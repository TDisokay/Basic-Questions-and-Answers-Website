<h2>Message Details</h2>
<p><strong>From:</strong> <?= htmlspecialchars($message['username']) ?></p>
<p><strong>Subject:</strong> <?= htmlspecialchars($message['subject']) ?></p>
<p><strong>Sent at:</strong> <?= $message['created_at'] ?></p>
<p><strong>Status:</strong> <?= $message['status'] ?></p>
<h3>Content:</h3>
<p><?= nl2br(htmlspecialchars($message['content'])) ?></p>

<a href="messages.php" class="button">Back to Messages</a>
