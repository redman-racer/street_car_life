<?php
require '../config/globals.php';
?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
<div id="Main_Container">
	<?php include_once '../includes/navigation.php'; ?>
  <div id="content">
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
        if(isset($garage_row['driving'])){
          $ic_container_class = "ic_container_driving";
        }else{
          $ic_container_class = "ic_container";
        }
        //select base_car for year,make,model by base_id stored in users_cars
        $base_car_stmt = $conn->prepare("SELECT * FROM  `base_cars` WHERE  `id`=:base_id");
        $base_car_stmt->bindParam(':base_id', $garage_row["base_id"], PDO::PARAM_STR);
        $base_car_stmt->execute();
        $base_car = $base_car_stmt->fetch();
        ?>
        <div id="ic_container" class="<?= $ic_container_class; ?>">
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
  </div>
</div>
</body>
</html>
