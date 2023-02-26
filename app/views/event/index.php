<?php
include __DIR__ . '/../header.php';

include __DIR__ . '/../footer.php';
?>

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
    color: white;">History Events</h1>
</div>


<?php
foreach ($model as $event){
    ?>
    <div class="card mt-3"">
        <div class="card-header">
            <h2 class="text-center" style="color: darkred;">John Willem</h2>
        <div class="card-body">
            <small class="card-text"><h6 class="card-title">Description</h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</small>
            <p class="text-success fw-bold"> Tickets available: <?= ucfirst($event->getTicketsAvailable())?></p>
            <h5>Ticket Price: <?= $event->getPrice()?>€</h5>
            <div class="card-footer text-center mt-1">
                <small class="text-muted"><?= $event->getFormattedDate()?></small>
            </div>
            <div class="card-button pt-4">
                <a class="btn btn-info" href="#">Book for <?= $event->getPrice()?>€</a>
            </div>
        </div>
        </div>
    </div>
    <?php
}
?>