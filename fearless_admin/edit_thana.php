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
		 
		 
		 $ThanaID=$_POST["ThanaID"];
		   if($_POST["AreaName"]!="")
		   {
		     
			 $sql="UPDATE thana_info SET ThanaName='".htmlspecialchars($_POST["AreaName"],ENT_QUOTES)."',
			 ShortDescription='".htmlspecialchars($_POST["ShortDescription"],ENT_QUOTES)."',
			 DistrictID='".$_POST["DistrictName"]."',ActiveStatus='".$_POST["ActiveStatus"]."' WHERE ThanaID='".$ThanaID."'";
			 $rs=mysqli_query($con, "$sql");
			  
             header("Location:thana_list.php?msg=Successfully Updated Upazila/Poloce Station...");
		   }
		   else
		   {
		      header("Location:edit_thana.php?msg=Please Enter a Upazila or PS Name Name To Edit&ThanaID=$ThanaID");
		   }
			
		
	  }
	  
	  $ars=mysqli_query($con, "SELECT * FROM thana_info WHERE ThanaID='".$_REQUEST["ThanaID"]."'");
	  $arsRow=mysqli_fetch_row($ars);
			
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
						<h5><?php print isset($_REQUEST['msg'])?$_REQUEST['msg']:"Edit Upazila/Police Station"; ?></h5>
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
									<label for="input-medium">District  Name:</label>
								</div>
								<div class="input">
								  <select name="DistrictName" id="DistrictName">
								  
								  <?php
								    $rs=mysqli_query($con, "SELECT DistrictID,DistrictName FROM district_info WHERE ActiveStatus='Active' ORDER BY DistrictID DESC ");
									while($row=mysqli_fetch_row($rs))
									{
									 if($arsRow[3]==$row[0])
									 {
								  ?>
								  
								  <option value="<?php print $row[0]; ?>" selected="selected"><?php print $row[1]; ?></option>
								    <?php }
									else
									{ ?>
								<option value="<?php print $row[0]; ?>"><?php print $row[1]; ?></option>
								<?php  }} ?>
							      </select>
							    </div>
							</div>
					        <div class="field">
								<div class="label">
									<label for="input-medium">Upazila/PS  Name:</label>
								</div>
							  <div class="input">
									<input id="AreaName" name="AreaName"  class="small valid" type="text" value="<?php print $arsRow[1]; ?>">
								    <input type="hidden" name="ThanaID" value="<?php print $_REQUEST["ThanaID"]; ?>" />
							  </div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Short Description :</label>
								</div>
								<div class="input">
								  <textarea name="ShortDescription"><?php print $arsRow[2]; ?></textarea>
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Active Status:</label>
								</div>
								<div class="input">
								  <select name="ActiveStatus" id="ActiveStatus">
								  <?php
								    if($arsRow[4]=="Active")
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
								 <input name="btnEdit" type="submit" class="btnsdt" id="btnEdit" style="color:white;" value="   Edit  "/>
							     
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