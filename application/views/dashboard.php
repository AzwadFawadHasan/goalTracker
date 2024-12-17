<h1>Welcome to your Dashboard</h1>
<p>You are logged in!</p>

<a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-danger">Logout</a>
<h3>Your Goals</h3>
<a href="<?php echo site_url('dashboard/create_goal'); ?>" class="btn btn-primary">Create New Goal</a>

<ul>
    <?php foreach ($goals as $goal): ?>
        <li>
            <h4><?php echo $goal->title; ?></h4>
            <p><?php echo $goal->description; ?></p>
            <p>Status: <?php echo $goal->status; ?></p>
            <a href="<?php echo site_url('dashboard/edit_goal/' . $goal->id); ?>">Edit</a>
            <a href="<?php echo site_url('dashboard/delete_goal/' . $goal->id); ?>">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>
