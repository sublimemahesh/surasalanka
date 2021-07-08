<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
// dd($_POST);
session_start();



if ($_POST["action"] === "ADD") {

    if (isset($_SESSION["shopping_cart"])) {

        $is_available = 0;

        foreach ($_SESSION["shopping_cart"] as $key => $values) {

            if ($_SESSION["shopping_cart"] [$key] ['product_id'] == $_POST["product_id"]) {
                $is_available++;
//                if (isset($_POST['quantity'])) {
//                      
//                    $_SESSION["shopping_cart"][$key]
//                            ['product_quantity'] =   $_POST['quantity']; 
//                    } else { 
//                    $_SESSION["shopping_cart"][$key]
//                            ['product_quantity'] = $_SESSION["shopping_cart"][$key] ['product_quantity'] + $_POST["product_quantity"];
//                }
                $result = "error";
                echo json_encode($result);
                header('Content-type: application/json');
                exit();
            }
        }


        if ($is_available == 0) {
            $iteam_array = array(
                'product_id' => $_POST["product_id"],
                'product_name' => $_POST["product_name"],
                'product_price' => $_POST["product_price"],
                'product_quantity' => $_POST["product_quantity"],
            );
            $_SESSION["shopping_cart"][] = $iteam_array;
        }
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

if ($_POST["action"] === 'REMOVE') {
    
    foreach ($_SESSION["shopping_cart"] as $key => $value) {
        
        if ($value["product_id"] == $_POST["product_id"]) {
            unset($_SESSION["shopping_cart"] [$key]);
        }
    }
}

if ($_POST["action"] == 'EMPTY') {
    unset($_SESSION["shopping_cart"]);
}
?> 