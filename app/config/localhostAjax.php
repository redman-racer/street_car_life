<?php
require 'globals.php';
// Define Header
header("Content-Type: application/json; charset=utf-8");

if ($dev_mode) {
    //$SITE_ROOT = 'http://streetcarlife.local/';
    $SITE_ROOT = 'http://localhost/street_car_life/';
    $FILE_ROOT = 'C:/wamp/www/street_car_life/';
    $CSS_ROOT = $SITE_ROOT ."source/css/";
    $JS_ROOT = $SITE_ROOT ."source/js/";
    $IMAGE_ROOT = $SITE_ROOT ."source/images/";
    $server_name = "localhost";
    $server_username = "root";
    $server_password = "";
} else {
    $server_name = "localhost"; // TODO CHANGE TO LIVE SERVER INFO
    $server_username = "redman-racer";
    $server_password = "Mazdamiata91";
    // Set Paths
    $SITE_ROOT = 'http://www.kundenforce.com/';
    $FILE_ROOT = '/home/redmanracer/public_html/';
    $CSS_ROOT = $SITE_ROOT ."source/css/";
    $JS_ROOT = $SITE_ROOT ."source/js/";
    $IMAGE_ROOT = $SITE_ROOT ."source/images/";
}

if ( $_POST['action'] == "siteRoot" ){
	echo json_encode( array( "SITE_ROOT" => $SITE_ROOT, "FILE_ROOT" => $FILE_ROOT, "CSS_ROOT" => $CSS_ROOT, "JS_ROOT" => $JS_ROOT, "IMAGE_ROOT" => $IMAGE_ROOT ) );
}
