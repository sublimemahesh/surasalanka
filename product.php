<?php
include './class/include.php';
if (!isset($_SESSION)) {
    session_start();
}
$PRODUCT = new Product($_GET['id']);

$CAT = new ProductCategories($PRODUCT->category);
$discount = $PRODUCT->price * ($PRODUCT->discount / 100);
$price = $PRODUCT->price - $discount;
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
    <title>Surasa Lanka (Pvt) Ltd. | <?php echo $PRODUCT->name; ?> </title>
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
    include './header2.php';
    ?>


    <div class="page-title-area item-bg-1">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="page-title-content">
                        <h2><?php echo $PRODUCT->name; ?> </h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li>
                                <i class="flaticon-tea-cup"></i>
                            </li>
                            <li><?php echo $PRODUCT->name; ?> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-title-shape">
            <img src="assets/img/page-title/down-shape.png" alt="image">
        </div>
    </div>


    <section class="product-details-area pt-100 pb-70">
        <div class="container">

            <div class="row align-items-center">
                <?php
                $PRODUCT_PHOTO = new ProductPhoto(null);
                foreach ($PRODUCT_PHOTO->getProductPhotosById($PRODUCT->id) as $product_photo) {
                ?>
                    <div class="col-lg-6 col-md-12">
                        <div class="product-details-image">
                            <img src="upload/product-categories/sub-category/product/photos/gallery/<?php echo $product_photo['image_name'] ?>" alt="image">
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="col-lg-6 col-md-12">
                    <div class="product-details-desc">
                        <h3><?php echo $PRODUCT->name; ?></h3>
                        <div class="price">
                            <?php
                            if ($PRODUCT->discount == 0) {
                            ?>
                                <span class="new">Rs. <?php echo number_format($PRODUCT->price, 2); ?></span>
                            <?php
                            } else {
                                $discount = $PRODUCT->price * $PRODUCT->discount / 100;
                                $price = $PRODUCT->price - $discount;
                            ?>
                                <span class="new">Rs. <?php echo number_format($price, 2); ?></span><del>Rs. <?php echo number_format($PRODUCT->price, 2); ?></del>
                            <?php
                            }
                            ?>
                        </div>

                        <p><?php echo substr($PRODUCT->description, 0, 250) . '..'; ?></p>
                        <div class="product-add-to-cart">
                            <div class="input-counter">
                                <input type="hidden" value="1" name="demo_vertical2" />
                                <span class="minus-btn">
                                    <i class='bx bx-minus'></i>
                                </span>
                                <input type="text" min="1" value="1" id="quantity<?= $PRODUCT->id; ?>">
                                <span class="plus-btn">
                                    <i class='bx bx-plus'></i>
                                </span>
                            </div>

                            <?php
                            if ($PRODUCT->in_stock == 1) {
                            ?>
                                <div class="default-btn">
                                    <input type="hidden" id="name<?= $PRODUCT->id; ?>" value="<?= $PRODUCT->name; ?>" />
                                    <input type="hidden" id="price<?= $PRODUCT->id; ?>" value="<?= $price; ?>" />
                                    <div id="<?php echo $PRODUCT->id; ?>" min-qty="<?php echo $PRODUCT->min_qty; ?>" max-qty="<?php echo $PRODUCT->max_qty; ?>" class="add_to_cart add_to_cart_btn"><i class="fa fa-shopping-cart"></i> Add to Cart</div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="default-btn"><i class="fa fa-shopping-cart"></i> Not in Stock</div>
                            <?php
                            }
                            ?>

                            <!-- <button type="submit" class="default-btn">
                                Add to cart
                                <span></span>
                            </button> -->
                        </div>

                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="tab products-details-tab">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <ul class="tabs">
                                    <li>
                                        <a href="#">
                                            <div class="dot"></div>
                                            Description
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="tab_content">
                                    <div class="tabs_item">
                                        <div class="products-details-tab-content">
                                            <p><?php echo $PRODUCT->description; ?></p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="related-products">
            <div class="container">
                <div class="products-title">
                    <span class="sub-title">Our Shop</span>
                    <h2>Related Products</h2>
                </div>
                <div class="row">
                    <?php
                    $PRODUCT1 = new Product(NULL);
                    foreach ($PRODUCT1->all() as $key => $product1) {
                        if ($key < 4) {
                            $discount = $product1['price'] * $product1['discount'] / 100;
                            $price = $product1['price'] - $discount;
                    ?>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="single-product">
                                    <div class="product-image">
                                        <a href="product.php?id=<?php echo $product1['id']; ?>">
                                            <img src="upload/product-categories/sub-category/product/photos/<?php echo $product1['image_name'] ?>" alt="image">
                                        </a>
                                        <?php
                                        if ($product1['in_stock'] == 1) {
                                        ?>
                                            <input type="hidden" id="name<?= $product1['id']; ?>" value="<?= $product1['name']; ?>" />
                                            <input type="hidden" id="price<?= $product1['id']; ?>" value="<?= $price; ?>" />
                                            <input type="hidden" id="quantity<?= $product1['id']; ?>" value="1" />
                                            <a href="#" id="<?php echo $product1['id']; ?>" min-qty="<?php echo $product1['min_qty']; ?>" max-qty="<?php echo $product1['max_qty']; ?>" class="add_to_cart add-to-cart-btn"> Add to Cart
                                                <i class="flaticon-play-button"></i>
                                            </a>

                                        <?php
                                        } else {
                                        ?>
                                            <div class="add-to-cart-btn "><i class="flaticon-shopping-cart"></i> Not in Stock</div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="product-content">
                                        <h3>
                                            <a href="product.php?id=<?php echo $product1['id']; ?>"><?php echo $product1['name']; ?></a>
                                        </h3>
                                        <div class="price">
                                            <?php
                                            if ($product1['discount'] == 0) {
                                            ?>
                                                <span class="new">Rs. <?php echo number_format($product1['price'], 2); ?></span>
                                            <?php
                                            } else {

                                            ?>
                                                <span class="new">Rs. <?php echo number_format($price, 2); ?></span><del>Rs. <?php echo number_format($product1['price'], 2); ?></del>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
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

    <script src="control-panel/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="js/add-to-cart.js" type="text/javascript"></script>
    <script src="js/login.js" type="text/javascript"></script>
</body>


</html>