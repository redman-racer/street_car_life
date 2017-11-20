<?php
require '../config/globals.php';

$message = "";

if(isset($_POST['submit'])){
	$a = 0;
	$currentLastID = 20;
	$username = "Computer";
	$password = "k8dseeXdKrvctNWpx1bIz7iq3tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS";

	while ($a <= $_POST['number']) {

		if( $a <= $currentLastID ){
			//Do nothing
			$a++;
		}else{
		$a2 = $a - $currentLastID;
		$username = "Computer".$a2;
		$password = "k8dseeXdKrvctNWpx1bIz7iq3".$a."tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS";
		$email	  = "Computer@street-car-life.com";
		$user_cash = ($a-$currentLastID) * 350;
		$query = "INSERT INTO users (id, username, password, email, user_cash) VALUES (:id, :username, :password, :email, :user_cash)";
	    // Prepare Query
		$stmt = $conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':id', $a, PDO::PARAM_INT);
		$stmt->bindParam(':username', $username, PDO::PARAM_INT);
		$stmt->bindParam(':password', $password, PDO::PARAM_INT);
		$stmt->bindParam(':email', $email, PDO::PARAM_INT);
		$stmt->bindParam(':user_cash', $user_cash, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute())  $message = $message.true."<br />";
		// Error
		else  $message = $message.false."<br />";
		$a++;
		}
	}


	/*
	// Build Query to Delete User
	$query = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)"; //TODO make this function work
        // Prepare Query
	$stmt = $this->conn->prepare($query);
	// Bind Parameters
	$stmt->bindParam(':username', $user_name, PDO::PARAM_INT);
	$stmt->bindParam(':password', $password, PDO::PARAM_INT);
	$stmt->bindParam(':email', $email, PDO::PARAM_INT);
	// Execute Query
	if ($stmt->execute()) return true;
	// Error
	else return false;
	*/
}

?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
<?php include_once '../includes/navigation.php'; ?>
<!-- new_race_dialog -->
<div style="width: 95%; min-height: 40%; border-radius: 5px; background-color: #fff; margin: 240px auto; text-align: center;">
	<form action="#" method="post" >
		<input type="number" id="number" name="number" style="margin: 15px auto;" />
		<input type="submit" id="submit" name="submit" style="margin: 15px auto;" />
		<?php echo $message; ?>
	</form>
</div>
</body>
<footer>

<script src="<?php echo $JS_ROOT; ?>all.js"></script>
<script src="<?php echo $JS_ROOT; ?>race-scene-races.js?v=<?=time();?>"></script>
<script>

</script>
</footer>
</html>
