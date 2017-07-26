<?php
// Include Globals
require '../config/globals.php';
// Define Header
header("Content-Type: application/json; charset=utf-8");
//TODO create ajax handler for the register page.

if ( $_POST['action'] == "newRegister"){

	// Gather all users to check email and username against
	$allUsers = $user->fetchUsers();

	foreach ($allUsers as $key => $value) {
		if (strtolower($value['username']) == strtolower($_POST['username'])){
			echo json_encode(array("error" => true, "eMessage" => "This username has already been taken."));
			return false;
		}
		if (strtolower($value['email']) == strtolower($_POST['email'])){
			echo json_encode(array("error" => true, "eMessage" => "This email has already been taken, click here to have the user information emailed to you."));
			return false;
		}
	}
	if($user->createUser($_POST['username'], $_POST['password'], $_POST['email'])){
		// Return
		echo json_encode(array("error" => false, "eMessage" => "User: ".$_POST['username']." was created."));
	}else{
		echo json_encode(array("error" => true, "eMessage" => "There was an error creating the user. Error Code: rAphpL27"));
	}
}
