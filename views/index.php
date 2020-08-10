<?php echo view('_header') ?>

<div>Sort</div>
<form action="" id="sort-form">
    <input type="hidden" name="page" value="<?= $_GET['page'] ?? 1 ?>">
    <div class="form-group">
        <select class="form-control" id="sort" name="sort">
            <?php foreach (['', 'username', 'email', 'status'] as $option): ?>
                <option value="<?php echo $option ?>" <?php echo $option == $_GET['sort'] ? 'selected' : '' ?>><?php echo $option ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</form>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Status</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as /** @var App\Models\Task $task */ $task): ?>
        <tr>
            <td><?php echo $task->getId() ?></td>
            <td><?php echo $task->getUsername() ?></td>
            <td><?php echo $task->getEmail() ?></td>
            <td><?php echo $task->getStatus() ?></td>
            <td><?php echo $task->getDescription() ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<nav>
    <?php echo $paginator ?>
</nav>

<?php echo view('_footer') ?>
