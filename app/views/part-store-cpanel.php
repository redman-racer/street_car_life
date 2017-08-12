<?php
$e_msg = "";
$menu_state = "";
$store_id = 0;
// Include Globals
require '../config/globals.php';
require '../controllers/PartStoreCP.php';
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
?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>

<!-- JQuery Dialog Box-->

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
<!-- Change Name Dialog-->


<!-- Post For Sale Dialog-->
<div id="post_for_sale_dialog" title="Post The Store for ">
	<div id="post_for_sale_error" style="display: none;">
			<div class="ui-widget" id="new_ps_name_error" style="displa: none;">
				<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
					<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
					<strong id="fs_passFail"></strong><span id="fs_e_msg_dialog"></span></p>
				</div>
			</div>
	</div>
  <p class="validateTips">How much do you want to sell it for?</p>

  <form>
    <fieldset>
      <label for="name">Amount</label>
      <input type="number" name="post_sale_amount" id="post_sale_amount" placeholder="<?php echo $ps_info['ps_value']; ?>" class="text ui-widget-content ui-corner-all">
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
<!-- Post For Sale Dialog-->

<!-- JQuery Dialog Box-->


<div id="Main_Container">
    <?php include_once '../includes/navigation.php'; ?>
    <div id="content">
		<div id="generic_container" style="">

			<ul id="menu" style="width: 10%; height: 99%; float: left;" class="<?php echo $menu_state; ?>">
			  <li><div>Edit Store</div>
				  <ul>
					<li id="change_name"><div>Change Name</div></li>
					<li id="post_sale"><div>Post for Sale</div></li>
				  </ul>
			  </li>
			  <li><div>Create Part</div></li>
			  <li><div>View Inventory</div></li>
			  <li><div id="open_storefront" data-storeid="<?php echo $store_id; ?>">View Storefront</div></li>
			</ul>

			<div id="cp_content" style="width: 89%; height: 99%; float: right; display: block;">

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
$( function() {
	// Makes the menu a menu
	$( "#menu" ).menu();

	$( "#change_name" ).on( "click", function() {
		$( "#new_ps_name_dialog" ).dialog( "open" );
	});

	$( "#post_sale" ).on( "click", function() {
		$( "#post_for_sale_dialog" ).dialog( "open" );
	});

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
	        form[ 0 ].reset();
	      }
	    });

	    form = $( "#new_ps_name_dialog" ).find( "form" ).on( "submit", function( event ) {
	      event.preventDefault();
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
	        form[ 0 ].reset();
	      }
	    });

	    form = $( "#post_for_sale_dialog" ).find( "form" ).on( "submit", function( event ) {
	      event.preventDefault();
	    });

	$( "#open_storefront" ).on( "click", function(){
		var store_id = $(this).data("storeid");
		window.location.href = site_root+"app/views/part-store?openStore=1&storeID=" + store_id;
	});

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
				closeDialog("post_for_sale_dialog")
			}, 1000 );
		}
	});
}

function closeDialog(dialog_id){
	$( "#" + dialog_id ).dialog( "close" );
}
} );
</script>

<script src="<?php echo $JS_ROOT; ?>all.js"></script>
</footer>
