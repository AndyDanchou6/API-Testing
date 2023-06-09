<?php

include 'dbframe.php';

class Database extends DBFrame {
    public $dbname = 'api_testing';
    public function setup() {
        $this->server = 'localhost';
        $this->user = 'root';
        $this->password = '';

        $this->conn = new mysqli($this->server, $this->user, $this->password);
        $this->conn->query("CREATE DATABASE IF NOT EXISTS ". $this->dbname);
    }
    public function sql($sql) {
        return $this->conn = new mysqli($this->server, $this->user, $this->password, $this->dbname);
    }
}

// $data1 = new Database();
// $stat = $data1->setup();

// if ($stat == true) {
//     echo "connectidos successfulley";
// }



