<?php
session_start();
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT * FROM userdata WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    if ($user['role'] === 'voter') {
        header("Location: vote.php");
    } else {
        header("Location: dashboard.php");
    }
} else {
    echo "❌ Invalid login.";
}
?>
