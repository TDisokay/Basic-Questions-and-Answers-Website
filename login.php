<?php
session_start();
require_once "includes/DatabaseConnection.php";
require_once "includes/DatabaseFunctions.php";

$user = null;

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = authenticateUser($pdo, $username, $password);
}

if ($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['is_admin'] = $user['is_admin'];
    $_SESSION['user_type'] = $user['is_admin'] ? 'admin' : 'user';
    if ($_SESSION['is_admin']) {
        header('Location: admin/admin_index.php');
    } else {
        header('Location: index.php');
    }
    exit();
}

$title = "Login";
ob_start();
include "templates/login.html.php";
$output = ob_get_clean();
include "templates/layout.html.php";
?>