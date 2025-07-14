<?php
$host = "sql12.freesqldatabase.com";
$user = "sql12789971";
$password = "ueh9xCfYYq";
$database = "sql12789971";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
