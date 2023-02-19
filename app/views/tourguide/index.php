<?php
include __DIR__ . '/../header.php';

include __DIR__ . '/../footer.php';
?>

<link rel="stylesheet" href="../../public/main.css">
<script src="../../public/js/haarlemHistory.js"></script>

<div class="bg-light p-5 rounded-lg"
     style="height: 300px;
    text-align:center;
    display:table;
    width:100%;
    background-size: cover;
    background-position: bottom;">
    <h1 class="display-4" style="    font-size: 110px;
    text-align: center;
    display: table-cell;
    vertical-align: middle;
    color: white;">Explore History</h1>
</div>

<div class="mt-2 container mx-auto" style="max-width: 1000px;">
    <div class="mt-3">
        <div class="card col-12 p-0 my-4">
            <div class="row" style="border: 0;">

            </div>
        </div>
        <?php
        foreach($model as $tourguides) {
            ?>
            <div class="card col-12 p-0 my-4">
                <div class="row" style="border: 0;">

                    <h4><?= ucfirst($tourguides->getName())?></h4>
                    <small>Description: <?= $tourguides->getDescription()?></small>

                </div>
            </div>
            <?php
        }
        ?>
        <!--<script>getTourGuides()</script>-->
        <!--keep as well the id which is id=getContainer-->
    </div>
</div>

<style>
    #app {
        background-color: white;
    }
</style>

