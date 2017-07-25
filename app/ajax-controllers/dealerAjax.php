<?php
// Include Globals
require '../config/globals.php';
// Define Header
header("Content-Type: application/json; charset=utf-8");

// Instantiate Car Model
$car = new Car($conn);

// Instantiate Car Model
$money = new Money($conn);

// Load all cars owned by user_id, display as json_encode
if ($_POST['action'] == "buyNow") {

	if($car->fetchCarTemplate($_POST['buyID'])['ct_msrp'] > $user_info['user_cash']){
		echo json_encode(array("error" => "The user does not have enough cash"));
		return false;
	}else{
		$money->subtract($user_info['id'], $user_info['user_cash'], $car->fetchCarTemplate($_POST['buyID'])['ct_msrp']);
	}

	$bought = $car->buyCar($_POST['buyID'], $user_info['id']);

	if (!$bought){
		echo json_encode(array("error" => false));
	}elseif ($bought){
			echo json_encode(array("error" => true));
		}
}
