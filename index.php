<?php
require 'app/config/globals.php';
?>
<html>
<?php include_once 'app/includes/header.php'; ?>
<body>
<div id="Table_01">
	<!--BANNER/NAVIGATION-->
	<div id="login-page-1">
		<div id="navigation">
			<a href="register.php">Register </a>|<a href="index.php"> Login </a>|<a href="contact.php"> Contact Us</a> | Test:
		</div>
	</div>
	<div id="login-page-2">
		<img src="images/login-page_2.jpg" width="1891" height="191">
	</div>
	<div id="login-page-3">
		<img src="images/login-page_3.jpg" width="412" height="582">
	</div>

		<form method="POST" name="user_login" id="user_login" autocomplete="off" title="Login using your full name" action="login.php" >
			<!--USERNAME-->
			<div id="login-page-4">
				<input type="text" class="login_box" name="user_name" id="user_name" placeholder="Username" />
			</div>
			<div id="login-page-5">
				<img src="images/login-page_5.jpg" width="1179" height="582">
			</div>
			<!--PASSWORD-->
			<div id="login-page-6">
				<input type="password" class="login_box" name="user_password" id="user_password" placeholder="Password" style="font-family: password;" />
			</div>
			<!--GO-->
			<div id="login-page-7">
				<input type="image" src="images/login-page_7.jpg" alt="Login!" name="user_login_submit" id="user_login_submit" width="300" height="39" value="1" />
			</div>
		</form>

	<div id="login-page-8">
		<img src="images/login-page_8.jpg" width="300" height="425">
	</div>
</div>
</body>
</html>
