<?php
session_start();
if(empty($_SESSION["product"]))
$_SESSION["product"]=0;
  require_once("rollout_admin/connection.php");
  
  $cat = mysqli_fetch_row(mysqli_query($con, "SELECT SUBSTR(ProductID,3,1) FROM product_info
   WHERE SerialNo=".$_REQUEST["sl"]." ORDER BY ProductID DESC LIMIT 1"));
                                        $product_details_info = mysqli_fetch_array(mysqli_query($con, "SELECT
																product_info.SerialNo 'SerialNo'
																, product_info.ProductID 'ProductID'
																, product_info.ProductName 'ProductName'
																, product_info.Brand 'Brand'
																, product_info.Price 'Price'
																, product_info.Collectibles 'Collectibles'
																, product_info.Discount 'Discount'
														, (product_info.Price-((product_info.Discount/100)*product_info.Price)) 'ActualPrice'
														        , product_info.Features 'Features'
															FROM product_info WHERE SerialNo=".$_REQUEST["sl"].""));
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $site_name; ?></title>
        
        <!-- META -->
        <meta name="description" content="">
        <meta name="author" content="Solutii Soft">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- END META -->
        
        <!-- CSS -->
        <link type="text/css" rel="stylesheet" href="<?php echo $url_cod; ?>style.css">
        <!-- END CSS -->
        
        <!-- Favicon Icon -->
        <link rel="shortcut icon" href="<?php echo $url_cod; ?>images/favicon.ico">
        
        <!-- Jquery Sticky Navigation Script
        ================================================== -->
        <script src="<?php echo $url_cod; ?>js/jquery-1.10.2.min.js"></script>
        
        <script>
        $(function() {
        
            // grab the initial top offset of the navigation 
            var sticky_navigation_offset_top = $('#sticky_navigation').offset().top;
            
            // our function that decides weather the navigation bar should have "fixed" css position or not.
            var sticky_navigation = function(){
                var scroll_top = $(window).scrollTop(); // our current vertical position from the top
                
                // if we've scrolled more than the navigation, change its position to fixed to stick to top, otherwise change it back to relative
                if (scroll_top > sticky_navigation_offset_top) { 
                    $('#sticky_navigation').css({ 'position': 'fixed', 'top':0, 'left':0 });
                } else {
                    $('#sticky_navigation').css({ 'position': 'relative' }); 
                }   
            };
            
            // run our function on load
            sticky_navigation();
            
            // and run it again every time you scroll
            $(window).scroll(function() {
                 sticky_navigation();
            });
            
            
            
        });
		
	//	$(document).ready(function(){
//        $("#bagadd").click(function() {
//			 $('#sdtdiv').show();  
//			 $('#sdtdiv').css('height','200px');  
//			 $('#sdtdiv').css('z-index','999999999');  
//            $('#sdtdiv').animate({ marginTop:"-=130px"
//			}, 1000);
//			setTimeout(function(){
//			 // $('#sdtdiv').addClass("sdtclass");
//			 $('#sdtdiv').hide();
//			 $('#sdtdiv').animate({ marginTop:"+=130px"
//			}, 1000);
//			
//			}, 2000);
//
//			//$('#sdtdiv').hide();  
//			})
//    });
		$(document).ready(function(){
        $("#bagadd").click(function() {
			 var CATID = document.getElementById('CATID').value;
			 var SerialNo = document.getElementById('SerialNo').value;
			 
			 if(CATID != 3)
			 {
				var size = document.getElementById('SizeSelect').value;
				var colorid = document.getElementById('colorSelect').value;
				var qty = parseInt(document.getElementById('quantity').value);
				   if(size != "")
				   { 
					   if(qty > 0)
					   {
						  // alert("ok");
					     $.post("LookUp.php",{ func: "COLOR", colorid: colorid, sl: SerialNo, size: size, qty: qty},
						   function(data)
						   {
							//alert(data.AMOUNT); 
							$('#sdtdiv').html(data.DIV);
						        $('#sdtdiv').show();  
								 $('#sdtdiv').css('height','200px');  
								 $('#sdtdiv').css('z-index','999999999');  
								$('#sdtdiv').animate({ marginTop:"-=130px"
								}, 1000);
								setTimeout(function(){
								 // $('#sdtdiv').addClass("sdtclass");
								 $('#sdtdiv').hide();
								 $('#sdtdiv').animate({ marginTop:"+=130px"
								}, 1000);
								
								}, 2000);
								$('#counttext').html(data.TOTAL);
							   $('#bagtext').html(data.AMOUNT);
								
							
						   },"json")
					  }
					  else
					  {
						 alert("Please Enter Quantity"); 
					      document.getElementById('quantity').focus();     
					  }
				   }
				   else
				   {
					 alert("Please Select a Size"); 
					 document.getElementById('SizeSelect').focus();  
				   }
			 }
			 else if(CATID == 3)
			 {
				  
				var qty = parseInt(document.getElementById('quantity').value);
				   
					   if(qty > 0)
					   {
						  // alert("ok");
					     $.post("LookUp.php",{ func: "NOCOLOR", sl: SerialNo, qty: qty},
						   function(data)
						   {
							//alert(data.AMOUNT); 
							$('#sdtdiv').html(data.DIV);
						       $('#sdtdiv').show();  
								 $('#sdtdiv').css('height','200px');  
								 $('#sdtdiv').css('z-index','999999999');  
								$('#sdtdiv').animate({ marginTop:"-=130px"
								}, 1000);
								setTimeout(function(){
								 // $('#sdtdiv').addClass("sdtclass");
								 $('#sdtdiv').hide();
								 $('#sdtdiv').animate({ marginTop:"+=130px"
								}, 1000);
								
								}, 2000);
							$('#counttext').html(data.TOTAL);
							$('#bagtext').html(data.AMOUNT);
							
						   },"json")
					  }
					  else
					  {
						 alert("Please Enter Quantity"); 
					      document.getElementById('quantity').focus();     
					  }
				  
			 }

			
			})
    });
	
        </script>
        <script type="text/javascript">
		function color_change(colorid)
		{
		var sl = document.getElementById('SerialNo').value;
		  window.location.href = "viewproduct.php?sl="+sl+"&colorid="+colorid;
	    }
		</script>
       <style type="text/css">
	   .sdtclass{
		   float:right;
		      position:absolute; 
			  display:none;
			   width:240px; 
			    border:1px solid #CCC;
				 background-color:#fff;
				 margin-left:290px;
				 border-radius: 5px  5px  5px  5px ;
				 box-shadow:2px 2px 2px 2px #888888;
				 
		     }
	   </style> 
    </head>
	<body>
		<header >
<!-- Top Header -->        
        	<?php include("top_header.php"); ?>
<!-- Top Header End --> 

<!-- Bottom Header -->			
<?php include("menu.php"); ?>
<!-- Bottom Header End -->
        </header>

<!-- Content Section -->
		<div class="container">
          
            <div class="row">
<!-- Breadcrumb Wrapper -->                
				<div class="breadcrumbWrapper">
<!-- Breadcrumb -->            	
                    <div class="col-md-9">
                        <ol class="breadcrumb">
                        <?php
                          $TOP_link = mysqli_fetch_row(mysqli_query($con, "SELECT
									product_category_info.CategoryName
									, product_sub_category.SubCategoryName
									, product_ssub_category.SubCategoryName
									, product_info.ProductName
									, product_category_info.CategoryID
									, product_sub_category.SubCategoryID
									, product_ssub_category.SubSubCategoryID
								FROM
									product_info
									INNER JOIN product_ssub_category 
										ON (substr(product_info.ProductID,6,3) = product_ssub_category.SubSubCategoryID)
									INNER JOIN product_sub_category 
										ON (product_ssub_category.SubCategoryID = product_sub_category.SubCategoryID)
									INNER JOIN product_category_info 
										ON (product_sub_category.CategoryID = product_category_info.CategoryID)
								WHERE product_info.ProductID='".$product_details_info['ProductID']."'"));
						?>
                          <li><a href="index.php">Home</a></li>
                          <li><a href="allproducts.php?cat=<?php echo $TOP_link[4]; ?>"><?php echo $TOP_link[0]; ?></a></li>
                          <li><a href="allproducts.php?scat=<?php echo $TOP_link[5]; ?>"><?php echo $TOP_link[1]; ?></a></li>
                          <li><a href="products.php?sscat=<?php echo $TOP_link[6]; ?>"><?php echo $TOP_link[2]; ?></a></li>
                          <li class="active"><?php echo $TOP_link[3]; ?></li>
                        </ol>
                    </div>
<!-- Breadcrumb End -->            	                
    
<!-- Product Code -->
                    <div class="col-md-3">
                        <div class="productCode">
                            <p><!--Product Code: <span>308389--></span></p>
                        </div>	
                    </div>
<!-- Product Code End -->
					<div class="clearfix"></div>
                    <div class="col-md-12">
                    	<hr/>
                    </div>
                </div>
<!-- Breadcrumb Wrapper End -->                
            </div>
            
            <div class="row">
<!-- Product Image -->            
           		<div class="col-md-5">
                	<input type="hidden" id="SerialNo" name="SerialNo" value="<?php echo $_REQUEST["sl"]; ?>" />
                    <input type="hidden" id="CATID" name="CATID" value="<?php echo $cat[0]; ?>" />
                    <ul id='girlstop' class='gc-start'>
                    <?php
                   
                           if($cat[0]==3)
						   {
							  $image_details = mysqli_query($con, "SELECT BigImage FROM product_image 
									 WHERE ProductID='".$product_details_info['ProductID']."' order by orderid");   
						   }
						   else
						   {
							  if(isset($_REQUEST["colorid"]) && $_REQUEST["colorid"]!="")
								{
							        $sl = $_REQUEST["sl"];
                                    $colorid = $_REQUEST["colorid"];
                                     $temp_ProductDetails_id = mysqli_fetch_row(mysqli_query($con, "SELECT LEFT(ProductFullID,11) FROM product_details
							           WHERE SerialNo=".$sl." AND substr(product_details.ProductFullID,9,3)='".$colorid."' LIMIT 1")); 
								}
								else
								{
							$temp_ProductDetails_id = mysqli_fetch_row(mysqli_query($con, "SELECT LEFT(ProductFullID,11) FROM product_details
							  WHERE SerialNo=".$_REQUEST["sl"]." GROUP BY substr(product_details.ProductFullID,9,3) LIMIT 1")); 
								}
							   
							 $image_details = mysqli_query($con, "SELECT BigImage FROM product_image 
									 WHERE ProductID='".$temp_ProductDetails_id[0]."' order by orderid");   
						   }
						   while($image_details_info = mysqli_fetch_array($image_details))
						   {
                         ?>
				
                        <li><img src="<?php echo $url_cod; ?>productimage/<?php echo $image_details_info['BigImage']; ?>" alt='image' /></li>
                       <?php } ?>
                    </ul>
                </div>
<!-- Product Image End -->                

<!-- Product Details -->
				<div class="col-md-5">
                <div class="pull-right sdtclass" id="sdtdiv">
                 <!-- copy start --> 
                     
                    <!-- copy end -->   
                </div> 
<!-- Product Details Header -->                
                	<div class="productHeader container-fluid">
                    	<div class="row">
                        	<div class="col-sm-8">
                            	<h4><?php echo $product_details_info['ProductName']; ?></h4>
                                <div class="rating hidden-sm pull-left">
                                    <i class="price-text-color fa fa-star"></i>
                                    <i class="price-text-color fa fa-star"></i>
                                    <i class="price-text-color fa fa-star"></i>
                                    <i class="price-text-color fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="col-sm-4">
                            	<!--<div class="price">-->
                  <p class="pull-right" style="padding-right:10px;"> <?php echo number_format($product_details_info['ActualPrice'],2,'.',','); ?></p>                                    
                               <!-- </div>-->
                                <div class="clearfix"></div>
                                <!--<div class="itemNumber pull-right">662-727</div>-->
                            </div>
                        </div>
                    </div>
<!-- Product Details Header End -->

<!-- Product Details Selection -->
					<div class="productContent container-fluid">
                    	<div class="row">
<!-- Content Box -->                
 
 
						 <?php
                           if($cat[0]!=3)
						   {
                         ?>
                        	
                        	<div class="contentBox">
<!-- Color Selection -->                            
                            	<div class="col-sm-6">
                                    <div class="color hidden-sm col-md-12">
                                      <?php
                                        $product_color = mysqli_query($con, "SELECT
															color_list.ColorName
															, color_list.ColorCode
															,color_list.ColorID
														FROM
															product_details
															INNER JOIN color_list 
																ON (substr(product_details.ProductFullID,9,3) = color_list.ColorID)
														WHERE product_details.SerialNo=".$_REQUEST['sl']."
														GROUP BY substr(product_details.ProductFullID,9,3)");
										 $first_color = 0;
										 $first_color_code = "";
										while( $product_color_details = mysqli_fetch_array( $product_color))
										{
											if(isset($_REQUEST["colorid"]) && $_REQUEST["colorid"]!="")
											{
												$first_color_code = $_REQUEST["colorid"];
											}
											else if(++$first_color ==1)
											{
											  $first_color_code = $product_color_details['ColorID'];
											}
						if($product_color_details['ColorID'] == $first_color_code)
											{
									  ?>
                 <div style="width:25px; height:25px; margin-top:-2px; background-color:<?php echo $product_color_details['ColorCode']; ?>" onClick="color_change(<?php echo $product_color_details['ColorID']; ?>);" ></div>
                                       
                                       <?php }
									   else
									   {
									    ?>
                 <a href="#"  onClick="color_change('<?php echo $product_color_details['ColorID']; ?>');">
               <div style="width:20px; height:20px; background-color:<?php echo $product_color_details['ColorCode']; ?>" ></div></a>
                                     <?php }} ?>
                                    </div>
                                </div>
<!-- Color Selection End -->                                
<!-- Size Selection -->
                                <div class="col-sm-6">
                                    <div class="size pull-right">
                                     <?php
                                      $size_info = mysqli_query($con, "SELECT
										product_unit.UnitID 'SizeID'
										, product_unit.UnitName 'SizeName'
										, product_details.Qty 'SizeQty'
									FROM
										product_details
										INNER JOIN product_unit 
											ON (RIGHT(product_details.ProductFullID,2) = product_unit.UnitID)
									WHERE SUBSTR(product_details.ProductFullID,9,3)='".$first_color_code."'
									 AND SerialNo=".$_REQUEST["sl"]."");
								
								while($size_info_details = mysqli_fetch_array($size_info))
								{
									if($size_info_details['SizeQty']>0)
									{
									 ?>
                                    	<a class="multiselect" pid="JEADU8FSFMPVC8ZY" href="#"
                             onClick="document.getElementById('SizeSelect').value = '<?php echo $size_info_details['SizeID']; ?>';">
                                        	<div class="multiselect">
                                            	<div class="multiselect-item "><?php echo $size_info_details['SizeName']; ?></div>
                                            </div>
                                        </a>
                                <?php }
								    else
									{
								 ?>
                                    	<a title="Sold Out" pid="JEADU8FSRFW3B7ZB" class="multiselect msi-soldout">
                                        	<div class="multiselect-item rposition ">
                                            	<div class="strike-out" style=""></div>
                                               	<span class="disabled"><?php echo $size_info_details['SizeName']; ?></span>
                                            </div>
                                        </a>
                          <?php } }?>
                                    </div>
                                </div>
<!-- Size Selection End -->                                
                                <div class="clearfix"></div>
                            </div> <?php } ?>
<!-- Content Box End -->
<!-- Content Box -->                            
                            <div class="contentBox">
<!-- Quantity Selection -->                
                            	<div class="col-sm-6">
                                <input type="hidden" name="colorSelect" id="colorSelect" value="<?php echo $first_color_code; ?>">
                                <input type="hidden" name="SizeSelect" id="SizeSelect">
                               		<input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity">
                                </div>
<!-- Quantity Selection End -->
<!-- Submit Button -->                                
                            	<div class="col-sm-6 pull-right">
                       
                                        <div class="btn-group">
                                        <a href="#" class="btn btn-checkout" id="bagadd"> Add To Bag</a>
                                    </div>
                                    
                                   
     							</div>	
<!-- Submit Button End -->        
								<div class="clearfix"></div>                        
                            </div>
<!-- Content Box End -->                            
<!-- Product Description -->
							<div class="col-sm-12">
                            	<p style="font-size:15px"><strong>Product Details</strong></p>
                                <p>
                                	<?php echo htmlspecialchars_decode($product_details_info['Features']); ?>
                                </p>
                            </div>
<!-- Product Description -->
                        </div>
                    </div>
<!-- Product Details Selection End -->                                        
                </div>
<!-- Product Details End -->                
<!-- Related Product -->
                <div class="col-md-2">
                    <div class="container-fluid">
                    <?php
                      $similar_product = mysqli_query($con, "SELECT SerialNo,ProductName,ProductID FROM product_info 
					  WHERE substr(ProductID,3,1)='".$cat[0]."' ORDER BY RAND() LIMIT 3");
					   while($similar_product_row = mysqli_fetch_array($similar_product))
					   {
					?>
                        <div class="row">
                            <div class="relatedProduct">
                              <?php
                                if($cat[0]!=3)
								{
									$temp_ProductDetails_id = mysqli_fetch_row(mysqli_query($con, "SELECT LEFT(ProductFullID,11) FROM product_details
							  WHERE SerialNo=".$similar_product_row['SerialNo']." GROUP BY substr(product_details.ProductFullID,9,3) LIMIT 1")); 
								
							 $image_details = mysqli_fetch_row(mysqli_query($con, "SELECT MidImage FROM product_image 
									 WHERE ProductID='".$temp_ProductDetails_id[0]."' order by orderid LIMIT 1")); 
							  ?>
                               <a href="viewproduct.php?sl=<?php echo $similar_product_row['SerialNo']; ?>">
                                <img src="<?php echo $url_cod; ?>productimage/<?php echo $image_details[0]; ?>" class="img-responsive">
                                </a>
                               <?php
								}
								else
								{
									 $image_details = mysqli_fetch_row(mysqli_query($con, "SELECT MidImage FROM product_image 
									 WHERE ProductID='".$similar_product_row['ProductID']."' order by orderid LIMIT 1")); 
							   ?>
                                <a href="viewproduct.php?sl=<?php echo $similar_product_row['SerialNo']; ?>">
                                <img src="<?php echo $url_cod; ?>productimage/<?php echo $image_details[0]; ?>" class="img-responsive">
                                </a>
                               <?php } ?>
                                <h4><a href="viewproduct.php?sl=<?php echo $similar_product_row['SerialNo']; ?>">
								<?php echo $similar_product_row['ProductName']; ?></a></h4>
                            </div>                            
                        </div>
                        
                   <?php } ?>                       
                        
                    </div>
                </div>
<!-- Related Product End -->	
            </div>
        </div>
<!-- Content Section End -->       

<!--Footer -->

<?php include("footer.php"); ?>
<!--Footer  -->
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo $url_cod; ?>js/bootstrap.min.js"></script>
        
        <!-- Megamenu Scripts -->
        <script type="text/javascript" src="<?php echo $url_cod; ?>js/jquery.js"></script>
        <script>
            $('a.btn').tooltip({
                "placement" : "top"
            });
        
            /* === SHOW MESSAGES === */
            $('.cart-message, .wish-message').css('display','none');
            function showMessage(value) {
                $.gritter.add({
                    title: ' Information',				            // (string | mandatory) the heading of the notification
                    text: $('.' + value + '-message p').text(),	    // (string | mandatory) the text inside the notification
                    time: 5000							            // (int | optional) the time you want it to be alive for before fading out (milliseconds)
                });
            }
            /* === END SHOW MESSAGES === */
        </script>
        
        <!-- Owl carousel JavaScript -->
        <script src="<?php echo $url_cod; ?>owl-carousel/owl.carousel.js"></script>
        <script>
        $(document).ready(function() {
        
          $("#owl-demo").owlCarousel({
            items : 4,
            lazyLoad : true,
            navigation : true
          });
        
        });
        </script>
        
        <script src="<?php echo $url_cod; ?>js/bootstrap-hover-dropdown.js"></script>
        <script src="<?php echo $url_cod; ?>js/fitdivs.js"></script>
        <script>
            $(document).ready(function(){
            // Target your .container, .wrapper, .post, etc.
                $(".fhmm").fitVids();
            });
        </script>
        <script>
            // Menu drop down effect
            $('.dropdown-toggle').dropdownHover().dropdown();
            $(document).on('click', '.fhmm .dropdown-menu', function(e) {
              e.stopPropagation()
            })
        </script>
           
        <script>
            $('.navbar .dropdown').hover(function() {
                $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
            }, function() {
                $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
            });
        </script>
        
        <!-- GlassCase Product Viewer Scripts -->
        <script src="<?php echo $url_cod; ?>js/jquery.glasscase.min.js" type="text/javascript"></script>
		<script type="text/javascript">
            $(function () {
                //Demo 1
                $("#girlstop").glassCase({ 'thumbsPosition': 'top', 'widthDisplay': '341', 'heightDisplay': '511' });            
            });
        </script> 
    
    </body>
</html>