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

	// $player_info = array("player_num" => $player, "current_car" => $current_car, "race_results" => $race_results);
	public function recordRace($player, $race_id)
	{
		$pnum = $player['player_num'];

		print_r($player);

		// Build Query to Delete User
		$race_d_car    = "race_d".$pnum."_car";		$race_d_rt = "race_d".$pnum."_rt"; $race_d_sixty = "race_d".$pnum."_sixty";
		$race_d_eighth = "race_d".$pnum."_eighth";	$race_d_et = "race_d".$pnum."_et"; $race_d_trap	 = "race_d".$pnum."_trap";

		$query = "UPDATE race SET
		`:race_d_car`		= `:race_d_car_var`,	`:race_d_rt` = `:race_d_rt_var`, `:race_d_sixty` = `:race_d_sixty_var`,
		`:race_d_eighth`	= `:race_d_eighth_var`,	`:race_d_et` = `:race_d_et_var`, `:race_d_trap` = `:race_d_trap_var`
		WHERE race_id = `:race_id_val` LIMIT 1";
		print("<br />".$query."<br/ >");
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':race_d_car', 	$race_d_car, 	PDO::PARAM_INT);
        $stmt->bindParam(':race_d_rt',		$race_d_rt, 	PDO::PARAM_INT);
        $stmt->bindParam(':race_d_sixty', 	$race_d_sixty, 	PDO::PARAM_INT);
        $stmt->bindParam(':race_d_eighth', 	$race_d_eighth,	PDO::PARAM_INT);
        $stmt->bindParam(':race_d_et', 		$race_d_et, 	PDO::PARAM_INT);
        $stmt->bindParam(':race_d_trap', 	$race_d_trap, 	PDO::PARAM_INT);
        $stmt->bindParam(':race_d_car_var',		$player['current_car']['cars_id'],	PDO::PARAM_INT);
        $stmt->bindParam(':race_d_rt_var',		$player['race_results']['rt'], 		PDO::PARAM_INT);
        $stmt->bindParam(':race_d_sixty_var', 	$player['race_results']['sixty'], 	PDO::PARAM_INT);
        $stmt->bindParam(':race_d_eighth_var', 	$player['race_results']['eighth'], 	PDO::PARAM_INT);
        $stmt->bindParam(':race_d_et_var', 		$player['race_results']['et'], 		PDO::PARAM_INT);
        $stmt->bindParam(':race_d_trap_var', 	$player['race_results']['trap'], 	PDO::PARAM_INT);
        $stmt->bindParam(':race_id_val', $race_id, PDO::PARAM_INT);

		// Execute Query
        if ($stmt->execute()){ print($stmt); return true; }
        // Error
        else return false;
	}

	public function createNewRace($creator_id, $recipient_id, $racer_type, $creator_car_id, $race_amount, $forPinks, $race_type)
	{

		if( $forPinks ){
			$race_amount2 = $race_amount.":||:Pinks";
		} else $race_amount2 = $race_amount;

		$query = "INSERT INTO race (race_bet_amount, race_track_type, race_driver_one, race_driver_two, race_d1_car)
				  VALUES (:race_bet_amount, :race_track_type, :race_driver_one, :race_driver_two, :race_d1_car)"; //TODO make this function work
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':race_bet_amount', $race_amount2, PDO::PARAM_INT);
		$stmt->bindParam(':race_track_type', $race_type, PDO::PARAM_INT);
		$stmt->bindParam(':race_driver_one', $creator_id, PDO::PARAM_INT);
		$stmt->bindParam(':race_driver_two', $recipient_id, PDO::PARAM_INT);
		$stmt->bindParam(':race_d1_car', $creator_car_id, PDO::PARAM_INT);
		// Execute Query
		if ($stmt->execute()){
			$last_id = $this->conn->lastInsertId();

				// Insert create a new race
				// Build Query to create a new race
				$query2 = "INSERT INTO race_msg (rmsg_race_id, rmsg_creator_id, rmsg_recipient_id,  rmsg_racer_type, rmsg_creator_car_id, rmsg_race_amount, rmsg_for_pinks, rmsg_race_type)
						  VALUES (:race_id, :creator_id, :recipient_id, :racer_type, :creator_car_id, :race_amount, :for_pinks, :race_type)";
				// Prepare Query
				$stmt2 = $this->conn->prepare($query2);
				// Bind Parameters
				$stmt2->bindParam(':race_id', $last_id, PDO::PARAM_INT);
				$stmt2->bindParam(':creator_id', $creator_id, PDO::PARAM_INT);
				$stmt2->bindParam(':recipient_id', $recipient_id, PDO::PARAM_INT);
				$stmt2->bindParam(':racer_type', $racer_type, PDO::PARAM_INT);
				$stmt2->bindParam(':creator_car_id', $creator_car_id, PDO::PARAM_INT);
				$stmt2->bindParam(':race_amount', $race_amount, PDO::PARAM_INT);
				$stmt2->bindParam(':for_pinks', $forPinks, PDO::PARAM_INT);
				$stmt2->bindParam(':race_type', $race_type, PDO::PARAM_INT);
				// Execute Query
				if ($stmt2->execute()) return $last_id;
				// Error
				else return false;
		}
		// Error
		else return false;
	}

	public function fetchRaceID($race_id){
        // Build Query to fetch race information
        $query = "SELECT * FROM race WHERE race_id = :race_id LIMIT 1";
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':race_id', $race_id, PDO::PARAM_INT);
        // Execute Query
        if (!$stmt->execute()) return $stmt->errorInfo();
        // Fetch race information
        $raceinfo = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if race exists
        if (!$raceinfo['race_id']) return false;
        // Return race Information
        else return $raceinfo;
	}
}
