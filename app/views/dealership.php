<?php
// Include Globals
require '../config/globals.php';
?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
	<div id="Main_Container">
	    <?php include_once '../includes/navigation.php'; ?>
		<div id="content">
			<div id="generic_container">
				<?php
					foreach ($car->fetchAllCarTemplate() as $key => $value) {
						echo $value['ct_year']." ".$value['ct_make']." ".$value['ct_model']." - $".number_format($value['ct_msrp'], 2).
						" - <span style=\"cursor: pointer;\" id=\"buyNow\" data-id=\"".$value['ct_id']."\">Buy Now </span><br />";
					}
				 ?>
			</div>
		</div>
	</div>
</body>
<footer>
<script>
	$("body").on("click", "#buyNow", function (e) {
		var buyID = $(this).data("id");
		alert(buyID);
		$.post('app/ajax-controllers/dealerAjax.php', {
			action: 'buyNow',
			buyID: buyID
			}, function (data) {
				alert("The car was bought." + data['error']);
			});
		});
</script>
</footer>
