<?php
include __DIR__ . '/../header.php';
?>
<!-- change image to $model->getHeaderImg() and display full size-->
<div style="position: relative; text-align: center; color: white;">
    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($model->getHeaderImg()); ?>" width="100%" class="img-fluid">
    <div style="position: absolute; bottom: 8px; left: 16px;">
        <h4 style="display:inline;"> Dance </h5>
            <h1 style="display:inline;"> <?= $model->getName() ?></h1>
    </div>
</div>

<a class="fa-solid fa-circle-arrow-left py-5 px-5" href="/artist" style="text-decoration:none; color:black; position: fixed; font-size: 2em;"></a>

<div class="album py-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p><?= $model->getDescription() ?></p>
            </div>
            <div class="col-sm-4">
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($model->getLogo()); ?>" class="img-fluid">
            </div>
        </div>

        <div class="row mt-3">
            <!-- change to $model->getThumbnailImg() and display full size-->
            <p><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($model->getImage()); ?>" width="1500px" class="img-fluid"></p>
        </div>

        <h2 class="mt-3">Albums and singles</h2>
        <div class="row" style="display:flex; justify-content:center;">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                <div class="col mb-3">
                    <div class="card shadow-sm">
                        <a href="/artist/artistdetails?id=">
                            <img src="https://thumbs.dreamstime.com/b/dj-icon-design-illustration-eps-graphic-68127680.jpg" class="product-card img" height="180px">
                            <div class="card-footer text-light bg-dark">
                                <p class="card-text fw-bold text-center">test></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card shadow-sm">
                        <a href="/artist/artistdetails?id=">
                            <img src="https://thumbs.dreamstime.com/b/dj-icon-design-illustration-eps-graphic-68127680.jpg" class="product-card img" height="180px">
                            <div class="card-footer text-light bg-dark">
                                <p class="card-text fw-bold text-center">test></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card shadow-sm">
                        <a href="/artist/artistdetails?id=">
                            <img src="https://thumbs.dreamstime.com/b/dj-icon-design-illustration-eps-graphic-68127680.jpg" class="product-card img" height="180px">
                            <div class="card-footer text-light bg-dark">
                                <p class="card-text fw-bold text-center">test></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card shadow-sm">
                        <a href="/artist/artistdetails?id=">
                            <img src="https://thumbs.dreamstime.com/b/dj-icon-design-illustration-eps-graphic-68127680.jpg" class="product-card img" height="180px">
                            <div class="card-footer text-light bg-dark">
                                <p class="card-text fw-bold text-center">test></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card shadow-sm">
                        <a href="/artist/artistdetails?id=">
                            <img src="https://thumbs.dreamstime.com/b/dj-icon-design-illustration-eps-graphic-68127680.jpg" class="product-card img" height="180px">
                            <div class="card-footer text-light bg-dark">
                                <p class="card-text fw-bold text-center">test></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-8">
                <h2>Events participating in</h2>
                <p><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($model->getThumbnailImg()); ?>" height="400px"></p>
            </div>
            <div class="col-sm-4">
                <h2>Try his tracks</h2>
                <!-- The container for the music player -->
                <iframe style="border-radius:12px" src="<?= $model->getSpotify() ?>" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
            </div>
        </div>
        <?php
        include __DIR__ . '/../footer.php';
        ?>