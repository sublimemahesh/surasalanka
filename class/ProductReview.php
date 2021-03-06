<?php

/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */

/**

 * Description of ProductReview

 *

 * @author Suharshana DsW

 */
class ProductReview {

    public $id;
    public $product;
    public $stars;
    public $title;
    public $description;
    public $customer;
    public $date_time;
    public $is_active;

    public function __construct($id) {

        if ($id) {
            $query = "SELECT  * FROM `product_review` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->product = $result['product'];
            $this->stars = $result['stars'];
            $this->title = $result['title'];
            $this->description = $result['description'];
            $this->customer = $result['customer'];
            $this->date_time = $result['date_time'];
            $this->is_active = $result['is_active'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `product_review` (`product`,`stars`,`title`,`description`,`customer`,`date_time`) VALUES  ('"
                . $this->product . "','"
                . $this->stars . "','"
                . $this->title . "','"
                . $this->description . "', '"
                . $this->customer . "', '"
                . $this->date_time . "')";

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

        $query = "SELECT * FROM `product_review` ORDER BY date_time ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `product_review` SET "
                . "`product` ='" . $this->product . "', "
                . "`title` ='" . $this->title . "', "
                . "`stars` ='" . $this->stars . "', "
                . "`description` ='" . $this->description . "', "
                . "`is_active` ='" . $this->is_active . "' "
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

        $query = 'DELETE FROM `product_review` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getReviwsByProduct($product) {

        $query = "SELECT * FROM `product_review` WHERE `product`= $product && `is_active` = 1 ORDER BY stars DESC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function arrange($key, $img) {
        $query = "UPDATE `product_review` SET `date_time` = '" . $key . "'  WHERE id = '" . $img . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        return $result;
    }

}