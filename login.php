<?php
session_start();
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$mobile = $_POST['mobile'] ?? '';

// Avoid echoing anything before header
$stmt = $conn->prepare("SELECT * FROM userdata WHERE username = ? AND mobile = ?");
$stmt->bind_param("ss", $username, $mobile);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && $password === $user['password']) {
    $_SESSION['username'] = $user['username'];
    header("Location: dashboard.php");
    exit();
} else {
    echo "❌ Invalid login.";
}
?>
