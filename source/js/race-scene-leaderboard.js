$( "#leaderboard_tabs_container" ).tabs();

$( "#leaderboard_dialog" ).dialog({
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
			  $( "#leaderboard_dialog" ).dialog( "close" );
			}
	},
	close: function() {
		var mphAndET_html = "<tr>"+
								"<th style=\"width: 20%;\">"+
									"Username"+
								"</th>"+
								"<th style=\"width: 20%;\">"+
									"Car"+
								"</th>"+
								"<th style=\"width: 20%;\">"+
									"Track Type"+
								"</th>"+
								"<th style=\"width: 20%;\">"+
									"ET"+
								"</th>"+
								"<th style=\"width: 20%;\">"+
									"MPH"+
								"</th>"+
							"</tr>";
		$("#fastest_et").html(mphAndET_html);
		$("#fastest_mph").html(mphAndET_html);
		$("#most_races_won").html(	"<tr>"+
										"<th style=\"width: 25%;\">"+
											"Username"+
										"</th>"+
										"<th style=\"width: 25%;\">"+
											"Races Won"+
										"</th>"+
										"<th style=\"width: 25%;\">"+
											"Races Lost"+
										"</th>"+
										"<th style=\"width: 25%;\">"+
											"Total Races"+
										"</th>"+
									"</tr>");
		$("#largest_bet").html(	"<tr>"+
									"<th style=\"width: 20%;\">"+
										"Race ID"+
									"</th>"+
									"<th style=\"width: 20%;\">"+
										"Winner"+
									"</th>"+
									"<th style=\"width: 20%;\">"+
										"Loser"+
									"</th>"+
									"<th style=\"width: 20%;\">"+
										"Winning ET"+
									"</th>"+
									"<th style=\"width: 20%;\">"+
										"Bet Amount"+
									"</th>"+
								"</tr>");
		$("#recent_races").html(	"<tr>"+
										"<th style=\"width: 20%;\">"+
										"Race ID"+
										"</th>"+
										"<th style=\"width: 20%;\">"+
										"Winner"+
										"</th>"+
										"<th style=\"width: 20%;\">"+
										"Winning ET"+
										"</th>"+
										"<th style=\"width: 20%;\">"+
										"Loser"+
										"</th>"+
										"<th style=\"width: 20%;\">"+
										"Losing ET"+
										"</th>"+
									"</tr>");
	}
});

$( "#open_leaderboards" ).on( "click", function(){

	$.post(site_root+'app/ajax-controllers/pendingRacesAjax.php', {
			action: "getLeaderboards"
		}, function (data) {
			if( data['error'] === true ){
				dialogError("pending_races", data['e_msg'], "Fail");
				$( "#leaderboard_dialog" ).dialog( "open" );

				return false;
			} else if ( data['error'] === false ){
				$("#leaderboard_dialog").dialog("open");


				var et_count = 0;
				for( race_id in data['fastest_et']){

					if( data['fastest_et'][race_id]['fastest_et'] == data['fastest_et'][race_id]['race_d1_et']){
						et_username = data['fastest_et'][race_id]['username_one'];
						et_car = data['fastest_et'][race_id]['race_d1_car'];
						et_et = Number(data['fastest_et'][race_id]['race_d1_et']).toFixed(3);
						et_mph = Number(data['fastest_et'][race_id]['race_d1_trap']).toFixed(0);
					}
					if( data['fastest_et'][race_id]['fastest_et'] == data['fastest_et'][race_id]['race_d2_et']){
						et_username = data['fastest_et'][race_id]['username_two'];
						et_car = data['fastest_et'][race_id]['race_d2_car'];
						et_et = Number(data['fastest_et'][race_id]['race_d2_et']).toFixed(3);
						et_mph = Number(data['fastest_et'][race_id]['race_d2_trap']).toFixed(0);

					}

					var left_et_count = et_count + 1;
					var fastest_et ="<tr style=\"border-top: 1px solid #dddfe2;\" >"+
										"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
											left_et_count +
										"</td>"+
										"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
											et_username+
										"</td>"+
										"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
											et_car+
										"</td>"+
										"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
											data['fastest_et'][race_id]['race_track_type'].replace("_race", "")+
										"</td>"+
										"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
											et_et+
										"</td>"+
										"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
											et_mph+
										"</td>"+
									"</tr>";
					$( "#fastest_et" ).append(fastest_et);

					et_count++;
				}

				var mph_count = 0;
				for( race_id2 in data['fastest_mph']){
					if( data['fastest_mph'][race_id2]['fastest_trap'] == data['fastest_mph'][race_id2]['race_d1_trap']){
						mph_username = data['fastest_mph'][race_id2]['username_one'];
						mph_car = data['fastest_mph'][race_id2]['race_d1_car'];
						mph_et = Number(data['fastest_mph'][race_id2]['race_d1_et']).toFixed(3);
						mph_mph = Number(data['fastest_mph'][race_id2]['race_d1_trap']).toFixed(0);
					}
					if( data['fastest_mph'][race_id2]['fastest_trap'] == data['fastest_mph'][race_id2]['race_d2_trap']){
						mph_username = data['fastest_mph'][race_id2]['username_two'];
						mph_car = data['fastest_mph'][race_id2]['race_d2_car'];
						mph_et = Number(data['fastest_mph'][race_id2]['race_d2_et']).toFixed(3);
						mph_mph = Number(data['fastest_mph'][race_id2]['race_d2_trap']).toFixed(0);

					}

					var left_mph_count = mph_count + 1;
					var fastest_mph ="<tr style=\"border-top: 1px solid #dddfe2;\" >"+
										"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
											left_mph_count +
										"</td>"+
										"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
											mph_username+
										"</td>"+
										"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
											mph_car+
										"</td>"+
										"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
											data['fastest_mph'][race_id2]['race_track_type'].replace("_race", "")+
										"</td>"+
										"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
											mph_et+
										"</td>"+
										"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
											mph_mph+
										"</td>"+
									"</tr>";
					$( "#fastest_mph" ).append(fastest_mph);
					mph_count++;
				}

				var wins_count = 0;
				for( race_id3 in data['most_wins']){
					var row_count = wins_count + 1;
					var total_races = data['most_wins'][race_id3]['total_wins'] + data['most_wins'][race_id3]['total_lost'];
					var races_won_html = 	"<tr>"+
												"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
													row_count+
												"</td>"+
												"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
													data['most_wins'][race_id3]['username']+
												"</td>"+
												"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
													data['most_wins'][race_id3]['total_wins']+
												"</td>"+
												"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
													data['most_wins'][race_id3]['total_lost']+
												"</td>"+
												"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
													total_races+
												"</td>"+
											"</tr>";
					$( "#most_races_won" ).append(races_won_html);
					wins_count++;
				}

				var bet_count = 0;
				for( race_id4 in data['largest_bet']){
					var row_count4 = bet_count + 1;


					/*Check to see if username_one is winner*/
					if(data['largest_bet'][race_id4]['race_d1_et'] == data['largest_bet'][race_id4]['fastest_et']){
						var winner = data['largest_bet'][race_id4]['username_one'];
						var win_et = data['largest_bet'][race_id4]['race_d1_et'];
						var loser  = data['largest_bet'][race_id4]['username_two'];
					}

					/*Check to see if username_two is winner*/
					if(data['largest_bet'][race_id4]['race_d2_et'] == data['largest_bet'][race_id4]['fastest_et']){
						var winner = data['largest_bet'][race_id4]['username_two'];
						var win_et = data['largest_bet'][race_id4]['race_d2_et'];
						var loser  = data['largest_bet'][race_id4]['username_one'];

					}

					// Build the html
					var largest_bet_html = 	"<tr>"+
												"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
													row_count4+
												"</td>"+
												"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
													data['largest_bet'][race_id4]['race_id']+
												"</td>"+
												"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
													winner+
												"</td>"+
												"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
													loser+
												"</td>"+
												"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
													win_et+
												"</td>"+
												"<td style=\"padding: 20px; border-top: 1px solid #dddfe2;\">"+
													"$"+data['largest_bet'][race_id4]['race_bet_amount']+
												"</td>"+
											"</tr>";
					$( "#largest_bet" ).append(largest_bet_html);
					bet_count++;
				}


			}
	});
});
