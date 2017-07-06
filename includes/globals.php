<?php
	// Session Start
	session_start();
	// Set true if on localhost
	$dev_mode = true;

	// Dev Mode Activated
	if ($dev_mode){
		// Set ??? Path
		$dev_path = 'phoenixMechanic';
		// Set Error Messages
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	} else {
		// Set ??? Path
		$dev_path = '';
	}


	// Define Database
	define("DB_DATA_SOURCE", "mysql:host=localhost;dbname=carlproject");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "");

	// Define and load Classes
	function __autoload($class) {
		// Set Project Folder
		$folder = '/carlproject';
		// Include Classes
		require_once($_SERVER['DOCUMENT_ROOT'].$folder."/app/models/$class.php");
	}

	// Connect to Database
	$conn = ConnectionFactory::connect();

	// Include Global Functions
	include_once "functions.php";

	// Fetch user information if he's logged in
	if ( isset($_SESSION['cklprj_user']) ){
		// Build Query to load User Information
		$query = "SELECT * FROM users WHERE id=:user_id LIMIT 1";
		// Prepare Query
		$stmt = $conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':user_id', $_SESSION['cklprj_user'], PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) exit();
		// Fetch User Information
		$userinfo = $stmt->fetch(PDO::FETCH_ASSOC);
		// Set Logged in
		$logged_in = true;
	} else {
		$logged_in = false;
	}

	//$asset_root = $base . $dev_path . '/assets';
	//$lib_root = $_SERVER['DOCUMENT_ROOT'].$dev_path.'/lib/';
	$img_root = 'http://'.$_SERVER['HTTP_HOST'].'/'.$dev_path.'/assets/images/';

?>
