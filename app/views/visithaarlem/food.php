<?php
require __DIR__ . '/../navbar.php';
?>

<head>
    <link rel="stylesheet" href="/css/foodstyle.css">
</head>

<div class="container-fluid">
    <h3 class="text-center click2edit"><?= $page->getTitle() ?></h3>
    <p class="click2edit"><?= $page->getDescription() ?></p>

    <button id="edit" class="btn btn-primary" onclick="edit()" type="button">Edit EVERYTHING</button>
    <button id="save" class="btn btn-primary" onclick="save()" type="button">Save ALL</button>
</div>

<!-- Page id 7, card id's 35 and up -->
<!-- Haarlem food -->
<div class="container-fluid">
    <div class="row" id="35">
        <div class="col">
            <h4 class="click2edit"><?= $pageCards[0]->getTitle(); ?></h4>
            <p class="click2edit"> <?= $pageCards[0]->getDescription() ?></p>

        </div>
        <div class="col">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[0]->getImage()) ?>" alt="Loading image..." class="image-fluid click2edit">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[1]->getImage()) ?>" alt="Loading image..." class="image-fluid click2edit">
        </div>
        <div class="col">
            <h4 class="click2edit"><?= $pageCards[1]->getTitle() ?></h4>
            <p class="click2edit"><?= $pageCards[1]->getDescription() ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h4 class="click2edit"><?= $pageCards[2]->getTitle() ?></h4>
            <p class="click2edit"><?= $pageCards[2]->getDescription() ?></p>

            <p class="click2edit"><?= $pageCards[2]->getLink() ?></p>
        </div>
        <div class="col" style="background-color: grey; padding-top: 20px;">
            <h1 class="text-center click2edit">Place Holder for location<h1>
        </div>
    </div>
</div>

<!-- International -->

<h3 class="text-center"> <?= $pageCards[3]->getTitle() ?> </h3>

<div class="container-fluid ">
    <div class="row">
        <div class="col">
            <p class="click2edit"><?= $pageCards[3]->getDescription() ?> </p>
        </div>
        <div class="col">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[3]->getImage()) ?>" alt="Loading image..." class="image-fluid click2edit">
        </div>
    </div>
</div>
<div class="container-fluid">
    <h4 class="text-center click2edit"><b>International food</b></h4>
    <div class="row ">

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[4]->getImage()) ?>" alt="Loading image..." class="card-img-top click2edit">
                    <h5 class="click2edit"><b><?= $pageCards[4]->getTitle() ?></b></h5>
                    <p class="click2edit"><?= $pageCards[4]->getDescription() ?></p>
                </div>
                <div class="card-footer">
                    <p class="click2edit"><?= $pageCards[4]->getLink() ?></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[5]->getImage()) ?>" alt="Loading image..." class="card-img-top click2edit">
                    <h5 class="click2edit"><b><?= $pageCards[5]->getTitle() ?></b></h5>
                    <p class="click2edit"><?= $pageCards[5]->getDescription() ?></p>
                </div>
                <div class="card-footer">
                    <p class="click2edit"><?= $pageCards[5]->getLink() ?></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[6]->getImage()) ?>" alt="Loading image..." class="card-img-top click2edit">
                    <h5 class="click2edit"><b><?= $pageCards[6]->getTitle() ?></b></h5>
                    <p class="click2edit"><?= $pageCards[6]->getDescription() ?></p>
                </div>
                <div class="card-footer">
                    <p class="click2edit"><?= $pageCards[6]->getLink() ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jopen bier -->
<h3 class="text-center">Nothing says Haarlem more than a nice glass of Jopen 🍺</h3>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h4><b><?= $pageCards[7]->getTitle() ?></b></h4>
            <p><?= $pageCards[7]->getDescription() ?> </p>
        </div>
        <div class="col">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[7]->getImage()) ?>" alt="Loading image..." class="image-fluid">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[8]->getImage()) ?>" alt="Loading image..." class="image-fluid">
        </div>
        <div class="col">
            <h4><b><?= $pageCards[8]->getTitle() ?></b></h4>
            <p><?= $pageCards[8]->getDescription() ?> </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h4><b><?= $pageCards[9]->getTitle() ?></b></h4>
            <ul>
                <?= $pageCards[9]->getDescription() ?>
            </ul>
        </div>
        <div class="col">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[9]->getImage()) ?>" alt="Loading image..." class="image-fluid">
        </div>
        <!-- <div class="col">
            <img src="/images/jopenimg4.png" alt="Loading image..." class="image-fluid">
        </div> -->
    </div>
    <div class="row">
        <div class="col">
            <h4><b><?= $pageCards[10]->getTitle() ?></b></h4>
            <p><?= $pageCards[10]->getDescription() ?></p>
            <p><?= $pageCards[10]->getLink() ?></p>
        </div>
        <div class="col" style="background-color: grey; padding-top: 20px;">
            <h1 class="text-center">Place Holder for location<h1>
        </div>
    </div>
</div>

<script>
    var edit = function() {
        $('.click2edit').each(function() {
            $(this).summernote({
                focus: true
            });
        })
    };

    var save = function() {
        $('.click2edit').each(function() {
            $(this).summernote('code');
            $(this).summernote('destroy');
        });
    };
</script>

<?php
require __DIR__ . '/../footer.php';
?>