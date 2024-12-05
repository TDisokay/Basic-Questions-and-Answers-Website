<?php
session_start();
include "../includes/DatabaseFunctions.php";
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('location: ../login.php');
    exit();
}
$title = "Manage Posts";
$posts = getAllPosts($pdo);
ob_start();
include "../templates/admin_posts.html.php";
$output = ob_get_clean();
include "../templates/admin_layout.html.php";
?>