<?php
// Include Globals
require '../config/globals.php';
// Define Header
header("Content-Type: application/json; charset=utf-8");


if ($_POST['action'] == "getStats"){

	echo json_encode( array( "error" => false, "money" => number_format($user_info['user_cash'], 2), "currentCar" => $car->currentDrivenCar($user_info['id']) ) );
}
