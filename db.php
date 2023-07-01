<?php

include 'dbframe.php';

class Database extends DBFrame {
    public function setup() {
        $this->server = 'localhost';
        $this->user = 'root';
        $this->password = '';
        $this->dbname = 'api_testing';

        $this->conn = new mysqli($this->server, $this->user, $this->password);
        $this->conn->query("CREATE DATABASE IF NOT EXISTS ". $this->dbname);
        $this->conn = new mysqli($this->server, $this->user, $this->password, $this->dbname);
    }
}

// $data1 = new Database();
// $stat = $data1->setup();

// if ($stat == true) {
//     echo "connectidos successfulley";
// }

