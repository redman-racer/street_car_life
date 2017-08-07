<?php
// Include Globals
require '../config/globals.php';
// Define Header
header("Content-Type: application/json; charset=utf-8");

// Instantiate Parts Store
$part_store = new PartStore($conn);


// Load all parts owned by store_id, display as json_encode
if ($_POST['action'] == "openStore") {
	// Fetch user cars
	$parts_available = $part_store->fetchAllParts($_POST['store_id']);

	// Check for parts
	if (!$parts_available) {
		echo json_encode( array( "error" => "There was an unexpected error loading the parts catalog for", "parts_available" => false ) );
	} else {
		// Build Array
		echo json_encode( array( "error" => false, "parts_available" => $parts_available, "image_root" => $IMAGE_ROOT ) );
	}
}


// Load all parts that are a part(pt_type) owned by store_id, display as json_encode
if ($_POST['action'] == "openPartType") {
	// Fetch user cars
	$parts = $part_store->fetchPartType($_POST['part_type'], $_POST['store_id']);

	// Add the commas to the numbers
	foreach ($parts as &$numbers) {
		$numbers['pt_msrp'] = number_format($numbers['pt_msrp']);
		$numbers['pt_hp'] = number_format($numbers['pt_hp']);
		$numbers['pt_tq'] = number_format($numbers['pt_tq']);
		$numbers['pt_weight'] = number_format($numbers['pt_weight']);
		$numbers['pt_reliability'] = number_format($numbers['pt_reliability']);
	}
	// Check for parts
	if (!$parts) {
		echo json_encode( array( "error" => "There was an unexpected error loading the part", "parts_available" => false ) );
	} else {
		// Build Array
		echo json_encode( array( "error" => false, "parts" => $parts, "image_root" => $IMAGE_ROOT ) );
	}
}

// Load single part(pt_id) owned by store_id, display as json_encode
if ($_POST['action'] == "openPart"){
	// Fetch the single Part
	$part = $part_store->fetchPart($_POST['part_id'], $_POST['store_id']);

	// Check for parts
	if (!$part) {
		echo json_encode( array( "error" => "There was an unexpected error loading the part.", "part" => false ) );
	} else {
		// Build Array
		echo json_encode( array( "error" => false, "part" => $part ) );
	}
}


// Buy Part controller
if ($_POST['action'] == "buyPart"){
	// Buy the Part
	$buy = $part_store->buyPart($_POST['part_id'], $_POST['store_id'], $user_info['id'], $_POST['install']);

	// Check to see if it was purchased suscesfully
	if (!$buy) {
		echo json_encode( array( "error" => "There was an unexpected error loading the part.", "bought" => false ) );
	} else {
		// Build Array
		echo json_encode( array( "error" => false, "bought" => true ) );
	}
}
