<?php
session_start();
include "includes/DatabaseFunctions.php";

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit();
}

if (isset($_POST['id'])) {
    $post = getPost($pdo, $_POST['id']);
    if ($post['user_id'] == $_SESSION['user_id']) {
        deletePost($pdo, $_POST['id']);
    }
}

header('location: index.php');
?>