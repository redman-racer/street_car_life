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


	public function postForSale($store_id, $sale_amount, $user_id)
	{
		// Build Query to Delete User
		$query = " UPDATE part_store SET ps_sale_price = :sale_amount WHERE ps_id = :store_id AND ps_owner_id = :user_id ";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':sale_amount', $sale_amount, PDO::PARAM_INT);
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) {
			$this->updateSaleStatus($store_id, 1, $user_id);
			return true;
		}
		// Error
		else return false;
	}


	public function cancelForSale($store_id, $user_id)
	{
		// Build Query to Delete User
		$query = " UPDATE `part_store` SET `ps_sale_price` = '0' WHERE `ps_id` = :store_id AND `ps_owner_id` = :user_id ";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) {
			$this->updateSaleStatus($store_id, 0, $user_id);
			return true;
		}
		// Error
		else return false;
	}


	public function updateSaleStatus($store_id, $status, $user_id){
		// Build Query to Delete User
		$query = " UPDATE part_store SET ps_sale_status = :status WHERE ps_id = :store_id AND ps_owner_id = :user_id ";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':status', $status, PDO::PARAM_INT);
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) {
			return true;
		}
		// Error
		else return false;
	}


	public function updateQOH($part_id, $store_id, $new_qoh){
		// Build Query to Delete User
		$query = " UPDATE part_template SET pt_qoh = :new_qoh WHERE pt_store_id = :store_id AND pt_id = :part_id ";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':new_qoh', $new_qoh, PDO::PARAM_INT);
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		$stmt->bindParam(':part_id', $part_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) {
			return true;
		}
		// Error
		else return false;
	}


	public function fetchInventory($store_id)
	{

		// Build Query to fetch all the cars of a user
		$query = "SELECT * FROM part_template WHERE pt_store_id = :store_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Return cars
		return $inventory;
	}

}
