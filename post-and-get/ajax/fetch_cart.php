<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
//featch_cart
session_start();
$delivery_charge = DefaultData::getDeliveryCharges();
$product = 0;
$quantity = 0;
$total_item = 0;
$total_price = 0;
$output = '';
$cart = '';

$output .= '<table class="table table-bordered">'
    . '<thead>'
    . '<tr>'
    . '<th scope="col">Product</th>'
    . '<th scope="col">Name</th>'
    . '<th scope="col">Unit Price</th>'
    . '<th scope="col">Quantity</th>'
    . '<th scope="col">Total</th>'
    . '</tr>'
    . '</thead>'
    . '<tbody>';
// unset($_SESSION["shopping_cart"]);
if (!empty($_SESSION["shopping_cart"])) {

    foreach ($_SESSION["shopping_cart"] as $key => $value) {
        $PRODUCT = new Product($value["product_id"]);


        $name =  $value["product_name"];
        $image_name = $PRODUCT->image_name;
        $p_id = $PRODUCT->id;
        $min_qty = $PRODUCT->min_qty;
        $max_qty = $PRODUCT->max_qty;
        $unit = $PRODUCT->unit;

        // dd($value["product_price"]);
        $output .= '<tr">'
            . '<td class="product-thumbnail"><a href="product.php?id=' . $p_id . '">'
            . '<img src="upload/product-categories/sub-category/product/photos/' . $image_name . '" alt="' . $PRODUCT->name . '" title="' . $PRODUCT->name . '" />'
            . '</a></td>'
            . '<td class="product-name"><a href="product.php?id=' . $p_id . '">' . $name . '</a></td>'
            . '<td class="product-price"><span class="unit-amount">Rs: ' . number_format($value["product_price"], 2) . '</span>'
            . '<td class="product-quantity"><div class="input-counter quantity">'
            . '<input type="number" name="quantity" size="1" class="form-control quantity qty-input" id="quantity' . $PRODUCT->id . '" min="' . $min_qty . '" max="' . $max_qty . '" step="' . $min_qty . '" product_id=' . $value["product_id"] . ' value="' . $value["product_quantity"] . '" />'
            . '</div></td>'
            . '<td class="product-subtotal">Rs: ' . number_format($value["product_quantity"] * $value["product_price"], 2)
            . '<a href="#" class="remove">'
            . '<button type="button" data-toggle="tooltip" title="Remove" class="btn btn-danger delete" name="delete" id="' . $value["product_id"] . '"><i class="bx bx-trash"></i></button>'
            . '</a>'
            . '</td>'
            . '<input type="hidden" class="form-control  "  product_id="' . $value["product_id"] . '" /> '
            . '<input type="hidden" class="form-control" id="price" name="price" value="' . $value["product_price"] . '"/>'
            . '<input type="hidden" class="form-control max"   value="' . $unit . '"/>'
            . '</tr>';

        $total_price = $total_price + ($value["product_quantity"] * $value["product_price"]);
        $total_item = $total_item + 1;
    }
    $output .= '</tbody>';
} else {
    $output .= '<tr>'
        . '<td colspan="5" align="center" class="product-remove">'
        . 'Your Cart is Empty!.'
        . '</td>'
        . '</tr>';
}
$output .= '<input type="hidden" class="form-control" id="total_price"   value="' . $total_price . '"/>';
$output .= '</tfooter>';
$output .= '</table>';
$tot1 = 0;
$items = 0;
$more_items = '';
if (!empty($_SESSION["shopping_cart"])) {
    foreach ($_SESSION["shopping_cart"] as $key1 => $product1) {
        $PRODUCT1 = new Product($product1['product_id']);
        $price1 = $product1['product_quantity'] * $product1['product_price'];
        $tot1 += $price1;
        $items += 1;

        if ($key1 < 3) {

            $cart .= '<tr>'
                . '<td class="text-center" style="width:70px">'
                . '<a href="#"> <img src="upload/product-categories/sub-category/product/photos/' . $PRODUCT1->image_name . '" style="width:70px" alt="' . $PRODUCT1->name . '" title="' . $PRODUCT1->name . '" class="preview"> </a>'
                . '</td>'
                . '<td class="text-left"> <a class="cart_product_name" href="product.php?id=' . $PRODUCT1->id . '">' . $PRODUCT1->name . '</a> </td>'
                . '<td class="text-center"> x' . $product1["product_quantity"] . ' </td>'
                . '<td class="text-center">Rs. ' . number_format($price1, 2) . '</td>'
                . '</tr>';
        }
    }
}
// dd($output);
//if ($items > 3) {
//    $more_items .= $items - 3 . ' more items.';
//}
$final = $tot1 + $delivery_charge;
$data = array(
    'cart_details' => $output,
    'cart_box' => $cart,
    'total_item' => $total_item,
    'total_price' => number_format($tot1, 2),
    'final' => number_format($final, 2)
    //    'more_items' => $more_items
);
// dd($data);
echo json_encode($data);
