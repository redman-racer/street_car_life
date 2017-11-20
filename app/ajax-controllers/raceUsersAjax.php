<?php
// Include Globals
require '../config/globals.php';
// Define header
header("Content-Type: application/json; charset=utf-8");

	if($_GET['action'] == "findUsers")
	{
		$searchTerm   = $_GET['term'];
		$searchResult = $user->searchUsers($searchTerm);
		$searchResUser = NULL;

		foreach ($searchResult as $fesr) {
			if( $fesr['id'] > 10000 || $fesr['id'] < 20){
				$searchResUser[] = $fesr['username'];
		 	}
		}

		if( !$searchResUser ){
			$searchResUser = "No Results";
		}
		echo json_encode($searchResUser);
	}

	if($_GET['action'] == "findComputers")
	{
		if( $searchResult = $user->fetchComputers() ){


		echo json_encode($searchResult);
		}else{
			echo json_encode(array("error" => true));
		}
	}
