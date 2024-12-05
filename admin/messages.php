<?php
session_start();
include "../includes/DatabaseConnection.php";
include "../includes/DatabaseFunctions.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('location: ../login.php');
    exit();
}

$title = "View Messages";
$messages = getAllMessages($pdo);

ob_start();
include "../templates/messages.html.php";
$output = ob_get_clean();
include "../templates/admin_layout.html.php";
?>