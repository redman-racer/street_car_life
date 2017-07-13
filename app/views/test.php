<?php
// Include Globals
require '../config/globals.php';

// Instantiate Car Model
$car = new Car($conn);

// Fetch user cars
$selected_car = $car->fetchCar(9);

// Check for cars
if (!$selected_car) {
	echo json_encode(array("error" => "There was an unexpected error loading the cars."));
} else {
	// Build Array
	echo json_encode(array("error" => false, "selected_car" => $selected_car));
}
