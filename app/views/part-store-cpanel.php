<?php
$e_msg = "";
$menu_state = "";
// Include Globals
require '../config/globals.php';
require '../controllers/PartStoreCP.php';

if ( $error ){
	$menu_state = "ui-state-disabled";
}
?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
<div id="Main_Container">
    <?php include_once '../includes/navigation.php'; ?>
    <div id="content">
		<div id="generic_container" style="">

			<ul id="menu" style="width: 10%; height: 99%; float: left;" class="<?php echo $menu_state; ?>">
			  <li><div>Edit Store</div>
				  <ul>
					<li><div>Change Name</div></li>
					<li><div>Post for Sale</div></li>
				  </ul>
			  </li>
			  <li><div>Create Part</div></li>
			  <li><div>View Inventory</div></li>
			  <li><div>View Storefront</div></li>
			</ul>

			<div id="cp_content" style="width: 89%; height: 99%; float: right; display: block;">

				<?php echo $e_msg; ?>

			</div>

		</div>
    </div>
</div>
</body>
<footer>
<script>
$( function() {
	// Makes the menu a menu
	$( "#menu" ).menu();

	// When the document is loaded
	$( "document" ).ready(function () {
		var action = $( "#action" ).data('action');

		if ( action == "buyStore" ){
			$( "#newStoreOwner" ).fadeIn(600);
		}
	});


} );


</script>

<script src="<?php echo $JS_ROOT; ?>all.js"></script>
</footer>
