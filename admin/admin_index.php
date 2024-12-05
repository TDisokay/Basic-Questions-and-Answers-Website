<?php
session_start();
include "../includes/DatabaseFunctions.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('location: ../login.php');
    exit();
}

$title = "Admin Dashboard"; 
ob_start();
include "../templates/dashboard.html.php";
$output = ob_get_clean();
include "../templates/admin_layout.html.php";
?>