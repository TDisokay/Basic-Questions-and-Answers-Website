<?php
session_start();
include "../includes/DatabaseConnection.php";
include "../includes/DatabaseFunctions.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('location: ../login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('location: messages.php');
    exit();
}

$messageId = $_GET['id'];
$message = getMessageById($pdo, $messageId);

if (!$message) {
    header('location: messages.php');
    exit();
}

$title = "View Message";

ob_start();
include "../templates/viewmessage.html.php";
$output = ob_get_clean();
include "../templates/admin_layout.html.php";
?>  