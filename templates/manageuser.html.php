<h2>Manage Users</h2>
<a href="adduser.php" class="button">Add User</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['is_admin'] ? 'Yes' : 'No'; ?></td>
            <td>
                <a href="edituser.php?id=<?php echo $user['id']; ?>" class="button">Edit</a>
                <form action="deleteuser.php" method="post" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this module?');">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <button type="submit" class="button delete">Delete</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>