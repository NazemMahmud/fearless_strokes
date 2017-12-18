<?php
  include("connection.php");
  if($_REQUEST["type"]=="ok")
   {
?>
<table width="793" border="0" cellspacing="1" cellpadding="3"  >
	<tr>
    <td height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="144" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">Country  Name </span></td>
	<td width="33" height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="158" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">Country  Name </span></td>
	<td width="51" height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="140" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">Country  Name </span></td>
	<td width="53" height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="107" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">Country  Name </span></td>
  </tr>
<tr bgcolor="#999999" >
   <?php
     $sl=0;
	 $tsl=0;
	 $total=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(country_id) FROM country_name WHERE country_id!=19  ORDER BY short_name"));
	 $rs=mysqli_query($con, "SELECT country_id,short_name FROM country_name WHERE country_id!=19  ORDER BY short_name");
	 while($row=mysqli_fetch_row($rs))
	 {
	  $sl++;
	  $tsl++;
	   if($sl==1)
	   {
   ?>
       <tr bgcolor="#999999" >
	   <?php } ?>
    <td width="32" height="22" align="center">
	<input type="checkbox" name="Country[]" id="checkbox" value="<?php print $row[0] ?>" />	 </td>
    <td><?php print $row[1] ?></td>

     <?php if($sl==4 || $tsl==$total[0])
	   {
	    $sl=0;
	  ?>
    </tr>
<?php }}?>
    </table>
	
	<?php } 
	if($_REQUEST["type"]=="set")
   {
?>
<table width="793" border="0" cellspacing="1" cellpadding="3"  >
	<tr>
    <td height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="144" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">Country  Name </span></td>
	<td width="33" height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="158" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">Country  Name </span></td>
	<td width="51" height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="140" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">Country  Name </span></td>
	<td width="53" height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="107" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">Country  Name </span></td>
  </tr>
<tr bgcolor="#999999" >
   <?php
     $sl=0;
	 $tsl=0;
	 $total=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(country_id) FROM country_name WHERE country_id!=19 ORDER BY short_name"));
	 $rs=mysqli_query($con, "SELECT country_id,short_name FROM country_name WHERE country_id!=19 ORDER BY short_name");
	 while($row=mysqli_fetch_row($rs))
	 {
	    $country=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(ShippingLocationID) FROM product_shipping_location 
		WHERE ProductID='".$_REQUEST["ProductID"]."' AND Dis_Bgd_Country_ID='".$row[0]."'"));
		
		$ShippingLocationID=mysqli_fetch_row(mysqli_query($con, "SELECT ShippingLocationID FROM product_shipping_location 
	 WHERE ProductID='".$_REQUEST["ProductID"]."' AND Dis_Bgd_Country_ID='".$row[0]."'  AND Loc_Type='World'"));
	  
	  $sl++;
	  $tsl++;
	   if($sl==1)
	   {
   ?>
       <tr bgcolor="#999999" >
	   <?php } ?>
    <td width="32" height="22" align="center">
	<?php
	  if($country[0]>0)
	  {
	?>
	<input type="checkbox" name="Country[]" id="checkbox" checked="checked" value="<?php print $row[0] ?>" />
	<?php }
	 else
	 {
	 ?>
	<input type="checkbox" name="Country[]" id="checkbox" value="<?php print $row[0] ?>" />
	<?php } ?>
		 </td>
    <td>
	<?php
	  if($ShippingLocationID!="")
	  {
	?>
	<a href="#" onclick="window.open('location_method.php?ShippingLocationID=<?php print $ShippingLocationID[0] ?>&type=insert','location_method','width=750px, height=700px, scrollbars=1, left=300px, top=100px');"><?php print $row[1]; ?></a>
	<?php }
	else
	{ print $row[1]; } ?>
	</td>

     <?php if($sl==4 || $tsl==$total[0])
	   {
	    $sl=0;
	  ?>
    </tr>
<?php }}?>
    </table>
	
	<?php } ?>