<?php
include __DIR__ . '/../header.php';
?>
<div class="album py-5">
    <div class="container mb-5">
        <h2 class="text-dark text-center">HF Dance Artists</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            foreach ($model as $artist) {
            ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <a href="/artist/artistdetails?id=<?= $artist->getId() ?>">
                            <img src="https://thumbs.dreamstime.com/b/dj-icon-design-illustration-eps-graphic-68127680.jpg" class="product-card img" height="400px">
                            <div class="card-body text-light bg-dark">
                                <p class="card-text fw-bold text-center"><?= $artist->getName() ?></p>
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