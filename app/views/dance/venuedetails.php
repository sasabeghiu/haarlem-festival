<?php
include __DIR__ . '/../header.php';
?>

<!-- change image to $model->getHeaderImg() and display full size-->
<div style="position: relative; text-align: center; color: white;">
    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($model->getHeaderImg()); ?>" width="100%" height="auto">
    <div style="position: absolute; bottom: 8px; left: 16px;">
        <h4 style="display:inline;"> Dance </h5>
            <h1 style="display:inline;"> <?= $model->getName() ?></h1>
    </div>
</div>

<a class="fa-solid fa-circle-arrow-left py-5 px-5" href="/venue" style="text-decoration:none; color:black; position: fixed; font-size: 2em;"></a>

<div class="album py-5">
    <div class="container mb-5">
        <div class="row">
            <div class="col-sm-8">
                <p><?= $model->getDescription() ?></p>
            </div>
            <div class="col-sm-4">
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($model->getImage()); ?>" class="img-thumbnail">
            </div>
        </div>

        <div class="row">
            <!-- change to $model->getThumbnailImg() and display full size-->
            <!-- <p><img src="https://pbs.twimg.com/media/D3FtePUXkAENNlK.jpg"></p> -->
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../footer.php';
?>