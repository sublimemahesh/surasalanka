<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Page
 *
 * @author Suharshana DsW
 */
class Page
{

    public $id;
    public $title;
    public $description;
    public $image_name;

    public function __construct($id)
    {
        if ($id) {

            $query = "SELECT `id`,`title`,`description`,`image_name` FROM `pages` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->title = $result['title'];
            $this->description = $result['description'];
            $this->image_name = $result['image_name'];


            return $this;
        }
    }

    public function create()
    {
        $db = new Database();
        $query = "INSERT INTO `pages` (`title`,`description`,`image_name`) VALUES  ('"
            . mysql_real_escape_string($this->title) . "','"
            . mysql_real_escape_string($this->description) . "', '"
            . mysql_real_escape_string($this->image_name) . "')";




        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function all()
    {

        $query = "SELECT * FROM `pages`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update()
    {
        $db = new Database();
        $query = "UPDATE  `pages` SET "
            . "`title` ='" . mysql_real_escape_string($this->title) . "', "
            . "`description` ='" . mysql_real_escape_string($this->description) . "', "
            . "`image_name` ='" . mysql_real_escape_string($this->image_name) . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete()
    {

        $query = 'DELETE FROM `pages` WHERE id="' . $this->id . '"';
        unlink(Helper::getSitePath() . "upload/page/" . $this->image_name);

        $db = new Database();

        return $db->readQuery($query);
    }
}
