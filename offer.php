<?php
include './class/include.php';
if (!isset($_SESSION)) {
    session_start();
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
        <title>Surasa Lanka (Pvt) Ltd. | Offer</title>
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
                            <h2>Offer</h2>
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>
                                    <i class="flaticon-tea-cup"></i>
                                </li>
                                <li>Offer</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title-shape">
                <img src="assets/img/page-title/down-shape.png" alt="image">
            </div>
        </div>


        <section class="event-area ptb-100">
            <div class="container">
                <?php
                $OFFER = new Offer(NULL);
                foreach ($OFFER->all() as $offer) {
                    ?>
                    <div class="event-style">
                        <a href="products.php" >
                            <div class="row align-items-center">
                                <div class="col-lg-7">

                                    <div class="event-item">
                                        <div class="number">

                                            <h3> 
                                                <?php
                                                $date = date_create($offer['date']);
                                                echo date_format($date, 'd ');
                                                ?>
                                            </h3>
                                            <span>
                                                <?php
                                                $date = date_create($offer['date']);
                                                echo date_format($date, 'M');
                                                ?>
                                            </span>
                                        </div>
                                        <div class="content">
                                            <h4><?php echo $offer['title']; ?></h4>
                                            <p><?php echo substr($offer['short_description'], 0, 250) . '..'; ?></p>
                                            <div class="event-btn">
                                                <div class="default-btn">
                                                    Order Now
                                                    <i class="flaticon-play-button"></i>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-5">
                                    <div class="event-image">
                                        <img src="upload/offer/<?php echo $offer['image_name']; ?>" alt="image">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php
                }
                ?>
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