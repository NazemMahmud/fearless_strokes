<?php
  include("connection.php");
  
  	$belowCheck=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(CatID) FROM product_price_discount_range 
	WHERE CatID='".$_REQUEST["ID"]."' AND type='prange' AND  BelowRange=0"));
	
	$aboveCheck=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(CatID) FROM product_price_discount_range 
	WHERE CatID='".$_REQUEST["ID"]."' AND type='prange' AND  AboveRange=0"));
	
  if(isset($_POST["UpdateFromTO"]))
  {
    $update_below=mysqli_query($con, "UPDATE product_price_discount_range SET AboveRange='".$_POST["UpdateBelowPrice"]."'
	WHERE BelowRange='0' AND CatID='".$_REQUEST["ID"]."' AND type='prange'");
	
	$update_above=mysqli_query($con, "UPDATE product_price_discount_range SET BelowRange='".$_POST["UpdateAbovePrice"]."'
	WHERE AboveRange='0' AND CatID='".$_REQUEST["ID"]."' AND type='prange'");
	
	print "<script>alert('Successfully Updated Below and Above Price Range')</script>";
	
  }
  
 if(isset($_POST["btnAdd"]))
 {
     if($belowCheck[0]==0)
	 {
	   $rs=mysqli_query($con, "INSERT INTO product_price_discount_range (CatID,BelowRange,AboveRange,type)
    VALUES('".$_POST["ID"]."','','".$_POST["BelowPrice"]."','prange')"); 
	 }
	 if($aboveCheck[0]==0)
	 {
	   $rs=mysqli_query($con, "INSERT INTO product_price_discount_range (CatID,BelowRange,AboveRange,type)
    VALUES('".$_POST["ID"]."','".$_POST["AbovePrice"]."','','prange')"); 
     
	 }
   $rs=mysqli_query($con, "INSERT INTO product_price_discount_range (CatID,BelowRange,AboveRange,type)
    VALUES('".$_POST["ID"]."','".$_POST["From"]."','".$_POST["To"]."','prange')"); 
   
   print "<script>alert('Successfully Inserted Price Range')</script>";
 }
 if(isset($_POST["btnListUpdate"]))
 {
	 
	 $rs=mysqli_query($con, "SELECT id,BelowRange,AboveRange FROM product_price_discount_range WHERE type='prange'
    AND CatID='".$_REQUEST["ID"]."' AND BelowRange!=0 AND  AboveRange!=0 ORDER BY id  ");
	$i=-1;
	 while($row=mysqli_fetch_row($rs))
	 {
	   $i++;
		$update=mysqli_query($con, "UPDATE product_price_discount_range SET BelowRange='".$_POST["UpdateFrom"][$i]."',
		AboveRange='".$_POST["UpdateTo"][$i]."' WHERE id='".$row[0]."'");
	 }
     print "<script>alert('Successfully Updated Range')</script>";
 }
 if(isset($_POST["btnDelete"]))
 {
    $id=$_POST["id"];
	 $idCOunt=count($id);
	 for($i=0;$i<$idCOunt;$i++)
	 {
	   
		$del=mysqli_query($con, "DELETE FROM product_price_discount_range WHERE id='".$id[$i]."' AND CatID='".$_REQUEST["ID"]."'");
	 }
     print "<script>alert('Successfully Deleted Range')</script>";
  
 }
 
 	if($_REQUEST["cattype"]=="sscat")
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
WHERE product_ssub_category.SubSubCategoryID='".$_REQUEST["ID"]."'"));
     $title="Price Range Settings for ".$title[0];
	}
	else if($_REQUEST["cattype"]=="scat")
	{
	 $title=mysqli_fetch_row(mysqli_query($con, "SELECT
     CONCAT(product_category_info.CategoryName,' > '
    , product_sub_category.SubCategoryName)
   FROM
    product_sub_category
    INNER JOIN product_category_info 
        ON (product_sub_category.CategoryID = product_category_info.CategoryID)
WHERE product_sub_category.SubCategoryID='".$_REQUEST["ID"]."'"));
     $title="Price Range Settings for ".$title[0];
	}
	else if($_REQUEST["cattype"]=="cat")
	{
	 $title=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName FROM product_category_info WHERE CategoryID='".$_REQUEST["ID"]."'"));
     $title="Price Range Settings for ".$title[0];
	}


  	$belowCheck=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(CatID) FROM product_price_discount_range 
	WHERE CatID='".$_REQUEST["ID"]."' AND type='prange' AND  BelowRange=0"));
	
	$aboveCheck=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(CatID) FROM product_price_discount_range 
	WHERE CatID='".$_REQUEST["ID"]."' AND type='prange' AND  AboveRange=0"));
	
$below_amount=mysqli_fetch_row(mysqli_query($con, "SELECT AboveRange FROM product_price_discount_range 
	WHERE CatID='".$_REQUEST["ID"]."' AND type='prange' AND  BelowRange='0'"));
$above_amount=mysqli_fetch_row(mysqli_query($con, "SELECT BelowRange FROM product_price_discount_range 
	WHERE CatID='".$_REQUEST["ID"]."' AND type='prange' AND  AboveRange='0'"));
?>
<HTML>
<HEAD>

	<script src="color/js/jquery/jquery.js" type="text/javascript"></script>
	<script src="color/js/jquery/ifx.js" type="text/javascript"></script>
	<script src="color/js/jquery/idrop.js" type="text/javascript"></script>
	<script src="color/js/jquery/idrag.js" type="text/javascript"></script>
	<script src="color/js/jquery/iutil.js" type="text/javascript"></script>
	<script src="color/js/jquery/islider.js" type="text/javascript"></script>

	<script src="color/js/jquery/color_picker/color_picker.js" type="text/javascript"></script>


	<link href="color/js/jquery/color_picker/color_picker.css" rel="stylesheet" type="text/css">

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
     </style>
</HEAD>
<BODY>
<form name="color_set" method="post" action="<?php print $_SERVER['PHP_SELF']; ?>">
<table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="65" colspan="7" align="center">
	<span style="font-size:20px; font-weight:bold; color:#000000;"><?php print $title; ?> </span>
	      <input type="hidden" name="ID" value="<?php print $_REQUEST["ID"]; ?>" />
	  <input type="hidden" name="type" value="<?php print $_REQUEST["type"]; ?>"  />
	  <input type="hidden" name="cattype" value="<?php print $_REQUEST["cattype"]; ?>"  />  	  </td>
  </tr>
  <?php
   if($_REQUEST["type"]=="insert")
    {
	if($belowCheck[0]==0)
	{
   ?>
  <tr>
    <td height="32" colspan="4" align="left" valign="top"><strong>Below  </strong><strong>or equal price of</strong></td>
    <td height="32" colspan="3" align="left" valign="top"><strong>:
        <input name="BelowPrice" type="text" id="BelowPrice" size="10" />
(e.g. only numeric data) </strong></td>
    </tr>
<?php } ?>
  <tr>
    <td height="28" colspan="4" align="left" valign="top"><strong>Price Range greater </strong><strong>or equal of</strong></td>
    <td height="28" colspan="3" align="left" valign="top"><strong>
      :
      <input name="From" type="text" id="From" size="10" />
(e.g. only numeric data) </strong></td>
    </tr>
  <tr>
    <td height="28" colspan="4" align="left" valign="top"><strong>Price Range less </strong><strong>or equal of</strong></td>
    <td height="28" colspan="3" align="left" valign="top"><strong>
    :
    <input name="To" type="text" id="To" size="10" />
    
(e.g. only numeric data) </strong></td>
    </tr>
<?php 
if($aboveCheck[0]==0)
{
  ?>
  <tr>
    <td height="28" colspan="4" align="left" valign="top"><strong>Above </strong><strong>or equal price of</strong></td>
    <td height="28" colspan="3" align="left" valign="top"><strong>:
        <input name="AbovePrice" type="text" id="AbovePrice" size="10" />
(e.g. only numeric data) </strong></td>
    </tr>
<?php } ?>
  <tr>
    <td width="78" height="67" align="center">&nbsp;</td>
    <td colspan="5" align="center"><input type="submit" name="btnAdd" class="btnsdt" value="Add Price Range" /></td>
    <td align="center">&nbsp;</td>
  </tr>
  <?php } ?>
  <?php
   	if($belowCheck[0]!=0 && $aboveCheck[0]!=0 )
	{
  ?>
   <tr>
    <td height="28" colspan="4" align="left" valign="top"><strong>Below </strong><strong>or equal price of</strong></td>
    <td height="28" colspan="3" align="left" valign="top"><strong>:
      <input name="UpdateBelowPrice" type="text" id="UpdateBelowPrice" size="10" value="<?php @print $below_amount[0]; ?>" />
(e.g. only numeric data) </strong></td>
    </tr>

 <tr>
    <td height="28" colspan="4" align="left" valign="top"><strong>Above </strong><strong>or equal price of</strong></td>
    <td height="28" colspan="3" align="left" valign="top"><strong>:
      <input name="UpdateAbovePrice" type="text" id="UpdateAbovePrice" size="10" value="<?php @print $above_amount[0]; ?>" />
(e.g. only numeric data) </strong></td>
    </tr>

	      <?php
   if($_REQUEST["type"]=="delete")
    {
   ?>
 <tr>
    <td height="48" colspan="4" align="left" valign="top">&nbsp;</td>
    <td height="48" colspan="3" align="left" valign="middle"><input type="submit" name="UpdateFromTO" class="btnsdt" value="Update Below and Above Price" /></td>
    </tr>
<?php }} ?>
  <tr>
    <td height="28" align="center" bgcolor="#000000"><span class="style4">SL</span></td>
    <td colspan="4" align="center" bgcolor="#000000"><span class="style4">Greater or equal </span></td>
    <td width="180" align="center" bgcolor="#000000"><span class="style4">Less or equal </span></td>
    <td width="115" align="center" bgcolor="#000000"><span class="style4">Price Range  </span></td>
  </tr>
  <?php
   $sl=0;
   $rs=mysqli_query($con, "SELECT id,BelowRange,AboveRange FROM product_price_discount_range WHERE type='prange'
    AND CatID='".$_REQUEST["ID"]."' AND BelowRange!=0 AND  AboveRange!=0 ORDER BY id  ");
   while($row=mysqli_fetch_row($rs))
   {
    $sl++;
	 if($sl%2==0)
	 {$bgcolor="bgcolor=\"#E3E9E9\"";}
	 else
	 {$bgcolor="bgcolor=\"#F0F2F5\"";}
  ?>
  <tr <?php print $bgcolor; ?>>
    <td height="30" align="center"><?php print $sl; ?>
	      <?php
   if($_REQUEST["type"]=="delete")
    {
   ?>
      <input type="checkbox" name="id[]" value="<?php print $row[0]; ?>" />
	<?php } ?>	  </td>
    <td colspan="4" align="center"><strong>
      <input name="UpdateFrom[]" type="text"  size="10" value="<?php print $row[1]; ?>" />
    </strong></td>
    <td align="center"><strong>
      <input name="UpdateTo[]" type="text"  size="10" value="<?php print $row[2]; ?>" />
    </strong></td>
    <td align="center">Numeric Range </td>
  </tr>
 <?php } ?>
   <?php
   if($_REQUEST["type"]=="delete")
    {
   ?>
  <tr>
    <td height="37">&nbsp;</td>
    <td colspan="4" align="center"><input type="submit" name="btnListUpdate" class="btnsdt" value="Edit Price Range" /></td>
    <td colspan="2"><input type="submit" name="btnDelete" class="btnsdt" value="Delete Price Range" /></td>
    </tr>
  <?php } ?>
</table>
</form>
</BODY>
</HTML>