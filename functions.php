<?php
session_start();
$server_name     = "localhost";
$server_username = "redman-racer";
$server_password = "Mazdamiata91";
$server_dbname   = "street_car_life";
$page            = basename($_SERVER['PHP_SELF']);//Gets the file name that is currently open;
$conn            = new PDO('mysql:host=localhost;dbname=street_car_life', $server_username, $server_password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_SESSION["username"])) { //checks to see if the user already has a session started;
    $session_username = $_SESSION["username"]; //gets the sessions username;

    //Get User's information
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $session_username, PDO::PARAM_STR);
    $stmt->execute();
    $user_info = $stmt->fetch();//variable to use for getting users information (ie. $user_info['username']);
    //END Users information

    if($page == "index.php"){ //If the user already has a session stored and is on the index.php page, relocate them to the logged.php page;
      header("Refresh:0; url=logged.php");
    }
} else { //if they dont have a session started, relocate them to the index.php page;
  if($page != "index.php" && $page != "login.php"){ //checks to see if they are already on index.php;
    header("Refresh:0; url=index.php");
    die();
  }
}
?>
