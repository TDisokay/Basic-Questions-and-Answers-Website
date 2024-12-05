<?php
session_start();
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$title = 'Student Q&A System';
$posts = getRecentPosts($pdo, 5);

ob_start();
include 'templates/home.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';
?>