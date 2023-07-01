<?php

interface Tables {
    public function create();
    public function insert(array $params);
    public function remove($id);
    public function showAll();
    public function show($id);
    public function update(array $params);
}