<?php
error_reporting(0);
include 'tables.php';
include 'db.php';
include 'status.php';
header('Content-Type: application/json');

class Car extends Database implements Tables {
    public $tblName = 'car';

    public function __construct() {
        $this->setup();
        $this->create();
    }
    public function create() {
        $create = "CREATE TABLE if not exists $this->tblName (
            id int auto_increment primary key,
            model_name varchar(200),
            engine_type varchar(200),
            drive_type varchar(200),
            price int,
            manufacturer varchar(200)
        )";
        $this->conn->query($create);
    }
    public function insert(array $params) {
        $insert_stat = true;

        if ($params['model'] == null || $params['engine'] == null || $params['drive'] == null || $params['price'] == null || $params['manu'] == null) {
            return $insert_stat = false;
        }

        elseif ($params['model'] == !null && $params['engine'] == !null && $params['drive'] == !null && $params['price'] == !null && $params['manu'] == !null) {
            $model = $params['model'];
            $engine = $params['engine'];
            $drive = $params['drive'];
            $price = $params['price'];
            $manu = $params['manu'];
            $insert = "INSERT INTO $this->tblName (model_name, engine_type, drive_type, price, manufacturer)
                VALUES ('$model', '$engine', '$drive', '$price', '$manu')";
            $res = $this->conn->query($insert);
            if ($res) {
                return $insert_stat = true;
            }
            else {
                return $insert_stat = false;
            }
        }
    }
    public function remove($id) {
        $delete = "DELETE FROM $this->tblName WHERE id = '$id'";
        $stat = $this->conn->query($delete);
        return $stat;
    }
    public function show($id) {
        $get_gadget = "SELECT * FROM $this->tblName WHERE id = '$id' LIMIT 1";
        $one_item = $this->conn->query($get_gadget);
        $fetch_one = mysqli_fetch_assoc($one_item);
        return $fetch_one;
    }
    public function showAll() {
        $get_all = "SELECT * FROM $this->tblName";
        $all = $this->conn->query($get_all);
        $fetch_all = mysqli_fetch_all($all);
        return $fetch_all;
    }
    public function update(array $params) {
        $id = $params['id'];
        $model = $params['model'];
        $engine = $params['engine'];
        $drive = $params['drive'];
        $price = $params['price'];
        $manu = $params['manu'];

        $update = "UPDATE $this->tblName SET model_name ='$model', engine_type='$engine', drive_type='$drive', price='$price', manufacturer='$manu' WHERE id = '$id'";
        $update_stat = $this->conn->query($update);
        if ($update_stat) {
            return $update_stat;
        }
        else {
            return $stat = false;
        }
    }
}



$data1 = new Car();

$request = $_SERVER['REQUEST_METHOD'];

$status = new Status();

// create and update
if ($request == "POST") {
    if (isset($_POST['id'])) {
        if ($_POST['model'] == null) {
            $up_stats = $status->error();
            $up_stats['solution'] = "Add model";
            echo json_encode($up_stats);
        }
        elseif ($_POST['engine'] == null) {
            $up_stats = $status->error();
            $up_stats['solution'] = "Add engine type";
            echo json_encode($up_stats);
        }
        elseif ($_POST['drive'] == null) {
            $up_stats = $status->error();
            $up_stats['solution'] = "Add drive type";
            echo json_encode($up_stats);
        }
        elseif ($_POST['price'] == null) {
            $up_stats = $status->error();
            $up_stats['solution'] = "Add price";
            echo json_encode($up_stats);
        }
        elseif ($_POST['manu'] == null) {
            $up_stats = $status->error();
            $up_stats['solution'] = "Add manufacturer";
            echo json_encode($up_stats);
        }

        else {
            //$update = $_POST;
            $update_stat = $data1->update($_POST);

            if ($update_stat) {
                $up_stats = $status->successful();
                echo json_encode($up_stats);
            }
            else {
                $up_stats = $status->error();
                echo json_encode($up_stats);
            }
        }
    }
    
// create
    else {
        if ($_POST['model'] == null) {
            $up_stats = $status->error();
            $up_stats['solution'] = "Add model";
            echo json_encode($up_stats);
        }
        elseif ($_POST['engine'] == null) {
            $up_stats = $status->error();
            $up_stats['solution'] = "Add engine type";
            echo json_encode($up_stats);
        }
        elseif ($_POST['drive'] == null) {
            $up_stats = $status->error();
            $up_stats['solution'] = "Add drive type";
            echo json_encode($up_stats);
        }
        elseif ($_POST['price'] == null) {
            $up_stats = $status->error();
            $up_stats['solution'] = "Add price";
            echo json_encode($up_stats);
        }
        elseif ($_POST['manu'] == null) {
            $up_stats = $status->error();
            $up_stats['solution'] = "Add manufacturer";
            echo json_encode($up_stats);
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
}
// read
elseif ($request == "GET") {
    $id = json_decode($_GET['id']);

    if (isset($id)) {
        $car_one = $data1->show($id);
        if ($car_one == null) {
            $get_stat = $status->not_found();
            echo json_encode($get_stat);
        }
        else {
            $get_stat = $status->found();
            echo json_encode($car_one);
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

    if ($id == null) {
        $del_stats = $status->error();
        $del_stats['solution'] = "Insert id";
        echo json_encode($del_stats);
    }
    else {
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
}
// method not allowed
else {
    $req_stat = $status->method_error($request);
    echo json_encode($req_stat);
}

