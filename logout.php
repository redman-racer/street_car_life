<?php
require 'app/config/globals.php';
session_unset();
session_destroy();
header("Refresh:0; url=index.php");
die();
?>
<html>
<?php include_once 'app/includes/header.php'; ?>
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
