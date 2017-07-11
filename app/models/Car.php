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
        $query = "SELECT * FROM cars WHERE car_id=:car_id LIMIT 1";
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
        if ($car['car_id']) {
            return $car;
        } // No car to return
        else {
            return false;
        }
    }

    public function fetchAllUserCars($user_id)
    {
        // Build Query to fetch all the cars of a user
        $query = "SELECT * FROM cars WHERE car_owner=:user_id";
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
}
