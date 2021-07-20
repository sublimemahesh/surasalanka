<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$ORDER = new Order($id);
$MEMBER = new Customer($ORDER->member);
$ORDER_PRODUCT = OrderProduct::getOrdersById($id);
$DISTRICT = new District($ORDER->district);
$CITY = new City($ORDER->city);
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>View Orders</title>
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


    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>

    <script src="js/order.js" type="text/javascript"></script>
    <!--<script src="../js/libs/html2canvas.min.js" type="text/javascript"></script>-->
    <!--<script src="'https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js'"></script>-->

</head>

<body class="theme-red view-order-page">
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
                                View Order
                            </h2>
                            <ul class="header-dropdown">

                            </ul>
                        </div>
                        <div class="body">





                            <div id="content">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Order ID</th>
                                        <td><?php echo '#' . $ORDER->id; ?></td>
                                    </tr>
                                    <?php
                                    if ($ORDER->status == 0) {
                                    ?>
                                        <tr>
                                            <th>Status</th>
                                            <td>Pending</td>
                                        </tr>
                                    <?php
                                    } elseif ($ORDER->status == 1) {
                                    ?>
                                        <tr>
                                            <th>Status</th>
                                            <td>Confirmed</td>
                                        </tr>
                                    <?php
                                    } elseif ($ORDER->status == 2) {
                                    ?>
                                        <tr>
                                            <th>Status</th>
                                            <td>Completed</td>
                                        </tr>
                                    <?php
                                    } elseif ($ORDER->status == 3) {
                                    ?>
                                        <tr>
                                            <th>Status</th>
                                            <td>Canceled</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <th>Ordered At</th>
                                        <td><?php echo $ORDER->orderedAt; ?></td>
                                    </tr>
                                    <?php
                                    if ($ORDER->status == 1) {
                                    ?>
                                        <tr>
                                            <th>Confirmed At</th>
                                            <td><?php echo $ORDER->deliveredAt; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    if ($ORDER->status == 2) {
                                    ?>
                                        <tr>
                                            <th>Confirmed At</th>
                                            <td><?php echo $ORDER->deliveredAt; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Completed At</th>
                                            <td><?php echo $ORDER->completedAt; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    if ($ORDER->status == 3) {
                                    ?>
                                        <tr>
                                            <th>Canceled At</th>
                                            <td><?php echo $ORDER->canceledAt; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <th>Full Name</th>
                                        <td><?php echo $MEMBER->name; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $MEMBER->email; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone Number</th>
                                        <td><?php echo $ORDER->contactNo1; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Additional Phone Number</th>
                                        <td><?php echo $ORDER->contactNo2; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td><?php echo $ORDER->address; ?></td>
                                    </tr>
                                    <tr>
                                        <th>District</th>
                                        <td><?php echo $DISTRICT->name; ?></td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td><?php echo $CITY->name; ?></td>
                                    </tr>

                                    <tr>
                                        <th>Delivery Charges</th>
                                        <td>Rs. <?php echo number_format($ORDER->deliveryCharges, 2); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total Amount</th>
                                        <td>Rs. <?php echo number_format($ORDER->amount, 2); ?></td>
                                    </tr>

                                    <tr>
                                        <th>Payment Method</th>
                                        <td><?php
                                            if ($ORDER->paymentMethod == "online_payment") {
                                                echo "Online Payment";
                                            } elseif ($ORDER->paymentMethod == "cash_on_delivery") {
                                                echo "Cash on Delivery";
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <th>Additional Note</th>
                                        <td><?php
                                            if (empty($ORDER->orderNote)) {
                                                echo " - ";
                                            } else {
                                                echo $ORDER->orderNote;
                                            }
                                            ?></td>
                                    </tr>

                                    <div class="body">
                                        <div>
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Amount (Rs)</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>

                                                    <?php
                                                    $tot = 0;
                                                    foreach ($ORDER_PRODUCT as $key => $orders) {
                                                        $key++;

                                                        $ORDER = new Order($orders['order']);
                                                        $PRODUCT = new Product($orders['product']);
                                                        // if ($PRODUCT->parent  != 0) {
                                                        //     $PARANT = new Product($PRODUCT->parent);
                                                        //     $name = $PARANT->name . ' - ' . $PRODUCT->name;
                                                        // } else {
                                                            $name =  $PRODUCT->name;
                                                        // }

                                                        $tot += $orders['amount'];
                                                    ?>
                                                        <tr id="row_<?php echo $order['id']; ?>">
                                                            <td><?php echo $key; ?></td>
                                                            <td><?php echo $name; ?></td>

                                                            <td><?php echo $orders['qty']; ?></td>
                                                            <td class="text-right"><?php echo number_format($orders['amount'], 2); ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3" class="text-right">Sub Total</th>
                                                        <th class="text-right"><?php echo number_format($tot, 2); ?></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                </table>
                            </div>

                            <div class="btn-back">
                                <?php
                                if ($ORDER->status == 3) {
                                ?>
                                    <a href="manage-canceled-orders.php" class="op-link btn btn-sm btn-info">Back</a>
                                <?php
                                } else if ($ORDER->status < 3) {
                                ?>
                                    <a href="manage-orders.php?status=<?php echo $ORDER->status; ?>" class="op-link btn btn-sm btn-info">Back</a>
                                    <a href="view-order-print.php?id=<?php echo $ORDER->id; ?>" target="_blank" class="download-pdf btn btn-sm btn-warning" data-id="<?php echo $ORDER->id; ?>">Print</a>

                                <?php
                                }
                                ?>

                                <?php
                                if ($ORDER->status == 0) {
                                ?>
                                    <a href="#" class="mark-as-delivered btn btn-sm btn-danger" data-id="<?php echo $ORDER->id; ?>">Confirm Order</a>
                                <?php
                                } else if ($ORDER->status == 1) {
                                ?>
                                    <a href="#" class="mark-as-completed btn btn-sm btn-danger" data-id="<?php echo $ORDER->id; ?>">Complete Order</a>
                                <?php
                                }
                                ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Manage brand -->

        </div>
    </section>
    <div id="elementH"></div>

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

</body>

</html>