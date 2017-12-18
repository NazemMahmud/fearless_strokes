<?php
  include("connection.php");
  
  
    $pdt_row=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryID,cattype,Name FROM product_info WHERE ProductID='".$_REQUEST["ProductID"]."'"));
	$subUnit_Name=mysqli_fetch_row(mysqli_query($con, "SELECT
    product_sub_unit.SubUnitName
FROM
    product_cat_size
    INNER JOIN product_sub_unit 
        ON (product_cat_size.SubUnitID = product_sub_unit.SubUnitID)
WHERE product_cat_size.sub_id='".$_REQUEST["sub_id"]."'"));
 	if($pdt_row[1]=="sscat")
	{
	 $title=mysqli_fetch_row(mysqli_query($con, "SELECT
    CONCAT(product_category_info.CategoryName,' > ',
    product_sub_category.SubCategoryName,' > ',
    product_ssub_category.SubCategoryName)
FROM
    product_ssub_category
    INNER JOIN product_sub_category 
        ON (product_ssub_category.SubCategoryID = product_sub_category.SubCategoryID)
    INNER JOIN product_category_info 
        ON (product_sub_category.CategoryID = product_category_info.CategoryID)
WHERE product_ssub_category.SubSubCategoryID='".$pdt_row[0]."'"));
     $title="Volume/Size Settings for ".$title[0]." > ".$pdt_row[2];
	}
	else if($pdt_row[1]=="scat")
	{
	 $title=mysqli_fetch_row(mysqli_query($con, "SELECT
     CONCAT(product_category_info.CategoryName,' > '
    , product_sub_category.SubCategoryName)
   FROM
    product_sub_category
    INNER JOIN product_category_info 
        ON (product_sub_category.CategoryID = product_category_info.CategoryID)
WHERE product_sub_category.SubCategoryID='".$pdt_row[0]."'"));
     $title="Volume/Size Settings for ".$title[0]." > ".$pdt_row[2];
	}
	else if($pdt_row[1]=="cat")
	{
	 $title=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName FROM product_category_info WHERE CategoryID='".$pdt_row[0]."'"));
     $title="Volume/Size Settings for ".$title[0]." > ".$pdt_row[2];
	}
     

	   if(isset($_REQUEST["btnInsert"]))
	    {

		  $id=mysqli_fetch_row(mysqli_query($con, "SELECT IFNULL(MAX(VolumeID),0) FROM product_size_volume"));
          $adid=$id[0]+1;
			   $volume_insert=mysqli_query($con, "INSERT INTO product_size_volume (VolumeID,sub_id,Volume)
			    VALUES('".$adid."','".$_REQUEST["sub_id"]."','".$_REQUEST["Volume"]."')");
			  
		  
		}

        if(isset($_REQUEST["btnUpdateQty"]))
	    { 
		  $size_id_count=count($_POST["qid"]);
			  for($i=0;$i<$size_id_count;$i++)
			  {
				$update=mysqli_query($con, "UPDATE product_size_volume SET Qty='".$_POST["qty"][$i]."' 
				WHERE VolumeID='".$_POST["qid"][$i]."' AND sub_id='".$_REQUEST["sub_id"]."'");
			  }
		  print "<script>alert('Successfully Updated Qty')</script>";
		}
		
	   if(isset($_REQUEST["btnDelete"]))
	    {
           //$_REQUEST["UnitSelect"]=$check[1];   
		  $size_id_count=count($_POST["volumeid"]);
		 
			  for($i=0;$i<$size_id_count;$i++)
			  {
			  $delete=mysqli_query($con, "DELETE FROM product_size_volume WHERE VolumeID='".$_POST["volumeid"][$i]."' AND sub_id='".$_REQUEST["sub_id"]."'");
			  }

		 }

			  $rs=mysqli_query($con, "SELECT VolumeID,Volume,orderid,Qty FROM product_size_volume WHERE sub_id='".$_REQUEST["sub_id"]."' ORDER BY orderid");
		

	  
	   
?>
<HTML>
<HEAD>

<script type="text/javascript">

</script>

    <style type="text/css">
<!--
.style4 {color: #FFFFFF; font-weight: bold; }
-->
    </style>
	 <style type="text/css">
		.btnsdt
			{
			background-color:#F33;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
			
			}
		.btnsdt1 {			background-color:#F33;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
}
     .btnsdt11 {background-color:#F33;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
}
     .btnsdt2 {			background-color:#F33;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
}
     .style5 {color: #FFFFFF}
     .btnsdt3 {			background-color:#F33;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
}
     .btnsdt4 {			background-color:#F33;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
}
     .btnsdt41 {background-color:#F33;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
}
     .btnsdt5 {			background-color:#F33;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
}
     </style>
</HEAD>
<BODY>
<form name="unit_volume_set" method="post" action="<?php print $_SERVER['PHP_SELF']; ?>">
  <table width="328" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="65" colspan="3" align="center"><span style="font-size:20px; font-weight:bold; color:#000000;"><?php print $title; ?> </span>
          <input type="hidden" name="ProductID" value="<?php print $_REQUEST["ProductID"]; ?>" />
          <input type="hidden" name="sub_id" value="<?php print $_REQUEST["sub_id"]; ?>"  />      </td>
    </tr>
    <tr>
      <td height="32" align="right" valign="top"><strong>Unit Name</strong><strong>: </strong></td>
      <td height="32" align="left" valign="top"><?php print $subUnit_Name[0]; ?></td>
    </tr>
    <tr>
      <td height="32" align="right" valign="top"><strong>Size Name</strong><strong>: </strong>   </td>
      <td height="32" align="left" valign="top"><input name="Volume" type="text" id="Volume" /></td>
    </tr>
    <tr>
      <td height="41" colspan="3" align="center" valign="top"><input name="btnInsert" type="submit" class="btnsdt" id="btnInsert" value="Insert Size" /></td>
    </tr>
    <tr>
      <td width="111" height="28" align="center" bgcolor="#000000"><span class="style4">SL</span></td>
      <td width="109" align="left" bgcolor="#000000"><span class="style4">Size Name </span></td>
      <td width="108" align="center" bgcolor="#000000"><span class="style4">Qty</span></td>
    </tr>
    <?php
   $sl=0;
      while(@$row=mysqli_fetch_row($rs))
	  {
    $sl++;
	 if($sl%2==0)
	 {$bgcolor="bgcolor=\"#E3E9E9\"";}
	 else
	 {$bgcolor="bgcolor=\"#F0F2F5\"";}
  ?>
    <tr <?php print $bgcolor; ?>>
      <td height="30" align="center"><?php print $sl; ?>
          <input type="checkbox" name="volumeid[]" value="<?php print $row[0]; ?>" /></td>
      <td align="left"><?php print $row[1]; ?>	  </td>
      <td align="center">
	  <a href="#" style="text-decoration:none;" onClick="window.open('color_image_setting.php?ProductID=<?php print $_REQUEST["ProductID"] ?>&id=<?php print $row[0]; ?>&type=volume','color_image_setting','width=600px, height=400px, scrollbars=1, left=300px, top=100px,');">
	  <!--<img src="actionimage/image.jpeg" style="width:18px; height:18px;" title="Image Settings">-->
	  </a>
	  <input name="qty[]" type="text" value="<?php print $row[3]; ?>" size="3" />
	  <input type="hidden" name="qid[]" id="unittype2" value="<?php print $row[0]; ?>" /></td>
    </tr>
    <?php } ?>
    <tr>
      <td height="37" colspan="3" align="center">

          <input type="submit" name="btnDelete" class="btnsdt" value="Delete Size" />
          <input type="submit" name="btnUpdateQty" class="btnsdt5" value="Update Qty" /></td>
    </tr>
  </table>
</form>
</BODY>
</HTML>