<?php
require '../config/globals.php';
//User Login Form
if(isset($_POST['user_login_submit'])){

  $login_username = $_POST['user_name'];
  $login_password = $_POST['user_password'];

  $login_query = "SELECT * FROM users WHERE username = :username";
  $login_stmt = $conn->prepare($login_query);
  $login_stmt->bindParam(':username', $login_username, PDO::PARAM_STR);
  $login_stmt->execute();
  $verify_username = $login_stmt->rowCount();
  $login_user_info = $login_stmt->fetchObject();

  if($verify_username == 0){
        header("Location:". $SITE_ROOT ."index?e=no-username");
        exit();
  }

  //checking to see if the password matches the password on file
  if($login_user_info->password != $login_password){
        header("Location: ". $SITE_ROOT ."index?e=pw");
        exit();
  }

  //it matches, set the session.
  session_start();
  $_SESSION["user_id"] = $login_user_info->id;
  header("Location: ". $SITE_ROOT ."logged");
}
 ?>
