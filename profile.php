<?php
session_start();
include("fearless_admin/connection.php");
//if(empty($_SESSION['MemberEmail']) )
//{
//    header("Location:artists");
//    die();
//}
if(isset($msg)){
  print '<script>alert("Sorry, file already exists.")</script>';
}

$id = $_GET['id'];

// echo "LOGIN SUCCESSFUL with id the value is ".$id."   ";
if(!empty($_SESSION['MemberEmail']) )
{
    $name = $_SESSION['MemberEmail'];
    $sessionId = $_SESSION['MemberId'];
}

//echo $sessionId."is the name that is stored in the session";
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
    <!-- <link rel="stylesheet" type="text/css" href="fearless_admin/resources/css/style.css"> -->

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
        <script>
          var password = document.getElementById("passwordd")
            , confirm_password = document.getElementById("confirm_password");

          function validatePassword(){
            if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
            confirm_password.setCustomValidity('');
            }
          }

          password.onchange = validatePassword;
          confirm_password.onkeyup = validatePassword;
        </script>
    <!-- Alif scripts body for registration starts from here-->

		
	
        <div class="row clearfix"> 
          	<div class="col-sm-12 bar2 ">
            	Find your favourite arts here
          		<div class="divider"></div>
          	</div>
        </div>

        <div class="row" style="margin-top:15px;">
          	<div id="filter" class="col-md-3">
				<!--THIS IS THE FIRST ROW-->
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
						</div>
					</div>
				<!--THIS IS THE FIRST ROW ENDS-->

		 		
			</div>
            
           	<div class="col-md-9">
           		<?php
           			$sqlartist = mysqli_fetch_row(mysqli_query($con, "SELECT id, artist_name,artist_image,artist_bio FROM artist WHERE id='".$id."' ")); 
           		 ?>
           		<div class="col-sm-12 col-md-12 col-xs-12  creative">
	            		<div class="col-md-4 col-sm-4 col-xs-12" style="float: left; margin-left:-12%;">
	                        	<img class="" src="artist/<?php echo $sqlartist[2];?>" alt="" width="120" height="127">
	                        </div>
	                    	<div class="col-md-8 col-sm-8 col-xs-12" style="float: left; margin-left:-12%;">
	                        	<h4 class="" style="text-transform: capitalize;" ><a href="profile?id=<?php echo $sqlartist[0];?>" ><?php echo $sqlartist[1]; ?></a></h4>
	                        	<h4><?php echo $sqlartist[3];?></h4>
	                    	</div>
            	</div>
             	<div class="clearfix"></div>
             	<?php if ( !empty($_SESSION['MemberEmail'])){ 
                     if ($id==$sessionId) {
                ?>
             		
                  <div class="col-md-12 col-sm-12 artimg" style="">
                      <div class="nav navbar" style="background-color: #60646d; color:#fff " >
                        <h5 style="font-size: 16px;" >&nbsp; Image Upload</h5>
                      </div>
                      <form class="form-horizontal" action="upload.php" enctype="multipart/form-data" method="post">
                        
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Image Title:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="UserName" name="image_title" placeholder="Enter Image Title" required>
                               <!-- <input id="UserName" name="ImageName" value="" class="small valid" > -->
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Insert Image:</label>
                            <div class="col-sm-10">          
                              <input type="file" class="form-control"  placeholder="Enter image" name="fileToUpload" id="fileToUpload" required >
                              <!-- <input name="ArtistImage" class="small valid" type="file">   -->
<!--                              <label for="input-valid"><strong>resolution must be (1080 x 1440)</strong></label>-->
                            </div>
                          </div>
                          <!-- button -->
                          <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" name="btnAdd" class="btn btn-success">Upload Image</button>
                               <!-- <input type="submit" name="btnAdd" value="Add  Image" class="btn btn-success" style="color:white;">  -->
                            </div>
                          </div>
                      
                      </form>           
                    </div>
                
           		<?php } }?>
                <div  class="product-list">
					<div id="products" class="list-group">
                        <?php
                            $sql = mysqli_query($con, "SELECT * FROM `artist_detail` WHERE `artist_id` ='".$id."' AND active=1 ");
                            
                            while($row=mysqli_fetch_row($sql)){ 
                                $sql_artist = mysqli_fetch_row(mysqli_query($con, "SELECT id,artist_name FROM  artist WHERE id='".$row[1]."' ORDER BY id desc "));
                        ?>
                                <a href="">
                                    <div class="item  col-xs-6 col-lg-6">
                                        <div class="thumbnail">
                                            <img class="group list-group-image" src="<?php echo $row[2];?>"  alt="" />
                                            <div class="caption">
                                                <h4 class="group inner list-group-item-heading"> <?php echo $row[3]?> </h4>
                                               <div class="row">
                                                    <div class="col-xs-12 col-md-6">
                                                    <p><i>By <?php echo $sql_artist[1];?></i></p>
                                                </div>
                                                    <div class="col-xs-12 col-md-6">
                                                        <p> <br></p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                
                        <?php    }
                        ?>

                            
                        </div>
                    </div>
                </div>            
           </div>          
        </div>        
    </div>
    
    <div class="container">
    	<?php include("footer.php"); ?>
    </div>
    <script type="text/javascript">
//        var _URL = window.URL || window.webkitURL;
//
//        $("#fileToUpload").change(function(e) {
//          // alert("sdasd");
//          var image, fileToUpload;
//
//          if ((fileToUpload = this.files[0])) {
//             // alert("sdasd");
//            image = new Image();
//
//            image.onload = function() {
//             // alert("sdasd");
//              if(this.width!=1080 || this.height!=1440){
//                 $("#fileToUpload").val('');
//                 alert("The image size must be 1080 X 1440");
//
//              }
//
//
//            };
//
//            image.src = _URL.createObjectURL(fileToUpload);
//
//
//          }
//
//        });
    </script>
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

