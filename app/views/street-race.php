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
			<form method="POST" name="createRace" id="createRace" autocomplete="off" title="Create a street race" action="<?php echo $SITE_ROOT; ?>street-race" >
				<select id="raceWho">
					<?php
					foreach ($car->fetchAllCarTemplate() as $key => $value) {
					?>
						<option value="<?php echo $value['ct_id']; ?>">Race a <?php echo $value['ct_year']." ".$value['ct_make']." ".$value['ct_model']; ?></option>
					<?php
					}
					?>
				</select>
				<br />
				<input id="betAmount" type="number" placeholder="Enter Bet Amount" required /><br />
				<input id="start_tree" type="submit" value="Start Race" />
				<input id="launch" type="button" value="Launch" style="display: none;"/>
			</form>
			<div id="tree_container" style="width: 100%;">
				<div id="amber_1" style="background-color: yellow; width: 30px; height: 30px; border: 1px solid #000; border-radius: 30px; margin: 5px auto; display: none;"> </div>
				<div id="amber_2" style="background-color: yellow; width: 30px; height: 30px; border: 1px solid #000; border-radius: 30px; margin: 5px auto; display: none;"> </div>
				<div id="amber_3" style="background-color: yellow; width: 30px; height: 30px; border: 1px solid #000; border-radius: 30px; margin: 5px auto; display: none;"> </div>
				<div id="green" style="background-color: green; width: 30px; height: 30px; border: 1px solid #000; border-radius: 30px; margin: 5px auto; display: none;"> </div>
				<div id="red" style="background-color: red; width: 30px; height: 30px; border: 1px solid #000; border-radius: 30px; margin: 5px auto; display: none;"> </div>
			</div>
			<div id="results"> </div>
		</div>
	</div>
</div>
</body>
<footer>
<script src="<?php echo $JS_ROOT; ?>street-race.js?v=<?=time();?>"></script>
<script src="<?php echo $JS_ROOT; ?>all.js?v=<?=time();?>"></script>
</footer>
