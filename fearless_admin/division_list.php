<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
	    if(isset($_REQUEST["del"]) && $_REQUEST["del"]=="ok")
				  {
				       $district_select=mysqli_query($con, "SELECT DistrictID FROM district_info WHERE DivisionID='".$_REQUEST["DivisionID"]."'");
					   while($district_selectRow=mysqli_fetch_row($district_select))
					   {
						$delete_district=mysqli_query($con, "DELETE FROM district_info WHERE DistrictID='".$district_selectRow[0]."'");
						$delete_thana=mysqli_query($con, "DELETE FROM thana_info WHERE DistrictID='".$district_selectRow[0]."'");
						$delete_area=mysqli_query($con, "DELETE FROM area_info WHERE DistrictID='".$district_selectRow[0]."'");
					   } 
					   $delete_division=mysqli_query($con, "DELETE FROM division_info WHERE DivisionID='".$_REQUEST["DivisionID"]."'");
						header("Location:division_list.php?msg=Successfully Deleted Division and Related All District as well as Thana..");
					 
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

function ConfirmAcInac(id)
{
   //alert(""+id);
	var result = confirm("Are you sure you want to Change this Record ?");
	if (result==true)
	{
		window.location = "delete.php?type=division&id="+id;
	}
}
function ConfirmDelete(id)
{
   //alert(""+id);
	var result = confirm("Are you sure you want to Delete this Division and Related All District as well as Thana?");
	if (result==true)
	{
		window.location = "division_list.php?del=ok&DivisionID="+id;
	}
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
				<div class="box" style="background:none;">
					<!-- box / title -->
					<div class="title">
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:"Division List"; ?></h5>
					</div>
					<!-- end box / title -->
					
						
    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
                    <br>
  <table width="413" border="0" align="left" cellpadding="0" cellspacing="0">
            <tr >
              <td width="74" align="center" ><strong>SL</strong></td>
              <td width="458" align="center"  ><strong> Division Name </strong></td>
              <td width="208" align="center" ><strong>Action</strong></td>
          </tr>
       		<?php
			
			$sl=0;
              $rs=mysqli_query($con, "SELECT * FROM division_info ORDER BY DivisionID DESC");
			  while($row=mysqli_fetch_row($rs))
			  {		++$sl;
				  if($sl%2==0)
				  {
				  $bgcolor="bgcolor=\"#999999\"";
				  }
				  else
				  {
					$bgcolor="bgcolor=\"#CCCCCC\"";  
				  }
				  
				  
				 if($row[2]=='Active')
				  {$acinac="InActive";}
				  else
				  {$acinac="Active";}
			?>
            <tr <?php print $bgcolor; ?>>
              <td height="30" align="center"><?php print $sl; ?></td>
              <td align="center"  ><?php print $row[1] ?></td>
              <td align="center">
			   <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-01","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
			  
			  <a href="edit_division.php?DivisionID=<?php print $row[0]; ?>">Edit</a>
			 <?php } ?>
			  <br>
			 <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-01","delete_option");
			 if($check_access=="yes")
			  {
			 ?>
			  <a  href="#" onclick="ConfirmDelete('<?php print $row[0] ?>');">Delete</a>
			 <?php } ?>
			  <br>
			 <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-01","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
			  
			  <a  href="#" onclick="ConfirmAcInac('<?php print $row[0] ?>');"><?php print $acinac ?></a>
			<?php } ?>
			  </td>
            </tr>
              <?php } ?>
          </table>
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