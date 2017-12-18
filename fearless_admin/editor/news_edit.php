<?php 
  session_start();
   if($_SESSION["UserName"]=="")
	 {
	   print "You are not authorized To View this page.<br>";
	   print "<a href=\"index.php\">GO Back</a>";
	   exit ();
	  }
	 include("../connection.php");
	
	  $Date=MakeDate();
	  
if(isset($_POST['Submit']))
{	
   
	 
			$NSID=$_POST["NID"];
			
			 //$allowedfiletypes = array("jpeg","jpg","gif","png");
		     $uploadfolder = "../newsimage/" ;
		     $uploadfilename = $_FILES['photo']['name'];
			 $uploadfilename2 = $_FILES['photo2']['name'];
	      if(!empty($uploadfilename))
		    {			
			$file1 = $uploadfolder.$NSID.$_FILES['photo']['name'];
			$bigimg=$NSID.$_FILES['photo']['name']; 
			@move_uploaded_file($_FILES['photo']['tmp_name'], $file1);
			}
			else
			{
			$bigimg=$_POST["bigimg"];
			}
		 if(!empty($uploadfilename2))
		    {			
			$file1 = $uploadfolder.$NSID.$_FILES['photo2']['name'];
			$linkimg=$NSID.$_FILES['photo2']['name']; 
			@move_uploaded_file($_FILES['photo2']['tmp_name'], $file1);
			}
			else
			{
			$linkimg=$_POST["linkimg"];
			}
			
			
		
			
			$sql="UPDATE news_info SET NewsCategoryID='".$_POST["NewsCategoryID"]."',Title='".$_POST["title"]."',IssuedBy='".$_POST["issuedby"]."',
			IssuedTo='".$_POST["issuedto"]."',NewsImage='".$bigimg."',LinkImage='".$linkimg."',UpdateDate='".$Date."',
			UpdateBy='".$_SESSION["UserID"]."' WHERE NewsID='".$NSID."'";
			$update=mysqli_query($con, "$sql"); 
			if($update)
			 {
			  print "<script>alert('Notice and Circulation Successfully Updated')</script>";
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
	


$rs=mysqli_query($con, "SELECT * FROM news_info WHERE NewsID='".$_REQUEST["NID"]."'");
$row=mysqli_fetch_row($rs); 
                if($row[9]!="")
				  $linkimg="<img src='../newsimage/$row[9]' style='width:50px; height:40px;'>";
				  else
				  $linkimg="Download File"; 
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
    <td height="29" align="left" valign="top"><strong>Category </strong></td>
    <td align="left" valign="top"><span class="input">
      <select name="NewsCategoryID" id="NewsCategoryID">
        
        <?php
								   $cat=mysqli_query($con, "SELECT CategoryID,CategoryName FROM news_category_info WHERE ActiveStatus='Active' ORDER BY CategoryID DESC ");
								   while($catRow=mysqli_fetch_row($cat))
								   {
								   if($catRow[0]==$row[1])
								   {
								  ?>
        <option value="<?php print $catRow[0]; ?>" selected="selected"><?php print $catRow[1]; ?></option>
        <?php
								  }
								  else
								  {
								  ?>
	   <option value="<?php print $catRow[0]; ?>" selected="selected"><?php print $catRow[1]; ?></option>
	                             <?php }} ?>
      </select>
    </span></td>
  </tr>
  <tr>
    <td height="29" align="left" valign="middle"><strong>Title:</strong></td>
    <td align="left" valign="middle"><input name="title" type="text" id="title" size="40" value="<?php print $row[2]; ?>">
      <input type="hidden" name="NID" value="<?php print $row[0]; ?>" />
      <input type="hidden" name="bigimg" value="<?php print $row[3]; ?>" />
      <input type="hidden" name="linkimg" value="<?php print $row[9]; ?>" /></td>
  </tr>
  <tr>
    <td height="29" align="left" valign="middle"><strong>Issued By:</strong></td>
    <td width="532" align="left" valign="middle"><input name="issuedby" type="text" id="issuedby" size="40" value="<?php print $row[7]; ?>" /></td>
  </tr>
  <tr>
    <td width="171" height="31" align="left" valign="middle"><strong>Issued To:</strong></td>
    <td align="left" valign="middle"><input name="issuedto" type="text" id="issuedto" size="40" value="<?php print $row[8]; ?>" /></td>
  </tr>
   <tr>
    <td height="29" align="left" valign="middle"><strong>Download File:</strong></td>
    <td align="left" valign="middle"><a href="../newsimage/<?php print $row[3]; ?>" target="_blank"><?php print $linkimg; ?></a></td>
   </tr>
   <tr>
    <td height="29" align="left" valign="middle"><strong>Change File:</strong></td>
    <td align="left" valign="middle"><input type="file" name="photo" id="photo" /></td>
   </tr>
    <tr>
      <td height="27" align="left" valign="top" ><strong>Change Link Image:</strong></td>
      <td height="27" align="left" valign="top" ><input type="file" name="photo2" id="photo2" /></td>
    </tr>
    <tr>
      <td height="27" align="left" valign="top" >&nbsp;</td>
      <td height="27" align="left" valign="top" >&nbsp;</td>
    </tr>
    <tr>
      <td height="27" align="left" valign="top" >&nbsp;</td>
      <td height="27" align="left" valign="top" ><input type="submit" name="Submit" value="EDIT" class="btnsdt" style="color:#FFFFFF;" /></td>
    </tr>
</table>
</form>
</body>
</html>