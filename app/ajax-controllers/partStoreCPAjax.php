<?php
// Include Globals
require '../config/globals.php';
// Define Header
header("Content-Type: application/json; charset=utf-8");

// Instantiate Parts Store
$part_store = new PartStore($conn);

// Instantiate Parts Store Control Panel
$ps_cp = new PartStoreCP($conn);

// Instantiate Money
$money = new Money($conn);


// Load all parts owned by store_id, display as json_encode
if ($_POST['action'] == "changePSName") {

	// Fetch user cars
	$store_info = $part_store->fetchPartStore($_POST['store_id']);

	if ( $store_info['ps_owner_id'] != $user_info['id'] ){
		echo json_encode( array( "error" => true, "e_msg" => "You are not the owner of the store, you can not change the name.", "name_change" => false ) );
		$error = true;
		return;
	}

	$changed_name = $ps_cp->changeName($store_info['ps_id'], $_POST['new_name'], $user_info['id']);

	if ( $changed_name ){
		echo json_encode( array( "error" => false, "e_msg" => "", "name_change" => true ) );
	} else 	echo json_encode( array( "error" => true, "e_msg" => "There was an issue during the name change, please try again.", "name_change" => false ) );
	return;

	echo json_encode( array( "error" => true, "e_msg" => "An un-known error ocurred.", "name_change" => false ) );

}

// Load all parts owned by store_id, display as json_encode
if ($_POST['action'] == "postFS") {

	// Fetch user cars
	$store_info = $part_store->fetchPartStore($_POST['store_id']);

	if ( $store_info['ps_owner_id'] != $user_info['id'] ){
		echo json_encode( array( "error" => true, "e_msg" => "You are not the owner of the store, you can not change the name.", "for_sale" => false ) );
		$error = true;
		return;
	}

	$for_sale = $ps_cp->postForSale($store_info['ps_id'], $_POST['sale_amount'], $user_info['id']);

	if ( $for_sale ){
		echo json_encode( array( "error" => false, "e_msg" => "", "name_change" => true ) );
	} else 	echo json_encode( array( "error" => true, "e_msg" => "There was an issue while trying to set the sale amount, please try again.", "for_sale" => false ) );
	return;

	echo json_encode( array( "error" => true, "e_msg" => "An un-known error ocurred.", "for_sale" => false ) );

}
