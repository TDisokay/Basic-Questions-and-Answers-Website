<?php
session_start();
include "../includes/DatabaseFunctions.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('location: ../login.php');
    exit();
}

if (isset($_POST['message_id'])) {
    $messageId = $_POST['message_id'];
    deleteMessage($pdo, $messageId);
}

header('Location: messages.php');
exit();