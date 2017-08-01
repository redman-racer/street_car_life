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
		// Fetch Cars
		$part_stores = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Return cars
		return $part_stores;
	}

	// Fetch parts available at a specific Parts Store
	public function fetchAllParts($store_id)
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
		$parts_available = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Return cars
		return $parts_available;
	}

}
