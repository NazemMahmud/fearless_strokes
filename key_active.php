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

	    <title>Fearless Strokes</title>

		<link rel="icon" href="assets/images/logo.png" type="image/png" sizes="16x16">
	    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	    
	    
	    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	    <link href="assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">
	    
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	    
	    <link rel="stylesheet" href="assets/css/style.css">
	    

	    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	    
	    <style type="text/css">
	    	a:hover {color: red;}
	    </style>
	  </head>
	<body>
		<header>
		    <div class="container">
		        <div class="row">
		          	<div class="col-md-3 col-sm-3 hidden-xs">
		          		<a href="index"><img src="assets/images/logo.png" class="img-responsive" alt=""></a>
		          	</div>
		          	<div class="col-md-6 col-sm-6">
		          		<div class="row">
		              		<div class="col-md-6 col-md-offset-3">
		                		<div id="custom-search-input">
		                    		<div class="input-group col-md-12">
		                        		<input type="text" class="form-control input-sm" placeholder="Search" />
		                        		<span class="input-group-btn">
		                                	<button class="btn btn-info btn-sm" type="button">
		                                        <i class="glyphicon glyphicon-search"></i>
		                                    </button>
		                        		</span>
		                   	 		</div>
		                		</div>
		            		</div>
		            	</div>
		          	</div>
		       		<div class="col-md-1 col-md-offset-2 col-sm-3">
		       			<button type="button" class="multiselect dropdown-toggle btn btn-default btn-sm" data-toggle="dropdown" style="width: auto;" title="BDT"><span class="glyphicon fa fa-money"></span> BDT</button>
					</div>
		        </div>
		    </div>
		</header>
		<div class="container">
			<div class="row" style="font-size:20px;" >
				<div class="col-md-8 col-sm-8 col-md-offset-3" > 
					<p><br><br><br><br> Thank you for signing up. Please check your email for confirmation!</p>
					<a href="artists" style="color:red; text-decoration: underline;">Go to home page</a>
					<?php
					$rs = mysqli_query($con,  "SELECT * FROM  artist order by id desc limit 1"); 
					?>
				</div>

				
			</div>
		</div>
		
	</body>
</html> 