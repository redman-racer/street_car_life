
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
										'<img src="'+ car['thumbnail_url'] +'" />' +
										 driving_e +
									'</div>'+
									currentlySelectedDiv;
					// Add template to HTML
					$("#cs_container").append(car_template);
				});

				//scrolls the page to the selected car.
				const element = document.getElementById('drivingScroll');
				const elementRect = element.getBoundingClientRect();
				const absoluteElementTop = elementRect.top + window.pageYOffset;
				const middle = absoluteElementTop - (window.innerHeight / 2);
				window.scrollTo(0, middle);
			});
		}


		// Function to fetch individual car data
		function fetchCar(car_id){
			// POST to fetch car
			$.post('app/ajax-controllers/garageAjax.php', {
				action: "fetchCar",
				car_id: car_id
			}, function (data) {
					// Check for errors
					if (checkErrors(data)) return false;

					// Write Templates
						// only put the steering wheel on cars that are not being driven.
					if(data['car']['cars_driving'] == 1){
						newDrivingDIV = '';
					}else{
						newDrivingDIV = '<div id="newDriving" data-id="'+ data['car']['cars_id'] +'">'+
											'<img src="'+ data['IMAGE_ROOT'] +'street-car-life-select-steeringwheel.png" width="55px" height="55" /><br />'+
											'Start Driving'+
										'</div><br />'}


					car_container =	newDrivingDIV +
									'<img src="'+ data['IMAGE_ROOT'] +'cars/garage/'+ data['car_template']['ct_photo_folder'] +'/street-car-life-'+
											data['car_template']['ct_year'] +'-'+ data['car_template']['ct_make'] +'-'+ data['car_template']['ct_model'] +'-large-front.png" width="420px" height="200px"/>';

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