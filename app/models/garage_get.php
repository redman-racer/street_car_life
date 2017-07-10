<?php
require '../config/globals.php';
require '../models/garage.php';

/*<!--BEGIN selected car display div - the large right div that displays the vehicles information*/
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
      <div id="car_container"><img src="<?php echo $IMAGE_ROOT; ?>cars/garage/<?= $base_selected['photo_folder']; ?>/street-car-life-<?= $base_selected['year']; ?>-<?= $base_selected['make']; ?>-<?= $base_selected['model']; ?>-large-front.png" /></div>
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
