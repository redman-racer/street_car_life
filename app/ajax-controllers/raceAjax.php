<?php
// Include Globals
require '../config/globals.php';
// Define header
header("Content-Type: application/json; charset=utf-8");


// Instantiate Race Functions
$race = new Race($conn);
// Instantiate Money Functions
$money = new Money($conn);

function payRaceWinner($winner_id, $race_cash, $race_info){
	global $money, $race, $page, $tools;

	$update_winner = $tools->genericUpdate("race", "race_winner", $winner_id, "race_id", $race_info['race_id']);
	if( $winner_id < 21 || $winner_id > 70 ){
		$deposit_amt = $race_info['race_bet_amount'] * 2;
		$pay_out = $money->add($winner_id, $race_cash, $deposit_amt, $page);
	}
	if( $race_info['race_for_pinks'] ){
		$change_owner = $car->changeCarOwner($race_info['race_d1_car'], $winner_id);
		$update_pinks = $car->setPinks($race_info['race_d2_car'], $winner_id, 0);
		$update_pinks = $car->setPinks($race_info['race_d1_car'], $winner_id, 0);
		$update_driviing = $car->changeDrivenCar($race_info['race_d1_car'], $winner_id);
	}

	return true;
}

if( isset( $_POST['action']) ){


	if(  $_POST['action'] == "streetRace" )
	{
		// Check to see if User has enough money to cover his bet.
		if ( $_POST['betAmount'] > $user_info['user_cash']){
			echo json_encode(array("error" => true, "noCash" => true));
			return false;
		}
		// Gets the computer car stats and sends it to the race math function
		$car_template	  = $car->fetchCarTemplate( $_POST['raceWho']);
		$results_computer = $race->raceMathStats($car_template['ct_hp'], $car_template['ct_weight']);

		// Set the skill level of the computers RT
		$rtLevel          = rand(1,6);
		switch ($rtLevel) {
			case '1':
				$results_computer['rt'] = (rand(0,300)/1000)*-1;
				break;

			case '2':
				$results_computer['rt'] = (rand(50,200)/1000)*-1;
				break;

			case '3':
				$results_computer['rt'] = rand(0,500)/1000;
				break;

			case '4':
				$results_computer['rt'] = rand(200,700)/1000;
				break;

			case '5':
				$results_computer['rt'] = rand(700,1000)/1000;
				break;

			case '6':
				$results_computer['rt'] = (rand(300,600)/1000)*-1;
				break;

			default:
				$results_computer['rt'] = rand(0,1000)/1000;
				break;
		}

		// Get the players car stats an then send it to the race math function
		$players_car  = $car->currentDrivenCar($user_info['id']);
		$player_car_stats = $car->fetchCarStats($players_car['cars_id'], $user_info['id']);
		$results_player = $race->raceMathStats($player_car_stats['cars_hp'], $player_car_stats['cars_weight']);

		// Add Vehicle RT to the Player RT
		$results_player['vrt']   = (rand(3000, 4000)-($players_car['cars_hp']*2))/10000;
		$results_computer['vrt'] = (rand(3000, 4000)-($car_template['ct_hp']*2))/10000;

		// Add the VRT to the RT
		$results_player['rtvrt']   =  $_POST['playerRT'] + $results_player['vrt'];
		$results_computer['rtvrt'] = $results_computer['rt'] + $results_computer['vrt'];

		// Add the RT to ET
		$results_player['rtet']   = $results_player['et'] + $results_player['rtvrt'];
		$results_computer['rtet'] = $results_computer['et'] + $results_computer['rtvrt'];

		// Sets red light for player
		if ($results_player['rtvrt'] < 0){
			$redlight= true;
		} else { $redlight = false; }

		// Sets red light for computer
		if ($results_computer['rtvrt'] < 0){
			$redlightC = true;
		} else { $redlightC = false; }

		// Make the money transfers for the winner
		if ($results_player['rtet'] < $results_computer['rtet'] && !$redlight){// IF Player ET is faster than computer and player did not redlight
			$money->add($user_info['id'], $user_info['user_cash'],  $_POST['betAmount'], $page);
			$winner = "Player";
		}
		elseif ($results_player['rtet'] > $results_computer['rtet'] && !$redlightC){// If computer ET is faster than player and computer did not redlight
			$money->subtract($user_info['id'], $user_info['user_cash'],  $_POST['betAmount'], $page);
			$winner = "Computer";
		}
		elseif($redlight && !$redlightC){ // If player redlights and computer does not
			$money->subtract($user_info['id'], $user_info['user_cash'],  $_POST['betAmount'], $page);
			$winner = "Computer";
		}
		elseif($redlightC && !$redlight){ // If Computer redlights and player does not
			$money->add($user_info['id'], $user_info['user_cash'],  $_POST['betAmount'], $page);
			$winner = "Player";
		}
		elseif($redlight && $redlightC){ // If Bother redlight, compare redlights and see who redlit the least .
			if($results_player['rtvrt'] > $results_computer['rtvrt']){
				$money->add($user_info['id'], $user_info['user_cash'],  $_POST['betAmount'], $page);
				$winner = "Player";
			}
			elseif($results_player['rtvrt'] < $results_computer['rtvrt']){
				$money->subtract($user_info['id'], $user_info['user_cash'],  $_POST['betAmount'], $page);
				$winner = "Computer";
			}
		}

		// Record the race in the db.
		$race->recordRace(array("player1_id"=>$user_info['id'], "player1_car"=>$players_car['cars_id'], "player1_results"=>$results_player),
						  array("player2_id"=> 0, "player2_car"=>$car_template['ct_id'], "player2_results"=>$results_computer));

		// Display results in json
		echo json_encode(array("error" => false, "results" => array("computer"=>$results_computer, "player"=>$results_player), "winner" => $winner));
	}

	//Create a new race
	if(  $_POST['action'] === "createNewRace" ){
		$raceWho 	=  $_POST['race_who'];
		$raceWhoID  =  $_POST['race_who_id'];
		$raceAmount =  $_POST['race_amount'];
		$raceType	=  $_POST['race_type'];
		$forPinks   =  $_POST['race_pinks'];
		$last24     =  $race->fetchD1Last24($user_info['id']);

		// Check to see if User has enough money to cover his bet.
		if ($raceAmount > $user_info['user_cash']){
			echo json_encode(array("error" => true, "e_msg" => "You do not have enough cash to start the race."));
			return false;
		}
		// Check if amount is negative.
		if( $raceAmount < 0){
			echo json_encode(array("error" => true, "e_msg" => "You can not race for a negative amount."));
			return false;
		}

		if ( $raceWho == "player" ){
			$getRacerID = $user->fetchByUser($raceWhoID);

			if( !$getRacerID ){
				echo json_encode(array("error" => true, "e_msg" => "We could not find your opponent, please try again."));
				return false;
			}

			$raceWhoID  = $getRacerID['id'];
		}

		if ( $raceWho == "computer"){
			foreach ($last24 as &$lrace) {
				if( $lrace['race_driver_two'] == $raceWhoID && $raceWhoID != 21){
					echo json_encode(array("error" => true, "e_msg" => "You can not race this computer again. <br /> You can only race them once every 2 minutes."));
					return false;
				}
			}

			$getRacerID = $user->fetchByUser($raceWhoID);

			if($raceAmount < $getRacerID['user_cash']){
				echo json_encode(array("error" => true, "e_msg" => "You can not race this computer for more than the displayed amount."));
				return false;
			}
			$forPinks = 0;
		}

		if ( $raceWho == "test" ){
			$raceAmount = 0;
			$forPinks   = 0;
			$raceWhoID  = 0;
		}

		if( !$currentCar = $car->currentDrivenCar($user_info['id']) ){
			echo json_encode(array("error" => true, "e_msg" => "You have to be driving a car to start a race."));
			return false;

		//No errors getting car info, get the car stats and 1/4 time now.
		}else{

			// Check if for pinks and if it is, check car elligibility
			if( $currentCar['cars_for_pinks'] == 1){
				echo json_encode(array("error" => true, "e_msg" => "This car is currently in a pinks race, finish that race before starting a new one."));
				return false;

			}

			if( $forPinks == 1 ){
				if( !$car->setPinks($currentCar['cars_id'], $user_info['id'], $forPinks) ){
					echo json_encode(array("error" => true, "e_msg" => "We failed to set the car as an active pinks race car, please try again."));
					return false;
				}
			}

			$car_stats  = $car->fetchCarStats($currentCar['cars_id'], $user_info['id']);
			$race_stats = $race->raceMathStats($car_stats['cars_hp'], $car_stats['cars_weight']);

			//If error getting either, return false and echo error message
			if( !$car_stats || !$race_stats){
				echo json_encode(array("error" => true, "e_msg" => "There was an error while attempting to retrieve data. Please try again."));
				return false;
			}
		}

		// Subtract the money
		if( !$money->subtract($user_info['id'], $user_info['user_cash'], $raceAmount, $page) ){
			echo json_encode(array("error" => true, "e_msg" => "There was an error deducting the funds, please try again."));
			return false;
		}

		// Create the race
		$createNewRace = $race->createNewRace($user_info['id'], $raceWhoID, $raceWho, $currentCar['cars_id'], $raceAmount, $forPinks, $raceType);

		$race_stats['race_id'] = $createNewRace;

		if( $createNewRace === false ){
			// ERROR, write error msg and return false.
			echo json_encode(array("error" => true, "e_msg" => "There was an issue creating the race, please try again."));
			return false;
		} else{
			echo json_encode(array("error" => false, "e_msg" => "The race was created.", "race_stats" => $race_stats));
		}
	}

	if(  $_POST['action'] === "recordRace" ){
		$race_id	=  $_POST['race_id'];
		$player_rt	=  $_POST['player_rt'];
		$current_car		= $car->currentDrivenCar($user_info['id']);
		$current_car_stats 	= $car->fetchCarStats($current_car['cars_id'], $user_info['id']);
		$race_results 		= $race->raceMathStats($current_car_stats['cars_hp'], $current_car_stats['cars_weight']);
		$race_info  		= $race->fetchRaceID($race_id);
		$race_results['rt'] = $player_rt;

		if( !$current_car || !$race_results || !$race_info){
			echo json_encode(array("error" => true, "e_msg" => "There was an error retrieving data, please try again."));
			return false;
		}

		//Finding which driver position the player is
		if( $race_info['race_driver_one'] === $user_info['id'] ){
			$player = 1;
			$rd_x   = "race_driver_one";
		}
		//Finding which driver position the player is
		if( $race_info['race_driver_two'] === $user_info['id'] ){
			$player = 2;
			$rd_x   = "race_driver_two";
			// Check to see if User has enough money to cover his bet.
			if ($race_info['race_bet_amount'] > $user_info['user_cash']){
				echo json_encode(array("error" => true, "e_msg" => "You do not have enough cash to start the race."));
				return false;
			}

			if( !$money->subtract($user_info['id'], $user_info['user_cash'], $race_info['race_bet_amount'], $page) ){
				echo json_encode(array("error" => true, "e_msg" => "There was an error deducting the funds, please try again."));
				return false;
			}

			if( $race_info['race_for_pinks'] == 1 ){
				if( !$car->setPinks($current_car['cars_id'], $user_info['id'], 1) ){
					echo json_encode(array("error" => true, "e_msg" => "We failed to set the car as an active pinks race car, please try again."));
					return false;
				}
			}
		}

		// Check to see if they are racing a computer_id
		if( $race_info['race_driver_two'] > 20 && $race_info['race_driver_two'] <= 71){
			$com_current_car		= $car->currentDrivenCar($race_info['race_driver_two']);
			$com_current_car_stats	= $car->fetchCarStats($com_current_car['cars_id'], $race_info['race_driver_two']);
			$com_race_results 		= $race->raceMathStats($com_current_car_stats['cars_hp'], $com_current_car_stats['cars_weight']);
			// Set the skill level of the computers RT
			$rtLevel          = rand(1,6);
			switch ($rtLevel) {
				case '1':
					$com_race_results['rt'] = (rand(0,300)/1000)*-1;
					break;

				case '2':
					$com_race_results['rt'] = (rand(50,200)/1000)*-1;
					break;

				case '3':
					$com_race_results['rt'] = rand(0,500)/1000;
					break;

				case '4':
					$com_race_results['rt'] = rand(200,700)/1000;
					break;

				case '5':
					$com_race_results['rt'] = rand(700,1000)/1000;
					break;

				case '6':
					$com_race_results['rt'] = (rand(300,600)/1000)*-1;
					break;

				default:
					$com_race_results['rt'] = rand(0,1000)/1000;
					break;
			}

			$computer_info = array("player_num" => 2, "current_car" => $com_current_car, "race_results" => $com_race_results);
			if( !$recordComRace = $race->recordRace($computer_info, $race_info['race_id']) ){
				echo json_encode(array("error" => true, "e_msg" => "There was an error while recording the computers race, please try again."));
				return false;
			}
			$race_info = $race->fetchRaceID($race_id);
		}

		// Check to see if they have already submitted a race for this race ID
		if( $race_info['race_d'.$player.'_et'] !== NULL ){
			echo json_encode(array("error" => true, "e_msg" => "You have already submitted your time for this race.", "race_stats" => $race_info));
			return false;
		}

		// Redundent check to make sure they are actually in the race
		if( $user_info['id'] !== $race_info[$rd_x]){
			echo json_encode(array("error" => true, "e_msg" => "You are not in this race."));
			return false;
		}

		//Start traction  editing
		switch($race_info['race_track_type']){
			case 'street_race':
				$track_traction = -80;
				break;
			case 'track_race':
				$track_traction = 0;
				break;
			default:
				$track_traction = 0;
				break;
		}
		$tuning_traction	= 0;
		$launch_rpm			= $user_info['user_launch_rpm'];
		$redline_rpm		= 6500;
		$rpm_multiplier		= $launch_rpm/$redline_rpm; //61.5%
		$total_traction		= $track_traction + $tuning_traction + $current_car_stats['cars_traction'];

		// Find Spin Amount - is a percentage of traction available for hp
		$spin_amt  = $total_traction / $current_car_stats['cars_hp'];

		if($spin_amt < 1){
			// Tire Spin
			$spin_perc = (1 - $spin_amt) * ($rpm_multiplier + 1);
			// Modify 60'
			$new_sixty = ($race_results['sixty'] * $spin_perc) + $race_results['sixty'];

			// Math to modify 1/4 et
			$sixty_diff = $new_sixty - $race_results['sixty'];

			//Modify 1/4 ET
			$new_et = $race_results['et'] + ( $sixty_diff * 1.72);
			$new_mph = round($race_results['trap'] * ( ($spin_perc/17) + 1 ), 3);

			// Insert traction modified times into Array
			$race_results['et'] = round($new_et, 3);
			$race_results['sixty'] = round($new_sixty, 3);
			$race_results['trap'] = $new_mph;
		} elseif ($spin_amt >= 1) {
			$spin_perc = 0;
			$extra_traction = $spin_amt - 1;
			$max_rpm_before_spin = ($extra_traction * $redline_rpm) + 1450;
			$rpm_before_spin_perc = $launch_rpm / $max_rpm_before_spin;

			if ( $rpm_before_spin_perc <= 1){
				// Hooked, reward with better 60' and et
				// Modify 60'
				$new_sixty = ( ((1 - $rpm_before_spin_perc) / 5) * $race_results['sixty'] ) + $race_results['sixty'];

				// Math to modify 1/4 et
				$sixty_diff = $new_sixty - $race_results['sixty'];

				//Modify 1/4 ET
				$new_et = $race_results['et'] + ( $sixty_diff * 1.72);

				// Insert traction modified times into Array
				$race_results['et'] = round($new_et, 3);
				$race_results['sixty'] = round($new_sixty, 3);

			} elseif ( $rpm_before_spin_perc > 1){
				$spin_perc	=	$rpm_before_spin_perc - 1;

				// Modify 60'
				$new_sixty = ($race_results['sixty'] * $spin_perc) + $race_results['sixty'];

				// Math to modify 1/4 et
				$sixty_diff = $new_sixty - $race_results['sixty'];

				//Modify 1/4 ET
				$new_et = $race_results['et'] + ( $sixty_diff * 1.72);
				$new_mph = round($race_results['trap'] * ( ($spin_perc/17) + 1 ), 3);

				// Insert traction modified times into Array
				$race_results['et'] = round($new_et, 3);
				$race_results['sixty'] = round($new_sixty, 3);
				$race_results['trap'] = $new_mph;

			}
		}



		$player_info = array("player_num" => $player, "current_car" => $current_car, "race_results" => $race_results);

		if( !$recordRace = $race->recordRace($player_info, $race_info['race_id']) ){
			echo json_encode(array("error" => true, "e_msg" => "There was an error while recording the race, please try again."));
			return false;
		} else{
			//Add to Array
			$race_info = $race->fetchRaceID($race_id);
			$driver_one_info = $user->fetchUser($race_info['race_driver_one']);
			$driver_two_info = $user->fetchUser($race_info['race_driver_two']);


			if( $race_info['race_d1_et'] !== NULL && $race_info['race_d2_et'] !== NULL){
				$total_et1 = $race_info['race_d1_et'] + $race_info['race_d1_rt'];
				$total_et2 = $race_info['race_d2_et'] + $race_info['race_d2_rt'];

				$driver_one_info = $user->fetchUser($race_info['race_driver_one']);
				$driver_two_info = $user->fetchUser($race_info['race_driver_two']);

				// Check if its a computer race before doing money math
				if( $driver_two_info['id'] > 20 && $driver_two_info['id'] < 71){
					$com_race = true;
				}else $com_race = false;

				$bet_total = $race_info['race_bet_amount'] * 2;

				//  Driver 1 RED LIGHT
				if( $race_info['race_d1_rt'] < 0 ){
					// Drive_two  wins, pay him
					$pay_winner_function = payRaceWinner($race_info['race_driver_two'], $driver_two_info['user_cash'], $race_info);

				// Driver 2 RED LIGHT
				}elseif( $race_info['race_d2_rt'] < 0 ){
					// Driver_one wins, pay him
					$pay_winner_function = payRaceWinner($race_info['race_driver_one'], $driver_one_info['user_cash'], $race_info);
				// BOTH Red Light
				}elseif( $race_info['race_d2_rt'] < 0 && $race_info['race_d1_rt'] < 0 ){
					if(  $race_info['race_d2_rt'] < $race_info['race_d1_rt'] ){
						// Driver_one wins, pay him
						$pay_winner_function = payRaceWinner($race_info['race_driver_one'], $driver_one_info['user_cash'], $race_info);
					}elseif( $race_info['race_d2_rt'] > $race_info['race_d1_rt'] ){
						// Driver_one wins, pay him
						$pay_winner_function = payRaceWinner($race_info['race_driver_two'], $driver_two_info['user_cash'], $race_info);
					}
				}elseif( $total_et1 < $total_et2 && $race_info['race_d1_rt'] > 0 ){
					// Driver_one wins, pay him
					$pay_winner_function = payRaceWinner($race_info['race_driver_one'], $driver_one_info['user_cash'], $race_info);
				}elseif( $total_et1 > $total_et2 &&  $com_race !== true){
					// Drive_two  wins, pay him
					$pay_winner_function = payRaceWinner($race_info['race_driver_two'], $driver_two_info['user_cash'], $race_info);
				}

				if( !$pay_winner_function ){
					echo json_encode(array("error" => true, "e_msg" => "There was an error with paying the winner.", "race_info" => $race_info));
					return true;
				}
			}

			$race_info = $race->fetchRaceID($race_id);
			echo json_encode(array("error" => false, "e_msg" => "You recorded your race.", "race_stats" => $race_info, "spin_amount" => $spin_perc));
		}

	}

	if( $_POST['action'] === "getRace" ){
		$race_id = $_POST['race_id'];
		$race_info = $race->fetchRaceID($race_id);

		if( $race_info ){
			echo json_encode(array("error" => false, "e_msg" => "", "race_info" => $race_info));
			return true;
		} else{

				echo json_encode(array("error" => true, "e_msg" => "Could not find race information."));

			 return false;
		 }
	}

	if( $_POST['action'] === "setLaunchRPM" ){

		if( $update_launch_rpm = $user->updateLaunch($user_info['id'], $_POST['launch_rpm']) ){
			echo json_encode(array("error" => false, "e_msg" => "You updated your launch rpm."));
			return false;
		}else {
			echo json_encode(array("error" => true, "e_msg" => "There was an error retrieving data, please try again."));
			return false;
		}
	}

}else{
header("Location: ".$SITE_ROOT);
exit;
}
