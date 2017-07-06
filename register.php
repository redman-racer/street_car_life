<?php
require 'app/config/globals.php';
$from_where_db = false;

if(isset($_POST['submit_register'])){
  echo"Register sumbited";
}

if(isset($_GET['fw'])){
  $from_where = $_GET['fw'];

  case "1111":
    $from_where_db = "facebook";
    $query = "INSERT INTO abandonedVehicles (inNumber) VALUES (:inNumber)";
    // Prepare Query
    $stmt = $conn->prepare($query);
    // Bind Parameters
    $stmt->bindParam(':inNumber', $inNumber, PDO::PARAM_STR);
    $stmt->execute();
  break;
}
?>
<html>
<?php include_once 'app/includes/header.php'; ?>
<body>
	<div id="Main_Container">
		<?php include_once 'app/includes/navigation.php'; ?>
    <div id="content">
        <div id="register_container">
    			<form method="POST" name="register" id="register" autocomplete="off" title="Register your account with Street Car Life" action="register.php" >
            <table style="margin: 0px auto;">
              <tr>
                <td>Username:</td>
                <td><input type="text" name="username" id="username" placeholder="Username" required /></td>
                <td>Email address</td>
                <td><input type="email" name="email" id="email" placeholder="email@streetcar.life" required /></td>
              </tr>
              <tr>
                <td>Password:</td>
                <td><input type="password" name="password" id="password" placeholder="Password" required /></td>
                <td>Verify Password:</td>
                <td><input type="password" name="password" id="password" placeholder="Password" required /></td>
              <tr>
              <tr>
                <td colspan="4" style="text-align: center;"><input type="submit" name="submit_register" id="submit_register" value="Register Now" /></td>
              </tr>
    			</form>
      </div>
    </div>
</div>
</body>
</html>
