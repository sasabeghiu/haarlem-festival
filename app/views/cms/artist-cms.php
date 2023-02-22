<?php
include __DIR__ . '/../header.php';
?>

<h1 class="text-center">Manage Artists</h1>
<div>
    <button class="btn btn-success mb-2" id="show-add-form">Add artist</button>
</div>

<!-- fix the form with images -->
<!-- hidden form to add a new artist -->
<div id="form-add-container" style="display: none;">
    <form method="POST">
        <div class="form-group row mb-1">
            <label for="name" class="col-sm-2 col-form-label">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
        </div>
        <div class="form-group row mb-1">
            <label for="description" class="col-sm-2 col-form-label">Description:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
        </div>
        <div class="form-group row mb-1">
            <label for="type" class="col-sm-2 col-form-label">Type:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="type" name="type" required>
            </div>
        </div>
        <div class="form-group row mb-1">
            <label for="headerImg" class="col-sm-2 col-form-label">HeaderImg:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="headerImg" name="headerImg" required>
            </div>
        </div>
        <div class="form-group row mb-1">
            <label for="thumbnailImg" class="col-sm-2 col-form-label">ThumbnailImg:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="thumbnailImg" name="thumbnailImg" required>
            </div>
        </div>
        <!-- <div class="form-group row mb-1">
            <label for="photo" class="col-sm-2 col-form-label text-light">Photo:</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="photo" name="photo">
            </div>
        </div> -->
        <input type="submit" name="add" value="Insert Artist" class="form-control btn btn-primary mb-1">
    </form>
</div>

<!-- display data -->
<table class="table table-striped table-responsive">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">HeaderIMG</th>
            <th scope="col">ThumbnailIMG</th>
            <th scope="col" colspan="2" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($model as $artist) {
        ?>
            <tr>
                <td><?= $artist->getId() ?></td>
                <td><?= $artist->getName() ?></td>
                <td><?= $artist->getDescription() ?></td>
                <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($artist->getHeaderImg()) . '" height="100px"/>'; ?></td>
                <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($artist->getThumbnailImg()) . '"  height="100px"/>'; ?></td>
                <!-- change links -->
                <td>
                    <form action="/artist/artistcms?updateID=<?= $artist->getId() ?>" method="POST">
                        <input type="hidden" name="edit" value="<?= $artist->getId() ?>">
                        <input type="submit" name="submit" value="Edit" class="btn btn-warning">
                    </form>
                </td>
                <td>
                    <form action="/artist/artistcms?deleteID=<?= $artist->getId() ?>" method="POST">
                        <input type="hidden" name="delete" value="<?= $artist->getId() ?>">
                        <input type="submit" name="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<!-- UPDATE part -->
<?php
if (isset($_POST["edit"])) {
?>
    <h3>Edit artist #<?= $updateArtist->getId() ?></h3>
    <div>
        <form method="POST">
            <div class="form-group row mb-1">
                <label for="changedName" class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="changedName" name="changedName" value="<?= $updateArtist->getName() ?>" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="changedDescription" class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="changedDescription" id="changedDescription"><?= $updateArtist->getDescription() ?></textarea>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="changedType" class="col-sm-2 col-form-label">Type:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="changedType" name="changedType" value="<?= $updateArtist->getType() ?>" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="changedHeaderImg" class="col-sm-2 col-form-label">HeaderImg:</label>
                <div class="col-sm-10">
                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($artist->getHeaderImg()) . '"  height="100px"/>'; ?>
                    <input type="text" class="form-control" id="changedHeaderImg" name="changedHeaderImg" value="<?= (int)$updateArtist->getHeaderImg() ?>" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="changedThumbnailImg" class="col-sm-2 col-form-label">ThumbnailImg:</label>
                <div class="col-sm-10">
                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($artist->getThumbnailImg()) . '"  height="100px"/>'; ?>
                    <input type="text" class="form-control" id="changedThumbnailImg" name="changedThumbnailImg" value="<?= (int)$updateArtist->getThumbnailImg() ?>" required>
                </div>
            </div>
            <input type="submit" name="update" value="Update Artist" class="form-control btn btn-primary mb-1">
        </form>
    </div>
<?php
}
?>

<!-- script to display add form if add button was clicked -->
<script>
    document.getElementById('show-add-form').addEventListener('click', function() {
        document.getElementById('form-add-container').style.display = 'block';
    });
</script>

<?php
include __DIR__ . '/../footer.php';
?>