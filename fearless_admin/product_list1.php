<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
	$Date=MakeDate();
	$_REQUEST["listtype"]=isset($_REQUEST["listtype"])?$_REQUEST["listtype"]:"none";

	      $TotalPage=mysqli_query($con, "SELECT COUNT(SubCategoryID) FROM product_sub_category WHERE CategoryID='".$_REQUEST["CategoryID"]."'");
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
	 
	$navlink="CategoryID=".$_REQUEST["CategoryID"];	// category id ta catch kortsi; update ordering 54 line; 
	 
	 
	    $bgcolor="";
		$recpos=isset($_REQUEST["recpos"])? $_REQUEST["recpos"]:"1";
		$count=($recpos-1)*25;
		$sl=$count;
		
	 $rs=mysqli_query($con, "SELECT SubCategoryID,orderid,ActiveStatus,SubCategoryName FROM product_sub_category
		 WHERE  CategoryID='".$_REQUEST["CategoryID"]."'
			   ORDER BY orderid  LIMIT $count,25");
	     if(isset($_POST["btnSave"]))
			{
			   $totalID=count($_POST["catid"]);
			   for($i=0;$i<$totalID;$i++)
			   {
				$update=mysqli_query($con, "UPDATE product_sub_category SET orderid='".$_POST["orderid"][$i]."' WHERE
				 SubCategoryID='".$_POST["catid"][$i]."'");
				
			   }
			   
			   $totalID=count($_POST["pid"]);
			   for($i=0;$i<$totalID;$i++)
			   {
				$update=mysqli_query($con, "UPDATE product_info SET orderid='".$_POST["porderid"][$i]."' WHERE
				 ProductID='".$_POST["pid"][$i]."'");
				
			   }
			   
			   header("Location:product_list1.php?msg=Successfully Updated ordering...&listtype=none&$navlink");
		   }
	  if(isset($_REQUEST["del"]) && $_REQUEST["del"]=="ok")
	  {
	      $catID=$_REQUEST["CategoryID"];
	      if($_REQUEST["type"]=="scat")
		  { 
	         
				   $product_related=mysqli_query($con, "DELETE FROM product_info WHERE CategoryID='".$_REQUEST["id"]."'");
				   $sub_cat_related=mysqli_query($con, "DELETE FROM product_sub_category WHERE SubCategoryID='".$_REQUEST["id"]."'");
				   
				   
				  header("Location:product_list1.php?msg=Successfully Deleted Your Item and Relavent all Products.&CategoryID=$catID");
				
		  }
		  else if($_REQUEST["type"]=="product")
		  {
			  $delete_product=mysqli_query($con, "DELETE FROM product_info WHERE ProductID='".$_REQUEST["id"]."'"); 
			  header("Location:product_list1.php?msg=Successfully Deleted Product.&CategoryID=$catID"); 
	      }
		 }

      if(isset($_REQUEST["acinac"]) && $_REQUEST["acinac"]=="ok")
	  {
	      if($_REQUEST["type"]=="scat")
		  {
		  $rs=mysqli_query($con, "SELECT ActiveStatus FROM product_sub_category WHERE SubCategoryID='".$_GET['id']."'");
		 $row=mysqli_fetch_row($rs);
		 if($row[0]=="Active")
		 {$acinac="InActive";}
		 else
		 {$acinac="Active";}
		 mysqli_query($con, "UPDATE product_sub_category SET ActiveStatus='".$acinac."' where SubCategoryID='".$_GET['id']."'");
		
		 header("Location:product_list1.php?msg=Product Sub Category Successfully Updated!&$navlink");
		 }
		 else if($_REQUEST["type"]=="product")
		 {
		     $ProductID=$_REQUEST["id"];
		
		            $rs=mysqli_query($con, "SELECT ActiveStatus FROM product_info WHERE ProductID='".$ProductID."'");
					 $row=mysqli_fetch_row($rs);
					 if($row[0]=="Active")
					 {$acinac="InActive";}
					 else
					 {$acinac="Active";}
					 mysqli_query($con, "UPDATE product_info SET ActiveStatus='".$acinac."' where ProductID='".$ProductID."'");
					
			header("Location:product_list1.php?msg=Product Successfully Updated!&$navlink");		 
		 
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

function ConfirmAcInac(id,type)
{
   //alert(""+id);
    var CategoryID=document.getElementById('CategoryID').value;
	var result = confirm("Are you sure you want to Change this Record ?");
	if (result==true)
	{
		window.location = "product_list1.php?acinac=ok&type="+type+"&id="+id+"&CategoryID="+CategoryID;
	}
}
function ConfirmDelete(id,type)
{
   //alert(""+id);
   var CategoryID=document.getElementById('CategoryID').value;
	var result = confirm("Are you sure you want to Delete this Item?");
	if (result==true)
	{
		window.location = "product_list1.php?del=ok&type="+type+"&id="+id+"&CategoryID="+CategoryID;
	}
}
function go_top(take_value)
{
  var first_three=take_value.substr(0,3);
  var id_length=take_value.length-3; 
  var id=take_value.substr(3,id_length); 
 //alert(''+id);
	 if(first_three=='roo')
	 {
	  window.location = "product_list.php";
	 }
	 else  if(first_three=='cat')
	 {
	  window.location = "product_list1.php?CategoryID="+id;
	 }
	 else  if(first_three=='sca')
	 {
	  window.location = "product_list2.php?SubCategoryID="+id;
	 }
	 else  if(first_three=='ssc')
	 {
	  window.location = "product_list3.php?SubSubCategoryID="+id;
	 }
}
</script>
         <style type="text/css">
		.btnsdt
			{
			background-color:<?php echo $button_background; ?>;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
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
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:"Product/Sub Category List"; ?></h5>
						
							<div class="search" style="width:auto; float:right; color:#FFFFFF; font-size:12px; margin-top:0px;"> 
							<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customersss" method="post" enctype="multipart/form-data">
							  
							
									
							 <strong>Search Product:</strong>
									<input name="txtsearch" type="text" id="txtsearch" />
								
								
									<input type="submit" name="btnGo" value="Search" class="btnsdt" style="color:white; height:25px;" />
									<br>	
							<strong>Go Top:</strong>
									<select name="GoTop" id="GoTop" onchange="go_top(this.value);">
									<option value="roo">Top</option>
									<?php
									 $comboo_cat=mysqli_query($con, "SELECT CategoryID,CategoryName FROM product_category_info ORDER BY orderid");
									 while($comboo_cat_Row=mysqli_fetch_row($comboo_cat))
									 {
									   if($comboo_cat_Row[0] == $_REQUEST["CategoryID"])
										  {
									?>
								<option value="cat<?php print $comboo_cat_Row[0] ?>" selected="selected"><?php print $comboo_cat_Row[1] ?></option>
									<?php }
									else
									  { ?>
									 <option value="cat<?php print $comboo_cat_Row[0] ?>"><?php print $comboo_cat_Row[1] ?></option>
									<?php } ?>
									<?php
									     $comboo_scat=mysqli_query($con, "SELECT SubCategoryID,SubCategoryName FROM product_sub_category 
										 WHERE CategoryID='".$comboo_cat_Row[0]."' ORDER BY orderid");
										 while($comboo_scat_Row=mysqli_fetch_row($comboo_scat))
										 {
										?>
										<option value="sca<?php print $comboo_scat_Row[0] ?>">
										&nbsp;&nbsp;&nbsp;&nbsp;<?php print$comboo_scat_Row[1] ?></option>
										
										           <?php
												 $comboo_sscat=mysqli_query($con, "SELECT SubSubCategoryID,SubCategoryName FROM product_ssub_category 
												 WHERE SubCategoryID='".$comboo_scat_Row[0]."' ORDER BY orderid");
												 while($comboo_sscat_Row=mysqli_fetch_row($comboo_sscat))
												 {
												?>
												<option value="ssc<?php print $comboo_sscat_Row[0] ?>">
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print $comboo_sscat_Row[1] ?></option>
												<?php
												}
												?>
										<?php
										}
										?>
									<?php
									}
									?>
									</select>
							</form>
						</div>
						
					</div>
					<!-- end box / title -->
					
				  <div class="pagination pagination-left" style="margin-top:0px; background-color:#FFFFFF;" >
    <div class="results" style="margin-top:0px;">
	<span >Total Product Sub Category: <?php print $sss[0]; ?></span>
	</div>
	</div>			
    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
  <table width="91%" border="0" align="left" cellpadding="0" cellspacing="0">
           <thead>
            <tr >
              <th width="103" align="center" ><strong>ID</strong></th>
              <th align="left"  ><strong> SCat/Products 
                  <input type="hidden" name="CategoryID" id="CategoryID" value="<?php print $_REQUEST["CategoryID"]; ?>" />
              </strong></th>
              <th width="352" align="center"  ><strong>Qty/Stock</strong></th>
              <th width="455" align="center"  ><strong>Price</strong></th>
              <th width="187" align="center" ><strong>Ordering</strong></th>
              <th width="2525" align="center" ><strong>Action</strong></th>
             </tr>
		  </thead>
		  <tbody>
       		<?php
			
			//$sl=0;
              //$rs=mysqli_query($con, "SELECT UserID,UserName,Address,ContactNumber,Email,UserType,ActiveStatus FROM user_admin ORDER BY UserID DESC ");
			  while($row=mysqli_fetch_row($rs))
			  {	
			  	++$sl; 
				 

				  
					  if($row[2]=='Active')
					  {$acinac="InActive";
					   $acinac="<img src=\"actionimage/icon_green_on.gif\" title=\"Status: Active. Change to Inactive\">";
					  }
					  else
					  {$acinac="Active";
					   $acinac="<img src=\"actionimage/icon_red_on.gif\" title=\"Status: Inactive. Change to Active\">";
					  }
				 

			?>
            <tr>
              <td height="43" align="center" valign="middle"><?php print $row[0]; ?></td>
              <td align="left" valign="middle"  >
			 <span> 
			 <a href="product_list2.php?SubCategoryID=<?php print $row[0]; ?>"><img src="actionimage/folder.gif">
			  <?php print $row[3] ?></a>
			  </span></td>
              <td align="center" valign="middle">&nbsp;</td>
              <td align="center" valign="middle">&nbsp;</td>
              <td align="center" valign="middle">
			  <input type="hidden" name="catid[]" value="<?php print $row[0]; ?>" />
			  <input name="orderid[]" type="text" size="3" value="<?php print $row[1] ?>" /></td>
              <td align="center" valign="middle">
			   
			   <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
			  <a href="product_sub_category_edit.php?SubCategoryID=<?php print $row[0] ?>"><img src="actionimage/icon_edit.gif" title="edit" /></a>
		<?php } ?>
		 <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","delete_option");
			 if($check_access=="yes")
			  {
			 ?>
			   <a  href="#" onclick="ConfirmDelete('<?php print $row[0] ?>','scat');"><img src="actionimage/icon_delete.gif" title="delete" /></a>
		 <?php } ?>
		  <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
			    <a  href="#" onclick="ConfirmAcInac('<?php print $row[0] ?>','scat');"><?php print $acinac ?></a>
		    <?php } ?>
				 <a href="product_color_image.php?ProductID=<?php print $row[0] ?>"><!--<img src="actionimage/icon_attributes.gif" title="Attribute Setting" />--></a>
			  </td>
            </tr> 
			<?php } ?>
			
            <tr>
              <td height="61" colspan="6" align="center" valign="middle">
			   <div class="buttons">
							
							 <div class="highlight">
							 <a href="product_list.php" style="text-decoration:none;">
							 <input type="button" name="GoBack" value="Go Back" class="btnsdt" style="color:white;"/>
							 </a>
							 <a href="product_sub_category.php" style="text-decoration:none;">
							 <input type="button" name="NewCat" value="New Sub Category" class="btnsdt" style="color:white;"/>
							 </a>
							    <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
								 <input type="submit" name="btnSave" value="   Save    " class="btnsdt" style="color:white;"/>
				<?php } ?>
							 </div>			  </td>
            </tr>
		  </tbody>
        </table>
</form>
			<div class="pagination pagination-left" style="background-color:#FFFFFF;"  >
			
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
		  <li><a href="product_list1.php?<?php print $navlink; ?>&recpos=1<?php print $searchtype; ?>">Start</a></li>
		  <li><a href="product_list1.php?<?php print $navlink; ?>&recpos=<?php print $i-1; ?><?php print $searchtype; ?>" ><< prev</a></li>
		  <?php } ?>
		  <?php
		  if($li==7+1 && $i<=$TotalPageRow)
		  {
		  // $pl++;
		?>
        
		  <li><a href="product_list1.php?<?php print $navlink; ?>&recpos=<?php print $i; ?><?php print $searchtype; ?>">next >></a></li>
     <?php }
	    if($li<=7 && $i>0)
	      { 
		  
		  //$pl++;
		  ?>
          
		  <li><a href="product_list1.php?<?php print $navlink; ?>&recpos=<?php print $i; ?><?php print $searchtype; ?>"><?php print $i; ?></a></li>
		<?php }}
		
		?>
        <?php
		 //print $pl;
		if(($i > 7) && ($TotalPageRow >= $nxt+1))
		{
		 ?>
       
		<li><a href="product_list1.php?<?php print $navlink; ?>&recpos=<?php print $TotalPageRow; ?><?php print $searchtype; ?>">End</a></li>
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