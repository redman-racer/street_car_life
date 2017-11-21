<?php

class Car
{
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function fetchCar($car_id)
    {
        // Build Query to fetch the information of a car
        $query = "SELECT * FROM cars WHERE cars_id=:car_id LIMIT 1";
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);
        // Execute Query
        if (!$stmt->execute()) {
            return array("error" => "Insert error text.");
        }
        // Fetch Car Information
        $car = $stmt->fetch(PDO::FETCH_ASSOC);
        // Return Car
        if ($car['cars_id']) {
            return $car;
        } // No car to return
        else {
            return false;
        }
    }

    public function fetchAllUserCars($user_id)
    {
        // Build Query to fetch all the cars of a user
        $query = "SELECT * FROM cars WHERE cars_owner=:user_id ORDER BY cars_id ASC";
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        // Execute Query
        if (!$stmt->execute()) {
            return false;
        }
        // Fetch Cars
        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Return cars
        return $cars;
    }

    public function fetchCarTemplate($ct_id)
    {
        // Build Query to fetch all the cars of a user
        $query = "SELECT * FROM car_template WHERE ct_id=:ct_id LIMIT 1";
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':ct_id', $ct_id, PDO::PARAM_INT);
        // Execute Query
        if (!$stmt->execute()) {
            return false;
        }
        // Fetch Cars
        $car_template = $stmt->fetch(PDO::FETCH_ASSOC);
        // Return cars
        return $car_template;
    }

	public function fetchAllCarTemplate()
	{
		// Build Query to fetch all the cars of a user
		$query = "SELECT * FROM car_template ORDER BY ct_make, ct_year ASC";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$car_templates = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Return cars
		return $car_templates;
	}

	// Changes the car that the player is currently driving
	public function changeDrivenCar($car_id, $user_id)
	{
		// Build Query to update cars that user is driving
		$query = "UPDATE `cars` SET `cars_driving` = 0 WHERE `cars_owner`=:user_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}

		// Build Query to update cars that user is driving
		$query = "UPDATE `cars` SET `cars_driving` = 1 WHERE `cars_id`=:car_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}

		$updatedCarDriven = true;
		// Return true to verify it updated
		return $updatedCarDriven;
	}

	// Fetchs the current car that the player is driving
	public function currentDrivenCar($user_id)
	{
		// Build Query to fetch all the cars of a user
		$query = "SELECT * FROM `cars` WHERE `cars_owner`=:user_id AND `cars_driving` = 1 LIMIT 1";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$currentDrivingCar = $stmt->fetch(PDO::FETCH_ASSOC);
		// Return cars
		return $currentDrivingCar;
	}

	// Get the car stats for cars_id
	public function fetchCarStats($car_id, $user_id)
	{
		// Build Query to fetch cars stock stats.
		$query = "SELECT * FROM `cars` WHERE `cars_owner`=:user_id AND `cars_id` = :car_id LIMIT 1";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$carStats = $stmt->fetch(PDO::FETCH_ASSOC);

		$carParts = $this->fetchCarParts($car_id, $user_id);

		foreach ($carParts as &$part) {
			if( $part['part_installed'] ){
				$partHP = round($part['part_hp'] * $carStats['cars_eng_liter']);
				$partTQ = round($part['part_tq'] * $carStats['cars_eng_liter']);

				$carStats['cars_hp'] += $partHP;
				$carStats['cars_tq'] += $partTQ;
				$carStats['cars_weight'] += $part['part_weight'];
				$carStats['cars_reliability'] += $part['part_reliability'];
				$carStats['cars_traction'] += $part['part_traction'];
			}
		}

		// Do Traction math
		$carStats['cars_traction'] = round(($carStats['cars_traction'] * $carStats['cars_weight'])/100);

		// Return cars
		return $carStats;
	}

	// Fetch ALL parts
	public function fetchCarParts($car_id, $user_id)
	{
		// Build Query to fetch cars mods.
		$query = "SELECT * FROM `part` WHERE `part_owner_id`=:user_id AND `part_car_id` = :car_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$carParts = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $carParts;
	}

	public function carThumbnail($car_id)
	{
		//Get the cars data
		$car		  = $this->fetchCar($car_id);
		//Get the car_template data
		$car_template = $this->fetchCarTemplate($car['cars_ct_id']);

		//Construct the imags
		$url = "cars/garage/".$car_template['ct_photo_folder']."/street-car-life-".$car_template['ct_year']."-".$car_template['ct_make']."-".$car_template['ct_model']."-thumb.jpg";
		//Return url
		return $url;
	}


	public function buyCar($ct_id, $user_id)
	{
		$car_template = $this->fetchCarTemplate($ct_id);

		// Build Query to Delete User
		$query = "INSERT INTO cars (cars_ct_id, cars_owner, cars_year, cars_make, cars_model, cars_transmission, cars_eng_liter, cars_hp, cars_tq, cars_traction, cars_f_aero, cars_r_aero, cars_weight, cars_braking, cars_handling, cars_launch, cars_reliability, cars_value)
				  VALUES (:cars_ct_id, :cars_owner, :cars_year, :cars_make, :cars_model, :cars_transmission, :cars_eng_liter, :cars_hp, :cars_tq, :cars_traction, :cars_f_aero, :cars_r_aero, :cars_weight, :cars_braking, :cars_handling, :cars_launch, :cars_reliability, :cars_value)";
        // Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':cars_ct_id', $ct_id, PDO::PARAM_INT);
		$stmt->bindParam(':cars_owner', $user_id, PDO::PARAM_INT);
		$stmt->bindParam(':cars_year', $car_template['ct_year'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_make', $car_template['ct_make'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_model', $car_template['ct_model'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_transmission', $car_template['ct_transmission'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_eng_liter', $car_template['ct_eng_liter'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_hp', $car_template['ct_hp'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_tq', $car_template['ct_tq'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_traction', $car_template['ct_traction'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_f_aero', $car_template['ct_f_aero'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_r_aero', $car_template['ct_r_aero'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_weight', $car_template['ct_weight'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_braking', $car_template['ct_braking'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_handling', $car_template['ct_handling'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_launch', $car_template['ct_launch'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_reliability', $car_template['ct_reliability'], PDO::PARAM_INT);
		$stmt->bindParam(':cars_value', $car_template['ct_cost'], PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()){
			// Gets the inserted ID
			$lastID = $this->conn->lastInsertId();
			// Sets the driven car to the just purchased car.
			$this->changeDrivenCar($lastID, $user_id);
			 return true;
	 	}
		// Error
		else return false;
	}

	public function setPinks($car_id, $user_id, $pinks_status){
		// Build Query to Delete User
		$query = "UPDATE cars SET cars_for_pinks = :pinks_status WHERE cars_id = :car_id AND cars_owner = :user_id";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':pinks_status', $pinks_status, PDO::PARAM_INT);
		$stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()) return true;
		// Error
		else return false;
	}
}
