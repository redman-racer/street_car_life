// Street-Race Javascript Module
//(function () {
	// Starts the r/t game
	var clickedTime; var createdTime = false; var reactionTime; var delay = 2600; var submit = false;

	$("#createRace").submit(function(e) {
		e.preventDefault();

		// Checkes to see if the race has been submited already.
		if (submit) {alert('You are only alowed to race one time'); return false;}
		// Mark the race as has been submitted.
		submit = true;

		// Make the buttons change.
		$("#launch").fadeIn(0, function (e){
			$("#start_tree").fadeOut(0);
		});
		// Make the inputs un-editable
		$('#betAmount').attr('readonly', true);
		$('#raceWho').attr('readonly', true);

		// Start lighting the christmas tree
		setTimeout(amber1, 1000);
    	setTimeout(amber2, 1500);
    	setTimeout(amber3, 2000);
    	setTimeout(green, 2500);
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
			createdTime=Date.now(); // Set the time that the green light was lit, to compare player RT
		}
	});

	$("body").on("click", "#launch", function (e) {
		clickedTime=Date.now(); // Set the time that the player Reacted (RT)

		// Compare the Reacted time to the green light LIT time.
		reactionTime=(clickedTime-createdTime)/1000;

		// Check to see if the player redlit.
		if (!createdTime) {
			setTimeout(delayStart, delay); // if they did redlight, delay the start of the race by the time left in the countdown.
		}else startRace((clickedTime-createdTime)/1000); // The didnt redlight, start the race.

		// Function to delay the start if they redlight.
		function delayStart (){
			startRace((clickedTime-createdTime)/1000)
		}
	});



	//Loads race results
	function startRace(playerRT) {
		var raceWho = $("#raceWho").val();
		var betAmount = $("#betAmount").val();
		$("#launch").fadeOut(100);

		$.post('app/ajax-controllers/raceAjax.php', {
			action: 'streetRace',
			raceWho: raceWho,
			playerRT: playerRT,
			betAmount: betAmount
		}, function (data) {
			// Check for errors
			if (checkErrors(data)){ alert("There was an error with data."); return false;}

			// Gather the PLAYER race results
			playerRT     = data['results']['player']['rtvrt']
			playerSixty  = data['results']['player']['sixty'];
			playerEighth = data['results']['player']['eighth'];
			playerET     = data['results']['player']['et'];
			playerTrap   = data['results']['player']['trap'];
			playerRTET   = data['results']['player']['rtet'];

			// Gather teh COMPUTER race results
			computerRT     = data['results']['computer']['rtvrt'];
			computerSixty  = data['results']['computer']['sixty'];
			computerEighth = data['results']['computer']['eighth'];
			computerET     = data['results']['computer']['et'];
			computerTrap   = data['results']['computer']['trap'];
			computerRTET   = data['results']['computer']['rtet'];

			// Find win Margin
			if (computerRTET > playerRTET) winMargin = computerRTET-playerRTET;
			if (computerRTET < playerRTET) winMargin = playerRTET-computerRTET;


			// Checks to see if player redlight and displays the red light if so.
			if (playerRT < 0) $("#red").toggle();

			// Find who the winner was.
			var winner = "The winner of the race was the " + data['winner'];

			// Write the display that will be shown
			result_display= '<br />' + winner + '! <br />' +
							'     Player.........................Computer <br />' +
							' RT : ' + playerRT.toFixed(3) + ' .................. RT : ' + computerRT.toFixed(3) + '<br />' +
							' 60\' : ' + playerSixty + ' .................. 60\' : ' + computerSixty + '<br />' +
							'1/8th : ' + playerEighth + ' .................. 1/8th : ' + computerEighth + '<br />' +
							'   ET : ' + playerET + ' ..................  ET : ' + computerET + '<br />' +
							' Trap : ' + playerTrap + ' .................. Trap : ' + computerTrap + '<br />'+
							'.......Win Margin: ' + winMargin.toFixed(3) + '........';
			$("#results").html(result_display);
		});
	}

	// Function to check for errors
	function checkErrors(data) {
		if (data['error'] !== false) {
			if (data['noCash'] == true){
				alert("You did not have enough money to cover your bet, the race was aborted.");
			}
			return true;
		} else {
			return false;
		}
	}
//}
