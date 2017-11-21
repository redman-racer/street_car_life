<?php
// Include Globals
require '../config/globals.php';
// Define //header
//header("Content-Type: application/json; charset=utf-8");

// Instantiate Race Functions
$race = new Race($conn);
// Instantiate Money Functions
$money = new Money($conn);

if( isset($_GET['action']) ){


	if( $_GET['action'] == "streetRace" )
	{
		// Check to see if User has enough money to cover his bet.
		if ($_GET['betAmount'] > $user_info['user_cash']){
			echo json_encode(array("error" => true, "noCash" => true));
			return false;
		}
		// Gets the computer car stats and sends it to the race math function
		$car_template	  = $car->fetchCarTemplate($_GET['raceWho']);
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
		$results_player['rtvrt']   = $_GET['playerRT'] + $results_player['vrt'];
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
			$money->add($user_info['id'], $user_info['user_cash'], $_GET['betAmount'], $page);
			$winner = "Player";
		}
		elseif ($results_player['rtet'] > $results_computer['rtet'] && !$redlightC){// If computer ET is faster than player and computer did not redlight
			$money->subtract($user_info['id'], $user_info['user_cash'], $_GET['betAmount'], $page);
			$winner = "Computer";
		}
		elseif($redlight && !$redlightC){ // If player redlights and computer does not
			$money->subtract($user_info['id'], $user_info['user_cash'], $_GET['betAmount'], $page);
			$winner = "Computer";
		}
		elseif($redlightC && !$redlight){ // If Computer redlights and player does not
			$money->add($user_info['id'], $user_info['user_cash'], $_GET['betAmount'], $page);
			$winner = "Player";
		}
		elseif($redlight && $redlightC){ // If Bother redlight, compare redlights and see who redlit the least .
			if($results_player['rtvrt'] > $results_computer['rtvrt']){
				$money->add($user_info['id'], $user_info['user_cash'], $_GET['betAmount'], $page);
				$winner = "Player";
			}
			elseif($results_player['rtvrt'] < $results_computer['rtvrt']){
				$money->subtract($user_info['id'], $user_info['user_cash'], $_GET['betAmount'], $page);
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
	if( $_GET['action'] === "createNewRace" ){
		$raceWho 	= $_GET['race_who'];
		$raceWhoID  = $_GET['race_who_id'];
		$raceAmount = $_GET['race_amount'];
		$raceType	= $_GET['race_type'];
		$forPinks   = $_GET['race_pinks'];

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

		if( !$currentCar = $car->currentDrivenCar($user_info['id']) ){
			echo json_encode(array("error" => true, "e_msg" => "You have to be driving a car to start a race."));
			return false;

		//No errors getting car info, get the car stats and 1/4 time now.
		}else{

			// Check if for pinks and if it is, check car elligibility
			if( $currentCar['cars_for_pinks'] == 1){
				echo json_encode(array("error" => true, "e_msg" => "This car is currently in a pinks race, finish that race before starting a new one."));
				return false;

			} else if( $forPinks == 1 ){
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

	if( $_GET['action'] === "recordRace" ){
		$race_id	= $_GET['race_id'];
		$player_rt	= $_GET['player_rt'];
		$current_car  = $car->currentDrivenCar($user_info['id']);
		$race_results = $race->raceMathID($current_car['cars_id']);
		$race_info  = $race->fetchRaceID($race_id);
		$race_results['rt'] = $race_id;

		if( !$current_car || !$race_results || !$race_info){
			echo json_encode(array("error" => true, "e_msg" => "There was an error retrieving data, please try again."));
			return false;
		}

		if( $race_info['race_driver_one'] === $user_info['id'] ){
			$player = 1;
			$rd_x   = "race_driver_one";
		}

		if( $race_info['race_driver_two'] === $user_info['id'] ){
			$player = 2;
			$rd_x   = "race_driver_two";
		}

		if( $race_info['race_d'.$player.'_et'] !== NULL ){
			echo json_encode(array("error" => true, "e_msg" => "You have already submitted your time for this race."));
			return false;
		}

		if( $user_info['id'] !== $race_info[$rd_x]){
			echo json_encode(array("error" => true, "e_msg" => "You are not apart of this race."));
			return false;
		}

		$player_info = array("player_num" => $player, "current_car" => $current_car, "race_results" => $race_results);

		if( !$recordRace = $race->recordRace($player_info, $race_info['race_id']) ){
			echo json_encode(array("error" => true, "e_msg" => "There was an error while recording the race, please try again."));
			return false;
		} else{
			echo json_encode(array("error" => false, "e_msg" => "You recorded your race."));
			return true;
		}

	}
}else{
//header("Location: ".$SITE_ROOT);
exit;
}
