<?php
include "../includes/DatabaseFunctions.php";
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('location: ../login.php');
    exit();
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    addModule($pdo, $name, $description);
    header('Location: modules.php');
    exit();
}

$title = "Add Module";
ob_start();
include "../templates/addmodule.html.php";
$output = ob_get_clean();
include "../templates/admin_layout.html.php";
?>