<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$OFFER = new Offer($id);
?> 

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Offer</title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>

        <section class="content">
            <div class="container-fluid">  
                <?php
                $vali = new Validator();
                $vali->show_message();
                ?>
                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Edit Offer
                                </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-offer.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>

                            </div>
                            <div class="body">
                                <form class="form-horizontal" method="post" action="post-and-get/offer.php" enctype="multipart/form-data"> 

                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control" type="text" id="product_category" autocomplete="off" >
                                                    <option class="active light-c"> -- Please  Select Product Category -- </option>
                                                    <?php
                                                    $PRODUCT = new Product($OFFER->product_id);
                                                    $PRODUCT_CATEGORIES = new ProductCategories(NULL);
                                                    foreach ($PRODUCT_CATEGORIES->all() as $key => $product_categories) {
                                                        if ($product_categories['id'] == $PRODUCT->category) {
                                                            ?>
                                                            <option value="<?php echo $product_categories['id']; ?>" selected=""><?php echo $product_categories['name']; ?></option>

                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $product_categories['id']; ?>" ><?php echo $product_categories['name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control" type="text" id="product" autocomplete="off" name="product">
                                                    <option class="active light-c"> -- Please  Select Product Category First -- </option> 

                                                    <?php
                                                    $PRODUCT = new Product(NULL);
                                                    $PRODUCT = new Product($OFFER->product_id);
                                                    foreach ($PRODUCT->getProductsByCategory($PRODUCT->category) as $product) {
                                                        if ($product['id'] == $OFFER->product_id) {
                                                            ?>
                                                            <option value="<?php echo $product['id']; ?>" selected=""><?php echo $product['name']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>           
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="title" class="form-control"  value="<?php echo $OFFER->title; ?>"  name="title"  required="TRUE">
                                                <label class="form-label">Title</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="file" id="image" class="form-control" value="<?php echo $OFFER->image_name; ?>"  name="image">
                                                <img src="../upload/offer/<?php echo $OFFER->image_name; ?>" id="image" class="view-edit-img img img-responsive img-thumbnail" name="image" alt="old image">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="title" class="form-control"  value="<?php echo $OFFER->date; ?>"  name="date"  required="TRUE">
                                                <label class="form-label">Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="title" class="form-control"  value="<?php echo $OFFER->short_description; ?>"  name="short_description"  required="TRUE">
                                                <label class="form-label">Short Description</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 hidden">
                                        <label for="description">Description</label>
                                        <div class="form-line">
                                            <textarea id="description" name="description" class="form-control" rows="5"><?php echo $OFFER->description; ?></textarea> 
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" id="oldImageName" value="<?php echo $OFFER->image_name; ?>" name="oldImageName"/>
                                        <input type="hidden" id="id" value="<?php echo $OFFER->id; ?>" name="id"/>
<!--                                            <input type="hidden" id="authToken" value="<?php echo $_SESSION["authToken"]; ?>" name="authToken"/>-->
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="update" value="update">Save Changes</button>
                                    </div>
                                    <div class="row clearfix">  </div>
                                    <hr/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Vertical Layout -->
            </div>
        </section>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script> 
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script>
        <script src="js/add-new-ad.js" type="text/javascript"></script>

        <script src="js/admin-js/product.js" type="text/javascript"></script>
        <script src="tinymce/js/tinymce/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: "#description",
                // ===========================================
                // INCLUDE THE PLUGIN
                // ===========================================

                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                // ===========================================
                // PUT PLUGIN'S BUTTON on the toolbar
                // ===========================================

                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
                // ===========================================
                // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
                // ===========================================

                relative_urls: false

            });


        </script>
    </body>

</html>