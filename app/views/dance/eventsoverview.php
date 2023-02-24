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
        height: 50px;
    }
</style>
<div class="album py-5">
    <div class="container mb-5">
        <h2 class="text-dark text-center mb-3">HF Dance Events</h2>

        <p class="text-center">A new addition to the festival is Haarlem Dance in which the latest dance, house, techno
            and trance is central. Six of the top Dj’s in the world will entertain their audience in
            Back2Backsessions(multipleacts,largerstage,longer sessions) as well as in
            smaller experimental (club) sessions.</p>

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
                        <div class="card-header text-light bg-dark">
                            <p class="card-text text-center"><?= $event->getName() ?></p>
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($event->getImage()); ?>" class="mx-auto d-block img-fluid">
                        </div>
                        <div class="card-body text-light bg-dark">
                            <p class="card-text">Time: <?php echo $formated; ?></p>
                            <p class="card-text">Location: <?= $event->getVenue() ?></p>
                            <p class="card-text">Price: <?= $event->getTicket_price() ?> &euro;</p>
                            <p class="card-text">Stock: <?= $event->getTickets_available() ?></p>
                        </div>
                        <div class="card-footer text-light bg-dark text-center">
                            <p class="text-center"><a href="/artist/artistdetails?id=<?= $event->getArtist() ?>">Discover more</a></p>
                            <button class="btn btn-secondary">Add to cart</button>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <p class="text-center">The capacity of the Club sessions is very limited. Availability for All-Access pas holders can not be guaranteed due to safety regulations.
            Tickets available represents total capacity. (90% is sold as single tickets. 10% of total capacity is left for Walk ins / All-Access passholders)</p>
            
    </div>
</div>
<?php
include __DIR__ . '/../footer.php';
?>