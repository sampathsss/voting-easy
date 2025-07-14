<?php
session_start();
include("db.php");

// Only redirect if user is already logged in
if (isset($_SESSION['userdata'])) {
    header("Location: vote.php");
    exit();
}

// Handle login POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $standard = $_POST['standard'];

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
?>
