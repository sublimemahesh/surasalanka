<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author W j K n``
 */
class Product {

    public $id;
    public $category;
    public $sub_category;
    public $brand;
    public $name;
    public $discount;
    public $unit;
    public $price;
    public $image_name;
    public $short_description;
    public $description;
    public $in_stock;
    public $min_qty;
    public $max_qty;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `product` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->category = $result['category'];
            $this->sub_category = $result['sub_category'];
            $this->brand = $result['brand'];
            $this->name = $result['name'];
            $this->discount = $result['discount'];
            $this->unit = $result['unit'];
            $this->price = $result['price'];
            $this->image_name = $result['image_name'];
            $this->short_description = $result['short_description'];
            $this->description = $result['description'];
            $this->in_stock = $result['in_stock'];
            $this->min_qty = $result['min_qty'];
            $this->max_qty = $result['max_qty'];
            $this->queue = $result['queue'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `product` (`category`,`sub_category`,`brand`,`name`,`discount`,`unit`,`price`,`image_name`,`short_description`,`description`,`in_stock`,`min_qty`,`max_qty`,`queue`) VALUES  ('"
                . $this->category . "','"
                . $this->sub_category . "','"
                . $this->brand . "','"
                . $this->name . "', '"
                . $this->discount . "', '"
                . $this->unit . "', '"
                . $this->price . "', '"
                . $this->image_name . "', '"
                . $this->short_description . "', '"
                . $this->description . "', '"
                . $this->in_stock . "', '"
                . $this->min_qty . "', '"
                . $this->max_qty . "', '"
                . $this->queue . "')";


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

        $query = "SELECT * FROM `product` ORDER BY queue ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getNewProducts() {

        $query = "SELECT * FROM `product` ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getFeaturedProducts() {

        $query = "SELECT * FROM `product` GROUP BY `category`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getOfferedProducts() {

        $query = "SELECT * FROM `product` WHERE `discount` != 0";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `product` SET "
                . "`category` ='" . $this->category . "', "
                . "`sub_category` ='" . $this->sub_category . "', "
                . "`brand` ='" . $this->brand . "', "
                . "`name` ='" . $this->name . "', "
                . "`discount` ='" . $this->discount . "', "
                . "`unit` ='" . $this->unit . "', "
                . "`price` ='" . $this->price . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`short_description` ='" . $this->short_description . "', "
                . "`description` ='" . $this->description . "', "
                . "`in_stock` ='" . $this->in_stock . "', "
                . "`min_qty` ='" . $this->min_qty . "', "
                . "`max_qty` ='" . $this->max_qty . "', "
                . "`queue` ='" . $this->queue . "' "
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


        $query = 'DELETE FROM `product` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getProductsBySubProduct($sub_category) {


        $query = 'SELECT * FROM `product` WHERE sub_category="' . $sub_category . '" ORDER BY queue ASC';

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getProductsByBrand($brand) {


        $query = 'SELECT * FROM `product` WHERE `brand`="' . $brand . '"   ORDER BY queue ASC';

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getBrandByCategory($category) {

        $query = 'SELECT DISTINCT `brand`  FROM `product` WHERE `category`="' . $category . '"';

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getProductsBySubCategory($subcategory) {

        $query = 'SELECT * FROM `product` WHERE sub_category="' . $subcategory . '"   ORDER BY queue ASC';

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getProductsByCategory($category) {

        $query = 'SELECT * FROM `product` WHERE category="' . $category . '"   ORDER BY queue ASC';

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getProductsByCategories($category, $minimum_price, $maximum_price, $sub_category, $brand, $pageLimit, $setLimit) {

        if (isset($category)) {

            $query = 'SELECT * FROM `product` WHERE category="' . $category . '"';

            if (isset($minimum_price) && isset($maximum_price) && !empty($minimum_price) && !empty($minimum_price)) {
                $query .= ' AND `price` BETWEEN "' . $minimum_price . '" AND "' . $maximum_price . '"';
            }

            if (!empty($sub_category)) {
                $sub_category_filter = implode(",", $sub_category);
                $query .= ' AND `sub_category` in(' . $sub_category_filter . ')';
            }

            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= ' AND `brand` in(' . $brand_filter . ')';
            }

            $query .= ' ORDER BY `queue` ASC LIMIT ' . $pageLimit . ', ' . $setLimit;
        }
        $db = new Database();
        $result = $db->readQuery($query);


        $out_put = '';
        while ($row = mysql_fetch_array($result)) {
            $BRAND = new Brand($row['brand']);

            $price_amount = 0;
            $discount = 0;

            $discount = $row['discount'];
            $price_amount = $row['price'];

            $discount = ($price_amount * $discount) / 100;
            $discount_price = $row['price'] - $discount;

            if (strlen($row['name']) > 28) {
                $name = substr($row['name'], 0, 24) . '...';
            } else {
                $name = $row['name'];
            }

            $add_to_cart = '';
            if ($row['in_stock'] == 1) {
                $add_to_cart = '<a class="addcart-link" href="#"  class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm' . $row['id'] . '"><i class="fa fa-shopping-basket"></i> Add to Cart</a>';
            } else {
                $add_to_cart = '<a class="addcart-link not-available-btn-hover" class="btn btn-default btn-rounded mb-4"><i class="fa fa-shopping-basket"></i> Not in Stock</a>';
            }

            $out_put .= '<ul class=" product-grid"  >';
            $out_put .= ' <li class="col-md-4 col-sm-6 col-xs-12">
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a class="product-thumb-link" href="view-product.php?id=' . $row['id'] . '">
                                        <img class="first-thumb" alt="" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"> 
                                        <img class="second-thumb" alt="" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"> 
                                    </a>
                                    
                                    <div class="product-info-cart">' . $add_to_cart . '</div>
                                </div>
                             <div class="product-info">
                                <h3 class="title-product"><a href="view-product.php?id=' . $row['id'] . '" title="' . $row['name'] . '">' . $name . '</a></h3>
                        <div class="info-price">';

            if (!empty($discount)) {
                $out_put .= ' <span id="price-format-design">Rs: ' . number_format($discount_price, 2) . '</span><span class="unit-display">/' . $row['unit'] . '</span><del>Rs: ' . number_format($price_amount, 2) . '</del>';
            } else {
                $out_put .= '<span id="price-format-design">Rs: ' . number_format($price_amount, 2) . '</span><span class="unit-display">/' . $row['unit'] . '</span> ';
            }

            $out_put .= '</div>';

            if (!empty($discount)) {
                $out_put .= '<div class="percent-saleoff">
                            <span><label>' . $row['discount'] . '%</label> OFF</span>
                            </div>';
            }
            $out_put .= '</div> ';
            $out_put .= '</li> ';
            $BRAND = new Brand($row['brand']);
            $out_put .= ''
                    . '<div class="modal fade" id="modalLoginForm' . $row['id'] . '"tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document"> 
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold"><b>' . $row['name'] . '</b>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </h4>
                        </div>
                        
                        <div class="modal-body mx-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img class="first-thumb" alt="" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"> 
                                        </div>
                                </div>
                                <div class="col-md-8"> 
                                    <p class="text-justify">' . $row['short_description'] . '</p>                                     
                                      <span pull-left> <i class="fa fa-circle"></i> Brand : ' . $BRAND->name . ' </span> </br>
                                      <span pull-right> <i class="fa fa-circle"></i> Unit : ' . $row['unit'] . ' </span></br>
                                          <span pull-right=""> <i class="fa fa-circle"></i> Order Limit : Minimum ' . $row['min_qty'] . ' & Maximum ' . $row['max_qty'] . ' </span><br>
                                        <div class="col-md-6  " id="price-padd">    
                                        
                                            <label>Rs :</label> <span id="price-format-design" > ' . number_format($discount_price, 2) . ' </span>
                                              
                                            <input type="hidden" id="price' . $row['id'] . '" class="price-format total_price_amount" value="' . $discount_price . '"/>
                                        </div>                                        
                                        <div class="col-md-6 "  id="price-padd">                                               
                                        <div class="attr-product">                                            
                                            <div class="input-group">                                             
                                                <input type="number" name="quantity"  min="' . $row['min_qty'] . '" max="' . $row['max_qty'] . '" step="' . $row['min_qty'] . '" id="quantity' . $row['id'] . '"     class=" form-control form-input-design"  value="1"  />
                                            </div>
                                            
                                        </div>                                            
                                     </div>
                                </div>  
                             </div>  
                        </div>
                        
                        <div class="modal-footer d-flex justify-content-center">  
                           <input type="hidden" class="form-control  "   id="product_id" value="' . $row['id'] . '" />
                            <input   type="hidden" name="name"  id="name' . $row['id'] . '" value="' . $row['name'] . '" />
                            <input type="button" class="btn btn-info add_to_cart" name="add_to_cart"  id="' . $row['id'] . '" min-qty="' . $row['min_qty'] . '" max-qty="' . $row['max_qty'] . '" value="Add to Cart"/>
                           </div>
                    </div>
                </div>
            </div>';
            $out_put .= '</ul> ';
        }

        if (!empty($out_put)) {
            echo $out_put;
        } else {
            echo $out_put = 'No Data Found..!';
        }
    }

    public function getAllProducts($minimum_price, $maximum_price, $pageLimit, $setLimit) {
//    public function getAllProducts($minimum_price, $maximum_price) {


        $query = 'SELECT * FROM `product` ';

        if (isset($minimum_price) && isset($maximum_price) && $minimum_price != '' && $maximum_price != '') {
            $query .= 'WHERE `price` BETWEEN "' . $minimum_price . '" AND "' . $maximum_price . '" ';
        }

        $query .= "ORDER BY `queue` ASC LIMIT " . $pageLimit . " , " . $setLimit;

        $db = new Database();
        $result = $db->readQuery($query);


        $out_put = '';
        while ($row = mysql_fetch_array($result)) {
            $BRAND = new Brand($row['brand']);

            $price_amount = 0;
            $discount = 0;

            $discount = $row['discount'];
            $price_amount = $row['price'];

            $discount = ($price_amount * $discount) / 100;
            $discount_price = $row['price'] - $discount;

            if (strlen($row['name']) > 28) {
                $name = substr($row['name'], 0, 24) . '...';
            } else {
                $name = $row['name'];
            }

            $add_to_cart = '';
            if ($row['in_stock'] == 1) {
                $add_to_cart = '<a class="addcart-link" href="#"  class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm' . $row['id'] . '"><i class="fa fa-shopping-basket"></i> Add to Cart</a>';
            } else {
                $add_to_cart = '<a class="addcart-link not-available-btn-hover" class="btn btn-default btn-rounded mb-4"><i class="fa fa-shopping-basket"></i> Not in Stock</a>';
            }

            $out_put .= '<ul class=" product-grid"  >';
            $out_put .= ' <li class="col-md-4 col-sm-6 col-xs-12">
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a class="product-thumb-link" href="view-product.php?id=' . $row['id'] . '">
                                        <img class="first-thumb" alt="" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"> 
                                        <img class="second-thumb" alt="" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"> 
                                    </a>
                                    
                                    <div class="product-info-cart">' . $add_to_cart . '</div>
                                </div>
                             <div class="product-info">
                                <h3 class="title-product"><a href="view-product.php?id=' . $row['id'] . '" title="' . $row['name'] . '">' . $name . '</a></h3>
                        <div class="info-price">';

            if (!empty($discount)) {
                $out_put .= ' <span id="price-format-design">Rs: ' . number_format($discount_price, 2) . '</span><span class="unit-display">/' . $row['unit'] . '</span><del>Rs: ' . number_format($price_amount, 2) . '</del>';
            } else {
                $out_put .= '<span id="price-format-design">Rs: ' . number_format($price_amount, 2) . '</span><span class="unit-display">/' . $row['unit'] . '</span> ';
            }

            $out_put .= '</div>';

            if (!empty($discount)) {
                $out_put .= '<div class="percent-saleoff">
                            <span><label>' . $row['discount'] . '%</label> OFF</span>
                            </div>';
            }
            $out_put .= '</div> ';
            $out_put .= '</li> ';
            $BRAND = new Brand($row['brand']);
            $out_put .= ''
                    . '<div class="modal fade" id="modalLoginForm' . $row['id'] . '"tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document"> 
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold"><b>' . $row['name'] . '</b>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </h4>
                        </div>
                        
                        <div class="modal-body mx-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img class="first-thumb" alt="" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"> 
                                        </div>
                                </div>
                                <div class="col-md-8"> 
                                    <p class="text-justify">' . $row['short_description'] . '</p>                                     
                                      <span pull-left> <i class="fa fa-circle"></i> Brand : ' . $BRAND->name . ' </span> </br>
                                      <span pull-right> <i class="fa fa-circle"></i> Unit : ' . $row['unit'] . ' </span></br>
                                          <span pull-right=""> <i class="fa fa-circle"></i> Order Limit : Minimum ' . $row['min_qty'] . ' & Maximum ' . $row['max_qty'] . ' </span><br>
                                        <div class="col-md-6  " id="price-padd">    
                                        
                                            <label>Rs :</label> <span id="price-format-design" > ' . number_format($discount_price, 2) . ' </span>
                                              
                                            <input type="hidden" id="price' . $row['id'] . '" class="price-format total_price_amount" value="' . $discount_price . '"/>
                                        </div>                                        
                                        <div class="col-md-6 "  id="price-padd">                                               
                                        <div class="attr-product">                                            
                                            <div class="input-group">                                             
                                                <input type="number" name="quantity"  min="' . $row['min_qty'] . '" max="' . $row['max_qty'] . '" step="' . $row['min_qty'] . '" id="quantity' . $row['id'] . '"     class=" form-control form-input-design"  value="1"  />
                                            </div>
                                            
                                        </div>                                            
                                     </div>
                                </div>  
                             </div>  
                        </div>
                        
                        <div class="modal-footer d-flex justify-content-center">  
                           <input type="hidden" class="form-control  "   id="product_id" value="' . $row['id'] . '" />
                            <input   type="hidden" name="name"  id="name' . $row['id'] . '" value="' . $row['name'] . '" />
                            <input type="button" class="btn btn-info add_to_cart" name="add_to_cart"  id="' . $row['id'] . '" min-qty="' . $row['min_qty'] . '" max-qty="' . $row['max_qty'] . '" value="   Add to Cart"/>
                           </div>
                    </div>
                </div>
            </div>';
            $out_put .= '</ul> ';
        }

        if (!empty($out_put)) {
            echo $out_put;
        } else {
            echo $out_put = 'No Data Found..!';
        }
    }

    public function getProductsByBrands($brand_id, $brand, $minimum_price, $maximum_price) {

        if (isset($brand_id)) {

            $query = 'SELECT * FROM `product` WHERE `brand`="' . $brand_id . '"';

            if (isset($minimum_price) && isset($maximum_price) && !empty($minimum_price) && !empty($minimum_price)) {
                $query .= 'AND `price` BETWEEN "' . $minimum_price . '" AND "' . $maximum_price . '"';
            }


            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= 'OR `brand` in(' . $brand_filter . ')';
            }

//            $query .= ' ORDER BY  queue DESC LIMIT ' . $page . ',' . $per_page . '';
        }


        $db = new Database();
        $result = $db->readQuery($query);

        $out_put = '';
        while ($row = mysql_fetch_array($result)) {
            $BRAND = new Brand($row['brand']);

            $price_amount = 0;
            $discount = 0;

            $discount = $row['discount'];
            $price_amount = $row['price'];

            $discount = ($price_amount * $discount) / 100;
            $discount_price = $row['price'] - $discount;

            if (strlen($row['name']) > 28) {
                $name = substr($row['name'], 0, 24) . '...';
            } else {
                $name = $row['name'];
            }

            $add_to_cart = '';
            if ($row['in_stock'] == 1) {
                $add_to_cart = '<a class="addcart-link" href="#"  class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm' . $row['id'] . '"><i class="fa fa-shopping-basket"></i> Add to Cart</a>';
            } else {
                $add_to_cart = '<a class="addcart-link not-available-btn-hover" class="btn btn-default btn-rounded mb-4"><i class="fa fa-shopping-basket"></i> Not in Stock</a>';
            }

            $out_put .= '<ul class=" product-grid"  >';
            $out_put .= ' <li class="col-md-4 col-sm-6 col-xs-12">
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a class="product-thumb-link" href="view-product.php?id=' . $row['id'] . '">
                                        <img class="first-thumb" alt="" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"> 
                                        <img class="second-thumb" alt="" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"> 
                                    </a>
                                    
                                    <div class="product-info-cart">' . $add_to_cart . '</div>
                                </div>
                             <div class="product-info">
                                <h3 class="title-product"><a href="view-product.php?id=' . $row['id'] . '" title="' . $row['name'] . '">' . $name . '</a></h3>
                        <div class="info-price">';

            if (!empty($discount)) {
                $out_put .= ' <span id="price-format-design">Rs: ' . number_format($discount_price, 2) . '</span><span class="unit-display">/' . $row['unit'] . '</span><del>Rs: ' . number_format($price_amount, 2) . '</del>';
            } else {
                $out_put .= '<span id="price-format-design">Rs: ' . number_format($price_amount, 2) . '</span><span class="unit-display">/' . $row['unit'] . '</span> ';
            }

            $out_put .= '</div>';

            if (!empty($discount)) {
                $out_put .= '<div class="percent-saleoff">
                            <span><label>' . $row['discount'] . '%</label> OFF</span>
                            </div>';
            }
            $out_put .= '</div> ';
            $out_put .= '</li> ';
            $BRAND = new Brand($row['brand']);
            $out_put .= ''
                    . '<div class="modal fade" id="modalLoginForm' . $row['id'] . '"tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document"> 
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold"><b>' . $row['name'] . '</b>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </h4>
                        </div>
                        
                        <div class="modal-body mx-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img class="first-thumb" alt="" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"> 
                                        </div>
                                </div>
                                <div class="col-md-8"> 
                                    <p class="text-justify">' . $row['short_description'] . '</p>                                     
                                      <span pull-left> <i class="fa fa-circle"></i> Brand : ' . $BRAND->name . ' </span> </br>
                                      <span pull-right> <i class="fa fa-circle"></i> Unit : ' . $row['unit'] . ' </span></br>
                                          <span pull-right=""> <i class="fa fa-circle"></i> Order Limit : Minimum ' . $row['min_qty'] . ' & Maximum ' . $row['max_qty'] . ' </span><br>
                                        <div class="col-md-6  " id="price-padd">    
                                        
                                            <label>Rs :</label> <span id="price-format-design" > ' . number_format($discount_price, 2) . ' </span>
                                              
                                            <input type="hidden" id="price' . $row['id'] . '" class="price-format total_price_amount" value="' . $discount_price . '"/>
                                        </div>                                        
                                        <div class="col-md-6 "  id="price-padd">                                               
                                        <div class="attr-product">                                            
                                            <div class="input-group">                                             
                                                <input type="number" name="quantity"  min="' . $row['min_qty'] . '" max="' . $row['max_qty'] . '" step="' . $row['min_qty'] . '" id="quantity' . $row['id'] . '"     class=" form-control form-input-design"  value="1"  />
                                            </div>
                                            
                                        </div>                                            
                                     </div>
                                </div>  
                             </div>  
                        </div>
                        
                        <div class="modal-footer d-flex justify-content-center">  
                           <input type="hidden" class="form-control  "   id="product_id" value="' . $row['id'] . '" />
                            <input   type="hidden" name="name"  id="name' . $row['id'] . '" value="' . $row['name'] . '" />
                            <input type="button" class="btn btn-info add_to_cart" name="add_to_cart"  id="' . $row['id'] . '" min-qty="' . $row['min_qty'] . '" max-qty="' . $row['max_qty'] . '" value="   Add to Cart"/>
                           </div>
                    </div>
                </div>
            </div>';
            $out_put .= '</ul> ';
        }

        if (!empty($out_put)) {
            echo $out_put;
        } else {
            echo $out_put = 'No Data Found..!';
        }
    }

    public function getMaxPriceInProduct($category, $sub_category, $brand) {

        if (isset($category)) {

            $query = 'SELECT max(price) FROM `product` WHERE category = "' . $category . '"';

            if (!empty($sub_category)) {
                $sub_category_filter = implode(",", $sub_category);
                $query .= 'AND `sub_category` in(' . $sub_category_filter . ')';
            }

            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= 'AND `brand` in(' . $brand_filter . ')';
            }
        };
        $db = new Database();

        $result = $db->readQuery($query);
        $row = mysql_fetch_array($result);

        return $row;
    }

    public function getMinPriceInProduct($category, $sub_category, $brand) {

        if (isset($category)) {

            $query = 'SELECT min(price) FROM `product` WHERE category = "' . $category . '"';

            if (!empty($sub_category)) {
                $sub_category_filter = implode(",", $sub_category);
                $query .= 'AND `sub_category` in(' . $sub_category_filter . ')';
            }

            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= 'AND `brand` in(' . $brand_filter . ')';
            }
        };
        $db = new Database();

        $result = $db->readQuery($query);
        $row = mysql_fetch_array($result);

        return $row;
    }

//    public function getProductsByCategoryByAll($category, $pageLimit, $setLimit) {
//
//        $query = "SELECT * FROM `product` where `category` = " . $category . "   ORDER BY queue DESC LIMIT " . $pageLimit . " , " . $setLimit . "  ";
//
//        $db = new Database();
//
//        $result = $db->readQuery($query);
//        $array_res = array();
//
//        while ($row = mysql_fetch_array($result)) {
//            array_push($array_res, $row);
//        }
//        return $array_res;
//    }

    public function arrange($key, $img) {

        $query = "UPDATE `product` SET `queue` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

    public function showPagination11111($id, $sub_category, $brand, $per_page, $page) {

        $page_url = "?";
        if (isset($id)) {
            $query = 'SELECT COUNT(*) as totalCount FROM `product` WHERE category = "' . $id . '" ';

            if (!empty($sub_category)) {
                $sub_category_filter = implode(",", $sub_category);
                $query .= 'AND `sub_category` in(' . $sub_category_filter . ')';
            }

            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= 'AND `brand` in(' . $brand_filter . ')';
            }
        }

        $db = new Database();

        $result = $db->readQuery($query);
        $row = mysql_fetch_array($result);

        $total = $row['totalCount'];

        $adjacents = "2";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;

        $setLastpage = ceil($total / $per_page);

        $lpm1 = $setLastpage - 1;
        $setPaginate = "";
        if ($setLastpage > 1) {

            $setPaginate .= "<div class='product-pagi-nav pull-right'>";
            $setPaginate .= "<a>Page $page of $setLastpage</a> ";

            if ($setLastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $setLastpage; $counter++) {

                    if ($counter == $page) {
                        $setPaginate .= " <a class='current_page'>$counter</a> ";
                    } else {
                        $setPaginate .= " <a href='{$page_url}page=$counter&id=$id'>$counter</a> ";
                    }
                }
            } elseif ($setLastpage > 5 + ($adjacents * 2)) {

                if ($page <= 1 + ((int) $adjacents * 2)) {

                    for ($counter = 1; $counter < 4 + ((int) $adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate .= " <a class='current_page'>$counter</a> ";
                        else
                            $setPaginate .= " <a href='{$page_url}page=$counter&id=$id'>$counter</a> ";
                    }

                    $setPaginate .= "<a href='{$page_url}page= $lpm1'>$lpm1</a>";
                    $setPaginate .= "<a href='{$page_url}page=$setLastpage&id=$id'>$setLastpage</a>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                    $setPaginate .= "<a href='{$page_url}page=1'>1</a>";
                    $setPaginate .= "<a href='{$page_url}page=2'>2</a>";
                    $setPaginate .= "<a class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<a class='current_page'>$counter</a>";
                        else
                            $setPaginate .= "<a href='{$page_url}page=$counter&id=$id'>$counter</a>";
                    }
                    $setPaginate .= "< class='dot'>..";
                    $setPaginate .= "<a href='{$page_url}page = $lpm1'>$lpm1</a>";
                    $setPaginate .= "<a href='{$page_url}page=$setLastpage&id=$id'>$setLastpage</a>";
                }
                else {
                    $setPaginate .= "<a href='{$page_url}page = 1'>1</a>";
                    $setPaginate .= "<a href='{$page_url}page = 2'>2</a>";
                    $setPaginate .= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<a class='current_page'>$counter</a>";
                        else
                            $setPaginate .= "<a href='{$page_url}page=$counter&i =$id'>$counter</a>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate .= "<a href='{$page_url}page=$next&id=$id'>Next</a>";
                $setPaginate .= "<a href='{$page_url}page=$setLastpage&id=$id'>Last</a>";
            } else {
                $setPaginate .= "<a class='current_page'>Next</a>";
                $setPaginate .= "<a class='current_page'>Last</a>";
            }

            $setPaginate .= "</div>\n";
        }
        echo $setPaginate;
    }

    public function showPagination($minimum_price, $maximum_price, $category, $cat, $sub_category, $brand, $per_page, $page) {

        $w = array();
        $where = '';

        if (!empty($sub_category)) {
            $sub_category_list = '';
            foreach ($sub_category as $scat) {
                if (empty($sub_category_list)) {
                    $sub_category_list .= $scat;
                } else {
                    $sub_category_list .= ',' . $scat;
                }
            }

            $w[] = '`sub_category` IN (' . $sub_category_list . ')';
        }
        if (!empty($category)) {
            $category_list = '';
            foreach ($category as $catl) {
                
                if (empty($category_list)) {
                    $category_list .= $catl;
                } else {
                    $category_list .= ',' . $catl;
                }
            }
            $w[] = '`category` IN (' . $category_list . ')';
        }
        if (!empty($cat)) {
            $w[] = '`category` = "' . $cat . '"';
        }

        if (isset($minimum_price) && isset($maximum_price) && $minimum_price != '' && $maximum_price != '') {
            $w[] = '`price` BETWEEN "' . $minimum_price . '" AND "' . $maximum_price . '"';
        }


        if (!empty($brand)) {
            $brand_filter = implode(",", $brand);
            $w[] = '`brand` in(' . $brand_filter . ')';
        }

        if (count($w)) {
            $where = "WHERE " . implode(' AND ', $w);
        }

        $db = new Database();

        $page_url = "?";
        $query = "SELECT COUNT(*) as totalCount FROM `product`  $where  ORDER BY `queue` asc";
        
        $rec = mysql_fetch_array(mysql_query($query));

        $total = $rec['totalCount'];

        $adjacents = "2";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;

        $setLastpage = ceil($total / $per_page);

        $lpm1 = $setLastpage - 1;
        $setPaginate = "";
        if ($setLastpage > 1) {
            $setPaginate .= "<ul class='setPaginate'>";
            $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
            if ($setLastpage < 7 + ($adjacents * 2)) {

                for ($counter = 1; $counter <= $setLastpage; $counter++) {

                    if ($counter == $page)
                        $setPaginate.= "<li><a class='current_page page'>$counter</a></li>";
                    else
                        $setPaginate.= "<li><a href='#' class='page' page='$counter'>$counter</a></li>";
                }
            }
            elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='#' class='page' page='$counter'>$counter</a></li>";
                    }
                    $setPaginate.= "<li class='dot'>...</li>";
                    $setPaginate.= "<li><a href='#' class='page' page='$lpm1'>$lpm1</a></li>";
                    $setPaginate.= "<li><a href='#' class='page' page='$setLastpage'>$setLastpage</a></li>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $setPaginate.= "<li><a href='#' class='page' page='1'>1</a></li>";
                    $setPaginate.= "<li><a href='#' class='page' page='2'>2</a></li>";
                    $setPaginate.= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='#' class='page' page='$counter'>$counter</a></li>";
                    }
                    $setPaginate.= "<li class='dot'>..</li>";
                    $setPaginate.= "<li><a href='#' class='page' page='$lpm1'>$lpm1</a></li>";
                    $setPaginate.= "<li><a href='#' class='page' page='$setLastpage'>$setLastpage</a></li>";
                }
                else {
                    $setPaginate.= "<li><a href='#' class='page' page='1>1</a></li>";
                    $setPaginate.= "<li><a href='#' class='page' page='2'>2</a></li>";
                    $setPaginate.= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='#' class='page' page='$counter'>$counter</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate.= "<li><a href='#' class='page' page='$next'>Next</a></li>";
                $setPaginate.= "<li><a href='#' class='page' page='$setLastpage'>Last</a></li>";
            } else {
                $setPaginate.= "<li><a class='current_page page'>Next</a></li>";
                $setPaginate.= "<li><a class='current_page page'>Last</a></li>";
            }

            $setPaginate.= "</ul>\n";
        }

        echo $setPaginate;
    }

    public function showPagination1($id, $sub_category, $brand, $per_page, $page) {

        $page_url = "?";
        $query = 'SELECT COUNT(*) as totalCount FROM `product`';

        if (isset($minimum_price) && isset($maximum_price) && !empty($minimum_price) && !empty($maximum_price)) {
            $query .= 'WHERE `price` BETWEEN "' . $minimum_price . '" AND "' . $maximum_price . '" ';
        }


        $db = new Database();

        $result = $db->readQuery($query);
        $row = mysql_fetch_array($result);

        $total = $row['totalCount'];

        $adjacents = "2";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;

        $setLastpage = ceil($total / $per_page);

        $lpm1 = $setLastpage - 1;
        $setPaginate = "";
        if ($setLastpage > 1) {

            $setPaginate .= "<div class='product-pagi-nav pull-right'>";
            $setPaginate .= "<a>Page $page of $setLastpage</a> ";

            if ($setLastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $setLastpage; $counter++) {

                    if ($counter == $page) {
                        $setPaginate .= " <a class='current_page'>$counter</a> ";
                    } else {
                        $setPaginate .= " <a href='{$page_url}page=$counter&id=$id'>$counter</a> ";
                    }
                }
            } elseif ($setLastpage > 5 + ($adjacents * 2)) {

                if ($page <= 1 + ((int) $adjacents * 2)) {

                    for ($counter = 1; $counter < 4 + ((int) $adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate .= " <a class='current_page'>$counter</a> ";
                        else
                            $setPaginate .= " <a href='{$page_url}page=$counter&id=$id'>$counter</a> ";
                    }

                    $setPaginate .= "<a href='{$page_url}page= $lpm1'>$lpm1</a>";
                    $setPaginate .= "<a href='{$page_url}page=$setLastpage&id=$id'>$setLastpage</a>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                    $setPaginate .= "<a href='{$page_url}page=1'>1</a>";
                    $setPaginate .= "<a href='{$page_url}page=2'>2</a>";
                    $setPaginate .= "<a class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<a class='current_page'>$counter</a>";
                        else
                            $setPaginate .= "<a href='{$page_url}page=$counter&id=$id'>$counter</a>";
                    }
                    $setPaginate .= "< class='dot'>..";
                    $setPaginate .= "<a href='{$page_url}page = $lpm1'>$lpm1</a>";
                    $setPaginate .= "<a href='{$page_url}page=$setLastpage&id=$id'>$setLastpage</a>";
                }
                else {
                    $setPaginate .= "<a href='{$page_url}page = 1'>1</a>";
                    $setPaginate .= "<a href='{$page_url}page = 2'>2</a>";
                    $setPaginate .= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<a class='current_page'>$counter</a>";
                        else
                            $setPaginate .= "<a href='{$page_url}page=$counter&i =$id'>$counter</a>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate .= "<a href='{$page_url}page=$next&id=$id'>Next</a>";
                $setPaginate .= "<a href='{$page_url}page=$setLastpage&id=$id'>Last</a>";
            } else {
                $setPaginate .= "<a class='current_page'>Next</a>";
                $setPaginate .= "<a class='current_page'>Last</a>";
            }

            $setPaginate .= "</div>\n";
        }
        echo $setPaginate;
    }

    public function getAllProductsByCategoryAndBrand($category, $cat, $minimum_price, $maximum_price, $sub_category, $brand, $pageLimit, $setLimit) {


        $w = array();
        $where = '';

        if (!empty($category)) {
            $cat_list = '';
            foreach ($category as $cat1) {
                if (empty($cat_list)) {
                    $cat_list .= $cat1;
                } else {
                    $cat_list .= ',' . $cat1;
                }
            }

            $w[] = '`category` IN (' . $cat_list . ')';
        }

        if (isset($minimum_price) && isset($maximum_price) && $minimum_price != '' && $maximum_price != '') {

            $w[] = '`price` BETWEEN "' . $minimum_price . '" AND "' . $maximum_price . '"';
        }

        if (!empty($sub_category)) {
            $w[] = '`sub_category` = "' . $sub_category . '"';
        }
        if (!empty($cat)) {
            $w[] = '`category` = "' . $cat . '"';
        }

        if (!empty($brand)) {
            $brand_filter = implode(",", $brand);
            $w[] = '`brand` in(' . $brand_filter . ')';
        }

        if (count($w)) {
            $where = " WHERE " . implode(' AND ', $w);
        }
        $query = "SELECT * FROM `product` $where";

        $query .= " ORDER BY `queue` ASC LIMIT " . $pageLimit . " , " . $setLimit;

        $db = new Database();
        $result = $db->readQuery($query);


        $out_put = '';
        while ($row = mysql_fetch_array($result)) {
            $BRAND = new Brand($row['brand']);

            $price_amount = 0;
            $discount = 0;

            $discount = $row['discount'];
            $price_amount = $row['price'];

            $discount = ($price_amount * $discount) / 100;
            $discount_price = $row['price'] - $discount;

            if (strlen($row['name']) > 28) {
                $name = substr($row['name'], 0, 24) . '...';
            } else {
                $name = $row['name'];
            }

            $add_to_cart = '';
            if ($row['in_stock'] == 1) {
                $add_to_cart = '<a class="addcart-link" href="#"  class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm' . $row['id'] . '"><i class="fa fa-shopping-basket"></i> Add to Cart</a>';
            } else {
                $add_to_cart = '<a class="addcart-link not-available-btn-hover" class="btn btn-default btn-rounded mb-4"><i class="fa fa-shopping-basket"></i> Not in Stock</a>';
            }

            $out_put .= '<ul class=" product-grid"  >';
            $out_put .= ' <li class="col-md-4 col-sm-6 col-xs-12">
                            <div class="item-product">
                                <div class="product-thumb">
                                    <a class="product-thumb-link" href="view-product.php?id=' . $row['id'] . '">
                                        <img class="first-thumb" alt="" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"> 
                                        <img class="second-thumb" alt="" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"> 
                                    </a>
                                    
                                    <div class="product-info-cart">' . $add_to_cart . '</div>
                                </div>
                             <div class="product-info">
                                <h3 class="title-product"><a href="view-product.php?id=' . $row['id'] . '" title="' . $row['name'] . '">' . $name . '</a></h3>
                        <div class="info-price">';

            if (!empty($discount)) {
                $out_put .= ' <span id="price-format-design">Rs: ' . number_format($discount_price, 2) . '</span><span class="unit-display">/' . $row['unit'] . '</span><del>Rs: ' . number_format($price_amount, 2) . '</del>';
            } else {
                $out_put .= '<span id="price-format-design">Rs: ' . number_format($price_amount, 2) . '</span><span class="unit-display">/' . $row['unit'] . '</span> ';
            }

            $out_put .= '</div>';

            if (!empty($discount)) {
                $out_put .= '<div class="percent-saleoff">
                            <span><label>' . $row['discount'] . '%</label> OFF</span>
                            </div>';
            }
            $out_put .= '</div> ';
            $out_put .= '</li> ';
            $BRAND = new Brand($row['brand']);
            $out_put .= ''
                    . '<div class="modal fade" id="modalLoginForm' . $row['id'] . '"tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document"> 
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold"><b>' . $row['name'] . '</b>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </h4>
                        </div>
                        
                        <div class="modal-body mx-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img class="first-thumb" alt="" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"> 
                                        </div>
                                </div>
                                <div class="col-md-8"> 
                                    <p class="text-justify">' . $row['short_description'] . '</p>                                     
                                      <span pull-left> <i class="fa fa-circle"></i> Brand : ' . $BRAND->name . ' </span> </br>
                                      <span pull-right> <i class="fa fa-circle"></i> Unit : ' . $row['unit'] . ' </span></br>
                                          <span pull-right=""> <i class="fa fa-circle"></i> Order Limit : Minimum ' . $row['min_qty'] . ' & Maximum ' . $row['max_qty'] . ' </span><br>
                                        <div class="col-md-6  " id="price-padd">    
                                        
                                            <label>Rs :</label> <span id="price-format-design" > ' . number_format($discount_price, 2) . ' </span>
                                              
                                            <input type="hidden" id="price' . $row['id'] . '" class="price-format total_price_amount" value="' . $discount_price . '"/>
                                        </div>                                        
                                        <div class="col-md-6 "  id="price-padd">                                               
                                        <div class="attr-product">                                            
                                            <div class="input-group">                                             
                                                <input type="number" name="quantity"  min="' . $row['min_qty'] . '" max="' . $row['max_qty'] . '" step="' . $row['min_qty'] . '" id="quantity' . $row['id'] . '"     class=" form-control form-input-design"  value="1"  />
                                            </div>
                                            
                                        </div>                                            
                                     </div>
                                </div>  
                             </div>  
                        </div>
                        
                        <div class="modal-footer d-flex justify-content-center">  
                           <input type="hidden" class="form-control  "   id="product_id" value="' . $row['id'] . '" />
                            <input   type="hidden" name="name"  id="name' . $row['id'] . '" value="' . $row['name'] . '" />
                            <input type="button" class="btn btn-info add_to_cart" name="add_to_cart"  id="' . $row['id'] . '" min-qty="' . $row['min_qty'] . '" max-qty="' . $row['max_qty'] . '" value="   Add to Cart"/>
                           </div>
                    </div>
                </div>
            </div>';
            $out_put .= '</ul> ';
        }

        if (!empty($out_put)) {
            echo $out_put;
        } else {
            echo $out_put = 'No Data Found..!';
        }
    }

    public function getMaxPriceInProduct1($category, $cat, $sub_category, $brand) {
        if ((isset($category) && !empty($category)) || (isset($cat) && !empty($cat))) {
            $cat_list = '';
            foreach ($category as $cat) {
                if (empty($cat_list)) {
                    $cat_list .= $cat;
                } else {
                    $cat_list .= ',' . $cat;
                }
            }

            $query = 'SELECT max(price) FROM `product` WHERE `category` IN (' . $cat_list . ')';

            if (!empty($sub_category)) {
                $query .= 'AND `sub_category` = "' . $sub_category . '"';
            }
            if (!empty($cat)) {
                $query .= ' AND `category` = "' . $cat . '"';
            }

            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= 'AND `brand` in(' . $brand_filter . ')';
            }
        } else {
            $query = 'SELECT max(price) FROM `product`';
        }
        $db = new Database();

        $result = $db->readQuery($query);
        $row = mysql_fetch_array($result);

        return $row;
    }

    public function getMinPriceInProduct1($category, $cat, $sub_category, $brand) {

        if ((isset($category) && !empty($category)) || (isset($cat) && !empty($cat))) {
            $cat_list = '';
            foreach ($category as $cat) {
                if (empty($cat_list)) {
                    $cat_list .= $cat;
                } else {
                    $cat_list .= ',' . $cat;
                }
            }
            $query = 'SELECT min(price) FROM `product` WHERE category IN (' . $cat_list . ')';

            if (!empty($sub_category)) {
                $query .= 'AND `sub_category` = "' . $sub_category . '"';
            }
            if (!empty($cat)) {
                $query .= ' AND `category` = "' . $cat . '"';
            }

            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= 'AND `brand` in(' . $brand_filter . ')';
            }
        } else {
            $query = 'SELECT min(price) FROM `product`';
        }
        $db = new Database();

        $result = $db->readQuery($query);
        $row = mysql_fetch_array($result);

        return $row;
    }

    public function search($category, $keyword, $pageLimit, $setLimit) {

        $w = array();
        $where = '';


        if (!empty($category)) {
            $w[] = "`category` = '" . $category . "' ";
        }
        if (!empty($keyword)) {
            $w[] = "`name` LIKE '%" . $keyword . "%' ";
        }

        if (count($w)) {
            $where = "WHERE " . implode(' AND ', $w);
        }

        $query = "SELECT * FROM `product` $where ORDER BY `queue` ASC LIMIT " . $pageLimit . " , " . $setLimit . "";


        $db = new Database();

        $result = $db->readQuery($query);

        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function showPaginationForSearch($category, $keyword, $per_page, $page) {
        $w = array();
        $where = '';

        if (!empty($category)) {
            $w[] = "`category` = '" . $category . "' ";
        }
        if (!empty($keyword)) {
            $w[] = "`name` LIKE '%" . $keyword . "%' ";
        }

        if (count($w)) {
            $where = "WHERE " . implode(' AND ', $w);
        }

        $page_url = "?";
        $query = "SELECT COUNT(*) as totalCount FROM `product`  $where  ORDER BY `queue` asc";
        $rec = mysql_fetch_array(mysql_query($query));

        $total = $rec['totalCount'];

        $adjacents = "2";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;

        $setLastpage = ceil($total / $per_page);

        $lpm1 = $setLastpage - 1;
        $setPaginate = "";
        if ($setLastpage > 1) {
            $setPaginate .= "<ul class='setPaginate'>";
            $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
            if ($setLastpage < 7 + ($adjacents * 2)) {

                for ($counter = 1; $counter <= $setLastpage; $counter++) {

                    if ($counter == $page)
                        $setPaginate.= "<li><a class='current_page'>$counter</a></li>";
                    else
                        $setPaginate.= "<li><a href='{$page_url}page=$counter&category=$category&keyword=$keyword'>$counter</a></li>";
                }
            }
            elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='{$page_url}page=$counter&category=$category&keyword=$keyword'>$counter</a></li>";
                    }
                    $setPaginate.= "<li class='dot'>...</li>";
                    $setPaginate.= "<li><a href='{$page_url}page=$lpm1&category=$category&keyword=$keyword'>$lpm1</a></li>";
                    $setPaginate.= "<li><a href='{$page_url}page=$setLastpage&category=$category&keyword=$keyword'>$setLastpage</a></li>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $setPaginate.= "<li><a href='{$page_url}page=1&category=$category&keyword=$keyword'>1</a></li>";
                    $setPaginate.= "<li><a href='{$page_url}page=2&category=$category&keyword=$keyword'>2</a></li>";
                    $setPaginate.= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='{$page_url}page=$counter&category=$category&keyword=$keyword'>$counter</a></li>";
                    }
                    $setPaginate.= "<li class='dot'>..</li>";
                    $setPaginate.= "<li><a href='{$page_url}page=$lpm1&category=$category&keyword=$keyword'>$lpm1</a></li>";
                    $setPaginate.= "<li><a href='{$page_url}page=$setLastpage&category=$category&keyword=$keyword'>$setLastpage</a></li>";
                }
                else {
                    $setPaginate.= "<li><a href='{$page_url}page=1&category=$category&keyword=$keyword'>1</a></li>";
                    $setPaginate.= "<li><a href='{$page_url}page=2&category=$category&keyword=$keyword'>2</a></li>";
                    $setPaginate.= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='{$page_url}page=$counter&category=$category&keyword=$keyword'>$counter</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate.= "<li><a href='{$page_url}page=$next&category=$category&keyword=$keyword'>Next</a></li>";
                $setPaginate.= "<li><a href='{$page_url}page=$setLastpage&category=$category&keyword=$keyword'>Last</a></li>";
            } else {
                $setPaginate.= "<li><a class='current_page'>Next</a></li>";
                $setPaginate.= "<li><a class='current_page'>Last</a></li>";
            }

            $setPaginate.= "</ul>\n";
        }

        echo $setPaginate;
    }

}