<?php
session_start();
include('db.php');

if (!isset($_SESSION['userdata'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['userdata'];
$voter_id = $user['id'];
$selected_candidate = $_POST['candidate_id'];

// Prevent double voting
$check_status = mysqli_query($conn, "SELECT status FROM userdata WHERE id=$voter_id");
$status = mysqli_fetch_assoc($check_status)['status'];

if ($status == 1) {
    echo "<script>alert('You have already voted!'); window.location='dashboard.php';</script>";
} else {
    // 1. Update candidate vote count
    mysqli_query($conn, "UPDATE userdata SET votes = votes + 1 WHERE id = $selected_candidate");

    // 2. Set voter's status to 1 (voted)
    mysqli_query($conn, "UPDATE userdata SET status = 1 WHERE id = $voter_id");

    echo "<script>alert('Vote submitted successfully!'); window.location='dashboard.php';</script>";
}
?>
