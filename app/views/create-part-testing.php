<?php
// Include Globals
require '../config/globals.php';

// Instantiate Parts Store Control Panel
$ps_cp = new PartStoreCP($conn);

 	if ( isset( $_GET['changeOwner']) ){
		echo "Test";
		$updateVal = $ps_cp->changeOwner($_GET['store_id'], $_GET['user_id']);
		if( $updateVal ){
			echo "::It worked;";
		} else echo "it didnt work";
	}

	$time = time();
	$date = date('Y-m-d', $time) ."\n";
	echo $time."; :".$date;
	 ?>

<html>
<head>
	<title>Create Part Factor Calculator</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<!--Include jquery-->
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

	function hpFunction(){
		hpFactor = $( "#hp_factor" ).val();

		hp1 = Math.round((( ( 100 + 100 + 100 ) * hpFactor ) * 5.7) * 100) / 100;
		hp2 = Math.round((( ( 70 + 50 + 60 ) * hpFactor ) * 5.7) * 100) / 100;
		hp3 = Math.round((( ( 25 + 25 + 25 ) * hpFactor ) * 5.7) * 100) / 100;

		hpMSG = 'HP1 = ' + hp1 + '; HP2 = ' + hp2 + '; HP3 = ' + hp3 + ';';

		$( "#hp_result" ).html(hpMSG);
	}

	function weightFunction(){
		weightFactor = $( "#weight_factor" ).val();

		weight1 =  Math.round(((( ( ( (100 + 100 ) * 0.85 ) + 100 ) ) / 3 ) * weightFactor) * 100) / 100;
		weight2 =  Math.round(((( ( ( (75 + 50 ) * 0.85 ) + 60 ) ) / 3 ) * weightFactor) * 100) / 100;
		weight3 =  Math.round(((( ( ( (75 + 50 ) * 0.85 ) + 30 ) ) / 3 ) * weightFactor) * 100) / 100;
		weight4 =  Math.round(((( ( ( (25 + 25 ) * 0.85 ) + 25 ) ) / 3 ) * weightFactor) * 100) / 100;

		weightMSG = 'weight1 = ' + weight1 + '; weight2 = ' + weight2 + '; weight3 = ' + weight3 + '; weight4 = ' + weight4 + ';';

		$( "#weight_result" ).html(weightMSG);
	}

	function costFunction(){
		costFactor = $( "#cost_factor" ).val();
		time1 = 100;
		time2 = 50;
		time3 = 25;
		money1 = 100;
		money2 = 75;
		money3 = 25;
		rd1 = 100;
		rd2 = 60;
		rd3 = 30;
		rd4 = 25;

		function mintoMaxAdjust(time, money, rd){
			mtma = (( ( 100 - money ) + ( 100 - time ) + ( 100 - rd ) ) * 0.01 );

			if ( mtma < 1){
				mtma = 1;
			}

			return mtma;
		}

		cog1 =  Math.round(((((((((money1 + time1 ) * 0.65 ) + rd1 )) / 3 ) * 1.308 ) * costFactor) * mintoMaxAdjust(time1, money1, rd1)) * 100) / 100 ;
		cog2 =  Math.round(((((((((money2 + time2 ) * 0.65 ) + rd2 )) / 3 ) * 1.308 ) * costFactor) * mintoMaxAdjust(time2, money2, rd2)) * 100) / 100 ;
		cog3 =  Math.round(((((((((money2 + time2 ) * 0.65 ) + rd3 )) / 3 ) * 1.308 ) * costFactor) * mintoMaxAdjust(time2, money2, rd3)) * 100) / 100 ;
		cog4 =  Math.round(((((((((money3 + time3 ) * 0.65 ) + rd4 )) / 3 ) * 1.308 ) * costFactor) * mintoMaxAdjust(time3, money3, rd4)) * 100) / 100 ;

		costMSG = 'cost1 = ' + cog1 + '; cost2 = ' + cog2 + '; cost3 = ' + cog3 + '; cost4 = ' + cog4 + ';';

		$( "#cost_result" ).html(costMSG);
	}

	function updateStoreVal(){

	}
</script>
</head>
<body>

	<div id="container">
		<div id="hp">
			HP Factor: <input type="number" id="hp_factor" onkeyup="hpFunction();" /> <br />
			<div id="hp_result"> </div>
		</div>
		<div id="weight">
			Weight Factor: <input type="number" id="weight_factor" onkeyup="weightFunction();" /> <br />
			<div id="weight_result"> </div>
		</div>
		<div id="cost">
			Cost Factor: <input type="number" id="cost_factor" onkeyup="costFunction();" /> <br />
			<div id="cost_result"> </div>
		</div>
	</div>

	<div id="update_ps_value">
		Store ID to Update: <input type="number" id="up_ps_val" onkeyup="updateStoreVal();" /> <br />
	</div>
</body>
<footer>
</footer>
</html>
