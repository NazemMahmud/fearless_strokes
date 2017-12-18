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
    if($_POST["NewsLetterCategoryID"]!="")
	  {
			$NSLID=MakeID($con, "newsletter_info","NewsLetterID","NSL-",12);
			$_POST['designdetail']=str_replace("’","&acute;",$_POST['designdetail']);
	        $_POST['designdetail']=str_replace("'","&acute;",$_POST['designdetail']);
			$sql="INSERT INTO newsletter_info (NewsLetterID,NewsLetterTitle,NewsLetterCategory,NewsLetterDescription)
			 VALUES('".$NSLID."','".$_POST["title"]."','".$_POST["NewsLetterCategoryID"]."','".$_POST['designdetail']."')";
			//print $sql;
			$insert=mysqli_query($con, "$sql"); 
			if($insert)
			 {
			  print "<script>alert('Newsletter Successfully Inserted')</script>";
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
	    print "<script>alert('Please Select A Newsletter Category')</script>";
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
    <td height="29" align="left" valign="top"><strong>NewsLetter Category </strong></td>
    <td align="left" valign="top"><span class="input">
      <select name="NewsLetterCategoryID" id="NewsLetterCategoryID">
        <option value="">Select NewsLetter Category</option>
        <?php
								   $cat=mysqli_query($con, "SELECT CategoryID,CategoryName FROM newslatter_category WHERE ActiveStatus='Active' ORDER BY CategoryID DESC");
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
    <td width="532" align="left" valign="middle"><input name="title" type="text" size="40"  /></td>
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
      <td height="27" align="left" valign="top" >&nbsp;</td>
      <td height="27" align="left" valign="top" >
	  <?php
							  $check_access=check_access($con, $_SESSION["UserID"],"MOD-11","add_option");
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