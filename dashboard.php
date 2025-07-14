<?php
session_start();

// Optional: Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// You can safely access the session now
$username = $_SESSION['username'];
// $role = $_SESSION['role']; // Only if you store this
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body {
      font-family: Arial;
      background: #f1f1f1;
      padding: 20px;
    }
    .box {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 10px #ccc;
      max-width: 400px;
      margin: auto;
    }
  </style>
</head>
<body>
  <div class="box">
    <h2>Welcome, <?= htmlspecialchars($username) ?>!</h2>
    <p>You are now logged in.</p>
      <p><a href="vote.php">🗳️ Go Vote</a></p>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>
