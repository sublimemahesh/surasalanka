<?php
include './class/include.php';
if (!isset($_SESSION)) {
    session_start();
}
$disabled = '';
if (!isset($_SESSION["shopping_cart"])) {
    $disabled = 'disabled';
}
$_SESSION["back_url"] = '';
if (!Customer::authenticate()) {
    $_SESSION["back_url"] = 'checkout';
    redirect('login.php');
}
if (!isset($_SESSION["shopping_cart"]) || empty($_SESSION["shopping_cart"])) {
    redirect('cart.php');
}
$CUSTOMER = new Customer($_SESSION['id']);
$CITY = new City($CUSTOMER->city);
$DISTRICT = new District($CUSTOMER->district);
$delivery_charge = DefaultData::getDeliveryCharges();

if (isset($_GET["order_id"])) {
    $ID = $_GET["order_id"];

    $paymentSatusCode = Order::getPaymentStatusCode($ID);
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
    <title>Surasa Lanka (Pvt) Ltd. | Checkout</title>
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
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li>
                                <i class="flaticon-tea-cup"></i>
                            </li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-title-shape">
            <img src="assets/img/page-title/down-shape.png" alt="image">
        </div>
    </div>


    <section class="checkout-area ptb-100">
        <div class="container">
            <div class="alert" id="beautypress-form-msg">
                <?php
                if (isset($_GET["order_id"])) {
                    if ($paymentSatusCode == 2) {
                        unset($_SESSION["shopping_cart"]);
                ?>
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> Your Payment has been succeeded.
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error!</strong> Your Payment was not successful. Please do your reservation again.
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <!-- <form method="post" action="https://www.payhere.lk/pay/checkout" name="contact-from" id="payments" class="booking-form">  -->
            <form method="post" action="https://sandbox.payhere.lk/pay/checkout" name="contact-from" id="payments" class="booking-form">

                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="billing-details">
                            <h3 class="title">Billing Details</h3>
                            <div class="row">

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Contact Number
                                            <span class="required">*</span>
                                        </label>
                                        <input type="text" name="contact_no_1" id="txtContactNo" placeholder="Contact Number" class="form-control" value="<?php echo $CUSTOMER->phone_number; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Additional Contact Number
                                        </label>
                                        <input type="text" name="contact_no_2" id="txtContactNo2" placeholder="Additional Contact Number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" id="txtAddress" placeholder="Address" class="form-control" value="<?php echo $CUSTOMER->address; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>District
                                            <span class="required">*</span>
                                        </label>
                                        <div class="select-box">
                                            <select name="district" id="district" class="form-control">
                                                <option>--Select District--</option>
                                                <?php
                                                foreach (District::all() as $district) {
                                                    if ($district['id'] == $CUSTOMER->district) {
                                                ?>
                                                        <option value="<?php echo $district['id']; ?>" selected dis-name="<?php echo $district['name']; ?>"><?php echo $district['name']; ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $district['id']; ?>" dis-name="<?php echo $district['name']; ?>"><?php echo $district['name']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>City
                                            <span class="required">*</span>
                                        </label>
                                        <div class="select-box">
                                            <select name="city" id="city" class="form-control">
                                                <option>--Select City--</option>
                                                <?php
                                                foreach (City::GetCitiesByDistrict($CUSTOMER->district) as $city) {
                                                    if ($city['id'] == $CUSTOMER->city) {
                                                ?>
                                                        <option value="<?php echo $city['id']; ?>" selected city-name="<?php echo $city['name']; ?>"><?php echo $city['name']; ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $city['id']; ?>" city-name="<?php echo $city['name']; ?>"><?php echo $city['name']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea id="txtOrderNote" name="txtOrderNote" placeholder="Order Notes" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="order-details">
                            <h3 class="title">Your Order</h3>
                            <div class="order-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tot = 0;
                                        $items = '';
                                        if (isset($_SESSION["shopping_cart"])) {
                                            foreach ($_SESSION["shopping_cart"] as $product) {

                                                $PRODUCT = new Product($product['product_id']);
                                                $name =  $product["product_name"];

                                                $price = $product['product_quantity'] * $product['product_price'];
                                                $tot += $price;
                                                $items = '';
                                                if (empty($items)) {
                                                    $items .= $name;
                                                } else {
                                                    $items .= ', ' . $name;
                                                }
                                        ?>
                                                <tr>
                                                    <td class="product-name"> <?php echo $name; ?>&nbsp;<span class="product-quantity">× <?php echo $product['product_quantity']; ?></span></td>
                                                    <td class="product-total text-right"><span class="amount">Rs. <?php echo number_format($price, 2); ?></span> </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr class="cart_item">
                                                <td colspan="2">Your cart is empty.</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <?php
                                        $grand_total = $tot + $delivery_charge;
                                        ?>
                                        <tr class="order-total">
                                            <th class="product-name">Delivery Charges</th>
                                            <th class="product-total text-right"><strong><span class="amount">Rs. <?= number_format($delivery_charge, 2); ?></span></strong> </th>
                                        </tr>
                                        <tr class="order-total">
                                            <th class="product-name">Total</th>
                                            <th class="product-total text-right"><strong><span class="amount">Rs. <?php echo number_format($grand_total, 2); ?></span></strong> </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="payment-box">
                                <div class="payment-method">
                                    <p>
                                        <input type="radio" id="online-payment" name="payment_method" value="online_payment">
                                        <label for="online-payment">Online Payment</label>
                                    </p>
                                    <p>
                                        <input type="radio" id="cash-on-delivery" name="payment_method" value="cash_on_delivery">
                                        <label for="cash-on-delivery">Cash on Delivery</label>
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 agree-check-box">
                                        <label class="checkbox-container">Click here to indicate that you have read and agree to the <a href="terms-and-conditions.php" target="_blank" class="text-blue">terms and conditions</a>.
                                            <input type="checkbox" name="agree" id="agree"><span class="checkmark">
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <input type="hidden" name="delivery_charges" id="delivery_charges" value="<?= $delivery_charge; ?>" />
                                <a href="#" class="default-btn order-btn" id="place_order" <?php echo $disabled; ?> prod-total="<?php echo $tot; ?>">
                                    Place Order
                                    <span></span>
                                </a>

                                <!-- <input type="hidden" name="merchant_id" value="214743">  Live Merchant ID -->
                                <input type="hidden" name="merchant_id" value="1213021"> <!-- Sandbox Merchant ID-->
                                <input type="hidden" name="return_url" value="http://www.surasalanka.com/checkout.php">
                                <input type="hidden" name="cancel_url" value="http://www.surasalanka.com/checkout?cancel">
                                <input type="hidden" name="notify_url" value="http://www.surasalanka.com/payments/notify.php">

                                <input type="hidden" name="order_id" id="current_order_id" value="">
                                <input type="hidden" name="items" value="<?php echo $items ?>">
                                <input type="hidden" name="currency" value="LKR">
                                <input type="hidden" name="member" id="member" value="<?php echo $_SESSION['id']; ?>">
                                <input name="amount" id="total_amount" type="hidden" value="<?php echo $grand_total; ?>" class="payment">

                                <input type="hidden" name="first_name" value="<?php echo $CUSTOMER->name; ?>">
                                <input type="hidden" name="last_name" value="<?php echo $CUSTOMER->name; ?>">
                                <input type="hidden" name="email" value="<?php echo $CUSTOMER->email; ?>">

                                <input type="hidden" id="txtDistrict" value="<?php echo $DISTRICT->name; ?>">
                                <input type="hidden" id="txtCity" value="<?php echo $CITY->name; ?>">
                                <input type="hidden" id="txtCountry" name="country" value="Sri Lanka">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
    <script src="js/order.js" type="text/javascript"></script>
</body>


</html>