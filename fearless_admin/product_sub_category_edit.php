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
	        $CatID=$_REQUEST["SubCategoryID"];
			$allowedfiletypes = array("jpeg","jpg","gif","png");
		    $uploadfolder = "../menuimage/" ;
			$bigimg=$_POST["bigimg"]; 
		    $uploadfilename = $_FILES['uploadimage']['name'];
		    $fileext = strtolower(substr($uploadfilename,strrpos($uploadfilename,".")+1));
		    if (!empty($uploadfilename) and !in_array($fileext,$allowedfiletypes)) 
			{ 
			header("Location:product_sub_category_edit.php?msg=Add New Icon&SubCategoryID=$CatID");
			die();		
		    }
		    else if(!empty($uploadfilename))
		    {
			 @unlink($uploadfolder.$bigimg);			
			 $file1 = $uploadfolder.$CatID.$_FILES['uploadimage']['name'];
			 $bigimg=$CatID.$_FILES['uploadimage']['name']; 
			 move_uploaded_file($_FILES['uploadimage']['tmp_name'], $file1);
			}

	        
	  
			$rs=mysqli_query($con, "UPDATE product_sub_category SET CategoryID='".$_POST["ProductCategory"]."',
			SubCategoryName='".$_POST["CategoryName"]."',
			Description='".$_POST["CategoryDescription"]."',ActiveStatus='".$_POST["ActiveStatus"]."',
			IconName='".$bigimg."'
			WHERE SubCategoryID='".$_POST["SubCategoryID"]."'");
			
			 header("Location:product_list1.php?msg=Successfully Edit Product Sub Category&CategoryID=".$_POST["ProductCategory"]."");	
	  }
	  $rs=mysqli_query($con, "SELECT * FROM product_sub_category WHERE SubCategoryID='".$_REQUEST["SubCategoryID"]."'");
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
						<h5><?php print isset($_REQUEST['msg'])?$_REQUEST['msg']:"Edit Product Category"; ?></h5>
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
									<label for="input-medium">Category  Name:</label>
								</div>
								<div class="input">
								  <select name="ProductCategory" id="ProductCategory">
								  <?php
								   $prs=mysqli_query($con, "SELECT
											product_category_info.CategoryID
											, product_category_info.CategoryName
										FROM
											product_category_info  WHERE ActiveStatus='Active' ORDER BY orderid");
									while($prow=mysqli_fetch_row($prs))
									{
									 if($row[1]==$prow[0])
									 {
								 ?>
								  <option value="<?php print $prow[0]; ?>" selected="selected"><?php print $prow[1]; ?></option>
								  <?php }
								  else
								  { ?>
								  <option value="<?php print $prow[0]; ?>"><?php print $prow[1]; ?></option>
								  <?php }} ?>
							      </select>
							    </div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Sub Category  Id:</label>
								</div>
								<div class="input">
					<input id="SubCategoryID" name="SubCategoryID"  class="small valid" type="text" readonly value="<?php print $row[0]; ?>">
					<input id="bigimg" name="bigimg" type="hidden" value="<?php print $row[5]; ?>">
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Sub Category  Name:</label>
								</div>
								<div class="input">
									<input id="CategoryName" name="CategoryName"  class="small valid" type="text" value="<?php print $row[2]; ?>">
								</div>
							</div>
					  <div class="field">
								<div class="label">
									<label for="input-large">Description:</label>
						  </div>
								<div class="input">
								  <textarea name="CategoryDescription" cols="50" rows="5" id="CategoryDescription" ><?php print $row[3]; ?></textarea>
						  </div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-large">Active Status:</label>
						  </div>
								<div class="input">
								<select name="ActiveStatus" id="ActiveStatus"> 
								<?php 
								 if($row[4]=="Active")
								 {
								 $active="selected=\"selected\"";
								 $inactive="";
								 }
								 else if($row[4]=="InActive")
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
							<?php
							  if($row[5]!="")
							  {
							?>
							 <div class="field">
								<div class="label">
									<label for="input-valid">Sub Category Icon:</label>
								</div>
							  <div class="select">
							    <img src="../menuimage/<?php print $row[5]; ?>" width="100" height="100" />
							  </div>

							</div>
							<?php } ?>
							<div class="field">
								<div class="label">
									<label for="input-valid">Change Sub Category Icon:</label>
								</div>
							  <div class="select">
							    <input name="uploadimage" type="file" id="uploadimage" />
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