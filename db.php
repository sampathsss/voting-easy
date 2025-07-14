<?php
$host = "sql12.freesqldatabase.com";
$dbname = "sql12789971";
$user = "sql12789971";
$pass = "ueh9xCfYYq";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Database connection failed: " . $e->getMessage());
}
?>
