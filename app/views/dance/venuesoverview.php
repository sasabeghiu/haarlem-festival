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
                <div class="col mb-3">
                    <div class="card shadow-sm">
                        <a href="/venue/venuedetails?id=<?= $venue->getId() ?>">
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($venue->getImage()); ?>" class="product-card img" height="200px">
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