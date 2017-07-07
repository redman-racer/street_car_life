<?php
require '../config/globals.php';
$from_where_db = false;

if(isset($_POST['submit_register'])){
  echo"Register sumbited";
}

?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
	<div id="Main_Container">
		<?php include_once '../includes/navigation.php'; ?>
    <div id="content">
        <div id="register_container">
    			<form method="POST" name="register" id="register" autocomplete="off" title="Register your account with Street Car Life" action="<?php echo $SITE_ROOT; ?>register" >
            <table style="margin: 0px auto;">
              <tr>
                <td>Username:</td>
                <td><input type="text" name="username" id="username" placeholder="Username" required /></td>
                <td>Email address</td>
                <td><input type="email" name="email" id="email" placeholder="email@streetcar.life" required /></td>
              </tr>
              <tr>
                <td>Password:</td>
                <td><input type="password" name="password" id="password" placeholder="Password" required /></td>
                <td>Verify Password:</td>
                <td><input type="password" name="password" id="password" placeholder="Password" required /></td>
              <tr>
              <tr>
                <td colspan="4" style="text-align: center;"><input type="submit" name="submit_register" id="submit_register" value="Register Now" /></td>
              </tr>
    			</form>
      </div>
    </div>
</div>
</body>
</html>
