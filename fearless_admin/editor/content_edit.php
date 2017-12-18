<?php 
  session_start();
	 include("../connection.php");
	 if($_SESSION["UserName"]=="")
	 {
	   print "You are not authorized To View this page.<br>";
	   print "<a href=\"index.php\">GO Back</a>";
	   exit ();
	  }
	  
	  
if(isset($_POST['regdata']) && $_POST['regdata']=="1")
{	
   
	 
			$CID=$_REQUEST["CID"];
			$Date=MakeDate();
			$smallimgname=$_POST["small"];
			$midimgname=$_POST["mid"];
			$bigimgname=$_POST["big"];
			 $allowedfiletypes = array("jpeg","jpg","gif","png");
					     $uploadfolder = "../contentimage/" ;
					     $uploadfilename = $_FILES['photo']['name'];
					     $fileext = strtolower(substr($uploadfilename,strrpos($uploadfilename,".")+1));
						if (!empty($uploadfilename) and !in_array($fileext,$allowedfiletypes)) 
						{ 
						  print "<script>alert('Image File Not Support! Try Again....')</script>";	
						}
						else if(!empty($uploadfilename))
						{
						include("thumb.php") ;	
						 @unlink($uploadfolder.$smallimgname);
						 @unlink($uploadfolder.$midimgname);	
						 @unlink($uploadfolder.$bigimgname);	
						 		
						$file1 = $uploadfolder."img".$CID.$_FILES['photo']['name'];
						//$bigimg="img".$row['maxid'].$_FILES['uploadimage']['name']; 
						move_uploaded_file($_FILES['photo']['tmp_name'], $file1);
						$ext=strtolower(substr(strrchr($file1,"."),1));
						
						$bigimg=$uploadfolder."big".$CID.$_FILES['photo']['name'];
						$bigimgname="big".$CID.$_FILES['photo']['name'];
						save_scaled($file1,$bigimg,$ext,594,280);
					
						$midimg=$uploadfolder."mid".$CID.$_FILES['photo']['name'];
						$midimgname="mid".$CID.$_FILES['photo']['name'];
						save_scaled($file1,$midimg,$ext,300,180);
						
						$smallimg=$uploadfolder."small".$CID.$_FILES['photo']['name'];
						$smallimgname="small".$CID.$_FILES['photo']['name'];
						save_scaled($file1,$smallimg,$ext,100,100);
						
						@unlink($file1);
		
			
							$_POST['designdetail']=str_replace("’","&acute;",$_POST['designdetail']);
							$_POST['designdetail']=str_replace("'","&acute;",$_POST['designdetail']);
							if($_REQUEST["ArticleType"]=="General")
							{
									
									 $update=mysqli_query($con, "UPDATE content_info SET Title='".$_POST["title"]."',SubTitle='".$_POST["subtitle"]."',
									Description='".$_POST['designdetail']."',ContentType='".$_POST["ArticleType"]."',
									LinkType='".$_POST["LinkType"]."',LinkDetails='".$_POST["ExternalLink"]."',
									ViewIn='".$_POST["RadioGroup1"]."',small_img='".$smallimgname."',mid_img='".$midimgname."',
									big_img='".$bigimgname."',UpdateDate='".$Date."',UpdateBy='".$_SESSION["UserID"]."' WHERE ContentID='".$CID."'");
									
							}
				
						   
							if($update)
							print "<script>alert('Article Edited Successfully')</script>";
							else 
							print "<script>alert('Article Edit Failed! Try Again....')</script>";
			           }
					   else
					   {
					        $_POST['designdetail']=str_replace("’","&acute;",$_POST['designdetail']);
							$_POST['designdetail']=str_replace("'","&acute;",$_POST['designdetail']);
							if($_REQUEST["ArticleType"]=="General")
							{
									
									 $update=mysqli_query($con, "UPDATE content_info SET Title='".$_POST["title"]."',SubTitle='".$_POST["subtitle"]."',
									Description='".$_POST['designdetail']."',ContentType='".$_POST["ArticleType"]."',
									LinkType='".$_POST["LinkType"]."',LinkDetails='".$_POST["ExternalLink"]."',
									ViewIn='".$_POST["RadioGroup1"]."',UpdateDate='".$Date."',UpdateBy='".$_SESSION["UserID"]."'
									 WHERE ContentID='".$CID."'");
									
							}
				
						   
							if($update)
							print "<script>alert('Article Edited Successfully')</script>";
							else 
							print "<script>alert('Article Edit Failed! Try Again....')</script>";
					   }
			
				
 }
			//die();              
                
        
		
        
////////////////////////////////		

		/////////////////////////////////////////////////////////////
	


$row=mysqli_fetch_row(mysqli_query($con, "SELECT * FROM content_info WHERE ContentID='".$_REQUEST["CID"]."'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

<script language="javascript" type="text/javascript" src="wysiwyg.js"></script>


<script language="javascript" type="text/javascript">
    function setup()
	{
	   if($('#LinkType').val()=="External")
	      {
		   $('#listArticle').hide();
		   $('#externalLink').show();
		  }
	   else if($('#LinkType').val()=="General")
	      {
		   $('#listArticle').hide();
		   $('#externalLink').hide();
		  }
	}
/*	function selectLinkType()
	{

	   if($('#ArticleType').val()=="List")
	      {
		   $('#linkType').show();
		   $('#viewin').show();
		   $('#listArticle').show();
		  }
	   else if($('#ArticleType').val()=="General")
	      {
		    $('#linkType').hide();
		    $('#listArticle').hide();
			$('#externalLink').hide();
			$('#viewin').hide();
		  }
	}*/
	function totalCheck()
	{		
		if(document.aaa.ArticleType.value=="General")
		{
			if(document.aaa.title.value=="")
			{
			 alert("Fillup Article Title");
			 document.aaa.title.focus();
			 return false;	
			}
			
		}
		
		else if(document.aaa.ArticleType.value=="List")
		{
			if(document.aaa.LinkType.value=="")
			{
			  alert("Please Select Link Type");
			  document.aaa.LinkType.focus();
			  return false; 
			}	
			else if(document.aaa.LinkType.value=="General")
			{
			   if(document.aaa.ListArticle.value=="") 
			   {
			     alert("Link an Article");
			     document.aaa.ListArticle.focus();
			     return false; 
			   } 
			   else if(document.aaa.title.value=="")
			   {
				 alert("Fillup Article Title");
				 document.aaa.title.focus();
				 return false;	
			   }	
			  
			}
			else if(document.aaa.LinkType.value=="External")
			{
			   if(document.aaa.ExternalLink.value=="") 
			   {
			     alert("Fillup External Link");
			     document.aaa.ExternalLink.focus();
			     return false; 
			   }
			   else if(document.aaa.title.value=="")
			   {
			    alert("Fillup Article Title");
			    document.aaa.title.focus();
			    return false;	
			   }	
			  
			}
			
		}
		
	}
</script>
<script src="../jquery-1.4.4.min.js" type="text/javascript"></script>

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
</head>
<body>
<form name="aaa" method="post" action="<?php print $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
<table width="703" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr style="display:none;">
    <td height="29" align="left" valign="top"><strong>Select Article Type </strong></td>
    <td colspan="2" align="left" valign="top">
	                             <select name="ArticleType" id="ArticleType" onchange="selectLinkType();">
								  <option value="">Select Article Type</option>

								  
								  <option value="General" selected="selected">General Article</option>
								  <option value="List" >List Article</option>
							      </select>
	                             <input name="small" type="hidden" id="small" value="<?php print $row[11]; ?>" />
	                             <input name="mid" type="hidden" id="mid" value="<?php print $row[12]; ?>" />
	                             <input name="big" type="hidden" id="big" value="<?php print $row[13]; ?>" /></td>
  </tr>

  <tr id="linkType">
    <td height="29" align="left" valign="middle"><strong>Link Type </strong></td>
    <td colspan="2" align="left" valign="middle">
	<select name="LinkType" id="LinkType" onchange="setup();">
                                <?php
								   if($row[6]=="General")
								   {
								    $active="selected=\"selected\"";
									$inactive="";
								   }
								   else if($row[6]=="External")
								   {
								    $active="";
									$inactive="selected=\"selected\"";
								   }
								  ?>
      <option value="General" <?php print $active ?>>Inner Article</option>
      <option value="External" <?php print $inactive ?>>External Link</option>
    </select></td>
  </tr>

  <tr id="listArticle" style="display:none;">

    <td height="29" align="left" valign="middle"><strong>Link an Article :</strong></td>
    <td colspan="2" align="left" valign="middle">
	<select name="ListArticle" id="ListArticle">
      
	  <?php
	   $listArticle=mysqli_query($con, "SELECT ContentID,Title FROM content_info WHERE ContentType='General' AND Title!='' ORDER BY Title");
	   while($listArticleRow=mysqli_fetch_row($listArticle))
	   {
	    if($row[7]==$listArticleRow[0])
		{
	  ?>
      <option value="<?php print $listArticleRow[0]; ?>" selected="selected"><?php print $listArticleRow[1]; ?></option>
	  <?php }
	  else
	  { ?>
	  <option value="<?php print $listArticleRow[0]; ?>" ><?php print $listArticleRow[1]; ?></option>
	  <?php }} ?>
    </select></td>
  </tr>
      <?php
    if($row[6]=="General")
	{
	 $externalLink="";
  ?>
  <tr id="externalLink" style="display:none;">
  <?php
    }
	else if($row[6]=="External")
	{ $externalLink=$row[7];
  ?>
  <tr id="externalLink">
  <?php
    }
	?>
    <td height="29" align="left" valign="middle"><strong>External Link: </strong></td>
    <td colspan="2" align="left" valign="middle">
	
	<input name="ExternalLink" type="text" id="ExternalLink" size="40" value="<?php print  $externalLink; ?>" /></td>
  </tr>
  <tr>
    <td height="29" align="left" valign="middle"><strong>Article Title:</strong></td>
    <td colspan="2" align="left" valign="middle"><input name="title" type="text" id="title" size="40" value="<?php print $row[2] ?>" ></td>
  </tr>
  <tr>
    <td height="29" align="left" valign="middle"><strong> Article Sub Title:</strong></td>
    <td colspan="2" align="left" valign="middle"><input name="subtitle" type="text" id="subtitle" size="40" value="<?php print $row[3] ?>"  /></td>
  </tr>
      <?php
  if($row[8]=="Same")
	   {
	     $check="checked=\"checked\"";
		 $incheck="";
	   }
	   else
	   if($row[8]=="Blank")
	   {
	     $check="";
		 $incheck="checked=\"checked\"";
	   }
  ?>
  <tr id="viewin">

    <td height="35" align="left" valign="top"><strong>View in: </strong></td>
    <td width="136" align="left" valign="top">

        <input type="radio" name="RadioGroup1" value="Same" <?php print $check; ?>  />
        Same Window </td>
    <td width="396" align="left" valign="top">
      <input type="radio" name="RadioGroup1" value="Blank" <?php print $incheck; ?> />
      Blank Window</td>
  </tr>
  <tr>
    <td width="171" height="19" align="left" valign="top"><strong>Description:</strong></td>
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="297" colspan="3" align="center" valign="top">

	<?php
	 $row[4]=str_replace("&acute;","’",$row[4]);
	 $row[4]=str_replace("&acute;","'",$row[4]);
	?>
	<textarea id="content" name="designdetail"  rows="5" cols="5"><?php print $row[4]; ?></textarea>
	
	
<script language="javascript1.2">
  generate_wysiwyg('content');
</script>	</td>
  </tr>
  <?php
   if($row[12]!="")
   {
  ?>
   <tr >
     <td height="65" align="left" valign="top"><strong>Content Image:</strong></td>
     <td colspan="2" align="left" valign="top"><img src="../contentimage/<?php print $row[11]; ?>"></td>
   </tr>
    <?php
   }
  ?>
   <tr >
    <td height="29" align="left" valign="middle"><strong>Change Image:</strong></td>
    <td colspan="2" align="left" valign="middle"><input type="file" name="photo" id="photo" />
(600px * 300px)</td>
   </tr>
    <tr>
      <td height="27" align="left" valign="top" >&nbsp;</td>
      <td height="27" colspan="2" align="left" valign="top" >
	  <input name="regdata" type="hidden" id="regdata" value="1"  />
	  <input type="submit" name="Submit" value="EDIT" class="btnsdt" style="color:#FFFFFF;"  />
	  <input name="CID" type="hidden" id="CID" value="<?php print $_REQUEST["CID"]; ?>"></td>
    </tr>
</table>
</form>
</body>
</html>