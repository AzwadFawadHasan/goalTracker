<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <?php echo validation_errors(); ?>
    <form action="<?php echo site_url('auth/register_process'); ?>" method="post">
        <label>Username: </label>
        <input type="text" name="username" required>
        <br>
        <label>Email: </label>
        <input type="email" name="email" required>
        <br>
        <label>Password: </label>
        <input type="password" name="password" required>
        <br>
        <label>Confirm Password: </label>
        <input type="password" name="confirm_password" required>
        <br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="<?php echo site_url('auth/login'); ?>">Login here</a></p>
</body>
</html>
