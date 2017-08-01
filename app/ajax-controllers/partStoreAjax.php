<?php
// Include Globals
require '../config/globals.php';
// Define Header
header("Content-Type: application/json; charset=utf-8");

// Instantiate Parts Store
$part_store = new PartStore($conn);


// Load all cars owned by user_id, display as json_encode
if ($_POST['action'] == "openStore") {
	// Fetch user cars
	$parts_available = $part_store->fetchAllParts($_POST['store_id']);

	// Check for parts
	if (!$parts_available) {
		echo json_encode( array( "error" => "There was an unexpected error loading the parts catalog for", "parts_available" => false ) );
	} else {
		// Build Array
		echo json_encode( array( "error" => false, "parts_available" => $parts_available ) );
	}
}
