<?php
session_start();
include "../includes/DatabaseFunctions.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('location: ../login.php');
    exit();
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    updateModule($pdo, $id, $name, $description);
    header('Location: modules.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: modules.php');
    exit();
}

$module = getModule($pdo, $_GET['id']);
if (!$module) {
    header('Location: modules.php');
    exit();
}

$title = "Edit Module";
ob_start();
include "../templates/editmodule.html.php";
$output = ob_get_clean();
include "../templates/admin_layout.html.php";
?>