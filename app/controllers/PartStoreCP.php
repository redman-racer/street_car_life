<?php
//require '../config/globals.php';

// Instantiate Parts Store
$ps_cp = new PartStoreCP($conn);

// Instantiate Parts Store
$PartStore = new PartStore($conn);

// Instantiate Money
$money  =  new Money($conn);

// Setting error message to the page was loaded.
$e_msg = "PartStoreCP Controller was loaded.";
$error = false;

// Function to buy a part store
if ( isset($_GET['action']) && isset($_GET['store_id']) && $_GET['action'] == "buyStore" ){
	$e_msg = "Buy Store function was called.";

	$ps_info = $PartStore->fetchPartStore($_GET['store_id']);

	// Check to see if the store owner is selling the store
	if ( $ps_info['ps_sale_status'] != 1 ){
		$error = true;
		$e_msg = "The owner of ".$ps_info['ps_name'] ." is not trying to sell their store.";
	}

	// Checks to see if the user has enough cash to buy the store
	if ( $user_info['user_cash'] <= $ps_info['ps_sale_price'] ){
		$error = true;
		$e_msg = "You do not have enough cash to buy the store.";
	}

	if ( $error == false ){
		if ( $money->subtract($user_info['id'], $user_info['user_cash'], $ps_info['ps_sale_price'], $page) ){

			// GET THE STORE OWNERS INFO
			$ps_owner_info = $user->fetchUser($ps_info['ps_owner_id']);

			$money->addTAXED($ps_info['ps_owner_id'], $ps_owner_info['user_cash'], $ps_info['ps_sale_price'], $page);

			$changedOwner = $ps_cp->changeOwner($_GET['store_id'], $user_info['id']);
			// The money was subtracted
			if ( $changedOwner ){

				$ps_cp->changeName($_GET['store_id'], $_GET['storeName'], $user_info['id']);

				// The store owner was changed
				$error = false;
				$e_msg = "The store owner was changed successfully.";
				$changed_owner = true;
			}  else{
				 $error = true;
				 $e_msg = "There was an error while changing the owner of the store, please try again.";
				 $changed_owner = false;
			}
		} else{
			 $error = true;
			 $e_msg = "There was an error in the money transaction.";
			 $changed_owner = false;
		 }
 	}
}

// Initial StoreCP Opening
if ( isset($_GET['action']) && isset($_GET['store_id']) && $_GET['action'] == "openCP" ){
	$ps_info = $PartStore->fetchPartStore($_GET['store_id']);
	$e_msg = "<div id=\"e_msg\" style=\"margin-top: 15%; display: block; font-family: rootbear; color: #555F61; font-size: 32px;\">Welcome to the control panel for <b>".$ps_info['ps_name']."</b> <br />
	please select an option from the menu to continue</div>";
	$store_id = $_GET['store_id'];
}
 ?>
