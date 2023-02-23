<?php
include __DIR__ . '/../header.php';
?>
<style>
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .filterbtn {
        width: 100px;
        height: 100px;
    }
</style>
<div class="album py-5">
    <div class="container mb-5">
        <h2 class="text-dark text-center mb-3">HF Dance Events</h2>

        <div class="center mb-3">
            <form method="POST">
                <input type="submit" name="events" value="All Events" class="btn btn-success mx-3 filterbtn"></a>
            </form>
            <form method="POST">
                <input type="submit" name="friday" value="Friday 27" class="btn btn-primary mx-3 filterbtn"></a>
            </form>
            <form method="POST">
                <input type="submit" name="saturday" value="Saturday 28" class="btn btn-primary mx-3 filterbtn"></a>
            </form>
            <form method="POST">
                <input type="submit" name="sunday" value="Sunday 29" class="btn btn-primary mx-3 filterbtn"></a>
            </form>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            foreach ($model as $event) {
                $date_string = $event->getDatetime();
                $date = new DateTime($date_string);
                $formated = $date->format("l, j F Y h:i A");
            ?>
                <div class="col mb-3">
                    <div class="card shadow-sm">
                        <a href="#">
                            <p class="card-text fw-bold text-center"><?= $event->getArtist() ?></p>
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($event->getImage()); ?>" height="200px">
                            <div class="card-body text-light bg-dark">
                                <p class="card-text fw-bold text-center">Time: <?php echo $formated; ?></p>
                                <p class="card-text fw-bold text-center">Location: <?= $event->getVenue() ?></p>
                                <p class="card-text fw-bold text-center">Price: <?= $event->getTicket_price() ?> &euro;</p>
                                <p class="card-text fw-bold text-center">Stock: <?= $event->getTickets_available() ?></p>
                            </div>
                            <p class="text-center"><a href="/artist/artistdetails?name=<?= $event->getArtist() ?>">Discover more</a></p>
                            <button class="btn btn-secondary">Add to cart</button>

                        </a>
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