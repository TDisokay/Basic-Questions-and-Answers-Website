<?php
session_start();
include "../includes/DatabaseFunctions.php";


if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('location: ../login.php');
    exit();
}


if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $module_id = $_POST['module_id'];
    $image_url = $_POST['current_image'];
    $imagePath = UPLOAD_PATH . basename($_FILES['image']['name']);
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../uploads/";
        $image_url = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_url);
    }
    updatePost($pdo, $id, $title, $content, $module_id, $image_url);
    header('location: posts.php');
} else {
    $post = getPost($pdo, $_GET['id']);
    $modules = getAllModules($pdo);
    $title = "Edit Question";
    ob_start();
    include "../templates/edit_post.html.php";
    $output = ob_get_clean();
    include "../templates/admin_layout.html.php";
}
?>
