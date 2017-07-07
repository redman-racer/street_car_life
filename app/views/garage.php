<?php
require '../config/globals.php';
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
		?>
		<div id="cd_container">
					<div id="car_container"><img src="<?php echo $IMAGE_ROOT; ?>cars/garage/<?= $base_selected['photo_folder']; ?>/street-car-life-<?= $base_selected['year']; ?>-<?= $base_selected['make']; ?>-<?= $base_selected['model']; ?>-large-front.png" /></div>
					<div id="car_stats" style="width: 400; height: 470px; border: 1px solid #000; position:absolute; top: 100px; left: 650px;"> </div>
		</div>
		<!--END selected car display div-->
	</div>
</div>
</body>
</html>
