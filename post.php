<?php
session_start();
include "includes/DatabaseFunctions.php";

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit(); 
}

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$post = getPost($pdo, $_GET['id']);
if (!$post) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_comment'])) {
    $content = $_POST['comment_content'];
    $image_url = null;

    if (isset($_FILES['comment_image']) && $_FILES['comment_image']['error'] == 0) {
        $target_dir = "uploads/comment_images/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . uniqid() . '_' . basename($_FILES["comment_image"]["name"]);
        if (move_uploaded_file($_FILES["comment_image"]["tmp_name"], $target_file)) {
            $image_url = $target_file;
        }
    }

    addComment($pdo, $post['id'], $_SESSION['user_id'], $content, $image_url);
    header('Location: post.php?id=' . $post['id']);
    exit();
}

$comments = getCommentsForPost($pdo, $_GET['id']);
$isOwner = isset($_SESSION['user_id']) && ($post['user_id'] == $_SESSION['user_id']);

$title = $post['title'];
ob_start();
include "templates/post.html.php";
$output = ob_get_clean();
include "templates/layout.html.php";
?>