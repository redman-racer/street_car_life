<?php

class Race
{
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

	// Return et and trap
	public function raceMathStats($hp, $weight)
	{
	$et   = round(pow(($weight/$hp), (1/3))*5.7, 3);
	$trap = round(pow(($hp/$weight), (1/3))*234, 3);
	$eighth_mile = round($et*.655-.22, 3);
    $sixty_foot  = round($et*.126+.17, 3);
	$results = array("et"=>$et, "trap"=>$trap, "eighth"=>$eighth_mile, "sixty"=>$sixty_foot);

	return $results;
	}

	// Return et and trap
	public function raceMathID($car_id)
	{
	//Gets the cars stats using the id
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

	$hp		  = $car['cars_hp'];
	$weight   = $car['cars_weight'];

	//run the stats through the race math function
	$results = $this->raceMathStats($hp, $weight);

	return $results;
	}

	// $player_1/2 = array("player1_id"=>$user_info['id'], "player1_car"=>$['cars_id'], "player1_results"=>$race_results_array
	public function recordRace($player_1, $player_2)
	{
		// Build Query to Delete User
        $query = "INSERT INTO race (race_driver_one, race_driver_two, race_d1_car, race_d2_car, race_d1_sixty, race_d2_sixty, race_d1_eighth, race_d2_eighth, race_d1_et, race_d2_et, race_d1_trap, race_d2_trap)
				  VALUES (:race_driver_one, :race_driver_two, :race_d1_car, :race_d2_car, :race_d1_sixty, :race_d2_sixty, :race_d1_eighth, :race_d2_eighth, :race_d1_et, :race_d2_et, :race_d1_trap, :race_d2_trap)"; //TODO make this function work
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':race_driver_one', $player_1['player1_id'], PDO::PARAM_INT);
        $stmt->bindParam(':race_driver_two', $player_2['player2_id'], PDO::PARAM_INT);
        $stmt->bindParam(':race_d1_car', $player_1['player1_car'], PDO::PARAM_INT);
        $stmt->bindParam(':race_d2_car', $player_2['player2_car'], PDO::PARAM_INT);
        $stmt->bindParam(':race_d1_sixty', $player_1['player1_results']['sixty'], PDO::PARAM_INT);
        $stmt->bindParam(':race_d2_sixty', $player_2['player2_results']['sixty'], PDO::PARAM_INT);
        $stmt->bindParam(':race_d1_eighth', $player_1['player1_results']['eighth'], PDO::PARAM_INT);
        $stmt->bindParam(':race_d2_eighth', $player_2['player2_results']['eighth'], PDO::PARAM_INT);
        $stmt->bindParam(':race_d1_et', $player_1['player1_results']['et'], PDO::PARAM_INT);
        $stmt->bindParam(':race_d2_et', $player_2['player2_results']['et'], PDO::PARAM_INT);
        $stmt->bindParam(':race_d1_trap', $player_1['player1_results']['trap'], PDO::PARAM_INT);
        $stmt->bindParam(':race_d2_trap', $player_2['player2_results']['trap'], PDO::PARAM_INT);
        // Execute Query
        if ($stmt->execute()) return true;
        // Error
        else return false;
	}
}
