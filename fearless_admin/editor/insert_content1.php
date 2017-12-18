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
   
	 
			$CID=MakeID($con, "content_info","ContentID","CONT-",10);
			$link="content_edit.php?ContentID=".$CID;
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
			
			if($_REQUEST["InnerMenu"]!="")
			{
			 $insert=mysqli_query($con, "INSERT INTO content_info (ContentID,MenuType,Title,SubTitle,Description) 
             VALUES('".$CID."','','".$_POST["title"]."','".$_POST["subtitle"]."','".$_POST['designdetail']."')");
			 //$link="content_edit.php?ContentID=".$CID;
			$update=mysqli_query($con, "UPDATE inner_menu SET articlelink='".$link."' WHERE InnerID='".$_REQUEST["InnerMenu"]."'");
			
			 print "<script>alert('Successfully Inserted Content')</script>";
			}
			else
			{
			if($_REQUEST["SubSubMenu"]!="")
			{
            $insert=mysqli_query($con, "INSERT INTO content_info (ContentID,MenuType,Title,SubTitle,Description) 
             VALUES('".$CID."','','".$_POST["title"]."','".$_POST["subtitle"]."','".$_POST['designdetail']."')");
			 //$link="content_edit.php?ContentID=".$CID;
			$update=mysqli_query($con, "UPDATE subsubmenu SET articlelink='".$link."' WHERE ssid='".$_REQUEST["SubSubMenu"]."'");
			
			 print "<script>alert('Successfully Inserted Content')</script>";
			}
			else
			{
			  if($_REQUEST["SubMenu"]!="")
			  {
			   $insert=mysqli_query($con, "INSERT INTO content_info (ContentID,MenuType,Title,SubTitle,Description) 
             VALUES('".$CID."','','".$_POST["title"]."','".$_POST["subtitle"]."','".$_POST['designdetail']."')");
			 $update=mysqli_query($con, "UPDATE submenu SET articlelink='".$link."' WHERE sid='".$_REQUEST["SubMenu"]."'");
			 print "<script>alert('Successfully Inserted Content')</script>";
			  }
			  else
			  {
			    if($_REQUEST["MainMenu"]!="")
				{
				$insert=mysqli_query($con, "INSERT INTO content_info (ContentID,MenuType,Title,SubTitle,Description) 
             VALUES('".$CID."','','".$_POST["title"]."','".$_POST["subtitle"]."','".$_POST['designdetail']."')");
			   $update=mysqli_query($con, "UPDATE mainmenu SET articlelink='".$link."' WHERE mid='".$_REQUEST["MainMenu"]."'");
			   print "<script>alert('Successfully Inserted Content')</script>";
				}
			  }
			}
			}
				//header("Location:edit_aboutus.php?msg=Successfully Edited...");
 }
			//die();              
                
        
		
        
////////////////////////////////		

		/////////////////////////////////////////////////////////////
	



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
<script src="../jquery-1.4.4.min.js" type="text/javascript"></script>
	       <script type="text/javascript">
		 	function rootmenu(searchCode)
			  {
			   // alert(''+searchCode);
			   $.post("LookUp.php",{ func: "PARENTMENU", src: searchCode},
			   function(data)
			   {
			   $('#parent').html(data.SSSSS);
			   },"json")	
			  }
			 function submenu(searchCode)
			  {
			   // alert(''+searchCode);
			   $.post("LookUp.php",{ func: "SUBMENU", src: searchCode},
			   function(data)
			   {
			   $('#sub').html(data.SSSSS);
			   $('#inner').html(data.IIIII);
			   },"json")	
			  }
		   function subsubmenu(searchCode)
			  {
			   // alert(''+searchCode);
			   $.post("LookUp.php",{ func: "SUBSUBMENU", src: searchCode},
			   function(data)
			   {
			   $('#subsub').html(data.SSSSS);
			   $('#inner').html(data.IIIII);
			   },"json")	
			  }
		    function innermenu(searchCode)
			  {
			   // alert(''+searchCode);
			   $.post("LookUp.php",{ func: "INNERMENU", src: searchCode},
			   function(data)
			   {
			   $('#inner').html(data.IIIII);
			   },"json")	
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
    <td align="left" valign="top"><select name="MenuType" id="MenuType" onchange="rootmenu(this.value);">
								  <option value="">Select Menu Type</option>
								  <option value="Top Left">Top Left</option>
								  <option value="Top Right">Top Right</option>
								  <option value="Main">Main</option>
								  <option value="Bottom1 Left">Bottom1 Left</option>
								  <option value="Bottom1 Right">Bottom1 Right</option>
								  <option value="Bottom2 Left">Bottom2 Left</option>
								  <option value="Bottom2 Right">Bottom2 Right</option>
							      </select>	</td>
  </tr>
  <tr>
    <td height="29" align="left" valign="top"><strong>Menu Title</strong></td>
    <td align="left" valign="top" id="parent">
	<select name='MainMenu' id='MainMenu' onchange='innermenu(this.value)'>
      <option value="">Select Parent Menu</option>

    </select></td>
  </tr>
  <tr>
    <td height="29" align="left" valign="top"><strong>Sub Menu Title</strong></td>
    <td align="left" valign="top" id="sub">
	<select name='SubMenu' id='SubMenu' onchange='subsubmenu(this.value)'>
      <option value="">Select Sub Menu</option>

    </select>
	</td>
  </tr>
  <tr>
    <td height="29" align="left" valign="top"><strong>Sub Sub Menu Title</strong></td>
    <td align="left" valign="top" id="subsub">
	<select name='SubSubMenu' id='SubSubMenu' onchange='innermenu(this.value)'>
      <option value="">Select Sub Sub Menu</option>

    </select>
	</td>
  </tr>
  <tr>
    <td height="29" align="left" valign="top"><strong>Inner Menu Title</strong></td>
    <td align="left" valign="top" id="inner">
	<select name='InnerMenu' id='InnerMenu' >
      <option value="">Select Inner Menu</option>

    </select>
	</td>
  </tr>
  <tr>
    <td height="29" align="left" valign="middle"><strong>Content Title:</strong></td>
    <td align="left" valign="middle"><input name="title" type="text" id="title" size="40" value="<?php print $row[2]; ?>"></td>
  </tr>
  <tr>
    <td height="29" align="left" valign="middle"><strong> Content Sub Title:</strong></td>
    <td width="532" align="left" valign="middle"><input name="subtitle" type="text" id="subtitle" size="40" value="<?php print $row[3]; ?>"  /></td>
  </tr>
  <tr>
    <td width="171" height="19" align="left" valign="top"><strong>Description:</strong></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="297" colspan="2" align="center" valign="top">

	
	<textarea id="content" name="designdetail"  rows="5" cols="5"></textarea>
	
	
<script language="javascript1.2">
  generate_wysiwyg('content');
</script>	</td>
  </tr>
  
   <tr>
    <td height="29" align="left" valign="middle"><strong>Content Image:</strong></td>
    <td align="left" valign="middle"><input type="file" name="photo" id="photo" /></td>
   </tr>
    <tr>
      <td height="27" align="left" valign="top" >&nbsp;</td>
      <td height="27" align="left" valign="top" ><input type="submit" name="Submit" value="INSERT" class="btnsdt" style="color:#FFFFFF;" /></td>
    </tr>
</table>
</form>
</body>
</html>