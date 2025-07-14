<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Voting System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="voter">Voter</option>
                <option value="candidate">Candidate</option>
            </select><br>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($_SESSION['error'])) { echo "<p class='error'>{$_SESSION['error']}</p>"; unset($_SESSION['error']); } ?>
    </div>
</body>
</html>
