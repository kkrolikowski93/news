<?php

include "db_config.php";

class News
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

    public function showAllNews()
    {
        $sql = "SELECT news.*, users.first_name, users.last_name FROM news, users WHERE news.author_id = users.id ORDER BY news.created_at DESC";

        $result = $this->db->query($sql);

        if ($result->num_rows) {
            $output = array();
            while ($row = $result->fetch_array()) {
                $output[] = $row;
            }
            return $output;
        } else {
            return false;
        }

    }

    public function showUserNews()
    {
        $sql = "SELECT news.*, users.first_name, users.last_name FROM news, users WHERE news.author_id =".$_SESSION['user_id']." AND news.author_id = users.id ORDER BY news.created_at DESC";

        $result = $this->db->query($sql);

        if ($result) {
            $output = array();
            while ($row = $result->fetch_array()) {
                $output[] = $row;
            }
            return $output;
        } else {
            return false;
        }

    }

    public function showSingleNews($id)
    {
        $sql = "SELECT news.*, users.first_name, users.last_name FROM news, users WHERE news.id = '$id' AND news.author_id = users.id";

        $result = $this->db->query($sql);
        if ($result->num_rows) {
            $output = $result->fetch_array();
            return $output;
    } else {
        return false;
        }
    }

    public function addNews($name, $description, $publish)
    {
        $authorId = $_SESSION['user_id'];
        $date = (new \DateTime())->format('Y:m:d H:i:s');
        $sql = "INSERT INTO news (name, description, is_active, created_at, updated_at, author_id) VALUES (
               '$name', '$description', '$publish', '$date', '$date', '$authorId')";
        $result = $this->db->query($sql);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function editNews($id, $name, $description, $publish)
    {
        $date = (new \DateTime())->format('Y:m:d H:i:s');
        $sql = "UPDATE news SET name = '$name', description = '$description', updated_at = '$date' WHERE id = '$id'";

        $result = $this->db->query($sql);
        return $result;
    }

    public function deleteNews($id)
    {
        $sql = "DELETE FROM news WHERE id='$id'";

        $result = $this->db->query($sql);
        return $result;
    }
}