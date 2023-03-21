<?php
//incl new navbar
include __DIR__ . '/../navbar.php';
?>

<div style="position: relative; text-align: center; color: white;">
    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($page->getHeaderImg()); ?>" width="100%" height="auto">
    <div style="position: absolute; bottom: 8px; left: 16px;">
        <h4 style="display:inline;">
            </h5>
            <h1 style="display:inline;"> <?= $page->getTitle() ?></h1>
    </div>
</div>
<!-- Main Content -->
<div class="container mb-3">
    <div class="row mb-3">
        <p class="text-center fs-1"> <?= $page->getDescription() ?></p>
    </div>

    <div class="row mb-3" style="display:flex; justify-content:center;">
        <?php
        foreach ($pagecards as $card) {
        ?>
            <div class="col">
                <div class="card">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($card->getImage()); ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="text-center fw-bold click2edit"><?= $card->getTitle() ?></h5>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="container mb-3">
        <div class="card" style="width: 75%;">
            <div class="row">
                <div class="col-md-9">
                    <img src="https://www.haarlemjazzandmore.nl/wp-content/uploads/2019/08/20190818_jazz_vuurwerk_07-1024x683.jpg" class="card-img rounded-left" alt="...">
                </div>
                <div class="col-md-3 bg-light rounded-right">
                    <div class="card-body text-center">
                        <h5 class="card-title">The Haarlem Festival</h5>
                        <p class="card-text">Amazing artists, great DJs and much more... </br> All in the beautiful beach of Haarlem</p>
                        <a href="/page/festival" class="btn btn-primary">CHECK IT OUT</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<!-- Location -->
<div class="container">
    <div class="col-md-6">
        <div class="location">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2427.660308624696!2d4.632323215799311!3d52.386532879785394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6097df89360c9%3A0x1a70afdd12fd6e39!2sGrote%20Markt%2C%20Haarlem!5e0!3m2!1sen!2snl!4v1615301111915!5m2!1sen!2snl" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>

<div class="container mt-4">
    <h4>Latest posts from #haarlem</h4>
    <div class="row mt-2">
        <div class="col-12">
            <iframe src="https://widget.taggbox.com/124424" style="width:100%;height:600px;border:none;"></iframe>
        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>


<?php
include __DIR__ . '/../footer.php';
?>