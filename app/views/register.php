<?php
require '../config/globals.php';
$from_where_db = false;

//function for getting real IP address
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
//set the ip
$ip = getRealIpAddr();//end ip

if(isset($_POST['submit_register'])){
  echo"Register sumbited";
}
if(isset($_GET['ref'])){
          //convert ref code into readable date for db
          switch ($_GET['ref']){
            case "1111":
              $referral = "FB Button";
            break;
            default:
              $referral = $_GET['ref'];
            break;
          }
          $query = "INSERT INTO page_referrals (page_visited, referral, ip, user_id) VALUES (:page_visited, :referral, :ip, :user_id)";          $stmt = $conn->prepare($query);
          $stmt->bindParam(':page_visited', $page, PDO::PARAM_STR);
          $stmt->bindParam(':referral', $referral, PDO::PARAM_STR);
          $stmt->bindParam(':ip', $ip, PDO::PARAM_STR);
          $stmt->bindParam(':user_id', $user_info['id'], PDO::PARAM_STR);
          $stmt->execute();
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
