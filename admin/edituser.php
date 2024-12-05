<?php
session_start();
include "../includes/DatabaseFunctions.php";


if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('location: ../login.php');
    exit();
}


if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;
    updateUser($pdo, $id, $username, $email, $is_admin);
    header('Location: manageuser.php');
    exit();
}


$user = getUser($pdo, $_GET['id']);
$title = "Edit User";
ob_start();
include "../templates/edituser.html.php";
$output = ob_get_clean();
include "../templates/admin_layout.html.php";
?>
