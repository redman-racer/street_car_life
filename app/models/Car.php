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
        $query = "SELECT * FROM cars WHERE cars_owner=:user_id";
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
		$query = "SELECT * FROM car_template";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':ct_id', $ct_id, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$car_templates = $stmt->fetch(PDO::FETCH_ASSOC);
		// Return cars
		return $car_templates;
	}


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
}
