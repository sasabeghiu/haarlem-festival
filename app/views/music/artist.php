<?php
include __DIR__ . '/../header.php';
?>
<div class="album py-5">
    <div class="container mb-5">
        <h2 class="text-dark text-center">Artists</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            foreach ($model as $artist) {
            ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="<?= $artist->getHeaderImg() ?>" class="product-card img">
                        <div class="card-body text-light bg-dark">
                            <p class="card-text fw-bold"><?= $artist->getName() ?></p>
                            <p class="card-text"><?= $artist->getDescription() ?></p>
                            <p class="card-text"><?= $artist->getType() ?></p>
                            <p class="card-text text-center">
                                <a href="https://soundcloud.com/motche-pejhanfar-648343451" target="_blank" class="text-light"><i class="fa-brands fa-soundcloud m-1"></i></a>
                                <a href="https://www.instagram.com/unit_240/" target="_blank" class="text-light"><i class="fa-brands fa-instagram m-1"></i></a>
                                <a href="https://open.spotify.com/user/315deul4yq4yacitwdgudo6zkgmm?si=9CSWNY2kRRuY3PFg2cXsYA" target="_blank" class="text-light"><i class="fa-brands fa-spotify m-1"></i></a>
                                <a href="https://www.youtube.com/@unit2402" target="_blank" class="text-light"><i class="fa-brands fa-youtube m-1"></i></a>
                            </p>
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