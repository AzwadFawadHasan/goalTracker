<h1>Create a New Goal</h1>
<form action="<?php echo site_url('dashboard/create_goal'); ?>" method="post">
    <input type="text" name="title" placeholder="Goal Title" required><br>
    <textarea name="description" placeholder="Goal Description"></textarea><br>
    <button type="submit">Create Goal</button>
</form>
