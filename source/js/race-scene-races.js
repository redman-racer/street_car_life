var race_started = false; var lightsOn = false; var engOn = false; var holdRPMActive = true; var needleActive = false;
var race_id; var tree_initiated_time; var redLight; var et; var trap; var estimateET; var estimateMPH;
$('document').ready(function () {

		rotateTach(0, 10);
		rotateSpeedo(0, 10);
		speedoActive = true;
		$("#speedoNumber").text(0);
});

$( "#time_sheet" ).dialog({
		show: {
		  effect: "bounce",
		  duration: 400
		},
		hide: {
		  effect: "fold",
		  duration: 200
	  },
		autoOpen: false,
		width: "auto",
		height: "auto",
		modal: true,
		buttons: {
				Close: function() {
				  $( "#time_sheet" ).dialog( "close" );
				}
		},
		close: function() {
			$( "#race_number" ).html("");
			$( "#ll_rt").html("");
			$( "#rl_rt").html("");
			$( "#ll_sixty").html("");
			$( "#rl_sixty").html("");
			$( "#ll_eighth").html("");
			$( "#rl_eighth").html("");
			$( "#ll_quarter").html("");
			$( "#rl_quarter").html("");
			$( "#ll_mph").html("");
			$( "#rl_mph").html("");
			$( "#ll_winner_margin").html("");
			$( "#rl_winner_margin").html("");
			$( "#ll_winner").html("");
			$( "#rl_winner").html("");
		}
	});
/**
 * @return
 * Set the engineOn var to on and animate the needle.
 */
function startRaceAnimation(){
	var launchRPM = $( "#launch_rpm" ).val();
		if(launchRPM > 6500) launchRPM = 6500;
		if(launchRPM < 800) launchRPM = 800;
	//Bring the light container in
	$( "#startLights" ).fadeIn(0);
	startEng();
	setTimeout( function(){
		holdRPMActive = false;
		rotateTach(launchRPM, 600, "startRaceAnimation");
	}, 3000 );
	setTimeout( function(){
		needleActive = true;
		holdRPMActive = true;
		holdRPM(launchRPM);
	}, 3600 );
	$( "#startLights" ).css("margin-left", "130px");
	$( "#gasPedal, #start_lights_container, #gasPedal" ).fadeIn(600);
	$( "#ui_menu_container, #nav_container" ).fadeOut(600);
	$( "#light1, #light2, #light3").css("background-color", "#ffff00");

	$( "#light1, #light2, #light3" ).delay(1400).fadeIn(300 );
	$( "#light1, #light2, #light3" ).fadeOut( 600 );
	$( "#light1, #light2, #light3" ).fadeIn( 300 );
	$( "#light1, #light2, #light3" ).fadeOut( 600 );
	$( "#light1, #light2, #light3" ).fadeIn( 300 );
	$( "#light1, #light2" ).delay(300).fadeOut( 300 );
	$( "#light3" ).delay(300).fadeOut( 300, function(){
		var max = 3500; min = 600;
		var randomWaitTime = Math.random() * (max - min) + min;

		setTimeout( function(){
			startTree();
			tree_initiated_time = Date.now();
		}, randomWaitTime);
	});
	return true;
}

$( "body" ).on("click", "#gasPedal", function(){
		playerRT = ( Date.now() - tree_initiated_time ) - 1500;

		if(playerRT < 0){
			redLight = true;
		}else redLight = false;
		startRace(playerRT, launchRPM);

		$( this ).fadeOut(600, function(){
			$( "#startLights" ).css("margin-left", "696px");
		});

		return true;
});


function startTree(){
	launchRPM = 4000;
	$( "#light1" ).fadeIn( 100 );
	$( "#light2" ).delay(400).fadeIn( 100 );
	$( "#light3" ).delay(900).fadeIn( 100 );

	// Set the light to green or red
	setTimeout(function(){
		if( !redLight ){
			$( "#light1, #light2, #light3").css("background-color", "#009933");
		}else if( redLight ){
			$( "#light1, #light2, #light3").css("background-color", "red");
		}
	}, 1500);

	return true;
}


/**
 * @return bool
 * Set the engineOn var to on and animate the needle.
 */
function startEng(){
	// Check to see if the tach needle is currently active.
	if(needleActive === true){
		alert("Please wait for the current animation to finish first.");
		return false;
	}
	// Check to see if engine is on already
	if(engOn === true){
		return true;
	}

	// Turn engine on
	engOn = true;

	// Turn lights on
	lights(true);

	// Start Needle Animations
		setTimeout( function(){
			needleActive = true;
			rotateTach(2200, 400, "startEng");
		}, 600 );
		setTimeout( function(){
			needleActive = true;
			rotateTach(2000, 200, "startEng");
		}, 1000 );
		setTimeout( function(){
			needleActive = true;
			rotateTach(800, 1250, "startEng");
		}, 1250 );
		setTimeout( function(){
			holdRPMActive = true;
			holdRPM(800);
		}, 2500 );
	return true;
}

/**
 * @param playerRT
 * @param launchRPM
 * @return bool
 * Animate the holding position of the tach needle
 */
function startRace(playerRT, launchRPM){
	race_started = true;
	playerRT = playerRT/1000;
	$.post(site_root+'app/ajax-controllers/raceAjax.php', {
		action: "recordRace",
		player_rt: playerRT,
		race_id: race_id
	}, function (data) {
		if( data['error'] === true ){
			dialogError("time_sheet", data['e_msg'], "Fail");
			return false;
		} else if ( data['error'] === false ){
			dialogError("time_sheet", "There were no broken parts, <br />you did not wreck the car, <br />and the cops did not bust you.", "Pass");
				// Start filling out the time sheet.
				if( data['spin_amount'] >= .05 ){
					// Activaet the TCS Light
					tcsLight(true);
				}
				var rt1 = data['race_stats']['race_d1_rt'];
				var rt2 = data['race_stats']['race_d2_rt'];
				var et1 = data['race_stats']['race_d1_et'];
				var et2 = data['race_stats']['race_d2_et'];
				var spinAMT = Math.round(data['spin_amount'] * 100);
				var rtet1 = Number(rt1) + Number(et1);
				var rtet2 = Number(rt2) + Number(et2);

				var difference1  = rtet1 - rtet2;
				var difference2  = rtet2 - rtet1;

				console.log(data);

				if( data['race_stats']['race_driver_one'] == data['race_stats']['race_winner'] ){
					var winner = "ll_winner";
				}
				if( data['race_stats']['race_driver_two'] == data['race_stats']['race_winner'] ){
					var winner = "rl_winner";
				}
				if( et2 !== null ){
					$( "#ll_winner_margin").html(difference1.toFixed(3));
					$( "#rl_winner_margin").html(difference2.toFixed(3));
					$( "#" + winner).html("<h5>Winner!</h5>");
				}
				$( "#race_number" ).html(race_id);

				userIDtUsername(data['race_stats']['race_driver_one'], "ll_driver");
				userIDtUsername(data['race_stats']['race_driver_two'], "rl_driver");
				$( "#ll_spin_amt").html("%"+spinAMT);
				$( "#ll_rt").html(data['race_stats']['race_d1_rt']);
				$( "#rl_rt").html(data['race_stats']['race_d2_rt']);
				$( "#ll_sixty").html(data['race_stats']['race_d1_sixty']);
				$( "#rl_sixty").html(data['race_stats']['race_d2_sixty']);
				$( "#ll_eighth").html(data['race_stats']['race_d1_eighth']);
				$( "#rl_eighth").html(data['race_stats']['race_d2_eighth']);
				$( "#ll_quarter").html(data['race_stats']['race_d1_et']);
				$( "#rl_quarter").html(data['race_stats']['race_d2_et']);
				$( "#ll_mph").html(data['race_stats']['race_d1_trap']);
				$( "#rl_mph").html(data['race_stats']['race_d2_trap']);
				$( "#bet_amount" ).html("$" + data['race_stats']['race_bet_amount'])
			return true;
		}
	});

		// Find the RPM to drop the needle to on launch
		dropRPM = launchRPM * .5; if (dropRPM <= 750) dropRPM = 800;

			// Find the duration of the race in miliseconds
			estimateET   = (estimateET * 1000) - 400;


			// Set the length of the individual gear animations
			firstLength  = Math.round(Number(estimateET * 0.23)); // first gear is 23% of the race
			secondLength = Math.round(Number(estimateET * 0.35));
			thirdLength  = Math.round(Number(estimateET * 0.42));
			time1        = 200 + firstLength;
			time2        = 200 + firstLength + 200;
			time3        = 200 + firstLength + 200 + secondLength;
			time4        = 200 + firstLength + 200 + secondLength + 200;
			time5        = 200 + firstLength + 200 + secondLength + 200 + thirdLength;
			time6        = 200 + firstLength + 200 + secondLength + 200 + thirdLength + 2500;

			// Start the race animation sequence

			// Rotate the Speedo
			rotateSpeedo(estimateMPH, estimateET);

			// Turn the idle of, if its on (holdRPMActive = false), and set the needleActive to on(true), and rotate the tach.
			holdRPMActive = false; needleActive = true;
			rotateTach(dropRPM, 200, "startRace");

			// First gear - T=200
			setTimeout( function(){
				needleActive = true;
				rotateTach(7600, firstLength, "startRace");
			}, 200 );

			// Second gear shift - T=200+firstLength
			setTimeout( function(){
				needleActive = true;
				rotateTach(4500, 200, "startRace");
				$("#gearNumber").text(2);
			}, time1 );

			// Second gear - T=200+firstLength+200
			setTimeout( function(){
				needleActive = true;
				rotateTach(7500, secondLength, "startRace");
			}, time2 );

			// Third gear shift - T =200+firstLength+200+secondLength
			setTimeout( function(){
				needleActive = true;
				rotateTach(4800, 200, "startRace");
				$("#gearNumber").text(3);
				tcsLight();
			}, time3 );

			// Third Gear - T =200+firstLength+200+secondLength+200
			setTimeout( function(){
				needleActive = true;
				rotateTach(7300, thirdLength, "startRace");
			}, time4 );

			// Slow Down - T =200+firstLength+200+secondLength+200+thirdLength
			setTimeout( function(){
				needleActive = true;
				race_started = false;
				rotateTach(800, 2500, "startRace");
				rotateSpeedo(0, 2500);
				$("#nav_container, #ui_menu_container").delay(600).fadeIn(600);
				$("#time_sheet").delay(1500).dialog( "open" );
				$("#light1, #light2, #light3, #gasPedal").delay(600).fadeOut(600);
			}, time5 );

			// Start Idle - T =200+firstLength+200+secondLength+200+thirdLength+2500
			setTimeout( function(){
				holdRPMActive = true;
				holdRPM(800);
				$("#gearNumber").text('N');
			}, time6 );

			return true;
}

/**
 * @param rpm
 * @return bool
 * Animate the holding position of the tach needle
 ***ATTENTION holdRPMActive Must be set to true when the function is called**
 */
function holdRPM(rpm){
	////////////////holdRPM() function info////////////////
	/*				IDLE and holdRPM   					*/
	/*		Animates the RPM needle during idle & 		*/
	/*	situations that need the RPM held in one place	*/
	/*			like, when launching.				  	*/
	/*													*/
	/*		Pass the desired RPM that you want to hold	*/
	/*	IDLE speed is 1500 RPM or less, i like to use	*/
	/*			800rpm as an idle speed.				*/
	/*													*/
	/*			*********ATTENTION*******				*/
	/*		 $holdRPMActive MUST be set to true when 	*/
	/* the function is called, or loop will not initate.*/
	//////////////////////////////////////////////////////
		// Set the bounceAMT var, to the amount of RPM's the needle should bounce back and forth bewteen.
		if (rpm >= 1500){
			// If RPM is greater than 1500 RPM, bounce a litte more.
			bounceAMT = 150;
		 // Else bounce a small amount for Idle
		} else bounceAMT = 30;

		// The bounceRPM is the lower RPM number that the needle will move to in the idle or holdRPM animation
		bounceRPM = rpm-bounceAMT;
		// bounceActive is the var that determines if we use the bounceRPM or the requested RPM; (requested RPM = var rpm)
		bounceActive = false;

		// /*Call the idle function, it will be called indefinitely by seetTimeout fucntions inside the idle function, to create a setTimeout Loop*/
		idle(bounceActive);

	/**
	 * @param bounceActive
	 * @return bool
	 * Function that sends the command to change the RPM call. if bounceActive is true, it sends the bounceRPM, else it sends rpm
	 * Is called internally by a setTimeout Loop(100) that is canceled by holdRPMActive === false;
	 */
	// Function that sends the command to change the RPM call.
	function idle(bounceActive){
		// Check to see if we are still holding the rpm, else return false;
		if( holdRPMActive === true){

			if( bounceActive ){
				// Make the call to move the RPM needle to the var bounceRPM
				rotateTach(bounceRPM, 95, "holdRPM");
				bounceActive = false;
			} else {
				// Make the call to move the RPM needle to the var rpm
				rotateTach(rpm, 95, "holdRPM");
				bounceActive = true;
			}

			// Initiate the loop.
			setTimeout( function(){
				idle(bounceActive);
			}, 100 );

			return true;

		} else return false;
	}

	return true;
}

/**
 * @param mode
 * @return bool
 * Turn the lights on or off, pass true = on or false = off (optional)
 */
function lights(mode){
	// Check to see if lights on was requested
	if(typeof mode !== null){
		// A mode was requested (on/off), true = on, false = off;
			if( mode === true ){
				if(lightsOn === false) lightsOnn();

				return true;
			}
			if( mode === false ){
				if(lightsOn === true) ylightsOff();

				return true;
			}
	}else{
		// No mode was requested, get the current status of the lights On;
		if( lightsOn === true ){
			// lights are turned on, so lets turn them off.
				lightsOff();
			return true;
		}
		if( lightsOn === false ){
			// turn lights on.
				lightsOnn();
			return true;
		}
	}

	function lightsOnn(){
		$('#tach-container').fadeTo('slow', 0.2, function()
		{
			$(this).css("background-image", "url("+image_root+"race/race-scene/race_scene_background_lights_on2.jpg)");
			$('#tach_needle_img').css("opacity", 1);
			$('#speedo_needle_img').css("opacity", 1);
			$('#speedDisplay').fadeIn(200);
			$('#gearDisplay').fadeIn(200);
			lightsOn = true;
		}).fadeTo('slow', 1);

		lightsOn = true;
		return true;
	}

	function lightsOff(){
		$('#tach-container').fadeTo('slow', 0.2, function()
		{
			$(this).css("background-image", "url("+image_root+"race/race-scene/race_scene_background_lights_off.jpg)");
			$('#tach_needle_img').css("opacity", .20);
			$('#speedo_needle_img').css("opacity", .10);
			$('#speedDisplay').fadeOut(200);
			$('#gearDisplay').fadeOut(200);
			lightsOn = false;
		}).fadeTo('slow', 1);

		lightsOn = false;
		return true;
	}

	// For some reason the funciton did not return prior to this, so return false as an error
	return false;
}

/**
 * @param rpm
 * @param duration
 * @return bool
 * Rotates that tach needle to the desired rpm, over the desired duration.
 */
function rotateTach(rpm, duration, id){
		// Set the start angle of the animation
		startAng = $("#tach_needle_img").getRotateAngle();

		// Divide RPM to get a 0-7, multiply by 30* of rotation, and subtract 30* for the offset.
		endAng   = ((rpm/1000)*30)-30;


		// Check to see if we are calling for the needle to be held in place(launch or idle)
		if(holdRPMActive === false){
			// needleActive = true = Needle is currently being animated
			needleActive = true;
		}
		if(holdRPMActive === true){
			// We are currently idling or holding a rpm so the needle is not active and can be animated.
			 needleActive = false;
		}

		// Rotate the tach needle
		$("#tach_needle_img").rotate({
			  angle:startAng,
			  duration:duration,
			  easing: $.easing.easeInQuad,
			  animateTo:endAng,
			  callback: function(){ needleActive = false; }
		  });

		return true;
}

/**
 * @param tce
 * @return bool
 * Flashes the tcs Light, either on or off depending on tcs
 */
function tcsLight(tcs){
	if(tcs){
		//Turn the lights on
		$("#tcsLight").fadeIn(200, function(e){
			$("#tcsLight").fadeOut(300, function(e){
				$("#tcsLight").fadeIn(200, function(e){
					$("#tcsLight").fadeOut(300, function(e){
						$("#tcsLight").fadeIn(200);
					});
				});
			});
		});
		return true;
	} else{
		//Turn the ligths off
		$("#tcsLight").fadeOut(300);
		return false;
	}
}

/**
 * @param cel
 * @return bool
 * Flashes the celLight, either on or off depending on cel
 */
function celLight(cel){
	if(cel){
		//Turn the lights on
		$("#celLight").fadeIn(200, function(e){
			$("#celLight").fadeOut(300, function(e){
				$("#celLight").fadeIn(200, function(e){
					$("#celLight").fadeOut(300, function(e){
						$("#celLight").fadeIn(200);
					});
				});
			});
		});
		return true;
	} else{
		//Turn the ligths off
		$("#celLight").fadeOut(300);
		return false;
	}
}

/**
 * @param mph
 * @param duration
 * @return bool
 * Rotates that speedo needle to the desired mph, over the desired duration
 */
function rotateSpeedo(mph, durationS){
	startSAng = $("#speedo_needle_img").getRotateAngle();
	// mph - offset of 90*
	endSAng   = mph-90;
	// Speedo Limit angle
	angLimit  = 116;
	// Limiting the amount of rotation
	speedoLimiter = true;

	// If the end angle is greater than the anglimit, make the endanlge = to the limit angle
	if(endSAng >= angLimit){
		endSAng = angLimit;
	}

	//Initiate the speedo needle travel limiter
	speedoTravelLimit();

	// Rotate the Speedo Needle.
	$("#speedo_needle_img").rotate({
		  angle:startSAng,
		  duration:durationS,
		  easing: $.easing.easeOutQuad,
		  animateTo:endSAng,
		  callback: function(){ changeActiveNeedleSStatus(); }
	  });

	  	// Function loops on a setTimeout, and is  canceld by var speedoLimiter === false;
		function speedoTravelLimit(angLimit){
			// If speedLimiter is turned off, stop  the function and loop.
			if( speedoLimiter === false){
				return false;
			}


		  // Get the current angle of the speedo needle
		  currentSpeedoAng = $("#speedo_needle_img").getRotateAngle();
		  // Set the current MPH from the ANLGE
		  currentMPH  = Math.round(Number(currentSpeedoAng) + 90);
		  // Update Digital MPH display
  		  $("#speedoNumber").text(currentMPH);

		  // IF the current speedo needle angle is passed the limit, stop the animation and loop (speedoLimiter = false stops loop)
		  if(currentSpeedoAng >= angLimit){
			  // Stop the animation
			  $("#speedo_needle_img").stopRotate();
			  // Stop the loop
			  speedoLimiter = false;
			  //Stop the function, the speedo is at its max angle.
			  return true;
		  }

		  // The speedo needle is not at its max angle yet, recheck again in 50 miliseconds
		  setTimeout( function(){
			  speedoTravelLimit(angLimit);
		  }, 50 );

		  // Return false, as the speedoTravelLimit has not been met yet.
		  return false;
		}

		// Function is called at the end of the current rotate animation, it sets the speedoActive to false, and the speedoLimiter to false
		function changeActiveNeedleSStatus(){
			   speedoActive = false;
			   speedoLimiter = false;
		  return true;
		}

	return true;
}
