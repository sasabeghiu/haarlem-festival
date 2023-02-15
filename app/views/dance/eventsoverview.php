<?php
include __DIR__ . '/../header.php';
?>
<div class="album py-5">
    <div class="container mb-5">
        <h2 class="text-dark text-center">HF Dance Events</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            foreach ($model as $event) {
            ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <a href="/event/eventdetails?id=<?= $event->getId() ?>">
                            <img src="https://thumbs.dreamstime.com/b/dj-icon-design-illustration-eps-graphic-68127680.jpg" class="product-card img" height="400px">
                            <div class="card-body text-light bg-dark">
                                <p class="card-text fw-bold text-center"><?= $event->getId() ?></p>
                                <p class="card-text fw-bold text-center"><?= $event->getTicket_price() ?></p>
                                <p class="card-text fw-bold text-center"><?= $event->getTickets_available() ?></p>
                                <p class="card-text fw-bold text-center"><?= $event->getDatetime() ?></p>
                            </div>
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