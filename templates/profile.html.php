<div class="profile-container">
    <h2><?= htmlspecialchars($user['username']) ?>'s Profile</h2>
    
    <?php if (!$edit_mode): ?>
        <img src="<?= htmlspecialchars($user['profile_picture'] ?? 'default_profile.jpg') ?>" alt="Profile Picture" class="profile-picture">
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Bio:</strong> <?= nl2br(htmlspecialchars($user['bio'] ?? 'No bio available.')) ?></p>
        
        <?php if ($user['social_media']): ?>
            <?php $social_media = json_decode($user['social_media'], true); ?>
            <h3>Social Media:</h3>
            <ul>
                <?php foreach ($social_media as $platform => $link): ?>
                    <?php if ($link): ?>
                        <li><strong><?= ucfirst($platform) ?>:</strong> <a href="<?= htmlspecialchars($link) ?>" target="_blank"><?= htmlspecialchars($link) ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
        <p><strong>Member since:</strong> <?= htmlspecialchars($user['created_at']) ?></p>
        <a href="?edit=true" class="button">Edit Profile</a>
    <?php else: ?>
        <form action="profile.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture">
            </div>
            <h3>Social Media:</h3>
            <?php $social_media = json_decode($user['social_media'] ?? '{}', true); ?>
            <div class="form-group">
                <label for="facebook">Facebook:</label>
                <input type="url" id="facebook" name="facebook" value="<?= htmlspecialchars($social_media['facebook'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="linkedin">LinkedIn:</label>
                <input type="url" id="linkedin" name="linkedin" value="<?= htmlspecialchars($social_media['linkedin'] ?? '') ?>">
            </div>
            <button type="submit" name="update_profile" class="button">Update Profile</button>
            <a href="profile.php" class="button delete">Cancel</a>
        </form>
    <?php endif; ?>
</div>