<?php
require '../config/globals.php';
require '../models/garage.php';

$sec = "5";
header("Refresh: $sec; url='garage'");
?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
<div id="Main_Container">
	<?php include_once '../includes/navigation.php'; ?>
  <div id="content">
		<!--BEGIN car select thumbnail div - The left collumn that holds the car thumbnails -->
    <div id="cs_container">
      <?php
      //Get list of vehicles owned by currenty user
      $garage_stmt = $conn->prepare("SELECT * FROM  `users_cars` WHERE  `owner`=:owner_id");
      $garage_stmt->bindParam(':owner_id', $user_info["id"], PDO::PARAM_STR);
      $garage_stmt->execute();
      //count our results
      $garage_count = $garage_stmt->rowCount();

      //loop through the results and display them
      while($garage_row = $garage_stmt->fetch()) {

        if($garage_row['driving']){
					$selected_display   = "";
          $ic_container_class = "ic_container_driving";
					$driving_id         = $garage_row['base_id'];
        }else{
          $ic_container_class = "ic_container";
					$selected_display   = "display: none;";
        }
        //select base_car for year,make,model by base_id stored in users_cars
        $base_car_stmt = $conn->prepare("SELECT * FROM  `base_cars` WHERE  `id`=:base_id");
        $base_car_stmt->bindParam(':base_id', $garage_row["base_id"], PDO::PARAM_STR);
        $base_car_stmt->execute();
        $base_car = $base_car_stmt->fetch();
        ?>

				<!--currently selected div-->
				<div id="selected_<?php echo $garage_row['id']; ?>" class="select_highlight" style="<?php echo $selected_display; ?>"></div>
				<!--div that contains the cars thumbnail image-->
        <div id="ic_container" class="<?= $ic_container_class; ?>">
					<!--cars thumbnail image-->
          <img src="<?php echo $IMAGE_ROOT; ?>cars/garage/<?= $base_car['photo_folder']; ?>/street-car-life-<?= $base_car['year']; ?>-<?= $base_car['make']; ?>-<?= $base_car['model']; ?>-thumb.jpg" />
          <?php
          if($garage_row['driving']){?>
            <driving>DRIVING</driving>
          <?php
        }
          ?>
        </div>
      <?php
        }
       ?>
    </div>
		<!--END car select thumbnail div-->
		<!--BEGIN selected car display div - the large right div that displays the vehicles information-->
		<?php
		//select base_car for year,make,model by base_id stored in users_cars
		$base_selected_stmt = $conn->prepare("SELECT * FROM  `base_cars` WHERE  `id`=:base_id");
		$base_selected_stmt->bindParam(':base_id', $driving_id, PDO::PARAM_STR);
		$base_selected_stmt->execute();
		$base_selected = $base_selected_stmt->fetch();

		//select users_cars that is currently being driven TODO make it so that the selected car is the one shown here
		$user_selected_stmt = $conn->prepare("SELECT * FROM  `users_cars` WHERE  `id`=:driving_id");
		$user_selected_stmt->bindParam(':driving_id', $driving_id, PDO::PARAM_STR);
		$user_selected_stmt->execute();
		$user_selected = $user_selected_stmt->fetch();
		?>
		<div id="cd_container">
					<!--car image box-->
					<div id="car_container"><img src="<?php echo $IMAGE_ROOT; ?>cars/garage/<?= $base_selected['photo_folder']; ?>/street-car-life-<?= $base_selected['year']; ?>-<?= $base_selected['make']; ?>-<?= $base_selected['model']; ?>-large-front.png" /></div>
					<!--car stats box-->
					<div id="car_stats" style="width: 700; height: 300px; border: 2px solid #000; background-color: rgba(0, 0, 0, .8); position:absolute; top: 35px; left: 650px;">
						<table  style="width:100%; font-family: rootbear; font-size: 28px; color: #fff;">
							<tr>
								<td style="width:25%; text-align: right;">
									Horse Power
								</td>
								<td style="width:25%; text-align: center; color: #ff6e5e;">
									<?php echo $user_selected['hp']; ?>
								</td>
								<td style="width:25%; text-align: right;">
									lb/ft Torque
								</td>
								<td style="width:25%; text-align: center; color: #97d079;">
									<?php echo $user_selected['tq']; ?>
								</td>
							</tr>
							<tr>
								<td style="width:25%; text-align: right;">
									Handling
								</td>
								<td style="width:25%; height: 20px; text-align: center; border: 1px solid #fff; margin: 0px 5px 0px 5px; border-radius: 7px;">
									<div style="width: <?php echo stats($user_selected['handling']); ?>%; height: 100%; background-color: #fff;  border-radius: 5px;  color: #ff6e5e;"><?php echo $user_selected['handling']; ?> </div>
								</td>
								<td style="width:25%; text-align: right;">
									Braking
								</td>
								<td style="width:25%; height: 20px; text-align: center; border: 1px solid #fff; margin: 0px 5px 0px 5px; border-radius: 7px;">
									<div style="width: <?php echo stats($user_selected['braking']); ?>%; height: 100%; background-color: #fff; border-radius: 5px; color: #ff6e5e;"><?php echo $user_selected['braking']; ?></div>
								</td>
							</tr>
						</table>
					</div>
		</div>
		<!--END selected car display div-->
	</div>
</div>
</body>
</html>
