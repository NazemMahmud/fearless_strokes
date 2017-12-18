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
		 $DivisionID=$_REQUEST["DivisionID"];
		 if($_POST["DivisionName"]!="")
		 {
		 
		   
		 
   $rs=mysqli_query($con, "UPDATE division_info SET DivisionName='".$_POST["DivisionName"]."',ActiveStatus='".$_POST["ActiveStatus"]."' WHERE DivisionID='".$DivisionID."'");
             header("Location:division_list.php?msg=Successfully Updated Division Name...");

			 
		 }
		 else
		 {
		      header("Location:edit_division.php?msg=Please Enter a Division Name To Edit&DivisionID=$DivisionID");
		 }	
	  }
	  
	 $rs=mysqli_query($con, "SELECT * FROM division_info WHERE DivisionID='".$_REQUEST["DivisionID"]."'");
	 $row=mysqli_fetch_row($rs);
			
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
						<h5><?php print isset($_REQUEST['msg'])?$_REQUEST['msg']:"Edit Division"; ?></h5>
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
									<label for="input-medium">Division  Name:</label>
								</div>
							  <div class="input">
									<input id="DivisionName" name="DivisionName"  class="small valid" type="text" value="<?php print $row[1]; ?>">
								    <input type="hidden" name="DivisionID" id="DivisionID" value="<?php print $_REQUEST["DivisionID"]; ?>" />
								</div>
							</div>
					        <div class="field">
								<div class="label">
									<label for="input-medium">Active Status:</label>
								</div>
								<div class="input">
								  <select name="ActiveStatus" id="ActiveStatus">
								  <?php
								    if($row[2]=="Active")
									{
									 $active="selected=\"selected\"";
									 $inactive="";
									}
									else
									{
									 $active="";
									 $inactive="selected=\"selected\"";
									}
								  ?>
								  <option value="Active" <?php print $active; ?>>Active</option>
								  <option value="InActive" <?php print $inactive; ?>>InActive</option>
							      </select>
							    </div>
							</div>
							<div class="buttons">
							
							 <div class="highlight">
								 <input name="btnEdit" type="submit" class="btnsdt" id="btnEdit" style="color:white;" value="   Edit"/>
							     
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