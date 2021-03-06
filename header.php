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
    <div class="main-navbar">
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
                                Products
                                <i class='bx bx-chevron-down'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                $PRODUCT_CATEGORIES = new ProductCategories(NULL);
                                foreach ($PRODUCT_CATEGORIES->all() as $product_categories) {
                                ?>
                                    <li class="nav-item">
                                        <a href="products.php?category=<?php echo $product_categories['id'] ?>" class="nav-link">
                                            <?php echo $product_categories['name']; ?>
                                        </a>
                                    </li>

                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="offers.php" class="nav-link">
                                Offers
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
                                    <a href="login.php" class="nav-link">
                                        <img src="assets/img/image-icon/signin.png" alt="Login" /> : Login
                                    </a>
                                </div>
                            </div>
                            <div class="option-item">
                                <div class="cart-btn sign-in-btn">
                                    <a href="register.php" class="nav-link">
                                        <img src="assets/img/image-icon/signup.png" alt="Register" /> : Register
                                    </a>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="option-item">
                                <div class="cart-btn sign-in-btn">
                                    <a href="member/" class="nav-link" title="My Account">
                                        <!-- <h5 class="text-black">Hi, <?php
                                                                    $arr = explode(' ', $_SESSION['name']);

                                                                    echo $arr[0]; ?></h5> -->
                                                                    <h5>My Account</h5>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="option-item cart-icon-section">
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
                                    <a href="login.php" class="nav-link">
                                        <img src="assets/img/image-icon/signin.png" alt="Login" />
                                    </a>
                                </div>
                            </div>
                            <div class="option-item">
                                <div class="cart-btn sign-in-btn">
                                    <a href="register.php" class="nav-link">
                                        <img src="assets/img/image-icon/signup.png" alt="Register" />
                                    </a>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="option-item">
                                <div class="cart-btn sign-in-btn">
                                    <a href="member/" class="nav-link" title="My Account">
                                        <h5>My Account</h5>
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
                                    <span>0</span>
                                </a>
                            </div>
                        </div>
                        <!-- <div class="option-item">
                            <a href="login.php" class="default-btn">
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