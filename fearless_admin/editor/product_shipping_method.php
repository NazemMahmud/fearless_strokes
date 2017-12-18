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
			$MID=MakeID($con, "shipping_method","MethodID","SMD-",6);
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
						$file1 = $uploadfolder.$MID.$_FILES['photo']['name'];
						$bigimg=$MID.$_FILES['photo']['name']; 
						move_uploaded_file($_FILES['photo']['tmp_name'], $file1);
						      $sql="INSERT INTO shipping_method (MethodID,title,description,image_name,ActiveStatus)
							   VALUES('".$MID."','".$_POST["title"]."','".$_POST["designdetail"]."','".$bigimg."','Active')";
								$insert=mysqli_query($con, "$sql"); 
								if($insert)
								 {
								  print "<script>alert('Shipping Method Successfully Inserted')</script>";
								 }
								else
								 if($insert)
								 {
								  print "<script>alert('Try Again')</script>";
								 }
			            }
						else
						{
						        $sql="INSERT INTO shipping_method (MethodID,title,description,image_name,ActiveStatus)
							   VALUES('".$MID."','".$_POST["title"]."','".$_POST["designdetail"]."','','Active')";
								$insert=mysqli_query($con, "$sql"); 
								if($insert)
								 {
								  print "<script>alert('Shipping Method Successfully Inserted')</script>";
								 }
								else
								 if($insert)
								 {
								  print "<script>alert('Try Again')</script>";
								 }
						}
			            
			
}

  
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
    <td height="29" align="left" valign="top"><strong>Shipping Method Title </strong></td>
    <td width="532" align="left" valign="top"><span class="input">
      <strong>:      </strong>
      <input name="title" type="text" id="title" size="40" />

    </span></td>
  </tr>
  
  <tr>
    <td width="171" height="19" align="left" valign="top"><strong>Description:</strong></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">
	<textarea id="content" name="designdetail"  rows="5" cols="5"></textarea>
	<input type="hidden" name="ID" value="">
<script language="javascript1.2">
  generate_wysiwyg('content');
</script>	</td>
  </tr>
   
    <tr>
      <td height="19" align="left" valign="top" >&nbsp;</td>
      <td height="19" align="left" valign="top" >&nbsp;</td>
    </tr>
    <tr>
      <td height="44" align="left" valign="top" ><strong>Icon if any </strong></td>
      <td height="44" align="left" valign="top" ><strong>:</strong>
        <input type="file" name="photo" id="photo" />
      (100px *60px)</td>
    </tr>
    <tr>
      <td height="27" align="left" valign="top" >&nbsp;</td>
      <td height="27" align="left" valign="top" >
	   <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","add_option");
			 if($check_access=="yes")
			  {
			 ?>
	  <input type="submit" name="Submit" value="INSERT" class="btnsdt" style="color:#FFFFFF;" />
	    <?php } ?>	  </td>
    </tr>
</table>
</form>
</body>
</html>