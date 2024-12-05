<?php
session_start();
include "../includes/DatabaseFunctions.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('location: ../login.php');
    exit();
}

if (isset($_POST['id'])) {
    $postId = $_POST['id'];
    try {
        deletePost($pdo, $postId);
        header('location: posts.php?delete=success');
    } catch (PDOException $e) {
        header('location: posts.php?delete=error');
    }
    exit();
}

header('location: posts.php');
?>