<?php
session_start();
if ($_SESSION['role'] !== 'candidate') {
    header("Location: login.php");
    exit;
}
echo "📊 Welcome Candidate: " . htmlspecialchars($_SESSION['username']);
?>
