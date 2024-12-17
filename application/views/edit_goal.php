<h1>Edit Goal</h1>
<form action="<?php echo site_url('dashboard/update_goal/' . $goal->id); ?>" method="post">
    <input type="text" name="title" value="<?php echo $goal->title; ?>" required><br>
    <textarea name="description"><?php echo $goal->description; ?></textarea><br>
    <select name="status">
        <option value="pending" <?php echo $goal->status == 'pending' ? 'selected' : ''; ?>>Pending</option>
        <option value="completed" <?php echo $goal->status == 'completed' ? 'selected' : ''; ?>>Completed</option>
    </select><br>
    <button type="submit">Update Goal</button>
</form>
