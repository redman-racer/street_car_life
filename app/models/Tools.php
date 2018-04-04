<?php

class Tools
{
    public function __construct($conn)
    {
        $this->conn = $conn;
    }


	public function genericUpdate($table, $setter, $set_clause, $where_collumn, $where_clause){
	// Build Query to Delete User
		$query = "UPDATE ".$table." SET ".$setter." = ".$set_clause." WHERE ".$where_collumn." = ".$where_clause;
        // Prepare Query
        $stmt = $this->conn->prepare($query);
		// Bind Parameters
		// Execute Query
        if ($stmt->execute()){ return true; }
        // Error
        else return false;
	}

}
