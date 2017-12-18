<?php
		session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
		include("connection.php");
	
	if(isset($_POST["btnEdit"]))
	  {
		 
		 
		// $UnitID=MakeID($con, "product_unit","UnitID","UNIT-",7);
		$ID = $_POST["ID"];
		if(mysqli_query($con, "UPDATE product_style SET StyleID='".$_POST["StyleID"]."',StyleName='".$_POST["StyleName"]."'
		 WHERE StyleID='".$_POST["ID"]."'"))
		{
		 // $ID = $_POST["StyleID"];
		  header("Location:product_style_edit.php?ID=$ID&&msg=Successfully Updated Product Style");		
		}
		else
		{
		   header("Location:product_style_edit.php?ID=$ID&&msg=Product Style Update Failed! Try Again");		
		}
			
			
			
			
			 
	  }
	$row = mysqli_fetch_row(mysqli_query($con, "SELECT StyleName FROM product_style WHERE StyleID = '".$_REQUEST["ID"]."'"));		
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
						<h5><?php print isset($_REQUEST['msg'])?$_REQUEST['msg']:"Update Product Style"; ?></h5>
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
									<label for="input-medium">Style  ID:</label>
								</div>
								<div class="input">
									<input id="StyleID" name="StyleID" readonly="readonly"  class="small valid" value="<?php echo $_REQUEST["ID"]; ?>" type="text">
                                    <input id="ID" name="ID"  type="hidden" value="<?php echo $_REQUEST["ID"]; ?>">
								</div>
							</div>
					  <div class="field">
								<div class="label">
									<label for="input-medium">Style  Name:</label>
								</div>
								<div class="input">
									<input id="StyleName" name="StyleName"  class="small valid" value="<?php echo $row[0]; ?>" type="text">
								</div>
							</div>
                     
						
							<div class="buttons">
							
							 <div class="highlight">
							 <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","add_option");
			 if($check_access=="yes")
			  {
			 ?>
								 <input type="submit" name="btnEdit" value="   EDIT    " class="btnsdt" style="color:white;"/>
					<?php } ?>		     
							 </div>
							
						  </div>
						
						<!-- pagination -->
						
						<!-- end pagination -->
						<!-- table action -->
						
						<!-- end table action -->
				  </form>
			  </div>
		  </div>
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