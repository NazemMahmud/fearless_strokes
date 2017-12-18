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
    if($_POST["NewsCategoryID"]!="")
	  {
	 
			$NSID=MakeID($con, "news_info","NewsID","NWS-",15);
			$Date=MakeDate();
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
			$bigimg="";
			}
			
		 if(!empty($uploadfilename2))
		    {			
			$file1 = $uploadfolder.$NSID.$_FILES['photo2']['name'];
			$linkimg=$NSID.$_FILES['photo2']['name']; 
			@move_uploaded_file($_FILES['photo2']['tmp_name'], $file1);
			}
			else
			{
			$linkimg="";
			}
			
			$sql="INSERT INTO news_info 
			(NewsID,NewsCategoryID,Title,NewsImage,ActiveStatus,InsertBy,NewsDate,IssuedBy,IssuedTo,LinkImage)
            VALUES('".$NSID."','".$_POST["NewsCategoryID"]."','".$_POST["title"]."',
	        '".$bigimg."','Active','".$_SESSION["UserID"]."','".$Date."','".$_POST["issuedby"]."','".$_POST["issuedto"]."','".$linkimg."')";
			//print $sql;
			$insert=mysqli_query($con, "$sql"); 
			if($insert)
			 {
			  print "<script>alert('Notice and Circulation Successfully Inserted')</script>";
			 }
			else
			 if($insert)
			 {
			  print "<script>alert('Try Again')</script>";
			 }
				//header("Location:edit_aboutus.php?msg=Successfully Edited...");
	   }
	else
	  {
	    print "<script>alert('Please Select A Notice and Circulation Category')</script>";
	  }	
				//die();              
                
        
		
        
////////////////////////////////		

		/////////////////////////////////////////////////////////////
	
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
    <td height="29" align="left" valign="top"><strong>Category </strong></td>
    <td width="532" align="left" valign="top"><span class="input">
      <select name="NewsCategoryID" id="NewsCategoryID">
        <option value="">Select News Category</option>
        <?php
								   $cat=mysqli_query($con, "SELECT CategoryID,CategoryName FROM news_category_info WHERE ActiveStatus='Active' ORDER BY CategoryID DESC ");
								   while($catRow=mysqli_fetch_row($cat))
								   {
								  ?>
        <option value="<?php print $catRow[0]; ?>"><?php print $catRow[1]; ?></option>
        <?php
								  }
								  ?>
      </select>
    </span></td>
  </tr>
  <tr>
    <td height="29" align="left" valign="middle"><strong>Title:</strong></td>
    <td align="left" valign="middle"><input name="title" type="text" id="title" size="40"></td>
  </tr>
  <tr>
    <td height="32" align="left" valign="top"><strong>Issued By :</strong></td>
    <td align="left" valign="top"><input name="issuedby" type="text" id="issuedby" size="40"></td>
  </tr>
  <tr>
    <td height="29" align="left" valign="top"><strong>Issued To :</strong></td>
    <td align="left" valign="top"><input name="issuedto" type="text" id="issuedto" size="40"></td>
  </tr>
  <tr>
    <td width="171" height="29" align="left" valign="top"><strong>File:</strong></td>
    <td align="left" valign="top"><input type="file" name="photo" id="photo" /></td>
  </tr>
  <tr>
    <td height="37" align="left" valign="top"><strong>Link Image :</strong></td>
    <td height="37" align="left" valign="top"><input type="file" name="photo2" id="photo2" /></td>
  </tr>
   <tr>
    <td height="29" align="left" valign="middle">&nbsp;</td>
    <td align="left" valign="middle">&nbsp;</td>
   </tr>
    <tr>
      <td height="27" align="left" valign="top" >&nbsp;</td>
      <td height="27" align="left" valign="top" >
	  <?php
							  $check_access=check_access($con, $_SESSION["UserID"],"MOD-14","add_option");
							 if($check_access=="yes")
							  {
							 ?>
	  <input type="submit" name="Submit" value="INSERT" class="btnsdt" style="color:#FFFFFF;" />
	   <?php } ?>
	  </td>
    </tr>
</table>
</form>
</body>
</html>