<?php
require 'app/config/globals.php';
?>
<html>
<?php include_once 'app/includes/header.php'; ?>
<body>
<div id="Main_Container">
  <div id="navigation">
    <div style="height:88px; margin-top:40px;">
      <a href="garage.php">My Garage  </a>|<a href="logout.php">  Logout</a>
    </div>
  </div>
  <div id="logo">
  </div>
  <div id="content">
    <?php
    $conn = new PDO('mysql:host=localhost;dbname=street_car_life', $server_username, $server_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $garage_stmt = $conn->prepare("SELECT * FROM  `users_cars` WHERE  `owner`=:owner_id");
    $garage_stmt->bindParam(':owner_id', $user_info["id"], PDO::PARAM_STR);
    $garage_stmt->execute();
    $garage_count = $garage_stmt->rowCount();
    while($garage_row = $garage_stmt->fetch()) {
      ?>
      <div class="uct_container">
        <img src="images/cars/street-car-life-miata-front-thumb.jpg" />
      </div>
      <?php  echo $garage_row["year"]." ".$garage_row["make"]." ".$garage_row["model"]."<br />
        The car makes ".$garage_row["hp"]."hp and ".$garage_row["tq"]."ft/lbs of torque, has a handling rating of ".$garage_row["handling"]."<br /><br />";
    }
     ?>
  </div>
</div>
</body>
</html>
