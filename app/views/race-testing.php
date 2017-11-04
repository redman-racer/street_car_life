<?php
require '../config/globals.php';
?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
<div id="speedo_lights_out"
	style="
			width:940px;
			height:505px;
			display: table-cell;
			vertical-align: bottom;
			background: url(<?php echo $IMAGE_ROOT; ?>race/tachometer-web-base-lights-out.jpg);">
	<div id="speedo-container"
		style="
				width:940px;
				height: 505px;
				display: table-cell;
				overflow: hidden;
				vertical-align: bottom;
			">
		<div id="speedo-needle"
			style="
					margin-left: 79px;
					display: inline-block;
					float: left;
					width: 783px;
					height: 180px;
					margin-top: 15px;
				"><img src="<?php echo $IMAGE_ROOT; ?>race/tachometer-web-needle.png"  id="spedo_needle_img" width="783px" height="180px" style="margin-top:35px; opacity: 0.35;"/><!-- Center is 390px X 80px; -->
		</div>
		<div id="speedo_bottom"
			style="
					z-index: 1000;
					float: left;
					position: absolute;
					top: 0px;
					width:940px;
					height: 505px;
					background: url(<?php echo $IMAGE_ROOT; ?>race/tachometer-bottom.png);
				">
		</div>
	</div>
</div>
<div id="button_container" style="width:940px; height:200px;">
	<button id="lights">Turn Lights On</button>
	<button id="start">Turn Engine On</button>
	<button id="rev">Rev the Engine</button>
	<button id="launch">Check Launch RPM</button>
	<button id="race">Start Race</button>
	<button id="idle">Idle</button>
	<button id="off">Off</button>
	<input type="number" id="launchRPM" placeholder="Set Launch RPM" />
</div>
<div id="start_lights_container"
 	style="
										width:940px;
										height:200px;
										width: auto;
										float: right;
										position: absolute;
										top: 100px;
										left: 1000px;">
	<button id="launchRaceButton" style="width: 125px; height: 125px; border-radius: 125px; background: darkgreen; font-weight: bold; color: white; font-size: 50px; display: none;">GO</button>
	<div id="tree_container" style="width: 100%; height: 300px; background: #fff; border-radius: 3px; padding-top: 20px;">
		<div id="stage1" style="background-color: orange; width: 60px; height: 60px; border: 1px solid #000; border-radius: 30px; margin: 5px auto; display: none;"> </div>
		<div id="stage2" style="background-color: orange; width: 60px; height: 60px; border: 1px solid #000; border-radius: 30px; margin: 5px auto; display: none;"> </div>
		<div id="amber_1" style="background-color: yellow; width: 30px; height: 30px; border: 1px solid #000; border-radius: 30px; margin: 5px auto; display: none;"> </div>
		<div id="amber_2" style="background-color: yellow; width: 30px; height: 30px; border: 1px solid #000; border-radius: 30px; margin: 5px auto; display: none;"> </div>
		<div id="amber_3" style="background-color: yellow; width: 30px; height: 30px; border: 1px solid #000; border-radius: 30px; margin: 5px auto; display: none;"> </div>
		<div id="green" style="background-color: green; width: 30px; height: 30px; border: 1px solid #000; border-radius: 30px; margin: 5px auto; display: none;"> </div>
		<div id="red" style="background-color: red; width: 30px; height: 30px; border: 1px solid #000; border-radius: 30px; margin: 5px auto; display: none;"> </div>
	</div>
</div>

</body>
<footer>
<script src="<?php echo $JS_ROOT; ?>all.js"></script>
<script>
<<<<<<< HEAD
var lightsOn = false; var engOn = false; var holdRPMActive = false; var needleActive = false; var greenLightOnTime = Date.now() * 1000;

$("#lights").on( "click", function() {
	if( lightsOn === true){
			turnLightsOff();
		return;
	}

	turnLightsOn();
});
=======
    // Set the lights off by default
    var lightsOn = false;
    // Set the engine off by default
    var engOn = false;
    // Set Engine Idling off by default
    var holdRPMActive = false;
    // Check if the needle is currently moving
    var needleActive = false;

    // Reference Body
    body = $("body");

    // When the "Switch light" button is clicked
    body.on("click", "#lights", function(){
        // Switch Lights
        switchLights();
    });

    function switchLights(mode = null){
        // Override
        if(mode){
            lightsOn = mode;
        }

        // Check if lights are on at the moment
        if(lightsOn === true){
            // Slowly turn the lights off
            $('#speedo-container').fadeTo('slow', 0.2, function() {
                // Set New Background Image
                $(this).css("background-image", "url("+image_root+"race/tachometer-web-base-lights-out.jpg)");
                // Change Opacity
                $('#spedo_needle_img').css("opacity", .35);
                // Turn lights off
                lightsOn = false;
                // Change Input text
                $("#lights").text("Turn Lights On");
            }).fadeTo('slow', 1);
        } else {
            // Turn lights on
            $('#speedo-container').fadeTo('slow', 0.2, function() {
                // Set new background image
                $(this).css("background-image", "url("+image_root+"race/tachometer-web-base.jpg)");
                // Change opacity
                $('#spedo_needle_img').css("opacity", 1);
                // Turn lights on
                lightsOn = true;
                // Change Input Text
                $("#lights").text("Turn Lights Off");
            }).fadeTo('slow', 1);
        }
        // Return success
        return true;
    }
>>>>>>> 872842414914131d438672fd34736d5dc0c72660

$("#start").on( "click", function() {
	if(needleActive === true){
		alert("Please wait for the current animation to finish first.");
		return;
	}
	if(engOn == true){
		alert("Your engine is already running");
		return;
	}
	engOn = true;
	if (lightsOn == false){
		turnLightsOn();
		setTimeout( function(){
			rotateImage(2500, 400, 'spedo_needle_img');
		}, 600 );
		setTimeout( function(){
			rotateImage(2000, 250, 'spedo_needle_img');
		}, 1000 );
		setTimeout( function(){
			rotateImage(800, 3500, 'spedo_needle_img');
		}, 1250 );
		setTimeout( function(){
			holdRPMActive = true;
			holdRPM(800);
		}, 4750 );
		return;
	}

	rotateImage(2500, 400, 'spedo_needle_img');
	setTimeout( function(){
		rotateImage(2000, 250, 'spedo_needle_img');
	}, 400 );
	setTimeout( function(){
		rotateImage(800, 3500, 'spedo_needle_img');
	}, 650 );
	setTimeout( function(){
		holdRPMActive = true;
		holdRPM(800);
	}, 4150 )
});

$("#rev").on( "click", function() {
	holdRPMActive = false;
	if(needleActive === true){
		alert("Please wait for the current animation to finish first.");
		return;
	}
	if(engOn == false){
		alert("Your engine is must be running to rev. Press the engine start button.");
		return;
	}
						    rotateImage(7500, 800, 'spedo_needle_img');
							setTimeout( function(){
								rotateImage(7000, 200, 'spedo_needle_img');
							}, 800 );
							setTimeout( function(){
								rotateImage(7500, 200, 'spedo_needle_img');
							}, 1000 );
							setTimeout( function(){
								rotateImage(7000, 200, 'spedo_needle_img');
							}, 1200 );
							setTimeout( function(){
								rotateImage(7500, 200, 'spedo_needle_img');
							}, 1400 );
							setTimeout( function(){
								rotateImage(7000, 200, 'spedo_needle_img');
							}, 1600 );
							setTimeout( function(){
								rotateImage(7500, 200, 'spedo_needle_img');
							}, 1800 );
							setTimeout( function(){
								rotateImage(7000, 200, 'spedo_needle_img');
							}, 2000 );
							setTimeout( function(){
								rotateImage(7500, 200, 'spedo_needle_img');
							}, 2200 );
							setTimeout( function(){
								rotateImage(800, 1600, 'spedo_needle_img');
							}, 2400 );
							setTimeout( function(){
								holdRPMActive = true;
								holdRPM(800);
							}, 4000 );
						});

$("#launch").on( "click", function() {
	if(needleActive === true){
		alert("Please wait for the current animation to finish first.");
		return;
	}
		launchRPM  = $("#launchRPM").val();
		currentRPM = (($("#spedo_needle_img").getRotateAngle() + 6)*41.66);
		rpmDiff    = launchRPM - currentRPM;
		if( engOn == false ){
			alert("You must start your engine first.");
			return;
		}
		if (launchRPM <= 799 ){
			alert("You must enter a number greater than the idle speed of 800rpm.");
			return;
		}
		if (launchRPM >= 7501 ){
			alert("You can not launch the car higher than the rev limiter.");
			return;
		}
		holdRPMActive = false;


				rpmDiffTime = rpmDiff/10;
				//Rev engine to Launch RPM
				setTimeout( function(){
					rotateImage(launchRPM, rpmDiffTime, 'spedo_needle_img');
				}, 140 );
				//Hold RPM at launch
				setTimeout( function(){
					holdRPMActive = true;
					holdRPM(launchRPM);
				}, rpmDiffTime );
				//Launch
				dropRPM = launchRPM * .3; if (dropRPM <= 750) dropRPM = 800;
				setTimeout( function(){
					holdRPMActive = false;
					rotateImage(dropRPM, 200, 'spedo_needle_img');
				}, rpmDiffTime+2500 );
				// First gear
				setTimeout( function(){
					rotateImage(7200, 2900, 'spedo_needle_img');
				}, rpmDiffTime+2700 );
				// Second gear shift
				setTimeout( function(){
					rotateImage(4500, 180, 'spedo_needle_img');
				}, rpmDiffTime+5600 );
				// Second gear
				setTimeout( function(){
					rotateImage(7700, 2600, 'spedo_needle_img');
				}, rpmDiffTime+5780 );
				// Third gear shift
				setTimeout( function(){
					rotateImage(4800, 220, 'spedo_needle_img');
				}, rpmDiffTime+8380 );
				// Third Gear
				setTimeout( function(){
					rotateImage(7300, 2300, 'spedo_needle_img');
				}, rpmDiffTime+8600 );
				// Slow Down
				setTimeout( function(){
					rotateImage(800, 2500, 'spedo_needle_img');
				}, rpmDiffTime+10900 );
				// Start Idle
				setTimeout( function(){
					holdRPMActive = true;
					holdRPM(600);
				}, rpmDiffTime+13400 );
			return true;

});

$("body").on("click", "#idle", function() {
	if(needleActive === true){
		alert("Please wait for the current animation to finish first.");
		return;
	}
	if(engOn == false){
		alert("Your engine is must be running to rev. Press the engine start button.");
		return;
	}
	holdRPMActive = true;
	targetRPM  = 800;
	currentRPM = (($("#spedo_needle_img").getRotateAngle() + 6)*41.66);
	rpmDiff    = currentRPM - launchRPM;
	rpmDiffTime = rpmDiff/10;

	rotateImage(targetRPM, rpmDiffTime, 'spedo_needle_img');
	setTimeout( function(){
		holdRPM(targetRPM);
	}, rpmDiffTime );
});

$("body").on("click", "#off", function() {
	if(needleActive === true){
		alert("Please wait for the current animation to finish first.");
		return;
	}
	if(engOn == false){
		alert("Your engine is must be running to rev. Press the engine start button.");
		return;
	}
	holdRPMActive = false;
	needleActive = false;
	rotateImage(200, 200, 'spedo_needle_img');
	setTimeout( function(){
		turnLightsOff();
		holdRPMActive = false;
		needleActive = false;
		engOn = false;
	}, 300 );
});

$("body").on("click", "#race", function() {
	// Set the time that the race was initiated
	createdTime=Date.now();
	//Start the checks that could stop the function
	// Check to see if another animation is playing
	if(needleActive === true){
		alert("Please wait for the current animation to finish first.");
		return;
	}
	// Check to see if the engine is on
	if( engOn == false ){
		alert("You must start your engine first.");
		return;
	}
	// Check to see if launch RPM is set below Idle rpm
	if (launchRPM <= 799 ){
		alert("You must enter a number greater than the idle speed of 800rpm.");
		return;
	}
	// Check to see if Launch RPM is greater than redline
	if (launchRPM >= 7501 ){
		alert("You can not launch the car higher than the rev limiter.");
		return;
	}


		//Get the launch RPM
		launchRPM  = $("#launchRPM").val();
		//Find what RPM the needle is at now
		currentRPM = (($("#spedo_needle_img").getRotateAngle() + 6)*41.66);
		//Get the difference bewtween Launch RPM and the current RPM to make the animation
		rpmDiff    = launchRPM - currentRPM;
		// Set the length of time the rev take to get to the launchRPM (10milisecs for every 1 rpm)
		rpmDiffTime = rpmDiff/10;
		// Stop the idle or holdRPM animation
		holdRPMActive = false;
		delay = 1;//TODO remove or make this var work

			//Turn the launch button on
			setTimeout( function(){
				$("#launchRaceButton").fadeIn(200);
			});
			//Rev engine to Launch RPM
			setTimeout( function(){
				rotateImage(launchRPM, rpmDiffTime, 'spedo_needle_img');
			}, 140 );
			//Hold RPM at launch
			setTimeout( function(){
				// Initiate idle or holdRPM animation
				holdRPMActive = true;
				holdRPM(launchRPM);
			}, rpmDiffTime );
			// Light the pre-stage bulbs
			setTimeout(stage1, rpmDiffTime);
			setTimeout(stage2, rpmDiffTime+1840);

		// Start lighting the christmas tree
		setTimeout(amber1, rpmDiffTime+2840);
		setTimeout(amber2, rpmDiffTime+3340);
		setTimeout(amber3, rpmDiffTime+3840);
		setTimeout(green, rpmDiffTime+4340);
		function stage1 (){
			delay = delay - 1000; // if the player redlights, this var delays the activation of the startRace to properly set the R/T.
			$("#stage1").toggle();
		}
		function stage2 (){
			delay = delay - 1000; // if the player redlights, this var delays the activation of the startRace to properly set the R/T.
			$("#stage2").toggle();
		}
		function amber1 (){
			delay = delay - 1000; // if the player redlights, this var delays the activation of the startRace to properly set the R/T.
			$("#amber_1").toggle();
		}
		function amber2 (){
			delay = delay - 500;
			$("#amber_2").toggle();
		}
		function amber3 (){
			delay = delay - 500;
			$("#amber_3").toggle();
		}
		function green (){
			delay = delay - 500;
			$("#green").toggle();
			greenLightOnTime=Date.now(); // Set the time that the green light was lit, to compare player RT
		}
});


$("body").on("click", "#launchRaceButton", function() {
		// Check to see if play red lit
		playerLaunchedTime=Date.now();
		$(this).fadeOut(300);
		
		if( playerLaunchedTime < greenLightOnTime){
			$("#red").fadeIn(300);
		}

		//Launch
		dropRPM = launchRPM * .5; if (dropRPM <= 750) dropRPM = 800;

			holdRPMActive = false;
			rotateImage(dropRPM, 200, 'spedo_needle_img');
		// First gear
		setTimeout( function(){
			rotateImage(7200, 2900, 'spedo_needle_img');
		}, 200 );
		// Second gear shift
		setTimeout( function(){
			rotateImage(4500, 180, 'spedo_needle_img');
		}, 3100 );
		// Second gear
		setTimeout( function(){
			rotateImage(7700, 2600, 'spedo_needle_img');
		}, 3280 );
		// Third gear shift
		setTimeout( function(){
			rotateImage(4800, 220, 'spedo_needle_img');
		}, 5880 );
		// Third Gear
		setTimeout( function(){
			rotateImage(7300, 2300, 'spedo_needle_img');
		}, 6000 );
		// Slow Down
		setTimeout( function(){
			rotateImage(800, 2500, 'spedo_needle_img');
		}, 8300 );
		// Start Idle
		setTimeout( function(){
			holdRPMActive = true;
			holdRPM(600);
		}, 10800 );
	return true;
});


function holdRPM(rpm){
		if (rpm >= 1500){
			bounceAMT = 250;
		} else bounceAMT = 50;
		bounceRPM = rpm-bounceAMT;
		bounceActive = false;
		idle(bounceActive);

		function idle(bounceActive){
			if(holdRPMActive == false){
				return false;
			}

			if( bounceActive == false){
				rotateImage(bounceRPM, 100, 'spedo_needle_img');

				bounceActive = true;

					//Activate HOLD RPM
						if(holdRPMActive == true){
							setTimeout( function(){
								idle(bounceActive);
							}, 100 );
						}
			}else if( bounceActive == true ){
				rotateImage(rpm, 100, 'spedo_needle_img');

				bounceActive = false;

					//Activate Bounce RPM
						if(holdRPMActive == true){
							setTimeout( function(){
								idle(bounceActive);
							}, 100 );
						}
			}
		return true;
		}
}

function turnLightsOn(){
	if (lightsOn === true){
		alert("Your lights are already on!");
		return false;
	}

	$('#speedo-container').fadeTo('slow', 0.2, function()
	{
		$(this).css("background-image", "url("+image_root+"race/tachometer-web-base.jpg)");
		$('#spedo_needle_img').css("opacity", 1);
		lightsOn = true;
	}).fadeTo('slow', 1);

	return true;
}

function turnLightsOff(){
	if (lightsOn === false){
		alert("Your lights are already off!");
		return false;
	}

	$('#speedo-container').fadeTo('slow', 0.2, function()
	{
		$(this).css("background-image", "url("+image_root+"race/tachometer-web-base-lights-out.jpg)");
		$('#spedo_needle_img').css("opacity", .35);
		lightsOn = false;
	}).fadeTo('slow', 1);

	return true;
}

function rotateImage(rpm, duration, imgID){
		startAng = $("#"+imgID).getRotateAngle();
		endAng   = (rpm/41.66) - 6;

		if(holdRPMActive === false){
			needleActive = true;
			console.log("needle is active. 1");
		}
		if(holdRPMActive === true){
			 needleActive = false;
			 console.log("needle is NOT active. 1");
		}
		$("#"+imgID).rotate({
			  angle:startAng,
			  duration:duration,
			  easing: $.easing.easeInQuad,
			  animateTo:endAng,
			  callback: function(){ changeActiveNeedleStatus(); }
		  });

		  function changeActiveNeedleStatus(){
			  if( holdRPMActive === false ){
				  needleActive = true;
				  console.log("needle is active");
			  }
			  if( holdRPMActive === true ){
				   needleActive = false;
 				   console.log("needle is NOT active");
			  	}

			  return true
		  }

		return true;
}
		//.rotate({ startDeg:0, endDeg:160, duration:2.8, easing:'ease-out' }); //TODO Find a way to make the center point of the rotate corectly on the needle

</script>
</footer>
</html>
