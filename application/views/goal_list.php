
<?php foreach ($goals as $goal): ?>
    <div>
        <h3><?= $goal->title ?></h3>
        <p><?= $goal->description ?></p>
        <a href="<?= base_url('goal/edit/'.$goal->id) ?>">Edit</a>
        <a href="<?= base_url('goal/delete/'.$goal->id) ?>">Delete</a>
    </div>
<?php endforeach; ?>
