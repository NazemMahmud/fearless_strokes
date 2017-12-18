<?php
    session_start();
    include("fearless_admin/connection.php");
    $msg='';

    $msg='<html>
            <head>
                <style>
                    .description{ padding-left: 20px;}
                    .price{ padding-left: 100px;}
                    .quantity{ padding-left: 60px;}
                </style>
            </head>
            <body>
                <div >';


     $msg.=' <table style="background: gray">
                <thead>
                <tr class="cart_menu">
                    <td class="image"><h4>Image</h4></td>
                    <td class="description"><h4>Name/Size</h4></td>
                    <td class="price"><h4>Price</h4></td>
                    <td class="quantity"><h4>Quantity</h4></td>
                    <td class="price"><h4>Sub Total</h4></td>
                    <td class="total"></td>
                </tr>
                </thead>
                <tbody>';
            foreach ($_SESSION["cart_item"] as $item){
                $sql_unit = mysqli_fetch_row(mysqli_query($con, "SELECT UnitID, UnitName FROM product_unit WHERE UnitID='".$item['size']."'"));
                $msg.='<tr style="border:0;">
                    <td ><img src="productimage/'.$item["image"].'"</td>
                    <td class="description" style="padding-top: 2%; ">
                        <h4>'.$item["name"].'</h4>
                        <p>Size: '.$sql_unit[1].'</p>
                    </td>
                    <td class="price" style="padding-top: 4%;"><h4>'.$item["price"].' Tk</h4></td>
                    <td class="quantity" style="padding-top: 4%;"><h4>'.$item["quantity"].'</h4></td>
                    <td class="price" style="padding-top: 4%;"><h4>'.$item["price"]*$item["quantity"].' Tk</h4></td>
                </tr>';
            }
            $msg.='</tbody></table>';

        $cnt=count($_SESSION['cart_item']);
        $addprice = 0;
        foreach($_SESSION["cart_item"] as $cartItem)
        {
            $addprice = $addprice + ($cartItem['price']*$cartItem['quantity']);
        }

        $msg.='<p>Total:
            <span id="subtotal" >'.$addprice.'</span>
            <span > &nbsp; Tk</span>
        </p>';
    $msg.='</div></body></html>';

    echo $msg;
?>
