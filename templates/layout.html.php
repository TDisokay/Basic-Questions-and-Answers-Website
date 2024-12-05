<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1><span class="highlight">Student Q&A System</span></h1>
            </div>
            <nav>
                <ul>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="posts.php">Questions</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    <?php elseif ($_SESSION['is_admin']): ?>
                        <li><a href="admin/admin_index.php">Admin Home</a></li>
                        <li><a href="admin/posts.php">Manage Questions</a></li>
                        <li><a href="admin/users.php">Manage Users</a></li>
                        <li><a href="admin/modules.php">Manage Modules</a></li> 
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="posts.php">Questions</a></li>
                        <li><a href="addpost.php">Add Question</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="contact.php">Contact us</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <main class="main">
            <?= $output ?>
        </main>
    </div>
    <footer>
        <p>&copy; 2023 Student Q&A System</p>
    </footer>
</body>
</html>