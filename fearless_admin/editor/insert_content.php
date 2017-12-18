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
   
	 
			$CID=MakeID($con, "content_info","ContentID","CONT-",10);
			$link="content_edit.php?ContentID=".$CID;
			$Date=MakeDate();
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
						}
						
						
						      		$_POST['designdetail']=str_replace("’","&acute;",$_POST['designdetail']);
									$_POST['designdetail']=str_replace("'","&acute;",$_POST['designdetail']);
									if($_REQUEST["ArticleType"]=="General")
									{
											
											 $sql="INSERT INTO content_info                     
											(ContentID,Title,SubTitle,Description,ContentType,LinkType,LinkDetails,ViewIn,ActiveStatus,
											PublishDate,small_img,mid_img,big_img,InsertBy)
										 VALUES('".$CID."','".$_POST["title"]."','".$_POST["subtitle"]."','".$_POST['designdetail']."',
									'".$_POST["ArticleType"]."','".$_REQUEST["LinkType"]."','".$_POST["ExternalLink"]."', '".$_POST["RadioGroup1"]."',
										 'Active','".$Date."','".$smallimgname."','".$midimgname."','".$bigimgname."','".$_SESSION["UserID"]."')";
											$insert=mysqli_query($con, "$sql");
											
											 if($insert)
											 {
											print "<script>alert('Article Createted Successfully')</script>";
											 }
											else 
											{
											print "<script>alert('Article Create Failed! Try Again....')</script>";
											}
											
									}

		                

			

 }
			//die();              
                
        
		
        
////////////////////////////////		

		/////////////////////////////////////////////////////////////
	



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
//	function selectLinkType()
//	{
//
//	   if($('#ArticleType').val()=="List")
//	      {
//		   $('#linkType').show();
//		   $('#viewin').show();
//		   $('#listArticle').show();
//		  }
//	   else if($('#ArticleType').val()=="General")
//	      {
//		    $('#linkType').hide();
//		    $('#listArticle').hide();
//			$('#externalLink').hide();
//			$('#viewin').hide();
//		  }
//	}
	function totalCheck()
	{		
		
			if(document.aaa.title.value=="")
			{
			 alert("Fillup Article Title");
			 document.aaa.title.focus();
			 return false;	
			}
			
	
           if(document.aaa.LinkType.value=="External")
			{
			   if(document.aaa.ExternalLink.value=="") 
			   {
			     alert("Fillup External Link");
			     document.aaa.ExternalLink.focus();
			     return false; 
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
<form name="aaa" method="post" action="<?php print $_SERVER['PHP_SELF'] ?>" onsubmit="return totalCheck();" enctype="multipart/form-data">
<table width="703" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr style="display:none;">
    <td height="29" align="left" valign="top"><strong>Select Article Type </strong></td>
    <td colspan="2" align="left" valign="top">
	                             <select name="ArticleType" id="ArticleType" onchange="selectLinkType();">
								  <option value="">Select Article Type</option>
								  <option value="General" selected="selected">General Article</option>
								  <option value="List">List Article</option>
							      </select>	</td>
  </tr>
  <tr id="linkType">
    <td height="29" align="left" valign="middle"><strong>Link Type </strong></td>
    <td colspan="2" align="left" valign="middle">
	<select name="LinkType" id="LinkType" onchange="setup();">
      <option value="">Select Link Type</option>
      <option value="General" selected="selected" >Inner Article</option>
      <option value="External">External Link</option>
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
	  ?>
      <option value="<?php print $listArticleRow[0]; ?>"><?php print $listArticleRow[1]; ?></option>
	  <?php } ?>
    </select></td>
  </tr>
  <tr id="externalLink" style="display:none;">
    <td height="29" align="left" valign="middle"><strong>External Link: </strong></td>
    <td colspan="2" align="left" valign="middle"><input name="ExternalLink" type="text" id="ExternalLink" size="40" /></td>
  </tr>
  <tr>
    <td height="29" align="left" valign="middle"><strong>Article Title:</strong></td>
    <td colspan="2" align="left" valign="middle"><input name="title" type="text" id="title" size="40" ></td>
  </tr>
  <tr>
    <td height="29" align="left" valign="middle"><strong> Article Sub Title:</strong></td>
    <td colspan="2" align="left" valign="middle"><input name="subtitle" type="text" id="subtitle" size="40"  /></td>
  </tr>
  <tr id="viewin">
    <td height="35" align="left" valign="top"><strong>View in: </strong></td>
    <td width="136" align="left" valign="top">

        <input type="radio" name="RadioGroup1" value="Same" checked="checked" />
        Same Window </td>
    <td width="396" align="left" valign="top">
      <input type="radio" name="RadioGroup1" value="Blank"/>
      Blank Window</td>
  </tr>
  <tr>
    <td width="171" height="19" align="left" valign="top"><strong>Description:</strong></td>
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="297" colspan="3" align="center" valign="top">

	
	<textarea id="content" name="designdetail"  rows="5" cols="5"></textarea>
	
	
<script language="javascript1.2">
  generate_wysiwyg('content');
</script>	</td>
  </tr>
  
   <tr>
    <td height="29" align="left" valign="middle"><strong>Content Image:</strong></td>
    <td colspan="2" align="left" valign="middle"><input type="file" name="photo" id="photo" />
    (600px * 300px)</td>
   </tr>
    <tr>
      <td height="27" align="left" valign="top" >&nbsp;</td>
      <td height="27" colspan="2" align="left" valign="top" >
	  <input name="regdata" type="hidden" id="regdata" value="1"  />
	  <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-03","add_option");
			 if($check_access=="yes")
			  {
			 ?>
	  <input type="submit" name="Submit" value="INSERT" class="btnsdt" style="color:#FFFFFF;"  />
	  <?php } ?>
	  </td>
    </tr>
</table>
</form>
</body>
</html>