<?php
session_start();
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$mobile = $_POST['mobile'] ?? '';

// Prepare the SQL statement to match all three fields
$stmt = $conn->prepare("SELECT * FROM userdata WHERE username = ? AND mobile = ?");
$stmt->bind_param("ss", $username, $mobile);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// If the user exists and password matches
if ($user && $password === $user['password']) {  // Or use password_verify() if password is hashed
    $_SESSION['username'] = $user['username'];
    header("Location: dashboard.php");
    exit();
} else {
    echo "❌ Invalid login.";
}
?>
