<?php
// Session Start
session_start();
// Set Dev Mode
$dev_mode = true;

// Toggle between dev and live mode
if ($dev_mode) {
    $server_name = "localhost";
    $server_username = "root";
    $server_password = "";
} else {
    $server_name = "localhost"; // TODO CHANGE TO LIVE SERVER INFO
    $server_username = "redman-racer";
    $server_password = "Mazdamiata91";
}

// Define and load Classes
function __autoload($class) {
    // Set Project Folder
    $folder = '/street_car_life';
    // Include Classes
    require_once($_SERVER['DOCUMENT_ROOT'].$folder."/app/models/$class.php");
}

// Get Page Name
$page = basename($_SERVER['PHP_SELF']);//Gets the file name that is currently open;
// Create Database Connection
$conn = new PDO('mysql:host=localhost;dbname=street_car_life', $server_username, $server_password);
// Set Database Connection
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Instantiate User Class
$user = new User($conn);

// Check if user is logged in
if (isset($_SESSION["username"])) {
    // Fetch User Information
    $user_info = $user->fetchByUser($_SESSION["username"]);

    //If the user already has a session stored and is on the index.php page, relocate them to the logged.php page;
    if ($page == "index.php"){
        // Redirect
        header("Location: logged.php");
        // Exit Application
        exit();
    }
} else { //if they dont have a session started, relocate them to the index.php page;
    if ($page != "index.php" && $page != "login.php") { //checks to see if they are already on index.php;
        // Relocate User
        header('Location: index.php');
        // Exit Application
        exit();
    }
}

// Set Paths
$MAIN_ROOT = "";
$SITE_ROOT = "";
$JS_ROOT = "";
$CSS_ROOT = "";
$IMAGE_ROOT = "";

