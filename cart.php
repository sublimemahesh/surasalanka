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
    <title>Surasa Lanka (Pvt) Ltd. | Cart</title>
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
                        <h2>Cart</h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li>
                                <i class="flaticon-tea-cup"></i>
                            </li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-title-shape">
            <img src="assets/img/page-title/down-shape.png" alt="image">
        </div>
    </div>


    <section class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <form>
                        <div class="cart-table table-responsive" id="add-cart">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#">
                                                <img src="assets/img/shop/image1.jpg" alt="item">
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="#">Burger Bistro</a>
                                        </td>
                                        <td class="product-price">
                                            <span class="unit-amount">$455.00</span>
                                        </td>
                                        <td class="product-quantity">
                                            <div class="input-counter">
                                                <span class="minus-btn">
                                                    <i class='bx bx-minus'></i>
                                                </span>
                                                <input type="text" value="1">
                                                <span class="plus-btn">
                                                    <i class='bx bx-plus'></i>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="subtotal-amount">$455.00</span>
                                            <a href="#" class="remove">
                                                <i class='bx bx-trash'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#">
                                                <img src="assets/img/shop/image2.jpg" alt="item">
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="#">Hot Cross Buns</a>
                                        </td>
                                        <td class="product-price">
                                            <span class="unit-amount">$541.50</span>
                                        </td>
                                        <td class="product-quantity">
                                            <div class="input-counter">
                                                <span class="minus-btn">
                                                    <i class='bx bx-minus'></i>
                                                </span>
                                                <input type="text" value="1">
                                                <span class="plus-btn">
                                                    <i class='bx bx-plus'></i>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="subtotal-amount">$541.50</span>
                                            <a href="#" class="remove">
                                                <i class='bx bx-trash'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#">
                                                <img src="assets/img/shop/image3.jpg" alt="item">
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="#">We Love Beef</a>
                                        </td>
                                        <td class="product-price">
                                            <span class="unit-amount">$140.50</span>
                                        </td>
                                        <td class="product-quantity">
                                            <div class="input-counter">
                                                <span class="minus-btn">
                                                    <i class='bx bx-minus'></i>
                                                </span>
                                                <input type="text" value="1">
                                                <span class="plus-btn">
                                                    <i class='bx bx-plus'></i>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="subtotal-amount">$140.50</span>
                                            <a href="#" class="remove">
                                                <i class='bx bx-trash'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#">
                                                <img src="assets/img/shop/image4.jpg" alt="item">
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="#">Dungeon Burgers</a>
                                        </td>
                                        <td class="product-price">
                                            <span class="unit-amount">$547.00</span>
                                        </td>
                                        <td class="product-quantity">
                                            <div class="input-counter">
                                                <span class="minus-btn">
                                                    <i class='bx bx-minus'></i>
                                                </span>
                                                <input type="text" value="1">
                                                <span class="plus-btn">
                                                    <i class='bx bx-plus'></i>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="subtotal-amount">$547.00</span>
                                            <a href="#" class="remove">
                                                <i class='bx bx-trash'></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-buttons hidden">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-sm-7 col-md-7">
                                    <div class="shopping-coupon-code">
                                        <input type="text" class="form-control" placeholder="Coupon code" name="coupon-code" id="coupon-code">
                                        <button type="submit">Apply Coupon</button>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-sm-5 col-md-5">
                                    <a href="#" class="default-btn">
                                        Update cart-totals
                                        <span></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="cart-totals">
                            <h3>Cart Totals</h3>
                            <ul>
                                <li>Subtotal
                                    <span class="cart_sub_total">Rs. 0.00</span>
                                </li>
                                <li>Shipping
                                    <span>Rs. 0.00</span>
                                </li>
                                <li>Total
                                    <span class="cart_sub_total"><b>Rs. 0.00</b></span>
                                </li>
                            </ul>
                            <a href="checkout.php" class="default-btn">
                                Proceed to Checkout
                                <span></span>
                            </a>
                        </div>
                    </form>
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