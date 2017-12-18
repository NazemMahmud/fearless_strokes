<?php 
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
    
    <div class="container" style="min-height:420px;">
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
              	<div class="col-md-12 col-sm-12 creative">
                    <h1 class="heading" style="">About Us</h1>
            		
            	</div>
             
             	<div class="clearfix"></div>

                    <div class="col-md-8 col-md-offset-2" style="margin-bottom: 25px; margin-top: 10px;">
                        <h5>Fearless Strokes is a platform for art enthusiasts and artists where they can share their common love for Art. The idea was to create a platform for both;
                            someone who is passionate about art and wants to generate revenue through it and also someone who likes to collect artsy merchandises.<br><br>
                            It offers gorgeous artworks featured as remarkable products that are as meaningful, unique &amp;
                            personal as the art itself. You don’t have to follow design trends created for the ordinary when
                            there are local artists creating artwork for the aesthete, discrete &amp; selective buyer, just like you.<br><br>
                            We are not only giving a platform to our local artists, but we are also bringing about a change in
                            the lives of hundreds of children, who are studying in Alokito Hridoy Primary School in Tangail.
                            55% of the profits will be contributed towards the education of the children of Alokito Hridoy
                            Primary School. <br><br>
                            ‘Alokito Hridoy’ means ‘The Enlightened Soul’; similarly our aim at Alokito Hridoy Foundation is to enlighten the hearts and souls of the future generation.<br><br>
                            We are dedicated towards capacity development at every level to build an inclusive, just and poverty-free society of leading innovators.<br><br> 
                            Our mission is to empower the youth and children by enriching their lives through good quality education, health and sustainable livelihood skills and opportunities.
                        </h5>
                            
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