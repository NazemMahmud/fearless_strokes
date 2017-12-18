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
     $title="Unit & Size Settings for ".$title[0];
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
     $title="Unit & Size Settings for ".$title[0];
	}
	else if($_REQUEST["cattype"]=="cat")
	{
	 $title=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName FROM product_category_info WHERE CategoryID='".$_REQUEST["ID"]."'"));
     $title="Unit & Size Settings for ".$title[0];
	}
     
	
	  if($_REQUEST["type"]=="insert")
	  {
	   $check=mysqli_fetch_row(mysqli_query($con, "SELECT CatID,UnitID FROM product_cat_unit WHERE CatID='".$_REQUEST["ID"]."'")); 
	     if( $check[1]!="")
		  {
		  
		       $_REQUEST["UnitSelect"]=$check[1];
		  
		  }
	   
	   if(isset($_REQUEST["btnAddList"]))
	    {

		  if( $check[0]=="")
		  {
		  $rs=mysqli_query($con, "INSERT INTO product_cat_unit (CatID,UnitID) VALUES('".$_REQUEST["ID"]."','".$_REQUEST["UnitSelect"]."')");
		  //$_REQUEST["UnitSelect"]=$check[1];
		  
		  }
		  
		  $size_id_count=count($_POST["size"]);
		  $comboSelect=$_REQUEST["UnitSelect"];
			  for($i=0;$i<$size_id_count;$i++)
			  {
			   $size_insert=mysqli_query($con, "INSERT INTO product_cat_size (UnitID,SubUnitID) VALUES('".$comboSelect."','".$_POST["size"][$i]."')");
			  }
		  
		}
	   
	      if(isset($_REQUEST["unittype"]) && $_REQUEST["unittype"]=="UnitChange")
	       {
			  $rs=mysqli_query($con, "SELECT
						product_sub_unit.SubUnitID
						,product_sub_unit.SubUnitName
						,product_sub_unit.Description
					FROM
						product_unit
						INNER JOIN product_sub_unit 
							ON (product_unit.UnitID = product_sub_unit.UnitID)
					WHERE product_sub_unit.SubUnitID NOT IN(SELECT SubUnitID FROM product_cat_size WHERE UnitID='".$_REQUEST["UnitSelect"]."')
					AND  product_sub_unit.UnitID='".$_REQUEST["UnitSelect"]."'");
							   
			  $comboSelect=$_REQUEST["UnitSelect"];
		   }
			
			 else
			 { 
			 //print $sql="";
			  $rs=mysqli_query($con, "SELECT
						product_sub_unit.SubUnitID
						,product_sub_unit.SubUnitName
						,product_sub_unit.Description
					FROM
						product_unit
						INNER JOIN product_sub_unit 
							ON (product_unit.UnitID = product_sub_unit.UnitID)
					WHERE product_sub_unit.SubUnitID NOT IN(SELECT SubUnitID FROM product_cat_size WHERE UnitID='".$_REQUEST["UnitSelect"]."')
					AND  product_sub_unit.UnitID='".$_REQUEST["UnitSelect"]."'");
							   
			  $comboSelect=$_REQUEST["UnitSelect"];
			}
		  $check=mysqli_fetch_row(mysqli_query($con, "SELECT CatID,UnitID FROM product_cat_unit WHERE CatID='".$_REQUEST["ID"]."'"));
	   }
	   
	   
	  if($_REQUEST["type"]=="delete")
	  {
	   $check=mysqli_fetch_row(mysqli_query($con, "SELECT CatID,UnitID FROM product_cat_unit WHERE CatID='".$_REQUEST["ID"]."'")); 
       $temp=$_REQUEST["UnitSelect"];
	   $_REQUEST["UnitSelect"]=$check[1];
	   
	   
	   if(isset($_REQUEST["btnListUpdate"]))
	    {
		    $_REQUEST["UnitSelect"]=$temp;
           if($_REQUEST["UnitSelect"]!=$check[1] && $_REQUEST["UnitSelect"]!="")
		   {   
		       $delete_unit=mysqli_query($con, "DELETE FROM product_cat_unit WHERE CatID='".$_REQUEST["ID"]."'");
			   $delete_size=mysqli_query($con, "DELETE FROM product_cat_size WHERE UnitID='".$check[1]."'");
		       $rs=mysqli_query($con, "INSERT INTO product_cat_unit (CatID,UnitID) VALUES('".$_REQUEST["ID"]."','".$_REQUEST["UnitSelect"]."')");
		  
		    
		       $size_id_count=count($_POST["size"]);
		       $comboSelect=$_REQUEST["UnitSelect"];
			   
			   for($i=0;$i<$size_id_count;$i++)
			   {
			   $size_insert=mysqli_query($con, "INSERT INTO product_cat_size (UnitID,SubUnitID) VALUES('".$comboSelect."','".$_POST["size"][$i]."')");
			   }
		   }
		}
	   if(isset($_REQUEST["btnDelete"]))
	    {
           //$_REQUEST["UnitSelect"]=$check[1];   
		  $size_id_count=count($_POST["size"]);
		  $comboSelect=$_REQUEST["UnitSelect"];
			  for($i=0;$i<$size_id_count;$i++)
			  {
			   $delete=mysqli_query($con, "DELETE FROM product_cat_size WHERE UnitID='".$comboSelect."' AND SubUnitID='".$_POST["size"][$i]."'");
			  }
		  
		}
	    if(isset($_REQUEST["unittype"]) && $_REQUEST["unittype"]=="UnitChange")
	       {
	           
			  $_REQUEST["UnitSelect"]=$temp;
			  if($_REQUEST["UnitSelect"]!=$check[1])
			  {
			  
			  $rs=mysqli_query($con, "SELECT
						product_sub_unit.SubUnitID
						,product_sub_unit.SubUnitName
						,product_sub_unit.Description
					FROM
						product_unit
						INNER JOIN product_sub_unit 
							ON (product_unit.UnitID = product_sub_unit.UnitID)
					WHERE product_sub_unit.SubUnitID NOT IN(SELECT SubUnitID FROM product_cat_size WHERE UnitID='".$_REQUEST["UnitSelect"]."')
					AND  product_sub_unit.UnitID='".$_REQUEST["UnitSelect"]."'");
							   
			  $comboSelect=$_REQUEST["UnitSelect"];
			  }
			  else
			  {
						$_REQUEST["UnitSelect"]=$check[1];
					$rs=mysqli_query($con, "SELECT
					product_cat_size.SubUnitID
					, product_sub_unit.SubUnitName
					, product_sub_unit.Description
				FROM
					product_cat_size
					INNER JOIN product_sub_unit 
						ON (product_cat_size.SubUnitID = product_sub_unit.SubUnitID)
				WHERE product_cat_size.UnitID='".$_REQUEST["UnitSelect"]."'");
											   
							  $comboSelect=$_REQUEST["UnitSelect"];
			  }
		   }
			
			else
			{ 
			  
			  $rs=mysqli_query($con, "SELECT
    product_cat_size.SubUnitID
    , product_sub_unit.SubUnitName
    , product_sub_unit.Description
FROM
    product_cat_size
    INNER JOIN product_sub_unit 
        ON (product_cat_size.SubUnitID = product_sub_unit.SubUnitID)
WHERE product_cat_size.UnitID='".$_REQUEST["UnitSelect"]."'");
							   
			  $comboSelect=$_REQUEST["UnitSelect"];
			}
		 
	   }
	   
?>
<HTML>
<HEAD>

<script type="text/javascript">
function select_unit_func()
 {
  document.getElementById('unittype').value="UnitChange";
  document.unit_size_set.submit();
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
     </style>
</HEAD>
<BODY>
<form name="unit_size_set" method="post" action="<?php print $_SERVER['PHP_SELF']; ?>">
  <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="65" colspan="5" align="center"><span style="font-size:20px; font-weight:bold; color:#000000;"><?php print $title; ?> </span>
          <input type="hidden" name="ID" value="<?php print $_REQUEST["ID"]; ?>" />
          <input type="hidden" name="type" value="<?php print $_REQUEST["type"]; ?>"  />
          <input type="hidden" name="cattype" value="<?php print $_REQUEST["cattype"]; ?>"  />
          <input type="hidden" name="unittype" id="unittype" value="" />
      </td>
    </tr>
    <tr>
      <td height="32" colspan="3" align="right" valign="top"><strong>Select Unit </strong><strong></strong></td>
      <td width="293" height="32" align="left" valign="top"><strong>: </strong>
          <?php
	   if($_REQUEST["type"]=="insert" && $check[0]=="")
	   {
	  ?>
          <select name="UnitSelect" id="UnitSelect" onchange="select_unit_func();">
      <?php }
	  else if($_REQUEST["type"]=="insert" && $check[0]!="")
	  {
	   
      ?>
            <select  name="UnitSelect" id="UnitSelect" >
 
     <?php   } 
	  else if($_REQUEST["type"]=="delete")
	  {
	   
      ?>
            <select name="UnitSelect" id="UnitSelect" onchange="select_unit_func();" >
 
     <?php   } ?>
	 
            <option value="">Select Unit</option>
            <?php
		  $product_unit=mysqli_query($con, "SELECT UnitID,UnitName FROM product_unit WHERE ActiveStatus='Active'");
		  while($product_unitRow=mysqli_fetch_row($product_unit))
		  {
		   if($comboSelect==$product_unitRow[0])
		   {
		?>
            <option value="<?php print $product_unitRow[0]; ?>" selected="selected"><?php print $product_unitRow[1]; ?></option>
            <?php }
		else
		  { ?>
            <option value="<?php print $product_unitRow[0]; ?>"><?php print $product_unitRow[1]; ?></option>
            <?php }} ?>
          </select>
      </td>
    </tr>
    <tr>
      <td height="19" colspan="5" align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="86" height="28" align="center" bgcolor="#000000"><span class="style4">SL</span></td>
      <td colspan="2" align="left" bgcolor="#000000"><span class="style4">Size/Sub Unit Name </span></td>
      <td width="293" colspan="2" align="left" bgcolor="#000000"><span class="style4">Short Description </span></td>
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
          <input type="checkbox" name="size[]" value="<?php print $row[0]; ?>" /></td>
      <td colspan="2" align="left"><?php print $row[1]; ?></td>
      <td colspan="2" align="left"><?php print $row[2]; ?></td>
    </tr>
    <?php } ?>
    <tr>
      <td height="37" colspan="4" align="center"><?php
	   if($_REQUEST["type"]=="insert")
	   {
	  ?>
          <input type="submit" name="btnAddList" class="btnsdt41" value="Add Unit & Size" />
          <?php } ?>
          <?php
	   if($_REQUEST["type"]=="delete")
	   {
	    if(isset($_REQUEST["unittype"]) && $_REQUEST["unittype"]=="UnitChange")
		{
	  ?>
          <input type="submit" name="btnListUpdate" class="btnsdt" value="Edit Unit & Size" />
		<?php }
		else
		{
		 ?>
          <input type="submit" name="btnDelete" class="btnsdt" value="Delete Unit & Size" />
          <?php }} ?></td>
    </tr>
  </table>
</form>
</BODY>
</HTML>