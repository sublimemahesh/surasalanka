<?php

/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */

/**

 * Description of add_to_product

 *

 * @author Suharshana DsW

 */
class AddToCart {

    public $id;
    public $product;
    public $customer;
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `add_to_cart` WHERE `id`=" . $id;
            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->product = $result['product'];
            $this->customer = $result['customer'];
            $this->status = $result['status'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `add_to_cart` (`product`,`customer`,`status`) VALUES  ('"
                . $this->product . "','"
                . $this->customer . "','"
                . $this->status . "')";

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

        $query = "SELECT * FROM `add_to_cart`  ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getProductById($id) {

        $query = "SELECT * FROM `add_to_cart` WHERE `id` = ' $id  '";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `add_to_cart` SET "
                . "`status` ='" . $this->status . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

}