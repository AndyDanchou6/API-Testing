<?php

interface Tables {
    public function create();
    public function insert($name, $date, $price, $amount, $manu);
    public function remove();
    public function showAll();
}