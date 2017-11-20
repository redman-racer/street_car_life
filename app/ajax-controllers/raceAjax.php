<?php
// Include Globals
require '../config/globals.php';
// Define header
header("Content-Type: application/json; charset=utf-8");

// Instantiate Car Model
$car = new Car($conn);
// Instantiate Race Functions
$race = new Race($conn);
// Instantiate Money Functions
$money = new Money($conn);

if( isset($_POST['action']) ){
	if($_POST['action'] == "streetRace")
	{
		// Check to see if User has enough money to cover his bet.
		if ($_POST['betAmount'] > $user_info['user_cash']){
			echo json_encode(array("error" => true, "noCash" => true));
			return false;
		}
		// Gets the computer car stats and sends it to the race math function
		$car_template	  = $car->fetchCarTemplate($_POST['raceWho']);
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
		$results_player['rtvrt']   = $_POST['playerRT'] + $results_player['vrt'];
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
			$money->add($user_info['id'], $user_info['user_cash'], $_POST['betAmount'], $page);
			$winner = "Player";
		}
		elseif ($results_player['rtet'] > $results_computer['rtet'] && !$redlightC){// If computer ET is faster than player and computer did not redlight
			$money->subtract($user_info['id'], $user_info['user_cash'], $_POST['betAmount'], $page);
			$winner = "Computer";
		}
		elseif($redlight && !$redlightC){ // If player redlights and computer does not
			$money->subtract($user_info['id'], $user_info['user_cash'], $_POST['betAmount'], $page);
			$winner = "Computer";
		}
		elseif($redlightC && !$redlight){ // If Computer redlights and player does not
			$money->add($user_info['id'], $user_info['user_cash'], $_POST['betAmount'], $page);
			$winner = "Player";
		}
		elseif($redlight && $redlightC){ // If Bother redlight, compare redlights and see who redlit the least .
			if($results_player['rtvrt'] > $results_computer['rtvrt']){
				$money->add($user_info['id'], $user_info['user_cash'], $_POST['betAmount'], $page);
				$winner = "Player";
			}
			elseif($results_player['rtvrt'] < $results_computer['rtvrt']){
				$money->subtract($user_info['id'], $user_info['user_cash'], $_POST['betAmount'], $page);
				$winner = "Computer";
			}
		}

		// Record the race in the db.
		$race->recordRace(array("player1_id"=>$user_info['id'], "player1_car"=>$players_car['cars_id'], "player1_results"=>$results_player),
						  array("player2_id"=> 0, "player2_car"=>$car_template['ct_id'], "player2_results"=>$results_computer));

		// Display results in json
		echo json_encode(array("error" => false, "results" => array("computer"=>$results_computer, "player"=>$results_player), "winner" => $winner));
	}

	if( $_POST['action'] === "createNewRace" ){
		$raceWho 	= $_POST['race_who'];
		$raceWhoID  = $_POST['race_who_id'];
		$raceAmount = $_POST['race_amount'];
		$raceType	= $_POST['race_type'];
		$forPinks   = $_POST['race_pinks'];

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
			$car_stats  = $car->fetchCarStats($currentCar['cars_id'], $user_info['id']);
			$race_stats = $race->raceMathStats($car_stats['cars_hp'], $car_stats['cars_weight']);

			//If error getting either, return false and echo error message
			if( !$car_stats || !$race_stats){
				echo json_encode(array("error" => true, "e_msg" => "There was an error while attempting to retrieve data. Please try again."));
				return false;
			}
		}

		//Create a new race
		$createNewRace = $race->createNewRace($user_info['id'], $raceWhoID, $raceWho, $currentCar['cars_id'], $raceAmount, $forPinks, $raceType);

		if( $createNewRace === true ){
			echo json_encode(array("error" => false, "e_msg" => "The race was created.", "race_stats" => $race_stats));
		} else{
			echo json_encode(array("error" => true, "e_msg" => "There was an issue creating the race, please try again."));
		}
	}
}else{
	header("Location: ".$SITE_ROOT);
	exit;
}
