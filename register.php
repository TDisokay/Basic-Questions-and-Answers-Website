<?php
include "includes/DatabaseFunctions.php";

if (isset($_POST['register'])) {
    $result = registerUser($pdo, $_POST['username'], $_POST['email'], $_POST['password']);
    if ($result === true) {
        $success = "Registration successful. You can now log in.";
    } else {
        $error = $result;
    }
}

$title = "Register";
ob_start();
include "templates/register.html.php";
$output = ob_get_clean();
include "templates/layout.html.php";
?>