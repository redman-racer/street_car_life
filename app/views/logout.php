<?php
require '../config/globals.php';
session_unset();
session_destroy();
header("Refresh:0; url=index.php");
die();
?>
