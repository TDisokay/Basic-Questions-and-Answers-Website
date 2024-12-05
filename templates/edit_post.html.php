<h2>Edit Question</h2>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $post['id'] ?>">
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
    </div>
    <div>
        <label for="content">Content:</label>
        <textarea id="content" name="content" rows="3" cols="50" required><?= htmlspecialchars($post['content']) ?></textarea>
    </div>
    <div>
        <label for="module_id">Module:</label>
        <select id="module_id" name="module_id" required>
            <?php foreach ($modules as $module): ?>
                <option value="<?= $module['id'] ?>" <?= $module['id'] == $post['module_id'] ? 'selected' : '' ?>><?= htmlspecialchars($module['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="image">Image:</label>
        <?php if ($post['image_url']): ?>
            <div class="post-image-preview">
                <img src="<?= htmlspecialchars($post['image_url']) ?>" alt="Post image" style="max-width: 300px;">
            </div>
        <?php endif; ?>
        <input type="file" name="image" accept="image/*">
    </div>
    <button type="submit" name="submit" class= "button">Update Post</button>
</form>