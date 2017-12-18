<?php
		session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
		include("connection.php");
	
	if(isset($_POST["btnAdd"]))
	  {
		 
		 if($_REQUEST["Menu"]=="")
		 {
		   header("Location:insert_special.php?msg=Please Select A Menu");
		 }
		 $SpecialID=MakeID($con, "special_info","SpecialID","SPL-",8);
			$allowedfiletypes = array("jpeg","jpg","gif","png");
		$uploadfolder = "../specialimage/" ;
		$uploadfilename = $_FILES['uploadimage']['name'];
		$fileext = strtolower(substr($uploadfilename,strrpos($uploadfilename,".")+1));
		    if (!empty($uploadfilename) and !in_array($fileext,$allowedfiletypes)) 
			{ 
			header("Location:insert_special.php?msg=Add New Image");
			die();		
		    }
		    else if(!empty($uploadfilename))
		    {
			
			include("thumb.php");			
			$file1 = $uploadfolder.$SpecialID.$_FILES['uploadimage']['name'];
			//$bigimg=$ProductID.$_FILES['uploadimage']['name']; 
			move_uploaded_file($_FILES['uploadimage']['tmp_name'], $file1);
			
			$rs=mysqli_query($con, "INSERT INTO special_info 
			(SpecialID,
			Category,
			Title,
			Activestatus,
			Image
			) VALUES('".$SpecialID."','".$_POST["SpecialName"]."','".$_POST["Title"]."','InActive','".$file1."')");
			
			 header("Location:special_list.php?msg=Successfully Add Slide");
			 }	
			 else
			 {
			 header("Location:insert_special.php?msg=Upload A  Image");
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
						<h5><?php print isset($_REQUEST['msg'])?$_REQUEST['msg']:"Insert Special Item"; ?></h5>
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
									<label for="input-large">Category:</label>
						  </div>
								<div class="input">
								   <select name="SpecialName" id="SpecialName">
									 <option value="Corporate" selected="selected">Corporate</option>
									 <option value="Cosplay">Cosplay</option>
                                  </select>
						 		</div>
					  </div>
					  <div class="field">
								<div class="label">
									<label for="input-large">Description:</label>
						  </div>
								<div class="input">
								  <textarea name="Title" cols="21" rows="4" id="Title" ></textarea>
						 		</div>
					  </div>
							<div class="field">
								<div class="label">
									<label for="input-large">Image:</label>
						  </div>
							 	  <div class="input">
							    <input name="uploadimage" type="file" id="uploadimage" />
							  </div>
							</div>
							<div class="buttons">
							
							 <div class="highlight">
							 <?php
			  $check_access=check_access($con, $_SESSION["UserID"],"MOD-09","add_option");
							 if($check_access=="yes")
							  {
							 ?>
								 <input type="submit" name="btnAdd" value="   Add    " class="btnsdt" style="color:white;"/>
							  <?php } ?>   
							 </div>
							
						  </div>
						
						<!-- pagination -->
						
						<!-- end pagination -->
						<!-- table action -->
						
						<!-- end table action -->
                        </div>
		  </div>
				  </form>
			  
				<!-- end table --><!-- messages -->
				
				<!-- end box / left -->
				<!-- box / right -->
				
	</div>			<!-- end box / right -->
	</div>
   
			<!-- end content / right --><!-- end content -->
		<!-- footer -->
		<?php include("footer.php"); ?>
		<!-- end footert -->
	</body>
</html>