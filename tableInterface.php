<?php

interface Tables {
    public $tblName;

    public function create();
    public function insert();
    public function remove();
    public function showAll();
}