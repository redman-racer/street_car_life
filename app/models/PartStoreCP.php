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
		$query = " UPDATE part_store SET ps_owner_id = :user_id WHERE ps_id = :store_id AND ps_sale_status = 1 ";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) {
				// Build Query to Delete User
				$query = " UPDATE part_store SET ps_sale_status = 0 WHERE ps_id = :store_id ";
				// Prepare Query
				$stmt = $this->conn->prepare($query);
				// Bind Parameters
				$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
				// Execute Query
				if ($stmt->execute()) return true;
				// Error
				else return false;
		}
		// Error
		else return false;
	}


	public function updateMSRP($store_id, $part_id, $new_msrp)
	{
		// Build Query to Delete User
		$query = " UPDATE part_template SET pt_msrp = :new_msrp WHERE pt_store_id = :store_id AND pt_id = :part_id ";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':new_msrp', $new_msrp, PDO::PARAM_INT);
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		$stmt->bindParam(':part_id', $part_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()){
			$this->updatePSValue($store_id);
			return true;
		 }
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
			$this->updatePSValue($store_id);
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


	public function updateSaleStatus($store_id, $status, $user_id)
	{
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


	public function updateQOH($part_id, $store_id, $new_qoh)
	{
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
			$this->updatePSValue($store_id);
			return true;
		}
		// Error
		else return false;
	}


	public function fetchInventory($store_id)
	{

		// Build Query to fetch all the cars of a user
		$query = "SELECT * FROM part_template WHERE pt_store_id = :store_id ORDER BY pt_id desc";
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

	public function updatePSValue($store_id)
	{
		$all_inventory = $this->fetchInventory($store_id);
		$totalValue = 0;

		foreach ($all_inventory as &$row) {
			$rowTotalVal = $row['pt_cost'] * $row['pt_qoh'];
			$totalValue  += $rowTotalVal;
		}

		// Add in the base price of a store
		$totalValue += 35000;

		// Build Query to Delete User
		$query = " UPDATE part_store SET ps_value = :new_value WHERE ps_id = :store_id ";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':new_value', $totalValue, PDO::PARAM_INT);
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) {
			return true;
		}
		// Error
		else return false;
	}

	public function fetchAllPartCreateTemplate()
	{
		// Build Query to fetch all the part create templates
		$query = "SELECT * FROM create_part ORDER BY cp_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$cpTemplate = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Return cars
		return $cpTemplate;
	}

	public function fetchPartCreateTemplate($template_id)
	{
		// Build Query to fetch all the part create templates
		$query = "SELECT * FROM create_part WHERE cp_id = :template_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':template_id', $template_id, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$cpTemplate = $stmt->fetch(PDO::FETCH_ASSOC);
		// Return cars
		return $cpTemplate;
	}

	public function createPart($store_id, $part_id, $user_id, $hp, $hp_limit, $reliability, $weight, $cog, $time_finished)
	{
		$np_template = $this->fetchPartCreateTemplate($part_id);
		$tq   = $hp * 0.85;
		$msrp = $cog * 2.35;

		// Build Query to Delete User
		$query = "INSERT INTO part_template (pt_cp_id, pt_store_id, pt_type, pt_sub_type, pt_name, pt_cost, pt_msrp, pt_hp, pt_tq, pt_weight, pt_hp_max, pt_reliability, pt_create_date)
		 							 VALUES (:pt_cp_id, :pt_store_id, :pt_type, :pt_sub_type, :pt_name, :pt_cost, :pt_msrp, :pt_hp, :pt_tq, :pt_weight, :pt_hp_max, :pt_reliability, :pt_create_date)"; //TODO make this function work
        // Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':pt_cp_id', $np_template['cp_id'], PDO::PARAM_INT);
		$stmt->bindParam(':pt_store_id', $store_id, PDO::PARAM_INT);
		$stmt->bindParam(':pt_type', $np_template['cp_type'], PDO::PARAM_INT);
		$stmt->bindParam(':pt_sub_type', $np_template['cp_sub_type'], PDO::PARAM_INT);
		$stmt->bindParam(':pt_name', $np_template['cp_sub_type'], PDO::PARAM_INT);
		$stmt->bindParam(':pt_cost', $cog, PDO::PARAM_INT);
		$stmt->bindParam(':pt_msrp', $msrp, PDO::PARAM_INT);
		$stmt->bindParam(':pt_hp', $hp, PDO::PARAM_INT);
		$stmt->bindParam(':pt_tq', $tq, PDO::PARAM_INT);
		$stmt->bindParam(':pt_weight', $weight, PDO::PARAM_INT);
		$stmt->bindParam(':pt_hp_max', $hp_limit, PDO::PARAM_INT);
		$stmt->bindParam(':pt_reliability', $reliability, PDO::PARAM_INT);
		$stmt->bindParam(':pt_create_date', $time_finished, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()){
			$this->updateStoreRD($store_id);
			return true;
		}
		// Error
		else return false;
	}

	public function updateStoreRD($store_id)
	{
		// Build Query to Delete User
		$query = " UPDATE part_store SET ps_rd_skill = ps_rd_skill + 0.5 WHERE ps_id = :store_id ";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) {
			return true;
		}
		// Error
		else return false;
	}
}
