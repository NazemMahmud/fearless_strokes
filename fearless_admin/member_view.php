<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");


    $rs=mysqli_query($con, "SELECT CONCAT(MemberFirstName,' ',MemberLastName),MemberAddress,MemberContact,MemberEmail,JoinDate,ActiveStatus,LastLoginTime ,PromotionalCode FROM member_info WHERE MemberID='".$_REQUEST["MemberID"]."'");
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

<table width="516" border="0" align="center" cellpadding="1" cellspacing="2">
  <tr>
    <td height="27" colspan="3" align="center" valign="top"><strong style="font-size:20px;">Member Information </strong></td>
  </tr>


  <tr>
    <td width="154" height="31" align="left" valign="top"><strong>Name </strong></td>
    <td width="343" align="left" valign="top"><strong>:&nbsp;<?php print $row[0]; ?></strong></td>
    <td width="5" align="center">&nbsp;</td>
  </tr>
  
  
  <tr>
    <td height="36" align="left" valign="top"><strong>Address</strong></td>
    <td align="left" valign="top"><strong>:&nbsp;<?php print $row[1]; ?></strong></td>
    <td width="5" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="48" align="left" valign="top"><strong>Phone Number</strong></td>
    <td colspan="2" align="left" valign="top"><strong>:&nbsp;<?php print $row[2]; ?></strong></td>
  </tr>
  <tr>
    <td height="35" align="left" valign="top"><strong>Email</strong></td>
    <td colspan="2" align="left" valign="top"><strong>:&nbsp;<?php print $row[3]; ?></strong></td>
  </tr>
  <tr>
    <td height="35" align="left" valign="top"><strong>Join Date</strong></td>
    <td colspan="2" align="left" valign="top"><strong>:&nbsp;<?php print $row[4]; ?></strong></td>
  </tr>
  <tr>
    <td height="35" align="left" valign="top"><strong>Active Status</strong></td>
    <td colspan="2" align="left" valign="top"><strong>:&nbsp;<?php print $row[5]; ?></strong></td>
  </tr>
  <tr>
    <td height="35" align="left" valign="top"><strong>Last Login</strong></td>
    <td colspan="2" align="left" valign="top"><strong>:&nbsp;<?php print $row[6]; ?></strong></td>
  </tr>
  <tr>
    <td height="35" align="left" valign="top"><strong>Promotional Code</strong></td>
    <td colspan="2" align="left" valign="top"><strong>:&nbsp;<?php print $row[7]; ?></strong></td>
  </tr>
  
  <tr>
    <td height="35" align="left" valign="top">&nbsp;</td>
    <td colspan="2" align="left" valign="top"><input name="button" type="button" id="button" value="Close" onClick="window.close();" /></td>
  </tr>
</table>

</body>
</html>