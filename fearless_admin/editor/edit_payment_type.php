<?php 
  session_start();
	 include("../connection.php");
	 if($_SESSION["UserName"]=="")
	 {
	   print "You are not authorized To View this page.<br>";
	   print "<a href=\"index.php\">GO Back</a>";
	   exit ();
	  }
	  
	  
if(isset($_POST['Submit']))
{	
			$MID=$_POST["PaymentID"];
			$bigimg=$_POST["IconName"];
			$Date=MakeDate();
			$_POST['designdetail']=str_replace("’","&acute;",$_POST['designdetail']);
	        $_POST['designdetail']=str_replace("'","&acute;",$_POST['designdetail']);
			
			            $allowedfiletypes = array("jpeg","jpg","gif","png");
					     $uploadfolder = "../menuimage/" ;
					     $uploadfilename = $_FILES['photo']['name'];
					     $fileext = strtolower(substr($uploadfilename,strrpos($uploadfilename,".")+1));
						if (!empty($uploadfilename) and !in_array($fileext,$allowedfiletypes)) 
						{ 
						  print "<script>alert('Image File Not Support! Try Again....')</script>";	
						}
						else if(!empty($uploadfilename))
						{	
						 unlink($uploadfolder.$bigimg);
						$file1 = $uploadfolder.$MID.$_FILES['photo']['name'];
						$bigimg=$MID.$_FILES['photo']['name']; 
						move_uploaded_file($_FILES['photo']['tmp_name'], $file1);
							  $sql="UPDATE payment_type SET TypeName='".$_POST["title"]."',APILink='".$_POST["apilink"]."',
							  description='".$_POST["designdetail"]."',ImageName='".$bigimg."' WHERE PaymentID='".$MID."'";
								$update=mysqli_query($con, "$sql"); 
								if($update)
								 {
								  print "<script>alert('Payment Method Successfully Updated')</script>";
								 }
								else
								 if($update)
								 {
								  print "<script>alert('Try Again')</script>";
								 }
			            }
						else
						{
						       $sql="UPDATE payment_type SET TypeName='".$_POST["title"]."',APILink='".$_POST["apilink"]."',
							  description='".$_POST["designdetail"]."',ImageName='".$bigimg."' WHERE PaymentID='".$MID."'";
								$update=mysqli_query($con, "$sql"); 
								if($update)
								 {
								  print "<script>alert('Payment Method Successfully Updated')</script>";
								 }
								else
								 if($update)
								 {
								  print "<script>alert('Try Again')</script>";
								 }
						}
			            
			
}

 $row=mysqli_fetch_row(mysqli_query($con, "SELECT * FROM payment_type WHERE PaymentID='".$_REQUEST["PaymentID"]."'")); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
div.num5{
background:#CC3333;
color:#FFFFFF;
	border: none;
	border-radius:5px;
	height:25px;
	width:80px;
	line-height:25px;
	margin-left:250px;
	float:left;
}
</style>

<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script>


<script language="javascript" type="text/javascript">
	function mainmenu(){		
		if(document.menuname.title.value==""){
			alert("Fill Notice Title");
			document.menuname.title.focus();
			return false;		
		}
		if(document.menuname.noticedate.value==""){
			alert("Fill Notice Date");
			document.menuname.noticedate.focus();
			return false;		
		}
		return true;
	}
</script>
  <style type="text/css">
		.btnsdt
			{
			background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;"
			
			}
		</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
<form name="aaa" method="post" action="<?php print $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
<table width="703" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="29" align="left" valign="top"><strong>Payment Method Title</strong></td>
    <td width="532" align="left" valign="top"><span class="input">
      <input name="title" type="text" id="title" size="40" value="<?php print  $row[1]; ?>" />

    </span></td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><strong>Payment API Link </strong></td>
    <td align="left" valign="top" id="subcat"><span class="input">
      <textarea name="apilink" cols="30" id="apilink"><?php print  $row[2]; ?></textarea>
    </span> </td>
  </tr>
  
  <tr>
    <td width="171" height="19" align="left" valign="top"><strong>Description:</strong></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	<?php
	 $row[3]=str_replace("&acute;","'",$row[3]);
	?>
	<textarea id="content" name="designdetail"  rows="5" cols="5"><?php print  $row[3]; ?></textarea>
	<input type="hidden" name="PaymentID" value="<?php print $_REQUEST["PaymentID"]; ?>">
<script language="javascript1.2">
  generate_wysiwyg('content');
</script>	<input type="hidden" name="IconName" value="<?php print  $row[4]; ?>" /></td>
  </tr>
   
    <tr>
      <td height="19" align="left" valign="top" >&nbsp;</td>
      <td height="19" align="left" valign="top" >&nbsp;</td>
    </tr>
	<?php if($row[4]!="")
	{ ?>
    <tr>
      <td height="44" align="left" valign="top" ><strong>Icon</strong></td>
      <td height="44" align="left" valign="top" ><img src="../menuimage/<?php print  $row[4]; ?>" width="100" height="60"></td>
    </tr>
	<?php } ?>
    <tr>
      <td height="44" align="left" valign="top" ><strong>Icon Change </strong></td>
      <td height="44" align="left" valign="top" ><input type="file" name="photo" id="photo" />
      (100px *60px)</td>
    </tr>
    <tr>
      <td height="27" align="left" valign="top" >&nbsp;</td>
      <td height="27" align="left" valign="top" ><input type="submit" name="Submit" value="UPDATE" class="btnsdt" style="color:#FFFFFF;" /></td>
    </tr>
</table>
</form>
</body>
</html>