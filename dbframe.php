<?php

abstract class DBFrame {
    public $conn;
    public $server;
    public $user;
    public $password;

    abstract public function setup();
}
