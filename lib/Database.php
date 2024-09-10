<?php

class Database
{
    public $host = HOST;
    public $user = USER;
    public $pass = PASSWORD;
    public $dbname = DATABASE;

    public $link;
    public $error;

    public function __construct()
    {
        $this->connect();
    }

    // Database Connection Function
    public function connect()
    {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if (!$this->link) {
            $this->error = "Database Connection Failed"
            . $this->link->connect_error;
            return false;
        }
    }

    // Select Query
    public function select($query)
    {
        $result = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    // Insert Query
    public function insert($query)
    {
        $insert_row = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($insert_row) {
            return $insert_row;
        } else {
            return false;
        }
    }

    // Update Query
    public function update($query)
    {
        $update_row = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($update_row) {
            return $update_row;
        } else {
            return false;
        }

    }

}
