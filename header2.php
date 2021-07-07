<div class="navbar-area">
    <div class="main-responsive-nav">
        <div class="container">
            <div class="main-responsive-menu">
                <div class="logo">
                    <a href="index.php">

                        <img src="assets/img/logo1.png" alt=""/>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-navbar header2">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/img/logo1.png" alt=""/>
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link active">
                                Home

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="products.php" class="nav-link">
                                Product
                                <i class='bx bx-chevron-down'></i>
                            </a>
                           <ul class="dropdown-menu">
                                <?php
                                $PRODUCT_CATEGORIES = new ProductCategories(NULL);
                                foreach ($PRODUCT_CATEGORIES->all() as $product_categories) {
                                    ?>
                                    <li class="nav-item">
                                        <a href="product.php?id=<?php echo $product_categories['id'] ?>" class="nav-link">
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
                        <div class="option-item">
                            <div class="cart-btn">
                                <a href="cart.php">
                                    <i class="flaticon-shopping-cart"></i>
                                    <span>0</span>
                                </a>
                            </div>
                        </div>
                        <div class="option-item">
                            <a href="login.php" class="default-btn">
                                Order Online
                                <span></span>
                            </a>
                        </div>
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
                        <div class="option-item">
                            <div class="cart-btn">
                                <a href="#">
                                    <i class="flaticon-shopping-cart"></i>
                                    <span>0</span>
                                </a>
                            </div>
                        </div>
                        <div class="option-item">
                            <a href="#" class="default-btn">
                                Order Online
                                <span></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>