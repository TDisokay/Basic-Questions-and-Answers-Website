<h2>Manage Modules</h2>
<a href="addmodule.php" class="button">Add New Module</a>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($modules as $module): ?>
        <tr>
            <td><?= htmlspecialchars($module['name']) ?></td>
            <td><?= nl2br(htmlspecialchars(substr($module['description'], 0, 100))) ?>...</td>
            <td>
                <a href="editmodule.php?id=<?= $module['id'] ?>" class="button">Edit</a>
                <form action="deletemodule.php" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this module?');">
                    <input type="hidden" name="id" value="<?= $module['id'] ?>">
                    <button type="submit" class="button delete">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>