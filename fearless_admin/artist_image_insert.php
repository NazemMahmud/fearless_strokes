<?php
		session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
		include("connection.php");
	    $Date=MakeDate();

	if(isset($_POST["btnAdd"]))
	  {
		 $active = 1;

        $target = "../artist_images/";  //This is the directory where images will be saved
        $target = $target . basename( $_FILES['ArtistImage']['name']);
        $image_path = "artist_images/" . basename( $_FILES['ArtistImage']['name']);

        //This gets all the other information from the form
        $Filename=basename( $_FILES['ArtistImage']['name']);

        //Writes the Filename to the server
        if(move_uploaded_file($_FILES['ArtistImage']['tmp_name'], $target)) {
            //Tells you if its all ok
//            echo "The file ". basename( $_FILES['ArtistImage']['name']). " has been uploaded, and your information has been added to the directory";
            // Connects to your Database
//            mysql_connect("localhost", "root", "") or die(mysql_error()) ;
//            mysql_select_db("altabotanikk") or die(mysql_error()) ;

            //Writes the information to the database
//            mysql_query("INSERT INTO picture (Filename,Description)
//            VALUES ('$Filename', '$Description')") ;
              $rs=mysqli_query($con, "INSERT INTO artist_image_details 
		 	(
			artist_id,
            images,
			image_title,
			active
			)
			VALUES
			(
            '".$_REQUEST['ArtistName']."',
			'".$image_path."',
			'".$_REQUEST["ImageName"]."',
			'$active'
			)");
//              echo "<script>alert('Image insert successfull.');</script>";
        } else {
            //Gives and error if its not
            echo "Sorry, there was a problem uploading your file.";
        }
	  }
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo $site_name; ?></title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<!-- stylesheets -->
		<link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="resources/css/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="resources/css/style_fixed.css" />
		<link id="color" rel="stylesheet" type="text/css" href="resources/css/colors/<?php echo $theme_color; ?>.css" />
		<!-- scripts (jquery) -->
		<script src="resources/scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
		<!--[if IE]><script language="javascript" type="text/javascript" src="resources/scripts/excanvas.min.js"></script><![endif]-->
		<script src="resources/scripts/jquery-ui-1.8.custom.min.js" type="text/javascript"></script>
		<script src="resources/scripts/jquery.ui.selectmenu.js" type="text/javascript"></script>
		<script src="resources/scripts/jquery.flot.min.js" type="text/javascript"></script>
		<script src="resources/scripts/tiny_mce/jquery.tinymce.js" type="text/javascript"></script>
		<!-- scripts (custom) -->
		<script src="resources/scripts/smooth.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.menu.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.chart.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.table.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.form.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.dialog.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.autocomplete.js" type="text/javascript"></script>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
         <style type="text/css">
		.btnsdt
			{
			background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;"
			
			}
		</style>
	</head>
	<body>
		
		<!-- dialogs -->
		<div id="dialog-form" title="Create new user">
		  <p>&nbsp;</p>
		</div>
		<!-- end dialogs -->
		<!-- header -->
		<?php  
		 include("header.php");
		?>
		<!-- end header -->
		<!-- content -->
		<div id="content">
			<!-- end content / left -->
			<div id="left">
				<div id="menu">
					<?php include("navigation.php"); ?>
				</div>
				
      </div>
			<!-- end content / left -->
			<!-- content / right -->
		<div id="right">
				<!-- table -->
				<div class="box">
					<!-- box / title -->
					<div class="title">
						<h5>Insert Artist</h5>
						<div class="search">
							<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customersss" method="post" enctype="multipart/form-data">
							</form>
						</div>
					</div>
					<!-- end box / title -->
					
					
					<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
						<div class="form">
						<div class="fields">
                            <div class="field">
                                <div class="label">
                                    <label for="input-medium">Artist Name:</label>
                                </div>
                                <div class="input">
                                    <select name="ArtistName" id="ProductArtistID" >
                                      <option value="">Select Artist</option>
                                      <?php
                                       $sqlartist=mysqli_query($con, "SELECT id,artist_name FROM artist");
                                       while($artistRow=mysqli_fetch_row($sqlartist))
                                       {
                                      ?>
                                      <option value="<?php print $artistRow[0]; ?>"><?php print $artistRow[1]; ?></option>
                                      <?php
                                      }
                                      ?>
                                    </select>

                                </div>
					        </div>
							
							<div class="field">
								<div class="label">
									<label for="input-medium">Image Title:</label>
								</div>
								<div class="input">
									<input id="UserName" name="ImageName" value="" class="small valid" type="text">
								</div>
							</div>
                           
                                                
                            
                            <div class="field">
								<div class="label">
									<label for="input-large">Image:</label>
								</div>
								<div class="select">
									<input  name="ArtistImage" class="small valid" type="file" id="fileToUpload">  <label for="input-valid"><strong>resolution must be (1080 x 1440)</strong></label>
								</div>
							</div>
                            
                            
                               <div class="buttons">
							
							 <div class="highlight">
								 <input type="submit" name="btnAdd" value="   Add    " class="btnsdt" style="color:white;"/> 
							 </div>
							
						  </div>
						 
						  
						<!-- pagination -->
						
						<!-- end pagination -->
						<!-- table action -->
						<!-- table action -->
						
						<!-- end table action -->
                        </div>
                    </div>
				  </form>
			  
		  
				<!-- end table --><!-- messages -->
				
				<!-- end box / left -->
				<!-- box / right -->
				
	</div>
    </div>			<!-- end box / right --><!-- end content / right --><!-- end content -->
		<!-- footer -->
		<?php include("footer.php"); ?>
		<!-- end footert -->
            <script type="text/javascript">
                        var _URL = window.URL || window.webkitURL;

                        $("#fileToUpload").change(function(e) {
                          // alert("sdasd");
                          var image, fileToUpload;

                          if ((fileToUpload = this.files[0])) {
                             // alert("sdasd");
                            image = new Image();

                            image.onload = function() {
                             // alert("sdasd");
                              if(this.width!=1080 || this.height!=1440){
                                 $("#fileToUpload").val('');
                                 alert("The image size must be 1080 X 1440");

                              }


                            };

                            image.src = _URL.createObjectURL(fileToUpload);


                          }

                        });
            </script>
	</body>
</html>