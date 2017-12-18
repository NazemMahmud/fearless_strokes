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

		 
		   if($_POST["billingUnionName"]!="")
		   {
		     $AreaID=MakeID($con, "village_info","VillageID","VLG-",10);

			 $rs=mysqli_query($con, "INSERT INTO village_info (VillageID,UnionID,Name,Description,ActiveStatus,ShippingCost) 
			 VALUES('".$AreaID."','".$_POST["billingUnionName"]."','".htmlspecialchars($_POST["AreaName"],ENT_QUOTES)."',
			 '".htmlspecialchars($_POST["ShortDescription"],ENT_QUOTES)."','InActive','".$_POST["ShippingCost"]."')");
			 
             header("Location:area_list.php?msg=Successfully Add Area/Village");
		   }
		   else
		   {
		      header("Location:insert_area.php?msg=Please Enter a Union");
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
	     <script type="text/javascript">
		         function selectdistrict(searchCode)
		  {
		 //alert(''+searchCode);
		   $.post("searchLookup.php",{ func: "DISTRICT", src: searchCode},
		   function(data)
		   {
		   $('#district').html(data.SSSSS);
		   },"json")	
		  }
	function billingselectarea(searchCode)
      {
	 //alert(''+searchCode);
       $.post("searchLookup.php",{ func: "AREAFIND", src: searchCode},
	   function(data)
	   {
	   $('#billingarea').html(data.SSSSS);
	   },"json")	
      }
	function billingselectunion(searchCode)
      {
	 //alert(''+searchCode);
       $.post("searchLookup.php",{ func: "UNION", src: searchCode},
	   function(data)
	   {
	   $('#billingunion').html(data.SSSSS);
	   },"json")	
      }
		 </script>
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
						<h5><?php print isset($_REQUEST['msg'])?$_REQUEST['msg']:"Insert Area/Village"; ?></h5>
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
									<label for="input-medium">Division Name:</label>
								</div>
								<div class="input">
								  <select name="Division" id="Division" onChange="selectdistrict(this.value);" >
									<option value="">Select Division</option>
									<?php
							        $preDivision=mysqli_query($con, "SELECT DivisionID,DivisionName FROM division_info WHERE ActiveStatus='Active'");
									while($preDivisionRow=mysqli_fetch_row($preDivision))
									{
									   if($pre_shipping[7]==$preDivisionRow[0])
									   {
									 ?>
								<option value="<?php print $preDivisionRow[0]; ?>" selected="selected"><?php print $preDivisionRow[1]; ?></option>
									<?php }
									  else
									  {
									 ?>
									<option value="<?php print $preDivisionRow[0]; ?>"><?php print $preDivisionRow[1]; ?></option>
									<?php }} ?>
									</select>
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">District Name:</label>
								</div>
								<div class="input" id="district">
								  <select name="billingDistrict" id="billingDistrict" onchange="billingselectarea(this.value);">
									<option value="">Select District Name</option>
									
									</select>
								</div>
							</div>
							
					        <div class="field">
								<div class="label">
									<label for="input-medium">Upazila/Police Station   Name:</label>
								</div>
								<div class="input" id="billingarea">
									<select name="billingAreaName" id="billingAreaName" onchange="billingselectunion(this.value);">
									<option value="">Select Police Station Name</option>
									
									</select>
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Union Name :</label>
								</div>
								<div class="input" id="billingunion">
								  <select name="billingUnionName" id="billingUnionName">
								  <option value="">Select Union Name</option>
								  
							      </select>
							    </div>
							</div>
					        <div class="field">
								<div class="label">
									<label for="input-medium">Area/Village  Name:</label>
								</div>
								<div class="input">
									<input id="AreaName" name="AreaName"  class="small valid" type="text">
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Short Description :</label>
								</div>
								<div class="input">
								  <textarea name="ShortDescription"></textarea>
								</div>
							</div>
                            <div class="field">
								<div class="label">
									<label for="input-medium">Shipping Cost for this area :</label>
								</div>
								<div class="input">
								  <input id="ShippingCost" name="ShippingCost"  class="small valid" type="text">
								&nbsp;&nbsp;(e.g: Numeric Data)</div>
							</div>
							<div class="buttons">
							
							 <div class="highlight">
							  <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-01","add_option");
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