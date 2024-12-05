<?php
session_start();
include "includes/DatabaseFunctions.php";

$title = "All Questions";
$totalPosts = getTotalPosts($pdo);
$posts = getAllPosts($pdo);
$modules = getAllModules($pdo);

ob_start();
include "templates/posts.html.php";
$output = ob_get_clean();
include "templates/layout.html.php";
?>