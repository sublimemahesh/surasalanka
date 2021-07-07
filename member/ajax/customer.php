<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


$CUSTOMER = new Customer($_POST['id']);

//    $dir_dest = '../../upload/product-categories/product/brands/logo/';
//
//    $handle = new Upload($_FILES['logo']);
//    if ($handle->uploaded) {
//        if (empty($_POST["oldImageLogo"])) {
//            $handle->image_resize = true;
//            $handle->file_new_name_ext = 'jpg';
//            $handle->image_ratio_crop = 'C';
//            $handle->file_new_name_body = Helper::randamId();
//        } else {
//            $handle->image_resize = true;
//            $handle->file_new_name_body = TRUE;
//            $handle->file_overwrite = TRUE;
//            $handle->file_new_name_ext = FALSE;
//            $handle->image_ratio_crop = 'C';
//            $handle->file_new_name_body = $_POST["oldImageLogo"];
//        }
//
//        $handle->image_x = 250;
//        $handle->image_y = 250;
//
//        $handle->Process($dir_dest);
//
//        $CUSTOMER->logo = $handle->file_dst_name;
//    }

$CUSTOMER->name = $_POST['name'];
$CUSTOMER->email = $_POST['email'];
$CUSTOMER->phone_number = $_POST['phone_number'];
$CUSTOMER->district = $_POST['district'];
$CUSTOMER->city = $_POST['city'];
$CUSTOMER->address = $_POST['address'];


$VALID = new Validator();
$VALID->check($CUSTOMER, [
    'name' => ['required' => TRUE],
    'email' => ['required' => TRUE],
    'phone_number' => ['required' => TRUE],
    'district' => ['required' => TRUE],
    'city' => ['required' => TRUE],
    'address' => ['required' => TRUE],
]);
$checkEmail = $CUSTOMER->checkEmail($_POST['email']);
if (!$checkEmail || $checkEmail['id'] == $_POST['id']) {
    if ($VALID->passed()) {
        $CUSTOMER->update();

        $result = ["status" => 'success'];
        echo json_encode($result);
        exit();
    } else {

        $result = ["status" => 'error'];
        echo json_encode($result);
        exit();
    }
} else {
    $result = ["status" => 'error1'];
    echo json_encode($result);
    exit();
}
