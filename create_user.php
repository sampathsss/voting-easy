<?php
require 'db.php';

$username = "voter1";
$password = password_hash("123456", PASSWORD_DEFAULT);
$role = "voter"; // change to "candidate" if needed

$stmt = $pdo->prepare("INSERT INTO userdata (username, password, role) VALUES (?, ?, ?)");
$stmt->execute([$username, $password, $role]);

echo "✅ Test user added: $username / 123456 ($role)";
?>
