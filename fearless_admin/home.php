<?php
  require_once("wish_cart_session.php");
  require_once("rollout_admin/connection.php");
  
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
            
            // NOT required:
            // for this demo disable all links that point to "#"
            $('a[href="#"]').click(function(event){ 
                event.preventDefault(); 
            });
            
        });
		
		
        </script>
        <script type="text/javascript">
		function cart_add(type,id,pdtid)
		{
			//alert("type: "+type+" id: "+pdtid);
		  if(type == "cart")
		  {
			  $.post("LookUp.php",{ func: "CART", id: id, pdtid: pdtid, qty: "1"},
				   function(data)
				   {
					//alert(data.SSSSS); 
				   $('#cart_inc').html(data.SSSSS);
				     if(data.MSG == "Product exist in your cart")
					 {}
					 else if(data.MSG == "")
				     {
					   // alert(data.TTTTT);
					   $('#shortcart').html(data.SSSSS);	
					  $('#sdtcartcount').html(data.TTTTT);	
					    
					 }
				   },"json")	
		  }
		  else  if(type == "wish")
		  {
			  $.post("LookUp.php",{ func: "WISH", id: id, pdtid: pdtid, qty: "1"},
				   function(data)
				   {
					alert(data.SSSSS); 
				  // $('#cart_inc').html(data.SSSSS);
				   
				   },"json")	
		  }
		}
		</script>
    </head>
	<body >
    
<!-- bg slider -->    	
		<div id="slideshow-holder">
            <div id="slideshow">
                <img class="gallery" src="<?php echo $url_cod; ?>images/bg/s1.jpg" />
                <img class="gallery" src="<?php echo $url_cod; ?>images/bg/s2.jpg" />
                <img class="gallery" src="<?php echo $url_cod; ?>images/bg/s3.jpg" />
            </div>
        </div>
        
        <script>
            $(function () {
            // Simplest jQuery slideshow by Jonathan Snook
            $('#slideshow img:gt(0)').hide();
            setInterval(function () {
            $('#slideshow :first-child').fadeOut(3000)
            .next('img').fadeIn(3000).end().appendTo('#slideshow');
            }, 6000);
            });
        </script>
<!-- bg slider end -->  

<!-- Header -->
		<header>
<!-- Top Header -->        
        	<?php include("top_header.php"); ?>
<!-- Top Header End --> 

<!-- Bottom Header -->			
<?php include("menu.php"); ?>
<!-- Bottom Header End -->
        </header>
<!-- Header End -->        
        
<!-- Wrapper Start -->  
		<div class="wrapper">
<!-- Slider -->  
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-8 col-lg-8">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                  <img src="<?php echo $url_cod; ?>images/050814-featured-2.jpg" alt="..." width="100%">
                                  <div class="carousel-caption">
                                    ...
                                  </div>
                                </div>
                                <div class="item">
                                  <img src="<?php echo $url_cod; ?>images/050814-featured-3.jpg" alt="..." width="100%">
                                  <div class="carousel-caption">
                                    ...
                                  </div>
                                </div>
                                <div class="item">
                                  <img src="<?php echo $url_cod; ?>images/051214-featured-1.jpg" alt="..." width="100%">
                                  <div class="carousel-caption">
                                    ...
                                  </div>
                                </div>
                            </div>
                            
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <img src="<?php echo $url_cod; ?>images/041714-3stack-3.jpg" width="100%" class="img-responsive" style="margin-bottom:5px" />
                        <img src="<?php echo $url_cod; ?>images/051514-3stack-3.jpg" width="100%" class="img-responsive" style="margin-bottom:5px" />
                        <img src="<?php echo $url_cod; ?>images/050814-3stack-1.jpg" width="100%" class="img-responsive" style="margin-bottom:0" />
                    </div> 
                </div>
            </div>
<!-- Slider End -->

<!-- Featured products -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row title-box">
                            <div class="col-md-9">
                                <h3>Featured Products</h3>
                                
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="owl-demo" class="owl-carousel">  
                                
                                <?php
                                $fetaured_product = mysqli_query($con, "SELECT
																product_info.SerialNo 'SerialNo'
																, product_info.ProductID 'ProductID'
																, product_details.ProductFullID 'ProductFullID'
																, product_info.ProductName 'ProductName'
																, product_info.Brand 'Brand'
																, product_info.Price 'Price'
																, product_info.Collectibles 'Collectibles'
																, product_info.Discount 'Discount'
														, (product_info.Price-((product_info.Discount/100)*product_info.Price)) 'ActualPrice'
															FROM
																product_info
																LEFT JOIN product_details 
																	ON (product_info.SerialNo = product_details.SerialNo)
															WHERE product_info.FeaturedStatus=1 AND product_info.ActiveStatus='Active'
															AND (product_info.Stock>0 OR product_details.Qty>0) 
															GROUP BY product_info.SerialNo");
								while($fetaured_product_data = mysqli_fetch_array($fetaured_product))
								{  if($fetaured_product_data['Collectibles']==1)
								   {
									 $featured_image = mysqli_fetch_row(mysqli_query($con, "SELECT MidImage FROM product_image 
									 WHERE ProductID='".$fetaured_product_data['ProductID']."' order by orderid limit 1")); 
									 $featured_pdt_id =   $fetaured_product_data['ProductID'];
								   }
								   else if($fetaured_product_data['Collectibles']==0)
								   {
									  $featured_image = mysqli_fetch_row(mysqli_query($con, "SELECT MidImage FROM product_image 
									 WHERE ProductID='".substr($fetaured_product_data['ProductFullID'],0,11)."' order by orderid limit 1"));  
									 
									 $featured_pdt_id =   $fetaured_product_data['ProductFullID'];
								   }
								?>
                                                  
                                    <div class="item">
                                        <div class="thumbnail">
                                            <img src="<?php echo $url_cod; ?>productimage/<?php echo $featured_image[0]; ?>" alt="...">
                                            <div class="caption">
                                                <h2><?php echo $fetaured_product_data['ProductName']; ?></h2>
                                                <?php
                                                if($fetaured_product_data['ProductName']!="")
												{
													 
												?>
                                                <div >
                                                <?php
                                                      $featured_color = mysqli_query($con, "SELECT
															color_list.ColorName
															, color_list.ColorCode
														FROM
															product_details
															INNER JOIN color_list 
																ON (substr(product_details.ProductFullID,9,3) = color_list.ColorID)
														WHERE product_details.SerialNo=".$fetaured_product_data['SerialNo']."
														GROUP BY substr(product_details.ProductFullID,9,3)");
												   while($featured_color_data = mysqli_fetch_array($featured_color))
												   {
												 ?>
                                                   <div style=" margin-left: 5px; float:left; background-color:<?php echo $featured_color_data['ColorCode']; ?>; width:16px; height:16px; border: 1px solid #CCC;"></div> 
                                                   <?php } ?>
                                               </div><br/>
                                              <?php } ?>
                                                <ul class="list-inline">
                                                <?php
                                                  if($fetaured_product_data['Discount']>0)
												  {
												?>
                                                   (BDT)  <li class="old-price"><?php echo $fetaured_product_data['Price']; ?></li>
                                                   
                                                  <?php } ?> 
                                                    <li class="pull-right price"><?php echo "(BDT) ".$fetaured_product_data['ActualPrice']; ?></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                                
                                                <?php
                                                  if($fetaured_product_data['Discount']>0)
												  {
												?>
                                                   <div class="discount">
                                                     <span class="rotate"><?php echo $fetaured_product_data['Discount']; ?></span>
                                                   </div> 
                                               <?php } ?> 
                                                <!-- mandatory code -->
                                                <p>
               <!--<a href="#" onClick="" class="btn btn-default color1 wish" role="button" title="add to wish list"><i class="fa fa-heart"></i></a>
             <a href="#" onClick=""  class="btn btn-default color2 cart" role="button" title="add to cart"><i class="fa fa-shopping-cart"></i></a>-->
                                                    <a href="viewproduct&sl=<?php echo $fetaured_product_data['SerialNo'];  ?>" class="btn btn-default color3" role="button" title="details"><i class="fa fa-external-link"></i></a>
                                                </p>
                                                
                                                
                                                <!-- end mandatory code -->
                                            </div>
                                        </div>                            
                                    </div>
                                    
                                   <?php } ?>
                                   
                                   
                                           
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>            
            </div>

<!-- Featured products end -->
		</div>
<!-- wrapper end -->
        
<!-- Offer slider -->
                <div class="offerSliderWrap">
                    <div class="container">
<!-- Product List -->                    
                        <div class="row">                  
<!-- List Start -->           
                            <?php
                                $casual_product = mysqli_query($con, "SELECT
																product_info.SerialNo 'SerialNo'
																, product_info.ProductID 'ProductID'
																, product_details.ProductFullID 'ProductFullID'
																, product_info.ProductName 'ProductName'
																, product_info.Brand 'Brand'
																, product_info.Price 'Price'
																, product_info.Collectibles 'Collectibles'
																, product_info.Discount 'Discount'
														, (product_info.Price-((product_info.Discount/100)*product_info.Price)) 'ActualPrice'
															FROM
																product_info
																LEFT JOIN product_details 
																	ON (product_info.SerialNo = product_details.SerialNo)
															WHERE SUBSTR(product_info.ProductID,3,1)=1 AND 
															product_info.FeaturedStatus=0 AND product_info.ActiveStatus='Active'
															AND product_details.Qty>0 
															GROUP BY product_info.SerialNo ORDER BY product_info.SerialNo DESC LIMIT 4");
								while($casual_product_data = mysqli_fetch_array($casual_product))
								{  
									  $casual_image = mysqli_fetch_row(mysqli_query($con, "SELECT MidImage FROM product_image 
									 WHERE ProductID='".substr($casual_product_data['ProductFullID'],0,11)."' order by orderid limit 1"));  
								   
								?>                           
                                           
                          	<div class="col-sm-6 col-md-3"><a>
                                </a><div class="thumbnail"><a>
                                    <img src="<?php echo $url_cod; ?>productimage/<?php echo $casual_image[0]; ?>" alt="...">
                                            <div class="caption">
                                                <h2><?php echo $casual_product_data['ProductName']; ?></h2>
                                                <?php
                                                if($casual_product_data['ProductName']!="")
												{
													 
												?>
                                                <div >
                                                <?php
                                                      $casual_color = mysqli_query($con, "SELECT
															color_list.ColorName
															, color_list.ColorCode
														FROM
															product_details
															INNER JOIN color_list 
																ON (substr(product_details.ProductFullID,9,3) = color_list.ColorID)
														WHERE product_details.SerialNo=".$casual_product_data['SerialNo']."
														GROUP BY substr(product_details.ProductFullID,9,3)");
												   while($casual_color_data = mysqli_fetch_array($casual_color))
												   {
												 ?>
                                                   <div style=" margin-left: 5px; float:left; background-color:<?php echo $casual_color_data['ColorCode']; ?>; width:16px; height:16px; border: 1px solid #CCC;"></div> 
                                                   <?php } ?>
                                               </div><br/>
                                              <?php } ?>
                                                <ul class="list-inline">
                                                <?php
                                                  if($casual_product_data['Discount']>0)
												  {
												?>
                                                   (BDT)  <li class="old-price"><?php echo $casual_product_data['Price']; ?></li>
                                                   
                                                  <?php } ?> 
                                                    <li class="pull-right price"><?php echo "(BDT) ".$casual_product_data['ActualPrice']; ?></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                                
                                                <?php
                                                  if($casual_product_data['Discount']>0)
												  {
												?>
                                                   <div class="discount">
                                                     <span class="rotate"><?php echo $casual_product_data['Discount']; ?></span>
                                                   </div> 
                                               <?php } ?> 
                                                <!-- mandatory code -->
                                                <p>

                                                    <a href="viewproduct&sl=<?php echo $casual_product_data['SerialNo'];  ?>" class="btn btn-default color3" role="button" title="details"><i class="fa fa-external-link"></i></a>
                                                </p>
                                                
                                                
                                                <!-- end mandatory code -->
                                            </div>
                                        </div>                            
                                    </div>
        <!-- List End -->
                           <?php } ?>
       
        
        <!-- List End -->                          
                        </div>
<!-- Product List End -->                   
                    </div>
                </div>
        <!-- Offer slider end -->
        
        <!-- wrapper -->
                <div class="wrapper">
        <!-- Product info -->
                    <div class="container">
                        <div class="row title-box">
                            <div class="col-md-9 col-lg-9 col-sm-9">
                                <h3>Formal Wear</h3>
                            </div>                
                        </div>
                        <div class="row">
                        
                        <?php
                                $formal_product = mysqli_query($con, "SELECT
																product_info.SerialNo 'SerialNo'
																, product_info.ProductID 'ProductID'
																, product_details.ProductFullID 'ProductFullID'
																, product_info.ProductName 'ProductName'
																, product_info.Brand 'Brand'
																, product_info.Price 'Price'
																, product_info.Collectibles 'Collectibles'
																, product_info.Discount 'Discount'
														, (product_info.Price-((product_info.Discount/100)*product_info.Price)) 'ActualPrice'
														       , substr(product_info.Features,1,50) 'Features'
															FROM
																product_info
																LEFT JOIN product_details 
																	ON (product_info.SerialNo = product_details.SerialNo)
															WHERE SUBSTR(product_info.ProductID,3,1)=2 AND 
															product_info.FeaturedStatus=0 AND product_info.ActiveStatus='Active'
															AND product_details.Qty>0 
															GROUP BY product_info.SerialNo ORDER BY product_info.SerialNo DESC LIMIT 4");
								while($formal_product_data = mysqli_fetch_array($formal_product))
								{  
									  $formal_image = mysqli_fetch_row(mysqli_query($con, "SELECT MidImage FROM product_image 
									 WHERE ProductID='".substr($formal_product_data['ProductFullID'],0,11)."' order by orderid limit 1"));  
								   
								?> 
                            <div class="col-lg-3">
                                <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                    <p style="text-align:center; margin:0px;">
                                        
                                        <img src="<?php echo $url_cod; ?>productimage/<?php echo $formal_image[0]; ?>" class="img-responsive" >
                                    </p>
                                    <div class="caption">
                                        <div class="blur"></div>
                                        <div class="caption-text">
                                            <h3 style="background-color: #F9F9F9 !important; border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important; padding:12px;"><?php echo $formal_product_data['ProductName']; ?></h3>
                                            <p><?php echo $formal_product_data['Features']; ?>...</p>
                                            <a class=" btn btn-default" href="viewproduct&sl=<?php echo $formal_product_data['SerialNo'];  ?>"><span class="glyphicon glyphicon-plus"> INFO</span></a>
                                        </div>
                                    </div>
                                </div>                        
                            </div>
                          
                          <?php } ?>
                          
                        </div>
                    </div>
        <!-- Product info -->
                </div>
        <!-- wrapper end -->  
        
        <!--Footer -->
              <?php include("footer.php"); ?>
        <!--Footer  -->
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo $url_cod; ?>https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo $url_cod; ?>js/bootstrap.min.js"></script>
        
        <!-- Flex Slider Scripts -->
        <script type='text/javascript' src='js/jquery.custom.min.js'></script>
        <script type='text/javascript' src='js/tm_jquery.flexslider.js'></script>
        
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
		    var dropcount = 0; 
           $('.navbar .dropdown').hover(function() 
			     {
				  
					$(".dropdown-menu", this).slideUp().slideDown();
				   
				 }
				
				);
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