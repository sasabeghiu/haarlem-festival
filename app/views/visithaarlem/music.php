<?php
include __DIR__ . '/../navbar.php';
?>

<head>
    <link rel="stylesheet" href="/css/homepages.css">
</head>

<div id="header-img" class="click2edit">
    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($page->getHeaderImg()); ?>" width="100%" height="auto">
    <div style="position: absolute; bottom: 8px; left: 16px;">
        <h4 style="display:inline;"> Experience </h5>
            <h1 style="display:inline;" class="click2edit"> <?= $page->getTitle() ?></h1>
    </div>
</div>

<div class="album py-5">
    <div class="container mb-5">
        <div class="row">
            <div class="col-sm-8">
                <p class="text-center click2edit"><?= $page->getDescription() ?></p>
            </div>
        </div>

        <button id="edit" class="btn btn-primary" onclick="edit()" type="button">Edit EVERYTHING</button>
        <button id="save" class="btn btn-primary" onclick="save()" type="button">Save ALL</button>

        <div class="row" style="display:flex; justify-content:center;">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                <?php
                foreach ($pagecards as $card) {
                ?>
                    <div class="row mb-3">
                        <div class="card shadow-sm border-1 rounded-pill">
                            <div class="card-body">
                                <p class="font-weight-bold text-center display-4"><?= $card->getTitle() ?></p>
                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($card->getImage()); ?>" class="rounded float-right ml-2" width="40%">
                                <p><?= $card->getDescription() ?></p>
                                <p><i class="fa-solid fa-euro-sign"></i> Price differs depending on the program</p>
                                <hr>
                                <p><i class=" fa-regular fa-star"></i> <?= $card->getRating() ?>/10</p>
                                <hr>
                                <p><i class="fa-solid fa-location-dot"></i> <?= $card->getLocation() ?></p>
                                <a href="<?= $card->getLink() ?>" class="float-right links" target="_blank">Go to website <i class="fa-solid fa-circle-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
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
include __DIR__ . '/../footer.php';
?>