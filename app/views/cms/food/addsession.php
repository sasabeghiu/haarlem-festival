<?php
include(__DIR__ . "/../../header.php");

?>
<div class="card">
    <div class="card-header">
        Adding Session
    </div>
    <div class="card-body">
        <form action="/food/save" method="post" enctype="multipart/form-data" id="edit-form">
            <div class="form-field mb-3">
                <label for="restaurantid" class="form-label">Restaurant: </label>
                <select name="restaurantid">
                    <?php
                    foreach ($restaurants as $restaurant) { 
                    ?>
                    <option value="<?= $restaurant->getId() ?>"><?= $restaurant->getName() ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="sessions" class="form-label">Sessions:</label>
                <input type="text" class="form-control" name="sessions" id="sessions" >
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price (€):</label>
                <input type="text" class="form-control" name="price" id="price">
            </div>
            <div class="mb-3">
                <label for="reducedprice" class="form-label">Reduced price:</label>
                <input type="text" class="form-control" name="reducedprice" id="reducedprice">
            </div>
            <div class="mb-3">
                <label for="firstsession" class="form-label">First session start time:</label>
                <input type="time" class="form-control" name="firstsession" id="firstsession">
            </div>
            <div class="mb-3">
                <label for="length" class="form-label">Session length (in hours):</label>
                <input type="text" class="form-control" name="length" id="length">
            </div>
            <div class="mb-3">
                <label for="seats" class="form-label">Seats:</label>
                <input type="text" class="form-control" name="seats" id="seats">
            </div>
            <button type="submit" class="btn btn-success">Add</button>
            <a name="" id="" class="btn btn-primary" href="/food/manageSessions" role="button">Cancel</a>

        </form>
    </div>

</div>
<?php include(__DIR__ . "/../../footer.php"); ?>