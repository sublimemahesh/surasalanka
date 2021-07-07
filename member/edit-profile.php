<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');

if (!isset($_SESSION)) {
    session_start();
}
$CUSTOMER = new Customer($_SESSION["id"]);
$DISTRICT = new District($CUSTOMER->district);
$CITY = new City($CUSTOMER->city);
?>
<!DOCTYPE HTML>
<html lang="en-US"> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <title>N One Store</title>


        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="robots" content="noodp,index,follow" />
        <meta name='revisit-after' content='1 days' />

        <link rel="icon" href="../images/logo-favicon.png" type="images/logo-favicon.png">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="../css/libs/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/font-linearicons.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/bootstrap-theme.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/jquery.fancybox.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/jquery-ui.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/owl.carousel.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/owl.transitions.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/owl.theme.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/query.mCustomScrollbar.html"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/settings.css"/>
        <link rel="stylesheet" type="text/css" href="../css/theme.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="../css/responsive.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="../css/hover-effect.css" media="all"/> 
        <link href="../control-panel/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="../css/modle-login.css" rel="stylesheet" type="text/css"/>
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>


        <link href="../css/caption-hover-effects/default.css" rel="stylesheet" type="text/css"/>
        <link href="../css/caption-hover-effects/component.css" rel="stylesheet" type="text/css"/> 

        <link href="../control-panel/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrap">
            <?php include './header.php'; ?> 
            <div id="content">
                <div class="container">
                    <div class="row">

                        <div class="col-md-8 col-md-offset-2 col-sm-8 col-xs-12">
                            <div class="panel pane-info">
                                <div class="panel-body">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h3>
                                                    Edit Profile
                                                </h3>
                                                <ul class="header-dropdown">

                                                </ul>
                                            </div>
                                            <div class="body">
                                                <form class="form-horizontal" id="customer-form" method="post" action="" enctype="multipart/form-data"> 

                                                    <div class="row">
                                                        <div class="col-lg-2 col-md-2 form-control-label">
                                                            <label for="name">Name</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                                            <div class="form-group">
                                                                <div class="form-line"> 
                                                                    <input type="text" id="name" class="form-control"  autocomplete="off" name="name" required="true" value="<?php echo $CUSTOMER->name; ?>">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                                            <label for="email">Email</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                                            <div class="form-group">
                                                                <div class="form-line"> 
                                                                    <input type="text" id="email" class="form-control"  autocomplete="off" name="email" required="true" value="<?php echo $CUSTOMER->email; ?>">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="row">
                                                        <div class="col-lg-2 col-md-2 form-control-label">
                                                            <label for="phone_number">Phone No.</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                                            <div class="form-group">
                                                                <div class="form-line"> 
                                                                    <input type="text" id="phone_number" class="form-control"  autocomplete="off" name="phone_number" required="true" value="<?php echo $CUSTOMER->phone_number; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-lg-2 col-md-2 form-control-label">
                                                            <label for="district">District</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                                            <div class="form-group">
                                                                <div class="form-line"> 
                                                                    <select class="form-control" type="text" id="district" autocomplete="off" name="district">
                                                                        <option value=""  class="active light-c"> -- Please  Select Your District -- </option>
                                                                        <?php
                                                                        $DISTRICT = new District(NULL);
                                                                        foreach ($DISTRICT->all() as $key => $district) {
                                                                            if ($CUSTOMER->district == $district['id']) {
                                                                                ?>
                                                                                <option value="<?php echo $district['id']; ?>" selected=""><?php echo $district['name']; ?></option>

                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <option value="<?php echo $district['id']; ?>"  ><?php echo $district['name']; ?></option>

                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-lg-2 col-md-2 form-control-label">
                                                            <label for="city">City</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                                            <div class="form-group">
                                                                <div class="form-line"> 
                                                                    <select class="form-control" autocomplete="off" type="text" id="city-bar" autocomplete="off" name="city" required="TRUE">
                                                                        <option value=""  class="active light-c"> -- Please  Select Your City -- </option>
                                                                        <?php
                                                                        $CITY = new City(NULL);
                                                                        foreach ($CITY->GetCitiesByDistrict($CUSTOMER->district) as $city) {
                                                                            if ($city['id'] == $CUSTOMER->city) {
                                                                                ?>
                                                                                <option value="<?php echo $city['id'] ?>" selected=""><?php echo $city['name']; ?>  </option>
                                                                            <?php } else {
                                                                                ?>
                                                                                <option value="<?php echo $city['id'] ?>" ><?php echo $city['name']; ?>  </option>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-2 col-md-2 form-control-label">
                                                            <label for="address">Address</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 p-bottom">
                                                            <div class="form-group">
                                                                <div class="form-line"> 
                                                                    <input type="text" name="address" class="form-control" id="address" value="<?php echo $CUSTOMER->address; ?>"> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-lg-2 col-md-2 form-control-label"> 
                                                        </div>
                                                        <div class="col-lg-10  col-md-10 col-sm-12 col-xs-12 p-l-0">
                                                            <input type="hidden" name="id" id="customer" value="<?php echo $CUSTOMER->id; ?>">
                                                            <input type="submit" name="update" id="btn-update-customer" class="btn btn-green m-t-15 waves-effect" value="Update"/>
                                                            <a href="profile.php" class="btn btn-green m-t-15 waves-effect">Back</a>
                                                        </div>
                                                    </div>

                                                </form>
                                                <div class="row clearfix">  </div>
                                                <hr/>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>	
            </div>
            <?php include './footer.php'; ?>
        </div>
        <script type="text/javascript" src="../js/libs/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../js/libs/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/libs/jquery.fancybox.js"></script>
        <script type="text/javascript" src="../js/libs/jquery-ui.js"></script>
        <script type="text/javascript" src="../js/libs/owl.carousel.js"></script>
        <script type="text/javascript" src="../js/libs/TimeCircles.js"></script>
        <script type="text/javascript" src="../js/libs/jquery.countdown.js"></script>
        <script type="text/javascript" src="../js/libs/jquery.bxslider.min.js"></script>
        <script type="text/javascript" src="../js/libs/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript" src="../js/libs/jquery.themepunch.revolution.js"></script>
        <script type="text/javascript" src="../js/libs/jquery.themepunch.plugins.min.js"></script>
        <script type="text/javascript" src="../js/theme.js"></script>
        <script src="../control-panel/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/city.js" type="text/javascript"></script>
        <script src="js/customer.js" type="text/javascript"></script>
    </body> 
</html>