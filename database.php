<?php

// database
abstract class DBFrame {
    public $conn;
    public $server;
    public $user;
    public $password;

    abstract public function setup();
}

class Database extends DBFrame {
    
    public function setup() {
        $this->server = 'localhost';
        $this->user = 'root';
        $this->password = '';

        $this->conn = new mysqli()
    }
}
