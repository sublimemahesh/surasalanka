<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
require_once "Mail.php";

session_start();
if ($_POST['action'] == 'ADDORDER') {

    $ORDER = new Order(NULL);
    date_default_timezone_set('Asia/Colombo');
    $orderedAt = date('Y-m-d H:i:s');

    $ORDER->orderedAt = $orderedAt;
    $ORDER->member = $_POST['member'];
    $ORDER->address = $_POST['address'];
    $ORDER->city = $_POST['city'];
    $ORDER->district = $_POST['district'];
    $ORDER->contactNo1 = $_POST['contactNo'];
    $ORDER->contactNo2 = $_POST['contactNo2'];
    $ORDER->orderNote = $_POST['orderNote'];
    $ORDER->paymentMethod = $_POST['payment_method'];
    $ORDER->amount = $_POST['amount'];
    $ORDER->deliveryCharges = $_POST['delivery_charges'];
    $ORDER->status = 1;
    $ORDER->paymentStatusCode = 0;
    $ORDER->deliveryStatus = 0;
    
    $result = $ORDER->create();
    if ($result) {
        
        $_SESSION['current_order_id'] = $result;
        foreach ($_SESSION["shopping_cart"] as $product) {
            $ORDERPRODUCT = new OrderProduct(NULL);
            $ORDERPRODUCT->order = $result;
            $ORDERPRODUCT->product = $product['product_id'];
            $ORDERPRODUCT->qty = $product['product_quantity'];
            $ORDERPRODUCT->amount = $product['product_quantity'] * $product['product_price'];

            $result1 = $ORDERPRODUCT->create();
        }
        
        $ORD = new Order($result);
        $products = OrderProduct::getProductsByOrder($result);
        
        $res = $ORD->sendOrderMail($products);
        // dd($res);
// dd($res);
        //    $res = $ORD->sendOrderMailToAdmin($products);

        unset($_SESSION["shopping_cart"]);
        $res['status'] = 'success';
        $res['order_id'] = $result;
        echo json_encode($res);
        exit();
    } else {
        $res['status'] = 'error';
        echo json_encode($res);
        exit();
    }
}
if (isset($_POST["action"]) == "ADDTOQTY") {

    if (isset($_SESSION["shopping_cart"])) {

        $is_available = 0;

        foreach ($_SESSION["shopping_cart"] as $key => $values) {

            if ($_SESSION["shopping_cart"][$key]['product_id'] == $_POST["product_id"]) {
                $is_available++;
                if (isset($_POST['quantity'])) {
                    $_SESSION["shopping_cart"][$key]['product_quantity'] = $_POST['quantity'];
                } else {
                    $_SESSION["shopping_cart"][$key]['product_quantity'] = $_SESSION["shopping_cart"][$key]['product_quantity'] + $_POST["product_quantity"];
                }
            }
        }


        // if ($is_available == 0) {
        //     $iteam_array = array(
        //         'product_id' => $_POST["product_id"],
        //         'product_name' => $_POST["product_name"],
        //         'product_price' => $_POST["product_price"],
        //         'product_quantity' => $_POST["product_quantity"],
        //     );
        //     $_SESSION["shopping_cart"][] = $iteam_array;
        // }
    } else {
        $iteam_array = array(
            'product_id' => $_POST["product_id"],
            'product_name' => $_POST["product_name"],
            'product_price' => $_POST["product_price"],
            'product_quantity' => $_POST["product_quantity"]
        );
        $_SESSION["shopping_cart"][] = $iteam_array;
    }
}
