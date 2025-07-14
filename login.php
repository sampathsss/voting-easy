<?php
session_start();
include("db.php");

if (isset($_SESSION['userdata'])) {
    header("Location: vote.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $standard = $_POST['standard'] ?? '';

    if (empty($standard)) {
        echo "<script>alert('Please select your role (voter or candidate)');</script>";
    } else {
        $query = "SELECT * FROM userdata WHERE username='$username' AND password='$password' AND standard='$standard'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['userdata'] = mysqli_fetch_array($result);
            header("Location: vote.php");
            exit();
        } else {
            echo "<script>alert('Invalid login credentials');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>

    <input type="password" name="password" placeholder="Password" required><br><br>

    <select name="standard" required>
        <option value="">-- Login as --</option>
        <option value="voter">Voter</option>
        <option value="candidate">Candidate</option>
    </select><br><br>

    <input type="submit" value="Login">
</form>

</body>
</html>
