<?php
include(__DIR__ . "/../../header.php");


?>
<div class="card">
    <div class="card-header">
        Edit User
    </div>
    <div class="card-body">
        <form action="/user/edit" method="post" enctype="multipart/form-data" id="edit-form">
            <div class="mb-3">
                <label for="username" class="form-label">Id: <?php echo $user->getId(); ?></label>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="<?php echo $user->getUsername(); ?>">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password:</label>
                <input type="password" class="form-control" name="pass" id="pass" placeholder="********">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo $user->getEmail(); ?>">
            </div>
            <div class="mb-3">
                <label for="roles" class="form-label">Role:</label>
                <select name="roles" id="roles">
                    <option value="admin">Customer</option>
                    <option value="user">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Edit</button>
            <a name="" id="" class="btn btn-primary" href="/user" role="button">Cancel</a>

        </form>
    </div>

</div>
<?php include(__DIR__ . "/../../footer.php"); ?>