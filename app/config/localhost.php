<?php
// Toggle between dev and live mode
if ($dev_mode) {
    //$SITE_ROOT = 'http://streetcarlife.local/';
    $SITE_ROOT = 'localhost/street_car_life/';
    $FILE_ROOT = 'C:/wamp64/www/street_car_life/';
    $CSS_ROOT = $SITE_ROOT ."assets/css/";
    $JS_ROOT = $SITE_ROOT ."assets/js/";
    $IMAGE_ROOT = $SITE_ROOT ."assets/images/";
    $server_name = "localhost";
    $server_username = "root";
    $server_password = "";
} else {
    $server_name = "localhost"; // TODO CHANGE TO LIVE SERVER INFO
    $server_username = "redman-racer";
    $server_password = "Mazdamiata91";
    // Set Paths
    $MAIN_ROOT = "";
    $SITE_ROOT = "";
    $JS_ROOT = "";
    $CSS_ROOT = "layout";
    $IMAGE_ROOT = "layout/images/";
}

define("SITE_ROOT", '//' . $_SERVER['HTTP_HOST'] . '/');
define("FILE_ROOT", $FILE_ROOT);
