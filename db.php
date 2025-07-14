<?php
$host = "sql201.infinityfree.com";
$user = "if0_39467487";
$password = "MvkbgO2RHZAZ";
$database = "if0_39467487_epiz_12345678_voting";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
