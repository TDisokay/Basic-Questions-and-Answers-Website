<?php
require_once '../includes/DatabaseFunctions.php';

$posts = getAllPosts($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Questions</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/admin_styles.css">
</head>
<body>
    <div class="admin-container">
        <h1>Manage Questions</h1>
        <div class="posts-list">
            <?php foreach ($posts as $post): ?>
                <div class="post-item">
                    <h2><?= htmlspecialchars($post['title']) ?></h2>
                    <div class="post-meta">
                        <span>By: <?= htmlspecialchars($post['username']) ?></span>
                        <span>Date: <?= htmlspecialchars($post['created_at']) ?></span>
                    </div>
                    <?php if ($post['image_url']): ?>
                        <div class="post-image-frame">
                            <img src="<?= htmlspecialchars(getImageUrl($post['image_url'])) ?>" alt="Post Image" class="post-image">
                        </div>
                    <?php endif; ?>
                    <div class="post-content">
                        <?= nl2br(htmlspecialchars($post['content'])) ?>
                    </div>
                    <div class="post-actions">
                        <a href="editpost.php?id=<?= $post['id'] ?>" class="button">Edit</a>
                        <a href="deletepost.php?id=<?= $post['id'] ?>" class="button delete" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>