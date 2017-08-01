<?php
// Include Globals
require '../config/globals.php';

// Instantiate Parts Store
$part_store = new PartStore($conn);
?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
<div id="Main_Container">
    <?php include_once '../includes/navigation.php'; ?>
    <div id="content">
		<div id="generic_container" style="background: url(<?php echo $IMAGE_ROOT; ?>wichita-map.png);  background-size: 100% 100%;
    background-repeat: no-repeat;">
			<?php
			foreach ($part_store->fetchAllPartStores() as $key => $value) {
			?>
				<span id="part_store" class="mapIcon" data-id="<?php echo $value['ps_id']; ?>" style="top: <?php echo $value['ps_top_pos']; ?>px; left: <?php echo $value['ps_left_pos']; ?>px;">
					<img src="<?php echo $IMAGE_ROOT; ?>map_pin.png" /><b><?php echo $value['ps_name']; ?></b>
				</span>
				<br />
			<?php
			}
			?>
		</div>

		<!-- Start actual part store HTML-->
		<div id="partStore" style="display: none;">
			<!--BEGIN car selection div - the small column on the left that contains all cars owned by the user-->
	        <div id="cs_container">

	        </div>
			<!--END car selection -->


			<!--BEGIN selected car display div - the large right div that displays the vehicles information-->
			<div id="cd_container">
				<!--Large car image container-->
				<div id="car_container">
				</div>
				<!--car stats box-->
				<div id="car_stats" style="width: 700; height: 300px; border: 2px solid #000; background-color: rgba(0, 0, 0, .8); position:absolute; top: 35px; left: 650px;">
					<table  style="width:100%; font-family: rootbear; font-size: 28px; color: #fff;">
						<tr>
							<td style="width:25%; text-align: right;">
								Horse Power
							</td>
							<td id="hp"  style="width:25%; text-align: center; color: #97d079;">
								<!--Insert HP Here-->
							</td>
							<td style="width:25%; text-align: right;">
								lb/ft Torque
							</td>
							<td  id="tq" style="width:25%; text-align: center; color: #ff6e5e;">
								<!--Insert TQ Here-->
							</td>
						</tr>
						<tr>
							<td style="width:25%; text-align: right;">
								Handling
							</td>
							<td id="handling" style="width:25%; height: 20px; text-align: center; border: 1px solid #fff; margin: 0px 5px 0px 5px; border-radius: 7px;">
							  <!--Insert Handling DIV here-->
							</td>
							<td style="width:25%; text-align: right;">
								Braking
							</td>
							<td  id="braking" style="width:25%; height: 20px; text-align: center; border: 1px solid #fff; margin: 0px 5px 0px 5px; border-radius: 7px;">
							  <!--Insert Brakign DIV here-->
							</td>
						</tr>
					</table>
			  </div>
			</div>
			<!--END selected car display div -->
		</div>
    </div>
</div>
</body>
<footer>
<script>
$("body").on("click", "#part_store", function (e) {
	var storeID = $(this).data("id");

	// POST to changeCar
	$.post('app/ajax-controllers/partStoreAjax.php', {
		action: "openStore",
		store_id: storeID
	}, function (data) {
		// Check for errors
		if (checkErrors(data)) return false;

		// Build the table for the parts_available
		$( "#generic_container" ).animate({	opacity: 0, height: "700", width: "90%"}, 500, function() {/* Animation complete.*/});
		$( "#partStore" ).fadeIn(800);
		/*$("#generic_container").html(
										'<tr border="1px">'+
											'<td>Part Type</td>'+
											'<td>Part Price</td>'+
											'<td>Added HP</td>'+
											'<td>Added TQ</td>'+
											'<td>Weight</td>'+
											'<td>Reliability</td>'+
											'<td>Description</td>'+
										'</tr>');*/


		// Loop through the parts that was returned
		data['parts_available'].forEach(function (part) {
			// Build the table row
			tableRow = 	'<tr style="border: 1px solid #000;">'+
							'<td>' +part['pt_type']+ '</td>'+
							'<td>' +part['pt_msrp']+ '</td>'+
							'<td>' +part['pt_hp']+ '</td>'+
							'<td>' +part['pt_tq']+ '</td>'+
							'<td>' +part['pt_weight']+ '</td>'+
							'<td>' +part['pt_reliability']+ '</td>'+
							'<td>' +part['pt_description']+ '</td>'+
						'</tr>';
			// $("#generic_container").append(tableRow);

		});
	});
});

// Check for errors in the array data['error']
function checkErrors(data) {
	if (data['error'] !== false) {
		console.log(data['error']);
		return true;
	} else {
		return false;
	}
}
</script>

<script src="<?php echo $JS_ROOT; ?>all.js"></script>
</footer>
