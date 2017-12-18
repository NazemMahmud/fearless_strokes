<?php
 session_start();
 include("connection.php");

 $recpos=isset($_REQUEST["recpos"])? $_REQUEST["recpos"]:"1";
					$count=($recpos-1)*20;
					$sl=$count;

	if(isset($_POST["regdata"]) && $_POST["regdata"]=="1")
	{
	   $a=$_POST["CID"];
	   $OB=$_POST["OB"];
	   $WB=$_POST["WB"];
	   
	  $counter=count($a);
	  $District="";
	  for($i=0;$i<$counter;$i++)
	   {
	     $District.="|".$a[$i];
	
	   }
	   /////////////////////
	   
	   $b=$_POST["Country"];
	   $b_count=count($b);
	  $Country="";
	  for($i=0;$i<$b_count;$i++)
	   {
	     $Country.="|".$b[$i];
	
	   }
	     //print $District;
	   if($counter>0)
	   {
	   print "<script type=\"text/javascript\">window.opener.document.getElementById('select_location').innerHTML='Location Selected';</script>";
	      print "<script type=\"text/javascript\">window.opener.document.product_form.WB.value='$WB';</script>";
	   print "<script type=\"text/javascript\">window.opener.document.product_form.OB.value='$OB'</script>";	
	   print "<script type=\"text/javascript\">window.opener.document.product_form.CountDistrict.value='$counter'</script>";	
	   print "<script type=\"text/javascript\">window.opener.document.product_form.DistrictID.value='$District'</script>";	
	   
	   print "<script type=\"text/javascript\">window.opener.document.product_form.CountCountry.value='$b_count'</script>";	
	   print "<script type=\"text/javascript\">window.opener.document.product_form.CountryList.value='$Country'</script>";
	   print "<script type=\"text/javascript\">window.close();</script>"; 
	   
       }
		else 
		{
	     print "<script>alert('Please Select Location')</script>";		
		}
	  
	}
	


   
?>
<html>
<head>
<script src="jquery-1.4.4.min.js"></script>
<script type="text/javascript">
  function check_bgd()
   {
      
	  var chk_arr =  document.getElementsByName("CID[]");
		var chklength = chk_arr.length;     
		// document.getElementByID        
		if(document.getElementById("WB").checked==true)
		{ 
		for(k=0;k< chklength;k++)
		{
			chk_arr[k].checked = true;
		} 
		}
		else if(document.getElementById("WB").checked==false)
		{ 
		for(k=0;k< chklength;k++)
		{
			chk_arr[k].checked = false;
		} 
		}


   }
   function check_world()
   {
       if(document.getElementById("OB").checked==true)
		{ 
		  // alert('aaaaaaaaaa');
		  //document.getElementById("countrytable").style.display=="inline;";
		  $('#countrytable').load('country_location_ex.php?type=ok');
		}
	   else if(document.getElementById("OB").checked==false)
		{ 
		    $('#countrytable').load('country_location_ex.php?type=no');
		  //document.getElementById("countrytable").style.display=="none;";
		}
   }
   
</script>
<style type="text/css">
		.btnsdt
			{
			background-color:<?php echo $button_background; ?>;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
			color:#FFFFFF;
			}
		.btnsdt1 {background-color:<?php echo $button_background; ?>;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
			color:#FFFFFF;
}
.style3 {
	font-weight: bold;
	color: #FFFFFF;
}
.btnsdt11 {background-color<?php echo $button_background; ?>;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
			color:#FFFFFF;
}
.btnsdt12 {background-color:<?php echo $button_background; ?>;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
			color:#FFFFFF;
}
.btnsdt121 {background-color:<?php echo $button_background; ?>;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
			color:#FFFFFF;
}
</style>
</head>
<body>
<form name="locationselect" method="post" action="<?php print $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<table width="775" height="auto" border="0" align="center" cellpadding="3" cellspacing="1" style="border: 2px solid <?php echo $button_background; ?>; ">
  <tr >
    <td height="33" colspan="8" align="center" >
	   <span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:18px;"><strong>Select Product Shipping Location  </strong></span>
       <input type="hidden" name="type" value="<?php print $_REQUEST["type"]; ?>" />
      <input type="hidden" name="MID" value="<?php print $_REQUEST["MID"]; ?>" />
	  <input type="hidden" name="regdata" id="regdata" value="1" /></td>
  </tr>

  <tr>
    <td height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="144" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">District  Name </span></td>
	<td width="33" height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="158" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">District  Name </span></td>
	<td width="51" height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="140" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">District  Name </span></td>
	<td width="53" height="30" align="center" valign="top" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="107" height="30" align="left" valign="top" bgcolor="#000000" ><span class="style3">District  Name </span></td>
  </tr>
<tr bgcolor="#999999" >
   <?php
     $sl=0;
	 $tsl=0;
	 $total=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(DistrictID) FROM district_info WHERE ActiveStatus='Active'"));
	 $rs=mysqli_query($con, "SELECT DistrictID,DistrictName FROM district_info WHERE ActiveStatus='Active' ORDER BY DistrictName");
	 while($row=mysqli_fetch_row($rs))
	 {
	  $sl++;
	  $tsl++;
	   if($sl==1)
	   {
   ?>
    <tr bgcolor="#999999" >
      <?php } ?>
    <td width="28" height="22" align="center">
	<input type="checkbox" name="CID[]" id="checkbox" value="<?php print $row[0] ?>" />	 </td>
    <td><?php print $row[1] ?></td>

     <?php if($sl==4 || $tsl==$total[0])
	   {
	    $sl=0;
	  ?>
    </tr>
<?php }}?>
  <tr>
    <td height="28" align="center" bgcolor="#999999"><input type="checkbox" name="WB" id="WB" value="BGD" onClick="check_bgd();" /></td>
    <td bgcolor="#999999">Whole Bangladesh </td>
    <td align="center" bgcolor="#999999"><input type="checkbox" name="OB" id="OB" value="WORLD" onClick="check_world();"/></td>
    <td bgcolor="#999999">Outside of Bangladesh </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 <tr >
 <td colspan="8"></td>
 
 </tr>
  

  <tr style="" id="">
    
	<td colspan="8" align="center" id="countrytable" >
	
	
	
	</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr >
    <td>&nbsp;</td>
    <td ><?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-02","add_option");
			 if($check_access=="yes")
			  {
			 ?>
      <input type="submit"  name="btnInsert" id="button" class="btnsdt121" value="Insert" />
      <?php }   ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
