<?php

include 'tables.php';
include 'database.php';

class Gadgets extends Database implements Tables {
    public $tblName = 'gadgets';

    public function __construct() {
        $this->setup();
    }
    public function create() {
        $sql = "CREATE TABLE IF NOT EXISTS $this->tblName(
            id int auto_increment primary key,
            name varchar(200) not null,
            date_launched varchar(200),
            price int,
            amount_launched int,
            manufacturer varchar(200)
        )";
        $this->sql($sql);
    }
    public function insert() {

    }
    public function remove() {

    }
    public function showAll() {

    }
}

$data1 = new Gadgets();
$stats = $data1->create();

if ($stats == true) {
    echo "table created";
}

// var_dump($data1);