<?php
include __DIR__ . '/../header.php';
?>
<!-- change image to $model->getHeaderImg() and display full size-->
<div style="position: relative; text-align: center; color: white;">
    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($model->getHeaderImg()); ?>" width="100%">
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
                <!-- change to $model->getlogo() -->
                <img src="https://1000logos.net/wp-content/uploads/2020/10/Afrojack-Logo.jpg" alt="My Icon" width="300px" class="ml-5">
            </div>
        </div>

        <div class="row">
            <!-- change to $model->getThumbnailImg() and display full size-->
            <p><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($model->getThumbnailImg()); ?>" class="product-card img"></p>
        </div>

        <h2>Albums and singles</h2>
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

        <div class="row">
            <div class="col-sm-8">
                <h2>Events participating in</h2>
            </div>
            <div class="col-sm-4">
                <h2>Try his tracks</h2>
            </div>
        </div>
    </div>
</div>
</div>
<?php
include __DIR__ . '/../footer.php';
?>