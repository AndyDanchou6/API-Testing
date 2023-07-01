<?php
<<<<<<< HEAD
//error_reporting(0);
=======
error_reporting(0);
>>>>>>> b1e556f6e1a145dfa695577b6a3b51c08938f674
include 'tables.php';
include 'db.php';
include 'status.php';
header('Content-Type: application/json');

class Gadgets extends Database implements Tables {
    public $tblName = 'gadgets';

    public function __construct() {
        $this->setup();
    }
    public function create() {
        $create = "CREATE TABLE if not exists $this->tblName (
            id int auto_increment primary key,
            model_name varchar(200),
            date_launched varchar(200),
            price int,
            amount_launched int,
            manufacturer varchar(200)
        )";
        $this->conn->query($create);;
    }
    public function insert(array $params) {
<<<<<<< HEAD
        $insert_stat = true;
=======
        $model = $params['model'];
        $date = $params['date'];
        $price = $params['price'];
        $amount = $params['amount'];
        $manu = $params['manu'];

        $insert = "INSERT INTO $this->tblName (model_name, date_launched, price, amount_launched, manufacturer)
            VALUES ('$model', '$date', '$price', '$amount', '$manu')";
        $res = $this->conn->query($insert);;
        return $res;
    }
    public function remove($id) {
>>>>>>> b1e556f6e1a145dfa695577b6a3b51c08938f674

        if ($params['model'] == null || $params['date'] == null || $params['price'] == null || $params['amount'] == null || $params['manu'] == null) {
            return $insert_stat = false;
        }

        elseif ($params['model'] == !null && $params['date'] == !null && $params['price'] == !null && $params['amount'] == !null && $params['manu'] == !null) {
            $model = $params['model'];
            $date = $params['date'];
            $price = $params['price'];
            $amount = $params['amount'];
            $manu = $params['manu'];
            $insert = "INSERT INTO $this->tblName (model_name, date_launched, price, amount_launched, manufacturer)
                VALUES ('$model', '$date', '$price', '$amount', '$manu')";
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
    public function show($id) {
        $get_gadget = "SELECT * FROM $this->tblName WHERE id = '$id' LIMIT 1";
        $one_item = $this->conn->query($get_gadget);
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
<<<<<<< HEAD
        $id = $params['id'];
        $model = $params['model'];
        $date = $params['date'];
        $price = $params['price'];
        $amount = $params['amount'];
        $manu = $params['manu'];
=======
>>>>>>> b1e556f6e1a145dfa695577b6a3b51c08938f674

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
        elseif (!isset($amount)) {
            return $stat = false;
        }
        elseif (!isset($manu)) {
            return $stat = false;
        }

        else {
            $update = "UPDATE $this->tblName SET model_name ='$model', date_launched='$date', price='$price', amount_launched='$amount', manufacturer='$manu' WHERE id = '$id'";
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

<<<<<<< HEAD


$data1 = new Gadgets();
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
        $gadget_one = $data1->show($id);
        if ($gadget_one == null) {
            $get_stat = $status->not_found();
            echo json_encode($get_stat);
        }
        else {
            $get_stat = $status->found();
            echo json_encode($gadget_one);
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

    echo json_encode($del);

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

// var_dump($status);
=======
$data1 = new Gadgets();
$data1->create();

$request = $_SERVER['REQUEST_METHOD'];

$status = new Status();

// create
if ($request == "POST") {
    $model = json_decode($_POST['model']);
    $price = json_decode($_POST['price']);
    $date = json_decode($_POST['date']);
    $amount = json_decode($_POST['amount']);
    $manu = json_decode($_POST['manu']);

    $data = [
        'model' => $model,
        'date' => $date,
        'price' => $price,
        'amount' => $amount,
        'manu' => $manu
    ];

// check if form is empty

    if ($data['model'] == null || $data['date'] == null || $data['price'] == null || $data['amount'] == null || $data['manu'] == null) {
        $error = $status->error();
        $error['error'] = "Please Insert All Information Needed";
        
        echo json_encode($data);
        echo json_encode($error);
    }

// execute insertion if requirements are meet
    elseif ($data['model'] == !null && $data['date'] == !null && $data['price'] == !null && $data['amount'] == !null && $data['manu'] == !null) {
        $data1->insert($data);
        $insert = $data1;
        if ($insert) {
            $insert_stat = $status->created();
            echo json_encode($insert_stat);
        }
        else {
            $insert_stat = $status->error();
            echo json_encode($insert_stat);
        }
    }
}

// read
elseif ($request == "GET") {
    $id = json_decode($_GET['id']);

    if (isset($id)) {
        $gadget_one = $data1->show($id);
        if ($gadget_one == null) {
            $get_stat = $status->not_found();
            echo json_encode($get_stat);
        }
        else {
            $get_stat = $status->found();
            echo json_encode($gadget_one);
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
// update
elseif ($request == "PATCH") { 
    echo $request;
}
// delete
elseif ($request == "DELETE") {
    echo $request;
}

// method not allowed
else {
    $req_stat = $status->method_error($request);
    echo json_encode($req_stat);
}

>>>>>>> b1e556f6e1a145dfa695577b6a3b51c08938f674
