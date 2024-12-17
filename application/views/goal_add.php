
<form action="<?= base_url('goal/add') ?>" method="POST">
    <label for="title">Goal Title:</label>
    <input type="text" name="title" id="title" required>
    
    <label for="description">Goal Description:</label>
    <textarea name="description" id="description" required></textarea>

    <button type="submit">Add Goal</button>
</form>
