<?php
session_start();
    include("fearless_admin/connection.php");
    // echo $_SESSION['MemberEmail'];
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
        <div class="col-md-12" >
            
    
        </div>
		
		<!--Modal for Login-->
			
                
		<!--Modal for Login Ends-->
		
		<!--modal for registration starts-->
        
		<!--modal for registration ends-->
		
		<!-- Alif scripts body for registration starts from here-->
		
		<!-- Alif scripts body for registration starts from here-->
		
	
        <div class="row clearfix"> 
          	<div class="col-sm-12 bar2 ">
            	Find your favourite arts here
          		<div class="divider"></div>
          	</div>
        </div>

        
        
        <div class="row" style="margin-top:15px;">
          	<div id="filter" class="col-md-3">

<!--
            	<div class="panel panel-default" style="margin-top: 5px;">
                    <div class="panel-heading">
                        <strong>COLORS</strong>
                    </div>

                </div>
                <div class="color-ctrl">
                        <ul>
                            <li style="background-color:gray;"></li>
                            <li style="background-color:purple;"></li>
                            <li style="background-color:green;"></li>
                            <li style="background-color:red;"></li>
                            <li style="background-color:yellow;"></li>
                            <li style="background-color:orange;"></li>
                        </ul>
                </div>
-->
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>ARTIST LIST</strong>
                    </div>

                    <div class="panel-body">
                        <ul style="list-style-type:none;">
                            <?php
                            $sqlartist = mysqli_query($con, "SELECT id, artist_name FROM artist ");
                            while($row=mysqli_fetch_row($sqlartist)){ ?>
                                <li><a href="profile?id=<?php echo $row[0];?>"><?php echo $row[1]?></a></li>
                            <?php
                            }
                            ?>


                            
                        </ul>
<!--
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Illustration
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Digital
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Nature
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Abstruct
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> People
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Painting
                          </label>
                        </div>
-->
                    </div>
                </div>
            </div>
            
           	<div class="col-md-9">
              	<div class="col-sm-12 creative">
            		<h1 class="heading">Artist</h1>
<!--            		<p class="desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>-->
            	</div>
             
             	<div class="clearfix"></div>
               
                <div  class="product-list">
<!--                   	<div class="well well-sm">-->
<!--                    	<strong>Category Title</strong>-->
<!--                        <div class="btn-group">-->
<!--                        	<a href="#" id="list" class="btn btn-default btn-sm">-->
<!--	                            <span class="glyphicon glyphicon-th-list"></span>List-->
<!--                            </a> -->
<!--                            <a href="#" id="grid" class="btn btn-default btn-sm">-->
<!--                            	<span class="glyphicon glyphicon-th"></span>Grid-->
<!--                            </a>-->
<!--                       	</div>-->
<!--                   	</div>-->
                    
                    <div id="products" class="list-group">
                        <?php
                            $sql = mysqli_query($con, "SELECT id,artist_id,images,image_title FROM  artist_detail WHERE active=1 ORDER BY id desc ");
                            
                            while($row=mysqli_fetch_row($sql)){ 
                                $sql_artist = mysqli_fetch_row(mysqli_query($con, "SELECT id,artist_name FROM  artist WHERE id='".$row[1]."' ORDER BY id desc "));
                        ?>
                                <a href="">
                                    <div class="item  col-xs-6 col-lg-6">
                                        <div class="thumbnail">
                                            <img class="group list-group-image" src="<?php echo $row[2];?>"  alt="" />
                                            <div class="caption">
                                                <h4 class="group inner list-group-item-heading"> <?php echo $row[3]?> </h4>
    <!--                                            <p class="group inner list-group-item-text"><br></p>-->
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-6">
                                                    <p><i>By <?php echo $sql_artist[1];?></i></p>
                                                </div>
                                                    <div class="col-xs-12 col-md-6">
                                                        <p> <br></p>
                                                    </div>
        <!--
                                                    <div class="col-xs-12 col-md-6">
                                                        <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
                                                    </div>
        -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                
                        <?php    }
                        ?>
<!--
                        <a href="artist_product-detail.php">
                            <div class="item  col-xs-6 col-lg-6">
                                <div class="thumbnail">
                                    <img class="group list-group-image" src="assets/images/product/new_category_1.jpg" alt="" />
                                    <div class="caption">
                                        <h4 class="group inner list-group-item-heading">Product title</h4>
                                        <p class="group inner list-group-item-text">Lorem Ipsum is simply dummy text.</p>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <p><i> By Mayeesha Rabbani</i></p>
                                            </div>
                                                <div class="col-xs-12 col-md-6">
                                                    <p class="lead pull-right">
                                                        ট 21.000</p>
                                                </div>
  
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
    </div>
    
    <div class="container">
    	<?php include("footer.php"); ?>
    </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap-select.js" /></script>
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