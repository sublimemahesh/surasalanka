<div class="navbar-area">
    <div class="main-responsive-nav">
        <div class="container">
            <div class="main-responsive-menu">
                <div class="logo">
                    <a href="index.php">

                        <img src="assets/img/logo1.png" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-navbar header2">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/img/logo1.png" alt="" />
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link active">
                                Home

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="all-products.php" class="nav-link">
                                Product
                                <i class='bx bx-chevron-down'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                $PRODUCT_CATEGORIES = new ProductCategories(NULL);
                                foreach ($PRODUCT_CATEGORIES->all() as $product_categories) {
                                ?>
                                    <li class="nav-item">
                                        <a href="products.php?id=<?php echo $product_categories['id'] ?>" class="nav-link">
                                            <?php echo $product_categories['name']; ?>
                                        </a>
                                    </li>

                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="offer.php" class="nav-link">
                                Offer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="about.php" class="nav-link">
                                About Us

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contact.php" class="nav-link">
                                Contact Us

                            </a>
                        </li>
                    </ul>
                    <div class="others-options d-flex align-items-center">
                        <?php
                        if (!isset($_SESSION['id'])) {
                        ?>
                            <div class="option-item">
                                <div class="cart-btn sign-in-btn">
                                    <a href="login.php" class="nav-link" title="Sign In">
                                        <img src="assets/img/image-icon/signin-w.png" class="sign_in_btn_w" alt="Sign In" />
                                        <img src="assets/img/image-icon/signin.png" class="sign_in_btn_b" alt="Sign In" />
                                    </a>
                                </div>
                            </div>
                            <div class="option-item">
                                <div class="cart-btn sign-in-btn">
                                    <a href="sign-up.php" class="nav-link" title="Sign Up">
                                        <img src="assets/img/image-icon/signup-w.png" class="sign_up_btn_w" alt="Sign Up" />
                                        <img src="assets/img/image-icon/signup.png" class="sign_up_btn_b" alt="Sign Up" />
                                    </a>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="option-item">
                                <div class="cart-btn sign-in-btn">
                                    <a href="member/" class="nav-link" title="Sign In">
                                        <h5>Hi, <?php
                                                $arr = explode(' ', $_SESSION['name']);

                                                echo $arr[0]; ?></h5>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="option-item">
                            <div class="cart-btn">
                                <a href="cart.php">
                                    <i class="flaticon-shopping-cart"></i>
                                    <span class="cart-badge">0</span>
                                </a>
                            </div>
                        </div>
                        <!-- <div class="option-item">
                            <a href="checkout.php" class="default-btn">
                                Order Online
                                <span></span>
                            </a>
                        </div> -->
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="others-option-for-responsive">
        <div class="container">
            <div class="dot-menu">
                <div class="inner">
                    <div class="circle circle-one"></div>
                    <div class="circle circle-two"></div>
                    <div class="circle circle-three"></div>
                </div>
            </div>
            <div class="container">
                <div class="option-inner">
                    <div class="others-options d-flex align-items-center">
                        <?php
                        if (!isset($_SESSION['id'])) {
                        ?>
                            <div class="option-item">
                                <div class="cart-btn sign-in-btn">
                                    <a href="login.php" class="nav-link" title="Sign In">
                                        <img src="assets/img/image-icon/signin.png" alt="Sign In" />
                                    </a>
                                </div>
                            </div>
                            <div class="option-item">
                                <div class="cart-btn sign-in-btn">
                                    <a href="sign-up.php" class="nav-link" title="Sign Up">
                                        <img src="assets/img/image-icon/signup.png" alt="Sign Up" />
                                    </a>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="option-item">
                                <div class="cart-btn sign-in-btn">
                                    <a href="member/" class="nav-link" title="Sign In">
                                        <h5>Hi, <?php
                                                $arr = explode(' ', $_SESSION['name']);

                                                echo $arr[0]; ?></h5>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="option-item">
                            <div class="cart-btn">
                                <a href="cart.php">
                                    <i class="flaticon-shopping-cart"></i>
                                    <span class="cart-badge">0</span>
                                </a>
                            </div>
                        </div>
                        <!-- <div class="option-item">
                            <a href="#" class="default-btn">
                                Order Online
                                <span></span>
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>