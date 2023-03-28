<?php
include __DIR__ . '/../header.php';
?>

<!-- change image to $model->getHeaderImg() and display full size-->
<div style="position: relative; text-align: center; color: white;">
    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($model->getHeaderImg()); ?>" width="100%" height="auto">
    <div style="position: absolute; bottom: 8px; left: 16px;">
        <h4 style="display:inline;"> Jazz </h5>
            <h1 style="display:inline;"> <?= $model->getName() ?></h1>
    </div>
</div>

<a class="fa-solid fa-circle-arrow-left py-5 px-5" href="/venue/jazzvenues" style="text-decoration:none; color:black; position: fixed; font-size: 2em;"></a>

<div class="album py-5">
    <div class="container mb-5">
        <div class="row">
            <div class="col-sm-8">
                <h2 class="my-3">About</h2>
                <p><?= $model->getDescription() ?></p>
            </div>
            <div class="col-sm-4">
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($model->getImage()); ?>" class="img-thumbnail">
            </div>
        </div>

        <h2 class="my-3">HF Jazz Events at this location</h2>
        <div class="row mt-3">

            <?php
            foreach ($events as $event) {
                $date_string = $event->getDatetime();
                $date = new DateTime($date_string);
                $formated = $date->format("l, j F Y h:i A");
            ?>
                <div class="col mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header text-light bg-dark">
                            <p class="card-text text-center"><?= $event->getName() ?></p>
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($event->getImage()); ?>" class="mx-auto d-block" height="150px">
                        </div>
                        <div class="card-body text-light bg-dark">
                            <p class="card-text">Time: <?php echo $formated; ?></p>
                            <p class="card-text">Location: <?= $model->getName() ?></p>
                            <p class="card-text">Price: <?= $event->getTicket_price() ?> &euro;</p>
                            <p class="card-text">Stock: <?= $event->getTickets_available() ?></p>
                        </div>
                        <div class="card-footer text-light bg-dark text-center">
                            <p class="text-center"><a href="/artist/jazzartistdetails?id=<?= $event->getArtist() ?>">Discover more</a></p>
                            <form action="/venue/jazzvenuedetails?id=<?= $model->getId() ?>" method="post">
                                <button class="btn btn-secondary" name="add-to-cart">Add to cart</button>
                                <input type="hidden" name="product_id" value="<?= $event->getId() ?>">
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../footer.php';
?>