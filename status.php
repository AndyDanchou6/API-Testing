<?php
class Status {
    public $data = array();
    public function successful() {
        $this->data['status'] = 200;
        $this->data['message'] = "Operation Successful";
        return $this->data;
    }
    public function created() {
        $this->data['status'] = 201;
        $this->data['message'] = "Successfully Created";
        return $this->data;
    }
    public function found() {
        $this->data['status'] = 200;
        $this->data['message'] = "Data Match Found";
        return $this->data;
    }
    public function not_found() {
        $this->data['status'] = 404;
        $this->data['message'] = "Data not found";
        return $this->data;
    }
    public function error() {
        $this->data['status'] = 500;
        $this->data['message'] = "Something went wrong";
        return $this->data;
    }
    public function method_error($request) {
        $this->data['status'] = 400;
        $this->data['message'] = $request. " method not Allowed";
        return $this->data;
    }
}


// $data = new Status();
// $data->created();

// var_dump($data);
?>