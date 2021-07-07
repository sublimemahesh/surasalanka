   <div class="main-slider-area pb-50">
            <div class="home-slider owl-carousel owl-theme">
                <?php
                $SLIDER = new Slider(NULL);
                foreach ($SLIDER->all() as $slider) {
                    ?>
                <div class="home-item item-bg1">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="slider-content">
                                            <span>Updated Menu's Item</span>
                                            <h1><?php echo $slider['title'] ?> </h1>
                                            <?php echo $slider['description'] ?> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="slider-image">
                                            <img src="upload/slider/<?php echo $slider['image_name'] ?> " alt="image">
                                            <div class="shape">
                                                <img src="assets/img/slider/shape.png" alt="image">
                                                <div class="dollar">
                                                    <span>Upward From</span>
                                                    <h3> <?php echo $slider['url'] ?> </h3>
                                                    <i class="flaticon-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?> 
            </div>
     
        </div>