
$( "#new_race" ).on( "click", function() {
	$( "#new_race_dialog" ).dialog( "open" );
	lights(true);
});
$( "#new_race_tabs_container" ).tabs({
  disabled: [ 1, 2 ]
});

$(function() {

	$.get( site_root+"app/ajax-controllers/raceUsersAjax.php?action=findComputers", function( data ) {
		for (var i of data) {

			$( "#race_computer_id" ).append("<option value=\"" + i['id'] + "\" data-betamt=\"" + i['user_cash'] + "\">" + i['username'] + " ($"+ i['user_cash'] +")</option>")

		};
	});
});
var typeOfRace; var raceWho;

$( "button" ).button({
	icon: "ui-icon-flag"
});
$( ".pinks" ).checkboxradio({
	icon: false
});


$( "#race_who_id" ).autocomplete({
  source: site_root+"app/ajax-controllers/raceUsersAjax.php?action=findUsers",
  position: { my : "left top", at: "left bottom" },
  select: function( event, ui ) {
	  $( "#race_who_id" ).attr("readonly", true);
	  $( "#changeOpponent" ).fadeIn(600);
	  $( "#new_race_tabs_container" ).tabs( "enable", 2 );
	  $( "#new_race_tabs_container" ).tabs( "option", "active", 2 );
	  $('#Start_Race_Button').fadeTo(0, 0.3, function()
		{
		    $(this).css('background-color','#4BB543').css('color', '#fff');
		}).fadeTo(600, 1);
  }
});

var acOpen = false;var dialogHeight;

$( "#race_who_id" ).on( "autocompleteopen", function( event, ui ) {
	var autoCompleteHeight = $( ".ui-autocomplete" ).innerHeight();


	if( acOpen === false ){
		dialogHeight = $( "#new_race_dialog" ).innerHeight();
		var addDandAC    = autoCompleteHeight + dialogHeight + 120;
	}
	if( acOpen === true ){
		addDandAC = autoCompleteHeight + dialogHeight + 120;
	}
	$( "#new_race_dialog" ).dialog( "option", "height", addDandAC );
	acOpen = true;
} );

$( "#race_who_id" ).on( "autocompleteclose", function( event, ui ) {
	$( "#new_race_dialog" ).dialog( "option", "height", "auto");
	acOpen = false;
} );


$("body").on( "click", "button", function(){
	switch($(this).attr("id")) {
	    case "new_street_race_button":
		        typeOfRace = "streetRace";
				$( "#new_race_tabs_container" ).tabs( "enable", 1 );
				$( "#new_race_tabs_container" ).tabs( "option", "active", 1 );
				$( "#new_street_race_radio").prop("checked", true);
	        break;
	    case "new_track_race_button":
		        typeOfRace = "trackRace";
				$( "#new_race_tabs_container" ).tabs( "enable", 1 );
				$( "#new_race_tabs_container" ).tabs( "option", "active", 1 );
				$( "#new_track_race_radio").prop("checked", true);
	        break;
	    case "computer_racer_button":
		        raceWho = "computer";
				$( "#computer_racer_radio").prop("checked", true);
				$( "#racerSearch" ).fadeOut(0);
				$( "#computerSearch" ).fadeIn(600);
	        break;
	    case "player_racer_button":
		        raceWho = "player";
				$( "#new_race_tabs_container" ).tabs( "enable", 2 );
				$( "#player_racer_radio").prop("checked", true);
				$( "#computerSearch").fadeOut(0);
				$( "#racerSearch" ).fadeIn(600);
				$( "#race_who_id" ).focus();
				$( "#race_who_id" ).autocomplete( "option", "position", { my : "left top", at: "left bottom", collision: "none" } );
	        break;
	    case "test_race_button":
		        raceWho = "test";
				$( "#new_race_tabs_container" ).tabs( "enable", 2 );
				$( "#new_race_tabs_container" ).tabs( "option", "active", 2 );
				$( "#test_race_radio").prop("checked", true);
				$('#Start_Race_Button').fadeTo('slow', 0.3, function()
				{
				    $(this).css('background-color','#4BB543').css('color', '#fff');
				}).fadeTo('slow', 1);
				$( "#computerSearch").fadeOut(0);
				$( "#racerSearch" ).fadeOut(0);
	        break;
		case "changeOpponent":
				$( "#race_who_id" ).attr("readonly", false).val("");
				$( "#changeOpponent" ).fadeOut(300);
			break;
	    default:
	        return false;
	}
});

$( "#race_computer_id" ).change( function() {
	var betAmt = $( "#race_computer_id option:selected" ).data( "betamt" );
	$( "#new_race_tabs_container" ).tabs( "enable", 2);
   	$( "#new_race_tabs_container" ).tabs( "option", "active", 2 );
	$( "#race_amount" ).val(betAmt).attr("max", betAmt).focus();
	$('#Start_Race_Button').fadeTo('slow', 0.3, function()
	{
	    $(this).css('background-color','#4BB543').css('color', '#fff');
	}).fadeTo('slow', 1);
	});

$( "#new_race_dialog" ).dialog({
	  autoOpen: false,
	  height: "auto",
	  width: "600px",
	  modal: true,
	  show: {
		effect: "fold",
		duration: 600
	  },
	  hide: {
		effect: "fold",
		duration: 200
	},
	  buttons: {
				"Start_Race": {
					text: "Start Race",
					id: "Start_Race_Button",
					click: function() {
								var betAmount 	 = $("#race_amount").val();
								if( betAmount < 0 ){
									dialogError("player_count", "Please enter an amount greater than or equal to $0.", "Fail");
									return false;
								}
								createRace();
							}
				},

				Close: function() {
				  $( "#new_race_dialog" ).dialog( "close" );

				}
	  },
	  close: function() {
		//fornrdReset[ 0 ].reset();
		var typeOfRace = null; var raceWho = null;
		$( "#new_race_tabs_container" ).tabs( "option", "disabled", [1, 2] );
		$( "#new_race_tabs_container" ).tabs( "option", "active", 0 );
		$( ".new_race_type").prop("checked", false);
		$( ".new_race_who").prop("checked", false);
		$( "#race_amount" ).val(0);
		$( "#new_race_error" ).fadeOut(0);
		$( "#racerSearch" ).fadeOut(0);
		$( "#computerSearch" ).fadeOut(0);
		$("#race_amount").val();
		$( "#race_computer_id" ).val(false)
	  }
	});


//TODO Fix the radio button so that it sends the
function createRace(){
	dialogError("new_race", "Loading...", "Pass");
	var betAmount 	 = $("#race_amount").val();
	var raceForPinks = $(".pinks:checked").val();
	var typeOfRace	 = $(".new_race_type:checked").val();
	var race_who	 = $(".new_race_who:checked").val();
	var newRaceError = true;
	    if( race_who == "computer" ){
			var racerID = $( "#race_computer_id option:selected" ).val();

			if ( !racerID ) { dialogError("new_race", "You have to select a competitor first.", "Fail"); return false; }
	    }
	    if( race_who == "player" ){
			var racerID = $( "#race_who_id" ).val();
		}
	    if( race_who == "test" ){
			var racerID = "test_race";
	    }

		if( !racerID){
			dialogError("new_race", "You have to select a competitor first.", "Fail");
			return false;
		}

	if( !typeOfRace || !race_who || !betAmount){
		dialogError("new_race", "You did not fill out one of the steps, please try again.", "Fail");
		return false;
	}


	$.post(site_root+'app/ajax-controllers/raceAjax.php', {
		action: "createNewRace",
		race_type: typeOfRace,
		race_who: raceWho,
		race_who_id: racerID,
		race_amount: betAmount,
		race_pinks: raceForPinks
	}, function (data) {
		newRaceError = false;
		if( data['error'] === true ){
			dialogError("new_race", data['e_msg'], "Fail");

			return false;
		} else if ( data['error'] === false ){
			dialogError("new_race", "The race was created", "Pass");

			//Start race Animation function is located in race-scene-races.js
			race_id =  data['race_stats']['race_id']; estimateET = data['race_stats']['et']; estimateMPH = data['race_stats']['trap']; // Set race data
			startRaceAnimation();

			setTimeout( function(){
				$( "#new_race_dialog" ).dialog( "close" );
			}, 800 );
			return true;
		}
	});

	if( newRaceError) dialogError("new_race", "There was an un-known error creating the race, please try again.", "Fail");

	return false;
}

function dialogError(dialogID, errorMSG, passFail){
	if(typeof dialogID === null || typeof errorMSG === null){
		return false;
	}
	if(typeof passFail === null) passFail = "Pass";


	$( "#"+dialogID+"_passFail" ).html(passFail+"!  ");
	$( "#"+dialogID+"_e_msg_dialog" ).html(errorMSG);
	$( "#"+dialogID+"_error" ).fadeIn(600);

	return true;
}
