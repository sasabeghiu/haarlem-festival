<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Haarlem Festival</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="logo.png" alt="Haarlem Festival" height="50"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">HISTORY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">CULTURE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">FOOD</a>
                </li>
            </ul>
            <img src="nav-bg.jpeg" alt="Navigation Background" class="nav-bg">
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mb-3">
        <div class="row mb-4">
            <div class="col-md-12 text-center mb-4">
                <h2 class="heading"><?php echo $homepage['heading']; ?></h2>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <p><?php echo $homepage['description']; ?></p>
            </div>
            <div class="col-md-6">
                <img src="image.jpg" alt="Image" class="img-fluid">
            </div>
        </div>



        <!-- Location -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="location">
                    <?php echo $homepage['location_link']; ?>
                    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2427.660308624696!2d4.632323215799311!3d52.386532879785394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6097df89360c9%3A0x1a70afdd12fd6e39!2sGrote%20Markt%2C%20Haarlem!5e0!3m2!1sen!2snl!4v1615301111915!5m2!1sen!2snl" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="did-you-know">
                    <h3>Did You Know?</h3>
                    <ul>
                        <li><?php echo $homepage['didyouknow']; ?></li>
                        <li>The famous painter Frans Hals was born and worked in Haarlem during the Dutch Golden Age.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <h4>Latest posts from #haarlem</h4>
            <div class="row mt-2">
                <div class="col-12">
                    <?php echo $homepage['ig_link']; ?>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h4>About Us</h4>
                        <p><a href="VisitHaarlem.nl">VisitHaarlem.nl</a> is dedicated to
                            present Haarlem’s offer in
                            an engaging way</p>
                    </div>
                    <div class="col-md-3">
                        <h4>Socials</h4>
                        <ul class="list-unstyled">
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Instagram</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h4>Contact</h4>
                        <ul class="list-unstyled">
                            <li><a href="#">Email</a></li>
                            <li><a href="#">Phone</a></li>
                            <li><a href="#">Address</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h4>Information</h4>
                        <ul class="list-unstyled">
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">FAQs</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>