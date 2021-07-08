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
            
            <form method="post" id="payments">
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
                                        <textarea  id="txtOrderNote" name="txtOrderNote" placeholder="Order Notes" cols="30" rows="5" class="form-control"></textarea>
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

                                    
                                        <tr>
                                            <td class="product-name">
                                                <a href="#">Dungeon Burgers</a>
                                            </td>
                                            <td class="product-total">
                                                <span class="subtotal-amount">$455.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="product-name">
                                                <a href="#">Pit Master Burgers</a>
                                            </td>
                                            <td class="product-total">
                                                <span class="subtotal-amount">$541.50</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="product-name">
                                                <a href="#">Backyard Burgers</a>
                                            </td>
                                            <td class="product-total">
                                                <span class="subtotal-amount">$140.50</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="product-name">
                                                <a href="#">Burger Ferguson</a>
                                            </td>
                                            <td class="product-total">
                                                <span class="subtotal-amount">$547.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="order-subtotal">
                                                <span>Rockin' Burgers</span>
                                            </td>
                                            <td class="order-subtotal-price">
                                                <span class="order-subtotal-amount">$1683.50</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="order-shipping">
                                                <span>CrazyBurger</span>
                                            </td>
                                            <td class="shipping-price">
                                                <span>$30.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="total-price">
                                                <span>Order Total</span>
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="subtotal-amount">$1713.50</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="payment-box">
                                <div class="payment-method">
                                    <p>
                                        <input type="radio" id="direct-bank-transfer" name="radio-group" checked>
                                        <label for="direct-bank-transfer">Direct Bank Transfer</label>
                                        Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                    </p>
                                    <p>
                                        <input type="radio" id="paypal" name="radio-group">
                                        <label for="paypal">PayPal</label>
                                    </p>
                                    <p>
                                        <input type="radio" id="cash-on-delivery" name="radio-group">
                                        <label for="cash-on-delivery">Cash on Delivery</label>
                                    </p>
                                </div>
                                <a href="#" class="default-btn order-btn">
                                    Place Order
                                    <span></span>
                                </a>
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
</body>


</html>