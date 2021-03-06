<?php
require '../config/globals.php';

// Instantiate Race Functions
$race = new Race($conn);


// Get the players car stats an then send it to the race math function
if($players_car	  = $car->currentDrivenCar($user_info['id'])){
	$player_car_stats = $car->fetchCarStats($players_car['cars_id'], $user_info['id']);
	$results_player   = $race->raceMathStats($player_car_stats['cars_hp'], $player_car_stats['cars_weight']);

	$estimatedET  = $results_player['et'];
	$estimatedMPH = $results_player['trap'];
}else{
	echo"
		<script>
			alert(\"You need to be driving a car before you can enter the race scene.\")
			window.location = '".$SITE_ROOT."';
		</script>
	";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once '../includes/header.php'; ?>
<body>
<?php include_once '../includes/navigation.php'; ?>
<!-- new_race_dialog -->
<div id="new_race_dialog" title="Start a New Race">
		<div class="ui-widget" id="new_race_error" style="display: none;">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
				<strong id="new_race_passFail"></strong><span id="new_race_e_msg_dialog"></span></p>
				<div id="new_race_content_dialog"></div>
			</div>
		</div>
	<div id="new_race_tabs_container" >
		<ul>
		  <li><a href="#new_race_msg">Type</a></li>
		  <li><a href="#player_count_msg">Who</a></li>
		  <li><a href="#race_amount_msg">Amount</a></li>
		</ul>
	  <p class="validateTips" id="new_race_msg" style="text-align: center;">
		  Which type of race would you like to start?<br />
		  <button id="new_street_race_button" style="margin-right: 10px; margin-top: 15px; min-width: 50px; min-height: 50px;">
			  Street Race
			  <input type="radio" name="new_race_type" class="new_race_type" id="new_street_race_radio" value="street_race" />
		  </button>
		  <button id="new_track_race_button" style="margin-right: 10px; margin-top: 15px; min-width: 50px; min-height: 50px;">
			  Track Race
			  <input type="radio" name="new_race_type" class="new_race_type" id="new_track_race_radio" value="track_race" />
		  </button>
	  </p>
	  <p class="validateTips" id="player_count_msg" style="text-align: center; display: none;">
		Who do you want to race against?<br />
		<button id="computer_racer_button" style="margin-right: 10px; margin-top: 15px; min-width: 50px; min-height: 50px;">
			Computer
			<input type="radio" name="new_race_who" class="new_race_who" id="computer_racer_radio" value="computer" />
		</button>
		<button id="player_racer_button" style="margin-right: 10px; margin-top: 15px; min-width: 50px; min-height: 50px;">
			Real Player
			<input type="radio" name="new_race_who" class="new_race_who" id="player_racer_radio" value="player"/>
		</button>
		<button id="test_race_button" style="margin-right: 10px; margin-top: 15px; min-width: 50px; min-height: 50px;">
			Test Race
			<input type="radio" name="new_race_who" class="new_race_who" id="test_race_radio" value="test" />
		</button><br />
	  </p>
	  <p class="validateTips" id="race_amount_msg" style="text-align: center; display: none;">
		How much would you like to bet?<br />
		<input type="number" class="ui-state-default" style="height: 50px; font-size: 20px; margin-top: 15px; text-align: center;" id="race_amount" min="0" value="0" /><br />
		Race for pinks? <br />
		<label for="pinks1"> Yes</label>
		<input type="radio" name="pinks" class="pinks" id="pinks1" value="1">
		<label for="pinks"> No</label>
		<input type="radio" name="pinks" class="pinks" id="pinks" value="0" checked> <br />
	  </p>

	  <div class="ui-front" id="racerSearch" style="width: 100%; height: auto; text-align: center; margin-bottom: 15px; display: none;">
		  <input type="text" name="race_who_id" class="race_who_id ui-state-default" id="race_who_id" style="border-radius: 3px; min-width: 50px; min-height: 30px; font-size: 20px; position: relative; z-index: 105; text-align: center;" />
		  <button class="button" id="changeOpponent" style="display: none; margin-left: -6px; min-width: 40px; height: 30px; font-size: small; font-weight: bold;">Change Opponent</button>
	  </div>
	  <div id="computerSearch" style="width: 100%; height: auto; text-align: center; margin-bottom: 15px; display: none;">
		  <select id="race_computer_id" class="ui-state-default" style="border-radius: 3px; min-width: 50px; min-height: 30px; font-size: 20px; position: relative; z-index: 105;">
			  <option val="false" disabled selected>Please pick one</option>
		  </select>
	  </div>
  </div>
</div>
<!-- new_race_dialog -->
<!-- Blank Time Sheet -->
<div id="time_sheet" title="Street Car Life Drag Race">
	<div class="ui-widget" id="time_sheet_error" style="display: none;">
		<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
			<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
			<strong id="time_sheet_passFail"></strong><span id="time_sheet_e_msg_dialog"></span></p>
		</div>
	</div>

	<table id="time_sheet_container" style="width: 400px; text-align: center;">
		<th id="ts_header_row" class="pure-1-1" style="width: 100%;" colspan="3">
			<h1>Street Car Life</h1>
			<h7>Race #<span id="race_number"> </span> </h7>
		</th>
		<tr id="ts_lane_row" style="width: 100%;">
			<td id="descripter">

			</td>
			<td id="left_lane">
				<h5 style="text-align: center;">Left Lane</h5>
			</td>
			<td id="right_lane">
				<h5 style="text-align: center;">Right Lane</h5>
			</td>
		</tr>
		<tr id="ts_driver_row" style="width: 100%;">
			<td id="ts_driver" stlye="width: 33%; text-align: right;">
				<h5 style="text-align: right;">Driver</h5>
			</td>
			<td id="ll_driver" stlye="width: 33%; text-align: center;">

			</td>
			<td id="rl_driver" stlye="width: 33%; text-align: center;">

			</td>
		</tr>
		<tr id="ts_spin_amt_row" style="width: 100%; background-color: #F1F1F1;">
			<td id="ts_spin_amt" stlye="width: 33%; text-align: right;">
				<h5 style="text-align: right;">Spin Amount</h5>
			</td>
			<td id="ll_spin_amt" stlye="width: 33%; text-align: center;">

			</td>
			<td id="rl_spin_amt" stlye="width: 33%; text-align: center;">

			</td>
		</tr>
		<tr id="ts_rt_row" style="width: 100%;">
			<td id="ts_reaction" stlye="width: 33%; text-align: right;">
				<h5 style="text-align: right;">Reaction Time</h5>
			</td>
			<td id="ll_rt" stlye="width: 33%; text-align: center;">

			</td>
			<td id="rl_rt" stlye="width: 33%; text-align: center;">

			</td>
		</tr>
		<tr id="ts_sixty_row" style="width: 100%; background-color: #F1F1F1;">
			<td id="ts_sixty" stlye="width: 33%; text-align: right;">
				<h5 style="text-align: right;">60 ft time</h5>
			</td>
			<td id="ll_sixty" stlye="width: 33%; text-align: center;">

			</td>
			<td id="rl_sixty" stlye="width: 33%; text-align: center;">

			</td>
		</tr>
		<tr id="ts_eighth_row" style="width: 100%;">
			<td id="ts_eighth" stlye="width: 33%; text-align: right;">
				<h5 style="text-align: right;">1/8 Mile Time</h5>
			</td>
			<td id="ll_eighth" stlye="width: 33%; text-align: center;">

			</td>
			<td id="rl_eighth" stlye="width: 33%; text-align: center;">

			</td>
		</tr>
		<tr id="ts_quarter_row" style="width: 100%; background-color: #F1F1F1;">
			<td id="ts_quarter" stlye="width: 33%; text-align: right;">
				<h5 style="text-align: right;">1/4 Mile Time</h5>
			</td>
			<td id="ll_quarter" stlye="width: 33%; text-align: center;">

			</td>
			<td id="rl_quarter" stlye="width: 33%; text-align: center;">

			</td>
		</tr>
		<tr id="ts_mph_row" style="width: 100%;">
			<td id="ts_mph" stlye="width: 33%; text-align: right;">
				<h5 style="text-align: right;">1/4 Mile MPH</h5>
			</td>
			<td id="ll_mph" stlye="width: 33%; text-align: center;">

			</td>
			<td id="rl_mph" stlye="width: 33%; text-align: center;">

			</td>
		</tr>
		<tr id="ts_winner_row" style="width: 100%; background-color: #F1F1F1;">
			<td id="ts_winner" stlye="width: 33%; text-align: right;">

			</td>
			<td id="ll_winner" stlye="width: 33%; text-align: center;">

			</td>
			<td id="rl_winner" stlye="width: 33%; text-align: center;">

			</td>
		</tr>
		<tr id="ts_winner_margin_row" style="width: 100%;">
			<td id="ts_winner_margin" stlye="width: 33%; text-align: right;">
				<h5 style="text-align: right;">Win Margin</h5>
			</td>
			<td id="ll_winner_margin" stlye="width: 33%; text-align: center;">

			</td>
			<td id="rl_winner_margin" stlye="width: 33%; text-align: center;">

			</td>
		</tr>
		<tr id="ts_bet_amount_row" style="width: 100%; background-color: #F1F1F1;">
			<td id="ts_bet_amount" stlye="width: 33%; text-align: right;">
				<h5 style="text-align: right;">Bet Amount</h5>
			</td>
			<td id="bet_amount" colspan="2" stlye="width: 33%; text-align: center;">

			</td>
		</tr>
	</table>
</div>
<!-- Blank Time Sheet -->
<!-- Peding Races -->
<div id="pending_races_dialog" title="Pending Races">
	<div class="ui-widget" id="pending_races_error" style="display: none;">
		<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
			<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
			<strong id="pending_races_passFail"></strong><span id="pending_races_e_msg_dialog"></span></p>
		</div>
	</div>

	<!--Pending Messages tabs-->
	<div id="pending_races_tabs_container" style="font-size: 1em; font-align: center;">
		<ul>
		  <li><a href="#incoming_msg">Challenges</a></li>
		  <li><a href="#outgoing_msg">Sent Races</a></li>
		  <li><a href="#history_msg">Race History</a></li>
		</ul>
	  <table class="validateTips" id="incoming_msg" style="text-align: center; max-height: 600px; overflow: scroll;">
		  <tr>
			  <th style="width: 8.25%;">
				  Race ID
			  </th>
			  <th style="width: 18.5%;">
				  Your Car
			  </th>
			  <th style="width: 18.5%;">
				  Challenger
			  </th>
			  <th style="width: 18.5%;">
				  Challenger Car
			  </th>
			  <th style="width: 8.25%;">
				  Bet Amount
			  </th>
			  <th style="width: 18.5%;">
				  Open Time Slip
			  </th>
		  </tr>

	  </table>
	  <table class="validateTips" id="outgoing_msg" style="text-align: center; max-height: 600px; overflow: scroll; display: none;">
		  <tr>
			  <th style="width: 8.25%;">
				  Race ID
			  </th>
			  <th style="width: 18.5%;">
				  Your Car
			  </th>
			  <th style="width: 18.5%;">
				  Challenger
			  </th>
			  <th style="width: 18.5%;">
				  Challenger Car
			  </th>
			  <th style="width: 8.25%;">
				  Bet Amount
			  </th>
			  <th style="width: 18.5%;">
				  Open Time Slip
			  </th>
		  </tr>

	  </table>
	  <table class="validateTips" id="history_msg" style="text-align: center; max-height: 600px; overflow: scroll; display: none;">
		  <tr>
			  <th style="width: 8.25%;">
				  Race ID
			  </th>
			  <th style="width: 18.5%;">
				  Your Car
			  </th>
			  <th style="width: 18.5%;">
				  Challenger
			  </th>
			  <th style="width: 18.5%;">
				  Challenger Car
			  </th>
			  <th style="width: 8.25%;">
				  Bet Amount
			  </th>
			  <th style="width: 18.5%;">
				  Open Time Slip
			  </th>
		  </tr>
	  </table>
  </div>
  <!-- Peding Messages Tabs -->

</div>
<!-- Peding Races -->
<!-- Set Launch RPM -->
<div id="launch_rpm_dialog" title="Set Launch RPM">
	<div class="ui-widget" id="launch_rpm_error" style="display: none;">
		<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
			<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
			<strong id="launch_rpm_passFail"></strong><span id="launch_rpm_e_msg_dialog"></span></p>
		</div>
	</div>
  <p class="validateTips">Set your desired launch rpm.</p>

	<form>
		<fieldset>
	      <input type="number" name="launch_rpm" value="<?php echo $user_info['user_launch_rpm']; ?>" id="launch_rpm" class="text ui-widget-content ui-corner-all">
	      <!-- Allow form submission with keyboard without duplicating the dialog button -->
	      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
	  </fieldset>
	</form>
</div>
<!-- Set Launch RPM -->
<!-- Leaderboard -->
<div id="leaderboard_dialog" title="Pending Races">
	<div class="ui-widget" id="leaderboard_error" style="display: none;">
		<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
			<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
			<strong id="leaderboard_passFail"></strong><span id="leaderboard_e_msg_dialog"></span></p>
		</div>
	</div>

	<!--Pending Messages tabs-->
	<div id="leaderboard_tabs_container" style="font-size: 1em; margin: 0px auto; text-align: center;">
		<ul>
		  <li><a href="#fastest_et">Fastest ET</a></li>
		  <li><a href="#fastest_mph">Fastest MPH</a></li>
		  <li><a href="#most_races_won">Most Races Won</a></li>
		  <li><a href="#largest_bet">Largest Bet</a></li>
		  <li><a href="#recent_races">Most Recent Races</a></li>
		</ul>
	  <table class="validateTips" id="fastest_et" style="text-align: center; min-width: 400px; max-height: 600px; overflow: scroll;">
		  <tr style="border-top: 1px solid #dddfe2;">
			  <th style="width: 5%;">

			  </th>
			  <th style="width: 20%;">
				  Username
			  </th>
			  <th style="width: 15%;">
				  Car
			  </th>
			  <th style="width: 20%;">
				  Track Type
			  </th>
			  <th style="width: 20%;">
				  ET
			  </th>
			  <th style="width: 20%;">
				  MPH
			  </th>
		  </tr>
	  </table>
	  <table class="validateTips" id="fastest_mph" style="text-align: center; max-height: 600px; overflow: scroll;">
		  <tr>
			  <th style="width: 5%;">

			  </th>
			  <th style="width: 20%;">
				  Username
			  </th>
			  <th style="width: 15%;">
				  Car
			  </th>
			  <th style="width: 20%;">
				  Track Type
			  </th>
			  <th style="width: 20%;">
				  ET
			  </th>
			  <th style="width: 20%;">
				  MPH
			  </th>
		  </tr>
	  </table>
	  <table class="validateTips" id="most_races_won" style="text-align: center; max-height: 600px; overflow: scroll; display: none;">
		  <tr>
			  <th style="width: 10%;">

			  </th>
			  <th style="width: 45%;">
				  Username
			  </th>
			  <th style="width: 15%;">
				  Races Won
			  </th>
			  <th style="width: 15%;">
				  Races Lost
			  </th>
			  <th style="width: 15%;">
				  Total Races
			  </th>
		  </tr>
	  </table>
	  <table class="validateTips" id="largest_bet" style="text-align: center; max-height: 600px; overflow: scroll; display: none;">
		  <tr>
			  <th style="width: 10%;">

			  </th>
			  <th style="width: 10%;">
				  Race ID
			  </th>
			  <th style="width: 20%;">
				  Winner
			  </th>
			  <th style="width: 20%;">
				  Loser
			  </th>
			  <th style="width: 20%;">
				  Winning ET
			  </th>
			  <th style="width: 20%;">
				  Bet Amount
			  </th>
		  </tr>
	  </table>
	  <table class="validateTips" id="recent_races" style="text-align: center; max-height: 600px; overflow: scroll; display: none;">
		  <tr>
			  <th style="width: 20%;">
				  Race ID
			  </th>
			  <th style="width: 20%;">
				  Winner
			  </th>
			  <th style="width: 20%;">
				  Winning ET
			  </th>
			  <th style="width: 20%;">
				  Loser
			  </th>
			  <th style="width: 20%;">
				  Losing ET
			  </th>
		  </tr>
	  </table>
  </div>
  <!-- Peding Messages Tabs -->

</div>
<!-- Leaderboard -->
<!-- Race Scene -->
<div id="speedo_lights_out"
	style="
			-webkit-transform:scale(0.99);
			-moz-transform-scale(0.99);
			width:1920px;
			height:1080px;
			margin-left: -10px;
			background: url(<?php echo $IMAGE_ROOT; ?>race/race-scene/race_scene_background_lights_off2.jpg);
	">
		<div id="tach-container"
		style="
				width:1920px;
				height:1080px;
				overflow: hidden;
		">
				<div id="tach-needle"
					style="
							float: left;
							margin-top: 773px;
							margin-left: 780px;
							width: 373px;
							height: 10px;
							z-index: 50;
							position: relative;
						">
					<img src="<?php echo $IMAGE_ROOT; ?>race/race-scene/race_scene_tach_needle.png"  id="tach_needle_img" width="373px" height="10px" />
				</div>
				<div id="speedo-needle"
					style="
							float: left;
							margin-top: 795px;
							margin-left: -756px;
							width: 322px;
							height: 77px;
							z-index: 50;
							position: relative;
						">
					<img src="<?php echo $IMAGE_ROOT; ?>race/race-scene/race_scene_speedo_needle.png"  id="speedo_needle_img" width="322px" height="77px"
						style="
							opacity: 0.10;
							"/>
				</div>
				<div id="speedDisplay" style="
										float: left;
										margin-top: 668px;
										margin-left: -229px;
										width: 93px;
										height: 37px;
										overflow: hidden;
										font-family: speedomph;
										font-size: 32px;
										padding-top: 10px;
										color: #e9eff1;
										text-align:center;
										z-index: 50;
										position: relative;
										display: none;" > <span id="speedoNumber">0</span>
				</div>
				<div id="gearDisplay" style="
										float: left;
										margin-top: 841px;
										margin-left: -63px;
										width: 40px;
										height: 40px;
										overflow: hidden;
										font-family: speedomph;
										font-size: 32px;
										padding-top: 10px;
										color: #e9eff1;
										text-align:center;
										z-index: 50;
										position: relative;
										display: none;" > <span id="gearNumber">N</span>
				</div>
				<div id="tcsLight" style="
										float: left;
										margin-top: 823px;
										margin-left: -568px;
										width: 50px;
										height: 65px;
										overflow: hidden;
										z-index: 50;
										position: relative;
										display: none;" >
					<img src="<?php echo $IMAGE_ROOT; ?>race/race-scene/race_scene_tcs_light.png"  id="tcs_light_img" width="50px" height="65px" />
				</div>
				<div id="ui_menu_container"
					style="
							float: left;
							margin-top: 577px;
							margin-left: -379px;
							width: 391px;
							height: 327px;
							z-index: 100;
							position: relative;
							background: url(<?php echo $IMAGE_ROOT; ?>race/race-scene/menu-background.gif);
						">
						<div id="ui_menu_buttons_container"
							style="
									float: left;
									margin-top: 59px;
									margin-left: 57px;
									width: 290px;
									height: 269px;
									z-index: 110;
									background: url(<?php echo $IMAGE_ROOT; ?>race/race-scene/menu-buttons.png);
								">
								<div id="new_race"
									style="
										float: left;
										margin-top: 8px;
										margin-left: 19px;
										width: 120px;
										height: 120px;
										z-index: 110;
										cursor: pointer;
										">
								</div>
								<div id="set_launch"
									style="
										float: left;
										margin-top: 138px;
										margin-left: -120px;
										width: 120px;
										height: 120px;
										z-index: 110;
										cursor: pointer;
										">
								</div>
								<div id="pending_races"
									style="
										float: right;
										margin-top: 8px;
										margin-right: 19px;
										width: 120px;
										height: 120px;
										z-index: 110;
										cursor: pointer;
										">
								</div>
								<div id="open_leaderboards"
									style="
										float: right;
										margin-top: 8px;
										margin-right: 19px;
										width: 120px;
										height: 120px;
										z-index: 110;
										cursor: pointer;
										">
								</div>
						</div>
				</div>
				<!-- Any element positioned to the right of the tachometer display must be rendered last. margin-left cetner point is at 1162px, now;-->
				<div id="celLight" style="
										float: left;
										margin-top: 809px;
										margin-left: 143px;
										width: 52px;
										height: 51px;
										overflow: hidden;
										z-index: 50;
										position: relative;
										display: none;" >
					<img src="<?php echo $IMAGE_ROOT; ?>race/race-scene/race_scene_cel_light.png"  id="cel_light_img" width="52px" height="51px" />
				</div>
		</div>
		<div id="race_controls_container"
			style="
					float: left;
					width:1920px;
					height:1080px;
					overflow: hidden;
					z-index: 1;
					position: absolute;
					top: 0px;
					left: 0px;
					display: none;
				">

		</div>
		<div id="start_lights_container"
			style="
			float: left;
			width:1920px;
			height:1080px;
			overflow: hidden;
			z-index: 2;
			position: absolute;
			top: 0px;
			left: 0px;
			display: ;
			">
			<div id="gasPedal" style="
										-webkit-transform: scaleX(-1);
										transform: scaleX(-1);
										float: left;
										margin-top: 285px;
										margin-left: 20px;
										width: 566px;
										height: 154px;
										overflow: hidden;
										z-index: 200;
										position: relative;
										cursor: pointer;
										display: none;
									" >
				<img src="<?php echo $IMAGE_ROOT; ?>race/race-scene/gas-pedal.png"
					onmousedown="this.src='<?php echo $IMAGE_ROOT; ?>race/race-scene/gas-pedal-pressed.png'" onmouseup="this.src='<?php echo $IMAGE_ROOT; ?>race/race-scene/gas-pedal.png'"
					id="gasPedal_img"
					width="556px" height="154px"
					style="-khtml-user-select: none;
							-o-user-select: none;
							-moz-user-select: none;
							-webkit-user-select: none;
							user-select: none;
				" />
			</div>
			<div id="startLights" style="
										float: left;
										margin-top: 266px;
										margin-left: 130px;
										width: 650px;
										height: 175px;
										overflow: hidden;
										z-index: 200;
										position: relative;
										text-align: center;
										display: none;
									" >
									<!-- Green = #009933; -->
									<div id="light1" style="
															width: 165px;
															height: 165px;
															border-radius: 100px;
															border: 1px solid black;
															background-color: #ffff00;
															display: none;
															margin-right: 25px;
															float: left;
															">
									</div>
									<div id="light2" style="
															width: 165px;
															height: 165px;
															border-radius: 100px;
															border: 1px solid black;
															background-color: #ffff00;
															display: none;
															margin-right: 25px;
															float: left;
															">
									</div>
									<div id="light3" style="
															width: 165px;
															height: 165px;
															border-radius: 100px;
															border: 1px solid black;
															background-color: #ffff00;
															display: none;
															float: left;
															">
									</div>
			</div>
		</div>
</div>
<!-- Race Scene -->
</body>
<footer>

<script src="<?php echo $JS_ROOT; ?>all.js"></script>
<script src="<?php echo $JS_ROOT; ?>pagination.js?v=<?=time();?>"></script>
<script src="<?php echo $JS_ROOT; ?>race-scene-races.js?v=<?=time();?>"></script>
<script src="<?php echo $JS_ROOT; ?>race-scene-new-race.js?v=<?=time();?>"></script>
<script src="<?php echo $JS_ROOT; ?>race-scene-pending-races.js?v=<?=time();?>"></script>
<script src="<?php echo $JS_ROOT; ?>race-scene-leaderboard.js?v=<?=time();?>"></script>
<script src="<?php echo $JS_ROOT; ?>race-scene-launch_rpm.js?v=<?=time();?>"></script>

<script>

</script>
</footer>
</html>
