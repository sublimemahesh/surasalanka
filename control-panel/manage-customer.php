<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Manage Customer </title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
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
                <!-- Manage Districts -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Manage Customers
                                </h2>
                                <ul class="header-dropdown">
                                    <li>
                                        <a href="create-customer.php">
                                            <i class="material-icons">add</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <div>
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th> 
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <th>District</th>
                                                    <th>City</th>
                                                    <th>Address</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th> 
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <th>District</th>
                                                    <th>City</th>
                                                    <th>Address</th>
                                                    <th>Options</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $CUSTOMER = new Customer(NULL);
                                                foreach ($CUSTOMER->all() as $key => $customer) {
                                                    $key++;
                                                    ?>
                                                    <tr id="div_<?php echo $customer['id']; ?>">
                                                        <td><?php echo $key; ?></td> 
                                                        <td><?php echo $customer['name']; ?></td> 
                                                        <td><?php echo $customer['email']; ?></td> 
                                                        <td><?php echo $customer['phone_number']; ?></td> 
                                                        <td>
                                                            <?php
                                                            $DISTRICT = new District($customer['district']);
                                                            echo $DISTRICT->name
                                                            ?>
                                                        </td> 
                                                        <td>
                                                            <?php
                                                            $CITY = new City($customer['city']);
                                                            echo $CITY->name;
                                                            ?>
                                                        </td> 
                                                        <td><?php echo $customer['address']; ?></td> 
                                                        <td>  
                                                            <a href="edit-customer.php?id=<?php echo $customer['id']; ?>" title="Edit District"> <button class="glyphicon glyphicon-pencil edit-btn"></button></a> |  
                                                             <a href="#"  class="delete-customer" data-id="<?php echo $customer['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn"></button></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>   
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </section>

        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script>
        <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>


        <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>


        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>
        <script src="js/demo.js"></script>
        <script src="delete/js/customer.js" type="text/javascript"></script>
 
    </body>

</html> 