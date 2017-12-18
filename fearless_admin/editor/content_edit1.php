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
   
	 
			$CID=$_POST["CID"];
			$Date=MakeDate();
			 //$allowedfiletypes = array("jpeg","jpg","gif","png");
		     $uploadfolder = "../contentimage/" ;
		     $uploadfilename = $_FILES['photo']['name'];
	      if(!empty($uploadfilename))
		    {			
			$file1 = $uploadfolder.$CID.".jpg";
			@move_uploaded_file($_FILES['photo']['tmp_name'], $file1);
			}
			
			$_POST['designdetail']=str_replace("’","&acute;",$_POST['designdetail']);
	        $_POST['designdetail']=str_replace("'","&acute;",$_POST['designdetail']);

			$sql="UPDATE content_info SET MenuType='".$_POST["menutype"]."',Title='".$_POST["title"]."',SubTitle='".$_POST["subtitle"]."',
			Description='".$_POST["designdetail"]."' WHERE ContentID='".$CID."'";
			$update=mysqli_query($con, "$sql"); 
			if($update)
			 {
			  print "<script>alert('Content Successfully Updated')</script>";
			 }
			else
			 if($insert)
			 {
			  print "<script>alert('Try Again')</script>";
			 }
				//header("Location:edit_aboutus.php?msg=Successfully Edited...");
 }
			//die();              
                
        
		
        
////////////////////////////////		

		/////////////////////////////////////////////////////////////
	


$rs=mysqli_query($con, "SELECT ContentID,MenuType,Title,SubTitle,Description FROM content_info WHERE ContentID='".$_REQUEST["CID"]."'");
@$row=mysqli_fetch_row($rs);  
if($row[1]=="")
 {
    $menutype=mysqli_query($con, "SELECT title FROM mainmenu WHERE articlelink='content_edit.php?ContentID=".$_REQUEST["CID"]."'");
	$menutyperow=mysqli_fetch_row($menutype);
	if($menutyperow[0]=="")
	{
	  $sql="SELECT title FROM submenu WHERE articlelink='content_edit.php?ContentID=".$_REQUEST["CID"]."'";
	$menutype=mysqli_query($con, "$sql");
	$menutyperow=mysqli_fetch_row($menutype);
	 if($menutyperow[0]=="")
	 {
	$menutype=mysqli_query($con, "SELECT title FROM subsubmenu WHERE articlelink='content_edit.php?ContentID=".$_REQUEST["CID"]."'");
	$menutyperow=mysqli_fetch_row($menutype);
	   if($menutyperow[0]=="")
	   {
	   $menutype=mysqli_query($con, "SELECT Title FROM inner_menu WHERE articlelink='content_edit.php?ContentID=".$_REQUEST["CID"]."'");
	   $menutyperow=mysqli_fetch_row($menutype);
	   }
	 }
	}
	//$menutyperow=mysqli_fetch_row($menutype);
	$row[1]=$menutyperow[0];
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
			background-color:#F33;
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
    <td height="29" align="left" valign="top"><strong>Menu Type </strong></td>
    <td align="left" valign="top"><input name="menutype" type="text" id="menutype" size="40" value="<?php print $row[1]; ?>" readonly /></td>
  </tr>
  <tr>
    <td height="29" align="left" valign="middle"><strong>Title:</strong></td>
    <td align="left" valign="middle"><input name="title" type="text" id="title" size="40" value="<?php print $row[2]; ?>"></td>
  </tr>
  <tr>
    <td height="29" align="left" valign="middle"><strong>Sub Title:</strong></td>
    <td width="532" align="left" valign="middle"><input name="subtitle" type="text" id="subtitle" size="40" value="<?php print $row[3]; ?>"  /></td>
  </tr>
  <tr>
    <td width="171" height="19" align="left" valign="top"><strong>Description:</strong></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="297" colspan="2" align="center" valign="top">
	<?php
	 $row[4]=str_replace("&acute;","’",$row[4]);
	 $row[4]=str_replace("&acute;","'",$row[4]);
	?>
	
	<textarea id="content" name="designdetail"  rows="5" cols="5"><?php print $row[4]; ?></textarea>
	<input type="hidden" name="CID" value="<?php print $_REQUEST["CID"]; ?>">
	
<script language="javascript1.2">
  generate_wysiwyg('content');
</script>	</td>
  </tr>
   <tr>
    <td height="29" align="left" valign="middle"><strong>Image:</strong></td>
    <td align="left" valign="middle"><img src="../contentimage/<?php print $row[0].".jpg"; ?>" height="100" width="100"></td>
   </tr>
   <tr>
    <td height="29" align="left" valign="middle"><strong>Image:</strong></td>
    <td align="left" valign="middle"><input type="file" name="photo" id="photo" /></td>
   </tr>
    <tr>
      <td height="27" align="left" valign="top" >&nbsp;</td>
      <td height="27" align="left" valign="top" ><input type="submit" name="Submit" value="EDIT" class="btnsdt" style="color:#FFFFFF;" /></td>
    </tr>
</table>
</form>
</body>
</html>