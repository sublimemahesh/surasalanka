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
        <title>Surasa Lanka (Pvt) Ltd. | Product</title>
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
                            <h2>Product</h2>
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>
                                    <i class="flaticon-tea-cup"></i>
                                </li>
                                <li>Product</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title-shape">
                <img src="assets/img/page-title/down-shape.png" alt="image">
            </div>
        </div>





        <section class="shop-area pt-100 pb-100">
            <div class="container">

                <div class="row">
                    <?php
                    $PRODUCT = new Product(NULL);
                    foreach ($PRODUCT->all() as $product) {
                        ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <div class="product-image">
                                    <a href="view-product.php?id=<?php echo $product['id']; ?>">
                                        <img src="upload/product-categories/sub-category/product/photos/<?php echo $product['image_name'] ?>" alt="image">
                                    </a>
                                    <a href="cart.php" class="add-to-cart-btn">
                                        Add To Cart
                                        <i class="flaticon-shopping-cart"></i>
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3>
                                        <a href="view-product.php?id=<?php echo $product['id']; ?>">
                                            <?php echo $product['name']; ?>
                                        </a>
                                    </h3>

                                    <div class="price">
                                        <?php
                                        if ($product['discount'] == 0) {
                                            ?>
                                            <span class="new">Rs. <?php echo number_format($product['price'], 2); ?></span>
                                            <?php
                                        } else {
                                            $discount = $product['price'] * $product['discount'] / 100;
                                            $price = $product['price'] - $discount;
                                            ?>
                                            <span class="new">Rs. <?php echo number_format($price, 2); ?></span><del>Rs. <?php echo number_format($product['price'], 2); ?></del>
                                            <?php
                                        }
                                        ?>

                                    </div>

                                </div>
                            </div>
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