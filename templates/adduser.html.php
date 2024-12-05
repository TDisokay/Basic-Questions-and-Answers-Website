<h2>Add User</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="is_admin" name="is_admin">
        <label class="form-check-label" for="is_admin">
            Admin
        </label>
    </div>
    <button type="submit" name="submit" class="button">Add User</button>
</form>