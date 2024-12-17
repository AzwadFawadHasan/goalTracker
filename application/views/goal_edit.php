
<form action="<?= base_url('goal/update/'.$goal->id) ?>" method="POST">
    <input type="text" name="title" value="<?= $goal->title ?>" required>
    <textarea name="description" required><?= $goal->description ?></textarea>
    <button type="submit">Update Goal</button>
</form>
