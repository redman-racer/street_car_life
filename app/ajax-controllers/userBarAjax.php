<?php
// Include Globals
require '../config/globals.php';
// Define Header
header("Content-Type: application/json; charset=utf-8");

// Instantiate Race Functions
$race = new Race($conn);

if ($_POST['action'] == "getStats"){

	echo json_encode( array( "error" => false, "money" => number_format($user_info['user_cash'], 2), "currentCar" => $car->currentDrivenCar($user_info['id']) ) );
}

if ( $_POST['action'] === "idToName" ){

	$userInfo = $user->fetchUser($_POST['user_id']);

	if( !$userInfo ){
		echo json_encode( array( "error" => true, "e_msg" => "There was an error finding the users information." ) );
	}else{
		echo json_encode( array( "error" => false, "e_msg" => false, "user_info" => $userInfo) );
	}
}

if ( $_POST['action'] === "getCurrentCarStat" ){
	$currentCar = $car->currentDrivenCar($user_info['id']);

	if( !$currentCar ){
		echo json_encode( array( "error" => true, "e_msg" => "There was an error finding the users information." ) );
	}else{
		$current_car_stats = $car->fetchCarStats($currentCar['cars_id'], $user_info['id']);
		$current_car_race  = $race->raceMathStats($current_car_stats['cars_hp'], $current_car_stats['cars_weight']);

		echo json_encode( array( "error" => false, "e_msg" => false, "current_car_stats" => $current_car_stats, "current_race" => $current_car_race) );
	}
}

if ( $_POST['action'] === "carIDToModel" ){
	$currentCar = $car->fetchCar($_POST['car_id']);

	if( !$currentCar ){
		echo json_encode( array( "error" => true, "e_msg" => "There was an error finding the users information." ) );
	}else{
		echo json_encode( array( "error" => false, "e_msg" => false, "current_car" => $currentCar['cars_model']) );
	}
}
