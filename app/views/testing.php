<?php
// Include Globals
require '../config/globals.php';
// Define header
//header("Content-Type: application/json; charset=utf-8");

// Instantiate Race Functions
$race = new Race($conn);
// Instantiate Money Functions
$money = new Money($conn);

function payRaceWinner($winner_id, $race_cash, $race_info){
	global $money, $race, $page, $tools;

	// Drive_two  wins, pay him
	$pay_out = $money->add($winner_id, $race_cash, $race_info['race_bet_amount'], $page);
	$update_winner = $tools->genericUpdate("race", "race_winner", $winner_id, "race_id", $race_info['race_id']);
	if( $race_info['race_for_pinks'] ){
		$change_owner = $car->changeCarOwner($race_info['race_d1_car'], $winner_id);
		$update_pinks = $car->setPinks($race_info['race_d2_car'], $winner_id, 0);
		$update_pinks = $car->setPinks($race_info['race_d1_car'], $winner_id, 0);
		$update_driviing = $car->changeDrivenCar($race_info['race_d1_car'], $winner_id);
	}
}

if($_GET['action'] == 'test'){
	$race_info = $race->fetchRaceID($_GET['race_id']);
	$driver_two_info = $user->fetchUser($race_info['race_driver_two']);

	$pay_winner_function = payRaceWinner($race_info['race_driver_two'], $driver_two_info['user_cash'], $race_info);

	echo $pay_winner_function;
}
