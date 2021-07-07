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
        <title>Surasa Lanka (Pvt) Ltd. | Product Category</title>
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
                            <h2>Product Category</h2>
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>
                                    <i class="flaticon-tea-cup"></i>
                                </li>
                                <li>Product Category</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title-shape">
                <img src="assets/img/page-title/down-shape.png" alt="image">
            </div>
        </div>

         <section class="overview-area pb-70 produt-c-area">
            <div class="container">
                <div class="row">
                    <?php
                    $PRODUCT_CATEGORIES = new ProductCategories(NULL);
                    foreach ($PRODUCT_CATEGORIES->all() as $product_categories) {
                        ?>
                    <div class="col-lg-6">
                          <a href="product.php?id=<?php echo $product_categories['id'] ?>">
                        <div class="overview-item">
                            <img src="upload/product-categories/banner/<?php echo $product_categories['banner']; ?>" alt="image">
                            <div class="content">
                                
                                <h3>
                                   <?php echo $product_categories['name']; ?>
                                </h3>
                                <div class="default-btn">
                                    Order Now
                                    <i class="flaticon-play-button"></i>
                                    <span></span>
                                </div>
                            </div>
                           
                        </div>
                          </a>
                    </div>
                    <?php
                    }
                    ?>
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