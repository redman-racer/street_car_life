<div id="navigation">
    <div style="height:88px; margin-top:40px;">
        <a href="<?php echo $SITE_ROOT; ?>"> Home </a>|
		<a href="<?php echo $SITE_ROOT; ?>street-race">Street Race </a>|
        <a href="<?php echo $SITE_ROOT; ?>garage">My Garage </a>|
        <a href="<?php echo $SITE_ROOT; ?>dealership">Dealership </a>|
        <a href="<?php echo $SITE_ROOT; ?>part-store">Part Stores </a>|
        <a href="<?php echo $SITE_ROOT; ?>logout"> Logout </a>|
        <a href="<?php echo $SITE_ROOT; ?>register?ref=<?php echo $page; ?>"> Register </a>
    </div>
</div>
<div id="logo">
</div>
<?php
 if ($page != "index.php" && $page != "login.php" && $page != "register.php"){
	$users_car = $car->currentDrivenCar($user_info['id']);
?>
<div id="userBar" style="height: 35px; width: 100%; top: 90px; position: fixed; text-align: center; margin: 5px auto; z-index: 105; color: #efefef; font-family: rootbear; font-size: 15px;">
	Money:
	<?php
	echo "<span style=\"color: #97d079;\">$".number_format($user_info['user_cash'], 2)."</span>";
	 ?>
	   | Car: <span id="navCurCar"><?php echo $users_car['cars_year']." ".$users_car['cars_make']." ".$users_car['cars_model']; ?></span>
</div>
<?php
}
?>
