<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<?php if ($this->session->flashdata('error')): ?>
    <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
<?php endif; ?>

<form method="POST" action="<?php echo site_url('auth/login'); ?>">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="<?php echo site_url('auth/register'); ?>">Register here</a></p>

</body>
</html>
