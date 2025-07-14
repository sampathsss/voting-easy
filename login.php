<?php
session_start();
include('db.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $standard = $_POST['standard'];

    $sql = "SELECT * FROM userdata WHERE username='$username' AND password='$password' AND standard='$standard'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $userdata = mysqli_fetch_array($result);
        $_SESSION['userdata'] = $userdata;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Login failed. Invalid credentials.')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Voting System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Login as:</label>
            <select name="standard" required>
                <option value="voter">Voter</option>
                <option value="candidate">Candidate</option>
            </select>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
