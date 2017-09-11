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

				setTimeout(setCSCPadding, 300);
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


						if (car['ct_id'] == 1){
							 var display = "";
							 var scrollTo = '<div id="scrollTO"> </div>';
						}
						else{
							var display = "none";
							var scrollTo = "";
						}


						// Write Template
						car_template =	'<div id="selected_'+ car['ct_id'] +'" class="select_highlight" style="display:' + display + ';"></div>' +
										'<div id="user_car" class="ic_container" data-id="'+ car['ct_id'] +'">' +
											'<img id="uc_img" src="'+ car['thumbnail_url'] +'" width="100%" height="100%" />' +
										'</div>'+
										'<div id="currentlySelectedID" data-id="1"></div>'+scrollTo;
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
				// POST to fetch car
				$.post('app/ajax-controllers/dealerAjax.php', {
					action: "fetchCar",
					car_id: car_id
				}, function (data) {
						// Check for errors
						if (checkErrors(data)) return false;

						// Write Templates
						// only put the steering wheel on cars that are not being driven.
						newDrivingDIV = '<div id="buyNow" class="steeringIcon" style="padding-right: 10px; display: inline-block; border-right: 2px solid black;" data-id="'+ data['car_template']['ct_id'] +'">'+
											'<img src="'+ data['IMAGE_ROOT'] +'street-car-life-select-steeringwheel.png" width="55px" height="55" /><br />'+
											'Buy Now'+
										'</div><br />';

						carCostDIV	  = '<div id="carCost" data-id="'+data['car_template']['ct_id']+'" style=" display: inline-block; ">'+
											'$'+data['car_template']['ct_msrp']+
										'</div>';
						car_container =	newDrivingDIV +
										carCostDIV +
										'<img src="'+ data['IMAGE_ROOT'] +'cars/garage/'+ data['car_template']['ct_photo_folder'] +'/street-car-life-'+
												data['car_template']['ct_year'] +'-'+ data['car_template']['ct_make'] +'-'+ data['car_template']['ct_model'] +'-large-front.png" style="vertical-align: bottom; margin-top: 60px; margin-right: 10%;" width="420px" height="200px"/>';

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

			function setCSCPadding(){
				navi_height = $( "#nav_container" ).height();

				$( "#cs_container" ).css( 'padding-top', navi_height );
			}

			function scrollToCar(){
				//scrolls the page to the selected car.
				const element = document.getElementById('scrollTO');
				const elementRect = element.getBoundingClientRect();
				const absoluteElementTop = elementRect.top + window.pageYOffset;
				const middle = absoluteElementTop - (window.innerHeight / 2);
				window.scrollTo(0, middle);
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
		}());
