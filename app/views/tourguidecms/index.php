<?php
include __DIR__ . '/../header.php';

include __DIR__ . '/../footer.php';
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<div class="bg-light p-5 rounded-lg"
     style="height: 300px;
    text-align:center;
    display:table;
    width:100%;
    background-size: cover;
    background-position: bottom;">
    <h1 class="display-4" style="    font-size: 110px;
    text-align: center;
    display: table-cell;
    vertical-align: middle;
    color: white;">Tour Guide CMS</h1>
</div>


<!-- fix the form with images -->
<!-- hidden form to add a new artist -->
<div id="form-add-container">
    <form method="POST">
        <div class="form-group row mb-1">
            <label for="name" class="col-sm-2 col-form-label">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Insert Tour Guide Name" required>
            </div>
        </div>
        <div class="form-group row mb-1">
            <label for="description" class="col-sm-2 col-form-label">Description:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="description" name="description" placeholder="Insert Tour Guide Details" required></textarea>
            </div>
        </div>
        <div class="form-group row mb-1">
            <label for="image" class="col-sm-2 col-form-label">Image:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="image" name="image" placeholder="Insert Image ID..." required>
            </div>
        </div>
        <input type="submit" name="add" value="Insert Tour Guide" class="form-control btn btn-success mb-1">
    </form>
</div>

<table class="table table-striped table-responsive">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Image</th>
        <th scope="col" colspan="2" class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
        <?php
        foreach ($model as $tourguide) {
        ?>
            <tr>
                <td><?= $tourguide->getId() ?></td>
                <td style="width: 2%;"><?= $tourguide->getName() ?></td>
                <td style="width: 50%;"><?= $tourguide->getDescription() ?></td>
                <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($tourguide->getImage()) . '"  height="100px"/>'; ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
