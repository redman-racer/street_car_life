<?php
// Include Globals
require '../config/globals.php';
// Define header
header("Content-Type: application/json; charset=utf-8");

// Instantiate Race Functions
$race = new Race($conn);

if($_POST['action'] === "getRaces"){
	$all_races = $race->fetchRaceAll($user_info['id']);
	$count = 0;
	foreach ($all_races as &$race) {
		$count++;
		if( $race['race_driver_one'] !== NULL ){
			$username_one = $user->fetchUser($race['race_driver_one']);
		}
		if( $race['race_driver_two'] !== NULL ){
			$username_two = $user->fetchUser($race['race_driver_two']);
		}
		$race['username_one'] = $username_one['username'];
		$race['username_two'] = $username_two['username'];
		$race['car_one'] = $car->fetchCar($race['race_d1_car']);
		$race['car_two'] = $car->fetchCar($race['race_d2_car']);
		if( $race['car_one'] == null ){
			$race['car_one']['cars_model'] = "None";
		}
		if( $race['car_two'] == null ){
			$race['car_two']['cars_model'] = "None";
		}
	}

	if( !$all_races ){
		echo json_encode(array("error" => true, "e_msg" => "There was an error retrieving the race data."));
		return false;
	}

	echo json_encode(array("error" => false, "e_msg" => "", "user_id" => $user_info['id'], "race_data" => $all_races));
	return true;
}

if($_POST['action'] === "getLeaderboards"){
	$fastest_mph = $race->getFastMPHList();
	$count_mph = 0;
	$mph_log   = array();
	$d_mph_log = array();

	$fastest_et = $race->getFastETList();
	$count_et = 0;
	$car_log 	= array();
	$delete_log = array();

	$win_list_get 	= $race->getMostWinsList();
	$count_win		= 0;
	$winner_ids		= array();
	$loser_ids		= array();
	$d_winner_ids	= array();

	$largest_bet = $race->getLargestBetList();

	foreach ($largest_bet as $bet_key => $bet_value) {
		// Assign Usernames to User IDs
		if( $bet_value['race_driver_one'] !== NULL ){
			$username_bet_one = $user->fetchUser($bet_value['race_driver_one']);
			$largest_bet[$bet_key]['username_one'] = $username_bet_one['username'];
		}
		if( $bet_value['race_driver_two'] !== NULL ){
			$username_bet_two = $user->fetchUser($bet_value['race_driver_two']);
			$largest_bet[$bet_key]['username_two'] = $username_bet_two['username'];
		}
		$largest_bet[$bet_key]['race_bet_amount'] = number_format($bet_value['race_bet_amount'], 0);
	}

	// Sort through  the results, assign usernames and determine duplicates
	foreach ($fastest_mph as &$race2) {
		// Determine duplicates that need to be deleted.
		if( $race2['race_d1_trap'] == $race2['fastest_trap'] ){
			$mph_logged = array_search($race2['race_d1_car'], $mph_log);

			if( $mph_logged === false ){
				$mph_log[] = $race2['race_d1_car'];
			}else{
				$d_mph_log[] = $count_mph;
			}
		}
		if( $race2['race_d2_trap'] == $race2['fastest_trap'] ){
			$mph_logged = array_search($race2['race_d2_car'], $mph_log);

			if( $mph_logged === false ){
				$mph_log[] = $race2['race_d2_car'];
			}else{
				$d_mph_log[] = $count_mph;
			}
		}

		// Assign Usernames to User IDs
		if( $race2['race_driver_one'] !== NULL ){
			$username_mph_one = $user->fetchUser($race2['race_driver_one']);
			$fastest_mph[$count_mph]['username_one'] = $username_mph_one['username'];
		}
		if( $race2['race_driver_two'] !== NULL ){
			$username_mph_two = $user->fetchUser($race2['race_driver_two']);
			$fastest_mph[$count_mph]['username_two'] = $username_mph_two['username'];
		}

		$count_mph++;
	}

	// Delete rows with duplicate winning car id's
	foreach ($d_mph_log as $key2) {
		unset($fastest_mph[$key2]);
	}


	// Sort through  the results, assign usernames and determine duplicates
	foreach ($fastest_et as &$race) {
		// Determine duplicates that need to be deleted.
		if( $race['race_d1_et'] === $race['fastest_et'] ){
			$logged = array_search($race['race_d1_car'], $car_log);

			if( $logged === false ){
				$car_log[] = $race['race_d1_car'];
			}else{
				$delete_log[] = $count_et;
			}
		}
		if( $race['race_d2_et'] === $race['fastest_et'] ){
			$logged = array_search($race['race_d2_car'], $car_log);

			if( $logged === false ){
			$car_log[] = $race['race_d2_car'];
			}else{
				$delete_log[] = $count_et;
			}
		}

		// Assign Usernames to User IDs
		if( $race['race_driver_one'] !== NULL ){
			$username_one = $user->fetchUser($race['race_driver_one']);
			$fastest_et[$count_et]['username_one'] = $username_one['username'];
		}
		if( $race['race_driver_two'] !== NULL ){
			$username_two = $user->fetchUser($race['race_driver_two']);
			$fastest_et[$count_et]['username_two'] = $username_two['username'];
		}

		$count_et++;
	}
	// Delete rows with duplicate winning car id's
	foreach ($delete_log as $key) {
		unset($fastest_et[$key]);
	}


	// Attach usernames and build $winner_ids
	foreach ($win_list_get as &$list_races) {
		// Build the winners list
		if( $list_races['race_d1_et'] == $list_races['fastest_et'] ){
			$winner_ids[] = $list_races['race_driver_one'];
		}
		if( $list_races['race_d2_et'] == $list_races['fastest_et'] ){
			$winner_ids[] = $list_races['race_driver_two'];
		}
		if($list_races['race_d1_et'] !== $list_races['fastest_et'] ){
			$loser_ids[] = $list_races['race_driver_one'];
		}
		if($list_races['race_d2_et'] !== $list_races['fastest_et'] ){
			$loser_ids[] = $list_races['race_driver_two'];
		}

		$count_win++;
	}
	// Group wins by winner id
	$count_wins = array_count_values($winner_ids);
	$count_loses = array_count_values($loser_ids);
	// Get the grouped winner id's
	$cwin_ids	= array_keys($count_wins);
	$c_lose_ids	= array_keys($count_loses);
	$cwin_count = 0;
	$c_lose_count = 0;
	function searchForUsername($id, $array) {
	   foreach ($array as $key => $val) {
	       if ($val['username'] === $id) {
	           return $key;
	       }
	   }
	   return null;
	}
	// Assign usernames and build $win_list_fin
	foreach ($count_loses as $c_lose) {
		$c_lose_username = $user->fetchUser($c_lose_ids[$c_lose_count]);

		$lose_list_fin[] = array( "username" => $c_lose_username['username'], "total_loses" => $c_lose);
		//$count_wins[$key]['username'] = $username_cwin_two['username'];

		$c_lose_count++;
	}

	foreach ($count_wins as $c_win) {
		$cwin_username  = $user->fetchUser($cwin_ids[$cwin_count]);
		$lose_array_key = searchForUsername($cwin_username['username'], $lose_list_fin);

		if($lose_array_key){
			$lose_count = $lose_list_fin[$lose_array_key]['total_loses'];
		} else{ $lose_count = 0;}

		$win_list_fin[] = array( "username" => $cwin_username['username'], "total_wins" => $c_win, "total_lost" => $lose_count);
		//$count_wins[$key]['username'] = $username_cwin_two['username'];

		$cwin_count++;
	}
	// Sort the array by total wins.
	function sort_by_total_wins($a, $b)
	{
	    return $b['total_wins'] - $a['total_wins'];
	}
	usort($win_list_fin, 'sort_by_total_wins');





	if( $fastest_et ){
		echo json_encode(array("error" => false, "e_msg" => "", "fastest_et" =>  $fastest_et, "fastest_mph" => $fastest_mph, "most_wins" => $win_list_fin, "largest_bet" => $largest_bet));
		return true;
	}

	echo json_encode(array("error" => true, "e_msg" => "There was an error loading the data."));
	return false;
}
