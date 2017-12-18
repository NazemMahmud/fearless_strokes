<?php
session_start();
if(empty($_SESSION['MemberEmail']) )
{
    header("Location:artists");
    die();
}
include("fearless_admin/connection.php");
include("fearless_admin/thumb.php");

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

if(isset($_POST["btnEdit"]))
{ 
        $target = "artist/"; //This is the directory where images will be saved
        $img = $_POST["hiddenimg"]; // from line 233
        $passwrd = $_POST["hiddenpassword"];
      //  echo "password original". $passwrd;
        if( $_FILES['ArtistImage']['name'] != "")
        {    
            @unlink($target.$img);
            
            $target1 = $target . basename( $_FILES['ArtistImage']['name']);
            $img=basename( $_FILES['ArtistImage']['name']);
            move_uploaded_file($_FILES['ArtistImage']['tmp_name'], $target1); 
            $ext=strtolower(substr(strrchr($target1,"."),1));
            save_scaled($target1,$img,$ext,360,460);
        }
        if(!empty($_REQUEST["ArtistPassword"])){
          // $passwrd = $_POST["ArtistPassword"];	
           $rs=mysqli_query($con, "UPDATE artist SET  
			artist_name='".$_REQUEST["ArtistName"]."',
			artist_bio='".$_REQUEST["ArtistBio"]."',
			artist_email='".$_REQUEST["ArtistEmail"]."',
			artist_phone='".$_REQUEST["ArtistContact"]."',
			artist_image='$img',
			artist_password = PASSWORD('".$_REQUEST["ArtistPassword"]."')
			WHERE id='".$_REQUEST["id"]."'");
        }else{
        //echo "condition e dhuke password: ". $passwrd;
        	$rs=mysqli_query($con, "UPDATE artist SET  
			artist_name='".$_REQUEST["ArtistName"]."',
			artist_bio='".$_REQUEST["ArtistBio"]."',
			artist_email='".$_REQUEST["ArtistEmail"]."',
			artist_phone='".$_REQUEST["ArtistContact"]."',
			artist_image='$img',
			artist_password = '".$passwrd ."'
			WHERE id='".$_REQUEST["id"]."'");
        }
             
        
		 
		 
		// $userID=MakeID($con, "user_admin","UserID","USR-",10);
		 
			if($rs){
                print "<script>alert('Information Updated Successfully');window.location.href='profile?id=".$_REQUEST['id']."'</script>";
            }
					  
		$msg=isset($rs)? "Successfully Updated...":"Can not Update";
			
}

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
            <!-- <div class="nav navbar-nav navbar-right col-md-1 col-md-offset-2 collapse navbar-collapse js-navbar-collapse" >
                <a href="#" data-toggle="modal" data-target="#registrationModal">Register</a>
            </div> -->
          
    
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
           			$sqlartist = mysqli_fetch_row(mysqli_query($con, "SELECT id, artist_name FROM artist WHERE id='".$id."' ")); 
           		 ?>
           		<div class="col-sm-12 creative">
            		<h1 class="heading" style="text-transform: capitalize;" ><a href="profile?id=<?php echo $sqlartist[0];?>" ><?php echo $sqlartist[1]; ?></a></h1>
            	</div>
             	<div class="clearfix"></div>
             	<?php if ( !empty($_SESSION['MemberEmail'])){ 
                     if ($id==$sessionId) {
                ?>
             		
                  <div class="col-md-12 col-sm-12 artimg" style="">
                      <div class="nav navbar" style="background-color: #60646d; color:#fff " >
                        <h5 style="font-size: 16px;" >&nbsp; Account Information</h5>
                      </div>
                      
                      
                      <form class="form-horizontal" name="account" action="account?id=<?php echo $_SESSION['MemberId'];?>" enctype="multipart/form-data" method="post">
                          <?php
	                        $row=mysqli_fetch_row(mysqli_query($con, "SELECT * FROM artist WHERE ID='".$_REQUEST["id"]."' "));
                          ?>
<!--                          artist name-->
                          <div class="form-group">
				            <label class="control-label col-md-2 col-sm-2" for="name">Name: </label>
				            <div class="col-md-7 col-sm-7">
				                <input id="UserName" name="ArtistName" value="<?php print @$row[1] ?>" class="form-control" type="text">
				            </div>
                          </div>
<!--                          artist bio      -->
                          <div class="form-group">
				            <label class="control-label col-md-2 col-sm-2" for="name">Bio: </label>
				            <div class="col-md-7 col-sm-7">
				                <textarea id="UserBio" name="ArtistBio" value="<?php print @$row[2];?>" cols="90" rows="5" maxlength="350" class="form-control"><?php print $row[2] ?></textarea>
				            </div>
                          </div>
                          <!--                          artist image      -->
                          <?php
                              if(!empty($row[5])){ ?>
                                  <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2" for="email">Image:</label>
                                    <div class="col-sm-10">
                                      <img src="artist/<?php echo @$row[5]?>" name="hiddenimage" alt="artist image">
                                           <!-- <input id="UserName" name="ImageName" value="" class="small valid" > -->
                                    </div>
                                  </div>
                           <?php   }
                          ?>
                          <input type="hidden" name="hiddenimg" value="<?php print $row[5]; ?>"> <!--to 28 no. line-->
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2" for="pwd">Insert Image:</label>
                            <div class="col-sm-10">          
                              <input type="file" class="form-control"  placeholder="Enter image" name="ArtistImage" id="fileToUpload">
                              <!-- <input name="ArtistImage" class="small valid" type="file">  
                              <label for="input-valid"><strong>resolution must be (360 x 460)</strong></label>  -->
                            </div>
                          </div>
                          
                          <!--                          artist conatct      -->
                          <div class="form-group">
				            <label class="control-label col-md-2 col-sm-2" for="name">Contact No.: </label>
				            <div class="col-md-7 col-sm-7">
				                <input id="UserContact" name="ArtistContact" value="<?php print @$row[4] ?>" class="form-control" type="text">
				            </div>
                          </div>
                          <!--                          artist email      -->
                          <div class="form-group">
				            <label class="control-label col-md-2 col-sm-2" for="name">Email: </label>
				            <div class="col-md-7 col-sm-7">
				                <input id="UserEmail" name="ArtistEmail" value="<?php print @$row[3] ?>" class="form-control" type="text">
				            </div>
                          </div>
                          <!--                          artist password      -->
                          <div class="form-group">
				            <label class="control-label col-md-2 col-sm-2" for="name">Change Password: </label>
				            <div class="col-md-7 col-sm-7">
				                <input id="UserPassword" name="ArtistPassword" value="" class="form-control" type="password" />
				                <input type="hidden" name="hiddenpassword" value="<?php print $row[6]; ?>">
				            </div>
                          </div>

                          <!-- button -->
                          <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" name="btnEdit" class="btn btn-success">Update Information</button>
                               <!-- <input type="submit" name="btnAdd" value="Add  Image" class="btn btn-success" style="color:white;">  -->
                            </div>
                          </div>
                      
                      </form>           
                    </div>
                
           		<?php } }?>
                
                </div>            
           </div>          
        </div>        
<!--    </div>-->
    
    <div class="container">
    	<?php include("footer.php"); ?>
    </div>
    <script type="text/javascript">
      /*  var _URL = window.URL || window.webkitURL;

        $("#fileToUpload").change(function(e) {
          // alert("sdasd");
          var image, fileToUpload;

          if ((fileToUpload = this.files[0])) {
             // alert("sdasd");
            image = new Image();
            
            image.onload = function() {
             // alert("sdasd");
              if(this.width!=360 || this.height!=460){
                 $("#fileToUpload").val('');
                 alert("The image size must be 360 X 460");

              }
              
            
            };
          
            image.src = _URL.createObjectURL(fileToUpload);


          }

        }); */
    </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap-select.js" /></script>
    <script>
//	   	 $(document).ready(function() {
//            $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
//            $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
//        });

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

