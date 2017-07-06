<?php
require 'app/config/globals.php';
?>
<html>
<?php include_once 'app/includes/header.php'; ?>
<body>
	<div id="Main_Container">
		<?php include_once 'app/includes/navigation.php'; ?>
	  <div id="content">
			<form method="POST" name="user_login" id="user_login" autocomplete="off" title="Login using your full name" action="login.php" >
				<!--USERNAME-->
				<div id="login-page-4">
					<input type="text" class="login_box" name="user_name" id="user_name" placeholder="Username" required />
				</div>
				<!--PASSWORD-->
				<div id="login-page-6">
					<input type="password" class="login_box" name="user_password" id="user_password" placeholder="Password" style="font-family: password;" required />
				</div>
				<!--GO-->
				<div id="login-page-7">
					<input type="image" src="<?= $IMAGE_ROOT?>login-page_7.jpg" alt="Login!" name="user_login_submit" id="user_login_submit" width="300" height="39" value="1" />
				</div>
			</form>
	  </div>
	</div>
</body>
</html>
