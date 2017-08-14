<?php
// Include Globals
require '../config/globals.php';

// Instantiate Parts Store
$part_store = new PartStore($conn);
?>
<html>
<head>
    <title><?php echo $page_title ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--JQuery UI CSS-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<!--Site CSS-->
    <link href="<?php echo $CSS_ROOT; ?>partstore.css?v=<?=time();?>" rel="stylesheet" type="text/css">

	<!--Include jquery-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!--Include site roots-->
	<script src="<?php echo$SITE_ROOT; ?>app/config/localhostJS.js"></script>
</head>
<body>
<div id="Main_Container" class="l-wrap">

	<div id="navigation" class="navigation">
	        <a href="<?php echo $SITE_ROOT; ?>"> Home </a>|
			<a href="<?php echo $SITE_ROOT; ?>street-race">Street Race </a>|
	        <a href="<?php echo $SITE_ROOT; ?>garage">My Garage </a>|
	        <a href="<?php echo $SITE_ROOT; ?>dealership">Dealership </a>|
	        <a href="<?php echo $SITE_ROOT; ?>part-store">Part Stores </a>|
	        <a href="<?php echo $SITE_ROOT; ?>logout"> Logout </a>|
	        <a href="<?php echo $SITE_ROOT; ?>register?ref=<?php echo $page; ?>"> Register </a>
	</div>

	<div id="logo" class="logo">
		<div class="col-3"> </div>

		<div id="userBar" class="col-3">
			Money: <?php	echo "<span style=\"color: #97d079;\">$".number_format($user_info['user_cash'], 2)."</span>"; ?>
			  |
			Car: <span id="navCurCar"><?php echo $users_car['cars_year']." ".$users_car['cars_make']." ".$users_car['cars_model']; ?></span>

	 		<div id="logoClickable" style="display: block; postion: fixed; width: 300px; height: 60px; cursor: pointer; margin: 50px auto;"> </div>
		</div>

		<div class="col-3"> </div>

	</div>
</div>
</body>
<footer>
<script>


</script>

<script src="<?php echo $JS_ROOT; ?>all.js"></script>
<script src="<?php echo $JS_ROOT; ?>part-store.js"></script>
</footer>
