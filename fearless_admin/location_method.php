<?php
  	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
     $Date=MakeDate();
      $ShippingLocationID=$_REQUEST["ShippingLocationID"];
 if(isset($_POST["btnAdd"]))
 {
     
	    $LOc_MethodID=mysqli_fetch_row(mysqli_query($con, "SELECT IFNULL(MAX(ID),0) FROM location_method"));
		$LOc_MethodID[0]+=1;
		
		
		    $insert=mysqli_query($con, "INSERT INTO location_method(ID,ShippingLocationID,MethodID,BaseQty,BaseCost,IncrementQty,IncrementCost)
                   VALUES('".$LOc_MethodID[0]."','".$ShippingLocationID."','".$_POST["Method"]."','".$_POST["BaseQty"]."','".$_POST["BaseCost"]."',
				   '".$_POST["IncrementQty"]."','".$_POST["IncrementCost"]."')");
			if($insert)
			{
              print "<script>alert('Successfully Inserted')</script>";
			}
			else
			{
			  print "<script>alert('Insertion Failed! Try Again...')</script>";
			}
					  
            
 }
 if(isset($_POST["btnDelete"]))
 {
    $id=$_POST["id"];
	 $idCOunt=count($id);
	 for($i=0;$i<$idCOunt;$i++)
	 {
		$del=mysqli_query($con, "DELETE FROM location_method WHERE ID='".$id[$i]."'");
	 }

 }
 if(isset($_POST["btnSave"]))
 {
    $ID=$_POST["sid"];
	 $counter=count($ID);
						 
		for($i=0;$i<$counter;$i++)
		{
		  
		  $update=mysqli_query($con, "UPDATE location_method SET MethodID='".$_POST["m"][$i]."',BaseQty='".$_POST["bqty"][$i]."',
		  BaseCost='".$_POST["bcost"][$i]."',IncrementQty='".$_POST["iqty"][$i]."',IncrementCost='".$_POST["icost"][$i]."' WHERE ID='".$ID[$i]."'");
		}

 }
  $PdtID=mysqli_fetch_row(mysqli_query($con, "SELECT
    ProductID
FROM
    product_shipping_location 
       
WHERE ShippingLocationID='".$ShippingLocationID."'"));
$ProductID=$PdtID[0];
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
                                        WHERE product_info.ProductID='".$ProductID."'"));
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
     </style>
</HEAD>
<BODY>
<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="color_set">
<table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="38" colspan="6" align="center">
	<span style="font-size:20px; font-weight:bold; color:#000000;">Location Wise Shipping Setting</span>
	<input type="hidden" name="ShippingLocationID" value="<?php print $_REQUEST["ShippingLocationID"]; ?>"  />  	  </td>
  </tr>

  <tr>
    <td width="44" height="19" align="center" valign="top">&nbsp;</td>
    <td valign="top"><strong>Product Name </strong></td>
    <td colspan="2" valign="top"><strong>: <?php print $product_info[3]; ?></strong></td>
    <td align="right" valign="top"><strong>Insert Date </strong></td>
    <td valign="top"><strong>:<?php print substr($product_info[6],0,10); ?></strong></td>
  </tr>
  <tr>
    <td height="19" align="center" valign="top">&nbsp;</td>
    <td valign="top"><strong>Category</strong></td>
    <td colspan="2" valign="top"><strong>: <?php print $cat_name[0]; ?></strong></td>
    <td align="right" valign="top"><strong>SKU No </strong></td>
    <td valign="top"><strong>: <?php print $product_info[7]; ?></strong></td>
  </tr>
  <tr>
    <td height="19" align="center" valign="top">&nbsp;</td>
    <td valign="top"><strong>Supplier</strong></td>
    <td colspan="2" valign="top"><strong>: <?php print $product_info[5]; ?></strong></td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="19" align="center" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td colspan="4" valign="top">&nbsp;</td>
  </tr>

  <tr>
    <td height="24" align="center">&nbsp;</td>
    <td align="left"><strong>Method</strong></td>
    <td colspan="4" align="left"><strong>:
      <select name="Method" id="Method">
	   <option value="">Select Method</option>
	   <?php
	     $method=mysqli_query($con, "SELECT MethodID,title FROM shipping_method WHERE ActiveStatus='Active' ORDER BY orderid");
		 while($method_row=mysqli_fetch_row($method))
		 {
	   ?>
	     <option value="<?php print $method_row[0]; ?>"><?php print $method_row[1]; ?></option>
		 <?php } ?>
      </select>
    </strong></td>
  </tr>
  <tr>
    <td height="24" align="center">&nbsp;</td>
    <td align="left"><strong>Base Qty </strong></td>
    <td colspan="4" align="left"><strong>:
      <input name="BaseQty" type="text" id="BaseQty" />
    </strong></td>
  </tr>
  <tr>
    <td height="23" align="center">&nbsp;</td>
    <td align="left"><strong>Base Cost </strong></td>
    <td colspan="4" align="left"><strong>:
      <input name="BaseCost" type="text" id="BaseCost" />
    </strong></td>
  </tr>
  <tr>
    <td height="29" align="center">&nbsp;</td>
    <td align="left"><strong>Increment Qty</strong></td>
    <td colspan="4" align="left"><strong>:
      <input name="IncrementQty" type="text" id="IncrementQty" />
    </strong></td>
  </tr>
  <tr>
    <td height="22" align="center">&nbsp;</td>
    <td align="left"><strong>Increment Cost(%) </strong></td>
    <td colspan="4" align="left"><strong>:
      <input name="IncrementCost" type="text" id="IncrementCost" />
    </strong></td>
    </tr>
  <tr>
    <td height="58" align="center">&nbsp;</td>
    <td colspan="5" align="left">
	
	    <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","add_option");
			 if($check_access=="yes")
			  {
			 ?>
	<input type="submit" name="btnAdd" class="btnsdt" value="Add Method" />	
	<?php  }?>	</td>
    </tr>

  <tr>
    <td height="28" align="center" bgcolor="#000000"><span class="style4">SL</span></td>
    <td width="153" align="left" bgcolor="#000000"><span class="style4">Method</span></td>
    <td width="105" align="left" bgcolor="#000000"><span class="style4">Base Qty </span></td>
    <td width="129" align="left" bgcolor="#000000"><span class="style4">Base Cost </span></td>
    <td width="148" align="left" bgcolor="#000000"><span class="style4">Increment Qty</span></td>
    <td width="141" align="left" bgcolor="#000000"><span class="style4">Increment Cost %  </span></td>
  </tr>
  <?php
   $sl=0;
   $rs=mysqli_query($con, "SELECT ID,MethodID,BaseQty,BaseCost,IncrementQty,IncrementCost FROM location_method 
   WHERE ShippingLocationID='".$ShippingLocationID."'");
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

      <input type="checkbox" name="id[]" value="<?php print $row[0]; ?>" />	  </td>
    <td align="left">
      <select name="m[]" >
        
        <?php
	     $method=mysqli_query($con, "SELECT MethodID,title FROM shipping_method WHERE ActiveStatus='Active' ORDER BY orderid");
		 while($method_row=mysqli_fetch_row($method))
		 { if($row[1]==$method_row[0])
		    {
	   ?>
        <option value="<?php print $method_row[0]; ?>" selected="selected"><?php print $method_row[1]; ?></option>
        <?php } 
		    else
			{
		?>
		<option value="<?php print $method_row[0]; ?>"><?php print $method_row[1]; ?></option>
		<?php }} ?>
      </select>
      <input type="hidden" name="sid[]" value="<?php  print $row[0]; ?>"  />   </td>
    <td align="left"><input name="bqty[]" type="text" size="3" value="<?php print $row[2] ?>" /></td>
    <td align="left"><input name="bcost[]" type="text" size="10" value="<?php print $row[3] ?>" /></td>
    <td align="left"><input name="iqty[]" type="text" size="3" value="<?php print $row[4] ?>" /></td>
    <td align="left"><input name="icost[]" type="text" size="10" value="<?php print $row[5] ?>" /></td>
  </tr>
 <?php } ?>

  <tr>
    <td height="37">&nbsp;</td>
    <td align="center">
	 <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","delete_option");
			 if($check_access=="yes")
			  {
			 ?>
	<input type="submit" name="btnDelete" class="btnsdt" value="Delete" />
	  <?php } ?>	</td>
    <td colspan="4" align="left">
	 <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
	<input type="submit" name="btnSave" class="btnsdt" value="Update" />
	  <?php } ?>	</td>
    </tr>
</table>
</form>
</BODY>
</HTML>