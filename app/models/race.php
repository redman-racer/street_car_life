<?php

class Race
{
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

	// Leaderboard Functions
	public function getLargestBetList(){
		// Build Query to fetch race information
		$query = "SELECT race_id, race_bet_amount, race_track_type, race_driver_one, race_driver_two, race_d1_car, race_d2_car, LEAST(race_d1_et, race_d2_et) AS fastest_et, race_d1_et, race_d2_et, race_d1_trap, race_d2_trap FROM race WHERE race_bet_amount >= 1 AND race_d1_et IS NOT NULL AND race_d2_et IS NOT NULL ORDER BY race_bet_amount DESC LIMIT 100";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$top_bet_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $top_bet_list;
	}

	public function getFastETList(){
		// Build Query to fetch race information
		$query = "SELECT race_id, race_track_type, race_driver_one, race_driver_two, race_d1_car, race_d2_car, LEAST(race_d1_et, race_d2_et) AS fastest_et, race_d1_et, race_d2_et, race_d1_trap, race_d2_trap FROM race WHERE race_d1_et IS NOT NULL AND race_d2_et IS NOT NULL ORDER BY fastest_et ASC";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$fastestET = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $fastestET;
	}

	public function getFastMPHList(){
		// Build Query to fetch race information
		$query = "SELECT race_id, race_track_type, race_driver_one, race_driver_two, race_d1_car, race_d2_car, race_d1_et, race_d2_et, GREATEST(race_d1_trap, race_d2_trap) AS fastest_trap, race_d1_trap, race_d2_trap FROM race WHERE race_d1_trap IS NOT NULL AND race_d2_trap ORDER BY fastest_trap DESC";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$fastestMPH = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $fastestMPH;
	}

	public function getMostWinsList(){
		// Build Query to fetch race information
		$query = "SELECT race_id, race_driver_one, race_driver_two, LEAST(race_d1_et, race_d2_et) AS fastest_et, race_d1_et, race_d2_et FROM race ORDER BY fastest_et DESC";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$winList = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $winList;
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

		// Build Query to Delete User
		$query = "UPDATE race SET race_d".$pnum."_car = ".$player['current_car']['cars_id'].", race_d".$pnum."_rt = ".$player['race_results']['rt'].", race_d".$pnum."_sixty = ".$player['race_results']['sixty'].", race_d".$pnum."_eighth = ".$player['race_results']['eighth'].
		", race_d".$pnum."_et = ".$player['race_results']['et'].", race_d".$pnum."_trap = ".$player['race_results']['trap']." WHERE race_id = ".$race_id." LIMIT 1";

		$player['race_id'] = $race_id;

        // Prepare Query
        $stmt = $this->conn->prepare($query);
		// Execute Query
        if ($stmt->execute()){ return $player; }
        // Error
        else return false;
	}

	public function createNewRace($creator_id, $recipient_id, $racer_type, $creator_car_id, $race_amount, $forPinks, $race_type)
	{
		$query = "INSERT INTO race (race_bet_amount, race_for_pinks, race_track_type, race_driver_one, race_driver_two, race_d1_car)
				  VALUES (:race_bet_amount, :race_for_pinks, :race_track_type, :race_driver_one, :race_driver_two, :race_d1_car)"; //TODO make this function work
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':race_bet_amount', $race_amount, PDO::PARAM_INT);
		$stmt->bindParam(':race_for_pinks', $forPinks, PDO::PARAM_INT);
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

	public function fetchD1Last24($user_id){
		// Build Query to fetch race information
		$query = "SELECT * FROM race WHERE race_driver_one = :user_id AND race_date_start >= (DATE_SUB(now(), INTERVAL 2 MINUTE))";
		// Prepare Query
		$stmt = $this->conn->prepare($query);
		// Bind Parameters
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$lastD124 = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $lastD124;
	}

	public function fetchRaceAll($user_id){
        // Build Query to fetch race information
        $query = "SELECT * FROM race WHERE race_driver_one = :user_id OR race_driver_two = :user_id ORDER BY race_id DESC";
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// Execute Query
		if (!$stmt->execute()) {
			return false;
		}
		// Fetch Cars
		$raceInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $raceInfo;
	}
}
