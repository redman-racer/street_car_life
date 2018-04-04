$( function(){

});

$( "#pending_races_dialog" ).dialog({
	show: {
	  effect: "fold",
	  duration: 600
	},
	hide: {
	  effect: "fold",
	  duration: 600
  },
	autoOpen: false,
	width: "auto",
	height: "auto",
	modal: true,
	buttons: {
			Close: function() {
			  $( "#pending_races_dialog" ).dialog( "close" );
			}
	},
	close: function() {
		var pending_race_close_html = "<tr>"+
								  "<th style=\"width: 8.25%;\">"+
									  "Race ID"+
								  "</th>"+
								  "<th style=\"width: 18.5%;\">"+
									  "Your Car"+
								  "</th>"+
								  "<th style=\"width: 18.5%;\">"+
									  "Challenger"+
								  "</th>"+
								  "<th style=\"width: 18.5%;\">"+
									  "Challenger Car"+
								  "</th>"+
								  "<th style=\"width: 8.25%;\">"+
									  "Bet Amount"+
								  "</th>"+
								  "<th style=\"width: 18.5%;\">"+
									  "Open Time Slip"+
								  "/th>"+
							  "</tr>";
		$("#incoming_msg").html(pending_race_close_html);
		$("#outgoing_msg").html(pending_race_close_html);
		$("#history_msg").html(pending_race_close_html);
	}
});


$( "#pending_races_tabs_container" ).tabs();


$( "#pending_races" ).on( "click", function(){
		$.post(site_root+'app/ajax-controllers/pendingRacesAjax.php', {
			action: "getRaces",

		}, function (data) {
			if( data['error'] === true ){
				dialogError("pending_races", data['e_msg'], "Fail");
				$( "#pending_races_dialog" ).dialog( "open" );

				return false;
			} else if ( data['error'] === false ){
				//  Collect all races data.
				data['race_data'].forEach(function (race) {
					if (race['race_driver_two'] == data['user_id'] && race['race_d2_et'] == null){
						var incoming_html = "<tr>"+
												"<td>"+
													race['race_id']+
												"</td>"+
												"<td id=\"ic2_"+race['race_id']+"\">"+
													race['car_two']['cars_model']+
												"</td>"+
												"<td>"+
													race['username_one']+
												"</td>"+
												"<td id=\"ic1_"+race['race_id']+"\">"+
													carIDToModel(race['race_d1_car'], 'ic1_'+race['race_id'])+
												"</td>"+
												"<td>"+
													race['race_bet_amount']+
												"</td>"+
												"<td>"+
													"<button id=\"start_reply_race\" data-raceID=\""+ race['race_id'] +"\" class=\"ui-button ui-corner-all ui-widget\">Start Race</button>"+
												"</td>"+
											"</tr>";
						$( "#incoming_msg" ).append(incoming_html);
					}
					if (race['race_driver_one'] == data['user_id'] && race['race_d2_et'] == null && race['race_driver_two'] != 0 ){
						var outgoing_html = "<tr>"+
												"<td>"+
													race['race_id']+
												"</td>"+
												"<td id=\"oc1_"+race['race_id']+"\">"+
													race['car_one']['cars_model']+
												"</td>"+
												"<td>"+
													race['username_two']+
												"</td>"+
												"<td id=\"oc2_"+race['race_id']+"\">"+
													race['car_two']['cars_model']+
												"</td>"+
												"<td>"+
													race['race_bet_amount']+
												"</td>"+
												"<td>"+
													"<button id=\"see_race_button\" style=\"\" data-raceID=\""+ race['race_id'] +"\" class=\"ui-button ui-corner-all\"><span class=\" ui-icon ui-icon-flag\"></span>See Race</button>"+
												"</td>"+
											"</tr>";
						$( "#outgoing_msg" ).append(outgoing_html);
					}
					if (race['race_d1_et'] !== null && race['race_d2_et'] !== null){

						if( race['race_winner'] == race['race_driver_one']){
							var winner_one = true;
							var winner_two = false;
						}else if( race['race_winner'] == race['race_driver_two'] ){
							var winner_one = false;
							var winner_two = true;
						}

						if( race['race_driver_one'] == data['user_id'] ){
							var h_racer = race['username_two'];
							var car_1   = race['car_one']['cars_model'];
							var car_2   = race['car_two']['cars_model'];
							if( winner_one ) color = "#97d079"; else color = "#ff6e5e";
						}
						if( race['race_driver_two'] == data['user_id'] ){
							var car_2   = race['car_one']['cars_model'];
							var car_1   = race['car_two']['cars_model'];
							var h_racer = race['username_one'];

							if( winner_two ) color = "#97d079"; else color = "#ff6e5e";
						}
						var history_html = "<tr>"+
												"<td>"+
													race['race_id']+
												"</td>"+
												"<td id=\"hc1_"+race['race_id']+"\">"+
													car_1+
												"</td>"+
												"<td>"+
													h_racer+
												"</td>"+
												"<td id=\"hc2_"+race['race_id']+"\">"+
													car_2+
												"</td>"+
												"<td style=\"color: "+color+";\">"+
													race['race_bet_amount']+
												"</td>"+
												"<td>"+
													"<button id=\"see_race_button\" style=\"\" data-raceID=\""+ race['race_id'] +"\" class=\"ui-button ui-corner-all\"><span class=\" ui-icon ui-icon-flag\"></span>See Race</button>"+
												"</td>"+
											"</tr>";
						$( "#history_msg" ).append(history_html);
					}
				});

				$( "#pending_races_dialog" ).dialog( "open" );
			}
		});
});

$( "body" ).on( "click", "#start_reply_race", function(){
	race_id = $(this).attr("data-raceID");
	startRaceReply();
});

$( "body" ).on( "click", "#see_race_button", function(){
	var race_id = $(this).attr( "data-raceID" );
	$.post(site_root+'app/ajax-controllers/raceAjax.php', {
		action: "getRace",
		race_id: race_id
	}, function (data) {
		if( data['error'] === true ){
			dialogError("time_sheet", data['e_msg'], "Fail");

			return false;
		} else if ( data['error'] === false ){
			//dialogError("time_sheet", "The race was created", "Pass");

			var rt1 = data['race_info']['race_d1_rt'];
			var rt2 = data['race_info']['race_d2_rt'];
			var et1 = data['race_info']['race_d1_et'];
			var et2 = data['race_info']['race_d2_et'];
			var rtet1 = Number(rt1) + Number(et1);
			var rtet2 = Number(rt2) + Number(et2);
			var difference1  = rtet1 - rtet2;
			var difference2  = rtet2 - rtet1;

			if( data['race_info']['race_driver_one'] == data['race_info']['race_winner'] ){
				var winner = "ll_winner";
			}
			if( data['race_info']['race_driver_two'] == data['race_info']['race_winner']){
				var winner = "rl_winner";
			}
			if( et2 !== null ){
				$( "#ll_winner_margin").html(difference1.toFixed(3));
				$( "#rl_winner_margin").html(difference2.toFixed(3));
				$( "#" + winner).html("<h5>Winner!</h5>");
			}
			$( "#race_number" ).html(race_id);
			$( "#ll_spin_amt").html(data['race_info']['race_track_type']);

			userIDtUsername(data['race_info']['race_driver_one'], "ll_driver");
			userIDtUsername(data['race_info']['race_driver_two'], "rl_driver");
			$( "#ll_rt").html(data['race_info']['race_d1_rt']);
			$( "#rl_rt").html(data['race_info']['race_d2_rt']);
			$( "#ll_sixty").html(data['race_info']['race_d1_sixty']);
			$( "#rl_sixty").html(data['race_info']['race_d2_sixty']);
			$( "#ll_eighth").html(data['race_info']['race_d1_eighth']);
			$( "#rl_eighth").html(data['race_info']['race_d2_eighth']);
			$( "#ll_quarter").html(data['race_info']['race_d1_et']);
			$( "#rl_quarter").html(data['race_info']['race_d2_et']);
			$( "#ll_mph").html(data['race_info']['race_d1_trap']);
			$( "#rl_mph").html(data['race_info']['race_d2_trap']);


			$( "#bet_amount" ).html("$" + data['race_info']['race_bet_amount'])


			$("#time_sheet").dialog( "open" );
		}
		$("#time_sheet").dialog( "open" );
	});
});

function startRaceReply(){
	$.post(site_root+'app/ajax-controllers/userBarAjax.php', {
		action: "getCurrentCarStat"
	}, function (data) {
		if( data['error'] === true ){

			return false;
		} else if ( data['error'] === false ){
			var current_car_stats = data['current_car_stats'];
			var current_car_race  = data['current_race'];
			$( "#pending_races_dialog" ).dialog( "close" );
			race_id = race_id; estimateET = current_car_race['et']; estimateMPH = current_car_race['trap']; // Set race data
			startRaceAnimation();
		}
	});
}
