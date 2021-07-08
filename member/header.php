
<div id="header">
    <div class="header-nav2 header-nav4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-3 col-xs-6 logo-section">
                    <div class="logo4">
                        <h1 class="hidden">Super Shop</h1>
                        <a href="../"><img src="../assets/img/logo1.png" alt="" /></a>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 hidden-xs">
                    <div class="name-section col-md-6 col-xs-7"><h3 class="header-title">Customer Dashboard</h3></div>
                    <!-- End Main Nav -->
                    <div class="name-section col-md-6 col-sm-6 col-xs-5">
                        <div class="top-info">
                            <ul class="top-info-right top-info  "> 
                                <li class="top-account has-child">
                                    <div id="img_url" ></div>
                                    <?php
                                    if (isset($CUSTOMER->id)) {
                                        if (empty($CUSTOMER->image_name)) {
                                            ?>

                                            <img src="../assets/img/user.png" alt="" class="img-circle" /> <?php echo $_SESSION['name']; ?>
                                        <?php } else { ?>
                                            <img src="../upload/customer/profile/<?php echo $CUSTOMER->image_name ?>" alt="" class="img-circle"/> <?php echo $_SESSION['name']; ?>

                                        <?php } ?>
                                        <ul class="sub-menu-top">

                                            <li><a href="../post-and-get/logout.php"><span> <i class="fa fa-sign-in " ></i>Log Out</span></a></li>
                                        </ul>
                                        <?php
                                    } else {
                                        ?> 
                                        <div id="img-t">
                                            <img src="../assets/img/user.png" alt="" class="img-circle" /> My Account 
                                        </div>

                                    <?php } ?>



                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 visible-xs">
                    <!-- End Main Nav -->
                    <div class="name-section">
                        <div class="top-info">
                            <ul class="top-info-right top-info  "> 
                                <li class="top-account has-child">
                                    <div id="img_url" ></div>
                                    <?php
                                    if (isset($CUSTOMER->id)) {
                                        if (empty($CUSTOMER->image_name)) {
                                            ?>

                                            <img src="../images/user.png" alt="" class="img-circle" /> <?php echo $_SESSION['name']; ?>
                                        <?php } else { ?>
                                            <img src="../upload/customer/profile/<?php echo $CUSTOMER->image_name ?>" alt="" class="img-circle"/> <?php echo $_SESSION['name']; ?>

                                        <?php } ?>
                                        <ul class="sub-menu-top">

                                            <li><a href="../post-and-get/logout.php"><span> <i class="fa fa-sign-in " ></i>Log Out</span></a></li>
                                        </ul>
                                        <?php
                                    } else {
                                        ?> 
                                        <div id="img-t">
                                            <img src="images/user.png" alt="" class="img-circle" /> My Account 
                                        </div>

                                    <?php } ?>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Nav2 -->
</div>



