<h2>Edit User</h2>
<form action="" method="post">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    </div>
    <div>
        <label for="is_admin">Admin:</label>
        <input type="checkbox" id="is_admin" name="is_admin" value="1" <?= $user['is_admin'] ? 'checked' : '' ?>>
    </div>
    <button type="submit" name="submit" class="button">Update User</button>
</form>
