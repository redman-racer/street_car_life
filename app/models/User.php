<?php

class User
{
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param $user_id
     * @return bool|array
     * Fetch all the information of a user
     */
    public function fetchUser($user_id)
    {
        // Build Query to fetch user information
        $query = "SELECT * FROM users WHERE id=:user_id LIMIT 1";
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        // Execute Query
        if (!$stmt->execute()) return $stmt->errorInfo();
        // Fetch User information
        $userinfo = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists
        if (!$userinfo['id']) return false;
        // Return User Information
        else return $userinfo;
    }

    public function fetchByUser($user_name){
        // Build Query to fetch user information
        $query = "SELECT * FROM users WHERE username=:user_name LIMIT 1";
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        // Execute Query
        if (!$stmt->execute()) return $stmt->errorInfo();
        // Fetch User information
        $userinfo = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists
        if (!$userinfo['id']) return false;
        // Return User Information
        else return $userinfo;
    }

    /**
     * @return bool|array
     * Fetch all the users registered on the website
     */
    public function fetchUsers()
    {
        // Build Query to Fetch Users
        $query = "SELECT * FROM users ORDER BY id ASC";
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Execute Query
        if (!$stmt->execute()) return false;
        // Fetch Users
        $users = $stmt->FetchAll(PDO::FETCH_ASSOC);
        // Check if there are users
        if (!count($users)) return false;
        // Return Users
        else return $users;
    }

    /**
     * @param $username
     * @return bool
     * Validate login information for a user
     */
    public function validateLogin($username, $password){
        // Build Query to fetch user information
        $query = "SELECT id, password FROM users WHERE username=:username LIMIT 1";
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        // Execute Query
        if(!$stmt->execute()) return false;
        // Fetch Information
        $info = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user was found
        if(!$info['id']) return false;

        // Validate password
        if($password != $info['password']) return false;
        // Return user id
        else return $info['id'];
    }

    /**
     * @param $user_id
     * @return bool|array
     *  Delete a user from the database
     */
    public function deleteUser($user_id)
    {
        // Build Query to Delete User
        $query = "DELETE FROM users WHERE id=:user_id";
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        // Execute Query
        if ($stmt->execute()) return true;
        // Error
        else return false;
    }

    /**
     * @param $user_id
     * @return bool|array
     *  Delete a user from the database
     */
    public function createUser($user_name, $password, $email)
    {
        // Build Query to Delete User
        $query = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)"; //TODO make this function work        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':username', $user_name, PDO::PARAM_INT);
        $stmt->bindParam(':password', $password, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_INT);
        // Execute Query
        if ($stmt->execute()) return true;
        // Error
        else return false;
    }

    /**
     * @param $user_id
     * @return bool
     * Ban a user.
     */
    public function banUser($user_id)
    {
        // Build Query to Delete User
        $query = "UPDATE users SET banned=1 WHERE id=:user_id";
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        // Execute Query
        if ($stmt->execute()) return true;
        // Error
        else return false;
    }

    /**
     * @param $user_id
     * @return bool
     * Unban a user.
     */
    public function unbanUser($user_id)
    {
        // Build Query to Delete User
        $query = "UPDATE users SET banned=0 WHERE id=:user_id";
        // Prepare Query
        $stmt = $this->conn->prepare($query);
        // Bind Parameters
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        // Execute Query
        if ($stmt->execute()) return true;
        // Error
        else return false;
    }
}
