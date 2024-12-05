<h2>Welcome to Student Coursework Q&A</h2>
<p>This is a platform where students can ask and answer questions about their coursework.</p>

<h3>Recent Questions</h3>
<ul>
    
<?php foreach ($recentPosts = getRecentPosts($pdo, 3) as $post): ?>
    <li>
        <a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
        <span class="meta">by <?= htmlspecialchars($post['username']) ?> in <?= htmlspecialchars($post['module_name']) ?></span>
    </li>
<?php endforeach; ?>
</ul>

<a href="posts.php" class="button">View All Questions</a>