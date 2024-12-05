<?php
session_start();
include "../includes/DatabaseFunctions.php";


if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('location: ../login.php');
    exit();
}


if (isset($_POST['id'])) {
    deleteUser($pdo, $_POST['id']);
}
header('Location: manageuser.php');
?>