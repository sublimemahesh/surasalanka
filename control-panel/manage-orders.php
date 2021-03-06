<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$status = '';
if (isset($_GET['status'])) {
    $status = $_GET['status'];
}

if ($status == '0') {
    $txt = "Manage Pending Orders";
} else if ($status == '1') {
    $txt = "Manage Confirmed Orders";
} else if ($status == '2') {
    $txt = "Manage Completed Orders";
} else {
    $txt = "Manage Orders";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $txt; ?></title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
    <?php
    include './navigation-and-header.php';
    ?>
    <section class="content">
        <div class="container-fluid">
            <!-- Manage Brand -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $txt; ?>
                            </h2>
                        </div>
                        <div class="body">
                            <div>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order ID</th>
                                            <th>Ordered At</th>
                                            <th>Full Name</th>
                                            <th>Location</th>
                                            <th>Amount (Rs)</th>
                                            <th>Payment Method</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Order ID</th>
                                            <th>Ordered At</th>
                                            <th>Full Name</th>
                                            <th>Location</th>
                                            <th>Amount (Rs)</th>
                                            <th>Payment Method</th>
                                            <th>Option</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <?php
                                        $orders = Order::getOrdersByDeliveryStatus($status);
                                        if (count($orders) > 0) {
                                            foreach ($orders as $key => $order) {
                                                $MEMBER = new Customer($order['member']);
                                                $DISTRICT = new District($order['district']);
                                                $CITY = new City($order['city']);
                                                $key++;
                                        ?>
                                                <tr id="row_<?php echo $order['id']; ?>">
                                                    <td><?php echo $key; ?></td>
                                                    <td><?php echo '#' . $order['id']; ?></td>
                                                    <td><?php echo $order['ordered_at']; ?></td>
                                                    <td><?php echo $MEMBER->name; ?></td>
                                                    <td><?php echo $DISTRICT->name . ' -> ' . $CITY->name; ?></td>
                                                    <td class="text-right"><?php echo number_format($order['amount'], 2); ?></td>

                                                    <td><?php
                                                        if ($order['payment_method'] == "online_payment") {
                                                            echo "Online Payment";
                                                        } elseif ($order['payment_method'] == "cash_on_delivery") {
                                                            echo "Cash on Delivery";
                                                        }
                                                        ?></td>
                                                    <td>
                                                        <a href="view-order.php?id=<?php echo $order['id']; ?>" class=""><i class="glyphicon glyphicon-eye-open view-btn"></i></a>
                                                        <?php
                                                        if ($order['status'] < 2) {
                                                        ?>
                                                            <a href="#" class="cancel-order" data-id="<?php echo $order['id']; ?>"> <i class="glyphicon glyphicon-remove-circle  delete-btn"></i></a>
                                                        <?php
                                                        }
                                                        ?>

                                                        <!--<a href="#"  class="delete-order" data-id="<?php echo $order['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn"></button></a>-->
                                                        <!--                                                           
                                                            <a href="#"  class="change-order-payment-status" title="Change Payment Status" data-id="<?php echo $order['id']; ?>" status="<?php echo $order['payment_status_code']; ?>"> <button class="glyphicon glyphicon-transfer arrange-btn"></button></a> 
                                                            <a href="#"  class="mark-as-refund" title="Refund" data-id="<?php echo $order['id']; ?>"> <button class="glyphicon glyphicon-forward warring-btn"></button></a>  -->


                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Manage brand -->

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
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    <script src="js/demo.js"></script>

    <script src="plugins/sweetalert/sweetalert.min.js"></script>
    <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>
    <script src="js/pages/ui/dialogs.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/order.js" type="text/javascript"></script>
    <script src="delete/js/order.js" type="text/javascript"></script>
    <script src="js/order-payment.js" type="text/javascript"></script>
</body>

</html>