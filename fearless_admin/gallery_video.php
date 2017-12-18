<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");


  $rs=mysqli_query($con, "SELECT Title,VideoFile FROM video_gallery WHERE VideoID='".$_REQUEST["VideoID"]."'");
	$row=mysqli_fetch_row($rs);	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="videorequire/video-js.css" rel="stylesheet" type="text/css">
  <!-- video.js must be in the <head> for older IEs to work. -->
  <script src="videorequire/video.js"></script>
  <script>
    _V_.options.flash.swf = "videorequire/video-js.swf";
  </script>


   <style type="text/css">
		.btnsdt
			{
			background-color:#F33;
			color:#FFFFFF;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;"
			
			}
		</style>
</head>
<body>

<table width="351" border="0" align="center" cellpadding="1" cellspacing="2" style="border-color:#F33; border-width:2px; border-style:solid;">
  <tr>
    <td height="27" colspan="3" align="center" valign="top">
	<strong > <?php print $row[0]; ?></strong></td>
  </tr>


  <tr>
    <td height="157" colspan="3" align="center" valign="top">
	

		
										<div class="mod-content clearfix">	
				<div class="mod-inner clearfix">
				 
			    <div class="video_glry_main">
                 
        <div class="out_put_video">
        
        <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="290" height="195" data-setup="{}">
    <source src="galleryvideo/<?php print $row[1]; ?>" type='video/mp4' />
   </video>
   		
		
        </div>
	
				</div>
			</div>
		</div>


	</td>
  </tr>
  

  <tr>
    <td height="35" colspan="3" align="center" valign="top">
	  <input name="button" type="button" id="button" value="Close" onClick="window.close();" class="btnsdt" /></td>
  </tr>
</table>
</body>
</html>