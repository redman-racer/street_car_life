<?php
// Include Globals
require '../config/globals.php';
// Define Header
header("Content-Type: application/json; charset=utf-8");

// Instantiate Car Model
$car = new Car($conn);
// Instantiate Race Functions
$race = new Race($conn);

	if($_POST['action'] == "streetRace")
	{
		$car_template	  = $car->fetchCarTemplate($_POST['raceWho']);
		$results_computer = $race->raceMathStats($car_template['ct_hp'], $car_template['ct_weight']);

		$players_car  = $car->currentDrivenCar($user_info['id']);
		$results_player = $race->raceMathID($players_car['cars_id']);

		$race->recordRace(array("player1_id"=>$user_info['id'], "player1_car"=>$players_car['cars_id'], "player1_results"=>$results_player),
						  array("player2_id"=> 0, "player2_car"=>$car_template['ct_id'], "player2_results"=>$results_computer));
		echo json_encode(array("error" => false, "results" => array("computer"=>$results_computer, "player"=>$results_player)));
	}
