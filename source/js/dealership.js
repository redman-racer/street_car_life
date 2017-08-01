$("body").on("click", "#buyNow, #carCost", function (e) {
	var buyID = $(this).data("id");

	$.post('app/ajax-controllers/dealerAjax.php', {
		action: 'buyNow',
		buyID: buyID
		}, function (data) {
			window.location.replace(data['site_root'] + "garage");
		});
	});

		// Garage Javascript Module
		(function () {
			var docReady = 0;
			// When the document is loaded
			$('document').ready(function () {
				var docReady = 1;
				// Fetch the user's cars
				fetchCars(docReady);
			});


			// Function to fetch cars
			function fetchCars(docReady) {
				//If not being called by docReady, empty the cs container
				if(docReady == 0) $('#cs_container').html('');
				else fetchCar(1);
				// POST to fetch cars
				$.post('app/ajax-controllers/dealerAjax.php', {
					action: 'fetchCars'
				}, function (data) {
					// Check for errors
					if (checkErrors(data)) return false;

					// For each car
					data['cars'].forEach(function (car) {
						if (car['ct_id'] == 1) var display = "";
						else var display = "none";
						// Write Template
						car_template =	'<div id="selected_'+ car['ct_id'] +'" class="select_highlight" style="display:' + display + ';"></div>' +
										'<div id="user_car" class="ic_container" data-id="'+ car['ct_id'] +'">' +
											'<img src="'+ car['thumbnail_url'] +'" />' +
										'</div>'+
										'<div id="currentlySelectedID" data-id="1"></div>';
						// Add template to HTML
						$("#cs_container").append(car_template);
					});
				});
			}


			// Function to fetch individual car data
			function fetchCar(car_id){
				// POST to fetch car
				$.post('app/ajax-controllers/dealerAjax.php', {
					action: "fetchCar",
					car_id: car_id
				}, function (data) {
						// Check for errors
						if (checkErrors(data)) return false;

						// Write Templates
						// only put the steering wheel on cars that are not being driven.
						newDrivingDIV = '<div id="buyNow" class="steeringIcon" style="padding-right: 10px; border-right: 2px solid black;" data-id="'+ data['car_template']['ct_id'] +'">'+
											'<img src="'+ data['IMAGE_ROOT'] +'street-car-life-select-steeringwheel.png" width="55px" height="55" /><br />'+
											'Buy Now'+
										'</div><br />';

						carCostDIV	  = '<div id="carCost" data-id="'+data['car_template']['ct_id']+'">'+
											'$'+data['car_template']['ct_msrp']+
										'</div>';
						car_container =	newDrivingDIV +
										carCostDIV +
										'<img src="'+ data['IMAGE_ROOT'] +'cars/garage/'+ data['car_template']['ct_photo_folder'] +'/street-car-life-'+
												data['car_template']['ct_year'] +'-'+ data['car_template']['ct_make'] +'-'+ data['car_template']['ct_model'] +'-large-front.png" width="420px" height="200px"/>';

						car_handling =  '<div style="width:'+ data['car_template']['ct_handling']/10 +'%; height: 100%; background-color: #fff;  border-radius: 5px;  color: #ff6e5e;">'+
											data['car_template']['ct_handling']+
										'</div>';

						car_braking  =  '<div style="width:'+ data['car_template']['ct_braking']/10 +'%; height: 100%; background-color: #fff;  border-radius: 5px;  color: #ff6e5e;">'+
											data['car_template']['ct_handling']+
										'</div>';

						// Add template to HTML
						$("#car_container").html(car_container);
						$("#hp").html(data['car_template']['ct_hp']);
						$("#tq").html(data['car_template']['ct_tq']);
						$("#handling").html(car_handling);
						$("#braking").html(car_braking);
				});
			}



			//Loads the selected cars stats when the car is selected
			$("body").on("click", "#user_car", function (e) {
				var selectedCarID = $(this).data("id");
				var selectedCarHighlight = $("#currentlySelectedID").data("id");

				//Change which Selected DIV is dsiplayed
				$("#selected_" + selectedCarHighlight).fadeOut(400);
				$("#selected_" + selectedCarID).fadeIn(400);

				//Update the curentlySelctedID DIV with the newly selected ID
				 $("#currentlySelectedID").data("id", selectedCarID);

				//Changes the displayed fetchCar - car stats displayed in the right
				fetchCar(selectedCarID);
			});
		}());
