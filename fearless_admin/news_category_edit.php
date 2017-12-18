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
		 
		 
		// $CatID=MakeID($con, "product_category_info","CategoryID","PCAT-",10);
		//	$rs=mysqli_query($con, "INSERT INTO product_category_info
//			(CategoryID,
//			CategoryName,
//			CategoryDescrition,
//			ActiveStatus)
//            VALUES 
//			('".$CatID."',
//			'".$_POST["CategoryName"]."',
//			'".$_POST["CategoryDescription"]."',
//			'Active')");
			$rs=mysqli_query($con, "UPDATE news_category_info SET 
			CategoryName='".$_POST["CategoryName"]."',
			CategoryDescrition='".$_POST["CategoryDescription"]."',
			ActiveStatus='".$_POST["ActiveStatus"]."'
			 WHERE CategoryID='".$_POST["CategoryID"]."'");
			
			
			 header("Location:news_category_list.php?msg=Successfully Edit Notice and Circulation Category");	
	  }
	  $rs=mysqli_query($con, "SELECT * FROM news_category_info WHERE CategoryID='".$_REQUEST["CategoryID"]."'");
	  $row=mysqli_fetch_row($rs);
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>PEPEELIKA</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<!-- stylesheets -->
		<link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="resources/css/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="resources/css/style_fixed.css" />
		<link id="color" rel="stylesheet" type="text/css" href="resources/css/colors/red.css" />
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
			background-color:#F33;
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
						<h5><?php print isset($_REQUEST['msg'])?$_REQUEST['msg']:"Edit Notice & Circulation Category"; ?></h5>
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
									<label for="input-medium">Category  Id:</label>
								</div>
								<div class="input">
									<input id="CategoryID" name="CategoryID"  class="small valid" type="text" readonly value="<?php print $row[0]; ?>">
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Category  Name:</label>
								</div>
								<div class="input">
									<input id="CategoryName" name="CategoryName"  class="small valid" type="text" value="<?php print $row[1]; ?>">
								</div>
							</div>
					  <div class="field">
								<div class="label">
									<label for="input-large">Description:</label>
						  </div>
								<div class="input">
								  <textarea name="CategoryDescription" cols="50" rows="5" id="CategoryDescription" ><?php print $row[2]; ?></textarea>
						  </div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-large">Active Status:</label>
						  </div>
								<div class="input">
								<select name="ActiveStatus" id="ActiveStatus"> 
								<?php 
								 if($row[3]=="Active")
								 {
								 $active="selected=\"selected\"";
								 $inactive="";
								 }
								 else if($row[3]=="InActive")
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
								 <input type="submit" name="btnEdit" value="   Edit   " class="btnsdt" style="color:white;"/>
							     
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