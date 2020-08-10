<?php echo view('_header') ?>

<form method="post" action="/create-task">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username">
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <input type="text" class="form-control" id="status">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php echo view('_footer') ?>