<?php
session_start();
include("fearless_admin/connection.php");

if (isset($_POST['code']) && isset($_SESSION['cart_item'])) {
    // $rem = $_POST['code'];
    $rem = substr($_POST['code'],1);
    $remtype = substr($_POST['code'],0,1);
    foreach ($_SESSION['cart_item'] as $key=>$cartItem) {
        if ($cartItem["code"] == $rem && $cartItem["type"] == $remtype ) {
            unset($_SESSION['cart_item'][$key]);
        }
    }
    $items = count($_SESSION["cart_item"]);
//            $items = 100000;
    die(json_encode(array('pcode'=>$items)));

}

//                    'name'=>$productid[1],
//                    'code'=>$_POST["serial"],
//                    'image'=>$product_image[4],
//                    'quantity'=>$_POST["quantity"],
//                    'price'=>$productid[2],
//                    'size'=>$_POST["size"]





?>


