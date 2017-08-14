
// If they use the enter button to submit the Buy Part dialogForm
$( "#dialogForm" ).submit(function(e) {
	e.preventDefault();

	var store_name = $("#store_name").val();
	if ( store_name =="" ){
		$( "#dialogError" ).fadeIn(600);
		return;
	}

	buyPartStore( $( "#buyPartStore" ).data( "storeID" ),  $( "#store_name" ).val() );
	$( this ).dialog( "close" );
});


// dialog box
$( function() {
  $( "#buyPartStore" ).dialog({
	autoOpen: false,
	resizable: false,
	height: "auto",
	width: 400,
	modal: true,
	buttons: {
	  "Buy Now": function() {
		var store_name = $("#store_name").val();
		if ( store_name =="" ){
			$( "#dialogError" ).fadeIn(600);
			return;
		}

		buyPartStore( $( "#buyPartStore" ).data( "storeID" ),  $( "#store_name" ).val() );
		$( this ).dialog( "close" );
	  },
	  Cancel: function() {
		$( this ).dialog( "close" );
	  }
	}
  });

  $( "#noPartsAvailable" ).dialog({
	autoOpen: false,
	resizable: false,
	height: "auto",
	width: 400,
	modal: true,
	buttons: {
	  "Ok": function() {
	   $( this ).dialog( "close" );
	  }
  	}
  });

});


//Function to buy parts store by storeID
function buyPartStore(storeID, storeName){
	window.location.href = site_root+"app/views/part-store-cpanel.php?action=buyStore&store_id="+storeID+"&storeName="+storeName;
}

// Opens the parts store
// Set the storeID variable
var storeID = "";
$("body").on("click", "#part_store", function (e) {
	openStore( $(this).data("id") );
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

	$.post(site_root+'app/ajax-controllers/partStoreAjax.php', {
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
	$.post(site_root+'app/ajax-controllers/partStoreAjax.php', {
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

	$.post(site_root+'app/ajax-controllers/partStoreAjax.php', {
		action: "buyPart",
		store_id: storeID,
		part_id: partID,
		install: install
	}, function (data) {
		alert(data['e_msg'] + "; Bought - " + data['bought']);
	});
});


// Open Buy Store dialog
function openBuyStore(storeID){
	// Get the stores cost
	var storeCost = $("#ps_name_"+storeID).data("value");

	$( "#buyPartStore" ).data('storeID', storeID);
	$( "#bps_cost" ).text(storeCost);
	$( "#buyPartStore" ).dialog( "open" );
}

// Function to open the store
function openStore(storeID){

	// POST to changeCar
	$.post(site_root+'app/ajax-controllers/partStoreAjax.php', {
		action: "openStore",
		store_id: storeID
	}, function (data) {
		// Check for errors
		if ( checkErrors(data) ){
			$( "#noPartsAvailable" ).dialog( "open" );
			return false;
	 	}

		// Build the table for the parts_available
		$( "#generic_container" ).animate({	opacity: 0, display: "none", height: "700", width: "90%"}, 600, function() {
			$( "#generic_container" ).css( "display", "none" );
			$( "#partStore" ).fadeIn(600);
		});

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
}
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


// Gets Variables from url
function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}


$( function(){
	if ( getQueryVariable("openStore") == 1){
		openStore( getQueryVariable("storeID") );
	}

});
