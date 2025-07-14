<?php
session_start();

// Database connection (LIVE SERVER)
$host = "sql12.freesqldatabase.com";
$user = "sql12789971";
$password = "ueh9xCfYYq";
$database = "sql12789971";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get login form data
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Prepare statement to avoid SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check user found
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password (MUST be hashed in DB)
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] === 'voter') {
            header("Location: vote.php");
        } elseif ($user['role'] === 'candidate') {
            header("Location: dashboard.php");
        } else {
            $_SESSION['error'] = "Unknown user role.";
            header("Location: index.php");
        }
        exit;
    } else {
        $_SESSION['error'] = "Incorrect password.";
    }
} else {
    $_SESSION['error'] = "User not found.";
}

header("Location: index.php");
exit;
