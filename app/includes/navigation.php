<div id="nav_container">
	<div id="navigation">
	    <div style="margin-top:40px;">
	        <div class="naviLink" style="display: inline-block;"><a href="<?php echo $SITE_ROOT; ?>"> Home </a>|</div>
			<div class="naviLink" style="display: inline-block;"><a href="<?php echo $SITE_ROOT; ?>street-race">Street Race </a>|</div>
			<div class="naviLink" style="display: inline-block;"><a href="<?php echo $SITE_ROOT; ?>race-scene">Race </a>|</div>
	        <div class="naviLink" style="display: inline-block;"><a href="<?php echo $SITE_ROOT; ?>garage">My Garage </a>|</div>
	        <div class="naviLink" style="display: inline-block;"><a href="<?php echo $SITE_ROOT; ?>dealership">Dealership </a>|</div>
	        <div class="naviLink" style="display: inline-block;"><a href="<?php echo $SITE_ROOT; ?>part-store">Part Stores </a>|</div>
	        <div class="naviLink" style="display: inline-block;"><a href="<?php echo $SITE_ROOT; ?>logout"> Logout </a>|</div>
	        <div class="naviLink" style="display: inline-block;"><a href="<?php echo $SITE_ROOT; ?>register?ref=<?php echo $page; ?>"> Register </a></div>
	    </div>
	</div>
	<div id="logo">
		<?php
		 if ($page != "index.php" && $page != "login.php" && $page != "register.php"){
			$users_car = $car->currentDrivenCar($user_info['id']);
		?>
		<div id="userBar" style="height: 35px; width: 100%; margin-top: 90px; position: fixed; text-align: center; margin: 5px auto; z-index: 105; color: #efefef; font-family: rootbear; font-size: 15px;">
			Money:
			<?php
			echo "<span style=\"color: #97d079;\">$".number_format($user_info['user_cash'], 2)."</span>";
			 ?>
			   | Car: <span id="navCurCar"><?php echo $users_car['cars_year']." ".$users_car['cars_make']." ".$users_car['cars_model']; ?></span>
		</div>
		<?php
		}
		?>
		<div id="logoClickable" style="display: block; width: 300px; height: auto; cursor: pointer; margin: 0px auto; padding-top: 110px;"> </div>
	</div>
</div>
