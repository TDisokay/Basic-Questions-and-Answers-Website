<h2>Welcome to the Admin Dashboard</h2>

<div class="dashboard-grid">
    <div class="dashboard-item">
        <h3>Questions</h3>
        <p><?php echo getTotalPosts($pdo); ?></p>
        <a href="posts.php">Manage Posts</a>
    </div>
    <div class="dashboard-item">
        <h3>Users</h3>
        <p><?php echo getTotalUsers($pdo); ?></p>
        <a href="manageuser.php">Manage Users</a>
    </div>
    <div class="dashboard-item">
        <h3>Modules</h3>
        <p><?php echo getTotalModules($pdo); ?></p>
        <a href="modules.php">Manage Modules</a>
    </div>
    <div class="dashboard-item">
        <h3>Messages</h3>
        <p><?php echo getTotalMessages($pdo); ?></p>
        <a href="messages.php">View Messages</a>
    </div>
</div>