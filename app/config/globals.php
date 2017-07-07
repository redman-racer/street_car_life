<?php
// Session Start
session_start();
// Set Dev Mode
$dev_mode = true;

// Include Constants
require_once "localhost.php";

// Define and load Classes
function __autoload($class) {
    // Set Project Folder
    $folder = 'street_car_life';
    // Include Classes
    require_once(FILE_ROOT ."/app/models/$class.php");
}

// Get Page Name
$page = basename($_SERVER['PHP_SELF']);//Gets the file name that is currently open;
// Create Database Connection
$conn = new PDO('mysql:host=localhost;dbname=street_car_life', $server_username, $server_password);
// Set Database Connection
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo $page;

// Instantiate User Class
$user = new User($conn);

// Check if user is logged in
if (isset($_SESSION["username"])) {
    // Fetch User Information
    $user_info = $user->fetchByUser($_SESSION["username"]);

    //If the user already has a session stored and is on the index.php page, relocate them to the logged.php page;
    if ($page == "index.php"){
        // Redirect
        header("Location: '. $SITE_ROOT .'logged");
        // Exit Application
        exit();
    }
} else { //if they dont have a session started, relocate them to the index.php page;
    if ($page != "index.php" && $page != "login.php" && $page != "register.php") { //checks to see if they are already on index.php;
        // Relocate User
        header('Location: '. $SITE_ROOT .'index');
        // Exit Application
        exit();
    }
}

//Layout Variables
$page_title = "Street Car Life: The Game"; //sets the <title> </title> of the page. To change it on a individual page, set this variable after-(require 'app/config/globals.php';)
