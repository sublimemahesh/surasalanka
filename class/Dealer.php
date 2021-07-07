<?php

/**
 * Description of Product
 *
 * @author synotec holdings
 * @web www.synotec.lk
 */
class Dealer {

    public $id;
    public $name;
    public $phone;
    public $email;
    public $nic;
    public $address;
    public $district;
    public $city;
    public $picture;
    public $nic_fr_photo;
    public $nic_bk_photo;
    private $password;
    private $authToken; 
    public $resetcode;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT  * FROM `dealer` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->phone = $result['phone'];
            $this->email = $result['email'];
            $this->nic = $result['nic'];
            $this->address = $result['address'];
            $this->city = $result['city'];
            $this->district = $result['district'];
            $this->picture = $result['picture'];
            $this->nic_fr_photo = $result['nic_fr_photo'];
            $this->nic_bk_photo = $result['nic_bk_photo'];
            $this->password = null;
            $this->authToken = $result['authToken'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `dealer` ("
                . "`name`, "
                . "`phone`, "
                . "`email`,"
                . "`nic`,"
                . "`address`,"
                . "`district`,"
                . "`city`,"
                . "`picture`,"
                . "`nic_fr_photo`,"
                . "`nic_bk_photo`"
                . ") VALUES  ('"
                . $this->name . "','"
                . $this->phone . "', '"
                . $this->email . "', '"
                . $this->nic . "', '"
                . $this->address . "', '"
                . $this->district . "', '"
                . $this->city . "', '"
                . $this->picture . "', '"
                . $this->nic_fr_photo . "', '"
                . $this->nic_bk_photo . "')";

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

        $query = "SELECT * FROM `dealer` ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function login($email, $password) {


        $query = "SELECT  * FROM `dealer` WHERE `email`= '" . $email . "' AND `password`= '" . $password . "'";
        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {

            $this->id = $result['id'];
            $this->setAuthToken($result['id']);
            $this->setUserSession($this->id);
            $dealer = $this->__construct($this->id);
            return $dealer;
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

    private function setUserSession($dealer) {

        if (!isset($_SESSION)) {
            session_start();
        }
        $dealer = $this->__construct($dealer);

        $_SESSION["id"] = $dealer->id;
        $_SESSION["name"] = $dealer->name;
        $_SESSION["email"] = $dealer->email;
        $_SESSION["phone"] = $dealer->phone;
        $_SESSION["authToken"] = $dealer->authToken;
        $_SESSION["picture"] = $dealer->picture;
    }

    private function setAuthToken($id) {

        $authToken = md5(uniqid(rand(), true));

        $query = "UPDATE `dealer` SET `authToken` ='" . $authToken . "' WHERE `id`='" . $id . "'";

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

        $query = "SELECT `id` FROM `dealer` WHERE `id`= '" . $id . "' AND `authToken`= '" . $authToken . "'";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkEmail($email) {

        $query = "SELECT `email`,`name` FROM `dealer` WHERE `email`= '" . $email . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {

            return $result;
        }
    }

    public function genarateCode($email) {

        $rand = rand(10000, 99999);

        $query = "UPDATE  `dealer` SET "
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

    public function selectForgetDealer($email) {

        if ($email) {

            $query = "SELECT `email`,`name`,`resetcode` FROM `dealer` WHERE `email`= '" . $email . "'";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->name = $result['name'];
            $this->email = $result['email'];
            $this->restCode = $result['resetcode'];

            return $result;
        }
    }

    public function selectResetCode($code) {

        $query = "SELECT `id` FROM `dealer` WHERE `resetcode`= '" . $code . "'";

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

        $query = "UPDATE  `dealer` SET "
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

        $query = "UPDATE  `resetcode` SET "
                . "`name` ='" . $this->name . "', "
                . "`email` ='" . $this->email . "', "
                . "`password` ='" . $this->password . "', "
                . "`phone` ='" . $this->phone . "', "
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

        $query = 'DELETE FROM `dealer` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function GetCitiesByDistrict($district) {

        $query = "SELECT * FROM `dealer` WHERE `district` = '" . $district . "'";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getDistrictByCityId($dealer) {

        $query = "SELECT * FROM `dealer` WHERE `id` = '" . $dealer . "'";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function deleteCitiesByDistrict($district) {

        $query = "DELETE FROM `dealer` WHERE `district`= '" . $district . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result;
    }

    public function arrange($key, $img) {
        $query = "UPDATE `dealer` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

}
