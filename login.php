<?php
session_start();
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM userdata WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    if ($user['role'] === 'voter') {
        header("Location: vote.php");
    } elseif ($user['role'] === 'candidate') {
        header("Location: dashboard.php");
    } else {
        echo "Unknown role.";
    }
} else {
    echo "Invalid username or password.";
}
?>
