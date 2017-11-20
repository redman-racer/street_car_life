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
				<div id="gasPedal" style="
											float: right;
										    margin-top: 266px;
										    margin-right: 0px;
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
						id="cel_light_img"
						width="556px" height="154px"
						style="-khtml-user-select: none;
								-o-user-select: none;
								-moz-user-select: none;
								-webkit-user-select: none;
								user-select: none;
					" />
				</div>
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
			<div id="startLights" style="
										float: left;
										margin-top: 266px;
										margin-left: 650px;
										width: 650px;
										height: 175px;
										overflow: hidden;
										z-index: 200;
										position: relative;
										cursor: pointer;
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

<!--Used for the speedo and mph animations-->
<input type="number" id="estimateET" style="display: none;" value="<?php echo $estimatedET; ?>" />
<input type="number" id="estimateMPH" style="display: none;" value="<?php echo $estimatedMPH; ?>" />
</body>
<footer>

<script src="<?php echo $JS_ROOT; ?>all.js"></script>
<script src="<?php echo $JS_ROOT; ?>race-scene-races.js?v=<?=time();?>"></script>
<script src="<?php echo $JS_ROOT; ?>race-scene-new-race.js?v=<?=time();?>"></script>
<script>

</script>
</footer>
</html>
