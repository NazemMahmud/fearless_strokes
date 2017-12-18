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
		 
	   if($_POST["ProductCategoryID"]!="")
	   {
		 $ProductID=MakeID($con, "product_info","ProductID","PDT-",15);
		$allowedfiletypes = array("jpeg","jpg","gif","png");
		$uploadfolder = "productimage/" ;
		$uploadfilename = $_FILES['uploadimage']['name'];
		$fileext = strtolower(substr($uploadfilename,strrpos($uploadfilename,".")+1));
		    if (!empty($uploadfilename) and !in_array($fileext,$allowedfiletypes)) 
			{ 
			header("Location:insert_product.php?msg=Add New Image");
			die();		
		    }
		    else if(!empty($uploadfilename))
		    {			
			$file1 = $uploadfolder.$ProductID.$_FILES['uploadimage']['name'];
			$bigimg=$ProductID.$_FILES['uploadimage']['name']; 
			move_uploaded_file($_FILES['uploadimage']['tmp_name'], $file1);
			
			$rs=mysqli_query($con, "INSERT INTO product_info 
			(ProductID,
			CategoryID,
			Name,
			Brand,
			Model,
			Features,
			Plan,
			Price,
			Image,
			ActiveStatus)
            VALUES('".$ProductID."',
			'".$_POST["ProductCategoryID"]."',
			'".$_POST["ProductName"]."',
			'".$_POST["ProductBrand"]."',
			'".$_POST["ProductModel"]."',
			'".$_POST["ProductFeatures"]."',
			'".$_POST["ProductPlan"]."',
			".$_POST["ProductPrice"].",
			'".$bigimg."',
			'Active')");
			header("Location:product_list.php?msg=Product Successfully Added!");
			die();
		   }
		   else
		   {
			$rs=mysqli_query($con, "INSERT INTO product_info 
			(ProductID,
			CategoryID,
			Name,
			Brand,
			Model,
			Features,
			Plan,
			Price,
			ActiveStatus)
            VALUES('".$ProductID."',
			'".$_POST["ProductCategoryID"]."',
			'".$_POST["ProductName"]."',
			'".$_POST["ProductBrand"]."',
			'".$_POST["ProductModel"]."',
			'".$_POST["ProductFeatures"]."',
			'".$_POST["ProductPlan"]."',
			".$_POST["ProductPrice"].",
			'Active')");
			header("Location:product_list.php?msg=Product Successfully Added!");
			die();
		   }
		}
		else
		{
		  header("Location:insert_product.php?msg=Please Select A Product Category!");
			die();
		}
	  }
			
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
	     <script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
         </script>
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
						<h5><?php print isset($_REQUEST['msg'])?$_REQUEST['msg']:"Edit Article"; ?></h5>
						<div class="search">
							<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customersss" method="post" enctype="multipart/form-data">
							</form>
						</div>
					</div>
					<!-- end box / title -->
					
					
				<iframe src="editor/content_edit.php?CID=<?php print $_REQUEST["ContentID"]; ?>" height="600" width="100%" style="background:#FFFFFF;"></iframe>
			  </div>
		  </div>
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