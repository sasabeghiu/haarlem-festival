<?php
include __DIR__ . '/../header.php';
?>
<div class="album py-5">
    <div class="container mb-5">
        <h2 class=" text-center"><?= $model->getId() ?></h2>
        <div>
            <p>type: <?= $model->getType() ?></p>
            <p>artist: <?= $model->getArtist() ?></p>
            <p>venue: <?= $model->getVenue() ?></p>
            <p>ticket price: <?= $model->getTicket_price() ?></p>
            <p>tickets available: <?= $model->getTickets_available() ?></p>
            <p>datetime: <?= $model->getDatetime() ?></p>
            <p>details: <?= $model->getDescription() ?></p>
        </div>
    </div>
</div>
<?php
include __DIR__ . '/../footer.php';
?>