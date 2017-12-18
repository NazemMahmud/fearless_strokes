<?php
session_start();
include("fearless_admin/connection.php");
require_once('PHPMailer-master/class.phpmailer.php');

$cust_name= $_POST['customer_name'];
$cust_email= $_POST['customer_email'];
$cust_address= $_POST['customer_address'];
$cust_number= $_POST['customer_number'];

$total =$_POST['finalprice'];
$total = intval($total);

if(isset($_SESSION["cart_item"]) && count($_SESSION["cart_item"])>0 ){
    foreach ($_SESSION["cart_item"] as $item){
        $sql_unit = mysqli_fetch_row(mysqli_query($con, "SELECT UnitID, UnitName FROM product_unit WHERE UnitID='".$item['size']."'"));
        $qty = $item["quantity"];
        $sql = mysqli_fetch_row(mysqli_query($con, "SELECT ProductFullID,SerialNo, Qty from product_details WHERE  SerialNo='".$item["code"]."' AND SUBSTRING(ProductFullID,-2)='".$item["size"]."'"));
        $available = $sql[2] - $qty;
        $sql_update = mysqli_query($con, "UPDATE product_details SET Qty='".$available."' WHERE SerialNo='".$item["code"]."' AND SUBSTRING(ProductFullID,-2)='".$item["size"]."' ");
    }
}
//
$invoice_id = MakeID($con, "purchase_order","order_id","INV-",30);
$date = date('Y-m-d H:i:s');
$sql1="INSERT INTO purchase_order (order_id,customer_name, customer_email,customer_contact,customer_address,total_price, order_date)
	                VALUES('".$invoice_id."','".$cust_name."','".$cust_email."','".$cust_number."','".$cust_address."','".$total."','".$date."')";
$insert = mysqli_query($con, $sql1);



//echo $result=mysqli_query($conn,"INSERT INTO purchase_details(size,price,name,code,cust_email,cust_number,cust_address,cust_name) VALUES('".$size."','".$product_price."','".$product_name."','".$product_code."','".$cust_email."','".$cust_number."','".$cust_name."')");
//$result=mysqli_query($conn,"INSERT INTO purchase_details(size,price,code,cust_email,cust_number,cust_address,cust_name) VALUES ('".$size."','".$product_price."','".$product_code."','".$cust_email."','".$cust_number."','".$cust_address."','".$cust_name."')");
//$email->From = "nazem.mahmud@controln.net"; // thik
//$email->From = $cust_email;
//$email->FromName  = $cust_name;


$email = new PHPMailer(); // thik ase..........................
$email->From = "fearless.strokes@gmail.com"; // thik.......................
$email->FromName = "Fearless Strokes";

$email->AddAddress($_POST['customer_email']);
//$email->AddAddress('sales.fearless.strokes@gmail.com');
//$email->AddAddress("enamulkarim97@gmail.com");

//Send HTML or Plain Text email
$email->isHTML(true); // thik............................................
$email->Subject   = 'Purchase Order'; //thik............................
$id1="logo";
$id2="contact";
$email->addEmbeddedImage('assets/images/logo.png',$id1);
$email->addEmbeddedImage('assets/images/contact.png',$id2);
$msg = '';
$msg.='<html>
            <head>
                <style>
                @media screen and (min-width: 520px) {
                    #parent_div_1{
                        width:49%;float:left;
                    }
                    #parent_div_2{
                        width:49%;float:left;
                    }
                    #p1{
                    font-size: 24px;
                  }
                }
                @media screen and (max-width: 520px){
                  
                }
                    .description{ padding-left: 20px;}
                    .price{ padding-left: 100px;}
                    .quantity{ padding-left: 60px;}
                </style>
            </head>
            <body style="background-color:#eee;">
                <div >';

$msg.=' <div style="margin-left:20px;">
    <img src="cid:'.$id1.'" alt="" height="60" width="150">
</div>
   <p id="p1" style="color:#f57c00;margin: 20px 20px 20px 20px;
    padding-bottom: 10px;
    border-bottom: solid thin #f6f6f6;
    ">Your order #'.$invoice_id.' has been shipped</p>
    
    <p style="margin: 20px 20px 0px 20px;">Dear '.$cust_name.',<br><br>
Your order # '.$invoice_id.' has been shipped and will be delivered within the next 3-5 days. Please prepare exactly ৳ '.$total.' in cash to pay on delivery.</p>
    <p style="width: 560px;margin-left: 20px;margin-right: 20px;font-size: 14px;color: #f57c00;margin-top:25px;margin-bottom:5px;">SHIPPING INFORMATION</p>
    <div style="padding-left:20px;">
      <div id="parent_div_1">
      <div class ="child_div_1" style="float:left">
        <p style="font-weight: bold;font-size: 14px;">Order #: '.$invoice_id.'</p>
          <button style="font-size:12px;background-color:#f57c00;color:#fff;border:none;text-align:center;text-decoration:none;height:20px;width:90%">Order Details</button>
        <p style="line-height:1;font-size: 14px;"><strong>Sold By: </strong>Fearless Strokes</p> 
        <p style="line-height:1;font-size: 14px;"><strong>Payment Mode: </strong>Cash on Delivery</p> 
        <p style="line-height:1;font-size: 14px;"><strong>Expected Delivery Date: </strong> </p>
      </div>
    </div>
    <div id="parent_div_2">
      <div class ="child_div_1" style="float:left;padding:5px;">
       <p style="font-weight: bold;font-size: 14px;">Your order will be shipped to:</p> 
       <p>'.$cust_name.'</p>
       <p>'.$cust_address.'</p>
        <p><strong>Phone: </strong>'.$cust_number.'</p>
      </div>
    </div>
    </div>
      <p style="clear:both;margin-left: 20px;margin-right: 20px;font-size: 14px;color: #f57c00;padding-bottom: 10px;">ORDER INFORMATION</p>
    
<!--    table will go here-->
<div style="overflow-x:auto;">
<table style="margin:20px 20px 0px 20px;">
                <thead >
                <tr class="cart_menu" style="background: #F3F3F3;">
                    <td class="image"><h4>Image</h4></td>
                    <td class="description"><h4>Name/Size</h4></td>
                    <td class="price"><h4>Price</h4></td>
                    <td class="quantity"><h4>Quantity</h4></td>
                    <td class="price"><h4>Sub Total</h4></td>
                    <td class="total"></td>
                </tr>
                </thead>
    <tbody>';



$idx=0;
foreach ($_SESSION["cart_item"] as $item){
    $invoice_idd = MakeID($con, "sales_details","invoiceID","INVD-",30);
    $sql_inv="INSERT INTO sales_details (invoiceID, invoice_id, SerialNo, Qty ,Size, Price,Sub_total)
	                VALUES('".$invoice_idd."','".$invoice_id."','".$item['code']."','".$item['quantity']."','".$item['size']."','".$item['price']."','".$item['price']*$item['quantity']."')";
    $insert_inv = mysqli_query($con, $sql_inv);
}

foreach ($_SESSION["cart_item"] as $item){
    $sql_unit = mysqli_fetch_row(mysqli_query($con, "SELECT UnitID, UnitName FROM product_unit WHERE UnitID='".$item['size']."'"));
    if($item['type']==1){
        $imagepath = 'productimage/'.$item["image"];
    }
    else{
        $imagepath = 'productimage/hj/'.$item["image"];
    }
    
    $email->addEmbeddedImage($imagepath,$idx); // filepath, cid means type of index number

//    <td ><img src="productimage/'.$item["image"].'"</td>
    $msg.='<tr style="border:0;">
                    <td ><img src="cid:'.$idx.'"</td>
                    <td class="description" style="padding-top: 2%; ">
                        <h4>'.$item["name"].'</h4>
                        <p>Size: '.$sql_unit[1].'</p>
                    </td>
                    <td class="price" style="padding-top: 4%;"><h4>'.$item["price"].' Tk</h4></td>
                    <td class="quantity" style="padding-top: 4%;"><h4>'.$item["quantity"].'</h4></td>
                    <td class="price" style="padding-top: 4%;"><h4><strong>'.$item["price"]*$item["quantity"].' Tk</strong></h4></td>
                </tr>';
    $idx = $idx + 1;
}
$msg.='</tbody></table></div>';

//$cnt=count($_SESSION['cart_item']);
//$addprice = 0;
//foreach($_SESSION["cart_item"] as $cartItem)
//{
//    $addprice = $addprice + ($cartItem['price']*$cartItem['quantity']);
//}

$msg.='<p style="padding-left:20px;">Total:
            <span id="subtotal" >'.$total.'</span>
            <span > &nbsp; Tk</span>
        </p>';


$msg.='</div><p style="padding:20px;">Thank you for choosing Fearless Strokes!</p>
    <div style="padding:20px;">
      <img src="cid:'.$id2.'" alt="" style="float:left;margin-right:20px;" height="70" width="70">
      <p><strong>Support</strong><br>Call us on the numbers below<br>+880-1742812044</p>  
    </div></body></html>';
// echo $msg;
$email->Body   = $msg; //thik


$email->Send();

?>
    <script>
        alert("Successfully ordered.! Please Check your email.");
    </script>

<html>
    <head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Fearless Strokes</title>
      <link rel="icon" href="assets/images/logo.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="assets/css/style.css">
<!--
      <style>
          .vertical-product-list a{
              text-decoration-style: none;
              color: #000;
          }
      </style>
-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <style>
            @media screen and (min-width: 520px) {
                #parent_div_1{
                    width:49%;float:left;
                }
                #parent_div_2{
                    width:49%;float:left;
                }
                #p1{
                    font-size: 24px;
                }
            }
            .description{ padding-left: 20px;}
            .price{ padding-left: 100px;}
            .quantity{ padding-left: 60px;}
        </style>
    </head>
    <body>
    	<?php include("header.php"); ?>
        <div class="container">
            <div style="margin-left:20px;">
                <img src="assets/images/logo.png" alt="" height="60" width="150">
            </div>
            <p id="p1" style="color:#f57c00;margin: 20px 20px 20px 20px; padding-bottom: 10px; border-bottom: solid thin #f6f6f6;">
                Your order #<?php echo $invoice_id; ?> has been shipped
            </p>
    
            <p style="margin: 20px 20px 0px 20px;">Dear <?php echo $cust_name; ?>,<br><br>
                    Your order #<?php echo $invoice_id; ?> has been shipped and will be delivered within the next 3-5 days. Please prepare exactly ৳ <?php echo $total; ?> in cash to pay on delivery.
            </p>
            <p style="width: 560px;margin-left: 20px;margin-right: 20px;font-size: 14px;color: #f57c00;margin-top:25px;margin-bottom:5px;">SHIPPING INFORMATION</p>
            <div style="padding-left:20px;">
                <div id="parent_div_1">
                    <div class ="child_div_1" style="float:left">
                        <p style="font-weight: bold;font-size: 14px;">Order #: <?php echo $invoice_id; ?></p>
                          <button style="font-size:12px;background-color:#f57c00;color:#fff;border:none;text-align:center;text-decoration:none;height:20px;width:90%">Order Details</button>
                        <p style="line-height:1;font-size: 14px;"><strong>Sold By: </strong>Fearless Strokes</p> 
                        <p style="line-height:1;font-size: 14px;"><strong>Payment Mode: </strong>Cash on Delivery</p> 
                        <p style="line-height:1;font-size: 14px;"><strong>Expected Delivery Date: </strong> </p>
                    </div>
                </div>
                <div id="parent_div_2">
                    <div class ="child_div_1" style="float:left;padding:5px;">
                        <p style="font-weight: bold;font-size: 14px;">Your order will be shipped to:</p> 
                        <p><?php echo $cust_name; ?></p>
                        <p><?php echo $cust_address; ?></p>
                        <p><strong>Phone: </strong><?php echo $cust_number; ?></p>
                    </div>
                </div>
            </div>
            <p style="clear:both;margin-left: 20px;margin-right: 20px;font-size: 14px;color: #f57c00;padding-bottom: 10px;">ORDER INFORMATION</p>
    
<!--    table will go here-->
            <div style="overflow-x:auto;">
                <table style="margin:20px 20px 0px 20px;">
                    <thead >
                        <tr class="cart_menu" style="background: #F3F3F3;">
                            <td class="image"><h4>Image</h4></td>
                            <td class="description"><h4>Name/Size</h4></td>
                            <td class="price"><h4>Price</h4></td>
                            <td class="quantity"><h4>Quantity</h4></td>
                            <td class="price"><h4>Sub Total</h4></td>
                            <td class="total"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $idx=0;
                            foreach ($_SESSION["cart_item"] as $item){
                                $sql_unit = mysqli_fetch_row(mysqli_query($con, "SELECT UnitID, UnitName FROM product_unit WHERE UnitID='".$item['size']."'"));
                                if($item['type']==1){
                                    $imagepath = 'productimage/'.$item["image"];
                                }
                                else{
                                    $imagepath = 'productimage/hj/'.$item["image"];
                                }
                        ?>
                        <tr style="border:0;">
                            <td ><img src="<?php echo $imagepath;?>" </td>
                            <td class="description" style="padding-top: 2%; ">
                                        <h4><?php echo $item["name"]; ?></h4>
                                        <p>Size: <?php echo $sql_unit[1]; ?></p>
                            </td>
                            <td class="price" style="padding-top: 4%;"><h4><?php echo $item["price"];?> Tk</h4></td>
                            <td class="quantity" style="padding-top: 4%;"><h4><?php echo $item["quantity"];?></h4></td>
                            <td class="price" style="padding-top: 4%;"><h4><?php echo $item["price"]*$item["quantity"];?> Tk</h4></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <p style="padding-left:20px;">Total:
                <span id="subtotal" ><?php echo $total; ?></span>
                <span > &nbsp; Tk</span>
            </p>
            <p style="padding:20px;">Thank you for choosing Fearless Strokes!</p>
            <div style="padding:20px;">
                 <img src="assets/images/contact.png" alt="" style="float:left;margin-right:20px;" height="70" width="70">
                 <p><strong>Support</strong><br>Call us on the numbers below<br>+880-1742812044</p>  
            </div>
        </div>
        
    </body>
</html>

<?php
//header("Location: index.php"); /* Redirect browser */
unset($_SESSION["cart_item"]);
exit();
// http://controlndigital.com:2082/cpsess2996387321/frontend/x3/filemanager/index.html?dirselect=webroot&domainselect=controlndigital.com&dir=%2Fhome%2Fctrlnweb%2Fpublic_html&showhidden=1
?>