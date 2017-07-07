<?php
// Toggle between dev and live mode
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
    $SITE_ROOT = 'http://kundenforce.com/';
    $FILE_ROOT = "";
    $CSS_ROOT = $SITE_ROOT ."source/css/";
    $JS_ROOT = $SITE_ROOT ."source/js/";
    $IMAGE_ROOT = $SITE_ROOT ."source/images/";
}

define("SITE_ROOT", '//' . $_SERVER['HTTP_HOST'] . '/');
define("FILE_ROOT", $FILE_ROOT);
