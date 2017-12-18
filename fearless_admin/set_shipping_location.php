<?php
 session_start();
 include("connection.php");

 $recpos=isset($_REQUEST["recpos"])? $_REQUEST["recpos"]:"1";
					$count=($recpos-1)*20;
					$sl=$count;
     $ProductID=$_REQUEST["ProductID"];
	if(isset($_POST["regdata"]) && $_POST["regdata"]=="1")
	{
	   $a=$_POST["CID"];
	   $OB=$_POST["OB"];
	   $WB=$_POST["WB"];
	   $counter=count($a);
	   if($WB!="")
	    {
		  $test_bangla=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(ShippingLocationID) FROM product_shipping_location 
		  WHERE ProductID='".$ProductID."' AND Loc_Type='Bangla'"));
		  if($test_bangla[0]>0)
		   {}
		   else if($test_bangla[0]==0)
		   {
		     $ShippingLocationID=MakeID($con, "product_shipping_location","ShippingLocationID","PSL-",25);
			  $rs=mysqli_query($con, "INSERT INTO product_shipping_location		   
			  							(ShippingLocationID,ProductID,Dis_Bgd_Country_ID,Loc_Type) 
										  VALUES('".$ShippingLocationID."','".$ProductID."','Bangla','Bangla')"); 
				
								
		   }
		   $delete=mysqli_query($con, "DELETE FROM product_shipping_location WHERE ProductID='".$ProductID."' AND Loc_Type='Dist'");
		}
		else if($WB=="")
		{
		    $all_district=mysqli_query($con, "SELECT Dis_Bgd_Country_ID,ShippingLocationID FROM product_shipping_location 
			WHERE ProductID='".$ProductID."' AND Loc_Type='Dist'");
			while($all_district_row=mysqli_fetch_row($all_district))
			   {
			       $test=0;
				   for($i=0;$i<$counter;$i++)
				   {
					 if($a[$i]==$all_district_row[0])
					 {
					   $test=1;
					   break;
					 }
				   } 
				    if($test==0)
					{
					  $delete=mysqli_query($con, "DELETE FROM product_shipping_location WHERE ShippingLocationID='".$all_district_row[1]."'");
					}
				   
			   }
			 for($i=0;$i<$counter;$i++)
				   {
					 
					 $check=mysqli_fetch_row(mysqli_query($con, "SELECT ShippingLocationID FROM product_shipping_location 
					 WHERE ProductID='".$ProductID."' AND Loc_Type='Dist' AND Dis_Bgd_Country_ID='".$a[$i]."'"));
					 if($check[0]=="")
					 {
					    $ShippingLocationID=MakeID($con, "product_shipping_location","ShippingLocationID","PSL-",25);
										  
										  $rs=mysqli_query($con, "INSERT INTO product_shipping_location
										  (ShippingLocationID,ProductID,Dis_Bgd_Country_ID,Loc_Type) 
										  VALUES('".$ShippingLocationID."','".$ProductID."','".$a[$i]."','Dist')");
					 }
				   } 
			 $delete=mysqli_query($con, "DELETE FROM product_shipping_location WHERE ProductID='".$ProductID."' AND Loc_Type='Bangla'");
		}
	   
	   
	   //////////////////      Country   ////////////////
	    if($OB=="")
		 {
		   $delete=mysqli_query($con, "DELETE FROM product_shipping_location WHERE ProductID='".$ProductID."' AND Loc_Type='World'");
		 }
		else if($OB!="")
		 {
		
				   $b=$_POST["Country"];
				   $b_count=count($b);
				    $all_country=mysqli_query($con, "SELECT Dis_Bgd_Country_ID,ShippingLocationID FROM product_shipping_location 
					WHERE ProductID='".$ProductID."' AND Loc_Type='World'");
					while($all_country_row=mysqli_fetch_row($all_country))
					   {
						   $test=0;
						   for($i=0;$i<$b_count;$i++)
						   {
							 if($b[$i]==$all_country_row[0])
							 {
							   $test=1;
							   break;
							 }
						   } 
							if($test==0)
							{
							  $delete=mysqli_query($con, "DELETE FROM product_shipping_location WHERE ShippingLocationID='".$all_country_row[1]."'");
							}
						   
					   }
					 for($i=0;$i<$b_count;$i++)
						   {
							 
							 $check=mysqli_fetch_row(mysqli_query($con, "SELECT ShippingLocationID FROM product_shipping_location 
							 WHERE ProductID='".$ProductID."' AND Loc_Type='World' AND Dis_Bgd_Country_ID='".$b[$i]."'"));
							 if($check[0]=="")
							 {
								$ShippingLocationID=MakeID($con, "product_shipping_location","ShippingLocationID","PSL-",25);
												  
												  $rs=mysqli_query($con, "INSERT INTO product_shipping_location
												  (ShippingLocationID,ProductID,Dis_Bgd_Country_ID,Loc_Type) 
												  VALUES('".$ShippingLocationID."','".$ProductID."','".$b[$i]."','World')");
							 }
						   } 
			 
	     }

	  
	}
	

$world=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(Dis_Bgd_Country_ID) FROM product_shipping_location WHERE ProductID='".$_REQUEST["ProductID"]."'
	   AND Loc_Type='World'"));
	   
 $product_info=mysqli_fetch_row(mysqli_query($con, "SELECT
											product_info.ProductID
											, product_info.CategoryID
											, product_info.cattype
											, product_info.Name
											, product_info.SuppliersID
											,CONCAT( suppliers_info.FirstName
											, ' ',suppliers_info.MiddleName
											, ' ',suppliers_info.LastName)
											, product_info.InsertDate
											, product_info.SKUNumber
										FROM
											product_info
											LEFT JOIN suppliers_info 
												ON (product_info.SuppliersID = suppliers_info.SuppliersID)
                                        WHERE product_info.ProductID='".$_REQUEST["ProductID"]."'"));
  if($product_info[2]=="cat")
				  {
				   $cat_name=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName FROM product_category_info WHERE CategoryID='".$product_info[1]."'"));
				  }
				  else if($product_info[2]=="scat")
				  {
				   $cat_name=mysqli_fetch_row(mysqli_query($con, "SELECT
										CONCAT(product_category_info.CategoryName,' > '
										, product_sub_category.SubCategoryName)
									FROM
										product_sub_category
										INNER JOIN product_category_info 
											ON (product_sub_category.CategoryID = product_category_info.CategoryID)
									WHERE product_sub_category.SubCategoryID='".$product_info[1]."'"));
				  }
				  else if($product_info[2]=="sscat")
				  {
				   $cat_name=mysqli_fetch_row(mysqli_query($con, "SELECT
								CONCAT(product_category_info.CategoryName,' > '
								, product_sub_category.SubCategoryName,' > '
								, product_ssub_category.SubCategoryName)
							FROM
								product_ssub_category
								INNER JOIN product_sub_category 
									ON (product_ssub_category.SubCategoryID = product_sub_category.SubCategoryID)
								INNER JOIN product_category_info 
									ON (product_sub_category.CategoryID = product_category_info.CategoryID)
							WHERE product_ssub_category.SubSubCategoryID='".$product_info[1]."'"));
				  }
   
?>
<html>
<head>
<script src="jquery-1.4.4.min.js"></script>
<script type="text/javascript">
  function check_bgd()
   {
      
	  var chk_arr =  document.getElementsByName("CID[]");
		var chklength = chk_arr.length;     
		// document.getElementByID        
		if(document.getElementById("WB").checked==true)
		{ 
		for(k=0;k< chklength;k++)
		{
			chk_arr[k].checked = true;
		} 
		}
		else if(document.getElementById("WB").checked==false)
		{ 
		for(k=0;k< chklength;k++)
		{
			chk_arr[k].checked = false;
		} 
		}


   }
   function check_world()
   {
       if(document.getElementById("OB").checked==true)
		{ 
		  // alert('aaaaaaaaaa');
		  //document.getElementById("countrytable").style.display=="inline;";
		  $('#countrytable').load('country_location_ex.php?type=ok');
		}
	   else if(document.getElementById("OB").checked==false)
		{ 
		    $('#countrytable').load('country_location_ex.php?type=no');
		  //document.getElementById("countrytable").style.display=="none;";
		}
   }
   function check_world(ProductID)
   {
       if(document.getElementById("OB").checked==true)
		{ 
		  // alert('aaaaaaaaaa');
		  //document.getElementById("countrytable").style.display=="inline;";
		  $('#countrytable').load('country_location_ex.php?type=set&ProductID='+ProductID);
		}
	   else if(document.getElementById("OB").checked==false)
		{ 
		    $('#countrytable').load('country_location_ex.php?type=no');
		  //document.getElementById("countrytable").style.display=="none;";
		}
   }
   function check_world_ex(take_count,ProductID)
   {  //alert(''+ProductID);
      take_count=parseInt(take_count);
	  //alert(''+take_count);
      if(take_count>0)
		{ 
		  
		  $('#countrytable').load('country_location_ex.php?type=set&ProductID='+ProductID);
		}
	   
   }
   
</script>
<style type="text/css">
		.btnsdt
			{
			background-color:#F33;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
			color:#FFFFFF;
			}
		.btnsdt1 {background-color:#F33;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
			color:#FFFFFF;
}
.style3 {
	font-weight: bold;
	color: #FFFFFF;
}
.btnsdt11 {background-color:#F33;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
			color:#FFFFFF;
}
.btnsdt12 {background-color:#F33;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
			color:#FFFFFF;
}
.btnsdt121 {background-color:<?php echo $button_background; ?>;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
			color:#FFFFFF;
}
</style>
</head>
<body onLoad="check_world_ex('<?php print $world[0]; ?>','<?php print $ProductID; ?>');">
<form name="locationselect" method="post"  action="<?php print $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<table width="775" height="auto" border="0" align="center" cellpadding="3" cellspacing="1" style="border: 2px solid <?php echo $button_background; ?>; ">
  <tr >
    <td height="33" colspan="8" align="center" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:18px;"><strong>Set Product Shipping Location </strong></span>
      <input type="hidden" name="ProductID" value="<?php print $_REQUEST["ProductID"]; ?>" />
      <input type="hidden" name="MID" value="<?php print $_REQUEST["MID"]; ?>" />
      <input type="hidden" name="regdata" id="regdata" value="1" /></td>
  </tr>
  <tr >
    <td height="25" colspan="8" align="center" ><table width="773" border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>
    <td width="44" height="19" align="center" valign="top">&nbsp;</td>
    <td valign="top"><strong>Product Name </strong></td>
    <td valign="top"><strong>: <?php print $product_info[3]; ?></strong></td>
    <td align="right" valign="top"><strong>Insert Date </strong></td>
    <td valign="top"><strong>:<?php print substr($product_info[6],0,10); ?></strong></td>
  </tr>
  <tr>
    <td height="19" align="center" valign="top">&nbsp;</td>
    <td valign="top"><strong>Category</strong></td>
    <td valign="top"><strong>: <?php print $cat_name[0]; ?></strong></td>
    <td align="right" valign="top"><strong>SKU No </strong></td>
    <td valign="top"><strong>: <?php print $product_info[7]; ?></strong></td>
  </tr>
  <tr>
    <td height="19" align="center" valign="top">&nbsp;</td>
    <td valign="top"><strong>Supplier</strong></td>
    <td valign="top"><strong>: <?php print $product_info[5]; ?></strong></td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
    </table></td>
  </tr>
  <tr >
    <td height="25" colspan="8" align="center" >&nbsp;</td>
  </tr>

  <tr>
    <td height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="144" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">District  Name </span></td>
	<td width="33" height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="158" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">District  Name </span></td>
	<td width="51" height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="140" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">District  Name </span></td>
	<td width="53" height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="107" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">District  Name </span></td>
  </tr>
<tr bgcolor="#999999" >
   <?php
     $sl=0;
	 $tsl=0;
	 $total=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(DistrictID) FROM district_info WHERE ActiveStatus='Active'"));
	 $rs=mysqli_query($con, "SELECT DistrictID,DistrictName FROM district_info WHERE ActiveStatus='Active' ORDER BY DistrictName");
	 $bangla=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(Dis_Bgd_Country_ID) FROM product_shipping_location 
	 WHERE ProductID='".$_REQUEST["ProductID"]."' AND Dis_Bgd_Country_ID='Bangla'"));
	 $ShippingLocationID_Bangla=mysqli_fetch_row(mysqli_query($con, "SELECT ShippingLocationID FROM product_shipping_location 
	 WHERE ProductID='".$_REQUEST["ProductID"]."' AND Dis_Bgd_Country_ID='Bangla'  AND Loc_Type='Bangla'"));
	 
	 while($row=mysqli_fetch_row($rs))
	 {
	  $sl++;
	  $tsl++;
	     $Dist=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(Dis_Bgd_Country_ID) FROM product_shipping_location 
	 WHERE ProductID='".$_REQUEST["ProductID"]."' AND Dis_Bgd_Country_ID='".$row[0]."'"));
	 
	 $ShippingLocationID=mysqli_fetch_row(mysqli_query($con, "SELECT ShippingLocationID FROM product_shipping_location 
	 WHERE ProductID='".$_REQUEST["ProductID"]."' AND Dis_Bgd_Country_ID='".$row[0]."'  AND Loc_Type='Dist'"));
	   if($sl==1)
	   {
   ?>
    <tr bgcolor="#999999" >
      <?php } ?>
    <td width="28" height="22" align="center">
	<?php
	   if($bangla[0]>0 || $Dist[0]>0)
	   {
	?>
	<input type="checkbox" name="CID[]" id="checkbox" value="<?php print $row[0] ?>" checked="checked" />
	 <?php }
	  else
	  {
	  ?>
	  <input type="checkbox" name="CID[]" id="checkbox" value="<?php print $row[0] ?>"  />
	  <?php } ?>
		 </td>
    <td>
	<?php
	  if($ShippingLocationID!="")
	  {
	?>
	<a href="#" onClick="window.open('location_method.php?ShippingLocationID=<?php print $ShippingLocationID[0] ?>&type=insert','location_method','width=750px, height=700px, scrollbars=1, left=300px, top=100px');"><?php print $row[1]; ?></a>
	<?php }
	else
	{ print $row[1]; } ?></td>

     <?php if($sl==4 || $tsl==$total[0])
	   {
	    $sl=0;
	  ?>
    </tr>
<?php }}?>
  <tr>
    <td height="28" align="center" bgcolor="#999999">
	<?php
	   if($bangla[0]>0)
	   {
	   ?>
	<input type="checkbox" name="WB" id="WB" value="BGD" onClick="check_bgd();" checked="checked" />
	 <?php }
	  else
	   {
	  ?>
	<input type="checkbox" name="WB" id="WB" value="BGD" onClick="check_bgd();"  />
	<?php } ?>
	</td>
    <td bgcolor="#999999">
	<?php
	  if($ShippingLocationID_Bangla[0]!="")
	  {
	?>
	<a href="#" onClick="window.open('location_method.php?ShippingLocationID=<?php print $ShippingLocationID_Bangla[0] ?>&type=insert','location_method','width=750px, height=700px, scrollbars=1, left=300px, top=100px');">
	Whole Bangladesh</a>
	<?php
	  }
	  else
	  {print "Whole Bangladesh";}
	?>
	 </td>
    <td align="center" bgcolor="#999999">

	</td>
    <td bgcolor="#999999"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 <tr >
 <td colspan="8"></td>
 </tr>
  

  <tr style="" id="">
    
	<td colspan="8" align="center" id="countrytable" >	</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr >
    <td>&nbsp;</td>
    <td ><?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-02","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
      <input type="submit"  name="btnInsert" id="button" class="btnsdt121" value="SAVE" />
      <?php }   ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
