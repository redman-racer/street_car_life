
$( "#set_launch" ).on( "click", function() {
	$( "#launch_rpm_dialog" ).dialog( "open" );
	$( "#launch_rpm" ).select();
});


$( "#launch_rpm_dialog" ).dialog({
	  autoOpen: false,
	  height: "auto",
	  width: "auto",
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
				"Set_RPM": {
					text: "Set RPM",
					id: "Set_RPM",
					click: function() {
								setRPM();
							}
				},

				Close: function() {
				  $( "#launch_rpm_dialog" ).dialog( "close" );
				  $( "#launch_rpm_error" ).fadeOut();
			  },
	  }
  });

	formslrpm = $( "#launch_rpm_dialog" ).find( "form" ).on( "submit", function( event ) {
		setRPM();
	  event.preventDefault();
  });


function setRPM(){
	var launch_rpm = $("#launch_rpm").val();
	$.post(site_root+'app/ajax-controllers/raceAjax.php', {
		action: "setLaunchRPM",
		launch_rpm: launch_rpm
	}, function (data) {
		if( data['error'] === true ){
			dialogError("launch_rpm", data['e_msg'], "Fail");

			return false;
		} else if ( data['error'] === false ){
			dialogError("launch_rpm", data['e_msg'], "Pass");

		}
	});

	return true;
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
