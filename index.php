<?php
include './class/include.php';

if (!isset($_SESSION)) {
    session_start();
    $ABOUTUS = new Page(1);
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
        <title>Surasa Lanka (Pvt) Ltd.</title>
        <link rel="icon" type="image/png" href="assets/img/favicon.png">
        <link href="control-panel/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <div class="preloader">
            <div class="lds-ripple">
                <div></div>
                <div></div>
            </div>
        </div>


        <?php
        include './header.php';
        ?>

        <?php
        include './slider.php';
        ?>

        <section class="welcome-area ptb-50" ">
            <div class=" container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="welcome-image">
                            <img src="upload/page/<?php echo $ABOUTUS->image_name; ?>" alt="image">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="welcome-content">
                            <span>Welcome</span>
                            <h3 style="font-size:35px"><?php echo $ABOUTUS->title; ?></h3>
                            <p class="text-justify"><?php echo $ABOUTUS->description; ?></p>

                            <div class="welcome-btn">
                                <a href="about.php" class="default-btn">
                                    Explore History
                                    <i class="flaticon-play-button"></i>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="welcome-shape">
                <div class="shape1">
                    <img src="assets/img/image-icon/1.png" alt="image">
                </div>
                <div class="shape2">
                    <img src="assets/img/image-icon/2.png" alt="image">
                </div>
            </div>
        </section>

        <section class="food-area ptb-30">
            <div class="container">
                <div class="row">
                    <?php
                    $PRODUCT_CATEGORIES = new ProductCategories(NULL);
                    foreach ($PRODUCT_CATEGORIES->all() as $key => $product_categories) {
                        if ($key < 4) {
                            ?>
                            <div class="col-lg-3 col-md-6">
                                <a href="products.php?id=<?php echo $product_categories['id'] ?>">
                                    <div class="food-item">
                                        <img src="upload/product-categories/icon/<?php echo $product_categories['icon']; ?>" width="170">
                                        <h3><?php echo $product_categories['name']; ?></h3>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="burger-shop-area ptb-100">
            <div class="container">
                <div class="section-title">

                    <h2>Quality Products</h2>
                </div>
                <div class="burger-shop-slider owl-carousel owl-theme">
                    <?php
                    $PRODUCT = new Product(NULL);
                    foreach ($PRODUCT->all() as $product) {
                        $discount = $product['price'] * $product['discount'] / 100;
                        $price = $product['price'] - $discount;
                        ?>
                        <div class="burger-shop-item product-box">
                            <div class="image">
                                <a href="product.php?id=<?php echo $product['id']; ?>"><img src="upload/product-categories/sub-category/product/photos/<?php echo $product['image_name'] ?> " alt="image"></a>
                                <div class="burger-btn">
                                    <?php
                                    if ($product['in_stock'] == 1) {
                                        ?>
                                        <input type="hidden" id="name<?= $product['id']; ?>" value="<?= $product['name']; ?>" />
                                        <input type="hidden" id="price<?= $product['id']; ?>" value="<?= $price; ?>" />
                                        <input type="hidden" id="quantity<?= $product['id']; ?>" value="1" />
                                        <div class="cart-btn ">
                                            <div id="<?php echo $product['id']; ?>" min-qty="<?php echo $product['min_qty']; ?>" max-qty="<?php echo $product['max_qty']; ?>" class="add_to_cart default-btn addcart-link"> Add to Cart
                                                <i class="flaticon-play-button"></i>
                                                <span></span>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="addcart-link not-available-btn-hover "><i class="fa fa-shopping-basket"></i> Not in Stock</div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="content">
                                <a href="product.php?id=<?php echo $product['id']; ?>">
                                    <h3><?php echo $product['name'] ?> </h3>
                                    <p><?php echo substr($product['short_description'], 0, 50) . '..'; ?></p>
                                    <span>Rs.<?php echo number_format($price, 2) ?></span>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="burger-shop-shape">
                <div class="shape1">
                    <img src="assets/img/image-icon/3.png" alt="image">
                </div>
                <div class="shape2">
                    <img src="assets/img/image-icon/4.png" alt="image">
                </div>
                <div class="shape3">
                    <img src="assets/img/image-icon/6.png" alt="image">
                </div>
            </div>
        </section>



        <section class="others-area ptb-100">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="others-item">
                            <div class="number">
                                <span>01</span>
                            </div>
                            <p>Offering high-quality Nutritious products of superior taste.</p>
                        </div>
                        <div class="others-item main-item">
                            <div class="number">
                                <span>02</span>
                            </div>
                            <p>Dairy products are made from fresh cow`s milk sourced from local dairy cows.</p>
                        </div>
                        <div class="others-item bottom-0">
                            <div class="number">
                                <span>03</span>
                            </div>
                            <p>Products made from fresh quality pure Kithul honey exported from Deraniyagala and
                                Kandy areas.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="others-item two main-item-two">
                            <div class="number">
                                <span>04</span>
                            </div>
                            <p>Quality control standards with certification of ISO22000 food products at affordable
                                prices.</p>
                        </div>
                        <div class="others-item two">
                            <div class="number">
                                <span>05</span>
                            </div>
                            <p>Watalappan integrated with Jaggery, Skimmed milk, Egg, Nutmeg, Cardamom, Clove
                                & Permitted Preservatives(INS 202).</p>
                        </div>
                        <div class="others-item two main-item-two bottom-0">
                            <div class="number">
                                <span>06</span>
                            </div>
                            <p>The facility of Online ordering is approved.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="others-shape">
                <div class="shape1">
                    <img src="assets/img/shape/shape1.png" alt="image">
                </div>
                <div class="shape2">
                    <img src="assets/img/shape/shape2.png" alt="image">
                </div>
            </div>
        </section>

        <section class="testimonial-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <span>Testimonial</span>
                    <h2>Our Clients Review</h2>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="testimonial-slider owl-carousel owl-theme">
                            <?php
                            $COMMENT = new Comments(NULL);
                            foreach ($COMMENT->activeComments() as $comment) {
                                ?>
                                <div class="testimonial-item">
                                    <div class="info">
                                        <h3><?php echo $comment['name']; ?></h3>
                                        <span><?php echo $comment['title']; ?></span>
                                    </div>
                                    <p><?php echo $comment['comment']; ?></p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="testimonial-image">
                            <img src="assets/img/feedback/image.png" alt="image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-shape">
                <div class="shape1">
                    <img src="assets/img/image-icon/5.png" alt="image">
                </div>
                <div class="shape2">
                    <img src="assets/img/image-icon/3.png" alt="image">
                </div>
                <div class="shape3">
                    <img src="assets/img/image-icon/6.png" alt="image">
                </div>
                <div class="shape4">
                    <img src="assets/img/image-icon/2.png" alt="image">
                </div>
                <div class="shape5">
                    <img src="assets/img/image-icon/6.png" alt="image">
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


        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>

        <script src="assets/js/popper.min.js"></script>

        <script src="assets/js/bootstrap.min.js"></script>
        <script src="control-panel/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>

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
        <script src="js/add-to-cart.js" type="text/javascript"></script>
        <script src="js/login.js" type="text/javascript"></script>
    </body>


</html>