<?php
session_start();
include "../includes/DatabaseFunctions.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('location: ../login.php');
    exit();
}

$title = "Manage Modules";
$modules = getAllModules($pdo);

ob_start();
include "../templates/modules.html.php";
$output = ob_get_clean();
include "../templates/admin_layout.html.php";
?>