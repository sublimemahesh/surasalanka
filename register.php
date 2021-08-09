<?php
include './class/include.php';
if (!isset($_SESSION)) {
    session_start();
}
$checkout = '';
if (isset($_GET['checkout'])) {
    $checkout = 'checkout';
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
    <title>Surasa Lanka (Pvt) Ltd. | Register</title>
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
                        <h2>Register</h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li>
                                <i class="flaticon-tea-cup"></i>
                            </li>
                            <li>Register</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-title-shape">
            <img src="assets/img/page-title/down-shape.png" alt="image">
        </div>
    </div>


    <div class="signup-area ptb-100">
        <div class="container">
            <div class="signup-form">
                <h3>Create your Account</h3>
                <form id="register-form">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="form-control" id="district"  name="district">
                                    <option class="active light-c" value=""> -- Please Select a District -- </option>
                                    <?php
                                    $DISTRICT = new District(NULL);
                                    foreach ($DISTRICT->all() as $key => $district) {
                                    ?>
                                        <option value="<?php echo $district['id']; ?>"><?php echo $district['name']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="form-control" autocomplete="off" type="text" id="city" autocomplete="off" name="city">
                                    <option value=""> -- Please Select a City -- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="send-btn">
                            <input type="hidden" name="back_url" id="back_url" value="<?php echo $checkout; ?>" >
                                <button type="#" class="default-btn" name="register-submit" id="register-submit">
                                    Register Now
                                    <span></span>
                                </button>
                            </div>
                            <br>
                            <span>Already a registered user? <a href="login.php">Login Now!</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




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
    <script src="js/registration.js" type="text/javascript"></script>
    <script src="js/add-to-cart.js" type="text/javascript"></script>
    <script src="js/city.js" type="text/javascript"></script>
</body>


</html>