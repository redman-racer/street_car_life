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

var lightsOn = false; var engOn = false; var holdRPMActive = false;

    /*
        It's always better to do it this way:

        $("body").on("click", "#lights", function(){});

        Because this will bind the event on the body, and if you delete the element
        and re-add it, the event will still work. but if it's binded directly on the
        element and you remove the element, you have to rebind it afterwards.
     */

$("#lights").on( "click", function() {
	$('#speedo-container').fadeTo('slow', 0.2, function()
	{
	    $(this).css("background-image", "url("+image_root+"race/tachometer-web-base.jpg)");
		$('#spedo_needle_img').css("opacity", 1);
		lightsOn = true;
	}).fadeTo('slow', 1);
});

    /*
        You should use === to force type binding ( false|true is a boolean, so verifying against true
        really verifies for true, for example with == (string)"true" would still work

        ==============================================================================================

        Furthermore, you should always return something, it's a function, so returning false is better
        This doesn't seem really useful now but if you ever start to use promises you'll run into issues
        because promise statements wait for a true/false return
     */

$("#start").on( "click", function() {
	if(engOn == true){
		alert("Your engine is already running");
		return;
	}
	engOn = true;
	if (lightsOn == false){

	    /*
	        To keep the flow of the app running more comform, you should put the lines 104 105 106 in a function
	        like moveNeedle(speed, angle, duration){
	            setTimeout( function(){
	                rotateImage(speed, angle, 'spedo_needle_img');
	            }, duration);
	        }

	        This way you could write:
	            moveNeedle(2500,400,600);
	            moveNeedle(2000, 250, 1000);
	            moveNeedle(800, 3500, 01250);

            I'm not sure if it his is just test code or a set in stone thing
	     */

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

		if ( rpmDiff >= 1500 ){
				rpmDiffTime = rpmDiff/10;
				setTimeout( function(){
					rotateImage(launchRPM, rpmDiffTime, 'spedo_needle_img');
				}, 140 );
				setTimeout( function(){
					holdRPMActive = true;
					holdRPM(launchRPM);
				}, rpmDiffTime );
			return;
		}
		setTimeout( function(){
			holdRPMActive = true;
			holdRPM(launchRPM);
		}, 140 );
});

$( "#degree" ).on("change", function() {
	//1% of rotation = 41.66 rpm. To get Degree of rotation for RPM desired. ~(RPM/41.66) - 6 = Degree~
	degree_val = $( "#degree" ).val();
	current_degree = $("#spedo_needle_img").getRotateAngle();
  	rotateImage(Number(current_degree), 200, Number(degree_val), 'spedo_needle_img');
});

/* For some reason you have double pagination here */

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

/* Functions should always return something no matter what */

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

		$("#"+imgID).rotate({
			  angle:startAng,
			  duration:duration,
			  easing: $.easing.easeInQuad,
			  animateTo:endAng
		  });
}
		//.rotate({ startDeg:0, endDeg:160, duration:2.8, easing:'ease-out' }); //TODO Find a way to make the center point of the rotate corectly on the needle

</script>
</footer>
</html>
