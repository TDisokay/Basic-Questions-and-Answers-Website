<h2>Register</h2>

<?php if (isset($error)): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>

<?php if (isset($success)): ?>
    <p class="success"><?= $success ?></p>
<?php endif; ?>

<form action="" method="post">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit" name="register" class= "button">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login here</a></p>