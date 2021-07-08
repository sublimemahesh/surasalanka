<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

$CUSTOMER = new Customer(NULL);

$email = $_POST['email'];
if ($CUSTOMER->checkEmail($email)) {
    
    if ($CUSTOMER->GenarateCode($email)) {
        $res = $CUSTOMER->SelectForgetCustomer($email);

        $username = $CUSTOMER->name;
        $email = $CUSTOMER->email;
        $resetcode = $CUSTOMER->restCode;


        date_default_timezone_set('Asia/Colombo');
        $todayis = date("l, F j, Y, g:i a");
        $site_link = "https://" . $_SERVER['HTTP_HOST'];

        //----------------------- DISPLAY STRINGS ---------------------
        $comany_name = "Surasa Lanka (Pvt) Ltd";
        $website_name = "www.surasalanka.com";
        $comConNumber = "+94 773 051 737";
        $comEmail = "info@surasalanka.com";
        $comOwner = "Team Surasa Lanka";
        $reply_email_name = 'SURASA LANKA (PVT) LTD';
        $webmail = "noreply@surasalanka.com";
        
        $subject = 'Dashboard - Password Reset';



        $html = "<table style='border:solid 1px #F0F0F0; font-size: 15px; font-family: sans-serif; padding: 0;'>";

        $html .= "<tr><th colspan='3' style='font-size: 18px; padding: 30px 25px 0 25px; color: #fff; text-align: center; background-color: #4184F3;'><h2>" . $comany_name . "</h2> </th> </tr>";

        $html .= "<tr><td colspan='3' style='font-size: 16px; padding: 20px 25px 10px 25px; color: #333; text-align: left; background-color: #fff;'><h3>" . $subject . "</h3> </td> </tr>";

        $html .= "<tr><td colspan='3' style='font-size: 14px; padding: 5px 25px 10px 25px; color: #666; background-color: #fff; line-height: 25px;'><b>Password Reset Code: </b> " . $resetcode . "</td></tr>";

        $html .= "<tr><td colspan='3' style='font-size: 14px; padding: 0 25px 10px 25px; color: #666; background-color: #fff; '><b>Name: </b> " . $username . "</td></tr>";

        $html .= "<tr><td colspan='3' style='font-size: 14px; background-color: #FAFAFA; padding: 25px; color: #333; font-weight: 300; text-align: justify; '>Thank you</td></tr>";

        $html .= "</table>";

        $HELPER = new Helper();
        $visitorMail = $HELPER->PHPMailer($webmail, $comany_name, $comEmail, $reply_email_name, $email, $username, $subject, $html);

        if ($visitorMail) {
            $result = ["status" => 'success'];
            echo json_encode($result);
            exit();
        } else {
            $result = ["status" => 'error'];
            echo json_encode($result);
            exit();
        }
    }
} else {

    $result = ["status" => 'error'];
    echo json_encode($result);
    exit();
}
