<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $standard = $_POST['standard'];

    $query = "SELECT * FROM userdata WHERE username='$username' AND password='$password' AND standard='$standard'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $userdata = mysqli_fetch_array($result);
        $_SESSION['userdata'] = $userdata;
        echo "<script>window.location = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Invalid login!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login Page</h2>

<form method="POST"> <!-- ✅ form submits to the same file -->
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <select name="standard">
        <option value="voter">Voter</option>
        <option value="candidate">Candidate</option>
    </select><br><br>
    <input type="submit" name="loginbtn" value="Login">
</form>

</body>
</html>
