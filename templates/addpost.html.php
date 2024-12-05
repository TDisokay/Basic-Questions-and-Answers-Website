<h2>Add a New Question</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
    </div>
    <div>
        <label for="module_id">Module:</label>
        <select id="module_id" name="module_id" required>
            <?php foreach ($modules as $module): ?>
                <option value="<?= $module['id'] ?>"><?= htmlspecialchars($module['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
    </div>
    <button type="submit" name="submit" class="button">Add Question</button>
</form>