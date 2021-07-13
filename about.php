<?php
include './class/include.php';
if (!isset($_SESSION)) {
    session_start();
    $ABOUT = new Page(2);
}
?>
<!doctype html>
<html lang="zxx">


    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="assets/css/bootstrap.min.css">

        <link rel="stylesheet" href="assets/css/animate.min.css">

        <link rel="stylesheet" href="assets/css/meanmenu.css">

        <link rel="stylesheet" href="assets/css/boxicons.min.css">

        <link rel="stylesheet" href="assets/css/flaticon.css">

        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">

        <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">

        <link rel="stylesheet" href="assets/css/magnific-popup.min.css">

        <link rel="stylesheet" href="assets/css/nice-select.min.css">

        <link rel="stylesheet" href="assets/css/odometer.min.css">

        <link rel="stylesheet" href="assets/css/style.css">

        <link rel="stylesheet" href="assets/css/responsive.css">
        <title>Surasa Lanka (Pvt) Ltd. | About Us</title>
        <link rel="icon" type="image/png" href="assets/img/favicon.png">
    </head>
    <body>

        <div class="preloader">
            <div class="lds-ripple">
                <div></div>
                <div></div>
            </div>
        </div>


        <?php
        include './header2.php';
        ?>


        <div class="page-title-area item-bg-1">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-title-content">
                            <h2>About Us</h2>
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>
                                    <i class="flaticon-tea-cup"></i>
                                </li>
                                <li>About Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title-shape">
                <img src="assets/img/page-title/down-shape.png" alt="image">
            </div>
        </div>


        <section class="about-area ptb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-content">
                            <span>Who Are We</span>
                            <h3><?php echo $ABOUT->title; ?></h3>
                            <p><?php echo $ABOUT->description; ?></p>
                            <div class="signature">
                                <h4>Christopher Nolan</h4>
                                <span>Manager At Surasa Lanka (Pvt) Ltd.</span>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-image">
                            <img src="upload/page/<?php echo $ABOUT->image_name; ?>" alt="image">
                            <div class="shape">
                                <img src="assets/img/about/shape.png" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-45">
                    <div class="col-md-6">
                        <a href="assets/img/about/1.jpg" class="entry-thumbnail"><img alt="Lessons of Resilience" src="assets/img/about/1.jpg"></a>
                        <a href="assets/img/about/1.jpg" data-lightbox="mygallery"  data-title="Stair case" class="entry-title"></a>
                    </div>
                    <div class="col-md-6 cetificate2">
                        <a href="assets/img/about/2.jpg" class="entry-thumbnail"><img alt="Lessons of Resilience" src="assets/img/about/2.jpg"></a>
                        <a href="assets/img/about/2.jpg" data-lightbox="mygallery"  data-title="Stair case" class="entry-title"></a>
                    </div>
                </div>
            </div>
        </section>




        <?php
        include './footer.php';
        ?>


        <div class="go-top">
            <i class="bx bx-chevron-up"></i>
            <i class="bx bx-chevron-up"></i>
        </div>


        <script src="assets/js/jquery.min.js"></script>

        <script src="assets/js/popper.min.js"></script>

        <script src="assets/js/bootstrap.min.js"></script>

        <script src="assets/js/jquery.meanmenu.js"></script>

        <script src="assets/js/owl.carousel.min.js"></script>

        <script src="assets/js/jquery.magnific-popup.min.js"></script>

        <script src="assets/js/jquery.nice-select.min.js"></script>

        <script src="assets/js/odometer.min.js"></script>

        <script src="assets/js/jquery.appear.js"></script>

        <script src="assets/js/jquery.ajaxchimp.min.js"></script>

        <script src="assets/js/form-validator.min.js"></script>

        <script src="assets/js/contact-form-script.js"></script>

        <script src="assets/js/wow.min.js"></script>

        <script src="assets/js/main.js"></script>
    </body>


</html>