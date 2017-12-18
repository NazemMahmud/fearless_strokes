<?php
  include("connection.php");
     $ProductID=$_REQUEST["ProductID"];
    $CatID=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryID,Name,Brand,Price,SuppliersID,InsertDate
	 FROM product_info where ProductID='".$_REQUEST["ProductID"]."'"));
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
WHERE product_ssub_category.SubSubCategoryID='".$CatID[0]."'"));
     $title="Color Settings for ".$title[0];
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
WHERE product_sub_category.SubCategoryID='".$CatID[0]."'"));
     $title="Color Settings for ".$title[0];
	}
	else if($_REQUEST["cattype"]=="cat")
	{
	 $title=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName FROM product_category_info WHERE CategoryID='".$CatID[0]."'"));
     $title="Color Settings for ".$title[0];
	}
	
  if(isset($_POST["ColorSelect"]))
  {
    
	 $a=$_POST["id"];
     $counter=count($a);
	  for($i=0;$i<$counter;$i++)
	   {
		  
			 $insert_color=mysqli_query($con, "INSERT INTO product_color_info (colorid,ProductID) VALUES('".$a[$i]."','".$ProductID."')");
							
							
	   }

   print "<script type=\"text/javascript\"> window.opener.location.reload();</script>";	
   print "<script type=\"text/javascript\">window.close();</script>";
  }
  if(isset($_POST["ColorDelete"]))
  {
     $imagefolder="productimage/";
	 $a=$_POST["id"];
     $counter=count($a);
	  for($i=0;$i<$counter;$i++)
	   {
		  
			 $select_image=mysqli_query($con, "SELECT id,image_name FROM product_color_image_info WHERE product_color_id='".$a[$i]."'");
			 while($select_imageRow=mysqli_fetch_row($select_image))
			 {
			   @unlink($imagefolder.$select_imageRow[1]);
			 }
			 $delete_image_id=mysqli_query($con, "DELETE FROM product_color_image_info WHERE product_color_id='".$a[$i]."'");
			 $delete_product_color=mysqli_query($con, "DELETE FROM product_color_info WHERE id='".$a[$i]."'  AND ProductID='".$ProductID."'");
							
							
	   }

   print "<script type=\"text/javascript\"> window.opener.location.reload();</script>";	
   print "<script type=\"text/javascript\">window.close();</script>";
  }
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
		</style>
</HEAD>
<BODY>
<form name="color_set" method="post" action="<?php print $_SERVER['PHP_SELF']; ?>">
<table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="49" colspan="3" align="center">
	<span style="font-size:20px; font-weight:bold; color:#000000;"><?php print $title; ?> </span>
	      <input type="hidden" name="ProductID" value="<?php print $_REQUEST["ProductID"]; ?>" />
	  <input type="hidden" name="type" value="<?php print $_REQUEST["type"]; ?>"  />
	  <input type="hidden" name="cattype" value="<?php print $_REQUEST["cattype"]; ?>"  />  	  </td>
  </tr>
  <tr>
    <td height="28" align="center" bgcolor="#FFFFFF"><strong>Name</strong></td>
    <td colspan="2" align="left" bgcolor="#FFFFFF"><strong>: <?php print $CatID[1]; ?></strong></td>
  </tr>
  <tr>
    <td height="28" align="center" bgcolor="#FFFFFF"><strong>Brand</strong></td>
    <td colspan="2" align="left" bgcolor="#FFFFFF"><strong>: <?php print $CatID[2]; ?></strong></td>
  </tr>
  <tr>
    <td height="28" align="center" bgcolor="#FFFFFF"><strong>Price</strong></td>
    <td colspan="2" align="left" bgcolor="#FFFFFF"><strong>: <?php print $CatID[3]; ?></strong></td>
    </tr>
  <tr>
    <td width="90" height="28" align="center" bgcolor="#000000"><span class="style4">SL</span></td>
    <td align="center" bgcolor="#000000"><span class="style4">Color Name </span></td>
    <td width="200" align="center" bgcolor="#000000"><span class="style4">Color</span></td>
    </tr>
  <?php
   $sl=0;
   if($_REQUEST["type"]=="insert")
   {
   $rs=mysqli_query($con, "SELECT
    product_cat_color.id
    , product_cat_color.CatID
    , product_cat_color.ColorName
    , product_cat_color.ColorCode
FROM
    product_info
    INNER JOIN product_cat_color 
        ON (product_info.CategoryID = product_cat_color.CatID)
WHERE product_info.ProductID='".$_REQUEST["ProductID"]."' 
AND product_cat_color.id NOT IN(SELECT colorid FROM product_color_info WHERE ProductID='".$_REQUEST["ProductID"]."') 
ORDER BY product_cat_color.id DESC");
  }
   if($_REQUEST["type"]=="delete")
   {
   $rs=mysqli_query($con, "SELECT
    product_color_info.id
    , product_info.CategoryID
    , product_cat_color.ColorName
    , product_cat_color.ColorCode
FROM
    product_info
    INNER JOIN product_color_info 
        ON (product_info.ProductID = product_color_info.ProductID)
    INNER JOIN product_cat_color 
        ON (product_color_info.colorid = product_cat_color.id)
WHERE product_info.ProductID='".$_REQUEST["ProductID"]."' ORDER BY product_color_info.orderid");
  }
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

      <input type="checkbox" name="id[]" value="<?php print $row[0]; ?>" /></td>
    <td align="center">
	<?php print $row[2]; ?>
	<input type="hidden" name="colorname[]" value="<?php print $row[2]; ?>"  />	</td>
    <td align="center"><div style="width:20px; height:20px; background-color:#<?php print $row[3]; ?>;"></div>
	<input type="hidden" name="colorcode[]" value="<?php print $row[3]; ?>"  />	</td>
    </tr>
 <?php } ?>

  <tr>
    <td height="37">&nbsp;</td>
    <td align="right">
	<?php
	 if($_REQUEST["type"]=="insert")
	 {
	?>
	<input type="submit" name="ColorSelect" class="btnsdt" value="Add Color" />
	<?php } ?>
	<?php
	 if($_REQUEST["type"]=="delete")
	 {
	?>
	<input type="submit" name="ColorDelete" class="btnsdt" value="Delete Color" />
	<?php } ?>	</td>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
</BODY>
</HTML>