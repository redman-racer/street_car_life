<?php
require '../config/globals.php';
?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
<div id="container" style="width: 50%; height: 60%; text-align: right; padding-top: 20%;">
	<button id="button" style="width: auto; height: 75px;"> Click Me as Fast as possible </button>
	<div id="timer" style="width: 200px; height: 100px; background-color: #fff; margin-left: 80%; text-align: center; paddiing-top: 30px; font-size: 20px;">
	</div>
	<div id="counter" style="width: 200px; height: 100px; background-color: #fff; margin-left: 80%; border-top: 10px solid #000;  text-align: center; paddiing-top: 30px; font-size: 20px;">
	</div>
</div>
</body>
<footer>
<script src="<?php echo $JS_ROOT; ?>all.js"></script>
<script>
var appStart = false; var count = 0; var timerLimit = 1750; var timeOut = false;
$("body").on("click", "#button", function(e){

		if(appStart === false && timeOut === false) startClickApp();
		if(appStart === true && timeOut === true){
			timeOut = false;
			count = 0;
			 startClickApp();
		 }
		if(appStart === true  && timeOut === false){
			count++;
			$("#counter").text(count);
		}
});


function startClickApp(){
	appStart = true;
	var currentTime = Date.now();
	var timerEndTime = currentTime + timerLimit;
	var timer = setInterval(timerCountdown, 1);

		function timerCountdown(){
			currentTime = Date.now();

			if( currentTime >= timerEndTime) {
				clearTimeout(timer);
				$("#timer").text(0);
				timeOut = true;
					alert(count);
			}
			$("#timer").text((timerEndTime-currentTime)/1000);
		}
}
</script>
</footer>
</html>
