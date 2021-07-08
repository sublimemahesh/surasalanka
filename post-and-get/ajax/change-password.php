<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

$CUSTOMER = new Customer(NULL);

$code = $_POST["reset_code"];
$password = $_POST["password"];

 
if ($CUSTOMER->SelectResetCode($code)) {
    
    $CUSTOMER->updatePassword($password, $code);
    
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
} else {
    $result = ["status" => 'error'];
    echo json_encode($result);
    exit();
}
?>
 
