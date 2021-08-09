<?php
include_once(dirname(__FILE__) . '/../class/include.php');
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

$merchant_id = $_POST['merchant_id'];
$order_id = $_POST['order_id'];
$payhere_amount = $_POST['payhere_amount'];
$payhere_currency = $_POST['payhere_currency'];
$status_code = $_POST['status_code'];
$md5sig = $_POST['md5sig'];

// Live Merchant Secret (Can be found on your PayHere account's Settings page)
$merchant_secret = '7250c6751a7f61f2e75d6e3b0e6ec339';
// Sandbox Merchant Secret
// $merchant_secret = '4UsTpifwp8d8LTZFMFItEL4eY94UXCSlX4ks3RAIH82l';


$local_md5sig = strtoupper(md5($merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret))));


if (($local_md5sig === $md5sig) and ($status_code == 2)) {
    $ORDER = new Order($order_id);
    $ORDER->paymentStatusCode = $status_code;
    $ORDER->status = 1;
    $ORDER->statusCode = serialize($_POST);
    $result = $ORDER->updatePaymentStatusCodeAndStatus();

    if ($result) {
        $ORD = new Order($order_id);
        $products = OrderProduct::getProductsByOrder($order_id);
        $res = $ORD->sendOrderMail($products);
        // $res1 = $ORD->sendOrderMailToAdmin($products);
    }
    unset($_SESSION["shopping_cart"]);
} else {

    $ORD = new Order($order_id);
    $res = $ORD->sendPaymentFailureMail($ORD);
}
