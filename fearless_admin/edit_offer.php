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
		
	    //$Date=MakeDate();
		 $OfferID=$_POST["OfferID"];
		$allowedfiletypes = array("jpeg","jpg","gif","png");
		$uploadfolder = "offerimage/" ;
		$uploadfilename = $_FILES['uploadimage']['name'];
		$fileext = strtolower(substr($uploadfilename,strrpos($uploadfilename,".")+1));
		    if (!empty($uploadfilename) and !in_array($fileext,$allowedfiletypes)) 
			{ 
			header("Location:offer_add.php?msg=Add New Image");
			die();		
		    }
		    else if(!empty($uploadfilename))
		    {			
			$file1 = $uploadfolder.$OfferID.$_FILES['uploadimage']['name'];
			$bigimg=$OfferID.$_FILES['uploadimage']['name']; 
			move_uploaded_file($_FILES['uploadimage']['tmp_name'], $file1);
			
			$rs=mysqli_query($con, "UPDATE offers_info SET 
			CategoryID='".$_POST["OfferCategoryID"]."',
			Title='".$_POST["title"]."',
			Subject='".$_POST["subject"]."',
			Description='".$_POST["description"]."',
			Image='".$bigimg."',
			ActiveStatus='".$_POST["ActiveStatus"]."' 
			WHERE OfferID='".$_POST["OfferID"]."'");
			header("Location:offer_list.php?msg=Offer Successfully Update!");
			die();
		   }
		   else
		   {
			$rs=mysqli_query($con, "UPDATE offers_info SET 
			CategoryID='".$_POST["OfferCategoryID"]."',
			Title='".$_POST["title"]."',
			Subject='".$_POST["subject"]."',
			Description='".$_POST["description"]."',
			ActiveStatus='".$_POST["ActiveStatus"]."' 
			WHERE OfferID='".$_POST["OfferID"]."'");
			header("Location:offer_list.php?msg=Offer Successfully Update!");
			die();
		   }
		
		}
		
	  
$rs=mysqli_query($con, "SELECT * FROM offers_info WHERE OfferID='".$_REQUEST["OfferID"]."'");
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
						<h5><?php print isset($_REQUEST['msg'])?$_REQUEST['msg']:"Edit Offer"; ?></h5>
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
									<label for="input-medium">Offer Id :</label>
								</div>
								<div class="input">
									<input id="OfferID" name="OfferID" class="small valid" type="text" readonly value="<?php print $row[0]; ?>">
								</div>
							</div>
						<div class="field">
								<div class="label">
									<label for="input-medium">Offer Category :</label>
								</div>
								<div class="input">
								 <?php
		 print $a=MakeCombo($con, "SELECT CategoryID,CategoryName FROM offers_category_info ORDER BY CategoryID DESC ","OfferCategoryID","$row[1]");
								 ?>
							    </div>
					  </div>
						<div class="field">
								<div class="label">
									<label for="input-medium">Offer Title :</label>
								</div>
								<div class="input">
									<input id="title" name="title" class="small valid" type="text" value="<?php print $row[2]; ?>">
								</div>
							</div>
					  <div class="field">
								<div class="label">
									<label for="input-large">Offer Subject  :</label>
						  </div>
						  <div class="input">
						    <input id="subject" name="subject" class="small valid" type="text" value="<?php print $row[3]; ?>" />
						  </div>
					  </div>
							<div class="field">
								<div class="label">
									<label for="input-valid">Description:</label>
								</div>
							  <div class="select">
							    <textarea name="description" cols="50" rows="5" id="description"><?php print $row[4]; ?></textarea>
							  </div>
                                
                          

                                
							</div>
							<div class="field">
								<div class="label">
									<label for="input-valid">Active Status :</label>
								</div>
							  <div class="select">
							    <select name="ActiveStatus" id="ActiveStatus">
								<?php
								 if($row[6]=='Active')
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
							<div class="field">
								<div class="label">
									<label for="input-valid">Image :</label>
								</div>
							  <div class="select">
							    <img src="offerimage/<?php print $row[5]; ?>" height="100" width="100">
							  </div>
                                
                          

                                
							</div>
							<div class="field">
								<div class="label">
									<label for="input-valid">Upload  Image :</label>
								</div>
							  <div class="select">
							    <input name="uploadimage" type="file" id="uploadimage" />
							  </div>
                                
                          

                                
							</div>
							<div class="buttons">
							
							 <div class="highlight">
								 <input type="submit" name="btnEdit" value="   Edit    " class="btnsdt" style="color:white;"/>
							     
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
				
	</div>
    </div>			<!-- end box / right --><!-- end content / right --><!-- end content -->
		<!-- footer -->
		<?php include("footer.php"); ?>
		<!-- end footert -->
	</body>
</html>