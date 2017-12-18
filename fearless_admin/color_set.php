<?php
  session_start();
  include("connection.php");
  
    $pdt_row=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryID,cattype,ProductName FROM product_info WHERE ProductID='".$_REQUEST["ProductID"]."'"));
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
     $title="Color Settings for ".$title[0]." > ".$pdt_row[2];
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
     $title="Color Settings for ".$title[0]." > ".$pdt_row[2];
	}
	else if($pdt_row[1]=="cat")
	{
	 $title=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName FROM product_category_info WHERE CategoryID='".$pdt_row[0]."'"));
     $title="Color Settings for ".$title[0]." > ".$pdt_row[2];
	}
  $uploadfolder="../colorimage/";
  
 if(isset($_POST["btnAdd"]))
 {
      
	  $id=mysqli_fetch_row(mysqli_query($con, "SELECT IFNULL(MAX(ColorID),0) FROM product_color"));
	  $adid=$id[0]+1;
		$allowedfiletypes = array("jpeg","jpg","gif","png");
		
	    $uploadfilename = $_FILES['photo']['name'];
		$fileext = strtolower(substr($uploadfilename,strrpos($uploadfilename,".")+1));
		    if (!empty($uploadfilename) and !in_array($fileext,$allowedfiletypes)) 
			{ 
			print "<script>alert('Try New Color Image')</script>";	
		    }
		    else if(!empty($uploadfilename))
		    {		
			$file1 = $uploadfolder.$adid.$_FILES['photo']['name'];
			$bigimg = $adid.$_FILES['photo']['name']; 
	        move_uploaded_file($_FILES['photo']['tmp_name'], $file1);
			   
			   
			   $rs = mysqli_query($con, "INSERT INTO product_color (ColorID,UnitID,ProductID,ColorName,ColorImage)
			    VALUES('".$adid."','".$_POST["Size"]."','".$_REQUEST["ProductID"]."','".$_REQUEST["colorName"]."','".$bigimg."')");
			   if($rs)
			   print "<script>alert('Successfully Inserted Color')</script>";
			   else
			   print "<script>alert('Insertion Failed! Try Again')</script>";
            }
			else if(empty($uploadfilename))
			{
			 print "<script>alert('Plz Try With Color Image')</script>";
			}
			 
 }
 if(isset($_REQUEST["btnUpdateQty"]))
	    { 
		  $size_id_count=count($_POST["qid"]);
			  for($i=0;$i<$size_id_count;$i++)
			  {
				
				$update=mysqli_query($con, "UPDATE product_color SET Qty='".$_POST["qty"][$i]."',orderid='".$_POST["orderlist"][$i]."' 
				WHERE ColorID='".$_POST["qid"][$i]."' AND ProductID='".$_REQUEST["ProductID"]."'");
			  }
			  print "<script>alert('Successfully Updated Qty')</script>";
		  
		}
 
 if(isset($_POST["btnDelete"]))
 {
    $id=$_POST["id"];
	 $idCOunt=count($id);
	 for($i=0;$i<$idCOunt;$i++)
	 {
	   $color_image=mysqli_fetch_row(mysqli_query($con, "SELECT ColorImage FROM product_color WHERE ColorID='".$id[$i]."'
	    AND ProductID='".$_REQUEST["ProductID"]."'"));
		@unlink($uploadfolder.$color_image[0]);
		$del=mysqli_query($con, "DELETE FROM product_color WHERE ColorID='".$id[$i]."' AND ProductID='".$_REQUEST["ProductID"]."'");
	 }
     print "<script>alert('Successfully Deleted Color')</script>";
  
 }
 

?>
<HTML>
<HEAD>
<script type="text/javascript" src="jquery-1.4.4.min.js"></script>
<script type="text/javascript">
function volume(searchCode)
      {
	  //alert(''+searchCode);
       $.post("LookUp.php",{ func: "VOLUME", src: searchCode},
	   function(data)
	   {
	   $('#volume').html(data.SSSSS);
	   },"json")	
      }
</script>
    <style type="text/css">
<!--
.style4 {color: #FFFFFF; font-weight: bold; }
-->
    </style>
	 <style type="text/css">
		.btnsdt
			{
			background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
			
			}
		.btnsdt5 {background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
}
     </style>
</HEAD>
<BODY>
<form name="color_set" method="post" action="<?php print $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="65" colspan="8" align="center">
	<span style="font-size:20px; font-weight:bold; color:#000000;"><?php print $title; ?> </span>
	      <input type="hidden" name="ProductID" value="<?php print $_REQUEST["ProductID"]; ?>" />
	  <input type="hidden" name="type" value="<?php print $_REQUEST["type"]; ?>"  />
	  <input type="hidden" name="cattype" value="<?php print $_REQUEST["cattype"]; ?>"  />  	  </td>
  </tr>
  <?php
   if($_REQUEST["type"]=="insert")
    {
   ?>
  <tr>
    <td height="32" colspan="8" align="left" valign="top"><strong>Select Size &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><strong>: 
        <select name="Size" id="Size" onChange="volume(this.value);">
	  <option value="">Select Size</option>
	  <?php
	   $size=mysqli_query($con, "SELECT UnitID,UnitName FROM product_unit WHERE ActiveStatus = 'Active' ORDER BY UnitName");
       while($sizeRow=mysqli_fetch_row($size))
        {
	  ?>
	   <option value="<?php print $sizeRow[0]; ?>"><?php print $sizeRow[1]; ?></option>
	   <?php } ?>
      </select>
    </strong></td>
    </tr>
  <tr>
    <td height="28" colspan="8" align="left" valign="top"><strong>Color Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>:
      <input name="colorName" type="text" id="colorName" size="40" />
      
      </strong></td>
  </tr>
  <tr>
    <td height="28" colspan="8" align="left" valign="top"><strong>Color Image&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </strong><strong>: </strong>
      <input type="file" name="photo" id="photo" /> 
      (18px * 18px)</td>
  </tr>
  <tr>
    <td width="103" height="58" align="center">&nbsp;</td>
    <td colspan="7" align="left">
      <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","add_option");
			 if($check_access=="yes")
			  {
			 ?>
      <input type="submit" name="btnAdd" class="btnsdt" value="Add Color" />
      <?php } ?>	</td>
    </tr>
  <?php } ?>
  <tr>
    <td height="28" align="center" bgcolor="#000000"><span class="style4">SL</span></td>
    <td width="138" align="center" bgcolor="#000000"><span class="style4">Color Name </span></td>
    <td width="73" align="center" bgcolor="#000000"><span class="style4">Color</span></td>
    <td colspan="2" align="center" bgcolor="#000000"><span class="style4">Size</span></td>
    <td width="66" align="center" bgcolor="#000000"><span class="style4">Act</span></td>
    <td width="57" align="center" bgcolor="#000000"><span class="style4">Qty</span></td>
    <td width="49" align="center" bgcolor="#000000"><span class="style4">Order</span></td>
  </tr>
  <?php
   $sl=0;
   $rs=mysqli_query($con, "SELECT
    product_color.ColorID
    , product_unit.UnitName
    , product_color.ColorName
    , product_color.ColorImage
    , product_color.orderid
    , product_color.Qty
FROM
    ecommerce.product_color
    INNER JOIN ecommerce.product_unit 
        ON (product_color.UnitID = product_unit.UnitID)
WHERE product_color.ProductID='".$_REQUEST["ProductID"]."'
ORDER BY product_color.orderid");
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
	      <?php
   if($_REQUEST["type"]=="delete")
    {
   ?>
      <input type="checkbox" name="id[]" value="<?php print $row[0]; ?>" />
	<?php } ?>	  </td>
    <td align="center"><?php print $row[1]; ?></td>
    <td align="center"><img src="../colorimage/<?php print $row[3]; ?>" style="width:18px; height:18px;"></td>
    <td colspan="2" align="center"><?php print $row[1]; ?></td>
    <td align="center">
      <a href="#" style="text-decoration:none;" onClick="window.open('color_image_setting.php?ProductID=<?php print $_REQUEST["ProductID"] ?>&id=<?php print $row[0]; ?>&type=color','color_image_setting','width=600px, height=400px, scrollbars=1, left=300px, top=100px,');">
        <img src="actionimage/image.jpeg" height="25" style="width:18px; height:18px;" title="Image Settings">
        </a>
      <input type="hidden" name="qid[]" id="unittype2" value="<?php print $row[0]; ?>" /></td>
    <td align="center"><input name="qty[]" type="text" value="<?php print $row[5]; ?>" size="3" /></td>
    <td align="center"><input name="orderlist[]" type="text" value="<?php print $row[4]; ?>" size="3" /></td>
  </tr>
 <?php } ?>
   <?php
   if($_REQUEST["type"]=="delete")
    {
   ?>
  <tr>
    <td height="37">&nbsp;</td>
    <td colspan="3" align="right">
	 <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","delete_option");
			 if($check_access=="yes")
			  {
			 ?>
	<input type="submit" name="btnDelete" class="btnsdt" value="Delete Color" />
	      <input type="submit" name="btnUpdateQty" class="btnsdt5" value="Update Qty/Order" />
	      <?php } ?>	</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <?php } ?>
</table>
</form>
</BODY>
</HTML>