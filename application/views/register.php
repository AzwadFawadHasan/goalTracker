<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<?php if ($this->session->flashdata('error')): ?>
    <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
<?php endif; ?>

<form method="POST" action="<?php echo site_url('auth/register'); ?>">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Register</button>
</form>

<p>Already have an account? <a href="<?php echo site_url('auth/login'); ?>">Login here</a></p>

</body>
</html>
