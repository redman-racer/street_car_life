<?php

class Money
{
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

	public function getAllIGMCash()
	{
		// Build Query to Fetch Users
		$query = "SELECT SUM(user_cash) AS total_igm FROM users";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Execute Query
		if (!$stmt->execute()) return false;
		// Fetch Users
		$total_IGM_Cash = $stmt->Fetch(PDO::FETCH_ASSOC);

		return $total_IGM_Cash['total_igm'];
	}

    public function subtract($user_id, $user_cash, $subtracting, $page)
    {
		if( $user_cash <= $subtracting ){
			return false;
		}

		// Subtract the car cost from the users cash
		$new_user_cash = $user_cash - $subtracting;
		// Build Query to Delete User
		$query = "UPDATE users SET user_cash=:new_balance WHERE id=:user_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':new_balance', $new_user_cash, PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if ( $stmt->execute() ) {
			if ( $this->recordTransaction($user_id, $user_cash, $new_user_cash, $page) ){
				return true;
			} else return false;
		}
		// Error
		else return false;
	}

    public function add($user_id, $user_cash, $adding, $page)
    {
		// Subtract the car cost from the users cash
		$new_user_cash = $user_cash + $adding;

		// Build Query to Delete User
		$query = "UPDATE users SET user_cash=:new_balance WHERE id=:user_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':new_balance', $new_user_cash, PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) {
			$this->recordTransaction($user_id, $user_cash, $new_user_cash, $page);
			return true;
		}
		// Error
		else return false;
	}

    public function subtractTaxed($user_id, $user_cash, $subtracting, $page)
    {
		// Subtract the car cost from the users cash
		$new_user_cash = $user_cash - ($subtracting * 1.0725);

		if ( $user_cash <= $new_user_cash ){
			return false;
		}

		// Build Query to Delete User
		$query = "UPDATE users SET user_cash=:new_balance WHERE id=:user_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':new_balance', $new_user_cash, PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) {
			if ( $this->recordTransaction($user_id, $user_cash, $new_user_cash, $page) ){
				return true;
			} else return false;
		}
		// Error
		else return false;
	}

    public function addTaxed($user_id, $user_cash, $adding, $page)
    {
		// Subtract the car cost from the users cash
		$new_user_cash = $user_cash + ( $adding - ( $adding * 0.0725 ) );

		// Build Query to Delete User
		$query = "UPDATE users SET user_cash=:new_balance WHERE id=:user_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':new_balance', $new_user_cash, PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) {
			$this->recordTransaction($user_id, $user_cash, $new_user_cash, $page);
			return true;
		}
		// Error
		else return false;
	}

	public function recordTransaction($user_id, $old_amount, $new_amount, $page)
	{
		// Find the amount changed
		$amount_different = $new_amount - $old_amount;

		$query = "INSERT INTO money_transactions (mt_user_id, mt_old_amount, mt_new_amount, mt_amount_different, mt_page)
				 VALUES (:user_id, :old_amount, :new_amount, :amount_different, :page)"; //TODO make this function work
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->bindParam(':old_amount', $old_amount, PDO::PARAM_INT);
		$stmt->bindParam(':new_amount', $new_amount, PDO::PARAM_INT);
		$stmt->bindParam(':amount_different', $amount_different, PDO::PARAM_INT);
		$stmt->bindParam(':page', $page, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) return true;
		// Error
		else return false;
	}


}
