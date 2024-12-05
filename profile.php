<?php
session_start();
include "includes/DatabaseFunctions.php";

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$user = getUserProfile($pdo, $user_id);

$edit_mode = isset($_GET['edit']) && $_GET['edit'] == 'true';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $profile_picture = $user['profile_picture']; 

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $profile_picture = $target_file;
        }
    }

    $social_media = [
        'linkedin' => $_POST['linkedin'],
        'facebook' => $_POST['facebook']
    ];

    updateUserProfile($pdo, $user_id, $username, $email, $bio, $profile_picture, $social_media);
    $user = getUserProfile($pdo, $user_id); 
    $edit_mode = false;
}

$title = "User Profile";
ob_start();
include "templates/profile.html.php";
$output = ob_get_clean();
include "templates/layout.html.php";
?>