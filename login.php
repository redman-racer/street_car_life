<?php
require 'app/config/globals.php';
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
    header("Refresh:0; url=index.php?e=no-username");
    exit();
  }
  //checking to see if the password matches the password on file
  if($login_user_info->password != $login_password){
        header("Refresh:0; url=index.php?e=pw");
        exit();
  }

  //it matches, set the cookie.
  session_start();
  $_SESSION["username"] = $login_user_info->username;
  header("Refresh:0; url=logged.php");
}
 ?>
 <html>
 <?php include_once 'app/includes/header.php'; ?>
 <body>
 <div id="Main_Container">
   <div id="navigation">
   <a href="logout.php">Logout</a>
   </div>
   <div id="logo">
   </div>
   <div id="content" style="display:none;">
   This is some test content.
   </div>
 </div>
 </body>
 </html>
