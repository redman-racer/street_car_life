<?php

class PartStore
{
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

	// Fetch all of the stores available
	public function fetchAllPartStores()
	{
		// Build Query to fetch all the cars of a user
		$query = "SELECT * FROM part_store";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch part_stores
		$part_stores = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Return part stores
		return $part_stores;
	}

	// Fetch all of the stores available
	public function fetchPartStore($store_id)
	{
		// Build Query to fetch all the cars of a user
		$query = "SELECT * FROM part_store WHERE ps_id = :store_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Part Store
		$part_store = $stmt->fetch(PDO::FETCH_ASSOC);
		// Return Part Store
		return $part_store;
	}

	// Fetch parts available at a specific Parts Store
	public function fetchAllParts($store_id)
	{
		// Build Query to fetch all the cars of a user
		$query = "SELECT DISTINCT pt_type FROM part_template WHERE pt_store_id = :store_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$parts_available = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Return cars
		return $parts_available;
	}


	// Fetch parts available at a specific Parts Store
	public function fetchPartType($part_type, $store_id)
	{
		// Build Query to fetch all the cars of a user
		$query = "SELECT * FROM part_template WHERE pt_store_id = :store_id AND pt_type = :part_type ORDER BY pt_hp ASC";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		$stmt->bindParam(':part_type', $part_type, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$parts = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Return cars
		return $parts;
	}

	// Fetch one part by store_id and part_id
	public function fetchPart($part_id, $store_id)
	{
		// Build Query to fetch all the cars of a user
		$query = "SELECT * FROM part_template WHERE pt_id = :part_id AND pt_store_id = :store_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':part_id', $part_id, PDO::PARAM_INT);
		$stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$part = $stmt->fetch(PDO::FETCH_ASSOC);
		// Return cars
		return $part;
	}

	// Buys the part
	public function buyPart($part_id, $store_id, $user_id, $install)
	{

		// If they are installing it on the current driven car, get the info.
		if ($install){
			// Build Query to fetch car_id
			$query1 = "SELECT cars_id FROM cars WHERE cars_owner = :user_id AND cars_driving = 1 LIMIT 1";
			// Prepare Query
			$stmt1 = $this->conn->prepare($query1);
			// Bind Parameters
			$stmt1->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			// Execute Query
			if (!$stmt1->execute()) {
				return false;
			}
				// Fetch Car ID
				$driving_car_id = $stmt1->fetch(PDO::FETCH_ASSOC);
			}else {
				$driving_car_id['cars_id'] = 0;
			}

		// Fetch the Part template
		$pt = $this->fetchPart($part_id, $store_id);

		// Build Query to Delete User
		$query = "INSERT INTO part (part_owner_id, part_car_id, part_type, part_price, part_hp, part_tq, part_weight, part_reliability, part_description)
				  VALUES (:part_owner_id, :part_car_id, :part_type, :part_price, :part_hp, :part_tq, :part_weight, :part_reliability, :part_description)";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':part_owner_id', $user_id, PDO::PARAM_INT);
		$stmt->bindParam(':part_car_id', $driving_car_id['cars_id'], PDO::PARAM_INT);
		$stmt->bindParam(':part_type', $pt['pt_type'], PDO::PARAM_INT);
		$stmt->bindParam(':part_price', $pt['pt_msrp'], PDO::PARAM_INT);
		$stmt->bindParam(':part_hp', $pt['pt_hp'], PDO::PARAM_INT);
		$stmt->bindParam(':part_tq', $pt['pt_tq'], PDO::PARAM_INT);
		$stmt->bindParam(':part_weight', $pt['pt_weight'], PDO::PARAM_INT);
		$stmt->bindParam(':part_reliability', $pt['pt_reliability'], PDO::PARAM_INT);
		$stmt->bindParam(':part_description', $pt['pt_description'], PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) return true;
		// Error
		else return false;
	}
}
