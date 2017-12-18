<?php
  	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
     $Date=MakeDate();
	 $ProductID=$_REQUEST["ProductID"];
	 $Serial=$_REQUEST["serial"];
	 
  $uploadfolder = "../productimage/" ;
 if(isset($_POST["btnAdd"]))
 {
     
	    $ImageID=MakeID($con, "product_image","ImageID","IMG-",20);
		$allowedfiletypes = array("jpeg","jpg","gif","png");
		
		            $allowedfiletypes = array("jpeg","jpg","gif","png");

					     $uploadfilename = $_FILES['file']['name'];
					     $fileext = strtolower(substr($uploadfilename,strrpos($uploadfilename,".")+1));
						if (!empty($uploadfilename) and !in_array($fileext,$allowedfiletypes)) 
						{ 
						  print "<script>alert('Invalid Extension!');</script>";
						}
						else if(!empty($uploadfilename))
						{
							include("thumb.php") ;			
							$file1 = $uploadfolder."img".$ImageID.$_FILES['file']['name'];
							//$bigimg="img".$row['maxid'].$_FILES['uploadimage']['name']; 
							move_uploaded_file($_FILES['file']['tmp_name'], $file1);
							$ext=strtolower(substr(strrchr($file1,"."),1));
							
							$bigimg=$uploadfolder."big".$ImageID.$_FILES['file']['name'];
							$bigimgname="big".$ImageID.$_FILES['file']['name'];
							save_scaled($file1,$bigimg,$ext,600,1000);
						
							$midimg=$uploadfolder."mid".$ImageID.$_FILES['file']['name'];
							$midimgname="mid".$ImageID.$_FILES['file']['name'];
							save_scaled($file1,$midimg,$ext,160,213);
							
							$smallimg=$uploadfolder."small".$ImageID.$_FILES['file']['name'];
							$smallimgname="small".$ImageID.$_FILES['file']['name'];
							save_scaled($file1,$smallimg,$ext,100,120);
							@unlink($file1);
							 $sql = "INSERT INTO product_image 
						   (ImageID,ProductID,BigImage,MidImage,SmallImage,type) 
						   VALUES('".$ImageID."','".$ProductID."','".$bigimgname."','".$midimgname."','".$smallimgname."',
						   '".$_REQUEST["type"]."')";
							    $img_insert=mysqli_query($con, $sql);
							   $activity_update=mysqli_query($con, "UPDATE product_info SET UpdateDate='".$Date."', UpdateBy='".$_SESSION['UserID']."'
									  WHERE ProductID='".$ProductID."'");
							 print "<script>alert('Successfully Inserted Image')</script>";
						
						}
                       else
					   {
   
                     print "<script>alert('Please Upload an Image')</script>";
					   }
            
 }
 if(isset($_POST["btnDelete"]))
 {
    $id=$_POST["id"];
	 $idCOunt=count($id);
	 for($i=0;$i<$idCOunt;$i++)
	 {
	    $image=mysqli_fetch_row(mysqli_query($con, "SELECT BigImage,MidImage,SmallImage FROM product_image WHERE ImageID='".$id[$i]."'
		 AND  type='".$_REQUEST["type"]."' AND ProductID='".$ProductID."' AND SerialNo='".$Serial."'"));
		@unlink($uploadfolder.$image[0]);
		@unlink($uploadfolder.$image[1]);
		@unlink($uploadfolder.$image[2]);
		$del=mysqli_query($con, "DELETE FROM product_image WHERE ImageID='".$id[$i]."' AND ProductID='".$ProductID."' AND SerialNo='".$Serial."' ");
	 }
	 
	 $activity_update=mysqli_query($con, "UPDATE product_info SET UpdateDate='".$Date."', UpdateBy='".$_SESSION['UserID']."'
		  WHERE ProductID='".$ProductID."' AND SerialNo='".$Serial."' ");
	 
     print "<script>alert('Successfully Deleted Image')</script>";
  
 }
 if(isset($_POST["btnSave"]))
 {
    $orderid=$_POST["orderid"];

	        $qrs=mysqli_query($con, "SELECT ImageID,orderid FROM product_image WHERE ProductID='".$ProductID."' AND SerialNo='".$Serial."'
			AND  type='".$_REQUEST["type"]."' ORDER BY orderid");
			$i=0;
			while($qrow=mysqli_fetch_row($qrs))
				{
					if($qrow[1] != $orderid[$i])
						{
						 $prs=mysqli_query($con, "UPDATE product_image SET orderid=".$orderid[$i]." 
						 WHERE ImageID='".$qrow[0]."' AND ProductID='".$ProductID."' AND  type='".$_REQUEST["type"]."' AND SerialNo='".$Serial."'");
						}	
					$i++;
				}
     $activity_update=mysqli_query($con, "UPDATE product_info SET UpdateDate='".$Date."', UpdateBy='".$_SESSION['UserID']."'
		  WHERE ProductID='".$ProductID."' AND SerialNo='".$Serial."'");
  
 }
 
$pdtID = substr($_REQUEST["ProductID"],0,8);
$colorID = substr($_REQUEST["ProductID"],8,3);

 $product_info=mysqli_fetch_row(mysqli_query($con, "SELECT
    product_info.ProductID
    , product_info.ProductName
    , product_style.StyleName
    , product_category_info.CategoryName
FROM
    product_info
    INNER JOIN product_style 
        ON (LEFT(product_info.ProductID,2) = product_style.StyleID)
    INNER JOIN product_category_info 
        ON (SUBSTRING(product_info.ProductID,3,2) = product_category_info.CategoryID)
WHERE product_info.ProductID='".$pdtID."'"));
$color = mysqli_fetch_row(mysqli_query($con, "SELECT ColorName,ColorCode FROM color_list WHERE ColorID='".$colorID."'"));
			
	$total_inserted_image=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(ImageID) FROM product_image
	 WHERE ProductID='".$ProductID."' AND SerialNo='".$Serial."' AND  type='".$_REQUEST["type"]."'"));
?>
<HTML>
<HEAD>

	<script src="color/js/jquery/jquery.js" type="text/javascript"></script>
	<script src="color/js/jquery/ifx.js" type="text/javascript"></script>
	<script src="color/js/jquery/idrop.js" type="text/javascript"></script>
	<script src="color/js/jquery/idrag.js" type="text/javascript"></script>
	<script src="color/js/jquery/iutil.js" type="text/javascript"></script>
	<script src="color/js/jquery/islider.js" type="text/javascript"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script src="color/js/jquery/color_picker/color_picker.js" type="text/javascript"></script>


	<link href="color/js/jquery/color_picker/color_picker.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
				function validation(thisform)
				{
					
				   with(thisform)
				   {
					  
					  if(validateFileExtension(file, "valid_msg", "image files are only allowed!",
					  new Array("jpg","pdf","jpeg","gif","png")) == false)
					  {
						 return false;
					  }
					  if(validateFileSize(file,102400, "valid_msg", "Image size should be less than 100KB !!!")==false)
					  {
						 return false;
					  }
				   }
				}
				
				function validateFileExtension(component,msg_id,msg,extns)
				{
				   var flag=0;
				   with(component)
				   {
					   if(component.value!="")
					   {
						  var ext=value.substring(value.lastIndexOf('.')+1);
						  for(i=0;i<extns.length;i++)
						  {
							 if(ext==extns[i])
							 {
								flag=0;
								break;
							 }
							 else
							 {
								flag=1;
							 }
						  }
					   }
					  if(flag!=0)
					  {
						 document.getElementById(msg_id).innerHTML=msg;
						 component.value="";
						 component.style.backgroundColor="#eab1b1";
						 component.style.border="thin solid #000000";
						 component.focus();
						 return false;
					  }
					  else
					  {
						 return true;
					  }
				   }
				   
				}
				function validateFileSize(component,maxSize,msg_id,msg)
				{
					if(component.value!="")
					{
						   if(navigator.appName=="Microsoft Internet Explorer")
						   {
							  if(component.value)
							  {
								 var oas=new ActiveXObject("Scripting.FileSystemObject");
								 var e=oas.getFile(component.value);
								 var size=e.size;
							  }
						   }
						   else
						   {
							  if(component.files[0]!=undefined)
							  {
								 size = component.files[0].size;
							  }
						   }
						   if(size!=undefined && size>=maxSize)
						   {
							  document.getElementById(msg_id).innerHTML=msg;
							  component.value="";
							  component.style.backgroundColor="#eab1b1";
							  component.style.border="thin solid #000000";
							  component.focus();
							  return false;
						   }
						   else
						   {
							  return true;
						   }
					}
					else
						return true;
				}
				
				/**********************************************************************************************/
				
				/***********************************************************************************************/
				</script>
                <script type="text/javascript">//&lt;![CDATA[ 
				// $(window).load(function(){
				// $('#file').change(function(e){
				// 	var files=this.files;
				// 	console.log(e,files);
				// 	for (var i=0; i < files.length; i++) {
				// 		var file=files[i];
				// 		var imageType=/image.*/;
						
				// 		if(!file.type.match(imageType)) {
				// 			continue;
				// 		}
						
				// 		var img=document.createElement("img");
				// 		img.classList.add("obj");
				// 		img.file=file;
				// 		$("#container").append(img);
				// 		var reader=new FileReader();
				// 		reader.onload=(function(aImg) {
				// 			return function(e) {
				// 				aImg.src=e.target.result;
				// 				aImg.addEventListener('load',function(){
				// 					var s=aImg.getBoundingClientRect();
				// 					alert(' Your Supported Size Is (600*1000)....Current Image Size is '+s.width+' x '+s.height+'!');
				// 					if(s.width >=600 && s.height >=1000)
				// 					{
				// 						document.getElementById("rony").disabled = false;
				// 					}
				// 					else
				// 					{
				// 						document.getElementById("rony").disabled = true;
				// 					}
				// 				});
				// 			};
				// 		})(img);
				// 		reader.readAsDataURL(file);
				// 	}
				// });
				// });
				//]]&gt;  

</script>
    <style type="text/css">
<!--
.style4 {color: #FFFFFF; font-weight: bold; }
-->
    </style>
	 <style type="text/css">
		.btnsdt
			{
			background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
			
			}
		.btnsdt1 {			background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			color:#FFFFFF;
			}
			.obj{
				visibility:hidden;
			}
			#container{
				width:0;
				height:0;
				visibility:hidden;
				overflow:hidden;
			}
     </style>
</HEAD>
<BODY>
<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="color_set" > <!--onSubmit="return validation(this)"> -->
<table width="489" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="65" colspan="4" align="center">
	<span style="font-size:20px; font-weight:bold; color:#000000;"><?php print $product_info[3]; ?> </span>
	  <input type="hidden" name="ProductID" value="<?php print $_REQUEST["ProductID"]; ?>"  />
	  <input type="hidden" name="type" value="<?php print $_REQUEST["type"]; ?>"  /></td>
  </tr>

  <tr>
    <td width="105" height="32" align="left" valign="top"><strong>Product Name </strong></td>
    <td colspan="3" valign="top"><strong>: <?php print $product_info[1]; ?></strong></td>
  </tr>
  <tr>
    <td height="31" align="left"><strong>Color Name</strong></td>
    <td colspan="3" align="left"><strong>: <?php print $color[0]; ?></strong></td>
  </tr>

  <tr>
    <td height="31" align="left"><strong>Upload Image </strong></td>
    <td colspan="3" align="left">
	    <strong>:
	      <input type="file" name="file"  id="file"/><br><label>(600px * 1000px)</label> 
	    </strong>
</td>
  </tr>
  <tr>
    <td height="58" align="center">&nbsp;</td>
    <td colspan="3" align="left">
	<?php
	 if($total_inserted_image[0]<'8')
	 {
	?>
	<input type="submit" name="btnAdd" class="btnsdt" id="rony" value="Update Image" />	
	<?php } ?>	<div id="valid_msg"/></td>
    </tr>

  <tr>
    <!-- <td height="28" align="center" bgcolor="#000000"><span class="style4">SL</span></td> -->
    <td width="153" align="center" bgcolor="#000000"><span class="style4">Image</span></td>
    <td width="136" align="center" bgcolor="#000000"><span class="style4">Ordering</span></td>
    <td width="95" align="center" bgcolor="#000000">&nbsp;</td>
  </tr>
  <?php
   $sl=0;
   $rs=mysqli_query($con, "SELECT ImageID,ProductID,SmallImage,orderid FROM product_image 
   WHERE ProductID='".substr($ProductID,0,8)."' AND SerialNo='".$Serial."' AND type='".$_REQUEST["type"]."' ORDER BY orderid");
   while($row=mysqli_fetch_row($rs))
   {
    $sl++;
	 if($sl%2==0)
	 {$bgcolor="bgcolor=\"#E3E9E9\"";}
	 else
	 {$bgcolor="bgcolor=\"#F0F2F5\"";}
  ?>
  <tr <?php print $bgcolor; ?>>
    <!-- <td height="30" align="center"><?php print $sl; ?>
      <input type="checkbox" name="id[]" value="<?php print $row[0]; ?>" />	  
  	</td> -->
    <td align="center">
	
	<img src="../productimage/<?php print $row[2]; ?>" width="50" height="40" style="padding:2px;">	</td>
    <td align="center"><input name="orderid[]" type="text" size="3" value="<?php print $row[3] ?>" /></td>
    <td align="center">&nbsp;</td>
  </tr>
 <?php } ?>

  <tr>
    <td height="37">&nbsp;</td>
    <!-- <td align="left"><input type="submit" name="btnDelete" class="btnsdt" value="Delete" /></td>
    <td  align="left"><input type="submit" name="btnSave" class="btnsdt" value="Update" /></td> -->
    </tr>
</table>
<div id="container"></div>
</form>
</BODY>
</HTML>