<?php
  include("connection.php");
 
 
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
WHERE product_sub_category.SubCategoryID='".$_REQUEST["ID"]."'"));
     $title="Color Settings for ".$title[0];
	}
	else if($_REQUEST["cattype"]=="cat")
	{
	 $title=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName FROM product_category_info WHERE CategoryID='".$_REQUEST["ID"]."'"));
     $title="Color Settings for ".$title[0];
	}
	
  if(isset($_POST["ColorSelect"]))
  {
     $a=$_POST["id"];
	 $color=$_POST["colorcode"];
	 $colorname=$_POST["colorname"];
  $counter=count($a);
  $id="";
  $div="";
  for($i=0;$i<$counter;$i++)
   {
	 $id.="|".$a[$i];
	 //print $color[$i]; 
      // $div.="<div style='float:left; width:20px; height:20px; background-color:#".$color[$i].";'></div>";
	  $div.=$colorname[$i].". ";
	 $revieweremaillist.=$a[$i]."<br>"; 
   }
   $div.="</tr></table>";
   print "<script type=\"text/javascript\">window.opener.document.getElementById('color_div').style.display='inline';</script>";
   print "<script type=\"text/javascript\">window.opener.document.getElementById('color_div').innerHTML='$div';</script>";

   print "<script type=\"text/javascript\">window.opener.document.product_form.colorid.value='$id';</script>";
   print "<script type=\"text/javascript\">window.opener.document.product_form.colorcount.value=$counter</script>";	
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
    <td height="65" colspan="5" align="center">
	<span style="font-size:20px; font-weight:bold; color:#000000;"><?php print $title; ?> </span>
	      <input type="hidden" name="ID" value="<?php print $_REQUEST["ID"]; ?>" />
	  <input type="hidden" name="type" value="<?php print $_REQUEST["type"]; ?>"  />
	  <input type="hidden" name="cattype" value="<?php print $_REQUEST["cattype"]; ?>"  />  	  </td>
  </tr>
  <tr>
    <td width="90" height="28" align="center" bgcolor="#000000"><span class="style4">SL</span></td>
    <td width="83" colspan="2" align="center" bgcolor="#000000"><span class="style4">Color Name </span></td>
    <td width="118" align="center" bgcolor="#000000"><span class="style4">Color</span></td>
    <td width="127" align="center" bgcolor="#000000"><span class="style4">Color Code </span></td>
  </tr>
  <?php
   $sl=0;
   $rs=mysqli_query($con, "SELECT * FROM product_cat_color WHERE CatID='".$_REQUEST["ID"]."' ORDER BY id DESC");
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

      <input type="checkbox" name="id[]" value="<?php print $row[0]; ?>" />
</td>
    <td colspan="2" align="center">
	<?php print $row[2]; ?>
	<input type="hidden" name="colorname[]" value="<?php print $row[2]; ?>"  /> 
	</td>
    <td align="center"><div style="width:20px; height:20px; background-color:#<?php print $row[3]; ?>;"></div>
	<input type="hidden" name="colorcode[]" value="<?php print $row[3]; ?>"  /> 
	</td>
    <td align="center"><?php print $row[3]; ?></td>
  </tr>
 <?php } ?>

  <tr>
    <td height="37">&nbsp;</td>
    <td colspan="2" align="right"><input type="submit" name="ColorSelect" class="btnsdt" value="Select Color" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

</table>
</form>
</BODY>
</HTML>