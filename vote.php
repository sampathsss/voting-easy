<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    echo "⛔ Session not set. Redirecting to login.";
    header("Location: login.php");
    exit();
} else {
    echo "✅ Logged in as: " . $_SESSION['userdata']['username'];
}
