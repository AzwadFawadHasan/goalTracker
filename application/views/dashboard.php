<!-- application/views/dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to your Dashboard</h1>
    <p>You are logged in!</p>
    <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-danger">Logout</a>

</body>
</html>
