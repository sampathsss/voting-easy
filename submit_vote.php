<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];
$candidate_id = $_POST['candidate_id'] ?? null;

if (!$candidate_id) {
    die("❌ Invalid selection.");
}

// Prevent duplicate votes
$check = $conn->prepare("SELECT * FROM votes WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$res = $check->get_result();
if ($res->num_rows > 0) {
    die("❌ You already voted.");
}

// Store vote
$stmt = $conn->prepare("INSERT INTO votes (username, candidate_id) VALUES (?, ?)");
$stmt->bind_param("si", $username, $candidate_id);

if ($stmt->execute()) {
    echo "✅ Thank you! Your vote has been recorded.";
} else {
    echo "❌ Failed to submit vote.";
}
?>
