<?php
session_start();
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$mobile = $_POST['mobile'] ?? '';

echo "<h3>Debug Output</h3>";
echo "Username: $username<br>";
echo "Mobile: $mobile<br>";

// Step 1: Check database connection
if (!$conn) {
    die("❌ DB Connection failed.");
} else {
    echo "✅ Connected to DB.<br>";
}

// Step 2: Run the query
$stmt = $conn->prepare("SELECT * FROM userdata WHERE username = ? AND mobile = ?");
$stmt->bind_param("ss", $username, $mobile);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    echo "✅ User found.<br>";

    // DEBUG: Show stored password
    echo "DB password: " . $user['password'] . "<br>";

    // Step 3: Compare password
    if ($password === $user['password']) {
        echo "✅ Password matched.<br>";
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "❌ Password incorrect.<br>";
    }
} else {
    echo "❌ No matching user found with that username + mobile.<br>";
}
?>
