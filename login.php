<?php
session_start();
$conn = new mysqli("localhost", "root", "", "voting_db");

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'voter') {
            header("Location: vote.php");
        } else if ($user['role'] === 'candidate') {
            header("Location: dashboard.php");
        } else {
            $_SESSION['error'] = "Unknown user role.";
            header("Location: index.php");
        }
        exit;
    }
}

$_SESSION['error'] = "Invalid username or password.";
header("Location: index.php");
exit;
