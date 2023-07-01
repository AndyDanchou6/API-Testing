<?php
error_reporting(0);
include 'tbl.php';
include 'database.php';
include 'sts.php';
header('Content-Type: application/json');

class Alcoholic_drinks extends Database implements Tbl {
    public $tblName = 'drinks';

    public function __construct() {
        $this->setup();
    }
    public function create() {
        $create = "CREATE TABLE if not exists $this->tblName (
            id int auto_increment primary key,
            brand varchar(200),
            date varchar(200),
            price int,
            manufacturer varchar(200)
        )";
        $this->conn->query($create);;
    }
    public function insert(array $params) {
        $insert_stat = true;

        if ($params['brand'] == null || $params['date'] == null || $params['price'] == null || $params['manu'] == null) {
            return $insert_stat = false;
        }

        elseif ($params['brand'] == !null && $params['date'] == !null && $params['price'] == !null && $params['manu'] == !null) {
            $brand = $params['brand'];
            $date = $params['date'];
            $price = $params['price'];
            $manu = $params['manu'];

            $insert = "INSERT INTO $this->tblName (brand, date, price,manufacturer)
                VALUES ('$brand', '$date', '$price', '$manu')";
            $res = $this->conn->query($insert);;
            if ($res) {
                return $insert_stat = true;
            }
            else {
                return $insert_stat = true;
            }
        }
    }
    public function remove($id) {
        $delete = "DELETE FROM $this->tblName WHERE id = '$id'";
        $stat = $this->conn->query($delete);
        return $stat;
    }
    public function show($id) {
        $get_drinks = "SELECT * FROM $this->tblName WHERE id = '$id' LIMIT 1";
        $one_item = $this->conn->query($get_drinks);
        if ($one_item) {
            if (mysqli_num_rows($one_item) == 1) {
                $fetch_one = mysqli_fetch_assoc($one_item);
                return $fetch_one;
            }
            else {
                return $res = null;
            }
        }
        else {
            return $res = null;
        }
    }
    public function showAll() {
        $get_all = "SELECT * FROM $this->tblName";
        $all = $this->conn->query($get_all);
        if ($all) {
            if (mysqli_num_rows($all) > 0) {
                $fetch_all = mysqli_fetch_all($all);
                return $fetch_all;
            }
            else {
                return $res = null;
            } 
        }
        else {
            return $res = null;
        }
    }
    public function update(array $params) {
        $id = $params['id'];
        $brand = $params['brand'];
        $date = $params['date'];
        $price = $params['price'];
        $manu = $params['manu'];

        if (!isset($id)) {
            return $stat = false;
        }
        elseif (!isset($model)) {
            return $stat = false;
        }
        elseif (!isset($date)) {
            return $stat = false;
        }
        elseif (!isset($price)) {
            return $stat = false;
        }
        elseif (!isset($manu)) {
            return $stat = false;
        }

        else {
            $update = "UPDATE $this->tblName SET brand ='$brand', date='$date', price='$price', manufacturer='$manu' WHERE id = '$id'";
            $update_stat = $this->conn->query($update);
            if ($update_stat) {
                return $update_stat;
            }
            else {
                return $stat = false;
            }
        }
    }
}

$data1 = new Alcoholic_Drinks();
$data1->create();

$request = $_SERVER['REQUEST_METHOD'];

$status = new Status();

// create and update
if ($request == "POST") {
    if (isset($_POST['id'])) {
        $update = $_POST;
        $update_stat = $data1->update($update);

        if ($update_stat) {
            $up_stats = $status->successful();
            echo json_encode($up_stats);
        }
        else {
            $up_stats = $status->error();
            echo json_encode($up_stats);
        }
    }
    else {
        $inserted_data = $_POST;
        $insert_stat = $data1->insert($inserted_data);

        if ($insert_stat) {
            $insert_stat = $status->created();
            echo json_encode($insert_stat);
            echo json_encode($inserted_data);
        }
        else {
            $insert_stat = $status->error();
            echo json_encode($insert_stat);
            echo json_encode($inserted_data);
        }   
    }
}

// read
elseif ($request == "GET") {
    $id = json_decode($_GET['id']);

    if (isset($id)) {
        $drinks_one = $data1->show($id);
        if ($drinks_one == null) {
            $get_stat = $status->not_found();
            echo json_encode($get_stat);
        }
        else {
            $get_stat = $status->found();
            echo json_encode($drinks_one);
            echo json_encode($get_stat);
        }
    }
    else {
        $all = $data1->showAll();
        if ($all == null) {
            $get_stat = $status->not_found();
            echo json_encode($get_stat);
        }
        else {
            $get_stat = $status->found();
            echo json_encode($all);
            echo json_encode($get_stat);
        }
    
    }
    
}
// delete
elseif ($request == "DELETE") {
    $id = $_GET['id'];
    $del = $data1->remove($id);

    if ($del == true) {
        $delete_stat = $status->successful();
        echo json_encode($delete_stat);
    }
    elseif ($del == false) {
        $delete_stat = $status->error();
        echo json_encode($delete_stat);
    }
}

// method not allowed
else {
    $req_stat = $status->method_error($request);
    echo json_encode($req_stat);
}

