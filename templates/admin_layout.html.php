<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Admin</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1><span class="highlight">Admin</span> Dashboard</h1>
            </div>
            <nav>   
                <ul>
                    <li><a href="admin_index.php">Home</a></li>
                    <li><a href="posts.php">Questions</a></li>
                    <li><a href="manageuser.php">Manage Users</a></li>
                    <li><a href="modules.php">Manage Modules</a></li>
                    <li><a href="messages.php">Messages</a></li>
                    <li><a href="../logout.php">Logout</a></li>
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
        <p>&copy; <?= date('Y') ?> Student Q&A System - Admin Area</p>
    </footer>
</body>
</html>