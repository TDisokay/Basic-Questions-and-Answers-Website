<?php
session_start();
include "includes/DatabaseFunctions.php";

if (isset($_POST['submit'])) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    try {
        addMessage($pdo, $user_id, $subject, $message);
        header('Location: contact.php?success=1');
        exit();
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        header('Location: contact.php?error=1');
        exit();
    }
}

$title = "Contact Us";
ob_start();
include "templates/contact.html.php";
$output = ob_get_clean();
include "templates/layout.html.php";
?>