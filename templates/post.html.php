<div class="post-container">
    <div class="post-header">
        <h2 class="post-title"><?= htmlspecialchars($post['title']) ?></h2>
        <div class="post-meta">
            Posted on <?= date('F j, Y', strtotime($post['created_at'])) ?>
        </div>
    </div>
    <?php if ($post['image_url']): ?>
        <img src="<?= htmlspecialchars($post['image_url']) ?>" alt="Post image" class="post-image">
    <?php endif; ?>
    <div class="post-content">
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </div>
    <div class="post-actions">
        <button onclick="location.href='editpost.php?id=<?= $post['id'] ?>'" class="button">Edit</button>
        <form action="deletepost.php" method="post" style="display: inline;">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <button type="submit" class="button delete">Delete</button>
        </form>
    </div>
</div>

<div class="comments-section">
    <h3>Answers</h3>
    <?php foreach ($comments as $comment): ?>
    <div class="comment">
        <div class="comment-header">
            <img src="<?= htmlspecialchars($comment['profile_picture'] ?? 'default_profile.jpg') ?>" alt="Profile Picture" class="comment-profile-pic">
            <span class="comment-username"><?= htmlspecialchars($comment['username']) ?></span>
            <span class="comment-date"><?= htmlspecialchars($comment['created_at']) ?></span>
        </div>
        <p class="comment-content"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
        <?php if ($comment['image_url']): ?>
        <div class="comment-image-frame">
            <img src="<?= htmlspecialchars($comment['image_url']) ?>" alt="Comment Image" class="comment-image">
        </div>
    <?php endif; ?>
</div>
<?php endforeach; ?>


<form action="post.php?id=<?= $post['id'] ?>" method="post" enctype="multipart/form-data" class="comment-form">
    <textarea name="comment_content" required placeholder="Write your answer here..."></textarea>

    <div class="post-actions">
        <input type="file" name="comment_image" accept="image/*">
        <button type="submit" name="submit_comment" class="button">Post Answers</button>
    </div>
</form>
</div>