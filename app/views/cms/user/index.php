<?php
include(__DIR__ . "/../../header.php");

?>
<br />
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="/user/displayCreate" role="button">Create</a>
    </div>
    <div class=" card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($model as $user) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $user->getId(); ?></td>
                            <td><?php echo $user->getUsername(); ?></td>
                            <td>********</td>
                            <td><?php echo $user->getEmail(); ?></td>
                            <td><?php echo $user->getRole();  ?></td>
                            <td>
                                <input name="editbtn" id="editbtn" class="btn btn-info" type="button" value="Edit" onclick="location='/user/edit?userId=<?php echo $user->getId(); ?>'">
                                <input name="deletebtn" id="deletebtn" class="btn btn-danger" type="button" value="Delete" onclick="location='/user/delete?userId=<?php echo $user->getId(); ?>'">
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<script>
    function deleteUs(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    }
</script>

<?php include(__DIR__ . "/../../footer.php"); ?>