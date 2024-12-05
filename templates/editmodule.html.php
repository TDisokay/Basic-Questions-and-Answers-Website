<h2>Edit Module</h2>
<form method="post" action="">
    <div>
        <input type="hidden" name="id" value="<?= $module['id'] ?>">
        <label for="name">Module Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($module['name']) ?>" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="3" cols="50" required><?= htmlspecialchars($module['description']) ?></textarea>
    </div>
    <input type="submit" name="submit" value="Update Module">
</form>