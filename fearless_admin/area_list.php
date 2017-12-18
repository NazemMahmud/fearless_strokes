<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
	
	
	         if(isset($_REQUEST["AcInac"]) && $_REQUEST["AcInac"]=="ok")
			  {
					    $rs=mysqli_query($con, "SELECT ActiveStatus FROM village_info WHERE VillageID='".$_GET['VillageID']."'");
						 $row=mysqli_fetch_row($rs);
						 if($row[0]=="Active")
						 {$acinac="InActive";}
						 else
						 {$acinac="Active";}
						 mysqli_query($con, "UPDATE village_info SET ActiveStatus='".$acinac."' where VillageID='".$_GET['VillageID']."'");
						
						 header("Location:area_list.php?msg=Area/Village Successfully Updated!");
				 
			  }
	        if(isset($_REQUEST["del"]) && $_REQUEST["del"]=="ok")
			  {
					$delete=mysqli_query($con, "DELETE FROM village_info WHERE VillageID='".$_REQUEST["VillageID"]."' ");
					header("Location:area_list.php?msg=Successfully Deleted Area/Village");
				 
			  }
			 $_REQUEST["GoTop"]=isset($_REQUEST["GoTop"])?$_REQUEST["GoTop"]:"";
	          $_REQUEST["txtsearch"]=isset($_REQUEST["txtsearch"])?$_REQUEST["txtsearch"]:"";
				if($_REQUEST["txtsearch"]!="")
				{
				 $TotalPage=mysqli_query($con, "SELECT COUNT(VillageID) FROM village_info WHERE Name LIKE '%".$_REQUEST["txtsearch"]."%'");
				 
				 $found_msg=" found as search keyword '".$_REQUEST["txtsearch"]."'";
				 $_REQUEST["GoTop"]="";
				}
				else if($_REQUEST["GoTop"]!="")
				{
				 $TotalPage=mysqli_query($con, "SELECT COUNT(VillageID) FROM village_info WHERE UnionID='".$_REQUEST["GoTop"]."'");
				 $thname=mysqli_fetch_row(mysqli_query($con, "SELECT Name FROM union_info WHERE UnionID='".$_REQUEST["GoTop"]."'"));
				 $found_msg=" found as Union/Sector '".$thname[0]."'";
				 $_REQUEST["txtsearch"]="";
				}
				else
				{
				  $found_msg="";
				    $TotalPage=mysqli_query($con, "SELECT COUNT(VillageID) FROM village_info");
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
															village_info.VillageID
															, village_info.Name
															, village_info.ShippingCost
															, village_info.ActiveStatus
															, union_info.Name
															, thana_info.ThanaName
													        , district_info.DistrictName
														FROM
															village_info
															INNER JOIN union_info 
																ON (village_info.UnionID = union_info.UnionID)
															INNER JOIN thana_info 
														        ON (union_info.ThanaID = thana_info.ThanaID)
													        INNER JOIN district_info 
														        ON (thana_info.DistrictID = district_info.DistrictID)
															WHERE  village_info.Name LIKE '%".$_REQUEST["txtsearch"]."%'
														ORDER BY village_info.Name LIMIT $count,25");	
				}
				else if($_REQUEST["GoTop"]!="")
				{
				                                      $rs=mysqli_query($con, "SELECT
															village_info.VillageID
															, village_info.Name
															, village_info.ShippingCost
															, village_info.ActiveStatus
															, union_info.Name
															, thana_info.ThanaName
													        , district_info.DistrictName
														FROM
															village_info
															INNER JOIN union_info 
																ON (village_info.UnionID = union_info.UnionID)
															INNER JOIN thana_info 
														        ON (union_info.ThanaID = thana_info.ThanaID)
													        INNER JOIN district_info 
														        ON (thana_info.DistrictID = district_info.DistrictID)
															WHERE  village_info.UnionID='".$_REQUEST["GoTop"]."'
														ORDER BY village_info.Name LIMIT $count,25");	
				}
				else
				{
				                              $rs=mysqli_query($con, "SELECT
															village_info.VillageID
															, village_info.Name
															, village_info.ShippingCost
															, village_info.ActiveStatus
															, union_info.Name
															, thana_info.ThanaName
													        , district_info.DistrictName
														FROM
															village_info
															INNER JOIN union_info 
																ON (village_info.UnionID = union_info.UnionID)
															INNER JOIN thana_info 
														        ON (union_info.ThanaID = thana_info.ThanaID)
													        INNER JOIN district_info 
														        ON (thana_info.DistrictID = district_info.DistrictID)
														ORDER BY village_info.Name LIMIT $count,25");	
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
       $.post("searchLookup.php",{ func: "UNIONEX", src: searchCode},
	   function(data)
	   {
	   $('#billingunion').html(data.SSSSS);
	   },"json")	
      }
function ConfirmAcInac(id)
{
   //alert(""+id);
	var result = confirm("Are you sure you want to Change this Record ?");
	if (result==true)
	{
		window.location = "area_list.php?AcInac=ok&VillageID="+id;
	}
}
function ConfirmDelete(id)
{
   //alert(""+id);
	var result = confirm("Are you sure you want to Delete this Village/Area?");
	if (result==true)
	{
		window.location = "area_list.php?del=ok&VillageID="+id;
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
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:"Village/Area List"; ?></h5>
					<div class="search" style="width:auto; float:right; color:#FFFFFF; font-size:12px; margin-top:0px;"> 
							<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
							  
							
									
							 <strong>Search Village/Area Name:</strong>
									<input name="txtsearch" type="text" id="txtsearch" />
								
								
									<input type="submit" name="btnGo" value="Search" class="btnsdt" style="color:white; height:25px;" />
								<br>	<br>
								<br>	<br>
								<strong>Division</strong>
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
								&nbsp;
									<strong>District: </strong>
									<span id="district">
									<select name="GoTop" id="GoTop" onchange="document.customer.submit();">
									<option value="">Select District Name</option>
									
									</select>
								     </span>
									 <br><br>
							<strong>Police Station:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
							          <span id="billingarea">
									<select name="GoTop" id="GoTop" onchange="document.customer.submit();">
									<option value="">Select Police Station Name</option>
									
									</select>
								   </span>
								   <br><br>
							<strong>By Union/Sector:</strong>
							        <span id="billingunion">
									<select name="GoTop" id="GoTop" onchange="document.customer.submit();">
									<option value="">Select Union/Sector Name</option>
									
									</select>
								    </span>
							
						</div>
						
					</div>
					<!-- end box / title -->
		 <div class="pagination pagination-left" style="margin-top:0px; background-color:#FFFFFF;" >
    <div class="results" style="margin-top:0px; background-color:#FFFFFF;" >
	<span>Total Village/Area: <?php print $sss[0].$found_msg; ?></span>
	</div>
	</div>					
						
    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
  <table width="89%" border="0" align="left" cellpadding="0" cellspacing="0">
       <thead>
            <tr >
              <th width="148" align="center" ><strong>SL</strong></th>
              <th width="282" align="center"  ><strong> Village/Area  </strong></th>
              <th width="384" align="center"  ><strong>Shipping Cost </strong></th>
              <th width="242" align="center"  ><strong>Union/Sector  </strong></th>
              <th width="299" align="center"  ><strong>Upa/PS</strong></th>
              <th width="337" align="center"  ><strong>District</strong></th>
              <th width="706" align="center" ><strong>Action</strong></th>
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
              <td align="center"  ><?php print $row[4] ?></td>
              <td align="center"  ><?php print $row[5] ?></td>
              <td align="center"  ><?php print $row[6] ?></td>
              <td align="center">
			  <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-01","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
			  <a href="edit_area.php?VillageID=<?php print $row[0]; ?>">Edit</a>
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
			 <?php } ?>			  </td>
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
		  <li><a href="area_list.php?recpos=1&<?php print $nav_for; ?>">Start</a></li>
		  <li><a href="area_list.php?recpos=<?php print $i-1; ?>&<?php print $nav_for; ?>" ><< prev</a></li>
		  <?php } ?>
		  <?php
		  if($li==7+1 && $i<=$TotalPageRow)
		  {
		  // $pl++;
		?>
        
		  <li><a href="area_list.php?recpos=<?php print $i; ?>&<?php print $nav_for; ?>">next >></a></li>
     <?php }
	    if($li<=7 && $i>0)
	      { 
		  
		  //$pl++;
		  ?>
          
		  <li><a href="area_list.php?recpos=<?php print $i; ?>&<?php print $nav_for; ?>"><?php print $i; ?></a></li>
		<?php }}
		
		?>
        <?php
		 //print $pl;
		if(($i > 7) && ($TotalPageRow >= $nxt+1))
		{
		 ?>
       
		<li><a href="area_list.php?recpos=<?php print $TotalPageRow; ?>&<?php print $nav_for; ?>">End</a></li>
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