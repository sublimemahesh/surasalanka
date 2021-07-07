<?php

/**
 * Description of Product
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class Customer {

    //put your code here
    public $id;
    public $name;
    public $email;
    public $password;
    public $phone_number;
    public $district;
    public $city;
    public $address;
    public $resetcode;
    public $authToken;
    public $image_name;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT  * FROM `customer` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->email = $result['email'];
            $this->password = $result['password'];
            $this->phone_number = $result['phone_number'];
            $this->district = $result['district'];
            $this->city = $result['city'];
            $this->address = $result['address'];
            $this->resetcode = $result['resetcode'];
            $this->authToken = $result['authToken'];
            $this->image_name = $result['image_name'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `customer` (`name`, `email`, `password`,`phone_number`,`district`,`city`,`address`,`image_name`) VALUES  ('"
                . $this->name . "','"
                . $this->email . "', '"
                . $this->password . "', '"
                . $this->phone_number . "', '"
                . $this->district . "', '"
                . $this->city . "', '"
                . $this->address . "', '"
                . $this->image_name . "')";
         
        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `customer` ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function login($email, $password) {

        
        $query = "SELECT  * FROM `customer` WHERE `email`= '" . $email . "' AND `password`= '" . $password . "'";
        
        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {

            $this->id = $result['id'];
            $this->setAuthToken($result['id']);
            $this->setUserSession($this->id);
            $customer = $this->__construct($this->id);
            return $customer;
        }
    }

    public function logOut() {

        if (!isset($_SESSION)) {
            session_start();
        }

        unset($_SESSION["id"]);
        unset($_SESSION["name"]);
        unset($_SESSION["email"]);

        return TRUE;
    }

    private function setUserSession($customer) {

        if (!isset($_SESSION)) {
            session_start();
        }
        $customer = $this->__construct($customer);

        $_SESSION["id"] = $customer->id;
        $_SESSION["name"] = $customer->name;
        $_SESSION["email"] = $customer->email;
        $_SESSION["phone_number"] = $customer->phone_number;
        $_SESSION["authToken"] = $customer->authToken;
        $_SESSION["image_name"] = $customer->image_name;
    }

    private function setAuthToken($id) {

        $authToken = md5(uniqid(rand(), true));

        $query = "UPDATE `customer` SET `authToken` ='" . $authToken . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {
            return $authToken;
        } else {

            return FALSE;
        }
    }

    public function authenticate() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $id = NULL;
        $authToken = NULL;

        if (isset($_SESSION["id"])) {
            $id = $_SESSION["id"];
        }

        if (isset($_SESSION["authToken"])) {
            $authToken = $_SESSION["authToken"];
        }

        $query = "SELECT `id` FROM `customer` WHERE `id`= '" . $id . "' AND `authToken`= '" . $authToken . "'";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkEmail($email) {

        $query = "SELECT `id`,`email`,`name` FROM `customer` WHERE `email`= '" . $email . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {

            return $result;
        }
    }

    public function GenarateCode($email) {

        $rand = rand(10000, 99999);

        $query = "UPDATE  `customer` SET "
                . "`resetcode` ='" . $rand . "' "
                . "WHERE `email` = '" . $email . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function SelectForgetCustomer($email) {

        if ($email) {

            $query = "SELECT `email`,`name`,`resetcode` FROM `customer` WHERE `email`= '" . $email . "'";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->name = $result['name'];
            $this->email = $result['email'];
            $this->restCode = $result['resetcode'];

            return $result;
        }
    }

    public function SelectResetCode($code) {

        $query = "SELECT `id` FROM `customer` WHERE `resetcode`= '" . $code . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        if (!$result) {

            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function updatePassword($password, $code) {
        $enPass = md5($password);

        $query = "UPDATE  `customer` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `resetcode` = '" . $code . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function update() {

        $query = "UPDATE  `customer` SET "
                . "`name` ='" . $this->name . "', "
                . "`email` ='" . $this->email . "', "
                . "`password` ='" . $this->password . "', "
                . "`phone_number` ='" . $this->phone_number . "', "
                . "`district` ='" . $this->district . "', "
                . "`city` ='" . $this->city . "', "
                . "`address` ='" . $this->address . "' "
                . "WHERE `id` = '" . $this->id . "'";



        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete() {

        $query = 'DELETE FROM `customer` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function GetCitiesByDistrict($district) {

        $query = "SELECT * FROM `customer` WHERE `district` = '" . $district . "'";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getDistrictByCityId($customer) {

        $query = "SELECT * FROM `customer` WHERE `id` = '" . $customer . "'";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function deleteCitiesByDistrict($district) {

        $query = "DELETE FROM `customer` WHERE `district`= '" . $district . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result;
    }

    public function arrange($key, $img) {
        $query = "UPDATE `customer` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

}
