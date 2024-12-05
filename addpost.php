<?php
session_start();
include "includes/DatabaseFunctions.php";

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit();
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $module_id = $_POST['module_id'];
    $image_url = '';
    $imagePath = UPLOAD_PATH . basename($_FILES['image']['name']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_url = $target_file;
                }
            }
        }
    }

    addPost($pdo, $title, $content, $user_id, $module_id, $image_url);
    header('location: posts.php');
    exit();
} else {
    $modules = getAllModules($pdo);
    $title = "Add New Question";
    ob_start();
    include "templates/addpost.html.php";
    $output = ob_get_clean();
    include "templates/layout.html.php";
}
?>