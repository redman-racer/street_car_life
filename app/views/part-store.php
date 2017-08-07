data['part']<?php
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
				<div id="car_container" width="600px" height="600px" style="width: 600px; height: 600px; margin: 35px 0px 0px 40px;">
					<!--Insert parts list here-->
				</div>
				<!--car stats box-->
				<div id="car_stats" style="display: none; width: 700; height: 300px; border: 2px solid #000; background-color: rgba(0, 0, 0, .8); position:absolute; top: 35px; left: 650px;">
					<table  style="width:100%; font-family: rootbear; font-size: 28px; color: #fff;">
						<!--First Row-->
						<tr>
							<td style="width:25%; text-align: right;">
								Horse Power
							</td>
							<td id="hp"  style="width:25%; text-align: center;">
								<!--Insert HP Here-->
							</td>
							<td style="width:25%; text-align: right;">
								lb/ft Torque
							</td>
							<td  id="tq" style="width:25%; text-align: center;">
								<!--Insert TQ Here-->
							</td>
						</tr>
						<!--Second Row-->
						<tr>
							<td style="width:25%; text-align: right;">
								Weight
							</td>
							<td id="weight" style="width:25%; text-align: center;">
							  <!--Insert Weight DIV here-->
							</td>
							<td style="width:25%; text-align: right;">
								Reliability
							</td>
							<td  id="reliability" style="width:25%; text-align: center;">
							  <!--Insert reliability DIV here-->
							</td>
						</tr>
						<!--Third Row-->
						<tr>
							<td style="width:25%; text-align: right;">
								Cost
							</td>
							<td id="msrp" style="width:25%; text-align: center; color: #ff6e5e;">
							  <!--Insert Cost DIV here-->
							</td>
							<td colspan="2" style="width:175px; text-align: center;">
								<button id="buyNow" data-id="0" data-storeid ="0" style="color: #ff6e5e; font-family: rootbear; font-size: 28px; width: 125px; height: 100%; background-color: #E5F8FF; border: 1px solid #000; border-radius: 5px; -webkit-box-shadow: 5px 5px 10px 0px rgba(0,0,0,0.5); -moz-box-shadow: 5px 5px 10px 0px rgba(0,0,0,0.5); box-shadow: 5px 5px 10px 0px rgba(0,0,0,0.5);">Buy Now </button>
							</td>
						</tr>
						<!--Fourth Row-->
						<tr style="display: none; ">
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
// Set the storeID variable
var storeID = "";
// Opens the parts store
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

		// Loop through the parts that was returned
		var count = 1;
		data['parts_available'].forEach(function (part) {
			// Build the Part Type Selection
			part_template =	'<div id="selected_' + count + '" class="select_highlight" style="display: none;"></div>' +
							'<div id="user_car" class="ic_container" data-id="' + count + '" data-type="' + part['pt_type'] + '" data-storeid="' + storeID + '" style="background-color: #fff;">' +
								'<img src="' + data['image_root'] + 'parts-store/' + part['pt_type'] + '-icon.png" height="150px" width="250px"/>' +
							'</div>'+
							'<div id="currentlySelectedID" data-id=""></div>';
			// Add template to HTML
			$("#cs_container").append(part_template);
			count += 1;
		});
	});
});

// Opens part type, and loads the last part availables stats
$("body").on("click", "#user_car", function (e) {
	var partType  = $(this).data("type");
	var storeID = $(this).data("storeid");
	var lastPartID ="";
	// Empty $("#car_container")
	$("#car_container").html("");

	var selectedPart = $(this).data("id");
	var selectedPartHighlighted = $("#currentlySelectedID").data("id");

	//Change which Selected DIV is dsiplayed
	$("#selected_" + selectedPartHighlighted).fadeOut(600);
	$("#selected_" + selectedPart).fadeIn(600);

	//Update the curentlySelctedID DIV with the newly selected ID
	 $("#currentlySelectedID").data("id", selectedPart);

	$.post('app/ajax-controllers/partStoreAjax.php', {
		action: "openPartType",
		store_id: storeID,
		part_type: partType
	}, function (data) {
		$("#car_stats").fadeOut(0);
		data['parts'].forEach(function (part) {
			lastPartID = part['pt_id'];
			partListHTML = 	'<div id="partContainer" data-id="' + part['pt_id'] + '" data-storeid="' + storeID + '" style="cursor: pointer;">'+
								'<div id="partName" class="fadeOut" style="font-family: rootbear; font-size: 32px; background-color: rgba(0, 0, 0, .8); color: #fff; width: 100%; margin: 15px auto; border-radius: 5px; -webkit-box-shadow: 5px 9px 25px 0px rgba(0,0,0,0.75); -moz-box-shadow: 5px 9px 25px 0px rgba(0,0,0,0.75); box-shadow: 5px 9px 25px 0px rgba(0,0,0,0.75);">'+
									'<span class="partSelected_' + part['pt_id'] + '" style="color: #ff6e5e; display: none; font-family: thegun; font-size: 18px;">  >>>  </span>' + part['pt_name'] + '<span class="partSelected_' + part['pt_id'] + '" style="color: #ff6e5e;  display: none; font-family: thegun; font-size: 18px;">  <<<  </span>'+
							'</div>'+
							'<div id="partDescription_' + part['pt_id'] + '" data-id="' + part['pt_id'] + '" style=" display: none; margin: 20px auto; font-family: calibriB; font-size: 18px;">'+
								part['pt_description']+
							'</div></div>'+
							'<div class="currentlySelectedID" data-id="' + part['pt_id'] + '"></div>';

					hp	 =	'<span style="color: ' + setColor(part['pt_hp']) +'">'+
								part['pt_hp']+
							'</span>';

					tq	 =	'<span style="color: ' + setColor(part['pt_tq']) + '">'+
								part['pt_tq']+
							'</span>';
				weight	 =	'<span style="color: ' + setColor(part['pt_weight']) + '">'+
								part['pt_weight']+
							'</span>';
			reliability	 =	'<span style="color: ' + setColor(part['pt_reliability']) + '">'+
								part['pt_reliability']+
							'</span>';
				msrp	 =	'<span style="color: ' + setColor(part['pt_cost']) + '">'+
								'$' + part['pt_msrp']+
							'</span>';
			// Add template to the HTML
			$("#car_container").append(partListHTML);
			$("#hp").html(hp);
			$("#tq").html(tq);
			$("#weight").html(weight);
			$("#reliability").html(reliability);
			$("#msrp").html(msrp);
			// Fade it out
			$(".fadeOut").fadeOut(0);
		});
		//Update the curentlySelctedID DIV with the newly selected ID
		 $(".currentlySelectedID").data("id", lastPartID);
		// Display selected icon
		$(".partSelected_" + lastPartID).fadeIn(600);
		$("#partDescription_" + lastPartID ).fadeIn(600);
		// Add the ID to the Buy Button
		$("#buyNow").data("id", lastPartID);
		$("#buyNow").data("storeid", storeID);
		// Fade it in
		$(".fadeOut").fadeIn(600);
		$("#car_stats").fadeIn(600);
	});
});

// Loads individual parts
$("body").on("click", "#partContainer", function (e) {
	var partID  = $(this).data("id");
	var storeID = $(this).data("storeid");
	var wasSelected = $(".currentlySelectedID").data("id");


	// Send the data to the ajax-controller
	$.post('app/ajax-controllers/partStoreAjax.php', {
		action: "openPart",
		store_id: storeID,
		part_id: partID
	}, function (data) {
		hp	 	=	'<span style="color: ' + setColor(data['part']['pt_hp']) +'">'+
					data['part']['pt_hp']+
				'</span>';

		tq		=	'<span style="color: ' + setColor(data['part']['pt_tq']) + '">'+
					data['part']['pt_tq']+
				'</span>';

		weight	=	'<span style="color: ' + setColor(data['part']['pt_weight']) + '">'+
					data['part']['pt_weight']+
				'</span>';

	reliability	=	'<span style="color: ' + setColor(data['part']['pt_reliability']) + '">'+
					data['part']['pt_reliability']+
				'</span>';

		msrp	=	'<span style="color: ' + setColor(data['part']['pt_cost']) + '">'+
					'$' + data['part']['pt_msrp']+
				'</span>';


		$("#car_stats").fadeOut(200,function (e){
			$("#hp").html(hp);
			$("#tq").html(tq);
			$("#weight").html(weight);
			$("#reliability").html(reliability);
			$("#msrp").html(msrp);
		});
		// Change selected icon
		$(".partSelected_" + wasSelected).fadeOut(600);
		$(".partSelected_" + partID).fadeIn(600);
		$("#partDescription_" + wasSelected ).slideToggle(500);
			$("#partDescription_" + partID ).slideToggle(600);

		$("#car_stats").fadeIn(800);
		$(".currentlySelectedID").data("id", partID);
		$("#buyNow").data("id", partID);
	});


});

// Buys the part
$("body").on("click", "#buyNow", function (e) {
	var partID = $(this).data("id");
	var storeID = $(this).data("storeid");

	// Checks to see if the user wants to install the part now
	if (confirm('Do you want to install the part now?')) {
	   install = 1;
	} else {
	   install = 0;
	}

	$.post('app/ajax-controllers/partStoreAjax.php', {
		action: "buyPart",
		store_id: storeID,
		part_id: partID,
		install: install
	}, function (data) {
		alert(data['bought']);
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

// Returns a #123456 number, Green for positive number, Red for negative
function setColor(number) {
	if(number > 0) color = "#97d079";
	else color = "#ff6e5e";

	return color;
}


</script>

<script src="<?php echo $JS_ROOT; ?>all.js"></script>
</footer>
