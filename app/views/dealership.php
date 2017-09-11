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
			<!--BEGIN car selection div - the small column on the left that contains all cars owned by the user-->
	        <div id="cs_container">

	        </div>
			<!--END car selection -->


			<!--BEGIN selected car display div - the large right div that displays the vehicles information-->
			<div id="cd_container">
				<!--Large car image container-->
				<div id="car_container">
				</div>
				<!--car stats box-->
				<div id="car_stats" class="stats_container">
					<table  style="width:100%; font-family: rootbear; font-size: 28px; color: #fff;">
						<tr>
							<td style="width:25%; text-align: right;">
								Horse Power
							</td>
							<td id="hp"  style="width:25%; text-align: center; color: #97d079;">
								<!--Insert HP Here-->
							</td>
							<td style="width:25%; text-align: right;">
								lb/ft Torque
							</td>
							<td  id="tq" style="width:25%; text-align: center; color: #ff6e5e;">
								<!--Insert TQ Here-->
							</td>
						</tr>
						<tr>
							<td style="width:25%; text-align: right;">
								Handling
							</td>
							<td id="handling" style="width:25%; height: 20px; text-align: center; border: 1px solid #fff; margin: 0px 5px 0px 5px; border-radius: 7px;">
							  <!--Insert Handling DIV here-->
							</td>
							<td style="width:25%; text-align: right;">
								Braking
							</td>
							<td  id="braking" style="width:25%; height: 20px; text-align: center; border: 1px solid #fff; margin: 0px 5px 0px 5px; border-radius: 7px;">
							  <!--Insert Brakign DIV here-->
							</td>
						</tr>
					</table>
			  </div>
			</div>
			<!--END selected car display div -->
	    </div>

		</div>
	</div>
</body>
<footer>
<script src="<?php echo $JS_ROOT; ?>dealership.js?v=<?=time();?>"></script>
<script src="<?php echo $JS_ROOT; ?>all.js?v=<?=time();?>"></script>
</footer>
