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
				      
						$delete_district=mysqli_query($con, "DELETE FROM district_info WHERE DistrictID='".$_REQUEST["DistrictID"]."'");
						$delete_thana=mysqli_query($con, "DELETE FROM thana_info WHERE DistrictID='".$_REQUEST["DistrictID"]."'");
						$delete_area=mysqli_query($con, "DELETE FROM area_info WHERE DistrictID='".$_REQUEST["DistrictID"]."'");
						header("Location:district_list.php?msg=Successfully Deleted District and Related All Thana..");
					 
				  }
	          $_REQUEST["GoTop"]=isset($_REQUEST["GoTop"])?$_REQUEST["GoTop"]:"";
	          $_REQUEST["txtsearch"]=isset($_REQUEST["txtsearch"])?$_REQUEST["txtsearch"]:"";
				if($_REQUEST["txtsearch"]!="")
				{
				 $TotalPage=mysqli_query($con, "SELECT COUNT(DistrictID) FROM district_info WHERE DistrictName LIKE '%".$_REQUEST["txtsearch"]."%'");
				 
				 $found_msg=" found as search keyword '".$_REQUEST["txtsearch"]."'";
				 $_REQUEST["GoTop"]="";
				}
				else if($_REQUEST["GoTop"]!="")
				{
				 $TotalPage=mysqli_query($con, "SELECT COUNT(DistrictID) FROM district_info WHERE DivisionID='".$_REQUEST["GoTop"]."'");
				 $found_msg="";
				 $_REQUEST["txtsearch"]="";
				}
				else
				{
				  $found_msg="";
				 $TotalPage=mysqli_query($con, "SELECT COUNT(DistrictID) FROM district_info");
				}
				
				
			  
					  $sss=mysqli_fetch_row($TotalPage);
					 $TotalPagesss=$sss[0]/25;
					 $TotalPageRow=intval($TotalPagesss);
					   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
					   {
						$TotalPageRow=$TotalPageRow+1;    
					   }
					   else 
					   {
						   
					   }
	 
			$recpos=isset($_REQUEST["recpos"])? $_REQUEST["recpos"]:"1";
				$count=($recpos-1)*25;
				$sl=$count;
				
				if($_REQUEST["txtsearch"]!="")
				{
				 $rs=mysqli_query($con, "SELECT
					district_info.DistrictID
					, district_info.DistrictName
					, division_info.DivisionName
					, district_info.ActiveStatus
				FROM
					district_info
					LEFT JOIN division_info 
						ON (district_info.DivisionID = division_info.DivisionID)
						WHERE district_info.DistrictName LIKE '%".$_REQUEST["txtsearch"]."%'
				ORDER BY district_info.DistrictName LIMIT $count,25");
				}
				else if($_REQUEST["GoTop"]!="")
				{
				  $rs=mysqli_query($con, "SELECT
					district_info.DistrictID
					, district_info.DistrictName
					, division_info.DivisionName
					, district_info.ActiveStatus
				FROM
					district_info
					LEFT JOIN division_info 
						ON (district_info.DivisionID = division_info.DivisionID)
						WHERE division_info.DivisionID='".$_REQUEST["GoTop"]."'
				ORDER BY district_info.DistrictName LIMIT $count,25");
				}
				else
				{
				  $rs=mysqli_query($con, "SELECT
					district_info.DistrictID
					, district_info.DistrictName
					, division_info.DivisionName
					, district_info.ActiveStatus
				FROM
					district_info
					LEFT JOIN division_info 
						ON (district_info.DivisionID = division_info.DivisionID)
				ORDER BY district_info.DistrictID LIMIT $count,25");
				}
				$nav_for="GoTop=".$_REQUEST["GoTop"]."&txtsearch=".$_REQUEST["txtsearch"];
				
             
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
		window.location = "delete.php?type=district&id="+id;
	}
}
function ConfirmDelete(id)
{
   //alert(""+id);
	var result = confirm("Are you sure you want to Delete this District and Related All Thana?");
	if (result==true)
	{
		window.location = "district_list.php?del=ok&DistrictID="+id;
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
					<div class="title" style="margin-bottom:0px;">
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:"District List"; ?></h5>
					<div class="search" style="width:auto; float:right; color:#FFFFFF; font-size:12px; margin-top:0px;"> 
							<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
							  
							
									
							 <strong>Search District Name:</strong>
									<input name="txtsearch" type="text" id="txtsearch" />
								
								
									<input type="submit" name="btnGo" value="Search" class="btnsdt" style="color:white; height:25px;" />
								<br>	<br>
							<strong>By Division:</strong>
									<select name="GoTop" id="GoTop" onchange="document.customer.submit();">
									<option value="">Select Division Name</option>
									<?php
									 $comboo_cat=mysqli_query($con, "SELECT DivisionID,DivisionName FROM division_info ORDER BY DivisionName");
									 while($comboo_cat_Row=mysqli_fetch_row($comboo_cat))
									 {
									    if($_REQUEST["GoTop"]==$comboo_cat_Row[0])
										{
									?>
									<option value="<?php print $comboo_cat_Row[0] ?>" selected="selected"><?php print $comboo_cat_Row[1] ?></option>
									<?php }
									     else
										 {
									 ?>
									<option value="<?php print $comboo_cat_Row[0] ?>"><?php print $comboo_cat_Row[1] ?></option>
								 <?php }} ?>
									</select>
								
							
						</div>
						
					</div>
					<!-- end box / title -->
		 <div class="pagination pagination-left" style="margin-top:0px; background-color:#FFFFFF;" >
    <div class="results" style="margin-top:0px; background-color:#FFFFFF;" >
	<span>Total District: <?php print $sss[0].$found_msg; ?></span>
	</div>
	</div>				
						
    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
  <table width="413" border="0" align="left" cellpadding="0" cellspacing="0">
       <thead>
            <tr >
              <th width="63" align="center" ><strong>SL</strong></th>
              <th width="534" align="center"  ><strong> District Name </strong></th>
              <th width="520" align="center"  ><strong>Division Name </strong></th>
              <th align="center" ><strong>Action</strong></th>
          </tr>
	  </thead>
	  <tbody>
       		<?php
			
			   $bgcolor="";
				
			  while($row=mysqli_fetch_row($rs))
			  {		++$sl;
				 
				  
				 if($row[3]=='Active')
				  {$acinac="InActive";}
				  else
				  {$acinac="Active";}
			?>
            <tr <?php print $bgcolor; ?>>
              <td height="30" align="center"><?php print $sl; ?></td>
              <td align="center"  ><?php print $row[1] ?></td>
              <td align="center"  ><?php print $row[2] ?></td>
              <td align="center">
			   <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-01","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
			  
			  <a href="edit_district.php?DistrictID=<?php print $row[0]; ?>">Edit</a>
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
			</tbody>
          </table>
</form>
			 <div class="pagination pagination-left" style="background-color:#FFFFFF;">
			
				 <div class="results">
								<span>Page <?php print $recpos;?> of <?php print $TotalPageRow ?></span>
							</div>
						
				
				
		<ul class="pager" style="float:left;">
        <?php
		   if($recpos<4)
		   $recpos=4;
		   else if($recpos>=$TotalPageRow-3)
		   $recpos=$TotalPageRow-3;
		   //print $recpos;
		  $nxt=$recpos+3;
		  $pre=$recpos-3;
		  $li=0;
		  //$pl=$next+2;
         for($i=$pre;$i<=$nxt+1;$i++)
		 {
			$li++;
		  if($i==$TotalPageRow+1)
		  break;
		  
		  if($i>1 && $li==1)
		  {
		  ?>
		  <li><a href="district_list.php?recpos=1&<?php print $nav_for; ?>">Start</a></li>
		  <li><a href="district_list.php?recpos=<?php print $i-1; ?>&<?php print $nav_for; ?>" ><< prev</a></li>
		  <?php } ?>
		  <?php
		  if($li==7+1 && $i<=$TotalPageRow)
		  {
		  // $pl++;
		?>
        
		  <li><a href="district_list.php?recpos=<?php print $i; ?>&<?php print $nav_for; ?>">next >></a></li>
     <?php }
	    if($li<=7 && $i>0)
	      { 
		  
		  //$pl++;
		  ?>
          
		  <li><a href="district_list.php?recpos=<?php print $i; ?>&<?php print $nav_for; ?>"><?php print $i; ?></a></li>
		<?php }}
		
		?>
        <?php
		 //print $pl;
		if(($i > 7) && ($TotalPageRow >= $nxt+1))
		{
		 ?>
       
		<li><a href="district_list.php?recpos=<?php print $TotalPageRow; ?>&<?php print $nav_for; ?>">End</a></li>
		<?php } ?>
		</ul>
		
			</div></div>
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