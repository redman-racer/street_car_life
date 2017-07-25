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
			<?php
			foreach ($car->fetchAllCarTemplate() as $key => $value) {
			?>
				<span id="streetRace" data-id="<?php echo $value['ct_id']; ?>" style="cursor: pointer;">Race a <?php echo $value['ct_year']." ".$value['ct_make']." ".$value['ct_model']; ?></span><br />
			<?php
			}
			?>
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
