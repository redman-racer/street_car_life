<?php
// Session Start
session_start();
// Set Dev Mode
$dev_mode = true;
$user_info = null;
// Include Constants
require_once "localhost.php";


// Define and load Classes
function __autoload($class)
{
    // Include Classes
    require_once(FILE_ROOT . "/app/models/$class.php");
}

// Get Page Name
$page = basename($_SERVER['PHP_SELF']);//Gets the file name that is currently open;
// Create Database Connection
$conn = new PDO('mysql:host=localhost;dbname=street-car-life', $server_username, $server_password);
// Set Database Connection
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Instantiate User Class
$user = new User($conn);

// Instantiate Car Class
$car = new Car($conn);

// Instantiate Car Class
$tools = new Tools($conn);

// Check if user is logged in
if (isset($_SESSION["user_id"])) {
    // Fetch User Information
    $user_info = $user->fetchUser($_SESSION["user_id"]);

    //If the user already has a session stored and is on the index.php page, relocate them to the logged.php page;
    if ($page == "index.php") {
        // Redirect
        header('Location: ' . $SITE_ROOT . 'garage');
        // Exit Application
        exit();
    }

	// Money Donation
	if( $user_info['user_cash'] < 150 ){
		// Instantiate Money Functions
		$money = new Money($conn);

		$donation = $money->add($user_info['id'], $user_info['user_cash'], 150, $page);
	}
} else { //if they dont have a session started, relocate them to the index.php page;
    if ($page != "index.php" && $page != "login.php" && $page != "register.php" && $page != "registerAjax.php") { //checks to see if they are already on index.php;
        // Relocate User
        header('Location: ' . $SITE_ROOT . 'index');
        // Exit Application
        exit();
    }
}

//Layout Variables
$page_title = "Street Car Life: The Game"; //sets the <title> </title> of the page. To change it on a individual page, set this variable after-(require 'app/config/globals.php';)
