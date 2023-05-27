<?php

abstract class DBFrame {
    protected $conn;
    protected $server;
    protected $user;
    protected $password;

    abstract public function setup();
}
