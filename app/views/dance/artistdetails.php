<?php
include __DIR__ . '/../header.php';
?>
<div class="album py-5">
    <div class="container mb-5">
        <h2 class=" text-center"><?= $model->getName() ?></h2>
        <div>
            <p>name: <?= $model->getName() ?></p>
            <p>details: <?= $model->getDescription() ?></p>
            <p>type: <?= $model->getType() ?></p>
            <p>image: <?= $model->getHeaderImg() ?></p>
            <p>image: <?= $model->getThumbnailImg() ?></p>
        </div>
    </div>
</div>
<?php
include __DIR__ . '/../footer.php';
?>