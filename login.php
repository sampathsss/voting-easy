<?php
session_start();
$conn = new mysqli("localhost", "root", "", "voting_db");

$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = ?");
$stmt->bind_param("ss", $username, $role);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: " . ($role === "voter" ? "vote.php" : "dashboard.php"));
        exit;
    }
}

$_SESSION['error'] = "Invalid credentials.";
header("Location: index.php");
