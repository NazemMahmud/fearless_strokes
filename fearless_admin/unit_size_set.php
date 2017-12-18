<?php
  session_start();
  include("connection.php");
  
  
    $pdt_row=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryID,cattype,Name FROM product_info WHERE ProductID='".$_REQUEST["ProductID"]."'"));
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
     $title="Unit & Size Settings for ".$title[0]." > ".$pdt_row[2];
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
     $title="Unit & Size Settings for ".$title[0]." > ".$pdt_row[2];
	}
	else if($pdt_row[1]=="cat")
	{
	 $title=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName FROM product_category_info WHERE CategoryID='".$pdt_row[0]."'"));
     $title="Unit & Size Settings for ".$title[0]." > ".$pdt_row[2];
	}
     
	
	  if($_REQUEST["type"]=="insert")
	  {
	   $check=mysqli_fetch_row(mysqli_query($con, "SELECT ProductID,UnitID FROM product_cat_size WHERE ProductID='".$_REQUEST["ProductID"]."'"));  
	   if( $check[1]!="")
		  {
		  
		       $_REQUEST["UnitSelect"]=$check[1];
		  
		  }
	   if(isset($_REQUEST["btnAddList"]))
	    {

		  
		  $size_id_count=count($_POST["size"]);
		  $comboSelect=$_REQUEST["UnitSelect"];
			  for($i=0;$i<$size_id_count;$i++)
			  {
			   $size_insert=mysqli_query($con, "INSERT INTO product_cat_size (UnitID,SubUnitID,ProductID)
			    VALUES('".$comboSelect."','".$_POST["size"][$i]."','".$_REQUEST["ProductID"]."')");
			  }
		  
		}
	   
	      if(isset($_REQUEST["unittype"]) && $_REQUEST["unittype"]=="UnitChange")
	       {
			  
                $sql="SELECT product_sub_unit.SubUnitID , product_sub_unit.SubUnitName , product_sub_unit.Description 
				FROM product_sub_unit 
				WHERE  product_sub_unit.UnitID='".$_REQUEST["UnitSelect"]."' AND
				 product_sub_unit.SubUnitID NOT IN(SELECT SubUnitID FROM product_cat_size WHERE ProductID='".$_REQUEST["ProductID"]."') ";
			  $rs=mysqli_query($con, "$sql");
							   
			  $comboSelect=$_REQUEST["UnitSelect"];
		   }
			
			 else
			 { 
			 //print $sql="";
			  $rs=mysqli_query($con, "SELECT product_sub_unit.SubUnitID , product_sub_unit.SubUnitName , product_sub_unit.Description 
				FROM product_sub_unit 
				WHERE  product_sub_unit.UnitID='".$_REQUEST["UnitSelect"]."' AND
				 product_sub_unit.SubUnitID NOT IN(SELECT SubUnitID FROM product_cat_size WHERE ProductID='".$_REQUEST["ProductID"]."') ");
							   
			  $comboSelect=$_REQUEST["UnitSelect"];
			}
		  $check=mysqli_fetch_row(mysqli_query($con, "SELECT ProductID,SubUnitID FROM product_cat_size WHERE ProductID='".$_REQUEST["ProductID"]."'"));
	   }
	   
	   
	  if($_REQUEST["type"]=="delete")
	  {
	   $check=mysqli_fetch_row(mysqli_query($con, "SELECT ProductID,UnitID FROM product_cat_size WHERE ProductID='".$_REQUEST["ProductID"]."'")); 
       @$temp=$_REQUEST["UnitSelect"];
	   $_REQUEST["UnitSelect"]=$check[1];
	   
	   
	   if(isset($_REQUEST["btnListUpdate"]))
	    {
		    $_REQUEST["UnitSelect"]=$temp;
           if($_REQUEST["UnitSelect"]!=$check[1] && $_REQUEST["UnitSelect"]!="")
		   {   
		       //$delete_unit=mysqli_query($con, "DELETE FROM product_cat_unit WHERE CatID='".$_REQUEST["ID"]."'");
			   $delete_size=mysqli_query($con, "DELETE FROM product_cat_size WHERE ProductID='".$_REQUEST["ProductID"]."'");
		      // $rs=mysqli_query($con, "INSERT INTO product_cat_unit (CatID,UnitID) VALUES('".$_REQUEST["ID"]."','".$_REQUEST["UnitSelect"]."')");
		  
		    
		       $size_id_count=count($_POST["size"]);
		       $comboSelect=$_REQUEST["UnitSelect"];
			   
			   for($i=0;$i<$size_id_count;$i++)
			   {
			   $size_insert=mysqli_query($con, "INSERT INTO product_cat_size (UnitID,SubUnitID,ProductID)
			    VALUES('".$comboSelect."','".$_POST["size"][$i]."','".$_REQUEST["ProductID"]."')");
			   }
			   $check[1]=$comboSelect;
		   }
		}
	   if(isset($_REQUEST["btnDelete"]))
	    {
           //$_REQUEST["UnitSelect"]=$check[1];   
		  $size_id_count=count($_POST["size"]);
		  $comboSelect=$_REQUEST["UnitSelect"];
			  for($i=0;$i<$size_id_count;$i++)
			  {
			   $delete=mysqli_query($con, "DELETE FROM product_cat_size WHERE UnitID='".$comboSelect."'
			    AND SubUnitID='".$_POST["size"][$i]."' AND ProductID='".$_REQUEST["ProductID"]."'");
			  }
		  
		}
		if(isset($_REQUEST["btnUpdateQty"]))
	    {
           //$_REQUEST["UnitSelect"]=$check[1];   
		  $size_id_count=count($_POST["qid"]);
		  $comboSelect=$_REQUEST["UnitSelect"];
			  for($i=0;$i<$size_id_count;$i++)
			  {
			   //$delete=mysqli_query($con, "DELETE FROM product_cat_size ");
				
				$update=mysqli_query($con, "UPDATE product_cat_size SET Qty='".$_POST["qty"][$i]."' WHERE UnitID='".$comboSelect."'
			    AND SubUnitID='".$_POST["qid"][$i]."' AND ProductID='".$_REQUEST["ProductID"]."'");
			  }
		  print "<script>alert('Successfully Updated Qty')</script>";
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
					WHERE product_sub_unit.UnitID='".$_REQUEST["UnitSelect"]."'");
							   
			  $comboSelect=$_REQUEST["UnitSelect"];
			  }
			  else
			  {
						$_REQUEST["UnitSelect"]=$check[1];
					$rs=mysqli_query($con, "SELECT
					product_cat_size.SubUnitID
					, product_sub_unit.SubUnitName
					, product_sub_unit.Description
					, product_cat_size.Qty
				FROM
					product_cat_size
					INNER JOIN product_sub_unit 
						ON (product_cat_size.SubUnitID = product_sub_unit.SubUnitID)
				WHERE product_cat_size.UnitID='".$_REQUEST["UnitSelect"]."' AND ProductID='".$_REQUEST["ProductID"]."'");
											   
							  $comboSelect=$_REQUEST["UnitSelect"];
			  }
		   }
			
			else
			{ 
			  
			  $rs=mysqli_query($con, "SELECT
    product_cat_size.SubUnitID
    , product_sub_unit.SubUnitName
    , product_sub_unit.Description
	, product_cat_size.Qty
FROM
    product_cat_size
    INNER JOIN product_sub_unit 
        ON (product_cat_size.SubUnitID = product_sub_unit.SubUnitID)
WHERE product_cat_size.UnitID='".$_REQUEST["UnitSelect"]."'  AND ProductID='".$_REQUEST["ProductID"]."'");
							   
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
			background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
			
			}
		.btnsdt1 {			background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
}
     .btnsdt11 {background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
}
     .btnsdt2 {			background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
}
     .style5 {color: #FFFFFF}
     .btnsdt3 {			background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
}
     .btnsdt4 {			background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
}
     .btnsdt41 {background-color:<?php echo $button_background; ?>;
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
      <td height="65" colspan="6" align="center"><span style="font-size:20px; font-weight:bold; color:#000000;"><?php print $title; ?> </span>
          <input type="hidden" name="ProductID" value="<?php print $_REQUEST["ProductID"]; ?>" />
          <input type="hidden" name="type" value="<?php print $_REQUEST["type"]; ?>"  />
          <input type="hidden" name="cattype" value="<?php print $_REQUEST["cattype"]; ?>"  />
          <input type="hidden" name="unittype" id="unittype" value="" />      </td>
    </tr>
    <tr>
      <td height="32" colspan="3" align="right" valign="top"><strong>Select Unit Type </strong><strong></strong></td>
      <td width="191" height="32" align="left" valign="top"><strong>: </strong>
          <?php
	   if($_REQUEST["type"]=="insert" && $check[0]=="")
	   {
	  ?>
          <select name="UnitSelect" id="UnitSelect" onChange="select_unit_func();">
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
		  $product_unit=mysqli_query($con, "SELECT UnitID,UnitName FROM product_unit WHERE ActiveStatus='Active' AND UnitName!='General'");
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
      </select>      </td>
    </tr>
    <tr>
      <td height="19" colspan="6" align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="44" height="28" align="center" bgcolor="#000000"><span class="style4">SL</span></td>
      <td colspan="2" align="left" bgcolor="#000000"><span class="style4"> Unit Name </span></td>
      <td width="191" align="left" bgcolor="#000000"><span class="style4">Short Description </span></td>
      <td width="71" align="left" bgcolor="#000000">
	  <span class="style4"><?php
	   if($_REQUEST["type"]=="delete" && $_REQUEST["UnitSelect"]==$check[1])
	   print "Qty";
	   	  ?></span>
</td>
      <td width="71" align="left" bgcolor="#000000"><span class="style4">Action</span></td>
    </tr>
    <?php
   $sl=0;
      while(@$row=mysqli_fetch_row($rs))
	  {
	    $sub_id=mysqli_fetch_row(mysqli_query($con, "SELECT sub_id FROM product_cat_size 
		WHERE SubUnitID='".$row[0]."' AND ProductID='".$_REQUEST["ProductID"]."'"));
	  
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
      <td align="left"><?php print $row[2]; ?></td>
      <td align="left">
	  <?php
	   if($_REQUEST["type"]=="delete" && $_REQUEST["UnitSelect"]==$check[1])
	   {
	  ?>
	     <input name="qty[]" type="text" value="<?php print $row[3]; ?>" size="3" />
	  
	     <input type="hidden" name="qid[]" id="unittype2" value="<?php print $row[0]; ?>" />
        <?php } ?>
	  </td>
      <td align="left"><?php
	   if($_REQUEST["type"]=="delete" && $_REQUEST["UnitSelect"]==$check[1])
	   {
	  ?>
        <a href="#" style="text-decoration:none;" onClick="window.open('unit_volume_set.php?ProductID=<?php print $_REQUEST["ProductID"] ?>&sub_id=<?php print $sub_id[0]; ?>','unit_volume_set','width=400px, height=400px, scrollbars=1, left=200px, top=100px,');"> <img src="actionimage/size.jpeg" style="width:18px; height:18px;" title="Size Settings"> </a> &nbsp; <a href="#" style="text-decoration:none;" onClick="window.open('color_image_setting.php?ProductID=<?php print $_REQUEST["ProductID"] ?>&id=<?php print $sub_id[0]; ?>&type=size','color_image_setting','width=600px, height=400px, scrollbars=1, left=300px, top=100px,');">
        <!--<img src="actionimage/image.jpeg" style="width:18px; height:18px;" title="Image Settings">-->
        </a>
        <?php } ?></td>
    </tr>
    <?php } ?>
    <tr>
      <td height="37" colspan="6" align="center"><?php
	   if($_REQUEST["type"]=="insert")
	   {       
	  ?>       <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","add_option");
			 if($check_access=="yes")
			  {
			 ?>
          <input type="submit" name="btnAddList" class="btnsdt41" value="Add Unit & Size" />
          <?php } }?>
          <?php
	   if($_REQUEST["type"]=="delete")
	   {
	    if(isset($_REQUEST["unittype"]) && $_REQUEST["unittype"]=="UnitChange")
		{
	  ?>    <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
          <input type="submit" name="btnListUpdate" class="btnsdt" value="Edit Unit & Size" />
		<?php }}
		else
		{
		 ?>
		    <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","delete_option");
			 if($check_access=="yes")
			  {
			 ?>
          <input type="submit" name="btnDelete" class="btnsdt" value="Delete Unit & Size" />
		  <input type="submit" name="btnUpdateQty" class="btnsdt" value="Update Qty" />
          <?php }}} ?></td>
    </tr>
  </table>
</form>
</BODY>
</HTML>