<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Voting System - Login</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
  <h2>Login</h2>

  <label>Username</label>
  <input type="text" name="username" required><br><br>

  <label>Password</label>
  <input type="password" name="password" required><br><br>

  <label>Mobile Number</label>
  <input type="text" name="mobile" required><br><br>

  <button type="submit">Login</button>
</form>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>{$_SESSION['error']}</p>";
            unset($_SESSION['error']);
        }
        ?>
    </div>
</body>
</html>
