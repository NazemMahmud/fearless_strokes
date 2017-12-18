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
        @media (min-width: 768px) {
            .modal-dialog {
                width: 630px;
                margin: 30px 242px;
            }
        }
        /*@media (min-width: 586px) {*/
            /*.modal-dialog {*/
                /*width: 518px;*/
            /*}*/
        /*}*/
        /*@media (min-width: 481px ) {*/
            /*.modal-dialog {*/
                /*!*width: 616px;*!*/
                /*margin: 30px 202px;*/
            /*}*/
        /*}*/
        /*@media (min-width: 370px) {*/
            /*.modal-dialog {*/
                /*width: 616px;*/
            /*}*/
        /*}*/
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
                    <h1 class="heading" style="">Contact Us</h1>
            		
            	</div>
             
             	<div class="clearfix"></div>

                    <div class="col-md-8 col-md-offset-2" style="margin-bottom: 25px; margin-top: 30px;;">
                        <ul style="list-style: none;">
                            <li><p><strong>Address</strong>: &nbsp;&nbsp;&nbsp;3/11,Block B, Lalmatia, Dhaka-1206, Bangladesh</p></li><br>
                            <li><p><strong>Phone</strong>: &nbsp;&nbsp;&nbsp;&nbsp; +880-1742812044</p></li><br>
                            <li><p><strong>Email</strong>: &nbsp;&nbsp;&nbsp;&nbsp; fearless.strokes@gmail.com</p></li>
                        </ul>
                    </div>
            </div>
        </div>

        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="box-shadow: 0 0px 0px rgba(0,0,0,.5);">
                <h4 style="text-align:center; padding-top: 5px;">If you have any enquiry, please leave it here.</h4>
                <div class="modal-body" style="height: 400px;" >

                    <div class="">

                        <form class = "pure-form" id="emailForm" action="contact_submit" method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="" type="text" class="form-control" name="cust_name" placeholder="Your Name" required>
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input id="" data-fv-emailaddress-message="The value is not a valid email address"   type="email" class="form-control" name="cust_email" placeholder="Email Address" required>
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input id="" type="text" class="form-control" name="cust_number" placeholder="Contact No." required>
                            </div>
                            <br>
                            <br>

                             <div class="form-group">
                                <textarea maxlength="450" class="form-control" rows="5" id="comment" name="cust_message" placeholder="Your Message"></textarea>
                            </div>
                            <button style="float:right;" type="submit" class="pure-button btn-danger btn ">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="" role="dialog" style="">

    </div>

    
    <div class="container">
    	<?php include("footer.php"); ?>
    </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap-select.js" ></script>
    <script>
	   	 $(document).ready(function() {
             $('#emailForm').formValidation();
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