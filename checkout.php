<?php
session_start();
include("fearless_admin/connection.php");
//echo $_POST["text"]; // this is total cost from prev page
//echo $_POST["hiddenshipcost"]; // this is total cost from prev page
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>

        function costFunction(cost, e) {
            var costt = +cost;
            typeof(costt);
            document.getElementById("shippingCost").value = costt;
//            var action = 'loaddata';
            var subtotal = +document.getElementById("subtotal").innerHTML;
//            var available = +document.getElementById("showavailable").value;
            typeof(subtotal);
            document.getElementById("Total").value = cost+subtotal;
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
                <h1 class="heading" style="font-size:22px;line-height: 8px;letter-spacing: normal; margin-top: 10px;margin-bottom: 4px;">Checkout</h1>
            </div>
            <div class="clearfix"></div>
        </div>

        <form style="margin-top: 9%" action="final_submit_mail" method="post">
                <div class="col-md-12">
                    <div class="col-md-8" style="background: #ebebeb; padding-top: 10px; padding-bottom: 10px; margin-right: 15px;">
                        <!--                Name -->
                        <div class="col-md-8  col-sm-8" style="margin-bottom: 10px;">

                            <div class="col-md-2 col-sm-2" >
                                <label for="name" class="">Name</label>
                            </div>
                            <div class="col-md-5 col-sm-5">
                                <input type="text" name="customer_name" class="form-control" id="" placeholder="Enter Full Name" required>
                            </div>

                        </div>
                        <!--                Email -->
                        <div class="col-md-8  col-sm-8" style="margin-bottom: 10px;">

                            <div class="col-md-2 col-sm-2">
                                <label for="email" class="">Email</label>
                            </div>
                            <div class="col-md-7 col-sm-7">
                                <input type="email" name="customer_email" class="form-control" id="" placeholder="Enter Email" required>
                            </div>

                        </div>

                        <!--     Contact                   -->
                        <div class="col-md-8  col-sm-8" style="margin-bottom: 10px;">

                            <div class="col-md-2 col-sm-2" style="float: left">
                                <label for="phone" class="">Contact</label>
                            </div>
                            <div class="col-md-5 col-sm-5">
                                <input type="text" name="customer_number" class="form-control" id="" placeholder="Enter Contact No." required>
                            </div>

                        </div>

                        <!--      Address                   -->
                        <div class="col-md-8  col-sm-8" style="margin-bottom: 10px;">

                            <div class="col-md-2 col-sm-2">
                                <label for="address" class="">Delivary Address</label>
                            </div>
                            <div class="col-md-7 col-sm-7">
                                <textarea required name="customer_address" cols="55" rows="5"></textarea>
                            </div>

                        </div>
                        <input type="hidden"; name="finalprice" value="<?php echo $_POST['text']?>">
                        <div class="col-md-10" style="margin-top: 20px;">
                            <div class="col-md-1 col-md-offset-3 "><input type="button" class="btn btn-primary" value="  Back  "></div>
                            <div class="col-md-1 col-md-offset-2 "><button class="btn btn-success">Place Order</button></div>

                        </div>
                    </div>
                    <div class="col-md-3 cart_info_area">
                        <?php $count = count($_SESSION['cart_item']);?>
                         <p><span class="priceLabel" style="color: #ec1111;">Cart Items:</span><span class="pull-right" name="totalitem"><?php echo $count;?></span></p>
                         <hr>
                         <p><span class="priceLabel" style="color: #ec1111;">Shipping Cost:</span><span class="pull-right" name="shippingcost"><?php echo $_POST['hiddenshipcost'];?></span></p>
                         <hr>
                         <p><span class="priceLabel" style="color: #ec1111;">Total:</span><span class="pull-right" name="totalprice"><?php echo $_POST['text'];?></span></p>


                    </div>
                </div>

        </form>
    </div>
    </div>


</body>
</html>
