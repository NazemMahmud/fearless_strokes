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
    <title>Fearless Strokes | Home Junction</title>

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
          	<div id="filter" class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Home junction LIST</strong>
                    </div>
                    <div class="panel-body">
                        <ul style="list-style-type:none;">
                            <?php
                            $sql = mysqli_query($con, "SELECT * FROM hj_category_info");
                            while($row=mysqli_fetch_row($sql)){
                                ?>
                                <li><a href="product_hj?id=<?php echo $row[0]?>"><?php echo $row[1]?></a></li>
                                <?php
                            }
                            ?>
                            
<!--
                            <li><a href="#">Placements</a></li>
                            <li><a href="#">Cushion Covers</a></li>
-->
                            
                        </ul>
                    </div>
                </div>
            </div>
            
           	<div class="col-md-9">
              	<div class="col-md-12 col-sm-12 creative">
                    <div class="col-md-3 col-sm-4  homejunc_logo" style="float: left; margin-left:-7%;">
                        <a class=""><img src="assets/images/home-junction5.jpg" alt="home junctions" style=""></a></div>
                    <div class="col-md-9 col-sm-8">
                        <p class="" style="margin-top: 2%; text-align:left;">Home Junction is a concern of Alokito Hridoy Foundation and has been launched with an aim to empower the lives of vulnerable and struggling women by training them in making jute-based home products. Once the training has been conducted, they are also provided with job opportunities to ensure sustainability on both ends.
                        <br><br>Home Junction brings to you a wide array of designs that are sophisticated, fresh and exciting. We incorporate an element of our ethnicity with contemporary designs to strike a perfect balance between subtle and statement.</p>
                    </div>
            	</div>
             
             	<div class="clearfix"></div>
               
                <div  class="product-list">
                    <div id="products" class="list-group ">
                      <?php
                        $sql = mysqli_query($con, "SELECT category_id,category_name,category_description,image  FROM hj_category_info ORDER BY orderid asc "); 
                        while($row=mysqli_fetch_row($sql)){  ?>
                            <a href="product_hj?id=<?php echo $row[0]; ?>" style="margin-bottom: 10px;">
                                <div class="item  col-xs-12 col-lg-5 col-md-4">
<!--                                    <div class="thumbnail">-->
                                        <img class="group list-group-image" src="menuimage/homejunction/<?php echo $row[3]?>" alt="<?php echo $row[1]?>" />
                                        <div class="caption">
                                            <h4 class="" style="text-align: center;"><?php echo $row[1]?></h4>
                                            <p class="group inner list-group-item-text"><br></p>
<!--
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6">
                                                    
                                                </div>
                                                <div class="col-xs-12 col-md-6">
                                                    <p class="lead pull-right">
                                                        ট 21.000</p>
                                                </div>
                                            </div>
-->
                                        </div>
<!--                                    </div>-->
                                </div>
                            </a>
                            
                       <?php }
                        ?>
                      
<!--
                            <a href="artist_product-detail.php">
                                <div class="item  col-xs-12 col-lg-6">
                                    <div class="thumbnail">
                                        <img class="group list-group-image" src="assets/images/product/new_category_3.jpg" alt="" />
                                        <div class="caption">
                                            <h4 class="group inner list-group-item-heading">
                                                Product title</h4>
                                            <p class="group inner list-group-item-text">Lorem Ipsum is simply dummy text.</p>
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6">
                                                <p><i>By Mayeesha Rabbani</i></p>
                                            </div>
                                                <div class="col-xs-12 col-md-6">
                                                    <p class="lead pull-right">
                                                        ট 21.000</p>
                                                </div>
    
                                             <!--   <div class="col-xs-12 col-md-6">
                                                    <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
                                                </div> 
--   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
-->
                           
                            
                        </div>
                    </div>
                </div>            
           </div>          
        </div>        
<!--    </div>-->
    
    <div class="container">
    	<?php include("footer.php"); ?>
    </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap-select.js" ></script>
    <script>
	   	 $(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
});
	
	$(function() {
    	$( "#slider-range" ).slider({
      		range: true,
			min: 500,
			max: 5000,
			values: [ 500, 5000 ],
			slide: function( event, ui ) {
        		$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      		}
    	});
    	
		$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      		" - $" + $( "#slider-range" ).slider( "values", 1 ) );
  		});
  	</script>
     
    <script type="text/javascript" src="assets/js/plugin.js"></script>
    
  </body>
</html>