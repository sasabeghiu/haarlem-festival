<?php
include __DIR__ . '/../header.php';
?>
<div class="album py-5">
    <div class="container mb-5">
        <h2 class="text-dark text-center">HF Dance Venues</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            foreach ($model as $venue) {
            ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <a href="/venue/venuedetails?id=<?= $venue->getId() ?>">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/3/32/Wikipedia_space_ibiza%2803%29.jpg" class="product-card img" height="270px">
                            <div class="card-body text-light bg-dark">
                                <p class="card-text fw-bold text-center"><?= $venue->getName() ?></p>
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