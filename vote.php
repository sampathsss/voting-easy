<?php
session_start();
include("db.php");

if (!isset($_SESSION['userdata'])) {
    header("Location: login.php");
    exit();
}

$userdata = $_SESSION['userdata'];
