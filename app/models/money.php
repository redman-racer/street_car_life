<?php

class Money
{
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function subtract($user_id, $user_cash, $car_cost)
    {
		// Subtract the car cost from the users cash
		$user_cash = $user_cash - $car_cost;

		// Build Query to Delete User
		$query = "UPDATE users SET user_cash=:new_balance WHERE id=:user_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':new_balance', $user_cash, PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) return true;
		// Error
		else return false;
	}
}
