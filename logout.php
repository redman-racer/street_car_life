<?php
require 'models/globals.php';
session_unset();
session_destroy();
header("Refresh:0; url=index.php");
die();
?>
<html>
<head>
<title>The Street Car Life Game</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="layout/base.css?v=<?=time();?>" rel="stylesheet" type="text/css">
</head>
<body>
<div id="Main_Container">
  <div id="navigation">
  <a href="logout.php">Logout</a>
  </div>
  <div id="logo">
  </div>
  <div id="content" style="display:none;">
  This is some test content.
  </div>
</div>
</body>
</html>
