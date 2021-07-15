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
        <title>Surasa Lanka (Pvt) Ltd. | Contact Us</title>
        <link rel="icon" type="image/png" href="assets/img/favicon.png">
        <link href="contact-form/style.css" rel="stylesheet" type="text/css"/>
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
                            <h2>Contact Us</h2>
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>
                                    <i class="flaticon-tea-cup"></i>
                                </li>
                                <li>Contact Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title-shape">
                <img src="assets/img/page-title/down-shape.png" alt="image">
            </div>
        </div>


        <section class="contact-box-area pt-100 pb-70">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="box-item">
                            <div class="contact-box-content">
                                <div class="icon">
                                    <i class="flaticon-world"></i>
                                </div>
                                <p>Surasa Lanka (Pvt) Ltd., 183/2, Ruppagoda, Gonahena,Kadawatha.</p>
                                <div class="shape">
                                    <img src="assets/img/image-icon/2.png" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="box-item">
                            <ul class="box-table">
                                <li>Sunday<span>Closed</span></li>
                                <li>Monday<span>8.00 a.m. - 5.00 p.m.</span></li>
                                <li>Tuesday<span>8.00 a.m. - 5.00 p.m.</span></li>
                                <li>Wednesday<span>8.00 a.m. - 5.00 p.m.</span></li>
                                <li>Friday<span>8.00 a.m. - 5.00 p.m.</span></li>
                                <li>Saturday<span>8.00 a.m. - 5.00 p.m.</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3">
                        <div class="box-item">
                            <div class="contact-box-content">
                                <div class="icon">
                                    <i class="flaticon-phone-ringing"></i>
                                </div>
                                <p>

                                    <a href="tel:+94773051737">+94 773 051 737</a>
                                </p>
                                <p>
                                    <a href="tel:+94112971632">+94 112 971 632</a>

                                </p>
                                <div class="shape">
                                    <img src="assets/img/image-icon/1.png" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="contact-area pb-100">
            <div class="container">
                <div class="contact-form">
                    <div class="title">
                        <span>Contact Us</span>
                        <h3>Contact With Us</h3>
                    </div>
                    <div id="contactForm">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="text" name="name" id="txtFullName" placeholder="Full Name *" class="form-control" >
                                    <span id="spanFullName"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="text" name="email" id="txtEmail" placeholder="Email *" class="form-control" >
                                    <span id="spanEmail"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="text" name="phone" id="txtPhone" placeholder="Phone Number *" class="form-control" >
                                    <span id="spanPhone"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="text" name="subject" id="txtSubject" placeholder="Subject *" class="form-control" >
                                    <span id="spanSubject"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" cols="30" rows="8" id="txtMessage" placeholder="Message *"></textarea>
                                    <span id="spanMessage"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <span id="capspan"></span>
                                    <input class="form-control" type="text" placeholder="Security Code" name="captchacode" id="captchacode" />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php
                                include ("./contact-form/captchacode-widget.php");
                                ?>
                                <img id="checking" src="contact-form/img/checking.gif" alt=""/>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <button type="submit" id="btnSubmit" value="Send" class="default-btn">
                                    Send Message
                                    <i class="flaticon-play-button"></i>
                                    <span></span>
                                </button>
                                <div class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 contact-us-button">
                        <div id="dismessage" align="center" class="msg-success"></div>
                    </div>
                </div>
            </div>
        </section>


        <div class="map pb-100">
            <div class="container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.010316979125!2d79.98434521427765!3d7.008067394937702!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2f9a453d68017%3A0x645f2637b74c4b2b!2sSURASA%20LANKA%20(PVT)%20LTD!5e0!3m2!1sen!2slk!4v1621506181027!5m2!1sen!2slk"></iframe>
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
        <script src="contact-form/scripts.js" type="text/javascript"></script>
    </body>


</html>