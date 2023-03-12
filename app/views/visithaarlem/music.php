<?php
//incl new navbar
include __DIR__ . '/../header.php';
?>

<div style="position: relative; text-align: center; color: white;" class="click2edit">
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
                        <div class="card shadow-sm">
                            <div class="card-body text-light bg-dark">
                                <p class="text-center fw-bold"><?= $card->getTitle() ?></p>
                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($card->getImage()); ?>" class="rounded float-right" width="40%">
                                <p><?= $card->getDescription() ?></p>
                                <p>Price: </p>
                                <p>Rating: <?= $card->getRating() ?>/10</p>
                                <p>Addres: <?= $card->getLocation() ?></p>
                                <a href="<?= $card->getLink() ?>" target="_blank">Go to website</a>
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

    // var save = function() {
    //     var markup = $('.click2edit').summernote('code');
    //     $('.click2edit').summernote('destroy');
    // };

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