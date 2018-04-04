	var docReady = 0;
	// Garage Javascript Module
	(function () {

		// When the document is loaded
		$('document').ready(function () {
			var docReady = 1;
			// Fetch the user's cars
			fetchCars(docReady);

			setTimeout(setCSCPadding, 300);
		});


		// Function to fetch cars
		function fetchCars(docReady) {
			//If not being called by docReady, empty the cs container
			if(docReady == 0) $('#cs_container').html('');

			// POST to fetch cars
			$.post('app/ajax-controllers/garageAjax.php', {
				action: 'fetchCars'
			}, function (data) {
				// Check for errors
				if (checkErrors(data)) return false;

				// For each car
				data['cars'].forEach(function (car) {
					if(docReady == 1 && car['cars_driving'] == 1) fetchCar(car['cars_id']);

					//if they are driving car, display as selected
					if (car['cars_driving'] == 1){
						// currently selected car div
						csc_div	= '';
						//user_car div class
						ucd_class  = 'ic_container_driving';
						//driving element that goes on top of the image of the car
						driving_e  = '<driving id="driving" data-id="'+ car['cars_id'] +'">DRIVING</driving><div id="drivingScroll"></div>';
						//Set the currently selected DIV value holder
						currentlySelectedDiv = '<div id="currentlySelectedID" data-id="'+ car['cars_id'] +'"></div>';
					 } else{
						// currently selected car div
						csc_div = 'display: none;';
						//user_car div class
						ucd_class  = 'ic_container';
						//driving element that goes on top of the image of the car
						driving_e  = '<driving id="driving" data-id="'+ car['cars_id'] +'" style="display: none;">DRIVING</driving>';
						//Set the currently selected DIV value holder
						currentlySelectedDiv = '';
					 }
					// Write Template
					car_template =	'<div id="selected_'+ car['cars_id'] +'" class="select_highlight" style="'+ csc_div +'"></div>' +
									'<div id="user_car" class="'+ ucd_class +'" data-id="'+ car['cars_id'] +'">' +
										'<img id="uc_img" src="'+ car['thumbnail_url'].toLowerCase() +'" />' +
										 driving_e +
									'</div>'+
									currentlySelectedDiv;
					// Add template to HTML
					$("#cs_container").append(car_template);
				});
				// Change the selected highlight height
				setTimeout(function() { changeSelectHeight(); }, 300);

				// Scroll to the selected car
				setTimeout(function() { scrollToCar(); }, 300);
			});
		}

		// Function to fetch individual car data
		function fetchCar(car_id){
			var parts_list = '';

			// POST to fetch car
			$.post('app/ajax-controllers/garageAjax.php', {
				action: "fetchCar",
				car_id: car_id
			}, function (data) {

					// Check for errors
					if (checkErrors(data)) return false;

					data['car_parts'].forEach(function (car_part) {
						// Build Car Part Div var
						var part_hp = Math.round(car_part['part_hp'] * data['car']['cars_eng_liter']);
						var part_tq = Math.round(car_part['part_tq'] * data['car']['cars_eng_liter']);


						parts_list = parts_list +
									'<table id="' + car_part['part_id'] + '" style="width: 100%; text-align: center;">'+
										'<tr>'+
											'<td id="part_id" style="font-size: .5em; color: #fff; padding-right: .5em; width: 7%;">ID: ' + car_part['part_id'] + ' <br ?><h2 class="remove_part" data-id="' + car_part['part_id'] + '" data-car_id="' + car_part['part_car_id'] + '" style="cursor: pointer;">REMOVE</h2> </td>'+
											'<td id="part_sub_type" style="color: #fff; padding-right: 1em; width: 25%;"><h3>' + car_part['part_sub_type'] + '</h3></td>'+
							 				'<td id="part_hp" style="color: #fff; padding-right: 1em; width: 16%;">HP: ' + part_hp + '</td>'+
							 				'<td id="part_tq" style="color: #fff; padding-right: 1em; width: 16%;">TQ: ' + car_part['part_tq'] + '</td>'+
							 				'<td id="part_weight" style="color: #fff; padding-right: 1em; width: 16%;">Weight: ' + car_part['part_weight'] + '</td>'+
							 				'<td id="part_damage" style="color: #fff; padding-right: 1em; width: 16%;">Damage: ' + car_part['part_damage'] + '%</td>'+
										'</tr>'+
									'</table><br />';

					});

					// Write Templates
						// only put the steering wheel on cars that are not being driven.
					if(data['car']['cars_driving'] == 1){
						newDrivingDIV = '';
					}else{
						newDrivingDIV = '<div id="newDriving" class="steeringIcon"  data-id="'+ data['car']['cars_id'] +'">'+
											'<img src="'+ data['IMAGE_ROOT'] +'street-car-life-select-steeringwheel.png" width="55px" height="55" /><br />'+
											'Start Driving'+
										'</div>'}


					car_container =	newDrivingDIV +
									'<img src="'+ data['IMAGE_ROOT'] +'cars/garage/'+ data['car_template']['ct_photo_folder'].toLowerCase() +'/street-car-life-'+
											data['car_template']['ct_year'] +'-'+ data['car_template']['ct_make'].toLowerCase() +'-'+ data['car_template']['ct_model'].toLowerCase() +'-large-front.png" style="vertical-align: bottom; position: relative; margin-right: 3%;" width="400px" height="200px"/>';

					car_handling =  '<div style="width:'+ data['car']['cars_handling']/10 +'%; height: 100%; background-color: #fff;  border-radius: 5px;  color: #ff6e5e;">'+
										data['car']['cars_handling']+
									'</div>';

					car_braking  =  '<div style="width:'+ data['car']['cars_braking']/10 +'%; height: 100%; background-color: #fff;  border-radius: 5px;  color: #ff6e5e;">'+
										data['car']['cars_handling']+
									'</div>';


					// Add template to HTML
					$("#car_container").html(car_container);
					$("#hp").html(data['car']['cars_hp']);
					$("#tq").html(data['car']['cars_tq']);
					$("#weight").html(data['car']['cars_weight']);
					$("#traction").html(data['car']['cars_traction']);
					$("#reliability").html(data['car']['cars_reliability']);
					$("#handling").html(car_handling);
					$("#braking").html(car_braking);
					$("#parts_list").html(parts_list);
			});
		}

		function changeSelectHeight(){
			var img_height = $( "#uc_img" ).height() + 25;

			if ( img_height == "0" ){
				setTimeout(function() { changeSelectHeight(); }, 300);
				return;
			}

			$( ".select_highlight" ).height(img_height);
			return;
		}

		function scrollToCar(){
			//scrolls the page to the selected car.
			const element = document.getElementById('drivingScroll');
			const elementRect = element.getBoundingClientRect();
			const absoluteElementTop = elementRect.top + window.pageYOffset;
			const middle = absoluteElementTop - (window.innerHeight / 2);
			window.scrollTo(0, middle);
		}

		function setCSCPadding(){
			navi_height = $( "#nav_container" ).height();

			$( "#cs_container" ).css( 'padding-top', navi_height );
		}

		function removePart(part_id, car_id){
			// POST to fetch car
			$.post('app/ajax-controllers/garageAjax.php', {
					action: "removePart",
					part_id: part_id
				}, function (data) {
						// Check for errors
						if (checkErrors(data)) return false;

						if (data['removedPart']){ alert("The part has been removed."); fetchCar(car_id)}
						else alert("Error");
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

			changeSelectHeight();
		});


		// Change Driving - Function to change the car the user is currently driving
		$("body").on("click", "#newDriving", function (e) {
			var newDrivingID = $(this).data("id");
			$(this).fadeOut(300);
			// POST to changeCar
			$.post('app/ajax-controllers/garageAjax.php', {
				action: "changeCar",
				car_id: newDrivingID
			}, function (data) {
				// Check for errors
				if (checkErrors(data)) return false;

				// Check for success
				if(!data['changedCar']) return false;

				fetchCars(docReady);
			});
		});

		$("body").on("click", ".remove_part", function (e) {
			removePart($( this ).data("id"), $( this ).data("car_id"));
		})

		// Function to check for errors
		function checkErrors(data) {
			if (data['error'] !== false) {
				console.log(data['error']);
				return true;
			} else {
				return false;
			}
		}
	}());
