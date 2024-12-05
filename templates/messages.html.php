<h2>Messages</h2>
<table>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Subject</th>
        <th>Preview</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($messages as $message): ?>
    <tr>
        <td><?= $message['id'] ?></td>
        <td><?= htmlspecialchars($message['username']) ?></td>
        <td><?= htmlspecialchars($message['subject']) ?></td>
        <td><?= htmlspecialchars(substr($message['content'], 0, 50)) . (strlen($message['content']) > 50 ? '...' : '') ?></td>
        <td><?= $message['status'] ?></td>
        <td><?= $message['created_at'] ?></td>
        <td>
            <a href="view_message.php?id=<?= $message['id'] ?>" class="button">View</a>
            <?php if ($message['status'] == 'unread'): ?>
            <form action="read.php" method="post" style="display: inline;">
                <input type="hidden" name="message_id" value="<?= $message['id'] ?>">
                <button type="submit" class = "button" >Mark as Read</button>
            </form>
            <?php endif; ?>
            <form action="deletemessage.php" method="post" style="display: inline;">
                <input type="hidden" name="message_id" value="<?= $message['id'] ?>">
                <button type="submit" class = "button delete" onclick="return confirm('Are you sure you want to delete this message?');">Delete</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>