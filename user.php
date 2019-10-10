<?php

include "db_config.php";

class User
{
    public $db;

    public function __construct()
    {
        $this->db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if (!$this->db) {
            echo "Error: Could not connect to database.";
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            die();
        }
    }

    public function userRegister(
        $firstName,
        $lastName,
        $email,
        $gender,
        $password
    )
    {
        $password = sha1($password);

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

        $date = (new \DateTime())->format('Y-m-d H:i:s');

        $result = $this->db->query($sql);

        if (!$result->num_rows) {
            $sql = "INSERT INTO users (first_name, last_name, email, gender, password, created_at, updated_at) VALUES 
            ('$firstName', '$lastName', '$email', '$gender', '$password', '$date', '$date')";

            $result = $this->db->query($sql);
            return $result;
        } else {
            return false;
        }

    }

    public function userLogin($email, $password)
    {
        $password = sha1($password);
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

        $result = $this->db->query($sql);
        if ($result->num_rows) {
            $userId = $result->fetch_array()['id'];
            $_SESSION['user_id'] = $userId;
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {

    }


}