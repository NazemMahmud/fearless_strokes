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
		 
		 $artistID=MakeID($con, "artist","id","",4);
       //This is the directory where images will be saved
        $target = "../artist/";
        $target = $target . basename( $_FILES['ArtistImage']['name']);

        //This gets all the other information from the form
        $Filename=basename( $_FILES['ArtistImage']['name']);
//        $Description=$_POST['Description'];


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
              $rs=mysqli_query($con, "INSERT INTO artist 
		 	(
            id,
			artist_name,
            artist_bio,
			artist_email,
			artist_phone,
            artist_image,
			artist_password
            
			)
			VALUES
			(
            '".$artistID."',
			'".$_REQUEST["ArtistName"]."',
			'".$_REQUEST["ArtistBio"]."',
            '".$_REQUEST["ArtistEmail"]."',
			'".$_REQUEST["ArtistContact"]."',
			'$Filename',
			PASSWORD('".$_REQUEST["ArtistPassword"]."')
			)");
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
									<label for="input-medium">Full  Name:</label>
								</div>
								<div class="input">
									<input id="UserName" name="ArtistName" value="<?php print @$row[1] ?>" class="small valid" type="text">
								</div>
							</div>
                            <div class="field">
								<div class="label">
									<label for="input-medium">Description:</label>
								</div>
								<div class="input">
                                    <textarea id="UserBio" name="ArtistBio" value="<?php print @$row[2] ?>" cols="50" rows="6" class="small valid"></textarea>
								</div>
							</div>
                            <div class="field">
								<div class="label">
									<label for="input-large">Artist Contact:</label>
								</div>
								<div class="input">
									<input id="UserContact" name="ArtistContact" value="" class="small valid" type="text">
								</div>
							</div>
                            <div class="field">
								<div class="label">
									<label for="input-large">Artist Email:</label>
								</div>
								<div class="input">
									<input id="UserEmail" name="ArtistEmail" value="" class="small valid" type="text">
								</div>
							</div>
                            
<!--
                            <div class="field">
								<div class="label">
									<label for="input-large">User Contact:</label>
							  </div>
								<div class="input">
									<input id="UserContact" name="UserContact" value="" class="small valid" type="text">
								</div>
					  </div>
-->
                            
                            
                            <div class="field">
								<div class="label">
									<label for="input-large">Artist Image:</label>
								</div>
								<div class="input">
									<input  name="ArtistImage" class="small valid" type="file">
								</div>
							</div>

                            <div class="field">
								<div class="label">
									<label for="select-button">Artist Password:</label>
								</div>
								<div class="input">
								  <input id="UserPassword" name="ArtistPassword" value="" class="small valid" type="password" />
								</div>
							</div>
                            
                            
                               <div class="buttons">
							
							 <div class="highlight">
							 <?php
//							$check_access=check_access($con, $_SESSION["UserID"],"MOD-06","add_option");
//							 if($check_access=="yes")
//							  {
							 ?>
								 <input type="submit" name="btnAdd" value="   Add    " class="btnsdt" style="color:white;"/>
							 <?php  ?>    
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
	</body>
</html>