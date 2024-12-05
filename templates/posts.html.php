<h2>All Questions</h2>
<p>Total questions: <?= $totalPosts ?></p> 

<?php foreach ($posts as $post): ?>
    <article class="post">
        <h3><a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h3>
        <p class="excerpt"><?= htmlspecialchars(substr($post['content'], 0, 150)) ?>...</p>
        <div class="meta">
            Posted by <?= htmlspecialchars($post['username']) ?>
            in <?= htmlspecialchars($post['module_name']) ?>
            on <?= date('F j, Y', strtotime($post['created_at'])) ?>
        </div>
    </article>
<?php endforeach; ?>