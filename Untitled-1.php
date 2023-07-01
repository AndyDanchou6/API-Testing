<?php

$conn = new mysqli('localhost', 'root', '');
$conn->query("CREATE DATABASE IF NOT EXISTS api_testing");
$conn = new mysqli('localhost', 'root', '', 'api_testing');

$delete = "DELETE FROM gadgets WHERE id = '1'";
$stat = $conn->query($delete);

echo var_dump($stat);