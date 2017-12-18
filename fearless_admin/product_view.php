<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");


    $rs=mysqli_query($con, "SELECT
    product_stock.ProductID
    , product_category_info.CategoryName
    , product_stock.Name
    , product_stock.Brand
    , product_stock.Model
    , product_stock.Features
    , product_stock.AdditionalFeatures
    , product_stock.ActiveStatus
    , product_stock.VisibleStatus
    , product_stock.InsertBy
    , product_stock.Comments
    , product_stock.Price
    , product_stock.Stock
    , product_stock.Image
FROM
   product_stock
    INNER JOIN product_category_info 
        ON (product_stock.CategoryID = product_category_info.CategoryID)
  WHERE product_stock.ProductID='".$_REQUEST["ProductID"]."'");
	$row=mysqli_fetch_row($rs);	

?>
<html>
<head>
<script type="text/javascript">
	function aaa()
	 {
	 // var arr=document.sss.email.value;
	 // var x=arr[0];
	  //alert(''+x);
	  //window.opener.document.menuname.reviewer.value=a;
	  //var has='#';
	  //var arr1=arr.count();
	 // for(var i=0;i<arr1;i++)
	 // {
		//var a='#'+arr1[i];
		//window.opener.document.menuname.reviewer.value=a;  
		//document.write(''+a);
	  //}
	 // document.sss.submit();	
	  //window.close(); 
	  var txtVal = document.sss.email.value;
window.opener.document.menuname.reviewer.value=txtVal;

//window.close();
	 }
</script>
</head>
<body>

<table width="428" border="0" align="center" cellpadding="1" cellspacing="2">
  <tr>
    <td height="27" colspan="3" align="center" valign="top"><strong style="font-size:20px;">Product Information </strong></td>
  </tr>


  <tr>
    <td width="142" height="31" align="left" valign="top"><strong> Category  </strong></td>
    <td width="155" align="left" valign="top">:&nbsp;<?php print $row[1]; ?></td>
    <td width="117" rowspan="3" align="center"><img src="productimage/<?php print $row[13];  ?>" height="100" width="100"></td>
  </tr>
  
  <tr>
    <td height="34" align="left" valign="top"><strong>Name </strong></td>
    <td align="left" valign="top">:&nbsp;<?php print $row[2]; ?></td>
  </tr>
  <tr>
    <td height="36" align="left" valign="top"><strong>Brand</strong></td>
    <td align="left" valign="top">:&nbsp;<?php print $row[3]; ?></td>
  </tr>
  <tr>
    <td height="48" align="left" valign="top"><strong>Model</strong></td>
    <td colspan="2" align="left" valign="top">:&nbsp;<?php print $row[4]; ?></td>
  </tr>
  <tr>
    <td height="35" align="left" valign="top"><strong>Price</strong></td>
    <td colspan="2" align="left" valign="top">:&nbsp;<?php print $row[11]; ?></td>
  </tr>
  <tr>
    <td height="35" align="left" valign="top"><strong>Stock</strong></td>
    <td colspan="2" align="left" valign="top">:&nbsp;<?php print $row[12]; ?></td>
  </tr>
  <tr>
    <td height="146" align="left" valign="top"><strong>Features</strong></td>
    <td colspan="2" align="left" valign="top">:&nbsp;<?php print $row[5]; ?></td>
  </tr>
  <tr>
    <td height="119" align="left" valign="top"><strong>Additional Features </strong></td>
    <td colspan="2" align="left" valign="top">:&nbsp;<?php print $row[6]; ?></td>
  </tr>
  <tr>
    <td height="35" align="left" valign="top"><strong>Insert By </strong></td>
    <td colspan="2" align="left" valign="top">:&nbsp;<?php print $row[9]; ?></td>
  </tr>
  <tr>
    <td height="35" align="left" valign="top"><strong>Active Status </strong></td>
    <td colspan="2" align="left" valign="top">:&nbsp;<?php print $row[7]; ?></td>
  </tr>
  <tr>
    <td height="35" align="left" valign="top"><strong>Visible Status </strong></td>
    <td colspan="2" align="left" valign="top">:&nbsp;<?php print $row[8]; ?></td>
  </tr>
  <tr>
    <td height="35" align="left" valign="top">&nbsp;</td>
    <td colspan="2" align="left" valign="top"><input name="button" type="button" id="button" value="Close" onClick="window.close();" /></td>
  </tr>
</table>

</body>
</html>