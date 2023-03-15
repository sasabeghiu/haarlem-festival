<?php
//incl new navbar
include __DIR__ . '/../header.php';
?>


<style>
    .links {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 50px;
        background-color: orangered;
        color: white;
        text-align: center;
        text-decoration: none;
    }
</style>

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
            <div class="col-sm-12">
                <h5 class="text-center click2edit"><?= $page->getDescription() ?></h5>
            </div>
        </div>

        <button id="edit" class="btn btn-primary" onclick="edit()" type="button">Edit EVERYTHING</button>
        <button id="save" class="btn btn-primary" onclick="save()" type="button">Save ALL</button>

        <!--For this hardcoded part I can call a foreach loop in which I use the same title with the other foreachloop as well
        and use the location as the description of those cards, instead of keeping it as a null. As well call the links
        in the loop when the above steps are finished.-->
        <div class="card-group d-flex flex-wrap justify-content-center">

            <div class="card my-4 card-sm" style="gap: 1rem;">
                <div class="card-body d-flex flex-row">
                    <div class="mx-auto">
                        <h5 class="card-text text-center font-weight-bold mb-2">Haarlems Origins</h5>
                    </div>
                </div>
                <div class="bg-image">
                    <img src="https://expatshaarlem.nl/wp-content/uploads/2020/04/eH-article-Lucile_2020-04_history-pic1.jpg" class="img-fluid h-100">
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="card-text">Learn about Haarlem officially becoming a city.</a>
                    </div>
                </div>
                <a class="btn btn-light" href="https://en.wikipedia.org/wiki/History_of_Harlem">Learn more</a>
            </div>

            <div class="card my-4 card-sm" style="gap: 1rem;">
                <div class="card-body d-flex flex-row">
                    <div class="mx-auto">
                        <h5 class="card-text text-center font-weight-bold mb-2">Anno Haarlem</h5>
                    </div>
                </div>
                <div class="bg-image">
                    <img src="https://www.visithaarlem.com/wp-content/uploads/2022/06/I3L2hhYXJsZW0tYmV6b2VrZXJzY2VudHJ1bS1hbm5vLWhhYXJsZW0tYmV6b2VrcnVpbXRlLmpwZw.jpg" class="img-fluid h-100">
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="card-text">Experience the entire history of Haarlem and the culture it used to and still follows.</a>
                    </div>
                </div>
                <a class="btn btn-light" href="https://www.visithaarlem.com/ontdekken/historie/anno-haarlem/">Learn more</a>
            </div>

            <div class="card my-4 card-sm" style="gap: 1rem;">
                <div class="card-body d-flex flex-row">
                    <div class="mx-auto">
                        <h5 class="card-text text-center font-weight-bold mb-2">Haarlem Trivia</h5>
                    </div>
                </div>
                <div class="bg-image">
                    <img src="https://i.pinimg.com/originals/98/e3/cc/98e3cc1f32d10869963c8deacfcfff3c.jpg" class="img-fluid">
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="card-text">Learn some interesting trivia facts about Haarlem.</a>
                    </div>
                </div>
                <a class="btn btn-light" href="https://haarleminsight.wordpress.com/say-hello-to-haarlem/">Learn more</a>
            </div>

        </div>

        <?php
        foreach ($pagecards as $card) {
        ?>
            <div class="d-flex justify-content-center align-items-center">
                <div class="card-data pt-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($card->getImage()); ?>" class="w-100">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $card->getTitle() ?></h5>
                                <p class="card-text"><?= $card->getDescription() ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>

<style>
    .card {
        max-width: 80%;
    }

    .card-sm {
        max-width: 300px;
    }

    .card-data {
        max-width: 1100px;
    }
</style>

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