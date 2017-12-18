<?php
		session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
		include("connection.php");

//echo $order_id.' catid: '.$category_id;
	$getorderidlatest=mysqli_fetch_row(mysqli_query($con,"SELECT orderid, CategoryID FROM product_category_info ORDER BY orderid DESC LIMIT 1 "));
                                        $order_id = $getorderidlatest[0] + 1;
                                        $category_id = $getorderidlatest[1] + 1;
//echo $order_id.'asdad'.$category_id;
//	if(isset($_POST["btnAdd"]))
if( isset($_POST["TakeID"]) && $_POST["TakeID"]!="")
	  {
		 
		 
		 $CatID=MakeID($con, "product_category_info","CategoryID","",2);
		  $allowedfiletypes = array("jpeg","jpg","gif","png");
		$uploadfolder = "../menuimage/" ;
		$uploadfilename = $_FILES['uploadimage']['name'];
		$fileext = strtolower(substr($uploadfilename,strrpos($uploadfilename,".")+1));
        
		    if (!empty($uploadfilename) and !in_array($fileext,$allowedfiletypes)) 
			{ 
			header("Location:product_category.php?msg=Add New Icon");
			die();		
		    }
		    else if(!empty($uploadfilename))
		    {			
			 $file1 = $uploadfolder.$CatID.$_FILES['uploadimage']['name'];
			 $bigimg=$CatID.$_FILES['uploadimage']['name']; 
			 move_uploaded_file($_FILES['uploadimage']['tmp_name'], $file1);
			}
			else
			{
			 $bigimg=""; 
			}
            
        
            $rs=mysqli_query($con, "INSERT INTO product_category_info
			(
            CategoryID,
			CategoryName,
			CategoryDescrition,
			ActiveStatus,
			IconName,
            orderid)
            VALUES 
			(
            
			'".$CatID."',
			'".$_POST["CategoryName"]."',
			'".$_POST["CategoryDescription"]."',
			'Active',
			'".$bigimg."',
            '".$_POST["OrderId"]."')");
			
			
			
			 header("Location:product_list.php?msg=Successfully Add Category");	
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
        
        <script type="text/javascript" src="jwysiwyg-master/lib/jquery1.5.js"></script>
<script type="text/javascript" src="jwysiwyg-master/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="jwysiwyg-master/controls/plugins/wysiwyg.autoload.js"></script>
<script type="text/javascript" src="jwysiwyg-master/controls/wysiwyg.image.js"></script>
<script type="text/javascript" src="jwysiwyg-master/controls/wysiwyg.link.js"></script>
<script type="text/javascript" src="jwysiwyg-master/controls/wysiwyg.table.js"></script>
	
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
        <script type="text/javascript">
            function all_check()
			  {
//			     var productID = $('#primary_id_container').val();
                  document.getElementById('TakeID').value = document.getElementById('CategoryId').value;
//                  var takeidvalue = document.getElementById('TakeID').value
                  

				 if(document.getElementById("CategoryName").value=="")
				 {
				  alert("Please Enter Category Name");
//                     document.getElementById('TakeID').value = "";
				  document.getElementById("CategoryName").focus();
				  return false;
				 }
				 if(document.getElementById("CategoryDescription").value=="")
				 {
				  alert("Please Enter Category Description");
//                     document.getElementById('TakeID').value = "";
				  document.getElementById("CategoryDescription").focus();
				  return false;
				 }
				 
				  if(document.getElementById("uploadimage").value=="")
				 {
				  alert("Please Enter Category Icon");
//                     document.getElementById('TakeID').value = "";
				  document.getElementById("uploadimage").focus();
				   return false;
				 }
				 else
				 {
//                     document.getElementById('TakeID').value = 2;
//				  alert('aaaaaaaaaaaaa : '+ takeidvalue);
				  document.product_form.submit();
				 }
				 
				 
			  }
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
						<h5><?php print isset($_REQUEST['msg'])?$_REQUEST['msg']:"Insert Product Category"; ?></h5>
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
									<input id="CategoryName" name="CategoryName"  class="small valid" type="text">
                                    <?php
//                                        $getorderidlatest=mysqli_fetch_row(mysqli_query($con,"SELECT orderid, CategoryID FROM product_category_info ORDER BY orderid DESC LIMIT 1 "));
//                                        $order_id = $getorderidlatest[0] + 1;
//                                        $category_id = $getorderidlatest[1] + 1;
                                    ?>
									<input id="CategoryId" type="hidden"  name="CategoryId"  class="small valid" value="<?php echo $category_id; ?>" >
									<input id="OrderId" type="hidden"  name="OrderId"  class="small valid" value="<?php echo $category_id; ?>" >
								</div>
							</div>
					       <div class="field">
								<div class="label">
									<label for="input-large">Description:</label>
						          </div>
								<div class="input">
								  <textarea name="CategoryDescription" cols="50" rows="5" id="CategoryDescription" ></textarea>
                                    <input type="hidden" name="TakeID" id="TakeID" value="" />
						          </div>
							</div>
						<div class="field">
								<div class="label">
									<label for="input-valid">Category Icon:</label>
<!--									<label for="input-valid"><i>max(304 x 388)</i></label>-->
								</div>
							  <div class="select">
							    <input name="uploadimage" type="file" id="uploadimage" class="fileToUpload" /> <label for="input-valid"><i>resolution must be (304 x 388)</i></label>
							  </div>

							</div>
							<div class="buttons">
							
							 <div class="highlight">
							  <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","add_option");
			 if($check_access=="yes")
			  {
			 ?>
								 <input type="submit" onclick="return all_check();" name="btnAdd" value="   Add    " class="btnsdt" style="color:white;"/>
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
		<script type="text/javascript">
	                var _URL = window.URL || window.webkitURL;
	                $(".fileToUpload").change(function(e) {
	                  // alert("sdasd");
	                  var image, fileToUpload;
	
	                  if ((fileToUpload = this.files[0])) {
	                     // alert("sdasd");
	                    image = new Image();
	
	                    image.onload = function() {
	                     // alert("sdasd");
	                      if(this.width!=304 || this.height!=388){
	                         $(".fileToUpload").val('');
	                         alert("The image size must be 304 X 388");
	
	                      }
	                    };
	
	                    image.src = _URL.createObjectURL(fileToUpload);
	                  }
	
	                });
            </script>
	</body>
</html>