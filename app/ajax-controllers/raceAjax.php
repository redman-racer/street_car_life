<?php
// Include Globals
require '../config/globals.php';
// Define Header
header("Content-Type: application/json; charset=utf-8");

// Instantiate Car Model
$car = new Car($conn);
