<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
	$Date=MakeDate();

    $navbarlink="CategoryID=".$_REQUEST["CategoryID"];	// category id ta catch kortsi;
    $catid=$_REQUEST["CategoryID"];	// category id ta catch kortsi; next 377,378 line e jabe
//echo $navbarlink;


//my line ; goto line 259
    $parent_category=mysqli_fetch_row(mysqli_query($con, "SELECT category_id, category_name FROM hj_category_info  WHERE category_id ='". $catid." ' " ));
//echo $parent_category[0];
	$_REQUEST["listtype"]=isset($_REQUEST["listtype"])?$_REQUEST["listtype"]:"none";
//.........................31-54 line apadoto off rakhlam................
         if(isset($_REQUEST["btnGo"]) || (isset($_REQUEST["search"]) && $_REQUEST["search"]=="yes"))
		 {
		  $TotalPage=mysqli_query($con, "SELECT COUNT(ProductID) FROM hj_product_info 
			  WHERE RIGHT(ProductID,3)='".$_REQUEST["SubSubCategoryID"]."'
			   AND (ProductName LIKE '%".$_REQUEST["txtsearch"]."%' OR 
			   Stock LIKE '%".$_REQUEST["txtsearch"]."%' OR Price LIKE '%".$_REQUEST["txtsearch"]."%' OR Brand LIKE '%".$_REQUEST["txtsearch"]."%'
			  )");
		 }
		 else
		 {
	      $TotalPage=mysqli_query($con, "SELECT COUNT(ProductID) FROM hj_product_info WHERE SUBSTRING(ProductID,3,2)='".$_REQUEST["CategoryID"]."'");
	 
		 }
	     
        $sss=mysqli_fetch_row($TotalPage);
        $TotalPagesss=$sss[0]/25; //
        $TotalPageRow=intval($TotalPagesss);
        if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
        {
            $TotalPageRow=$TotalPageRow+1;    
        }
//		else 
//		{ 
//		}
	 
	    $bgcolor="";
		$recpos=isset($_REQUEST["recpos"])? $_REQUEST["recpos"]:"1";
		$count=($recpos-1)*25;
		$sl=$count;
	     if(isset($_POST["btnSave"]))
			{
			   $totalID=count($_POST["pid"]);
			   for($i=0;$i<$totalID;$i++)
			   {
				$update=mysqli_query($con, "UPDATE hj_product_info SET orderid='".$_POST["porderid"][$i]."' WHERE
				 ProductID='".$_POST["pid"][$i]."'");
				
			   }
			   
			   header("Location:hj_product_list1.php?msg=Successfully Updated ordering...&listtype=none&$navbarlink");
		   }
	  if(isset($_REQUEST["del"]) && $_REQUEST["del"]=="ok")
	  {   
	  
	       $id = mysqli_fetch_row(mysqli_query($con, "SELECT ProductID FROM hj_product_info WHERE SerialNo='".$_REQUEST["id"]."'"));
	    
//			if(substr($_REQUEST["id"],2,1)==3)
//			{
//				$image = mysqli_query($con, "SELECT BigImage,MidImage,SmallImage FROM product_image WHERE ProductID='".$id[0]."'");
//				while($image_row = mysqli_fetch_row($image))
//				{
//				 $del = "../productimage/".$image_row[0];
//				 @unlink($del);
//				 $del = "../productimage/".$image_row[1];
//				 @unlink($del);
//				 $del = "../productimage/".$image_row[2];
//				 @unlink($del);
//				}
//				mysqli_query($con, "DELETE FROM product_image WHERE ProductID='".$id[0]."'");
//			}
//			else
//			{
			
			
			  $ids = mysqli_query($con, "SELECT LEFT(ProductFullID,4) FROM hj_product_details WHERE SerialNo='".$_REQUEST["id"]."' 
			  GROUP BY LEFT(ProductFullID,11)");
			   while($ids_row = mysqli_fetch_row($ids))
			   {
				   $image = mysqli_query($con, "SELECT BigImage,MidImage,SmallImage FROM hj_product_image WHERE ProductID='".$ids_row[0]."'");
					while($image_row = mysqli_fetch_row($image))
					{
					 $del = "../productimage/hj/".$image_row[0];
					 @unlink($del);
					 $del = "../productimage//hj/".$image_row[1];
					 @unlink($del);
					 $del = "../productimage/hj/".$image_row[2];
					 @unlink($del);
					}
					mysqli_query($con, "DELETE FROM hj_product_image WHERE ProductID='".$ids_row[0]."'");     
			   }
			   
			   
			  mysqli_query($con, "DELETE FROM hj_product_details WHERE SerialNo='".$_REQUEST["id"]."'");
			  
			  
			 
//			}
			  $delete_product=mysqli_query($con, "DELETE FROM hj_product_info WHERE SerialNo='".$_REQUEST["id"]."'");
			 header("Location:hj_product_list1.php?msg=Successfully Deleted Product.&$navbarlink");
	      
	  }

      if(isset($_REQUEST["acinac"]) && $_REQUEST["acinac"]=="ok")
	  {
	      
		     $ProductID=$_REQUEST["id"];
			 
		
		            $rs=mysqli_query($con, "SELECT ActiveStatus FROM hj_product_info WHERE SerialNo='".$ProductID."'");
					 $row=mysqli_fetch_row($rs);
					 if($row[0]=="Active")
					 {$acinac="InActive";}
					 else
					 {$acinac="Active";}
					 mysqli_query($con, "UPDATE hj_product_info SET ActiveStatus='".$acinac."' where SerialNo='".$ProductID."'");
					
			header("Location:hj_product_list1.php?msg=Product Successfully Updated!&$navbarlink");		 
		 
		 
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
    var SubSubCategoryID=document.getElementById('SubSubCategoryID').value;
	var result = confirm("Are you sure you want to Change this Record ?");
	if (result==true)
	{
		window.location = "product_list3.php?acinac=ok&type="+type+"&id="+id+"&SubSubCategoryID="+SubSubCategoryID;
	}
}
function ConfirmDelete(id,type)
{
   //alert(""+id);
//   var SubSubCategoryID=document.getElementById('SubSubCategoryID').value;
	var result = confirm("Are you sure you want to Delete this Item?");
	if (result==true)
	{
		window.location = "hj_product_list1.php?del=ok&type="+type+"&id="+id;
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
	  window.location = "hj_product_list.php";
	 }
	 else  if(first_three=='cat')
	 {
	  window.location = "hj_product_list1.php?CategoryID="+id;
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
<!--                        from 29 line -->
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:"Product List of $parent_category[1]"; ?></h5>
                        
						
							<div class="search" style="width:auto; float:right; color:#FFFFFF; font-size:12px; margin-top:0px;"> 
				  <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
							  
							
									
							 <strong>Search Product:</strong>
									<input name="txtsearch" type="text" id="txtsearch" />
								
								
									<input type="submit" name="btnGo" value="Search" class="btnsdt" style="color:white; height:25px;" />
								<br>	
							<strong>Go Top:</strong>
									<select name="GoTop" id="GoTop" onchange="go_top(this.value);">
									<option value="roo">Top</option>
									<?php
									 $comboo_cat=mysqli_query($con, "SELECT category_id,category_name FROM hj_category_info ORDER BY orderid");
									 while($comboo_cat_Row=mysqli_fetch_row($comboo_cat))
									 {
									?>
									<option value="cat<?php print $comboo_cat_Row[0] ?>"><?php print $comboo_cat_Row[1] ?></option>
									<?php
//									     $comboo_scat=mysqli_query($con, "SELECT SubCategoryID,SubCategoryName FROM product_sub_category 
//										 WHERE CategoryID='".$comboo_cat_Row[0]."' ORDER BY orderid");
//										 while($comboo_scat_Row=mysqli_fetch_row($comboo_scat))
//										 {
										?>
<!--										<option value="sca<?php print $comboo_scat_Row[0] ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php print$comboo_scat_Row[1] ?></option>-->
										
										           <?php
//												 $comboo_sscat=mysqli_query($con, "SELECT SubSubCategoryID,SubCategoryName FROM product_ssub_category 
//												 WHERE SubCategoryID='".$comboo_scat_Row[0]."' ORDER BY orderid");
//												 while($comboo_sscat_Row=mysqli_fetch_row($comboo_sscat))
//												 {
//												  if($comboo_sscat_Row[0] == $_REQUEST["SubSubCategoryID"])
//												  {
												?>
<!--												<option value="ssc<?php print $comboo_sscat_Row[0] ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print $comboo_sscat_Row[1] ?></option>-->
												<?php
//												  }
//												  else
//												  {
												  ?>
<!--												  <option value="ssc<?php print $comboo_sscat_Row[0] ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print $comboo_sscat_Row[1] ?></option>-->
												  
												<?php
//												}}
												?>
										<?php
//										}
										?>
									<?php
									}
									?>
									</select>
								
							
						</div>
						
					</div>
					<!-- end box / title -->
					
				  <div class="pagination pagination-left" style="margin-top:0px; background-color:#FFFFFF;" >
    <div class="results" style="margin-top:0px;">
	<span >
	<?php
//		 if(isset($_REQUEST["btnGo"]) || (isset($_REQUEST["search"]) && $_REQUEST["search"]=="yes"))
//		 {
//		  print "Total Found: ".$sss[0]." by key word '".$_REQUEST["txtsearch"]."'";
//		 }
//		else
//		{
//		print "Total Product:  ".$sss[0];
//		}
 ?></span>
	</div>
	</div>			
    
  <table width="91%" border="0" align="left" cellpadding="0" cellspacing="0">
           <thead>
            <tr >
              <th width="34" align="center" ><strong>ID</strong></th>
              <th width="58" align="left"  ><strong> Name 
<!--                  <input type="hidden" name="SubSubCategoryID" id="SubSubCategoryID" value="<?php print $_REQUEST["SubSubCategoryID"]; ?>" />-->
              </strong></th>
<!--              <th width="64" align="center"  >Artist</th>-->
              <th width="60" align="center"  >Style</th>
              <th width="82" align="center"  ><strong>Quantity</strong></th>
              <th width="71" align="center"  ><strong>Price</strong></th>
              <th width="82" align="center" ><strong>Ordering</strong></th>
              <th width="552" align="center" ><strong>Action</strong></th>
             </tr>
		  </thead>
		  <tbody>
			<?php
//              361-378 use for search purpose: pore dkhbol apadoto off ;...................................................poreeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
			  if(isset($_REQUEST["btnGo"]) || (isset($_REQUEST["search"]) && $_REQUEST["search"]=="yes"))
			  {
			  $rs=mysqli_query($con, "SELECT ProductID,orderid,ActiveStatus,ProductName,Stock,Price,ShippingCost,Collectibles,Brand,SerialNo 
			  FROM product_info".                 
//			  WHERE RIGHT(ProductID,3)='".$_REQUEST["SubSubCategoryID"]."'
			   "WHERE SUBSTRING(ProductID,3,1)='".$_REQUEST["CategoryID"]."'
               AND (ProductName LIKE '%".$_REQUEST["txtsearch"]."%' OR 
			   Stock LIKE '%".$_REQUEST["txtsearch"]."%' OR Price LIKE '%".$_REQUEST["txtsearch"]."%'
			    OR Brand LIKE '%".$_REQUEST["txtsearch"]."%')
			   ORDER BY orderid LIMIT $count,25");
			   $extra="&search=yes&txtsearch=".$_REQUEST["txtsearch"];
			  }
			  else
			  {
//                  to show product list using categoryID received from url  extracting from productID
                  
			   $rs=mysqli_query($con, "SELECT ProductID,orderid,ActiveStatus,ProductName,Price,SerialNo
               FROM hj_product_info
               WHERE SUBSTRING(ProductID,3,2)='".$_REQUEST["CategoryID"]."' ORDER BY orderid,SerialNo desc LIMIT $count,25"); // 13,14 line e ase // from 61

			  $extra="&search=no";
			  }
			  //$parentid = product_parent_category("sscat", $_REQUEST["SubSubCategoryID"]);
			  while($row=mysqli_fetch_row($rs))
			  {
//                  echo ' id: '.$row[0];
                  //ProductID,orderid,ActiveStatus,ProductName,Stock,Price,ShippingCost,Collectibles,Brand,SerialNo
                  $sl++;
				  $styleID = substr($row[0],0,2); // style id nitsi
				  $style = mysqli_fetch_row(mysqli_query($con, "SELECT StyleName FROM product_style WHERE StyleID = '".$styleID ."' "));
				
                  if($row[2]=='Active')
                  {
                      $acinac="InActive";
					   $acinac="<img src=\"actionimage/icon_green_on.gif\" title=\"Status: Active. Change to Inactive\">";
                  }
                  else
                  { 
                      $acinac="Active";
				      $acinac="<img src=\"actionimage/icon_red_on.gif\" title=\"Status: Inactive. Change to Active\">";
                  }
//					 find out total quantity of a product category ; 405-414 porjnto line gula off kore disi kisu 
//				  if($row[7] == 1)
//				  {
//                      $qty = $row[4];	
//                  }
//                  else
//                  {
					   $take_total_qty = mysqli_fetch_row(mysqli_query($con, "SELECT SUM(Qty) FROM hj_product_details 
					   WHERE SerialNo = '".$row[5]."'"));
					 $qty = $take_total_qty[0];	
//                  }
			?>
			  <tr>
              <td height="43" align="center" valign="middle"><?php print $row[0] ?></td> <!-- product id -->
              <td align="left" valign="middle"  > <?php print $row[3] ?></td> <!-- product name -->
              <td align="center" valign="middle"><?php echo $style[0]; ?></td> <!-- style name from 391 line -->
              <td align="center" valign="middle"><?php echo $qty; ?></td> <!-- product quantity from 411 line -->
              <td align="center" valign="middle"><?php print $row[4]; ?></td> <!-- price per product -->
              <td align="center" valign="middle"><?php print $row[1] ?>
                  <input type="hidden" name="pid[]" value="<?php print $row[0]; ?>" />
<!--                  <input name="porderid[]" type="text" size="3" value="<?php print $row[1] ?>" />-->
               </td>
              <td align="center" valign="middle">
			   
			   <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","edit_option");
			 if($check_access=="yes")
			  {
                 $fullProductId = mysqli_fetch_row(mysqli_query($con, "SELECT ProductFullID FROM hj_product_details 
					   WHERE SerialNo = '".$row[5]."'"));;
			 ?>
			  <a href="hj_edit_product1.php?ProductID=<?php print $row[0]; ?>&SerialNo=<?php print $row[5]; ?>"><img src="actionimage/icon_edit.gif" title="edit" /></a>
		<?php } ?>
		 <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","delete_option");
			 if($check_access=="yes")
			  {
			 ?>
			   <a  href="#" onclick="ConfirmDelete('<?php print $row[5] ?>','product');"><img src="actionimage/icon_delete.gif" title="delete" /></a>
			<?php } ?>
		 <?php
//			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","edit_option");
//			 if($check_access=="yes")
//			  {
			 ?>
<!--			    <a  href="#" onclick="ConfirmAcInac('<?php print $row[5] ?>','product');"><?php print $acinac ?></a>-->
		   <?php// } ?>
                  
              </td>
            </tr> 
			<?php } ?>
            <tr>
              <td height="61" colspan="8" align="center" valign="middle">
			   <div class="buttons">
							 <div class="highlight">
                                 <a href="hj_product_list.php" style="text-decoration:none;"> 
                                 <input type="button" name="GoBack" value="Go Back" class="btnsdt" style="color:white;"/>
                                 </a>
							 
<!--								 <input type="submit" name="btnSave" value="   Save    " class="btnsdt" style="color:white;"/>-->
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
		  <li><a href="hj_product_list1.php?<?php print $navbarlink; ?>&recpos=1<?php print $extra; ?>">Start</a></li>
		  <li><a href="hj_product_list1.php?<?php print $navbarlink; ?>&recpos=<?php print $i-1; ?><?php print $extra; ?>" ><< prev</a></li>
		  <?php 
            } 
            ?>
		  <?php
		  if($li==7+1 && $i<=$TotalPageRow)
		  {
		  // $pl++;
		?>
       
		  <li><a href="hj_product_list1.php?<?php print $navbarlink; ?>&recpos=<?php print $i; ?><?php print $extra; ?>">next >></a></li>
     <?php 
            }
	    if($li<=7 && $i>0)
	      { 		  
//		  //$pl++;
		  ?>
         
		  <li><a href="hj_product_list1.php?<?php print $navbarlink; ?>&recpos=<?php print $i; ?><?php print $extra; ?>"><?php print $i; ?></a></li>
		<?php 
            }}
		
		?>
        <?php
		 //print $pl;
//		if(($i > 7) && ($TotalPageRow >= $nxt+1))
//		{
		 ?>
       
<!--		<li><a href="product_list3.php?<?php print $navbarlink; ?>&recpos=<?php print $TotalPageRow; ?><?php print $extra; ?>">End</a></li>-->
		<?php 
//        } 
            ?>
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