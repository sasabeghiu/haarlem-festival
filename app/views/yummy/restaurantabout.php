<?php
require __DIR__ . '/../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/restaurantaboutstyle.css">
</head>

<html>
<div class="container-fluid">
    <div class="row justify-content-around">

        <div class="col-4">
            <h3>Description</h3>
            <p><?= $restaurant->getDescription() ?></p>
        </div>
        <div class="col-4">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($restaurant->getImage1()); ?>" class="image-fluid" alt="Loading image...">
        </div>
    </div>
    <div class="row justify-content-around">
        <div class="col-2">
            <h3>Details</h3>
            <p>Price: <?= $session->getPrice() ?></p>
            <p>Cuisine: <?= $restaurant->getCuisine() ?> </p>
            <p>Rating: <?= $restaurant->getStars() ?> Stars</p>
        </div>
        <div class="col-4">
            <image src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($restaurant->getImage2()); ?>" class="image-fluid" alt="Loading image..." />
        </div>
        <div class="col-3">
            <h3><b>Contact</b></h3>
            <p><b>Address:</b> <?= $restaurant->getLocation() ?> </p>
            <p><b>Phone:</b> <?= $restaurant->getPhonenumber() ?> </p>
            <p><b>Email: </b> <?= $restaurant->getEmail() ?> </p>
        </div>
    </div>
    <div class="row justify-content-around">
        <div class="col-4">
            <image src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($restaurant->getImage3()); ?>" class="image-fluid" alt="Loading image..." />
        </div>
        <div class="col-6">
            <h3>Make a reservation</h3>
            <form method="POST">
                <div class="form-field">
                    <div class="mb-3">
                        <label for="name" class="form-label"><b>Name:</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
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
                <div class="form-field">
                    <label><b>Session:</b> </label>
                    <select name="session">
                        <?php
                        //The loop for adding session options. The first session starttime is in the database, for all sessions after 
                        //the length of the session is added to this time
                        for ($i = 0; $i < $session->getSessions(); $i++) {
                            $date_input = strtotime($session->getFirst_session());
                            $date = date('H:i', $date_input);
                            $minutesToAdd = $i * $session->getSession_length() * 60; //You can not add .5 hours to a date variable in php so minutes are used instead
                            $sessionTime = date('H:i', strtotime($date . ' + ' . $minutesToAdd . ' minutes'));
                        ?>
                            <option value="<?= $sessionTime ?>">Session <?= $i + 1 ?>: <?= $sessionTime ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="request" class="form-label"><b>Special requests:</b></label>
                    <input type="text" class="form-control" name="request" id="request">
                </div>
                <button type="submit" class="btn btn-success">Add reservation</button>
            </form>
        </div>
    </div>

</div>


<?php
require __DIR__ . '/../footer.php';
?>