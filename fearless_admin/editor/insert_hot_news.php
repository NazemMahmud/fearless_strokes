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
   
			$NSID=MakeID($con, "hotest_news","HotNewsID","HNWS-",10);
			$Date=MakeDate();
			 $allowedfiletypes = array("jpeg","jpg","gif","png");
		     $uploadfolder = "../newsimage/" ;
		     $uploadfilename = $_FILES['photo']['name'];
		  $fileext = strtolower(substr($uploadfilename,strrpos($uploadfilename,".")+1));
		  if (!empty($uploadfilename) and !in_array($fileext,$allowedfiletypes)) 
		    { 
				 print "<script>alert('Image File Not Support! Try Again....')</script>";	
			}
	      else if(!empty($uploadfilename))
		    {			
					$file1 = $uploadfolder.$NSID.$_FILES['photo']['name'];
					$bigimg=$NSID.$_FILES['photo']['name']; 
					@move_uploaded_file($_FILES['photo']['tmp_name'], $file1);
									
					$_POST['designdetail']=str_replace("’","&acute;",$_POST['designdetail']);
					$_POST['designdetail']=str_replace("'","&acute;",$_POST['designdetail']);

					$sql="INSERT INTO hotest_news (HotNewsID,Title,Description,ImageName,PublishDate,ActiveStatus)
					 VALUES('".$NSID."','".$_POST["title"]."','".$_POST['designdetail']."','".$bigimg."','".$Date."','Active')";
					 
					$insert=mysqli_query($con, "$sql"); 
					if($insert)
					 {
					  print "<script>alert('News Successfully Inserted')</script>";
					 }
					else
					 {
					  print "<script>alert('Try Again')</script>";
					 }
			}
			else
			{
			   print "<script>alert('Please Try with an Image....')</script>";	
			}
			


	
}

  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


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
    <td align="left" valign="top"><strong>News Title:</strong></td>
    <td width="532" align="left" valign="top"><input name="title" type="text" id="title" size="40"></td>
  </tr>
  
  <tr>
    <td width="171" height="19" align="left" valign="top"><strong>Description:</strong></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="297" colspan="2" align="center" valign="top">
	<textarea id="content" name="designdetail"  rows="5" cols="5"></textarea>
	<input type="hidden" name="ID" value="">
<script language="javascript1.2">
  generate_wysiwyg('content');
</script>	</td>
  </tr>
   <tr>
    <td height="29" align="left" valign="middle"><strong>News Image :</strong></td>
    <td align="left" valign="middle"><input type="file" name="photo" id="photo" />
      (300px*180px)</td>
   </tr>
    <tr>
      <td height="27" align="left" valign="top" >&nbsp;</td>
      <td height="27" align="left" valign="top" >
	  <?php
							  $check_access=check_access($con, $_SESSION["UserID"],"MOD-12","add_option");
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