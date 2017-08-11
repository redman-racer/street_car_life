<?php
// Include Globals
require '../config/globals.php';

// Instantiate Parts Store
$part_store = new PartStore($conn);
?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
<!-- jQuery Dialog box-->
	<div id="buyPartStore" title="Buy Parts Store?">
		<div class="ui-widget" id="dialogError" style="display: none;">
			<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
				<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
				<strong>Alert:</strong> <br />
				Please enter a store name before continuing.</p>
			</div>
		</div>
	  <p>
		  <span class="ui-icon ui-icon-cart" style="float:left; margin:12px 12px 20px 0;"></span>This store is selling for <b><span style="color: red;">$<span id="bps_cost"></span></span></b>.
		  <br />Are you sure you want to buy it?

		  <form id="dialogForm" style="margin-left: 30px;">
		      <label for="name">Store Name</label><br />
		      <input type="text" name="store_name" id="store_name" placeholder="For Sale" class="text ui-widget-content ui-corner-all" >
		  </form>
	  </p>
	</div>

	<div id="noPartsAvailable" title="Empty Store">
	  <p>This parts store does not currently have anything in their store front.</p>
	</div>

<!-- jQuery Dialog Box-->

<div id="Main_Container">
    <?php include_once '../includes/navigation.php'; ?>
    <div id="content">
		<div id="generic_container" style="background: url(<?php echo $IMAGE_ROOT; ?>wichita-map.png);  background-size: 100% 100%;
    background-repeat: no-repeat;">
			<?php
			foreach ($part_store->fetchAllPartStores() as $key => $value) {
			?>
				<span id="part_store" class="mapIcon" data-id="<?php echo $value['ps_id']; ?>" style=" position: relative; float: right; top: <?php echo $value['ps_top_pos']; ?>%; left: <?php echo $value['ps_left_pos']; ?>%;">
					<img src="<?php echo $IMAGE_ROOT; ?>map_pin.png" /><b><span id="ps_name_<?php echo $value['ps_id']; ?>" data-value="<?php echo number_format($value['ps_value']); ?>"><?php echo $value['ps_name']; ?></span></b>
				</span>
				<br />
			<?php
			}
			?>
		</div>

		<!-- Start actual part store HTML-->
		<div id="partStore" style="display: none;">
			<!--BEGIN car selection div - the small column on the left that contains all cars owned by the user-->
	        <div id="cs_container">

	        </div>
			<!--END car selection -->


			<!--BEGIN selected car display div - the large right div that displays the vehicles information-->
			<div id="cd_container">
				<!--Large car image container-->
				<div id="car_container" width="600px" height="600px" style="width: 600px; height: 600px; margin: 35px 0px 0px 40px;">
					<!--Insert parts list here-->
				</div>
				<!--car stats box-->
				<div id="car_stats" style="display: none; width: 700; height: 300px; border: 2px solid #000; background-color: rgba(0, 0, 0, .8); position:absolute; top: 35px; left: 650px;">
					<table  style="width:100%; font-family: rootbear; font-size: 28px; color: #fff;">
						<!--First Row-->
						<tr>
							<td style="width:25%; text-align: right;">
								Horse Power
							</td>
							<td id="hp"  style="width:25%; text-align: center;">
								<!--Insert HP Here-->
							</td>
							<td style="width:25%; text-align: right;">
								lb/ft Torque
							</td>
							<td  id="tq" style="width:25%; text-align: center;">
								<!--Insert TQ Here-->
							</td>
						</tr>
						<!--Second Row-->
						<tr>
							<td style="width:25%; text-align: right;">
								Weight
							</td>
							<td id="weight" style="width:25%; text-align: center;">
							  <!--Insert Weight DIV here-->
							</td>
							<td style="width:25%; text-align: right;">
								Reliability
							</td>
							<td  id="reliability" style="width:25%; text-align: center;">
							  <!--Insert reliability DIV here-->
							</td>
						</tr>
						<!--Third Row-->
						<tr>
							<td style="width:25%; text-align: right;">
								Cost
							</td>
							<td id="msrp" style="width:25%; text-align: center; color: #ff6e5e;">
							  <!--Insert Cost DIV here-->
							</td>
							<td colspan="2" style="width:175px; text-align: center;">
								<button id="buyNow" data-id="0" data-storeid ="0" style="color: #ff6e5e; font-family: rootbear; font-size: 28px; width: 125px; height: 100%; background-color: #E5F8FF; border: 1px solid #000; border-radius: 5px; -webkit-box-shadow: 5px 5px 10px 0px rgba(0,0,0,0.5); -moz-box-shadow: 5px 5px 10px 0px rgba(0,0,0,0.5); box-shadow: 5px 5px 10px 0px rgba(0,0,0,0.5);">Buy Now </button>
							</td>
						</tr>
						<!--Fourth Row-->
						<tr style="display: none; ">
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
<script>


</script>

<script src="<?php echo $JS_ROOT; ?>all.js"></script>
<script src="<?php echo $JS_ROOT; ?>part-store.js"></script>
</footer>
