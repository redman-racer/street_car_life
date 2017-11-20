<?php
$e_msg = "";
$menu_state = "";
$store_id = 0;
// Include Globals
require '../config/globals.php';
require '../controllers/PartStoreCP.php';
// Instantiate Parts Store Control Panel
$ps_cp = new PartStoreCP($conn);

if( isset($_GET['store_id'])){
	$store_id = $_GET['store_id'];
}

if ( !$store_id){
	$error = true;
	$e_msg = "The store id was not set.";
}

if ( $error ){
	$menu_state = "ui-state-disabled";
}

	// Build the select menu for Create a Part
	$optgroup = "";  $cp_msg = "";
	foreach( $ps_cp->fetchAllPartCreateTemplate() as &$row ){
		if ( $optgroup != $row['cp_type'] ){
			$optgroup = $row['cp_type'];
			$cp_msg = $cp_msg."</optgroup>
						<optgroup label=\"" .$row['cp_type']. "\">";
		}
		if ( $optgroup == $row['cp_type'] ){
			$cp_msg = $cp_msg."<option value=\"" .$row['cp_id']. "\">" .$row['cp_sub_type']. "</option>";
		}
	}


?>
<html>
<?php include_once '../includes/header.php'; ?>
<script>
function editMSRP(part_id, part_msrp){
	$( "#edit_msrp_dialog" ).dialog( "open" );
	$( "#edit_msrp_amount" ).val(part_msrp);
	$( "#edit_msrp_amount" ).data( "partid", part_id );
	$( "#edit_msrp_amount" ).data( "partmsrp", part_msrp );
}

function openQOH(part_id, qoh, cost){
	$( "#edit_qoh_dialog" ).dialog( "open" );
	$( "#edit_qoh_amount" ).val(qoh);
	$( "#edit_qoh_amount" ).data( "partid", part_id );
	$( "#edit_qoh_amount" ).data( "partcost", cost );
	$( "#edit_qoh_amount" ).data( "partcurqoh", qoh );
}

function updateQOHCost(){
	var cost = $( "#edit_qoh_amount" ).data( "partcost" );
	var currentQOH = $( "#edit_qoh_amount" ).data( "partcurqoh" );
	var newQOH = $( "#edit_qoh_amount" ).val();

	if( newQOH == "" ){
		$( "#qohCost" ).html("");
		return;
	}

	if( currentQOH > newQOH ){
		// Selling
		var chrg   = cost * (currentQOH - newQOH);
		var tx	   = chrg * 0.0725;
		var txdAMT = chrg - tx;
		txdAMT = Math.round(txdAMT * 100) / 100;

		var formattedAMT = format(txdAMT, "$");

		$( "#qohCost" ).html(formattedAMT);
		$( "#qohCost" ).css('color', 'green');
		return;
	}
	if( currentQOH < newQOH ){
		// Buying
		var chrg   = cost * (newQOH - currentQOH);
		var txdAMT = chrg * 1.0725;
		txdAMT	   = Math.round(txdAMT * 100) / 100;

		var formattedAMT = format(txdAMT, "$");

		$( "#qohCost" ).html(formattedAMT);
		$( "#qohCost" ).css('color', 'red');
		return;
	}

	$( "#qohCost" ).html("");
	$( "#qohCost" ).css('color', 'red');
	return;
}

function format(n, currency) {
	return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}
</script>
<body>

<!-- JQuery Dialog Box's-->
<jqueryDialogBox>
	<!-- Change Name Dialog-->
	<div id="new_ps_name_dialog" title="Rename Part Store">
		<div id="new_ps_name_error" style="display: none;">
				<div class="ui-widget" id="new_ps_name_error" style="displa: none;">
					<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
						<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
						<strong id="nn_passFail"></strong><span id="nn_e_msg_dialog"></span></p>
					</div>
				</div>
		</div>
	  <p class="validateTips">What would you like to change the name to?</p>

	  <form>
	    <fieldset>
	      <label for="name">Name</label>
	      <input type="text" name="new_ps_name" id="new_ps_name" value="<?php echo $ps_info['ps_name']; ?>" class="text ui-widget-content ui-corner-all" maxlength="20">
	      <!-- Allow form submission with keyboard without duplicating the dialog button -->
	      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
	    </fieldset>
	  </form>
	</div>
	<!-- Change Name Dialog -->

	<!-- Creat Part Dialog-->
	<div id="create_part_dialog" title="Create a New Part">
		<div id="create_part_error" style="display: none;">
				<div class="ui-widget" id="new_ps_name_error" style="displa: none;">
					<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: .7em;">
						<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
						<strong id="create_part_passFail"></strong><span id="create_part_e_msg_dialog"></span></p>
					</div>
				</div>
		</div>
	  <p class="validateTips">The amount of time, money and parts store Research and Development Skil level, will all play a roll in the gains from the part created.</p>

	  <form>
	    <fieldset>
	      <label for="part_type">Part Type</label>
			<select name="part_type" id="part_type">
				<?php echo $cp_msg; ?>
			</select>

	      <label for="create_part_amount">Money Invested</label>
		  	<input type="number" name="create_part_amount" id="create_part_amount" placeholder="$200,000" class="text ui-widget-content ui-corner-all" required>

	      <label for="part_time">Time Invested (In Real Time Minutes)</label>
		  	<input type="number" name="part_time" id="part_time" placeholder="20,000" class="text ui-widget-content ui-corner-all"  required>

	      <!-- Allow form submission with keyboard without duplicating the dialog button -->
	      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
	    </fieldset>
	  </form>
	</div>
	<!-- Create Part Dialog -->

	<!-- Blank MSG Dialog -->
	<div id="blank_msg_dialog" title="">
			<div class="ui-widget" id="blank_msg_error" style="display: none;">
				<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
					<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
					<strong id="blank_msg_passFail"></strong><span id="blank_msg_e_msg_dialog"></span></p>
					<div id="blank_msg_content_dialog"> </div>
				</div>
			</div>
	  <p class="validateTips" id="blank_msg_msg"></p>

	</div>
	<!-- Blank MSG Dialog -->

	<!-- Post For Sale Dialog -->
	<div id="post_for_sale_dialog" title="Post The Store for ">
		<div id="post_for_sale_error" style="display: none;">
				<div class="ui-widget" id="new_ps_name_error" style="displa: none;">
					<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
						<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
						<strong id="fs_passFail"></strong><span id="fs_e_msg_dialog"></span></p>
					</div>
				</div>
		</div>
	  <p class="validateTips" style="text-align: center;">How much do you want to sell it for? <br />
	  <span style="font-size: 10px;">The currest suggested sale price is $<?php echo number_format($ps_info['ps_value']); ?>.</span></p>

	  <form>
	    <fieldset>
	      <label for="name">Amount</label>
	      <input type="number" name="post_sale_amount" id="post_sale_amount" placeholder="$<?php echo number_format($ps_info['ps_value']); ?>" class="text ui-widget-content ui-corner-all">
	      <!-- Allow form submission with keyboard without duplicating the dialog button -->
	      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
	    </fieldset>
	  </form>
	</div>
	<!-- Post For Sale Dialog -->

	<!-- EDIT QOH Dialog -->
	<div id="edit_qoh_dialog" title="Change Quantity on Hand (QOH)">
		<div id="edit_qoh_error" style="display: none;">
				<div class="ui-widget" id="edit_qoh_error" style="displa: none;">
					<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
						<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
						<strong id="edit_qoh_passFail"></strong><span id="edit_qoh_e_msg_dialog"></span></p>
					</div>
				</div>
		</div>
	  <p class="validateTips">How many parts do you want to to keep on hand?</p>

	  <form>
	    <fieldset>
	      <label for="edit_qoh_amount">Amount</label>
	      <input type="number" name="edit_qoh_amount" id="edit_qoh_amount" onkeyup="updateQOHCost();" data-partid="" data-partcost="" data-partcurqoh="" placeholder="" class="text ui-widget-content ui-corner-all">
	      <!-- Allow form submission with keyboard without duplicating the dialog button -->
	      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
	    </fieldset>
	  </form>
	  <p class="validateTips" id="qohCost"> </p>
	</div>
	<!-- EDIT QOH Dialog -->

	<!-- EDIT MSRP Dialog -->
	<div id="edit_msrp_dialog" title="Change Manufacturer Suggested Retail Price (MSRP)">
		<div id="edit_msrp_error" style="display: none;">
				<div class="ui-widget" id="edit_qoh_error" style="displa: none;">
					<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
						<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
						<strong id="edit_msrp_passFail"></strong><span id="edit_msrp_e_msg_dialog"></span></p>
					</div>
				</div>
		</div>
	  <p class="validateTips">How much do you want to sell the part for?</p>

	  <form>
	    <fieldset>
	      <label for="edit_msrp_amount">Amount</label>
	      <input type="number" name="edit_msrp_amount" id="edit_msrp_amount" data-partid="" data-partmsrp="" class="text ui-widget-content ui-corner-all">
	      <!-- Allow form submission with keyboard without duplicating the dialog button -->
	      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
	    </fieldset>
	  </form>
	</div>
	<!-- EDIT MSRP Dialog -->
	</jqueryDialogBox>
<!-- JQuery Dialog Box's -->


<div id="Main_Container">
    <?php include_once '../includes/navigation.php'; ?>
    <div id="content">
		<div id="generic_container" style="">

			<ul id="menu" style="width: 10%; height: 99%; float: left;" class="<?php echo $menu_state; ?>">
			  <li><div>Edit Store</div>
				  <ul>
					<li id="change_name"><div>Change Name</div></li>
					<?php if ( $ps_info['ps_sale_status'] ){ $sale_id = "cancel_sale"; $sale_label = "Cancel Sale"; }
							else { $sale_id = "post_sale"; $sale_label = "Post For Sale"; }
					?>
					<li id="<?php echo $sale_id; ?>">
						<div>
							<?php echo $sale_label; ?>
						</div>
					</li>
				  </ul>
			  </li>
			  <li><div id="create_part">Create Part</div></li>
			  <li><div id="open_inventory">View Inventory</div></li>
			  <li><div id="open_storefront" data-storeid="<?php echo $store_id; ?>">View Storefront</div></li>
			</ul>

			<div id="cp_content" style="width: 89%; height: 99%; float: right; display: block; overflow: auto;">

				<?php echo $e_msg; ?>

			</div>

		</div>
    </div>
</div>
<div id="store_id" data-id="<?php echo $ps_info['ps_id']; ?>" style="diplay: none;"></div>
<div id="store_name" data-name="<?php echo $ps_info['ps_name']; ?>" style="diplay: none;"></div>
</body>
<footer>
<script>
// Page ready
$( function() {
	var storeID = $( "#store_id" ).data( "id" );
		// Makes the menu a menu
		$( "#menu" ).menu();

		// On Clicks
		$( "#change_name" ).on( "click", function() {
			$( "#new_ps_name_dialog" ).dialog( "open" );
		});

		$( "#post_sale" ).on( "click", function() {
			$( "#post_for_sale_dialog" ).dialog( "open" );
		});

		$( "#cancel_sale" ).on( "click", function() {
			cancelSale();
		});

		$( "#create_part" ).on( "click", function() {
			$( "#create_part_dialog" ).dialog( "open" );
		});

		$( "#open_inventory" ).on( "click", function() {
			openInventory();
		});

		$( "#open_storefront" ).on( "click", function(){
			var store_id = $(this).data("storeid");
			window.location.href = site_root+"app/views/part-store?openStore=1&storeID=" + store_id;
		});

		// Dialogs
		$( "#new_ps_name_dialog" ).dialog({
		      autoOpen: false,
		      height: "auto",
		      width: "auto",
		      modal: true,
		      buttons: {
		        "Change Name": function() {
					changePSName();
				},
		        Close: function() {
		          $( "#new_ps_name_dialog" ).dialog( "close" );
		        }
		      },
		      close: function() {
		        formnpsn[ 0 ].reset();
		      }
		    });

		    formnpsn = $( "#new_ps_name_dialog" ).find( "form" ).on( "submit", function( event ) {
		      event.preventDefault();
			  changePSName();
		    });

		$( "#blank_msg_dialog" ).dialog({
		      autoOpen: false,
		      height: "auto",
		      width: "auto",
		      modal: true,
		      buttons: {
		        "Ok": function() {
					$( "#blank_msg_dialog" ).dialog( "close" );
				}
		      }
		});

		$( "#post_for_sale_dialog" ).dialog({
		      autoOpen: false,
		      height: "auto",
		      width: "auto",
		      modal: true,
		      buttons: {
		        "Sell Now": function() {
					postPSFS();
				},
		        Close: function() {
		          $( "#post_for_sale_dialog" ).dialog( "close" );
		        }
		      },
		      close: function() {
		        formpfs[ 0 ].reset();
		      }
		    });

		    formpfs = $( "#post_for_sale_dialog" ).find( "form" ).on( "submit", function( event ) {
		      event.preventDefault();
			  postPSFS();
		    });

		$( "#create_part_dialog" ).dialog({
		      autoOpen: false,
		      height: "auto",
		      width: "auto",
		      modal: true,
		      buttons: {
		        "Create Part": function() {
					createPart();
				},
		        Close: function() {
		          $( "#create_part_dialog" ).dialog( "close" );
		        }
		      },
		      close: function() {
		        formcpf[ 0 ].reset();
				$( "#create_part_passFail" ).html("");
				$( "#create_part_e_msg_dialog" ).html("");
				$( "#create_part_error" ).fadeOut(600);
		      }
		    });

		    formcpf = $( "#create_part_dialog" ).find( "form" ).on( "submit", function( event ) {
				createPart();
		      event.preventDefault();
		    });

		$( "#edit_qoh_dialog" ).dialog({
		      autoOpen: false,
		      height: "auto",
		      width: "auto",
		      modal: true,
		      buttons: {
		        "Update Now": function() {
					var qoh = 	$( "#edit_qoh_amount" ).val();
					var part_id = 	$( "#edit_qoh_amount" ).data( "partid" );
					updateQOH(part_id, qoh);
				},
		        Close: function() {
		          $( "#edit_qoh_dialog" ).dialog( "close" );
		        }
		      },
		      close: function() {
		        formqoh[ 0 ].reset();
				openInventory();
				$( "#qohCost" ).html("");
				$( "#edit_qoh_passFail" ).html("");
				$( "#edit_qoh_e_msg_dialog" ).html("");
				$( "#edit_qoh_error" ).fadeOut(600);
		      }
		    });

		    formqoh = $( "#edit_qoh_dialog" ).find( "form" ).on( "submit", function( event ) {
		      event.preventDefault();
			  var qoh = 	$( "#edit_qoh_amount" ).val();
			  var part_id = 	$( "#edit_qoh_amount" ).data( "partid" );
			  updateQOH(part_id, qoh);
		    });

		$( "#edit_msrp_dialog" ).dialog({
		      autoOpen: false,
		      height: "auto",
		      width: "auto",
		      modal: true,
		      buttons: {
		        "Update Now": function() {
					var new_msrp = 	$( "#edit_msrp_amount" ).val();
					var part_id = 	$( "#edit_msrp_amount" ).data( "partid" );
					updateMSRP(part_id, new_msrp);
				},
		        Close: function() {
		          $( "#edit_msrp_dialog" ).dialog( "close" );
		        }
		      },
		      close: function() {
		        formmsrp[ 0 ].reset();
				openInventory();
				$( "#edit_msrp_passFail" ).html("");
				$( "#edit_msrp_e_msg_dialog" ).html("");
				$( "#edit_msrp_error" ).fadeOut(600);
		      }
		    });

		    formmsrp = $( "#edit_msrp_dialog" ).find( "form" ).on( "submit", function( event ) {
		      event.preventDefault();
			  var new_msrp = 	$( "#edit_msrp_amount" ).val();
			  var part_id = 	$( "#edit_msrp_amount" ).data( "partid" );
			  updateMSRP(part_id, new_msrp);
		    });

	// Functions
	function changePSName(){
		var storeID = $( "#store_id" ).data( "id" );
		var new_name = $( "#new_ps_name").val();

		if ( new_name == "For Sale" ){
			$( "#nn_passFail" ).html("Fail!  ");
			$( "#nn_e_msg_dialog" ).html("If you want to sell your store, please use the correct tool!");
			$( "#new_ps_name_error" ).fadeIn(600);
			return;
		}
		$.post(site_root+'app/ajax-controllers/partStoreCPAjax.php', {
			action: "changePSName",
			store_id: storeID,
			new_name: new_name
		}, function (data) {
			if( data['error'] == true ){
				$( "#nn_passFail" ).html("Fail!  ");
				$( "#nn_e_msg_dialog" ).html(data['e_msg']);
				$( "#new_ps_name_error" ).fadeIn(600);
			} else{
				$( "#nn_passFail" ).html("Success!  ");
				$( "#nn_e_msg_dialog" ).html("The store name was change to " + new_name +"!");
				$( "#new_ps_name_error" ).fadeIn(600);
				setTimeout(function(){
					closeDialog('new_ps_name_dialog')
				}, 1000);
			}
		});
	}

	function postPSFS(){
		var storeID 	= $( "#store_id" ).data( "id" );
		var sale_amount = $( "#post_sale_amount").val();

		$.post(site_root+'app/ajax-controllers/partStoreCPAjax.php', {
			action: "postFS",
			store_id: storeID,
			sale_amount: sale_amount
		}, function (data) {
			if( data['error'] == true ){
				$( "#fs_passFail" ).html("Fail!  ");
				$( "#fs_e_msg_dialog" ).html(data['e_msg']);
				$( "#post_for_sale_error" ).fadeIn(600);
			} else{
				$( "#fs_passFail" ).html("Success!  ");
				$( "#fs_e_msg_dialog" ).html("The store name was posted for sale for: $" + sale_amount +"!");
				$( "#post_for_sale_error" ).fadeIn(600);
				setTimeout( function(){
					closeDialog("post_for_sale_dialog");
				}, 1000 );
			}
		});
	}

	function cancelSale(){
		var storeID = $( "#store_id" ).data( "id" );

		$.post(site_root+'app/ajax-controllers/partStoreCPAjax.php', {
			action: "cancelFS",
			store_id: storeID
		}, function (data) {
			if( data['error'] == true ){
				$( "#blank_msg_dialog" ).dialog( "open" );
				$( "#blank_msg_passFail" ).html("Fail!  ");
				$( "#blank_msg_e_msg_dialog" ).html(data['e_msg']);
				$( "#blank_msg_error" ).fadeIn(600);
			} else{
				$( "#blank_msg_dialog" ).dialog( "open" );
				$( "#blank_msg_passFail" ).html("Success!  ");
				$( "#blank_msg_e_msg_dialog" ).html("The sale of the store was cancelled.");
				$( "#blank_msg_error" ).fadeIn(600);
				setTimeout( function(){
					closeDialog("blank_msg_dialog")
				}, 5000 );
			}
		});
	}

	function createPart(){
		var part_type_id = $( "#part_type" ).val(); var time_invested =  $( "#part_time" ).val(); var money_invested =  $( "#create_part_amount" ).val();

		if( time_invested <= 0 ) console.log("time_invested was less than 0");
		if( money_invested <= 0 ) console.log("money_invested was less than 0");


		$.post(site_root+'app/ajax-controllers/partStoreCPAjax.php', {
			action: "createPart",
			store_id: storeID,
			part_type_id: part_type_id,
			time_invested: time_invested,
			money_invested: money_invested
		}, function (data) {
			if( data['error'] == true ){
				$( "#create_part_passFail" ).html("Fail!  ");
				$( "#create_part_e_msg_dialog" ).html(data['e_msg']);
				$( "#create_part_error" ).fadeIn(600);

				return false;
			} else{
				$( "#create_part_passFail" ).html("Success!  ");
				$( "#create_part_e_msg_dialog" ).html(data['e_msg']);
				$( "#create_part_error" ).fadeIn(600);

				openInventory();
				return true;
			}
		});

		console.log("After the ajax.");
	}

	function openInventory(){
		var store_id = $( "#store_id" ).data("id");

		$.post(site_root+'app/ajax-controllers/partStoreCPAjax.php', {
			action: "openInventory",
			store_id: store_id
		}, function (data) {
			if( data['error'] == true ){
				$( "#blank_msg_dialog" ).dialog( "open" );
				$( "#blank_msg_passFail" ).html("Fail!  ");
				$( "#blank_msg_e_msg_dialog" ).html(data['e_msg']);
				$( "#blank_msg_error" ).fadeIn(600);
			} else{
				// Build the table
				table_heading = '<table id="inventory_table" width="100%" style="text-align: center; ">'+
									'<tr style="background-color: black; color: white; font-family: rootbear; font-size: 22px;">'+
										'<th width="15%" style="text-align: center;">'+
											'Part Category'+
										'</th>'+
										'<th width="15%" style="text-align: center;">'+
											'Part Type'+
										'</th>'+
										'<th width="15%" style="text-align: center;">'+
											'Part Name'+
										'</th>'+
										'<th width="55%" colspan="3" style="text-align: center;">'+
											'Part Description'+
										'</th>'+
									'</tr>';


				// Sort through all the returned rows
				table_content = ''; count = 1;
				data['inventory'].forEach(function (part) {

					if( isOdd(count) ){
						var color = 'grey';
						var color2 = 'white';
					} else{
						var color = 'white';
						var color2 = 'black';
					}

					// Check to see if part has finished being created
					var d = new Date(); var t = d.getTime(); var time_now = Math.round( t / 1000 ); var partFinCreate = 1;
					if ( part['pt_create_date'] >= time_now ){
						partFinCreate = 0;
						color = 'darkgrey';
						color2 = 'lightgrey';
					}

					table_content = table_content +
									'<tr style="text-align: center; background-color: ' + color + '; color: ' + color2 + '; border-top: 1px solid #000; border-radius: 3px; padding: 15px 0px 15px 0px;">'+
										'<td width="15%" style="padding-top: 15px; padding-bottom: 5px;">'+
											part['pt_type']+
										'</td>'+
										'<td width="15%" style="padding-top: 15px; padding-bottom: 5px;">'+
											part['pt_sub_type']+
										'</td>'+
										'<td width="15%" style="padding-top: 15px; padding-bottom: 5px;" id="pt_name" data-id="' + part['pt_id'] + '">'+
											part['pt_name']+
										'</td>'+
										'<td width="55%" style="padding-top: 15px; padding-bottom: 5px;" colspan="3" id="pt_description" data-id="' + part['pt_id'] + '">'+
											part['pt_description']+
										'</td>'+
									'</tr>'+
									'<tr style="text-align: center; background-color: ' + color + '; color: ' + color2 + '; border-bottom: 1px solid #000; border-radius: 3px;">'+
										'<td width="16.5%" style="padding-bottom: 15px;">'+
											'HP: ' + part['pt_hp']+
										'</td>'+
										'<td width="16.5%" style="padding-bottom: 15px;">'+
											'TQ: ' + part['pt_tq']+
										'</td>'+
										'<td width="16.5%" style="padding-bottom: 15px;">'+
											'Weight: ' + part['pt_weight']+
										'</td>'+
										'<td width="16.5%" style="padding-bottom: 15px; cursor: pointer;">'+
											'<div id="QOH_' + part['pt_id'] + '" onClick="openQOH(' + part['pt_id'] + ',' + part['pt_qoh'] + ',' + part['pt_cost'] + ');">QOH: ' + part['pt_qoh'] + '</div>'+
										'</td>'+
										'<td width="16.5%" style="padding-bottom: 15px;">'+
											'Cost: ' + part['pt_cost']+
										'</td>'+
										'<td width="16.5%" style="padding-bottom: 15px; cursor: pointer;" id="msrp" data-id="' + part['pt_id'] + '" data-msrp="' + part['pt_msrp'] + '">'+
											'<div id="MSRP_' + part['pt_id'] + '" onClick="editMSRP(' + part['pt_id'] + ',' + part['pt_msrp'] + ');">MSRP: ' + part['pt_msrp']+
										'</td>'+
									'</tr>';
					count++;
				});

				// Close the table
				table_closing =	'</table>';

				// Compile the table
				table = table_heading + table_content + table_closing;
				$( "#cp_content" ).html(table);


			}
		});
	}

	function updateQOH(partID, qoh){
		var storeID 	= $( "#store_id" ).data( "id" );

		if ( qoh < 0 ){
			$( "#edit_qoh_passFail" ).html("Fail!  ");
			$( "#edit_qoh_e_msg_dialog" ).html("The QOH has to be greater than 0! If you want to sell some invnetory, then simply enter the amount of inventory you would like to keep.");
			$( "#edit_qoh_error" ).fadeIn(600);
			return;
		}
		$.post(site_root+'app/ajax-controllers/partStoreCPAjax.php', {
			action: "updateQOH",
			store_id: storeID,
			part_id: partID,
			new_qoh: qoh
		}, function (data) {
			if( data['error'] == true ){
				$( "#edit_qoh_passFail" ).html("Fail!  ");
				$( "#edit_qoh_e_msg_dialog" ).html(data['e_msg']);
				$( "#edit_qoh_error" ).fadeIn(600);
			} else{
				$( "#edit_qoh_passFail" ).html("Success!  ");
				$( "#edit_qoh_e_msg_dialog" ).html("The part quantity was updated to: " + qoh +"!");
				$( "#edit_qoh_error" ).fadeIn(600);
				setTimeout( function(){
					closeDialog("edit_qoh_dialog")
				}, 1000 );
			}
		});
	}

	function updateMSRP(partID, msrp){
		var storeID 	= $( "#store_id" ).data( "id" );

		if ( msrp < 0 ){
			$( "#edit_msrp_passFail" ).html("Fail!  ");
			$( "#edit_msrp_e_msg_dialog" ).html("The MSRP has to be greater than 0!");
			$( "#edit_msrp_error" ).fadeIn(600);
			return;
		}
		$.post(site_root+'app/ajax-controllers/partStoreCPAjax.php', {
			action: "updateMSRP",
			store_id: storeID,
			part_id: partID,
			new_msrp: msrp
		}, function (data) {
			if( data['error'] == true ){
				$( "#edit_msrp_passFail" ).html("Fail!  ");
				$( "#edit_msrp_e_msg_dialog" ).html(data['e_msg']);
				$( "#edit_msrp_error" ).fadeIn(600);
			} else{
				$( "#edit_msrp_passFail" ).html("Success!  ");
				$( "#edit_msrp_e_msg_dialog" ).html("The part MSRP was updated to: " + msrp +"!");
				$( "#edit_msrp_error" ).fadeIn(600);
				setTimeout( function(){
					closeDialog("edit_msrp_dialog")
				}, 1000 );
			}
		});
	}

	function closeDialog(dialog_id){
		$( "#" + dialog_id ).dialog( "close" );
	}

	function isOdd(num) { return num % 2;};

});
// Page Ready });
</script>

<script src="<?php echo $JS_ROOT; ?>all.js"></script>
</footer>
