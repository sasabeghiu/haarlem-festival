<?php
include __DIR__ . '/../header.php';

include __DIR__ . '/../footer.php';
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


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

<div class="row container mx-auto" style="max-width: 1000px;">
    <div class="mt-4">
    <?php
    foreach ($model as $historyevents){
        ?>
        <div class="card mt-3"">
        <div class="card-header">
            <h1 class="text-center" style="color: darkred;">Guide Group: <?= $historyevents->getTourguideName()?></h1>
            <div class="row">
                <div class="col-md-6">
                    <img class="card-img" style="opacity: 70%;" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($historyevents->getImage());?>">
                </div>
                <div class="col-md-6">
                    <h4 class="card-text"><h3 class="card-title">Description</h3><?= $historyevents->getTourguideDescription()?></h4>
                </div>
            </div>
            <div class="card-body">
                <h4 class="text-success fw-bold"> Tickets available: <?= ucfirst($historyevents->getTicketsAvailable())?></h4>
                <div class="card-button">
                    <a class="btn btn-info" href="#">Book for <?= $historyevents->getPrice()?>€</a>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <div class="row">
                <div class="row-2">
                    <div class="col-md-12">
                        <p class="text-muted">Location:</p>
                    </div>
                </div>
                <div class="col-ml-1">
                    <small class="text-muted">at</small>
                </div>
                <div class="col-md-3" style="padding-right: 50px;">
                    <small class="text-muted"><?= $historyevents->getLocation()?></small>
                </div>
                <div class="col-2-md-3" style="padding-right: 50px;">
                    <small class="text-muted">on</small>
                </div>
                <div class="col-1-md-3">
                    <small class="text-muted"><?= $historyevents->getFormattedDate()?></small>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    </div>
</div>


<!--<div class="card-deck">
    <div class="card">
        <img class="card-img-top w-50 " src="data:image/jpg;charset=utf8;base64,<?php /*echo base64_encode($historyevents->getImage());*/?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?/*= $historyevents->getTourguideName()*/?></h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
        <div class="card-button pt-4">
            <a class="btn btn-info" href="#">Book for <?/*= $historyevents->getPrice()*/?>€</a>
        </div>
        <div class="card-footer">
            <small class="text-muted"><?/*= $historyevents->getFormattedDate()*/?></small>
        </div>
    </div>-->


