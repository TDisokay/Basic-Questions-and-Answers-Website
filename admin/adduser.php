<?php
session_start();
include "../includes/DatabaseFunctions.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('location: ../login.php');
    exit();
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    addUser($pdo, $username, $email, $password, $is_admin);
    header('Location: manageuser.php');
    exit();
}

$title = "Add User";
ob_start();
include "../templates/adduser.html.php";
$output = ob_get_clean();
include "../templates/admin_layout.html.php";