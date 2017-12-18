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
    <title>Fearless Strokes</title>
      <link rel="icon" href="assets/images/logo.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--    <link href="assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">-->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="assets/css/style.css">
<!--      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--      Add the new slick-theme.css if you want the default styling-->
      <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
      <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>

<!--
      <style>
          .vertical-product-list a{
              text-decoration-style: none;
              color: #000;
          }
      </style>
-->
      <style>
          /*.slick-dots li button:before{*/
              /*font-size: 35px;*/
          /*}*/

          /*.slick-prev:before, .slick-next:before{*/
              /*color: black;*/
          /*}*/
      </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!--      <script src="assets/js/jquery-3.2.1.min.js"></script>-->
  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
  </head>
  <body >
    <?php include("header.php"); ?>
    
    <div class="container">
<!--        <div class="slideshow-container">-->
        <div class="your-class">
            <?php $slider_image = mysqli_query($con, "SELECT id, sliderImage FROM slider_image ORDER BY id asc ");
            while($row=mysqli_fetch_row($slider_image))
            { ?>
                <div class="">
                    <img src="<?php echo $row[1];?>" style="width:100%; height: auto">
                </div>
            <?php }?>

        </div>
        <br>

<!--
    	<div class="row">
         	<div class="col-md-8">
           		<div class="row top-left-message" >
                    <div class="col-sm-3">
                        <button class="btn btn-sm">T-Shirts <i class="fa fa-chevron-right"></i></button>
                    </div>
                    <div class="col-sm-6">
                        <h5>WIN UP TO 60%</h5>
                    </div>
                    <div class="col-sm-3">
                         <button class="btn btn-sm pull-right">Mugs <i class="fa fa-chevron-right"></i></button>
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
        
        <div class="row"> 
          	<div class="col-sm-12 bar2">Find your favourite arts here.</div>
        </div>
        
    	<div class="row" style="margin-bottom:20px;" >
<!--       		<div class="col-md-12 col-sm-3">-->
            	<ul class=" horizontal-product-list">
                     <?php 
                    $sql=mysqli_query($con, "SELECT CategoryID,CategoryName,CategoryDescrition,IconName FROM product_category_info WHERE ActiveStatus='Active' ORDER BY orderid asc ");
                    $sl=0;
                    while($row=mysqli_fetch_row($sql))
                    {   ++$sl;
                      
                ?>  
                    <li class="col-md-4" style="">
                        
                            <a href="product?id=<?php echo $row[0]; ?>" >
                                        <img src="menuimage/<?php echo $row[3]; ?>">
                                        <div class="detail">                        	
                                        <!--    <div class="feed-box">
                                                <span><strong><?php// echo $row[1]; ?></strong></span>
                                            </div> -->
<!--                                            <p class="product-title"><?php echo $row[1]; ?></p>-->

                                            <br><br>
                                        </div>
                        </a>
                       
                        
                     </li>
                    <?php } ?>
            	</ul>
<!--            </div>-->
            
            
        </div>        
        
        <!--<div class="row">
        	<div class="col-sm-12">
            	<p class="title-header">
                	<em>
                    	<span>Fashion & Beauty</span>
                    </em>
                </p>
            </div>
        </div>
        
        <div class="row">
        	<div class="col-sm-12">
            	<ul class="row horizontal-product-list">
            		<li class="col-sm-4">
                    	<div class="product-wrap">
                        	<img src="assets/images/product/wtwt-464x592-cta.jpg">
                            <div class="detail">                        	
                                <div class="feed-box"><span>Shop</span></div>
                                <p class="product-title">The jean jacket</p>
                                <p>When in denim</p>
                            </div>
                        </div>
                    </li>
            		<li class="col-sm-4">
                    	<div class="product-wrap">
                        	<img src="assets/images/product/yah.jpg">
                            <div class="detail">                        	
                                <div class="feed-box"><span>Shop</span></div>
                                <p class="product-title">The jean jacket</p>
                                <p>When in denim</p>
                            </div>
                        </div>
                    </li>
                    <li class="col-sm-4">
                    	<div class="product-wrap">
                        	<img src="assets/images/product/wtwt-464x592-cta.jpg">
                            <div class="detail">                        	
                                <div class="feed-box"><span>Shop</span></div>
                                <p class="product-title">The jean jacket</p>
                                <p>When in denim</p>
                            </div>
                        </div>
                    </li>
            	</ul>
            </div>
        </div>-->
    </div>
    

    <div class="container">
    	<?php include("footer.php"); ?>
    </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap-select.js"> </script>
<!--    <script src="assets/js/singleCartDelete.js"></script>-->
    <script type="text/javascript" src="assets/js/plugin.js"></script>


<!--          <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
    <!--      for slick start-->
    <script type="text/javascript" src="assets/js/slick.min.js"></script>
<!--    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>-->
<!--    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>-->
    <script type="text/javascript">
        $(document).ready(function(){
            $('.your-class').slick({
                dots: true,
                infinite: true,
                speed: 390,
                fade: true,
                cssEase: 'linear',
                autoplay: true,
            });
        });
    </script>

<!--    <script>-->
<!--        var slideIndex = 0;-->
<!--        showSlides();-->
<!---->
<!--        function showSlides() {-->
<!--            var i;-->
<!--            var slides = document.getElementsByClassName("mySlides");-->
<!--            var dots = document.getElementsByClassName("dot");-->
<!--            for (i = 0; i < slides.length; i++) {-->
<!--                slides[i].style.display = "none";-->
<!--            }-->
<!--            slideIndex++;-->
<!--            if (slideIndex > slides.length) {slideIndex = 1}-->
<!--            for (i = 0; i < dots.length; i++) {-->
<!--                dots[i].className = dots[i].className.replace(" active", "");-->
<!--            }-->
<!--            slides[slideIndex-1].style.display = "block";-->
<!--            dots[slideIndex-1].className += " active";-->
<!--            setTimeout(showSlides, 1000); // Change image every 2 seconds-->
<!--        }-->
<!--    </script>-->
    
  </body>
</html>