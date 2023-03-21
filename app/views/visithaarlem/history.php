<?php
//incl new navbar
include __DIR__ . '/../navbar.php';
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

        <div class="card-group d-flex flex-wrap justify-content-center" style="width:100%; display: flex;">

            <div class="card click2edit mb-4 my-4" style="flex: 3; margin-right: 4rem;">
                <div class="card-body">
                    <h3 class="card-title">About</h3>
                    <p class="card-text">Take a stroll through the History of Haarlem! Haarlem is a city with a rich history, the cultural influences of which can still be seen even today. From the awe-inspiring interior of the St. Bavo church to the works of many great artists displayed in the various museums located in the city, we at the festival want to give you the opportunity to experience the beauty of Haarlem's history for yourself.
                        <br> </br>
                        Use the schedule displayed below to see the timeslots for the tours we offer. Additional information such as the entry price and duration can be found there as well.
                    </p>
                    <h3 class="card-title">Important:</h3>
                    <p class="card-text">Tours for the history event start at the St. Bavo church at the Grote markt in Haarlem.
                        Look for the giant flag that marks the exact starting location. The minimum age for taking the tours is 12 years old.
                        Usage of strollers is not allowed during the event.
                        Please do not book an English tour if you are a Dutch or Dutch speaking citizen, we at the Haarlem festival would hate to turn down foreign visitors because the tour slots with their preferred language are full.</p>
                </div>
            </div>

            <div class="card click2edit mb-4 my-4" style="flex: 2; margin-right: 4rem;">
                <div class="card-body">
                    <h3 class="card-title">Location</h3>
                    <p class="card-text">Take some time to read up on the locations you will visit on our history tours.</p>
                    <h6>The locations that will be visited are: </h6>
                    <a href="/historyevent">Church of St.Bavo - Starting location</a>
                    <br></br>
                    <a href="/historyevent">De Hallen</a>
                    <br></br>
                    <a href="/historyevent">Proveniershof</a>
                    <br></br>
                    <a href="/historyevent">Jopenkerk - Break location</a>
                    <br></br>
                    <a href="/historyevent">Waalse kerk Haarlem</a>
                    <br></br>
                    <a href="/historyevent">Molen deAdriaan</a>
                    <br></br>
                    <a href="/historyevent">Amsterdamse poort</a>
                    <br></br>
                    <a href="/historyevent">Hof vanBakenes</a>
                </div>
            </div>
        </div>

        <div class="card-group d-flex flex-wrap justify-content-center" style="width:100%; display: flex;">

            <?php
            foreach ($pagecards as $firstcards) {
            ?>

                <div class="card my-4 card-sm" style="flex: 1; margin-right: 4rem;">
                    <div class="card-body d-flex flex-row">
                        <div class="mx-auto">
                            <h5 class="card-text text-center font-weight-bold mb-2"><?= $firstcards->getTitle() ?></h5>
                        </div>
                    </div>
                    <div class="bg-image">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($firstcards->getImage()); ?>" class="w-100 h-100">
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-text"><?= $firstcards->getLocation() ?></a>
                        </div>
                    </div>
                    <a class="btn btn-light" href="<?= $firstcards->getLink() ?>">Learn more</a>
                </div>
            <?php
            }
            ?>
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