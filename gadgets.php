<?php

include 'tables.php';
include 'db.php';

class Gadgets extends Database implements Tables {
    public $tblName = 'gadgets';

    public function __construct() {
        $this->setup();
    }
    public function create() {
        $create = "CREATE TABLE [IF NOT EXISTS] $this->tblName(
            id int auto_increment primary key not null,
            name varchar(200) not null,
            date_launched varchar(200),
            price int,
            amount_launched int,
            manufacturer varchar(200) not null
        )";
        return $this->sql($create);
    }
    public function insert($name, $date, $price, $amount, $manu) {
        $insert = "INSERT INTO TABLE $this->tblName (name, date_launched, 
        price, amount_launched, manufacturer) VALUES ('$name', '$date',
        $price, $amount, '$manu')";
        return $this->sql($insert);
    }
    public function remove() {

    }
    public function showAll() {

    }
}

$data1 = new Gadgets();
$stats = $data1->create();
// $stats = $data1->insert('dummy', 'May 11', 45356, 5646, 'dummy');
// if ($stats == true) {
//     echo "succesfull";
// }

var_dump($stats);