<?php
// Include Globals
require '../config/globals.php';
?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
<div id="Main_Container">
    <?php include_once '../includes/navigation.php'; ?>
    <div id="content">
		<div id="generic_container">
			<span id="streetRace" data-id="1">Race Mazda Miata</span><br />
			<span id="streetRace" data-id="2">Race Chevrolet Camaro ZL1</span><br />
			<span id="streetRace" data-id="3">Race Chevrolet Corvette Z06</span><br />
			<!--<span id="streetRace" data-id="4">Race id 4</span><br />
			<span id="streetRace" data-id="5">Race id 5</span><br />
			<span id="streetRace" data-id="6">Race id 6</span><br />
			<span id="streetRace" data-id="7">Race id 7</span><br />-->
			<div id="results"> </div>
		</div>
	</div>
</div>
</body>
<footer>
<script>
// Street-Race Javascript Module
//(function () {

	//Loads race results
	$("body").on("click", "#streetRace", function (e) {
		var raceWho = $(this).data("id");

		$.post('app/ajax-controllers/raceAjax.php', {
			action: 'streetRace',
			raceWho: raceWho
		}, function (data) {
			playerSixty  = data['results']['player']['sixty'];
			playerEighth = data['results']['player']['eighth'];
			playerET     = data['results']['player']['et'];
			playerTrap   = data['results']['player']['trap'];
			computerSixty  = data['results']['computer']['sixty'];
			computerEighth = data['results']['computer']['eighth'];
			computerET     = data['results']['computer']['et'];
			computerTrap   = data['results']['computer']['trap'];

			if (playerET < computerET) var winner = "The winner was the Player";
			if (playerET == computerET) var winner = "The race was a Draw";
			if (playerET > computerET) var winner = "The winner was the Computer";			

			result_display= '<br />' + winner + '! <br />' +
							'     Player.........................Computer <br />' +
							' 60\' : ' + playerSixty + ' .................. 60\' : ' + computerSixty + '<br />' +
							'1/8th : ' + playerEighth + ' .................. 1/8th : ' + computerEighth + '<br />' +
							'   ET : ' + playerET + ' ..................  ET : ' + computerET + '<br />' +
							' Trap : ' + playerTrap + ' .................. Trap : ' + computerTrap + '<br />';
			$("#results").html(result_display);
			// Check for errors
			if (checkErrors(data)) return false;
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
//}
</script>
</footer>
