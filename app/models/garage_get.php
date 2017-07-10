<?php
require '../config/globals.php';
require '../models/garage.php';


//BEGIN New Driving - Puts the user as driving the select car
if(isset($_GET["newDrivingID"])){
  //Exit user from ALL vehicles to make them not driving anything.
  $exitAllQ = "UPDATE users_cars SET `driving` = 0 WHERE owner=:owner_id";
  $exitAllQ  = $conn->prepare($exitAllQ);
  $exitAllQ->bindParam(':owner_id', $user_info['id'], PDO::PARAM_STR);
  $exitAllQ->execute();

  //puts the user into the selected car.
  $newDrivingQ = "UPDATE users_cars SET `driving` = 1 WHERE `id`=:newDrivingID AND `owner`=:owner_id";
  $newDriving  = $conn->prepare($newDrivingQ);
  $newDriving->bindParam(':newDrivingID', $_GET["newDrivingID"], PDO::PARAM_STR);
  $newDriving->bindParam(':owner_id', $user_info['id'], PDO::PARAM_STR);
  $newDriving->execute();
}
//END New Driving


//BEGIN Get all users cars
if(isset($_GET["allCars"])){
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
    $steering_wheel     = "display: none;";
    $ic_container_class = "ic_container_driving";
    $driving_id         = $garage_row['base_id'];
  }else{
    $ic_container_class = "ic_container";
    $selected_display   = "display: none;";
    $steering_wheel			= "";
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
  <div id="user_car" class="<?= $ic_container_class; ?>" data-id="<?php echo $garage_row['id']; ?>">
    <!--cars thumbnail image-->
    <img src="<?php echo $IMAGE_ROOT; ?>cars/garage/<?= $base_car['photo_folder']; ?>/street-car-life-<?= $base_car['year']; ?>-<?= $base_car['make']; ?>-<?= $base_car['model']; ?>-thumb.jpg" data-id="<?php echo $garage_row['id']; ?>" />
    <?php
    if($garage_row['driving']){
      $currentlySelectedID = $garage_row['id'];
      ?>
      <driving id="driving" data-id="<?php echo $garage_row['id']; ?>">DRIVING</driving>
    <?php
  }?>
  </div>
<?php
  }
 ?>
<currentlySelected data-id="<?php echo $currentlySelectedID; ?>"></currentlySelected>
<?php
}
//END Get User Cars


//BEGIN selected car display div - the large right div that displays the vehicles information
if(isset($_GET["load-id"])){
$loading_id = $_GET["load-id"];

//select users_cars that is currently being driven
$selected_stmt = $conn->prepare("SELECT * FROM  `users_cars` WHERE  `id`=:loading_id");
$selected_stmt->bindParam(':loading_id', $loading_id, PDO::PARAM_STR);
$selected_stmt->execute();
$selected = $selected_stmt->fetch();

//select base_car for year,make,model by base_id stored in users_cars
$base_selected_stmt = $conn->prepare("SELECT * FROM  `base_cars` WHERE  `id`=:base_id");
$base_selected_stmt->bindParam(':base_id', $selected['base_id'], PDO::PARAM_STR);
$base_selected_stmt->execute();
$base_selected = $base_selected_stmt->fetch();
?>
      <!--car image box-->
      <div id="car_container">
        <?php
        if(!$selected['driving']){?>
        <div id="newDriving" data-id="<?php echo $selected['id']; ?>">
          <img src="<?php echo $IMAGE_ROOT; ?>street-car-life-select-steeringwheel.png" width="55px" height="55" /><br />
          Start Driving
        </div><br />
        <?php } ?>
        <img src="<?php echo $IMAGE_ROOT; ?>cars/garage/<?= $base_selected['photo_folder']; ?>/street-car-life-<?= $base_selected['year']; ?>-<?= $base_selected['make']; ?>-<?= $base_selected['model']; ?>-large-front.png" />
      </div>
      <!--car stats box-->
      <div id="car_stats" style="width: 700; height: 300px; border: 2px solid #000; background-color: rgba(0, 0, 0, .8); position:absolute; top: 35px; left: 650px;">
        <table  style="width:100%; font-family: rootbear; font-size: 28px; color: #fff;">
          <tr>
            <td style="width:25%; text-align: right;">
              Horse Power
            </td>
            <td style="width:25%; text-align: center; color: #ff6e5e;">
              <?php echo $selected['hp']; ?>
            </td>
            <td style="width:25%; text-align: right;">
              lb/ft Torque
            </td>
            <td style="width:25%; text-align: center; color: #97d079;">
              <?php echo $selected['tq']; ?>
            </td>
          </tr>
          <tr>
            <td style="width:25%; text-align: right;">
              Handling
            </td>
            <td style="width:25%; height: 20px; text-align: center; border: 1px solid #fff; margin: 0px 5px 0px 5px; border-radius: 7px;">
              <div style="width: <?php echo stats($selected['handling']); ?>%; height: 100%; background-color: #fff;  border-radius: 5px;  color: #ff6e5e;"><?php echo $selected['handling']; ?> </div>
            </td>
            <td style="width:25%; text-align: right;">
              Braking
            </td>
            <td style="width:25%; height: 20px; text-align: center; border: 1px solid #fff; margin: 0px 5px 0px 5px; border-radius: 7px;">
              <div style="width: <?php echo stats($selected['braking']); ?>%; height: 100%; background-color: #fff; border-radius: 5px; color: #ff6e5e;"><?php echo $selected['braking']; ?></div>
            </td>
          </tr>
        </table>
      </div>
<!--END selected car display div-->
<?php
}



?>
