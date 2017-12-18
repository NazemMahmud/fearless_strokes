<?php
session_start();
include("fearless_admin/connection.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Fearless Strokes | Cart</title>

    <link rel="icon" href="assets/images/logo.png" type="image/png" sizes="16x16">
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <style>
        .drpdwn{
            width: 100%;
            height:30px;
            border-radius: 4%;
            margin-bottom: 10px;
        }
        .drpdwn option{
            font-weight: bold;
        }
    </style>

    <script>
//        $( "#chksubmit" ).click(function() {
//            var shipcost = document.getElementById("shippingCost").value;
//            if(document.getElementById("totalshipcost").value=='')
//            {
//                alert( "Please, insert shipping area" );
//            }
//            else{
//                $("#submit1").submit();
//            }
//
//        });
        function check() {
            if(document.getElementById('totalshipcost').value=='')
            {
                alert('Please, Select shipping area');
                return false;
            }
            else{}
        }

        function costFunction(cost, e) {
            var costt = +cost;
            typeof(costt);

            var subtotal = +document.getElementById("subtotal").innerHTML;
//            var available = +document.getElementById("showavailable").value;
            typeof(subtotal);
            document.getElementById("shippingCost").value = costt; // on click e ei shipping cost ta ashbe
            document.getElementById("Total").value = costt+subtotal; //// on click e ei total cost ta ashbe

            document.getElementById("totalshipcost").value = costt;
            document.getElementById("totaltext").value = costt+subtotal; // eta next page e pathabo

//            alert(costt+subtotal);
            $.ajax({
                type: "POST",
            }).done(function(){ //on Ajax success

                $("#shippingCost").html(cost); //total items in cart-info element
                $("#Total").html(costt+subtotal); //total items in cart-info element
            })

        }
    </script>
</head>
<body>
<?php include("header.php"); ?>

<div class="container">
    <!--
            <div class="row">
                 <div class="col-md-8">
                       <div class="row top-left-message" >
                        <div class="col-sm-3">
                            <button class="btn btn-sm">T-SHIRTS <i class="fa fa-chevron-right"></i></button>
                        </div>
                        <div class="col-sm-6">
                            <h5>WIN UP TO 60%</h5>
                        </div>
                        <div class="col-sm-3">
                             <button class="btn btn-sm pull-right">MUGS <i class="fa fa-chevron-right"></i></button>
                        </div>
                       </div>
                 </div>

                 <div class="col-md-4">
                       <div class="row top-right-message">
                        <strong>FREE DELIVERY</strong>
                            WORLDWIDE*
                            <br>
                            *MORE INFO HERE ›
                       </div>
                 </div>
            </div>
    -->

    <div class="row clearfix">
        <div class="col-sm-12 bar2 ">
            Find your favourite arts here
            <div class="divider"></div>
        </div>
    </div>

    <div class="row" style="margin-top:15px;">

        <div class="col-md-12">
            <div class="col-sm-12 creative">
                <h1 class="heading" style="font-size:22px;line-height: 8px;letter-spacing: normal; margin-top: 10px;margin-bottom: 4px;">View Cart</h1>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="col-md-12 table-responsive">
            <?php
            if(isset($_SESSION["cart_item"]) && count($_SESSION["cart_item"])>0 ){ ?>
                <table class="table table-condensed" style="">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image"><h4>Image</h4></td>
                        <td class="description"><h4>Name/Size</h4></td>
                        <td class="description"><h4>Price</h4></td>
                        <td class="quantity"><h4>Quantity</h4></td>
                        <td class="price"><h4>Product Sub Total</h4></td>

                        <td class="total"></td>

                    </tr>
                    </thead>
                    <tbody>
<!--                <ul  style="list-style-type: none;">-->
                    <?php
                        foreach ($_SESSION["cart_item"] as $item){
                            $sql_unit = mysqli_fetch_row(mysqli_query($con, "SELECT UnitID, UnitName FROM product_unit WHERE UnitID='".$item['size']."'"));
                            ?>
                                <tr style="border:0;">

                                    <td class="cart_product">
                                        <?php
                                            if($item['type']==1){ ?>
                                                <a href=""><img src="productimage/<?php echo $item["image"];?>" alt=""/></a>
                                          <?php  }
                                            else{ ?>
                                                <a href=""><img src="productimage/hj/<?php echo $item["image"];?>" alt=""/></a>
                                          <?php  } ?>
                                        
                                    </td>
                                    <td class="cart_description" style="padding-top: 2%;">
                                        <h4><a href=""><?php echo $item["name"];?></a></h4>
                                        <p>Size: <?php echo $sql_unit[1];?></p>
                                    </td>
                                    <td class="cart_total" style="padding-top: 4%;">
                                        <h4 class="cart_total_price" ><?php echo $item["price"];?> Tk</h4>
                                    </td>

                                    <td class="cart_quantity" style="padding-top: 4%;">
                                        <div class="cart_quantity_button">
<!--                                            <a class="cart_quantity_up" href=""> + </a>-->
<!--                                            <input class="cart_quantity_input" type="text" name="quantity" value="--><?php //echo ' '.$item["quantity"];?><!--" autocomplete="off" size="2">-->
<!--                                            <h5>--><?php //echo $item["quantity"];?><!-- </h5>-->
                                                <h4 class="cart_total_price" ><?php echo $item["quantity"];?></h4>
<!--                                            <a class="cart_quantity_down" href=""> - </a>-->
                                        </div>
                                    </td>
                                    <td class="cart_total" style="padding-top: 4%;">
                                        <h4 class="cart_total_price" ><?php echo $item["price"]*$item["quantity"];?> Tk</h4>
                                    </td>
                                    <td class="cart_delete" style="padding-top: 4%;">
                                        <a class="cart_quantity_delete singleCartRemove" data-code="<?php echo $item['type'].$item['code'];?>" href=""><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                        <?php }
                     ?>
                    </tbody>
                </table>
            <?php  }
            ?>
        </div>
        <div class="col-md-6 col-md-offset-6 col-sm-6">
            <div class="total_area">
                <form action="checkout" method="post" id="submit1">
                    <ul>
                        <?php
                        $cnt=count($_SESSION['cart_item']);
                        $addprice = 0;
                        foreach($_SESSION["cart_item"] as $cartItem)
                        {
                            $addprice = $addprice + ($cartItem['price']*$cartItem['quantity']);
                        }
                        ?>
                        <li>Cart Sub Total
                            <span > &nbsp; Tk</span>
                            <span id="subtotal" ><?php echo $addprice;?> </span>
                        </li>
                        <li>Shipping
                            <span>
                            <?php
                            $sql_cost = mysqli_query($con, "SELECT * from shipping_cost");
                            while ($row = mysqli_fetch_row($sql_cost))
                            {?>
                                <label class="radio-inline">
                                        <input type="radio" name="shippingcost" id="shippingcost" onclick="costFunction(this.value, event)" value="<?php echo $row[2];?>">
                                    <?php echo $row[1];?>
                                    </label>
                            <?php }
                            ?>
                        </span>
                        </li>
                        <li>Shipping Cost<span id="shippingCost"></span></li>
                        <li>Total
                            <span > &nbsp; Tk</span>
                            <span name="totalcost" id="Total" ><?php echo $addprice;?> </span>
                        </li>
                    </ul>
                    <!--                <a class="btn btn-default update" href="">Update</a>-->
                    <input type="hidden" name="hiddenshipcost" id="totalshipcost">
                    <input type="hidden" name="text" id="totaltext">
                    <button class="btn btn-default check_out" type="submit" name="chksubmit" id="chksubmit" onclick="return check()">Place Order</button>

                </form>

            </div>
        </div>

    </div>


    </div>
<!--</div>-->
<!--</div>-->




    <div class="container">
        <?php include("footer.php"); ?>
    </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap-select.js" /></script>
    <script src="assets/js/singleCartDelete.js"></script>

    <script type="text/javascript" src="assets/js/plugin.js"></script>

</body>
</html>
