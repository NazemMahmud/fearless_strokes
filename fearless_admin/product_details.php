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
	 
  $uploadfolder = "../productimage/" ;
 if(isset($_POST["btnAdd"]))
 {
//     $rs=mysqli_fetch_row(mysqli_query($con, "SELECT ImageID,ProductID,BigImage,MidImage,SmallImage,orderid FROM product_image 
//                   WHERE ProductID='".$ProductID."' AND SerialNo='".$_REQUEST['serial']."' "));
     $ProductID=$_REQUEST["ProductID"];
     $Serial=$_REQUEST["serial"];
     $img_id = $_POST["imageid"];
     $bigimg=$_POST["bigimg"]; 
     $midimg=$_POST["midimg"]; 
     $smallimg=$_POST["smallimg"]; 
//	    $ImageID=MakeID($con, "product_image","ImageID","IMG-",20);
     $allowedfiletypes = array("jpeg","jpg","gif","png");
     $uploadfilename = $_FILES['photo']['name'];
     $fileext = strtolower(substr($uploadfilename,strrpos($uploadfilename,".")+1));
     if(!empty($uploadfilename) and !in_array($fileext,$allowedfiletypes)) 
     {
         print "<script>alert('Invalid Extension!');</script>";
     }
     else if(!empty($uploadfilename))
     {
         include("thumb.php") ;	
         @unlink($uploadfolder.$bigimg);
		 @unlink($uploadfolder.$midimg);
		 @unlink($uploadfolder.$smallimg);
         
         $file1 = $uploadfolder."img".$img_id.$_FILES['photo']['name'];
         if(move_uploaded_file($_FILES['photo']['tmp_name'], $file1)){
             
         }
         $ext=strtolower(substr(strrchr($file1,"."),1));
         $bigimg=$uploadfolder."big".$img_id.$_FILES['photo']['name'];
         $bigimgname="big".$img_id.$_FILES['photo']['name'];
         save_scaled($file1,$bigimg,$ext,1480,1952);
//         save_scaled($file1,$bigimg,$ext,600,500);
         
         $midimg=$uploadfolder."mid".$img_id.$_FILES['photo']['name'];
		 $midimgname="mid".$img_id.$_FILES['photo']['name'];
		 save_scaled($file1,$midimg,$ext,600,700);
//		 save_scaled($file1,$midimg,$ext,400,220);
						
         $smallimg=$uploadfolder."small".$img_id.$_FILES['photo']['name'];
         $smallimgname="small".$img_id.$_FILES['photo']['name'];
         save_scaled($file1,$smallimg,$ext,100,120);
         @unlink($file1);
         
//         $image=mysqli_fetch_row(mysqli_query($con, "SELECT BigImage,MidImage,SmallImage FROM product_image WHERE ImageID='".$img_id."' "));
//         echo "SELECT BigImage,MidImage,SmallImage FROM product_image WHERE ImageID='".$img_id."' ";
		 
						
//         $img_insert=mysqli_query($con, "INSERT INTO product_image (ImageID,ProductID,BigImage,MidImage,SmallImage,type,colorid) 
//					   VALUES('".$ImageID."','".$ProductID."','".$bigimgname."','".$midimgname."','".$smallimgname."','nocolor','')");
     }else{
         print "<script>alert('Please Upload an Image'); </script>";
     }
      $img_insert=mysqli_query($con, "UPDATE product_image SET 
					   BigImage ='".$bigimgname."' ,
                       MidImage ='".$midimgname."' ,
                       SmallImage = '".$smallimgname." ' 
                       WHERE ImageID='".$img_id."' AND ProductID='".$ProductID."'  ");
     
     echo $bigimgname;
     echo $midimgname;
     echo $smallimgname;
     echo 
         
         $activity_update=mysqli_query($con, "UPDATE product_info SET UpdateDate='".$Date."', UpdateBy='".$_SESSION['UserID']."'
								  WHERE ProductID='".$ProductID."'");
         if($img_insert){
             print "<script>alert('Successfully Inserted Image')</script>";
         }else{
             print "<script>alert('Problem')</script>";
         }
            
 }
 if(isset($_POST["btnDelete"]))
 {
    $id=$_POST["id"];
	 $idCOunt=count($id);
	 for($i=0;$i<$idCOunt;$i++)
	 {
	    $image=mysqli_fetch_row(mysqli_query($con, "SELECT BigImage,MidImage,SmallImage FROM product_image WHERE ImageID='".$id[$i]."' AND type='nocolor'"));
		@unlink($uploadfolder.$image[0]);
		@unlink($uploadfolder.$image[1]);
		@unlink($uploadfolder.$image[2]);
		$del=mysqli_query($con, "DELETE FROM product_image WHERE ImageID='".$id[$i]."' AND ProductID='".$ProductID."'");
	 }
	 
	 $activity_update=mysqli_query($con, "UPDATE product_info SET UpdateDate='".$Date."', UpdateBy='".$_SESSION['UserID']."'
		  WHERE ProductID='".$ProductID."'");
	 
     print "<script>alert('Successfully Deleted Image')</script>";
  
 }
 if(isset($_POST["btnSave"]))
 {
    $id=$_POST["pdtids"];
    $idCOunt = count($id);
	  
			 for($i=0;$i<$idCOunt;$i++)
	           {
					 $sql = "UPDATE product_details SET Qty='".$_POST["qty"][$i]."' WHERE ProductFullID='".$id[$i]."'";
						 $prs=mysqli_query($con, "$sql");
					
				}
    
  
 }
 
 $product_info=mysqli_fetch_row(mysqli_query($con, "SELECT
    product_info.ProductID
    , product_info.ProductName
    , product_style.StyleName
    , product_category_info.CategoryName
	, product_info.Brand
    , product_info.Price
	, SUM(product_details.Qty)
FROM

    product_info
    INNER JOIN product_style 
        ON (LEFT(product_info.ProductID,2) = product_style.StyleID)
	INNER JOIN product_details
		ON(product_info.SerialNo = product_details.SerialNo)
    INNER JOIN product_category_info 
        ON (SUBSTRING(product_info.ProductID,3,2) = product_category_info.CategoryID)
WHERE product_info.ProductID='".$_REQUEST["ProductID"]."' AND product_info.SerialNo='".$_REQUEST["serial"]."'"));

//     product_info.ProductID, product_info.ProductName, product_style.StyleName, 
//     CONCAT(product_category_info.CategoryName
//     ,' > ', product_sub_category.SubCategoryName
//     ,' > ', product_ssub_category.SubCategoryName)
// 	, product_info.Brand, product_info.Price, SUM(product_details.Qty)
// FROM  product_info INNER JOIN product_ssub_category ON (RIGHT(product_info.ProductID,3) = product_ssub_category.SubSubCategoryID) INNER JOIN product_style 
//         ON (LEFT(product_info.ProductID,2) = product_style.StyleID)
// 	INNER JOIN product_details ON(product_info.SerialNo = product_details.SerialNo)
//     INNER JOIN product_sub_category  ON (product_ssub_category.SubCategoryID = product_sub_category.SubCategoryID)
//     INNER JOIN product_category_info ON (product_sub_category.CategoryID = product_category_info.CategoryID) WHERE product_info.ProductID='".$_REQUEST["ProductID"]."'"));

				  
	$total_inserted_image=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(ImageID) FROM product_image
	 WHERE ProductID='".$ProductID."' AND type='nocolor'"));
?>
<HTML>
<HEAD>

	<script src="color/js/jquery/jquery.js" type="text/javascript"></script>
	<script src="color/js/jquery/ifx.js" type="text/javascript"></script>
	<script src="color/js/jquery/idrop.js" type="text/javascript"></script>
	<script src="color/js/jquery/idrag.js" type="text/javascript"></script>
	<script src="color/js/jquery/iutil.js" type="text/javascript"></script>
	<script src="color/js/jquery/islider.js" type="text/javascript"></script>

	<script src="color/js/jquery/color_picker/color_picker.js" type="text/javascript"></script>

    <!--    now added start                   -->
    <script src="resources/scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
		<!--[if IE]><script language="javascript" type="text/javascript" src="resources/scripts/excanvas.min.js"></script><![endif]-->
		<script src="resources/scripts/jquery-ui-1.8.custom.min.js" type="text/javascript"></script>
		<script src="resources/scripts/jquery.ui.selectmenu.js" type="text/javascript"></script>
		<script src="resources/scripts/jquery.flot.min.js" type="text/javascript"></script>
		<script src="resources/scripts/tiny_mce/jquery.tinymce.js" type="text/javascript"></script>
    
    
    <script src="resources/scripts/smooth.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.menu.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.chart.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.table.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.form.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.dialog.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.autocomplete.js" type="text/javascript"></script>
    
    <script type="text/javascript" src="jwysiwyg-master/lib/jquery1.5.js"></script>
    <script type="text/javascript" src="jwysiwyg-master/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="jwysiwyg-master/controls/plugins/wysiwyg.autoload.js"></script>
    <script type="text/javascript" src="jwysiwyg-master/controls/wysiwyg.image.js"></script>
    <script type="text/javascript" src="jwysiwyg-master/controls/wysiwyg.link.js"></script>
    <script type="text/javascript" src="jwysiwyg-master/controls/wysiwyg.table.js"></script>

    
<!--    now added end      

	<link href="color/js/jquery/color_picker/color_picker.css" rel="stylesheet" type="text/css">

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
     </style>
</HEAD>
<BODY>
	<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="color_set">
        <input type="hidden" name="serial" value="<?php echo $_REQUEST["ProductID"] ?>" >
        <input type="hidden" name="ProductID" value="<?php echo $_REQUEST["serial"]?>" >
		<table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
		    <td height="45" colspan="4" align="center">
			<span style="font-size:20px; font-weight:bold; color:#000000;"><?php print $product_info[3]; ?> </span>
			  <input type="hidden" name="ProductID" value="<?php print $_REQUEST["ProductID"]; ?>"  />  	  
		      <input type="hidden" name="serial" value="<?php print $_REQUEST["serial"]; ?>"  /></td>
		  </tr>

		  <tr>
		    <td width="105" height="24" align="left" valign="top"><strong>Product Name </strong></td>
		    <td colspan="3" valign="top"><strong>: <?php print $product_info[1]; ?></strong></td>
		  </tr>
		 <tr>
		    <td width="105" height="22" align="left" valign="top"><strong>Product Style </strong></td>
		    <td colspan="3" valign="top"><strong>: <?php print $product_info[2]; ?></strong></td>
		  </tr>
		  <!-- <tr>
		    <td height="24" align="center"><strong>Product</strong> <strong>Brand</strong></td>
		    <td colspan="3" align="left"><strong>: <?php print $product_info[4]; ?></strong></td>
		  </tr> -->
		  <tr>
		    <td height="24" align="left"><strong>Total Quantity</strong></td>
		    <td colspan="3" align="left"><strong>: <?php print $product_info[6]; ?></strong></td>
		  </tr>
		  <tr>
		    <td height="24" align="left"><strong>Product</strong> <strong>Price</strong></td>
		    <td colspan="3" align="left"><strong>: <?php print $product_info[5]; ?></strong></td>
		  </tr>
		  <tr>
		    <td height="19" align="left">&nbsp;</td>
		    <td colspan="3" align="left">&nbsp;</td>
		    </tr>

		  <tr>
		    <td height="28" align="center" bgcolor="#000000"><span class="style4">ID</span></td>
		    <td width="153" align="center" bgcolor="#000000"><span class="style4">COLOR</span></td>
		    <td width="136" align="center" bgcolor="#000000"><span class="style4">SIZE</span></td>
		    <td width="136" align="center" bgcolor="#000000"><span class="style4">QTY</span></td>
		  </tr>
		  <?php
		   $sl=0;
		   $rs= mysqli_query($con, "SELECT
		     product_details.ProductFullID
		    , color_list.ColorName
		    , color_list.ColorCode
		    , product_unit.UnitName
		    , product_details.Qty
			FROM
			   product_details
			    INNER JOIN color_list 
			        ON (SUBSTR(product_details.ProductFullID,9,3) = color_list.ColorID)
			    INNER JOIN product_unit 
			        ON (RIGHT(product_details.ProductFullID,2) = product_unit.UnitID)
			WHERE product_details.SerialNo='".$_REQUEST["serial"]."'
			ORDER BY product_details.ProductFullID");
		  $matching = 0;
//            $serial = $_REQUEST["serial"];
		   while($row=mysqli_fetch_row($rs))
		   {
		    if(substr($row[0],0,11) != $matching)
			{
			  $matching = substr($row[0],0,11);	
                $serial = $_REQUEST["serial"];
//                echo $serial;
//			   echo "<tr>
//		    <td height=\"30\" align=\"left\" colspan=\"4\"><a href=\"#\" onclick=\"window.open('color_image_setting.php?serial=".$serial."&ProductID=".$matching."&type=color','color_image_setting','width=600px, height=500px, scrollbars=1, left=400px, top=100px');\">Update Images for ".$row[1]."</a> </td>
//
//		    </tr>";
			}
			$sl++;
			 if($sl%2==0)
			 {$bgcolor="bgcolor=\"#E3E9E9\"";}
			 else
			 {$bgcolor="bgcolor=\"#F0F2F5\"";}
		  ?>
		   
		  <tr <?php print $bgcolor; ?>>
		    <td height="30" align="center"><?php echo $row[0]; ?></td>
		    <td align="center"><?php echo $row[1]; ?></td>
		    <td align="center">
		    <?php echo $row[3]; ?>
		    <input type="hidden" name="pdtids[]" value="<?php echo $row[0]; ?>">
		    </td>
		    <td align="center" ><input type="text" size="4" name="qty[]" value="<?php echo $row[4]; ?>"></td>
              
		  </tr>
		 <?php } ?>

		  <!-- <tr>
		    <td height="37">&nbsp;</td>
		    <td colspan="2" align="center"><input type="submit" name="btnSave" id="btnSave" value="Update Qty"></td>
		    <td align="left">&nbsp;</td>
		    </tr> -->

		</table>
        <table width="489" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr> <td height="27">&nbsp;</td> </tr>
            <tr>
                <!-- <td height="28" align="center" bgcolor="#000000"><span class="style4">SL</span></td> -->
                <td height="31" align="left"><strong>Image :</strong></td>
                <?php
//                   $sl=0;
                   $rs=mysqli_query($con, "SELECT ImageID,ProductID,BigImage,MidImage,SmallImage,orderid FROM product_image 
                   WHERE ProductID='".$ProductID."' AND SerialNo='".$_REQUEST['serial']."' ");
                   while($row=mysqli_fetch_row($rs))
                   {
//                    $sl++;
//                     if($sl%2==0)
//                     {$bgcolor="bgcolor=\"#E3E9E9\"";}
//                     else
//                     {$bgcolor="bgcolor=\"#F0F2F5\"";}
                  ?>
<!--                  <tr <?php // print $bgcolor; ?>>-->
                    <td align="center"> 
                        <img src="../productimage/<?php print $row[4]; ?>" width="70" height="60" style="padding:2px;">	
                        <input type="hidden" name="imageid" value="<?php echo $row[0];?>" >
                        <input id="bigimg" name="bigimg" type="hidden" value="<?php print $row[2]; ?>">
                        <input id="midimg" name="midimg" type="hidden" value="<?php print $row[3]; ?>">
                        <input id="smallimg" name="smallimg" type="hidden" value="<?php print $row[4]; ?>">
                    </td>
        <!--            <td align="center"><input name="orderid[]" type="text" size="3" value="<?php print $row[3] ?>" /></td>-->
                    <td align="center">&nbsp;</td>
<!--                  </tr>-->
                <?php } ?>
            </tr>
          

          <tr> <td height="20">&nbsp;</td> </tr>
            <tr>
                <td height="31" align="left"><strong>Upload Image :</strong><br><label>not less than<br>(1200px * 1583px)</label></td>
                <td colspan="3" align="left">
                    <input type="file" name="photo" class="fileToUpload"  id="file" required />&nbsp; 
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
        </table>
	</form>
    <script type="text/javascript">
        var _URL = window.URL || window.webkitURL;
	    $(".fileToUpload").change(function(e) {
	                  // alert("sdasd");
            var image, fileToUpload;
	        if ((fileToUpload = this.files[0])) {
	                     // alert("sdasd");
	           image = new Image();
	           image.onload = function() {
	                     // alert("sdasd");
                   if(this.width < 1200 || this.height<1583){
                       $(".fileToUpload").val('');
                       alert("The image size must not be less than 1200 X 1583");
                   }
	           };
	
	           image.src = _URL.createObjectURL(fileToUpload);
	       }
	   });
    </script>
	                
            
</BODY>
</HTML>