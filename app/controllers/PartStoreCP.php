<?php
//require '../config/globals.php';

// Instantiate Parts Store
$ps_cp = new PartStoreCP($conn);

// Instantiate Parts Store
$PartStore = new PartStore($conn);

// Instantiate Money
$money  =  new Money($conn);

// Setting error message to the page was loaded.
$e_msg = "PartStoreCP was loaded.";
$error = false;

// Function to buy a part store
if ( $_GET['action'] = "buyStore" ){
	$e_msg = "Buy Store function was called.";

	$ps_info = $PartStore->fetchPartStore($_GET['storeID']);

	// Check to see if the store owner is selling the store
	if ( $ps_info['ps_name'] != "For Sale" ){
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
			// The money was subtracted
			if ( $ps_cp->changeOwner($_GET['storeID'], $user_info['id']) ){

				$ps_cp->changeName($_GET['storeID'], $_GET['storeName'], $user_info['id']);

				// The store owner was changed
				$error = false;
				$e_msg = "The store owner was changed successfully.";
				$changed_owner = true;
			}  else{
				 $error = true;
				 $e_msg = "There was an error while changing the owner of the store, please try again.";
				 $changed_owner = false;
			}
		}
		else{
			 $error = true;
			 $e_msg = "There was an error in the money transaction.";
			 $changed_owner = false;
		 }
 	}
}

 ?>
