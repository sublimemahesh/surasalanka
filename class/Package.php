<?php

/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */

/**

 * Description of Attractions

 *

 * @author Suharshana DsW

 */
class Package {

    public $id;
    public $category;
    public $sub_category;
    public $name;
    public $description;
    public $image_name;
    public $discount;
    public $product_list;
    public $price;
    public $sort;

    public function __construct($id) {

        if ($id) {

            $query = "SELECT * FROM `package` WHERE `id`=" . $id;
            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->category = $result['category'];
            $this->sub_category = $result['sub_category'];
            $this->name = $result['name'];
            $this->description = $result['description'];
            $this->image_name = $result['image_name'];
            $this->discount = $result['discount'];
            $this->product_list = $result['product_list'];
            $this->price = $result['price'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `package` (`category`,`sub_category`,`name`,`description`,`image_name`,`discount`,`product_list`,`price`,`sort`) VALUES  ('"
                . $this->category . "','"
                . $this->sub_category . "', '"
                . $this->name . "', '"
                . $this->description . "', '"
                . $this->image_name . "', '"
                . $this->discount . "', '"
                . $this->product_list . "', '"
                . $this->price . "', '"
                . $this->sort . "')";

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

        $query = "SELECT * FROM `package` ORDER BY sort ASC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row);
            }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `package` SET "
                . "`category` ='" . $this->category . "', "
                . "`sub_category` ='" . $this->sub_category . "', "
                . "`name` ='" . $this->name . "', "
                . "`price` ='" . $this->price . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`discount` ='" . $this->discount . "', "
                . "`product_list` ='" . $this->product_list . "', "
                . "`description` ='" . $this->description . "', "
                . "`sort` ='" . $this->sort . "' "
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

        unlink(Helper::getSitePath() . "upload/package/" . $this->image_name);

        $query = 'DELETE FROM `package` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }


}