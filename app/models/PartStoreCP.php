<?php

class PartStoreCP
{
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

	public function changeOwner($store_id, $user_id)
	{
		// Build Query to Delete User
		$query = " UPDATE part_store SET ps_owner_id = :user_id WHERE ps_id = :store_id AND ps_name = 'For Sale' ";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) return true;
		// Error
		else return false;
	}


	public function changeName($store_id, $new_name, $user_id)
	{
		// Build Query to Delete User
		$query = " UPDATE part_store SET ps_name = :new_name WHERE ps_id = :store_id AND ps_owner_id = :user_id ";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':new_name', $new_name, PDO::PARAM_INT);
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) return true;
		// Error
		else return false;
	}


}
