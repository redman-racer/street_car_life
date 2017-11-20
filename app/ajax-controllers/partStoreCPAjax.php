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
if ( $_POST['action'] == "changePSName" ) {

	// Fetch user cars
	$store_info = $part_store->fetchPartStore(    $_POST['store_id']);

	if ( $store_info['ps_owner_id'] != $user_info['id'] ){
		echo json_encode( array( "error" => true, "e_msg" => "You are not the owner of the store, you can not change the name.", "name_change" => false ) );
		$error = true;
		return;
	}

	$changed_name = $ps_cp->changeName($store_info['ps_id'],     $_POST['new_name'], $user_info['id']);

	if ( $changed_name ){
		echo json_encode( array( "error" => false, "e_msg" => "", "name_change" => true ) );
	} else 	echo json_encode( array( "error" => true, "e_msg" => "There was an issue during the name change, please try again.", "name_change" => false ) );
	return;

	echo json_encode( array( "error" => true, "e_msg" => "An un-known error ocurred.", "name_change" => false ) );

}

// Load all parts owned by store_id, display as json_encode
if ( $_POST['action'] == "postFS" ) {

	// Fetch user cars
	$store_info = $part_store->fetchPartStore(    $_POST['store_id']);

	if ( $store_info['ps_owner_id'] != $user_info['id'] ){
		echo json_encode( array( "error" => true, "e_msg" => "You are not the owner of the store, you can not post it for sale.", "for_sale" => false ) );
		$error = true;
		return;
	}

	$for_sale = $ps_cp->postForSale($store_info['ps_id'],     $_POST['sale_amount'], $user_info['id']);

	if ( $for_sale ){
		echo json_encode( array( "error" => false, "e_msg" => "", "for_sale" => true ) );
	} else 	echo json_encode( array( "error" => true, "e_msg" => "There was an issue while trying to set the sale amount, please try again.", "for_sale" => false ) );
	return;

	echo json_encode( array( "error" => true, "e_msg" => "An un-known error ocurred.", "for_sale" => false ) );

}

// Load all parts owned by store_id, display as json_encode
if ( $_POST['action'] == "cancelFS" ) {

	// Fetch user cars
	$store_info = $part_store->fetchPartStore(    $_POST['store_id']);

	if ( $store_info['ps_owner_id'] != $user_info['id'] ){
		echo json_encode( array( "error" => true, "e_msg" => "You are not the owner of the store, you can not cancel the sale.", "cancel_sale" => false ) );
		$error = true;
		return;
	}

	$cancel_sale = $ps_cp->cancelForSale($store_info['ps_id'], $user_info['id']);

	if ( $cancel_sale ){
		echo json_encode( array( "error" => false, "e_msg" => "", "cancel_sale" => true ) );
	} else 	echo json_encode( array( "error" => true, "e_msg" => "There was an issue while trying to cancel the sale, please try again.", "for_sale" => false ) );
	return;

	echo json_encode( array( "error" => true, "e_msg" => "An un-known error ocurred.", "for_sale" => false ) );

}

// Get the stores inventory
if ( $_POST['action'] == "openInventory" ){
	// Fetch Store Info
	$store_info = $part_store->fetchPartStore(    $_POST['store_id']);

	if ( $store_info['ps_owner_id'] != $user_info['id'] ){
		echo json_encode( array( "error" => true, "e_msg" => "You are not the owner of the store, you can not cancel the sale.", "inventory" => false ) );
		$error = true;
		return;
	}

	$view_inventory = $ps_cp->fetchInventory($store_info['ps_id']);

	if ( $view_inventory ){
		echo json_encode( array( "error" => false, "e_msg" => "We retrieved the stores inventory!", "inventory" => $view_inventory ) );
		return;
	} else {
		echo json_encode( array( "error" => true, "e_msg" => "There was an issue while trying to get the stores inventory.", "inventory" => false ) );
		return;
	}

	echo json_encode( array( "error" => true, "e_msg" => "An un-known error ocurred.", "inventory" => false ) );

}

// Update the stores inventory
if ( $_POST['action'] == "updateQOH" ){
	// Fetch Store Info
	$store_info = $part_store->fetchPartStore(    $_POST['store_id']);

	// Fetch Part Info
	$part_info = $part_store->fetchPart(    $_POST['part_id'],     $_POST['store_id']);

	// Check to see if they are the store owner, if not end the script.
	if ( $store_info['ps_owner_id'] != $user_info['id'] ){
		echo json_encode( array( "error" => true, "e_msg" => "You are not the owner of the store, you can not change the inventory.", "updateQOH" => false ) );
		$error = true;
		return;
	}

	// Check to see if the store is the owner of the part_template, if not end the script.
	if ( $store_info['ps_id'] != $part_info['pt_store_id'] ){
		echo json_encode( array( "error" => true, "e_msg" => "You are not the owner of the part, you can not change the inventory.", "updateQOH" => false ) );
		$error = true;
		return;
	}

	// Decide if they are selling or buying quantity $buySell = "sell", "buy";
	if( $part_info['pt_qoh'] >     $_POST['new_qoh'] ){
		// We are selling quantity
		$buySell = "sell";
	} elseif ( $part_info['pt_qoh'] <     $_POST['new_qoh'] ){
		// We are Buying quantity
		$buySell = "buy";
	} elseif ( $part_info['pt_qoh'] ==     $_POST['new_qoh'] ){
		// We are doing nothing
		echo json_encode( array( "error" => true, "e_msg" => "You entered the current amount in inventory, you can buy or sell by changing the QOH.", "updateQOH" => false ) );
		$error = true;
		return;
	}


	// If they are buying parts, verify user_cash, update QOH, return;
	if( $buySell == "buy" ){
		// Find out how many he wants to buy.
		$part_buying_amt =     $_POST['new_qoh'] - $part_info['pt_qoh'];

		// Figure how much his total will be
		$cost = $part_buying_amt * $part_info['pt_cost'];

		// Check to see if user has enough cash
		if( $cost >= $user_info['user_cash'] ){
			echo json_encode( array( "error" => true, "e_msg" => "You do not have enough cash to buy ".$part_buying_amt." parts.", "inventory" => false ) );
			return;
		}

		// Charge the Users account
		$charged_user = $money->subtractTAXED($user_info['id'], $user_info['user_cash'], $cost, $page);

		// If the money transacton was a success, then update the inventory, if inventory updated, return results.
		if ( $charged_user ){

				// Update the inventory
				$update_inventory = $ps_cp->updateQOH($part_info['pt_id'], $store_info['ps_id'],     $_POST['new_qoh']);

				// Check for updated inventory, return with results.
				if ( $update_inventory ){
					echo json_encode( array( "error" => false, "e_msg" => "We updated the parts quantity to ".    $_POST['new_qoh']."!", "inventory" => true ) );
					return;
					// The inventory failed to update
					} else {
						echo json_encode( array( "error" => true, "e_msg" => "There was an issue while trying to update the stores inventory.", "inventory" => false ) );
						return;
					}

			// The money transaction failed
			} else {
				echo json_encode( array( "error" => true, "e_msg" => "There was an issue while trying to deduct the amount from your account.", "inventory" => false ) );
				return;
			}

	}

	// If they are selling parts, verify qoh, update QOH, return;
	if( $buySell == "sell" ){
		// Find out how many he wants to buy.
		$part_selling_amt = $part_info['pt_qoh'] -     $_POST['new_qoh'];

		// Figure how much his total will be
		$cost = $part_selling_amt * $part_info['pt_cost'];

		// Check to see if store has enough QOH
		if( $part_selling_amt > $part_info['pt_qoh'] ){
			echo json_encode( array( "error" => true, "e_msg" => "You do not have enough parts on hand to sell ".$part_selling_amt." parts.", "inventory" => false ) );
			return;
		}

		// Update Inventory
		$update_inventory = $ps_cp->updateQOH($part_info['pt_id'], $store_info['ps_id'],     $_POST['new_qoh']);

		// Check to see if inventory updated, add amt to user, verify amt added, return results.
		if ( $update_inventory ){

			// Add the reutrned amount minus tax to the customer
			$charged_user = $money->addTAXED($user_info['id'], $user_info['user_cash'], $cost, $page);

			// Check to see if the amount was deposited into the users account.
			if ( $charged_user ){
				echo json_encode( array( "error" => false, "e_msg" => "We updated the parts quantity to ".    $_POST['new_qoh']."!", "inventory" => true ) );
				return;
			// The amount was never deposited in the users account
			} else {
				echo json_encode( array( "error" => true, "e_msg" => "There was an issue while trying to deposit $".number_format($taxed_amt)." into your account.", "inventory" => false ) );
				return;
			}

		// Inventory failed to update
		} else {
			echo json_encode( array( "error" => true, "e_msg" => "There was an issue while trying to update the stores inventory.", "inventory" => false ) );
			return;
		}
	}

	// If the script never encountered a return; call, then there was an un-known error.
	echo json_encode( array( "error" => true, "e_msg" => "An un-known error ocurred.", "inventory" => false ) );
	return;
}

// Load all parts owned by store_id, display as json_encode
if ( $_POST['action'] == "updateMSRP" ) {

	// Fetch user cars
	$store_info = $part_store->fetchPartStore(    $_POST['store_id']);

	if ( $store_info['ps_owner_id'] != $user_info['id'] ){
		echo json_encode( array( "error" => true, "e_msg" => "You are not the owner of the store, you can not change the MSRP.", "update_msrp" => false ) );
		$error = true;
		return;
	}

	if( $_POST['new_msrp'] < 0 ){
		echo json_encode( array( "error" => true, "e_msg" => "You can not set a - MSRP amount.", "update_msrp" => false ) );
		$error = true;
		return;
	}

	$update_msrp = $ps_cp->updateMSRP($store_info['ps_id'],     $_POST['part_id'],     $_POST['new_msrp']);

	if ( $update_msrp ){
		echo json_encode( array( "error" => false, "e_msg" => "", "update_msrp" => true ) );
		return;
	} else {
		echo json_encode( array( "error" => true, "e_msg" => "There was an issue while trying to set the sale amount, please try again.", "update_msrp" => false ) );
		return;
	}

	echo json_encode( array( "error" => true, "e_msg" => "An un-known error ocurred.", "update_msrp" => false ) );
	return;
}

// Load Create Part form
if ( $_POST['action'] == "createPart" ) {
	$store_id		=	$_POST['store_id'];
	$part_id		=	$_POST['part_type_id'];
	$time_invested  =	$_POST['time_invested'];
	$money_invested =	$_POST['money_invested'];
	$time_finished  =	time() + ($time_invested * 60);
	$moneyTaxed     = $money_invested * 1.0725;

	// Fetch Store Info
	$store_info = $part_store->fetchPartStore( $store_id );

	// Check to see if the user has enough cash
	if ( $moneyTaxed >= $user_info['user_cash'] ){
		echo json_encode( array( "error" => true, "e_msg" => "You do not have $".number_format($moneyTaxed)." There is tax applied to the amount you entered.", "create_part" => false ) );
		return;
	}

	// Check to see if they are the store owner, if not end the script.
	if ( $store_info['ps_owner_id'] != $user_info['id'] ){
		echo json_encode( array( "error" => true, "e_msg" => "You are not the owner of the store, you can not create a part for this store..", "create_part" => false ) );
		return;
	}

	// Check to see if either number is negative
	if ( $time_invested <= 0 ||  $money_invested <= 0 ){
		echo json_encode( array( "error" => true, "e_msg" => "You can not use a negative amount in either box.".$time_invested."||".$money_invested, "create_part" => false ) );
		return;
	}

	$time_factor = ($time_invested / 7200) * 100;
	if ( $time_factor >= 100 ){
		$time_factor = 100;
	}
	$money_factor = ( $money_invested / $money->getAllIGMCash() ) * 10000;
	if ( $money_factor >= 100 ){
		$money_factor = 100;
	}
	$ps_rd_level = $store_info['ps_rd_skill'];

	$part_template = $ps_cp->fetchPartCreateTemplate($part_id);

	function mintoMaxAdjust($time, $money, $rd_level)
	{
		$mtma = (( ( 100 - $money ) + ( 100 - $time ) + ( 100 - $rd_level ) ) * 0.01 );

		if ( $mtma < 1){
			$mtma = 1;
		}

		return $mtma;
	}

	$np_hp			= round( ( $time_factor + $money_factor + $ps_rd_level ) * $part_template['cp_hp_factor'], 3);
	$np_hp_limit 	= round(( $time_factor + $money_factor + $ps_rd_level ) * $part_template['cp_hp_limit_factor'], 3);
	$np_reliability = round(((((( $time_factor + $money_factor ) * 0.85 )  + $ps_rd_level )) / 3 ) * $part_template['cp_reliability_factor'], 3);
	$np_weight		= round(((((( $time_factor + $money_factor ) * 0.85 ) + $ps_rd_level )) / 3 ) * $part_template['cp_weight_factor'], 3);
	$np_traction	= round(( $time_factor + $money_factor + $ps_rd_level) * $part_template['cp_traction_factor'], 5);
	$np_cog 		= round(((((((( $money_factor + $time_factor ) * 0.65 ) + $ps_rd_level )) / 3 ) * 1.308 ) * $part_template['cp_cog_factor']) * mintoMaxAdjust($time_factor, $money_factor, $ps_rd_level), 3);

	// Subtract money from player
	$money_transaction = $money->subtractTaxed($user_info['id'], $user_info['user_cash'], $money_invested, $page);

	if( $money_transaction ){
			// The money was subtracted, create the part.
			if( $ps_cp->createPart($store_id, $part_id, $user_info['id'], $np_hp, $np_hp_limit, $np_reliability, $np_weight, $np_traction, $np_cog, $time_finished) )
			{
				// The part was created, return results
				echo json_encode( array( "error" => false, "e_msg" => "The part was created, and will make ".$np_hp." per liter. It will cost $".number_format($np_cog)." per part to stock.", "create_part" => false ) );
				return;
			} else{
				// The part was not created.
				echo json_encode( array( "error" => true, "e_msg" => "There was an issue while trying to create the part, the money was taken from your account. Please message a admin with the current time.", "create_part" => false ) );
				return;
			}
	// The money transaction failed
	} else {
		echo json_encode( array( "error" => true, "e_msg" => "There was an issue while trying to deduct the amount from your account.", "create_part" => false ) );
		return;
	}

echo json_encode( array( "error" => true, "e_msg" => "There was an un-known error.", "create_part" => false ) );
return;
}
