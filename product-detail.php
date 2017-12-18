<?php
session_start();
header("Cache-Control: no-cache");
header("Pragma: no-cache");
include('fearless_admin/connection.php');
$cat_id = $_REQUEST["CatId"];
$sql = mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName,CategoryDescrition  from product_category_info where CategoryID='".$cat_id."' "));


$product_id = $_REQUEST["Productid"];
$sql_product = mysqli_fetch_row(mysqli_query($con, "SELECT ProductID,ProductName,Features, orderid,ActiveStatus,Price,ShippingCost,SerialNo,Discount 
                               FROM product_info
                               WHERE SerialNo='".$_REQUEST["Serial"]."' AND ProductID='".$product_id."' "));

$sql_productfullid = mysqli_query($con, "SELECT ProductFullID,SerialNo,Qty
                               FROM product_details
                               WHERE SerialNo='".$_REQUEST["Serial"]."' ");

//for size 
//$sql_size=
//for image
$sqlimage = mysqli_fetch_row(mysqli_query($con, "SELECT ImageID, ProductID,BigImage,MidImage,SmallImage,SerialNo
                               FROM product_image
                               WHERE ProductID='".$product_id."' AND SerialNo='".$_REQUEST["Serial"]."'"));
                                
// for artist name
$artistid = substr($product_id[0],-4);
$sqlartist = mysqli_fetch_row( mysqli_query($con, "SELECT id, artist_name FROM artist WHERE id='".$artistid."' "));
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Fearless Strokes</title>
      <link rel="icon" href="assets/images/logo.png" type="image/png" sizes="16x16">
<!--      for slick start-->
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
<!--	for slick end-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
      <script src="assets/js/jquery-3.2.1.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
      
<!--      <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.3.11/slick.css"/>-->
  	
    <style>
        .title h2 {
            font-weight: 700;
            font-size: 100%;
            text-transform: uppercase;
        }
        .multiple-items{
            margin-left: 30px;
            margin-right: 30px;
        }
         .multiple-items h3{
            font-weight: 300;
            font-size: 100%;
            text-transform: uppercase;
        }
/*
        .multiple-items img{
            width: 145px;
        }
*/
        .recent_view img{
            max-width: 125px;
            max-height: 125px;
        }
        .slick-prev{ left: -30px;}
        .slick-next{ right: 0px;}
        
        .slick-prev:before, .slick-next:before {
            font-family: "Glyphicons Halflings", "slick", sans-serif;
            font-size: 30px;
            line-height: 1; 
            color: #d5d5d5; 
/*
            opacity: 0.75; 
            -webkit-font-smoothing: antialiased; 
            -moz-osx-font-smoothing: grayscale; 
*/
        }
        
        .slick-prev:before { content: "\e079";}
        .slick-next:before { content: "\e080";}
                

      
 
    </style>
      <script>
          $(document).ready(function(){
              $("#bagadd").click(function() {
                  
              })
              
          });
      </script>
      <script type="text/javascript">
          function all_check(action, productid){ // from 262 line
              var product_id = productid;
              if(document.getElementById("showsize").value==""){
                 alert("Please Select size");
                  return false;
              }
              else if(document.getElementById("quantity").value==""){
                      alert("Please Select Quantity");
                      document.getElementById("quantity").focus();
                      return false;
              }

              else{
                  var qtyid = +document.getElementById("quantity").value;
                  typeof(qtyid);
                  var available = +document.getElementById("showavailable").value;
                  typeof(available);
                  if(qtyid > available ){
//                          var available = document.getElementById('showavailable').value;
//                          alert("Sorry,  "+ document.getElementById("quantity").value);
                          alert("Sorry, Available Quantity is "+ available);
                          return false;
                    }
                  }
//              }
//              alert ("kaj kore");
//              cartAction(action, product_id);
              var serial = document.getElementById("showserial").value;
              var size = document.getElementById("showsize").value;
              var qty = document.getElementById("quantity").value;
//              alert('2nd'+product_id+action+serial+'size'+size);

              var queryString = "";
              if(action != "") {
                  switch(action) {
                      case "add":
                          queryString = 'action='+action+'&code='+ product_id+'&serial='+serial+'&quantity='+qty+'&size='+size;
//                          alert(queryString);
                          break;
//                      case "remove":
//                          alert("working");
//                          queryString = 'action='+action+'&code='+ product_code;
//                          break;
                      case "empty":
                          queryString = 'action='+action;
                          break;
                  }
              }
              $.ajax({ //make ajax request to ajax_action
                  url: "ajax_action.php",
                  type: "POST",
                  dataType:"json", //expect json value from server
                  data: queryString
              }).done(function(data){ //on Ajax success
//                  alert("success");
                  $("#cartcount").html(data.items); //total items in cart-info element
                  location.reload();

              });
              
//              e.preventDefault();
//              $("#shopping-cart-results" ).load( "cart_process.php", {"load_cart":"1"});
//              $("#shopping_cart_results" ).load( "ajax_action.php", {"load_cart":"1"});
          }
          function get_availble(serial)
          {
              document.getElementById('showserial').value = serial;
              var size_n_available = document.getElementById('product_size').value;
//              alert(size_n_available);
              document.getElementById('showsize').value = size_n_available.substring(0,2) ; // substring e last e j position thakbe oita bad jabe, index 0 theke start hoy
              document.getElementById('showavailable').value = size_n_available.substring(2) ; // substring e last e j position thakbe oita bad jabe, index 0 theke start hoy
//              alert(document.getElementById('showavailable').value);
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
          	<div class="col-md-5 col-sm-6">
<!--
            	<ul id="thumb-group">
                    <li>
                        <a href="javascript:void(0)" class="thumbnail" data-src="assets/images/product/single/image1.jpg"><img src="assets/images/product/single/thumbs/image1.jpg" alt=""></a>  	
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="thumbnail" data-src="assets/images/product/single/image2.jpg"><img src="assets/images/product/single/thumbs/image2.jpg" alt=""></a>  	
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="thumbnail" data-src="assets/images/product/single/image3.jpg"><img src="assets/images/product/single/thumbs/image3.jpg" alt=""></a>  	
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="thumbnail" data-src="assets/images/product/single/image4.jpg"><img src="assets/images/product/single/thumbs/image4.jpg" alt=""></a>  	
                    </li>
                </ul>
-->
                
                <div id="view-thumb">
                    <img id="theImg" class="my-foto img-responsive" src="productimage/<?php echo $sqlimage[2]?>" data-large="productimage/<?php echo $sqlimage[2]?>" title="">
                </div>
            </div>
            
           	<div class="col-md-7 col-sm-6">
            	 <div class="productHeader container-fluid">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2><?php echo $sql_product[1]?></h2>

                        </div>
                        <div class="col-sm-4">
                            <!--<div class="price">-->
                            <?php if($sql_product[8]<=0){ ?>
                                <p style="padding-top: 26px; padding-right:10px; font-family: Helvetica; color:#999; font-size:17px;" class="pull-right">
                                    Tk <?php echo $sql_product[5]?>
                                </p> <!-- price -->
                            <?php }else if($sql_product[8]>0){
                                $main = $sql_product[5];
                                $discount = $sql_product[8]/100;
                                $discount = $main * $discount;
                                $main = $main - $discount;
                                ?>
                                <p style="padding-top: 26px; padding-right:10px; font-family: Helvetica; color:#999; font-size:17px;" class="pull-right">Tk
                                    <span style="text-decoration: line-through; color: red; "><span style="color: #999;"> <?php echo $sql_product[5];?></span></span>
                                    <?php echo $main; ?>
                                </p> <!-- price -->
                            <?php } ?>

                           <!-- </div>-->
                            <div class="clearfix"></div>
                            <!--<div class="itemNumber pull-right">662-727</div>-->
                        </div>
                    </div>
                </div>                    
                
                <div class="row">
                	<div class="col-sm-6 col-sm-offset-3">
                    	<form action="" method="">
                    		<div class="form-group">
                            	<select id="product_size" name="product_size" class="form-control" onchange="get_availble(<?php echo $_REQUEST["Serial"] ?>)" required>
                                    <option value="-1">Select Size</option>
                                    <?php
                                        while($row=mysqli_fetch_row($sql_productfullid)){
                                            $sql_size= mysqli_fetch_row(mysqli_query($con,"SELECT UnitID, UnitName FROM product_unit WHERE UnitID='".substr($row[0],-2)."'")); 
//                                            if($cat_id=)
                                            ?>
                                                <option value="<?php echo $sql_size[0].$row[2]; ?>"><?php echo $sql_size[1]; ?></option>
                                    <?php
                                        }
                                    ?>

                             	</select>
                                <input class="form-control" id="showsize" name="showsize" placeholder="show size" type="hidden">
                                <input class="form-control" id="showavailable" name="showavailable" placeholder="show Quantity" type="hidden">
                                <input class="form-control" id="showserial" name="showserial" placeholder="show serial" type="hidden">
                            </div>
                            <div class="form-group">
                                <?php
                                
//                                $sql_available = mysqli_fetch_row(mysqli_query($con, "SELECT ProductFullID,SerialNo,Qty, Available FROM product_details WHERE SerialNo='".$_REQUEST["showquantity"]."' "));
                                ?>
                            	
                            	<input class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" type="text">
                            </div>
                            
                            <a class="btn btn-success btn-block" id="bagadd" onclick="return all_check('add', '<?php echo $product_id;?>');"><i class="fa fa-cart-plus"></i> Add To Bag</a>

                            <input class="btn btn-success btn-block" id="forsubmit" type="hidden">
                            
                    	</form>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tabbable-panel">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs ">
                                    <li class="active">
                                        <a href="#tab_default_1" data-toggle="tab">ABOUT THIS PRODUCT</a>
                                    </li>
                                    <li>
                                        <a href="#tab_default_2" data-toggle="tab">ABOUT THIS CATEGORY</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_default_1">
                                        <p>Product.</p>
                                        <p> <?php echo $sql_product[2];?> </p>
                                    </div>
                                    <div class="tab-pane" id="tab_default_2">
                                        <p> Category </p>
                                        <p>
                                            <?php 
                                           $desc =  mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName,CategoryDescrition  from product_category_info where CategoryID='".$cat_id."' "));
                                            echo $desc[1];?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
           	</div>
<!--
           <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <h2>Also available as</h2>
                        </div>
                        <div class="multiple-items">
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/aaa/flower-heart-spring-framed-prints.jpg" class="img-responsive"></a>

                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/aaa/flower-heart-spring-bath-mats.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/aaa/flower-heart-spring-metal-travel-mugs.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/aaa/flower-heart-spring-notebooks.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/aaa/flower-heart-spring-prints.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/aaa/flower-heart-spring-tapestries.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/aaa/flower-heart-spring-vneck-tshirts.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/aaa/nevertheless-she-persisted260283-pillows.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/aaa/flower-heart-spring-framed-prints.jpg" class="img-responsive"></a>
                            </div>
                        </div>
                    </div>
            </div>
            
            <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <h2>More from this artist</h2>
                        </div>
                        <div class="multiple-items">
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/more/dna-piano-tshirts.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/more/feed-me-and-tell-me-im-pretty-bear-tshirts.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/more/furr-division-cats-tshirts.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/more/furr-division-cats-tshirts.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/more/how-to-train-your-human-uyi-tshirts.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/more/love-space157634-tshirts.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/more/traveling-lens-tshirts.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/more/world-domination-for-cats-6wz-tshirts.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/aaa/flower-heart-spring-framed-prints.jpg" class="img-responsive"></a>
                            </div>
                        </div>
                    </div>
            </div>
            
            <div class="row" style="margin-bottom:10px;">
                    <div class="col-md-12">
                        <div class="title">
                            <h2>Recently viewed</h2>
                        </div>
                        <div class="multiple-items recent_view">
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/because-sloths-1yv-mugs.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/good-morning-i-see-the-assassins-have-failed-mugs.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/nevertheless-mugs.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/tea-baggin-mugs.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/the-unicorn-is-reading-bags.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/all-we-need-6ds-tshirts.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/botanic-wars-mugs.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/frida-floral-notebooks.jpg" class="img-responsive"></a>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <a href="#"><img src="assets/images/product/fabric-of-life-alternative-tshirts.jpg" class="img-responsive"></a>
                            </div>
                        </div>
                    </div>
            </div>
-->
        </div>
    </div>
      
    <div class="container">
    	<?php include("footer.php"); ?>
    </div>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/bootstrap/js/bootstrap-select.js"></script>
<!--      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
<!--      for slick start-->
      <script src="assets/js/zoomsl-3.0.min.js"></script>
      <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
      <script type="text/javascript" src="slick/slick.min.js"></script>
      <script src="assets/js/singleCartDelete.js"></script>
<!--      for slick end-->
  
      <script>
		$(document).ready(function(){
//            for slick start
            $('.multiple-items').slick({
                infinite: true,
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                
            });
//            for slick end
            
			$('#thumb-group a').on({
				'click': function(){
					
					var imgSrc = $(this).attr('data-src');
					
					$('#theImg').attr('src',imgSrc);
					$('#theImg').attr('data-large',imgSrc);
					
				}
			});
		
			// если отсутсвует zoomsl-3.0.min.js
			if(!$.fn.imagezoomsl){
			
				$('.msg').show();
				return;
			}
			 else $('.msg').hide();
		
			 
			// инициализация плагина
			$('.my-foto').imagezoomsl({ 
		
				 zoomrange: [1, 12],
				 zoomstart: 4,
				 innerzoom: true,
				 magnifierborder: "none"	
			});  
		});
        
        
	</script>
     
    <script type="text/javascript" src="assets/js/plugin.js"></script>
    
  </body>
</html>