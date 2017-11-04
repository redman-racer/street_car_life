<?php
// Include Globals
require '../config/globals.php';
// Define Header
header("Content-Type: application/json; charset=utf-8");


// Instantiate Car Model
$money = new Money($conn);

// Instantiate Car Model
$car = new Car($conn);


// Load all cars owned by user_id, display as json_encode
if ($_POST['action'] == "fetchCars") {
	// Fetch user cars
	$user_cars = $car->fetchAllCarTemplate();

	//Add the cars thumbnail image to the array($car)
	foreach ($user_cars as &$carA) {
		//Construct the imags
		$carA['thumbnail_url'] = $IMAGE_ROOT."cars/garage/".$carA['ct_photo_folder']."/street-car-life-".$carA['ct_year']."-".$carA['ct_make']."-".$carA['ct_model']."-thumb.jpg";
	}

	// Check for cars
	if (!$user_cars) {
		echo json_encode(array("error" => "There was an unexpected error loading the cars."));
	} else {
		// Build Array
		echo json_encode(array("error" => false, "cars" => $user_cars));
	}
}


// Load one car by cars_id, the car_template, and the IMAGE_ROOT, display as json_encode
if ($_POST['action'] == "fetchCar") {

	// Fetch car_template
	$car_template = $car->fetchCarTemplate($_POST['car_id']);

	//Format the Cars MSRP into $5,000,000
	$car_template['ct_msrp'] = number_format($car_template['ct_msrp']);


	// Check for cars
	if (!$car_template) {
		echo json_encode(array("error" => "There was an unexpected error loading the cars."));
	} else {
		// Build Array
		echo json_encode(array("error" => false, "car_template" => $car_template, "IMAGE_ROOT" => $IMAGE_ROOT));
	}
}


// Load all cars owned by user_id, display as json_encode
if ($_POST['action'] == "buyNow") {

	if($car->fetchCarTemplate($_POST['buyID'])['ct_msrp'] > $user_info['user_cash']){
		echo json_encode(array("error" => "The user does not have enough cash"));
		return false;
	}else{
		$money->subtract($user_info['id'], $user_info['user_cash'], $car->fetchCarTemplate($_POST['buyID'])['ct_msrp'], $page);
	}

	// Sendthe information to the buyCar Function
	$bought = $car->buyCar($_POST['buyID'], $user_info['id']);


	if (!$bought){
		echo json_encode(array("error" => true, "site_root" => $SITE_ROOT));
	}elseif ($bought){
			echo json_encode(array("error" => false, "site_root" => $SITE_ROOT));
		}
}
