<?php

/**
 * Description of Order
 *
 * @author U s E r ¨
 */
class Order
{

    public $id;
    public $orderedAt;
    public $member;
    public $address;
    public $city;
    public $contactNo1;
    public $contactNo2;
    public $district;
    public $deliveryCharges;
    public $amount;
    public $orderNote;
    public $paymentMethod;
    public $status;
    public $paymentStatusCode;
    public $statusCode;
    public $deliveryStatus;
    public $deliveredAt;
    public $completedAt;
    public $canceledAt;

    public function __construct($id)
    {
        if ($id) {

            $query = "SELECT *  FROM `orders` WHERE `id`='" . $id . "'";

            $db = new Database();

            $result = mysql_fetch_assoc($db->readQuery($query));

            $this->id = $result['id'];
            $this->orderedAt = $result['ordered_at'];
            $this->member = $result['member'];
            $this->address = $result['address'];
            $this->city = $result['city'];
            $this->contactNo1 = $result['contact_no_1'];
            $this->contactNo2 = $result['contact_no_2'];
            $this->district = $result['district'];
            $this->deliveryCharges = $result['delivery_charges'];
            $this->amount = $result['amount'];
            $this->orderNote = $result['order_note'];
            $this->paymentMethod = $result['payment_method'];
            $this->status = $result['status'];
            $this->paymentStatusCode = $result['payment_status_code'];
            $this->statusCode = $result['status_code'];
            $this->deliveryStatus = $result['delivery_status'];
            $this->deliveredAt = $result['delivered_at'];
            $this->completedAt = $result['completed_at'];
            $this->canceledAt = $result['canceled_at'];

            return $result;
        }
    }

    public function create()
    {
        $db = new Database();
        $query = "INSERT INTO `orders` ("
            . "`ordered_at`,"
            . "`member`,"
            . "`address`,"
            . "`city`,"
            . "`contact_no_1`,"
            . "`contact_no_2`,"
            . "`district`,"
            . "`delivery_charges`,"
            . "`amount`,"
            . "`order_note`,"
            . "`payment_method`,"
            . "`status`,"
            . "`payment_status_code`,"
            . "`delivery_status`,"
            . "`delivered_at`,"
            . "`completed_at`,"
            . "`canceled_at`) VALUES  ("
            . "'" . $this->orderedAt . "', "
            . "'" . $this->member . "', "
            . "'" . mysql_real_escape_string($this->address) . "', "
            . "'" . $this->city . "', "
            . "'" . $this->contactNo1 . "', "
            . "'" . $this->contactNo2 . "', "
            . "'" . $this->district . "', "
            . "'" . $this->deliveryCharges . "', "
            . "'" . $this->amount . "', "
            . "'" . mysql_real_escape_string($this->orderNote) . "', "
            . "'" . mysql_real_escape_string($this->paymentMethod) . "', "
            . "'" . 0 . "', "
            . "'" . $this->paymentStatusCode . "', "
            . "'" . $this->deliveryStatus . "', "
            . "'" . $this->deliveredAt . "', "
            . "'" . $this->completedAt . "', "
            . "'" . $this->canceledAt . "')";



        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $last_id;
        } else {
            return FALSE;
        }
    }

    public function all()
    {

        $query = "SELECT * FROM `orders` ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getOrdersByDateRange($from, $to, $status)
    {

        $query = "SELECT * FROM `orders` WHERE `delivery_status`='" . $status . "' AND `status`='1' AND (`ordered_at` BETWEEN '" . $from . "' AND '" . $to . "' OR `ordered_at` LIKE '%" . $to . "%')";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getOrdersByCustomer($customer)
    {

        $query = "SELECT * FROM `orders` WHERE `member`='" . $customer . "' ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getUnpaidOrdersByDateRange($from, $to)
    {

        $query = "SELECT * FROM `orders` WHERE `status`='0' AND (`ordered_at` BETWEEN '" . $from . "' AND '" . $to . "' OR `ordered_at` LIKE '%" . $to . "%') ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getPaidOrders()
    {

        $query = "SELECT * FROM `orders` WHERE `status`='1' ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function updateResponse($id, $status)
    {

        $query = "UPDATE `orders` SET "
            . "`status` ='" . $status . "' "
            . " WHERE `id` = '" . $id . "'";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete()
    {

        $this->deleteOrderProducts();

        $query = 'DELETE FROM `orders` WHERE id="' . $this->id . '"';


        $db = new Database();
        return $db->readQuery($query);
    }

    public function deleteOrderProducts()
    {

        $ORDER_PRODUCT = new OrderProduct(NULL);

        $allOrderProducts = $ORDER_PRODUCT->getOrdersById($this->id);

        foreach ($allOrderProducts as $order_products) {

            $ORDER_PRODUCT_OBJ = new OrderProduct($order_products["id"]);

            $ORDER_PRODUCT_OBJ->delete();
        }
    }

    public function getLastID()
    {

        $query = "SELECT `id` FROM `orders` ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysql_fetch_assoc($db->readQuery($query));

        return $result['id'];
    }

    function updatePaymentStatusCodeAndStatus()
    {

        $query = "UPDATE  `orders` SET "
            . "`payment_status_code` ='" . $this->paymentStatusCode . "', "
            . "`status_code` ='" . $this->statusCode . "', "
            . "`status` ='" . $this->status . "' "
            . " WHERE `id` = '" . $this->id . "'  ";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function updatePaymentStatusCode()
    {

        $query = "UPDATE  `orders` SET "
            . "`payment_status_code` ='" . $this->paymentStatusCode . "' "
            . " WHERE `id` = '" . $this->id . "'  ";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function markAsDelivered()
    {
        date_default_timezone_set('Asia/Colombo');
        $deliveredAt = date('Y-m-d H:i:s');
        $query = "UPDATE  `orders` SET "
            . "`status` ='1', "
            . "`delivered_at` ='" . $deliveredAt . "' "
            . " WHERE `id` = '" . $this->id . "'  ";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function markAsCompleted()
    {
        date_default_timezone_set('Asia/Colombo');
        $completedAt = date('Y-m-d H:i:s');
        $query = "UPDATE  `orders` SET "
            . "`status` ='2', "
            . "`completed_at` ='" . $completedAt . "' "
            . " WHERE `id` = '" . $this->id . "'  ";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function cancelOrder()
    {
        date_default_timezone_set('Asia/Colombo');
        $canceledAt = date('Y-m-d H:i:s');
        $query = "UPDATE  `orders` SET "
            . "`status` ='3', "
            . "`canceled_at` ='" . $canceledAt . "' "
            . " WHERE `id` = '" . $this->id . "'  ";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteOrder()
    {

        $query = 'DELETE FROM `orders` WHERE id="' . $this->id . '"';

        $db = new Database();
        return $db->readQuery($query);
    }

    public function getPaymentStatusCode($order)
    {

        $query = "SELECT `payment_status_code` FROM `orders` WHERE `id` = $order";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result["payment_status_code"];
    }

    public function getOrdersByDeliveryStatusDescending($status)
    {

        $query = "SELECT * FROM `orders` WHERE `delivery_status`='" . $status . "' AND `payment_status_code` != 4 AND `status`='1' ORDER BY `id` DESC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getOrdersByDeliveryStatus($status)
    {

        $query = "SELECT * FROM `orders` WHERE `status`='" . $status . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getCanceledOrders()
    {

        $query = "SELECT * FROM `orders` WHERE `status`='3'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    public function getRefundOrders()
    {

        $query = "SELECT * FROM `orders` WHERE `payment_status_code`='4'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    function sendOrderMail($products)
    {
        $CUSTOMER = new Customer($this->member);
        $DISTRICT = new District($this->district);
        $CITY = new City($this->city);

        date_default_timezone_set('Asia/Colombo');
        $todayis = date("l, F j, Y, g:i a");
        $site_link = "http://" . $_SERVER['HTTP_HOST'];

        //----------------------- DISPLAY STRINGS ---------------------
        $comany_name = "Surasa Lanka (Pvt) Ltd";
        $website_name = "www.surasalanka.com";
        $comConNumber = "+94 773 051 737";
        $comEmail = "info@surasalanka.com";
        $comOwner = "Team Surasa Lanka";
        $customer_msg = 'Hello, and thank you for your interest in ' . $comany_name . '. We have received your enquiry, and we will get back to you as soon as possible.';


        $visitor_name = $CUSTOMER->name;
        $visitor_email = $CUSTOMER->email;
        //    $visitor_phone = $CUSTOMER->phone_number;
        //    $message = $_POST['message'];


        //---------------------- SERVER WEBMAIL LOGIN ------------------------

        $host = "sg1-ls7.a2hosting.com";
        $username = "noreply@surasalanka.com";
        $password = 'Umu93;x3njmd';

        //------------------------ MAIL ESSENTIALS --------------------------------

        $webmail = "noreply@surasalanka.com";
        $visitorSubject = "Thank You " . $visitor_name . " - " . $comany_name;
        $companySubject = "Order Enquiry - #" . $this->id;

        $delivery_charge = DefaultData::getDeliveryCharges();

        $tr = '';
        $tot = 0;
        $id = 0;
        foreach ($products as $key => $product) {

            $PRODUCT = new Product($product['product']);

            // if ($PRODUCT->parent  != 0) {
            //     $PARANT = new Product($PRODUCT->parent);
            //     $name = $PARANT->name . ' - ' . $product["product_name"];
            // } else {
            $name =  $PRODUCT->name;
            // }

            $tot += $product['amount'];
            $id++;
            $tr .= '<tr>';
            $tr .= '<td>' . $id . '</td>';
            $tr .= '<td>' . $name . '</td>';
            $tr .= '<td>' . $product['qty'] . '</td>';
            $tr .= '<td style="text-align: right;">Rs. ' . number_format($product['amount'], 2) . '</td>';
            $tr .= '</tr>';
        }

        $grand_total = $tot + $delivery_charge;
        $status = "Pending";
        $visitor_message = '<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Synotec Email</title>
        </head>
        <body>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
                <tbody>
                    <tr> 
                        <td style="padding-top:10px;padding-bottom:30px;padding-left:16px;padding-right:16px" align="center"> 
                            <table style="width:602px" width="602" cellspacing="0" cellpadding="0" border="0" align="center"> 
                                <tbody>
                                    <tr> 
                                        <td bgcolor=""> 
                                            <table width="642" cellspacing="0" cellpadding="0" border="0"> 
                                                <tbody> 
                                                    <tr> 
                                                        <td style="border:1px solid #dcdee3;padding:20px;background-color:#fff;width:600px" width="600px" bgcolor="#ffffff" align="center"> 
                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                                <tbody>
                                                                    <tr><td>
                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td width="100%">
                                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 25px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td valign="middle" height="46" align="right">
                                                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td width="100%" align="center">
                                                                                                                            <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:18px">
                                                                                                                                <a href="' . $site_link . '" style="color:#68696a;text-decoration:none;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.gallecabsandtours.com&amp;source=gmail&amp;ust=1574393192616000&amp;usg=AFQjCNGNM8_Z7ZMe7ndwFlJuHEP29nDd3Q">
                                                                                                                                    <h4>' . $website_name . '</h4>
                                                                                                                                </a>
                                                                                                                            </font>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody> 
                                                            </table> 
                                                            <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                                <tbody> 
                                                                    <tr> 
                                                                        <td style="font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:15px 20px 10px;font-weight: 600;" align="left"> Hi , ' . $CUSTOMER->name . ' </td> 
                                                                    </tr> 
                                                                </tbody> 
                                                            </table> 
                                                            <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                                <tbody> 
                                                                    <tr> 
                                                                        <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                            <p>Thank you for purchasing with us and find the attached details of the purchase below. Do not be hesitate to contact us via hotline for any enquiries.</p></td> 
                                                                    </tr> 
                                                                </tbody> 
                                                            </table> 
                                                        </td> 
                                                    </tr> 
                                                    <tr> 
                                                        <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                    </tr> 
                                                    <tr> 
                                                        <td style="padding:20px;border:1px solid #dcdee3;width:600px;background-color:#fff"> 
                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                                <tbody> 
                                                                    <tr> 
                                                                        <td style="font-size:15px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:0 0 8px;font-weight: 700;" align="left"> The Details :</td>
                                                                    </tr> 
                                                                </tbody> 
                                                            </table> 
                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                                <tbody> 
                                                                    <tr> 
                                                                        <ul>
                                                                            <li>
                                                                                <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                                    Full Name : ' . $CUSTOMER->name . '
                                                                                </font>
                                                                            </li>
                                                                            <li>
                                                                                <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                                    Email : ' . $CUSTOMER->email . '
                                                                                </font>
                                                                            </li>
                                                                            <li>
                                                                                <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                                    Contact No : ' . $this->contactNo1 . '
                                                                                </font>
                                                                            </li>
                                                                            <li>
                                                                                <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                                   Additional Contact No : ' . $this->contactNo2 . '
                                                                                </font>
                                                                            </li>
                                                                            <li>
                                                                                <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                    Address : ' . $this->address . '
                                                                                </font>
                                                                            </li>
                                                                            <li>
                                                                                <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                    City : ' . $CITY->name . '
                                                                                </font>
                                                                            </li>
                                                                            <li>
                                                                                <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                    District : ' . $DISTRICT->name . '
                                                                                </font>
                                                                            </li>
                                                                            <li>
                                                                                <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                    Ordered At : ' . $this->orderedAt . '
                                                                                </font>
                                                                            </li>
                                                                            <li>
                                                                                <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                    Status : Pending
                                                                                </font>
                                                                            </li>
                                                                                
                                                                                <table width="100%" border="1" style="margin-top: 10px" cellspacing="0" cellpadding="0">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>ID</th>
                                                                                            <th>Product</th>
                                                                                            <th>Qty</th>
                                                                                            <th>Amount</th>
                                                                                        </tr>
    
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        ' . $tr . '
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                        <tr>
                                                                                            <th colspan="3" style="text-align: left;">Total</th>
                                                                                            <th style="text-align: right;">Rs. ' . number_format($tot, 2) . '</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th colspan="3" style="text-align: left;">Delivery Charges</th>
                                                                                            <th style="text-align: right;">Rs. ' . number_format($delivery_charge, 2) . '</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th colspan="3" style="text-align: left;">Grand Total</th>
                                                                                            <th style="text-align: right;">Rs. ' . number_format($grand_total, 2) . '</th>
                                                                                        </tr>
                                                                                    </tfoot>
                                                                                </table>
                                                                        </ul>
                                                                    </tr> 
                                                                </tbody> 
                                                            </table> 
                                                            <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                                <tbody> 
                                                                    <tr> 
                                                                        <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:10px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px 10px" align="left"> <p> Cheers, </p>
                                                                            <p> ' . $comOwner . ' </p>
                                                                        </td> 
                                                                    </tr>
                                                                    <tr> 
                                                                        <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                            <p>* Special Note - Do not delete this e-mail, instead keep it as the invoice to submit the delivery person.</p></td> 
                                                                    </tr> 
                                                                        
                                                                </tbody> 
                                                            </table> 
                                                            <table style="background-color:#fff" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#fff"> 
                                                                
                                                                <tbody>
                                                                    <tr> 
                                                                        <td style="padding:10px 20px 7px;color:#9a9a9a;text-align:left;font-family:Arial,Helvetica,sans-serif;font-size:12px" align="left"> <p style="line-height:18px;margin:0;padding:0"> 
                                                                            </p><p style="line-height:24px;margin:0;padding:0">' . $comany_name . '</p>
                                                                            <p style="line-height:24px;margin:0;padding:0">Email : ' . $comEmail . ' </p> 
                                                                            <p style="line-height:24px;margin:0;padding:0">Tel: ' . $comConNumber . '</p> </td> 
                                                                    </tr> 
                                                                </tbody>
                                                            </table> 
                                                        </td> 
                                                    </tr> 
                                                </tbody> 
                                            </table>
                                        </td> 
                                    </tr> 
                                    <tr> 
                                        <td id="m_-1040695829873221998footer_content"> 
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
                                                <tbody>
                                                    <tr> 
                                                        <td> 
                                                            <table style="padding:0" width="100%" cellspacing="0" cellpadding="0" border="0" align="center"> 
                                                                <tbody> 
                                                                    <tr> 
                                                                        <td style="padding:0px 0 7px;color:#9a9a9a;text-align:left;font-family:Arial,Helvetica,sans-serif;font-size:12px" align="left"> <p style="line-height:18px;margin:0;padding:0">Website By : <a href="https://synotec.lk/">Synotec Holdings</a></p> </td> 
                                                                    </tr> 
                                                                    <tr></tr> 
                                                                </tbody> 
                                                            </table>
                                                        </td> 
                                                    </tr> 
                                                </tbody>
                                            </table> 
                                        </td> 
                                    </tr> 
                                </tbody>
                            </table>
                        </td> 
                    </tr> 
                </tbody>
            </table>
        </body>
    </html>';

        $company_message = '<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Synotec Email</title>
    </head>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
            <tbody>
                <tr> 
                    <td style="padding-top:10px;padding-bottom:30px;padding-left:16px;padding-right:16px" align="center"> 
                        <table style="width:602px" width="602" cellspacing="0" cellpadding="0" border="0" align="center"> 
                            <tbody>
                                <tr> 
                                    <td bgcolor=""> 
                                        <table width="642" cellspacing="0" cellpadding="0" border="0"> 
                                            <tbody> 
                                                <tr> 
                                                    <td style="border:1px solid #dcdee3;padding:20px;background-color:#fff;width:600px" width="600px" bgcolor="#ffffff" align="center"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody>
                                                                <tr><td>
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="100%">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 25px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td valign="middle" height="46" align="right">
                                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="100%" align="center">
                                                                                                                        <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:18px">
                                                                                                                            <a href="' . $site_link . '" style="color:#68696a;text-decoration:none;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.gallecabsandtours.com&amp;source=gmail&amp;ust=1574393192616000&amp;usg=AFQjCNGNM8_Z7ZMe7ndwFlJuHEP29nDd3Q">
                                                                                                                                <h4>' . $website_name . '</h4>
                                                                                                                            </a>
                                                                                                                        </font>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:15px 20px 10px;font-weight: 600;" align="left"> Hi , ' . $comany_name . ' </td> 
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                        <p> You have a new order enquiry from your website on ' . $todayis . ' as follows. Please pay your attention as soon as possible.</p></td> 
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:20px;border:1px solid #dcdee3;width:600px;background-color:#fff"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="font-size:15px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:0 0 8px;font-weight: 700;" align="left"> The Details :</td>
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <ul>
                                                                        <li>
                                                                            <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                                Full Name : ' . $CUSTOMER->name . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                                Email : ' . $CUSTOMER->email . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                                Contact No : ' . $this->contactNo1 . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                               Additional Contact No : ' . $this->contactNo2 . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                Address : ' . $this->address . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                City : ' . $CITY->name . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                District : ' . $DISTRICT->name . '
                                                                            </font>
                                                                        </li>
                                                                            
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                Ordered At : ' . $this->orderedAt . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                Status : ' . $status . '
                                                                            </font>
                                                                        </li>
                                                                        <table width="100%" border="1" style="margin-top: 10px" cellspacing="0" cellpadding="0">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ID</th>
                                                                                        <th>Product</th>
                                                                                        <th>Qty</th>
                                                                                        <th>Amount</th>
                                                                                    </tr>

                                                                                </thead>
                                                                                <tbody>
                                                                                    ' . $tr . '
                                                                                </tbody>
                                                                                <tfoot style="border: 1px solid #000">
                                                                                    <tr>
                                                                                        <th colspan="3" style="text-align: left;">Total</th>
                                                                                        <th style="text-align: right;">Rs. ' . number_format($tot, 2) . '</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="3" style="text-align: left;">Delivery Charges</th>
                                                                                        <th style="text-align: right;">Rs. ' . number_format($delivery_charge, 2) . '</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="3" style="text-align: left;">Grand Total</th>
                                                                                        <th style="text-align: right;">Rs. ' . number_format($grand_total, 2) . '</th>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                    </ul>
                                                                </tr> 
                                                            </tbody> 
                                                        </table>
                                                    </td> 
                                                </tr> 
                                            </tbody> 
                                        </table>
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td id="m_-1040695829873221998footer_content"> 
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
                                            <tbody>
                                                <tr> 
                                                    <td> 
                                                        <table style="padding:0" width="100%" cellspacing="0" cellpadding="0" border="0" align="center"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="padding:0px 0 7px;color:#9a9a9a;text-align:left;font-family:Arial,Helvetica,sans-serif;font-size:12px" align="left"> <p style="line-height:18px;margin:0;padding:0">Website By : <a href="https://synotec.lk/">Synotec Holdings</a></p> </td> 
                                                                </tr> 
                                                                <tr></tr> 
                                                            </tbody> 
                                                        </table>
                                                    </td> 
                                                </tr> 
                                            </tbody>
                                        </table> 
                                    </td> 
                                </tr> 
                            </tbody>
                        </table>
                    </td> 
                </tr> 
            </tbody>
        </table>
    </body>
</html>';

        $HELPER = new Helper();
        $visitorMail = $HELPER->PHPMailer($webmail, $comany_name, $comEmail, $comany_name, $visitor_email, $visitor_name, $visitorSubject, $visitor_message);
        $companyMail = $HELPER->PHPMailer($webmail, $visitor_name, $visitor_email, $visitor_name, $comEmail, $comany_name, $companySubject, $company_message);

        if ($visitorMail && $companyMail) {
            $arr['status'] = "Your message has been sent successfully";
        } else {
            $arr['status'] = "Could not be sent your message";
        }

        return $arr;

        // $visitorHeaders = array(
        //     'MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
        //     'To' => $visitor_email,
        //     'Reply-To' => $comEmail,
        //     'Subject' => $visitorSubject
        // );

        // $companyHeaders = array(
        //     'MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
        //     'To' => $webmail,
        //     'Reply-To' => $visitor_email,
        //     'Subject' => $companySubject
        // );


        // $smtp = Mail::factory('smtp', array(
        //     'host' => $host,
        //     'auth' => true,
        //     'username' => $username,
        //     'password' => $password
        // ));

        // $visitorMail = $smtp->send($visitor_email, $visitorHeaders, $visitor_message);
        // $companyMail = $smtp->send($webmail, $companyHeaders, $company_message);

        // if (PEAR::isError($visitorMail && $companyMail)) {
        //     $arr['status'] = "Could not be sent your message";
        // } else {
        //     $arr['status'] = "Your message has been sent successfully";
        // }
        // return $arr;
    }

    function sendOrderMailToAdmin($products)
    {

        $CUSTOMER = new Customer($this->member);
        $DISTRICT = new District($this->district);
        $CITY = new City($this->city);

        date_default_timezone_set('Asia/Colombo');
        $todayis = date("l, F j, Y, g:i a");
        $site_link = "https://" . $_SERVER['HTTP_HOST'];

        $comany_name = "Surasa Lanka (Pvt) Ltd";
        $website_name = "www.surasalanka.com";
        $comConNumber = "+94 773 051 737";
        $comEmail = "info@surasalanka.com";
        $comOwner = "Team Surasa Lanka";
        $reply_email_name = 'SURASA LANKA (PVT) LTD';

        $visitor_email = $CUSTOMER->email;
        $visitor_name = $CUSTOMER->name;
        $webmail = "noreply@surasalanka.com";
        $visitorSubject = "Order Enquiry - #" . $this->id;

        $tr = '';
        $tot = 0;
        $id = 0;
        foreach ($products as $key => $product) {
            $PRODUCT = new Product($product['product']);
            $tot += $product['amount'];
            $id++;
            $tr .= '<tr>';
            $tr .= '<td>' . $id . '</td>';
            $tr .= '<td>' . $PRODUCT->name . '</td>';
            $tr .= '<td>' . $product['qty'] . ' ' . $PRODUCT->unit . '</td>';
            $tr .= '<td style="text-align: right;">Rs. ' . number_format($product['amount'], 2) . '</td>';
            $tr .= '</tr>';
        }
        // $processing_fee = ($tot + 150) * 3 / 100;
        $grand_total = $tot + 0;
        $status = "Pending";


        $html = '<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Synotec Email</title>
    </head>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
            <tbody>
                <tr> 
                    <td style="padding-top:10px;padding-bottom:30px;padding-left:16px;padding-right:16px" align="center"> 
                        <table style="width:602px" width="602" cellspacing="0" cellpadding="0" border="0" align="center"> 
                            <tbody>
                                <tr> 
                                    <td bgcolor=""> 
                                        <table width="642" cellspacing="0" cellpadding="0" border="0"> 
                                            <tbody> 
                                                <tr> 
                                                    <td style="border:1px solid #dcdee3;padding:20px;background-color:#fff;width:600px" width="600px" bgcolor="#ffffff" align="center"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody>
                                                                <tr><td>
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="100%">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 25px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td valign="middle" height="46" align="right">
                                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="100%" align="center">
                                                                                                                        <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:18px">
                                                                                                                            <a href="' . $site_link . '" style="color:#68696a;text-decoration:none;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.gallecabsandtours.com&amp;source=gmail&amp;ust=1574393192616000&amp;usg=AFQjCNGNM8_Z7ZMe7ndwFlJuHEP29nDd3Q">
                                                                                                                                <h4>' . $website_name . '</h4>
                                                                                                                            </a>
                                                                                                                        </font>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:15px 20px 10px;font-weight: 600;" align="left"> Hi , ' . $comany_name . ' </td> 
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                        <p> You have a new order enquiry from your website on ' . $todayis . ' as follows. Please pay your attention as soon as possible.</p></td> 
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:20px;border:1px solid #dcdee3;width:600px;background-color:#fff"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="font-size:15px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:0 0 8px;font-weight: 700;" align="left"> The Details :</td>
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <ul>
                                                                        <li>
                                                                            <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                                Full Name : ' . $CUSTOMER->name . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                                Email : ' . $CUSTOMER->email . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                                Contact No : ' . $this->contactNo1 . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                               Additional Contact No : ' . $this->contactNo2 . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                Address : ' . $this->address . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                City : ' . $CITY->name . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                District : ' . $DISTRICT->name . '
                                                                            </font>
                                                                        </li>
                                                                            
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                Ordered At : ' . $this->orderedAt . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                Status : ' . $status . '
                                                                            </font>
                                                                        </li>
                                                                        <table width="100%" border="1" style="margin-top: 10px" cellspacing="0" cellpadding="0">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ID</th>
                                                                                        <th>Product</th>
                                                                                        <th>Qty</th>
                                                                                        <th>Amount</th>
                                                                                    </tr>

                                                                                </thead>
                                                                                <tbody>
                                                                                    ' . $tr . '
                                                                                </tbody>
                                                                                <tfoot style="border: 1px solid #000">
                                                                                    <tr>
                                                                                        <th colspan="3" style="text-align: left;">Total</th>
                                                                                        <th style="text-align: right;">Rs. ' . number_format($tot, 2) . '</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="3" style="text-align: left;">Delivery Charges</th>
                                                                                        <th style="text-align: right;">Rs. 0.00</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="3" style="text-align: left;">Grand Total</th>
                                                                                        <th style="text-align: right;">Rs. ' . number_format($grand_total, 2) . '</th>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                    </ul>
                                                                </tr> 
                                                            </tbody> 
                                                        </table>
                                                    </td> 
                                                </tr> 
                                            </tbody> 
                                        </table>
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td id="m_-1040695829873221998footer_content"> 
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
                                            <tbody>
                                                <tr> 
                                                    <td> 
                                                        <table style="padding:0" width="100%" cellspacing="0" cellpadding="0" border="0" align="center"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="padding:0px 0 7px;color:#9a9a9a;text-align:left;font-family:Arial,Helvetica,sans-serif;font-size:12px" align="left"> <p style="line-height:18px;margin:0;padding:0">Website By : <a href="https://synotec.lk/">Synotec Holdings</a></p> </td> 
                                                                </tr> 
                                                                <tr></tr> 
                                                            </tbody> 
                                                        </table>
                                                    </td> 
                                                </tr> 
                                            </tbody>
                                        </table> 
                                    </td> 
                                </tr> 
                            </tbody>
                        </table>
                    </td> 
                </tr> 
            </tbody>
        </table>
    </body>
</html>';

        $host = "sg1-ls7.a2hosting.com";
        $username = "noreply@surasalanka.com";
        $password = 'Umu93;x3njmd';
        // $HELPER = new Helper();
        // $companyMail = $HELPER->PHPMailer($webmail, $visitor_name, $visitor_email, $visitor_name, $comEmail, $comany_name, $visitorSubject, $html);

        // if ($companyMail) {
        //     $arr['status'] = "Your message has been sent successfully";
        // } else {
        //     $arr['status'] = "Could not be sent your message";
        // }
        $visitorHeaders = array(
            'MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
            'To' => $visitor_email,
            'Reply-To' => $comEmail,
            'Subject' => $visitorSubject
        );
        $smtp = Mail::factory('smtp', array(
            'host' => $host,
            'auth' => true,
            'username' => $username,
            'password' => $password
        ));

        $visitorMail = $smtp->send($visitor_email, $visitorHeaders, $html);

        if (PEAR::isError($visitorMail)) {

            $arr['status'] = "Could not be sent your message";
        } else {
            $arr['status'] = "Your message has been sent successfully";
        }
        return $arr;
    }
    public function sendOrderConfirmedEmail()
    {


        date_default_timezone_set('Asia/Colombo');
        $todayis = date("l, F j, Y, g:i a");
        $site_link = "https://" . $_SERVER['HTTP_HOST'];

        $comany_name = "Surasa Lanka (Pvt) Ltd";
        $website_name = "www.surasalanka.com";
        $comConNumber = "+94 773 051 737";
        $comEmail = "info@surasalanka.com";
        $comOwner = "Team Surasa Lanka";
        $reply_email_name = 'SURASA LANKA (PVT) LTD';
        $CUSTOMER = new Customer($this->member);
        $visitor_email = $CUSTOMER->email;
        $visitor_name = $CUSTOMER->name;
        $webmail = "noreply@surasalanka.com";
        $visitorSubject = "Order Confirmation - (#" . $this->id . ")";

        $host = "sg1-ls7.a2hosting.com";
        $username = "noreply@surasalanka.com";
        $password = 'Umu93;x3njmd';


        // Compose a simple HTML email message
        $message = '<html>';
        $message .= '<body>';
        $message .= '<div  style="padding: 10px; max-width: 650px; background-color: #f2f1ff; border: 1px solid #d4d4d4;">';
        $message .= '<h4>Order Confirmation - (#' . $this->id . ')</h4>';
        $message .= '<p>Dear sir/madam, <br/>Your order (#' . $this->id . ') has been confiremd successfully.</p>';
        $message .= '<hr/>';
        $message .= '<p>Please click <a href="' . $site_link . '/member/view-order.php?id=' . $this->id . '" target="_blank">here</a> to check your order details.</p>';
        $message .= '<hr/>';
        $message .= '<p>Thanks & Best Regards!.. <br/> ' . $website_name . '<p/>';
        $message .= '<small>*Please do not reply to this email. This is an automated email & you will not receive a response.</small><br/>';
        $message .= '<span>Hotline: ' . $comConNumber . ' </span><br/>';
        $message .= '<span>' . $comEmail . '</span>';
        $message .= '</div>';
        $message .= '</body>';
        $message .= '</html>';


        $HELPER = new Helper();
        $visitorMail = $HELPER->PHPMailer($webmail, $comany_name, $comEmail, $comany_name, $visitor_email, $visitor_name, $visitorSubject, $message);
        if ($visitorMail) {
            return TRUE;
        } else {
            return FALSE;
        }


        // $visitorHeaders = array(
        //     'MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
        //     'To' => $visitor_email,
        //     'Reply-To' => $comEmail,
        //     'Subject' => $visitorSubject
        // );


        // $smtp = Mail::factory('smtp', array(
        //     'host' => $host,
        //     'auth' => true,
        //     'username' => $username,
        //     'password' => $password
        // ));

        // $visitorMail = $smtp->send($visitor_email, $visitorHeaders, $message);

        // if (PEAR::isError($visitorMail)) {
        //     return FALSE;
        // } else {
        //     return TRUE;
        // }
    }

    function sendPaymentFailureMail()
    {
        require_once "Mail.php";

        $CUSTOMER = new Customer($this->member);
        $DISTRICT = new District($CUSTOMER->district);
        $CITY = new City($CUSTOMER->city);

        date_default_timezone_set('Asia/Colombo');
        $todayis = date("l, F j, Y, g:i a");

        $comany_name = "Surasa Lanka (Pvt) Ltd";
        $website_name = "www.surasalanka.com";
        $comConNumber = "+94 773 051 737";
        $comEmail = "info@surasalanka.com";
        $comOwner = "Team Surasa Lanka";
        $reply_email_name = 'SURASA LANKA (PVT) LTD';
        $site_link = "https://" . $_SERVER['HTTP_HOST'];

        //---------------------- SERVER WEBMAIL LOGIN ------------------------

        $host = "sg1-ls7.a2hosting.com";
        $username = "noreply@surasalanka.com";
        $password = 'Umu93;x3njmd';

        //------------------------ MAIL ESSENTIALS --------------------------------

        $webmail = "noreply@surasalanka.com";
        $visitorSubject = "Order Enquiry - #" . $this->id . " - Payment Not Successful";

        $status = "";
        if ($this->paymentStatusCode == 2 && $this->status == 1) {
            $status = "Successful.";
        } else {
            $status = "Unsuccessful. Please resume your order.";
        }

        $html = '<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Synotec Email</title>
    </head>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
            <tbody>
                <tr> 
                    <td style="padding-top:10px;padding-bottom:30px;padding-left:16px;padding-right:16px" align="center"> 
                        <table style="width:602px" width="602" cellspacing="0" cellpadding="0" border="0" align="center"> 
                            <tbody>
                                <tr> 
                                    <td bgcolor=""> 
                                        <table width="642" cellspacing="0" cellpadding="0" border="0"> 
                                            <tbody> 
                                                <tr> 
                                                    <td style="border:1px solid #dcdee3;padding:20px;background-color:#fff;width:600px" width="600px" bgcolor="#ffffff" align="center"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody>
                                                                <tr><td>
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="100%">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 25px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td valign="middle" height="46" align="right">
                                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="100%" align="center">
                                                                                                                        <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:18px">
                                                                                                                            <a href="' . $site_link . '" style="color:#68696a;text-decoration:none;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.gallecabsandtours.com&amp;source=gmail&amp;ust=1574393192616000&amp;usg=AFQjCNGNM8_Z7ZMe7ndwFlJuHEP29nDd3Q">
                                                                                                                                <h4>' . $website_name . '</h4>
                                                                                                                            </a>
                                                                                                                        </font>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:15px 20px 10px;font-weight: 600;" align="left"> Hi , ' . $CUSTOMER->name . ' </td> 
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                        <p style="word-wrap:break-word;font-size:14px;color:red;line-height:20px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px">Your payment was not successful... </p>
                                                                        <p>Please be kindly informed that we have not received your payment successfully, but in case if your merchant/bank has already deducted the amount from your bank account, please contact PayHere Private Limited via 011 3009975 or 077 2929333 and get it refunded within 24 hours of payment.</p>
                                                                        <p>If your payment is not successful, click <a href="https://www.surasalanka.com/return.php?order=' . $this->id . '">here</a> for a re-payment. Thank you.</p>
                                                                    </td> 
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:20px;border:1px solid #dcdee3;width:600px;background-color:#fff"> 
                                                        
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:10px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px 10px" align="left"> <p> Cheers, </p>
                                                                        <p>' . $comOwner . '</p>
                                                                    </td> 
                                                                </tr>
                                                                    
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#fff" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#fff"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                                </tr> 
                                                            </tbody> 
                                                            <tbody>
                                                                <tr> 
                                                                    <td style="padding:10px 0 7px;color:#9a9a9a;text-align:left;font-family:Arial,Helvetica,sans-serif;font-size:12px" align="left"> <p style="line-height:18px;margin:0;padding:0"> 
                                                                        </p><p style="line-height:24px;margin:0;padding:0">' . $comany_name . '</p>
                                                                        <p style="line-height:24px;margin:0;padding:0">Email : ' . $comEmail . ' </p> 
                                                                        <p style="line-height:24px;margin:0;padding:0">Tel: ' . $comConNumber . '</p> </td> 
                                                                </tr> 
                                                            </tbody>
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                            </tbody> 
                                        </table>
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td id="m_-1040695829873221998footer_content"> 
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
                                            <tbody>
                                                <tr> 
                                                    <td> 
                                                        <table style="padding:0" width="100%" cellspacing="0" cellpadding="0" border="0" align="center"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="padding:0px 0 7px;color:#9a9a9a;text-align:left;font-family:Arial,Helvetica,sans-serif;font-size:12px" align="left"> <p style="line-height:18px;margin:0;padding:0">Website By : <a href="https://synotec.lk/">Synotec Holdings (Pvt) Ltd.</a></p> </td> 
                                                                </tr> 
                                                                <tr></tr> 
                                                            </tbody> 
                                                        </table>
                                                    </td> 
                                                </tr> 
                                            </tbody>
                                        </table> 
                                    </td> 
                                </tr> 
                            </tbody>
                        </table>
                    </td> 
                </tr> 
            </tbody>
        </table>
    </body>
</html>';

        $visitorHeaders = array(
            'MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
            'To' => $CUSTOMER->email,
            'Reply-To' => $comEmail,
            'Subject' => $visitorSubject
        );

        $companyHeaders = array(
            'MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
            'To' => $webmail,
            'Reply-To' => $CUSTOMER->email,
            'Subject' => $visitorSubject
        );

        $smtp = Mail::factory('smtp', array(
            'host' => $host,
            'auth' => true,
            'username' => $username,
            'password' => $password
        ));

        $visitorMail = $smtp->send($CUSTOMER->email, $visitorHeaders, $html);
        $companyMail = $smtp->send($webmail, $companyHeaders, $html);
        $arr = array();
        if (PEAR::isError($visitorMail)) {

            $arr['status'] = "Could not be sent your message";
        } else {
            $arr['status'] = "Your message has been sent successfully";
        }

        return $arr;
    }
}
