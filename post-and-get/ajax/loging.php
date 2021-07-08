<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
session_start();
$CUSTOMER = new Customer(NULL);

$username = filter_var($_POST['user_email'], FILTER_SANITIZE_STRING);
$password = $_POST['user_password'];

if ($CUSTOMER->login($username, md5($password))) {
    $data = $CUSTOMER->login($username, md5($password));

    if (empty($data->image_name)) {
        $image_name = 'user.png';
    } else {
        $image_name = $data->image_name;
    }
    $redirect = '';
    if (!empty($_SESSION["back_url"])) {
        unset($_SESSION['back_url']);
        $redirect = 'checkout';
    }
    $result = ["status" => 'success', 'image_name' => $image_name, 'name' => $data->name, 'id' => $data->id, 'redirect' => $redirect];
    echo json_encode($result);
    exit();
} else {
    $result = ["status" => 'error'];
    echo json_encode($result);
    exit();
}
?>
 
