<?php
// Include Globals
require '../config/globals.php';
// Define Header
header("Content-Type: application/json; charset=utf-8");

// Instantiate Car Model
$car = new Car($conn);

// Load all cars owned by user_id, display as json_encode
if ($_POST['action'] == "fetchCars") {
	// Fetch user cars
	$user_cars = $car->fetchAllUserCars($user_info['id']);

	//Add the cars thumbnail image to the array($car)
	foreach ($user_cars as &$carA) {
		$carA['thumbnail_url'] = $IMAGE_ROOT.$car->carThumbnail($carA['cars_id']);
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
	// Fetch user cars
	$selected_car = $car->fetchCar($_POST['car_id']);

	// Fetch car_template
	$car_template = $car->fetchCarTemplate($selected_car['cars_ct_id']);

	// Check for cars
	if (!$selected_car) {
		echo json_encode(array("error" => "There was an unexpected error loading the cars."));
	} else {
		// Build Array
		echo json_encode(array("error" => false, "car" => $selected_car, "car_template" => $car_template, "IMAGE_ROOT" => $IMAGE_ROOT));
	}
}

// Change the driving car
if ($_POST['action'] == "changeCar") {
	//Update the car that is being driven
	$changeCar = $car->changeDrivenCar($_POST['car_id'], $user_info['id']);

	if (!$changeCar) {
		echo json_encode(array("error" => "There was an unexpected error loading the cars."));
	} else {
		// Build Array
		echo json_encode(array("error" => false, "changedCar" => true));
	}
}