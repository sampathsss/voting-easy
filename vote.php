<?php
session_start();
if ($_SESSION['role'] !== 'voter') {
    header("Location: login.php");
    exit;
}
echo "✅ Welcome Voter: " . htmlspecialchars($_SESSION['username']);
?>
