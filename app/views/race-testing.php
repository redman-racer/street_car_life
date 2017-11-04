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
<div div="button_container" style="width:940px; height:200px;">
	<button id="lights">Turn Lights On</button>
	<button id="start">Turn Engine On</button>
	<button id="rev">Rev the Engine</button>
	<button id="launch">Launch</button>
	<button id="idle">Idle</button>
	<button id="off">Off</button>
	<input type="number" id="launchRPM" placeholder="Set Launch RPM" />
</div>
</body>
<footer>
<script src="<?php echo $JS_ROOT; ?>all.js"></script>
<script>
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
		holdRPMActive = false;
		needleActive = false;
		engOn = false;
	}, 300 );

	$('#speedo-container').fadeTo('slow', 0.2, function()
	{
		$(this).css("background-image", "url("+image_root+"race/tachometer-web-base-lights-out.jpg)");
		$('#spedo_needle_img').css("opacity", .35);
		lightsOn = false;
	}).fadeTo('slow', 1);
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
	$('#speedo-container').fadeTo('slow', 0.2, function()
	{
		$(this).css("background-image", "url("+image_root+"race/tachometer-web-base.jpg)");
		$('#spedo_needle_img').css("opacity", 1);
		lightsOn = true;
	}).fadeTo('slow', 1);
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
