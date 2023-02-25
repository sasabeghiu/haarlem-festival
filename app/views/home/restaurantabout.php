<?php
require __DIR__ . '/../header.php';
?>

<html>
<div class="about container">
    <div class="row">
        <?php
        foreach ($restaurants as $restaurant) {
        ?>
            <div class="col">
                <h3>Description</h3>
                <p><?= $restaurant->description ?></p>
            </div>
            <div class="col">
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($restaurant->image1); ?>" class="img-fluid" alt="Loading image...">
            </div>
    </div>
    <div class="row">
        <div class="col">
            <h3>Details</h3>
            <p>Price: session.price</p>
            <p>Cuisine: <?= $restaurant->cuisine ?> </p>
            <p>Rating: <?= $restaurant->stars ?> Stars</p>
        </div>
        <div class="col">
            <image src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($restaurant->image2); ?>" class="image-fluid" alt="Loading image..." />
        </div>
        <div class="col">
            <h3><b>Contact</b></h3>
            <p><b>Address:</b> <?= $restaurant->location ?> </p>
            <p><b>Phone:</b> <?= $restaurant->phonenumber ?> </p>
            <p><b>Email: </b> <?= $restaurant->email ?> </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <image src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($restaurant->image3); ?>" class="image-fluid" alt="Loading image..." />
        </div>
        <div class="col">
            <h3>Make a reservation</h3>
            <form method="POST">
                <div class="form-field">
                    <label><b>Number of people:</b> </label>
                    <select name="formguests">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="form-field">
                    <label><b>Day:</b> </label>
                    <select name="date">
                        <option value="thursday">Thursday</option>
                        <option value="friday">Friday</option>
                        <option value="saturday">Saturday</option>
                        <option value="sunday">Sunday</option>
                    </select>
                </div>
                <!-- Add form options for the rest of the session details -->
            </form>
        </div>
    </div>
<?php
        }
?>
</div>


<?php
require __DIR__ . '/../footer.php';
?>