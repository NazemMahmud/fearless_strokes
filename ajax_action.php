<?php
session_start();
include("fearless_admin/connection.php");
############# add products to session #########################
if(!empty($_POST["action"])) {
    switch($_POST["action"]) {
        case "add":
            if(!empty($_POST["quantity"])) {
                $productid = mysqli_fetch_row(mysqli_query($con, "SELECT ProductID,ProductName,Price,SerialNo  FROM product_info where SerialNo='".$_POST["serial"]."'"));
                $product_image = mysqli_fetch_row(mysqli_query($con, "SELECT ImageID, ProductID,BigImage,MidImage,SmallImage,SerialNo FROM product_image
                                   WHERE ProductID='".$productid[0]."' AND SerialNo='".$_POST["serial"]."'"));
                $type = 1; 
                $idx = $type.$_POST["serial"].$_POST["size"];
                       
                $itemArray = array($idx=>array(
                                                  'name'=>$productid[1],
                                                  'code'=>$_POST["serial"],
                                                  'image'=>$product_image[4],
                                                  'quantity'=>$_POST["quantity"],
                                                  'price'=>$productid[2],
                                                  'size'=>$_POST["size"],
                                                  'type'=>$type
                                              )
                                  );

                if(!empty($_SESSION["cart_item"])) {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }

        break;
        case "addhj":
            if(!empty($_POST["quantity"])) {
                $productid = mysqli_fetch_row(mysqli_query($con, "SELECT ProductID,ProductName,Price,SerialNo  FROM hj_product_info where SerialNo='".$_POST["serial"]."'"));
                $product_image = mysqli_fetch_row(mysqli_query($con, "SELECT ImageID, ProductID,BigImage,MidImage,SmallImage,SerialNo FROM hj_product_image
                                   WHERE ProductID='".$productid[0]."' AND SerialNo='".$_POST["serial"]."'"));
                $type = 2; 
                $idx = $type.$_POST["serial"].$_POST["size"];
                       
                $itemArray = array($idx=>array(
                                                  'name'=>$productid[1],
                                                  'code'=>$_POST["serial"],
                                                  'image'=>$product_image[4],
                                                  'quantity'=>$_POST["quantity"],
                                                  'price'=>$productid[2],
                                                  'size'=>$_POST["size"],
                                                  'type'=>$type
                                              )
                                  );

                if(!empty($_SESSION["cart_item"])) {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }

        break;    
//        case "remove":
//            if(!empty($_SESSION["cart_item"])) {
//                foreach($_SESSION["cart_item"] as $k => $v) {
//                        if($_POST["code"] == $k)
//                            unset($_SESSION["cart_item"][$k]);
//                        if(empty($_SESSION["cart_item"]))
//                            unset($_SESSION["cart_item"]);
//                }
//            }
//            $items = count($_SESSION["cart_item"]);
//            $items = 100000;
//            die(json_encode(array('pcode'=>$items)));
//        break;
        case "empty":
            unset($_SESSION["cart_item"]);
        break;
    }
    $total_items = count($_SESSION["cart_item"]); //count total items
    die(json_encode(array('items'=>$total_items))); //output json
}

?>
<?php
################## list products in cart ###################

?>
<!--                                  <ul class="dropdown-menu dropdown-cart dropdown-content" role="menu">-->
<!--                                      --><?php
//                                      if(count($_SESSION["cart_item"])>0)
//                                      {
//                                           foreach ($_SESSION["cart_item"] as $item){
//                                      ?>
<!--                                          <li>-->
<!--                                              <span class="item">-->
<!--                                                <span class="item-left">-->
<!--                                                    <img src="productimage/--><?php //echo $item["image"];?><!--" alt="" style="width:50px; height:50px;"/>-->
<!--                                                    <span class="item-info">-->
<!--                                                        <span>--><?php //echo $item["name"];?><!--</span>-->
<!--                                                        <span>--><?php //echo $item["price"]*$item["quantity"];?><!--tk</span>-->
<!--                                                        <span>Qty: --><?php //echo $item["quantity"];?><!--</span>-->
<!--                                                    </span>-->
<!--                                                </span>-->
<!--                                                <span class="item-right">-->
<!--                                                    <button class="btn btn-xs btn-danger pull-right" onclick="singleCartRemove('remove')">x</button>-->
<!--                                                </span>-->
<!--                                            </span>-->
<!--                                          </li>-->
<!--                                      --><?php //}
//                                      }
//                                      ?>
<!--

                                      <li>
                                          <span class="item">
                                            <span class="item-left">
                                                <img src="assets/images/product/the-unicorn-is-reading-bags50-50.jpg" alt="" />
                                                <span class="item-info">
                                                    <span>Item name</span>
                                                    <span>23$</span>
                                                </span>
                                            </span>
                                            <span class="item-right">
                                                <button class="btn btn-xs btn-danger pull-right">x</button>
                                            </span>
                                        </span>
                                      </li>
-->
<!--                                      <li class="divider"></li>-->
<!--                                      <li><a class="text-center" href="">View Cart</a></li>-->
<!--                                  </ul>-->
