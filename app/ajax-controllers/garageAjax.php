<?php
// Include Globals
require '../config/globals.php';
// Define Header
header("Content-Type: application/json; charset=utf-8");

// Instantiate Car Model
$car = new Car($conn);


if ($_POST['action'] == "fetchCars") {
    // Fetch user cars
    $user_cars = $car->fetchAllUserCars($user_info['id']);
    // Check for cars
    if (!$user_cars) {
        echo json_encode(array("error" => "There was an unexpected error loading the cars."));
    } else {
        // Build Array
        echo json_encode(array("error" => false, "cars" => $car->fetchAllUserCars($user_info['id'])));
    }
}

