<?php
		session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
		include("connection.php");
	

	   if( isset($_POST["primary_id_container"]) && $_POST["primary_id_container"]!="")
	   {
	    	$uploadfolder = "../productimage/hj" ;
	       	include("thumb.php") ;
		   
		  // echo $_POST["ProductCategoryID"];
		// $ProductID=MakeID($con, "product_info","ProductID","PDT-",15);
		 	$Date=MakeDate();
		 	$SerialNo = $_REQUEST["SerialNo"];
 
			$sql = "UPDATE hj_product_info SET 
				 ProductName='".end_quote_send($_POST["ProductName"])."',
				 Price='".$_POST["ProductPrice"]."', 
				 Discount='".$_POST["ProductDiscount"]."',
				 Description='".end_quote_send($_POST["ProductFeatures"])."',
				 
	                          UpdateDate='".$Date."',
				 UpdateBy='".$_SESSION["UserID"]."',
				 FeaturedStatus=".$_POST["FeaturedProduct"]."
				 WHERE SerialNo='".$SerialNo."'";
			$update=mysqli_query($con, "$sql");	
			 
			$delete_product_details = mysqli_query($con, "DELETE FROM hj_product_details WHERE SerialNo=".$SerialNo."");
			$total_db_size = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(UnitID) FROM product_unit"));
			for($i =1; $i<= $_POST["ColorCount"]; $i++)
			{
				for($j=1; $j<=$total_db_size[0]; $j++)
				{
						$id = "id".$i.$j;
						if($_POST[$id] != "")
						{
						$qty = "qty".$i.$j;
						$id = $_POST[$id];
						$qty = $_POST[$qty];
						mysqli_query($con,  "INSERT INTO hj_product_details(ProductFullID,SerialNo,Qty) VALUES('".$id."',".$SerialNo.",".$qty.")");  
						}
				}
			}

					if($update)
					 {
					  
						header("Location:hj_edit_product1.php?msg=Product Successfully Updated!&SerialNo=$SerialNo");
							die();
					  
					 }
					 else
					 {
					   header("Location:hj_edit_product1.php?msg=Product Insertion Failed! Try Again...&SerialNo=$SerialNo");
			            die();
					 }
			
		   }
		
	$data = mysqli_fetch_row(mysqli_query($con, "SELECT ProductName,Price,Discount,Description,FeaturedStatus,ProductID
										  FROM hj_product_info WHERE SerialNo=".$_REQUEST["SerialNo"].""));
	$_REQUEST["ProductID"] = $data[5];	
	$collectibles_style = "";
	$non_collectibles_style = "";
//	if(substr($data[5],2,1) != 3)
//	{
	$collectibles_style = "style=\"display:none;\"";
	$scq = mysqli_query($con, "SELECT COUNT(ProductFullID),ProductFullID FROM hj_product_details
		 WHERE SerialNo=".$_REQUEST["SerialNo"]." GROUP BY SUBSTR(ProductFullID,1,7)");
	 $color_count = mysqli_num_rows($scq);
	 $total_size_count = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(UnitID) FROM product_unit WHERE ActiveStatus='Active'"));
//	}
//	else if(substr($data[5],2,1) == 3)
	//{
//		$non_collectibles_style = "style=\"display:none;\"";
	//}
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo $site_name; ?></title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<!-- stylesheets -->
		<link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="resources/css/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="resources/css/style_fixed.css" />
		<link id="color" rel="stylesheet" type="text/css" href="resources/css/colors/<?php echo $theme_color; ?>.css" />

		<!-- scripts (jquery) -->
                <link rel="stylesheet" type="text/css" href="jwysiwyg-master/lib/blueprint/screen.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="jwysiwyg-master/lib/blueprint/print.css" media="print" />
<!--[if lt IE 8]><link rel="stylesheet" href="../lib/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
<link rel="stylesheet" href="jwysiwyg-master/jquery.wysiwyg.css" type="text/css"/>
<script type="text/javascript" src="jwysiwyg-master/lib/jquery1.5.js"></script>
<script type="text/javascript" src="jwysiwyg-master/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="jwysiwyg-master/controls/plugins/wysiwyg.autoload.js"></script>
<script type="text/javascript" src="jwysiwyg-master/controls/wysiwyg.image.js"></script>
<script type="text/javascript" src="jwysiwyg-master/controls/wysiwyg.link.js"></script>
<script type="text/javascript" src="jwysiwyg-master/controls/wysiwyg.table.js"></script>
<script type="text/javascript">
(function ($) {
	$(document).ready(function () {
		$("textarea").wysiwyg({
			plugins: { autoload: true },
			autoGrow: true,
			maxHeight: 600,
			initialContent: " "
		});
	});
})(jQuery);
</script>
		<script src="resources/scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
		<!--[if IE]><script language="javascript" type="text/javascript" src="resources/scripts/excanvas.min.js"></script><![endif]-->
		<script src="resources/scripts/jquery-ui-1.8.custom.min.js" type="text/javascript"></script>
		<script src="resources/scripts/jquery.ui.selectmenu.js" type="text/javascript"></script>
		<script src="resources/scripts/jquery.flot.min.js" type="text/javascript"></script>
		<script src="resources/scripts/tiny_mce/jquery.tinymce.js" type="text/javascript"></script>
		<!-- scripts (custom) -->
		<script src="resources/scripts/smooth.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.menu.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.chart.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.table.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.form.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.dialog.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.autocomplete.js" type="text/javascript"></script>
	         <script type="text/javascript">
		 	function subCategory(searchCode)
			  {
				  set_primary_id();
			    document.getElementById('cattype').value="cat";
				document.getElementById('TakeID').value=searchCode;	
				//alert(''+$('#ProductCategoryID').val());
				if($('#ProductCategoryID').val() == '3')
				{
				 $('#set_dimension').show();
				 $('#set_stock').show();
				 $('#set_images').show();
				 $('#size_color_qty_option').hide();	
				}
				else
				{
					$('#set_dimension').hide();
				    $('#set_stock').hide();
					$('#size_color_qty_option').show();
					$('#set_images').hide();
					
				}
			   $.post("LookUp.php",{ func: "PDTCAT", src: searchCode},
			   function(data)
			   {
			     //alert(''+data.SSSSS);
			   $('#subcatpro').html(data.SSSSS);
			   
			   <!--$('#pdtsize').html(data.TTTTT);-->
			   },"json")
			   
			   
			   	
			  }
			function subsubCategory(searchCode)
			  {
			   set_primary_id();
			   $.post("LookUp.php",{ func: "PDTSUBCAT", src: searchCode},
			   function(data)
			   {
			   $('#subsubcatpro').html(data.SSSSS);
			   <!--$('#pdtsize').html(data.TTTTT);-->
			   },"json")
			   
			   document.getElementById('cattype').value="scat";
			   document.getElementById('TakeID').value=document.getElementById('ProductSubCategoryID').value;	
			  }
			function subsubSize(searchCode)
			  {
			   
			   $.post("LookUp.php",{ func: "PDTSUBSIZE", src: searchCode},
			   function(data)
			   {
			   <!--$('#pdtsize').html(data.SSSSS);-->
			   },"json")
			   
			   document.getElementById('cattype').value="sscat";
			   document.getElementById('TakeID').value=document.getElementById('ProductSubSubCategoryID').value;
			   	
			  }
			 function chk_validity(searchCode)
			  {
			   //alert(''+searchCode);
			   $.post("LookUp.php",{ func: "SKU", src: searchCode},
			   function(data)
			   {
			    // alert(''+data.TTTTT);
				 $('#ysku').html(data.SSSSS);
				 $('#SKU').val(data.TTTTT);
			   },"json")
			   
			  }
			 function set_primary_id()
			 {
			  // var pdtartist = $('#ProductArtistID').val();
			   var pdtstyle = $('#ProductStyleID').val();
			   var pdtcategory = $('#ProductCategoryID').val();
//			   var pdtscategory = $('#ProductSubCategoryID').val();
//			   var pdtsscategory = $('#ProductSubSubCategoryID').val();
			   var primary_id = pdtstyle+''+pdtcategory; //+''+pdtsscategory;
			     $('#primary_id_container').val(primary_id);
			   	 
			 }
			 function add_more_function()
			  {
				
				  var ColorCount = $('#ColorCount').val();
				 // alert(ColorCount);
				  var deleterow = "delete"+ColorCount;
				  ColorCount ++; 
				  var primary_id = $('#primary_id_container').val(); 
				   if(primary_id != "" && primary_id.length == 4)
				   {
				   $.post("LookUp.php",{ func: "ADDMOREEDIT", src: ColorCount, primary_id: primary_id },
					   function(data)
					   {
						//alert(deleterow+''+data.TTTTT);
						$('#ColorCount').val(ColorCount);
						// id = "id"+ColorCount;
						// qty = "qty"+ColorCount;
						$('#size_color_qty').append(data.SSSSS);
						
						document.getElementById('lastsize_id_qty_count').value = data.TTTTT;
						document.getElementById(deleterow).style.display = "none";
					   },"json")
				   }
				   else
				   {
					alert('Plz Select style, category, sub category, sub sub category');   
				   }
			  }
			 function idchange(number)
			  {
				
				var lastsize_id_qty_count = $('#lastsize_id_qty_count').val();
//                  document.write(lastsize_id_qty_count);
				var primary_id = $('#primary_id_container').val(); 
				var color  = "color"+number; 
				     color = document.getElementById(color).value;
					 
				var size  = "size"+number; 
				var id  = "id"+number; 
				var id_running,size_running;
				var myDiv = "div"+number;
				if(color != "")
				{
					for(var i=1; i<=lastsize_id_qty_count; i++)
					{
					  id_running = id+""+i;
					  size_running = size+""+i;
					  if( document.getElementById(size_running).checked == true)
					  {
						 size_running = document.getElementById(size_running).value;
						 document.getElementById(id_running).value = primary_id+""+color+""+size_running;  
					  }
					  else
					  {
						 document.getElementById(id_running).value = "";   
					  }
					 
					}
				 document.getElementById(myDiv).style.border="none";
				}
				else
				{
				 alert("Please Select Color");	
				}
				 
			  }
			 function all_check()
			  {
			     var productID = $('#primary_id_container').val();
			     
//				 if(document.getElementById("BatchLot").value=="")
//				 {
//				  alert("Please Enter Batch/Lot Number");
//				  document.getElementById("BatchLot").focus();
//				  return false;
//				 }
				 if( productID.length < 4)
				 {
				  alert("Please Select Product Style, Category, Sub Category and Sub sub Category");
				  document.getElementById("ProductCategoryID").focus();
				  return false;
				 }
				 if(document.getElementById("ProductName").value=="")
				 {
				  alert("Please Enter Product Name");
				  document.getElementById("ProductName").focus();
				  return false;
				 }
				 if(document.getElementById("ProductPrice").value=="")
				 {
				  alert("Please Enter Product Trade Price");
				  document.getElementById("ProductPrice").focus();
				  return false;
				 }
				// if(document.getElementById("ProductCategoryID").value!=4)
//				 {
//						 var id
//						  var value_temporary
//						   var ColorCount = $('#ColorCount').val();
//						   var thiscount = 0;
//						  for(var i=1; i <= ColorCount; i++)
//						  {
//							   thiscount++;
//							  id = "id"+i;
//							  myDiv = "div"+i;
//							  value_temporary = document.getElementById(id).value;
//							  if(value_temporary.length < 13)
//							  {
//							  alert("Please Correct this id");  
//							  document.getElementById(myDiv).style.border="thin solid #f40";
//							   return false;
//							  break;
//							  }
//						  } 
//						  if(thiscount == 0)
//						  {
//							 alert("Please add color, size, qty");  
//							  return false;
//						  } 
//						 
//				 }
				 
				 if(document.getElementById("ProductFeatures").value=="")
				 {
				  alert("Please Enter Product Features");
				  document.getElementById("ProductFeatures").focus();
				   return false;
				 }
				 else
				 {
				  //alert('aaaaaaaaaaaaa');
				  document.product_form.submit();
				 }
				 
				 
			  }
			  function check_ids()
			  {
				  var id
				  var value_temporary
				   var ColorCount = $('#ColorCount').val();
				   var thiscount = 0;
				  for(var i=1; i <= ColorCount; i++)
				  {
					   thiscount++;
					  id = "id"+i;
					  myDiv = "div"+i;
					  value_temporary = document.getElementById(id).value;
					  if(value_temporary.length < 13)
					  {
					  alert("Please Correct this id");  
					  document.getElementById(myDiv).style.border="thin solid #f40";
					  break;
					  }
				  } 
				  if(thiscount == 0)
				  {
					 alert("Please add color, size, qty");  
				  } 
			  }
			  function delete_row(id)
			  {
				  var div = document.getElementById("div" + id);
                        div.parentNode.removeChild(div);
					var colorcount = $('#ColorCount').val();
					colorcount = colorcount-1;
					document.getElementById("ColorCount").value = colorcount;
					$('#delete'+colorcount).show();
			  }

            
             </script>
         <style type="text/css">
		.btnsdt
			{
			background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			
			
			}
		.wysiwyg{width:400px;}
		
#content div.box li {
    font-size: 12px;
    padding: 0;
}
		</style>
	     <script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
         </script>
		 
		 <script type="text/javascript">
		 function window_popup()
		 {
		   var type=$('#cattype').val();
		   //alert(type);
		   var ID=($('#TakeID').val());
		  var a=window.open("color_set_in_product.php?ID="+ID+"&cattype="+type+"","color_set_in_product","width=600px, height=500px, scrollbars=1, left=200px, top=100px");
		 }
		 </script>
	</head>
	<body>
		
		<!-- dialogs -->
		<div id="dialog-form" title="Create new user">
		  <p>&nbsp;</p>
		</div>
		<!-- end dialogs -->
		<!-- header -->
		<?php  
		 include("header.php");
		?>
		<!-- end header -->
		<!-- content -->
		<div id="content">
			<!-- end content / left -->
			<div id="left">
				<div id="menu">
					<?php include("navigation.php"); ?>
				</div>
				
      </div>
			<!-- end content / left -->
			<!-- content / right -->
		<div id="right">
				<!-- table -->
				<div class="box">
					<!-- box / title -->
					<div class="title">
						<h5><?php print isset($_REQUEST['msg'])?$_REQUEST['msg']:"Edit Product"; ?></h5>
						<div class="search">
							
						</div>
					</div>
					<!-- end box / title -->
					
					
					<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="product_form" method="post" enctype="multipart/form-data">
						<div class="form">
						<div class="fields">
<!-- batch/lot lagbe na
						
-->
                        
                            
                       <div class="field">
                           <div class="label">
									<label for="input-medium">  Style:</label>
                           </div>
					    <div class="input" >
                            <select name="ProductStyleID" id="ProductStyleID" onchange="set_primary_id();" disabled="disabled">
                                  
								  <?php
								   $style=mysqli_query($con, "SELECT StyleID,StyleName FROM product_style WHERE ActiveStatus = 1");
								   while($styleRow=mysqli_fetch_row($style))
								   {
									   if($styleRow[0] == substr($_REQUEST["ProductID"],0,2))
									   {
								  ?>
                                  
                                  <option value="<?php print $styleRow[0]; ?>" selected="selected"><?php print $styleRow[1]; ?></option>
                                  <?php }
								     else
									 {
								   ?>
                                  
                                  <option value="<?php print $styleRow[0]; ?>"><?php print $styleRow[1]; ?></option>
								  <?php
								  }}
								  ?>
                            </select>
								
							<span style="float:right; padding-left:10px;">
                            <input style="height:18px; padding:0; text-align:center;" name="primary_id_container" type="text" size="10" readonly="readonly" id="primary_id_container" value="<?php echo substr($_REQUEST["ProductID"],0); ?>"></span>    
					    </div>
					  </div>
                            
					  <div class="field">
                          <div class="label">
									<label for="input-medium">  Category:</label>
                          </div>
					      <div class="input">
			                 <select name="ProductCategoryID" id="ProductCategoryID" disabled="disabled"  >
                                  <option value="">Select Product Category</option>
								  <?php
								   $cat=mysqli_query($con, "SELECT  category_id,category_name FROM hj_category_info 
								   ORDER BY orderid");
								   while($catRow=mysqli_fetch_row($cat))
								   {
									   if(substr($data[5],2,2) == $catRow[0])
									   { 
								  ?>
                               <option value="<?php print $catRow[0]; ?>" selected="selected"><?php print $catRow[1]; ?></option>
                                  <?php }
							         else
									 {
							      ?>
                                  <option value="<?php print $catRow[0]; ?>" ><?php print $catRow[1]; ?></option>
								  <?php
								  }}
								  ?>
                            </select>
								<input type="hidden" name="cattype" id="cattype" value="" />
								<input type="hidden" name="TakeID" id="TakeID" value="" />
							    
			              <input type="hidden" name="SerialNo" id="SerialNo" value="<?php echo $_REQUEST["SerialNo"]; ?>" />
					    </div>
					  </div>
<!-- sub category lagbe na

-->
<!-- sub sub category lagbe na
-->
							<div class="field">
								<div class="label">
									<label for="input-medium">  Name:</label>
								</div>
								<div class="input">
									<input id="ProductName" name="ProductName" value="<?php echo $data[0]; ?>" class="small valid" type="text">
								</div>
							</div>
							<input type="hidden" name="ColorCount" id="ColorCount" value="<?php echo $color_count; ?>" />
                            <input type="hidden" name="lastsize_id_qty_count" id="lastsize_id_qty_count" value="<?php echo $total_size_count[0]; ?>" />
                            
<!-- brand lagbe na
                            <div class="field">
                                <div class="label">
                                        <label for="input-large"> Brand :</label>
                                </div>
                                <div class="input">
                                    <input id="ProductBrand" name="ProductBrand" value="<?php echo $data[1]; ?>" class="small valid" type="text" />
                                    <input type="hidden" name="ColorCount" id="ColorCount" value="<?php echo $color_count; ?>" />
                                    <input type="hidden" name="lastsize_id_qty_count" id="lastsize_id_qty_count" value="<?php echo $total_size_count[0]; ?>" />
                              </div>
                            </div>
-->
                            
					 <div class="field" id="size_color_qty_option" <?php echo $non_collectibles_style; ?>>
                        <div  style="width:100%;" id="size_color_qty">
                            <a href="#"  onclick="window.open('hj_product_details.php?ProductID=<?php print $data[5] ?>&serial=<?php print $_REQUEST["SerialNo"] ?>','product_details','width=800px, height=700px, scrollbars=1, left=200px, top=50px');">Image Settings with Details</a>

                                   <?php
                                        $sdt = 0;
                                         $VALUE = "";
                                 while($scq_row = mysqli_fetch_row($scq)) // from 106 line product details table theke productfullid neyar jonno
                                   {
                                       $sdt++;
//                                        echo $sdt.' : '.$sdt.' ';

                                       $srcText = $sdt;
                                             $color = "color".$srcText;
                                             $size = "size".$srcText;
                                             $qty = "qty".$srcText;
                                             $id = "id".$srcText;
                                             $delete = "delete".$srcText;
                                             $div_id = "div".$srcText;
//                                     echo 'text: '.$srcText.'\n';
//                                     echo '$color: '.$color.'\n';
//                                     echo '$size: '.$size.'\n ';
//                                     echo '$qty: '.$qty.' \n';
//                                     echo '$delete: '.$delete.'\n ';
//                                     echo '$div_id: '.$div_id.'\n ';
                              



                                                $VALUE .="<div id='".$div_id."' style='padding-top:10px;' ><span>Color : &nbsp;</span>";
                                                $VALUE .=" <span>";
                                                $VALUE .="<select name='".$color."' id='".$color."' onchange='idchange(".$srcText.")'>";
                                                $VALUE .="<option value=''>Select Color</option>";
                                                $color_rs = mysqli_query($con, "SELECT ColorID,ColorName FROM color_list");
                                                 $i = 0;
                                                while($color_row = mysqli_fetch_row($color_rs))
                                                {
                                                   if(substr($scq_row[1],-5,3) == $color_row[0]) // color match for selected; done
                                                    {
                                                   $VALUE .="<option value='".$color_row[0]."' selected='selected'>".$color_row[1]."</option>";
                                                    }
                                                    else
                                                    {
                                                    $VALUE .="<option value='".$color_row[0]."'>".$color_row[1]."</option>";	
                                                    }
                                                }
                                                $VALUE .="</select> </span>";

                                                if($srcText != $color_count)
                                                {
                                                $VALUE .="<span id='".$delete."' style='display:none;' >&nbsp;&nbsp;<img src='actionimage/icon_delete.gif' title='delete this row'                                   onclick='delete_row($srcText)'></span>";
                                                }
                                                else if($srcText == $color_count)
                                                {
                                                $VALUE .="<span id='".$delete."' >&nbsp;&nbsp;<img src='actionimage/icon_delete.gif' title='delete this row' onclick='delete_row($srcText)'></span>";
                                                }
                                                   $size_rs = mysqli_query($con, "SELECT UnitID,UnitName FROM product_unit ORDER BY UnitID DESC");
                                                 $j = 0;
                                                 $size_id_qty_count = 0;
                                               while($size_row = mysqli_fetch_row($size_rs))
                                                {
                                                    $VALUE .="<br><br>&nbsp;&nbsp;";
                                                    $size_id_qty_count++;
                                                    $size_id_qty_size =  $size.$size_id_qty_count;
                                                    $size_id_qty_qty =  $qty.$size_id_qty_count;
                                                    $size_id_qty_id =  $id.$size_id_qty_count;
                                                       $chk_size = mysqli_fetch_row(mysqli_query($con, "SELECT ProductFullID,Qty
                                                        FROM hj_product_details WHERE ProductFullID='".$_REQUEST["ProductID"].substr($scq_row[1],-5,3).$size_row[0]."'")); // COUNT(ProductFullID),ProductFullID; ProductID.productfullid theke color er 3ta digit.unit size er digit
//                                                   echo $chk_size[0];
                                                      if($chk_size[0] != ""){
                                                          
                                                      $check_set = "checked='checked'";
                                                      }
                                                      else
                                                      $check_set = "";

                                                    $VALUE .="<div><div style='width:70px;'><span>$size_row[1]&nbsp;";
                                                    $VALUE .="<input onchange='idchange(".$srcText.")' $check_set type='checkbox' name='$size_id_qty_size' id='$size_id_qty_size' value='$size_row[0]' ></span></div>";
                                                    $VALUE .="<div style=' margin-left: 70px;margin-top: -20px;width: 300px;'> <span>&nbsp;&nbsp;Qty: &nbsp;</span> <span>";
                                                   if($chk_size[1]!=""){
                                                       $VALUE .="<input type='text' value='$chk_size[1]' name='$size_id_qty_qty' id='$size_id_qty_qty' size='4'></span>";
                                                   }else{
                                                      $VALUE .="<input type='text' value='1' name='$size_id_qty_qty' id='$size_id_qty_qty' size='4'></span>"; 
                                                   }
                                                   
                                                    

                                                    $VALUE .=" <span>ID :&nbsp;</span><span><input value='$chk_size[0]' readonly type='text' name='$size_id_qty_id' id='$size_id_qty_id' size='13'></span></div></div>";
                                                                        $VALUE .="<br>&nbsp;&nbsp;";

                                                }

                                             // $id_value = $primary_id.$first_color_id.$first_size_id;



                                                 $VALUE .= "</div><br>";
                                 }
                                                echo $VALUE;	
                                                  ?>
                         
                          </div>
                            <div style="padding-top:10px;"><a href="#" onclick="add_more_function();">Add Product Size,Color,Qty</a></div>
                         
                         
					  </div>
                     
                      <div class="field" id="set_images" <?php echo $collectibles_style; ?>>
								
									<span style="font-weight:bold; color:#000;">
                                    <a href="#" onclick="window.open('nocolor_image_setting.php?ProductID=<?php print $data[5] ?>&type=insert','nocolor_image_setting','width=600px, height=500px, scrollbars=1, left=200px, top=100px');">Image Settings</a>
                                    </span>
								
								
							</div> 
                     <div class="field" id="set_dimension" <?php echo $collectibles_style; ?>>
								<div class="label">
									<label for="input-large">Product Dimension:</label>
								</div>
								<div class="input">
									<input id="Dimension" name="Dimension" value="<?php echo $data[2]; ?>" class="small valid" type="text">
								</div>
							</div>

						<div class="field" id="set_stock" <?php echo $collectibles_style; ?>>
								<div class="label">
									<label for="input-large">Product Stock:</label>
								</div>
								<div class="input">
									<input id="Stock" name="Stock" value="<?php echo $data[3]; ?>" class="small valid" type="text">
								</div>
							</div>	
							<div class="field">
								<div class="label">
									<label for="input-large">Trade Price per Qty(e.g. numeric data):</label>
								</div>
								<div class="input">
									<input id="ProductPrice" name="ProductPrice" value="<?php echo $data[1]; ?>" class="small valid" type="text">
								</div>
							</div>
							
                            <div class="field">
								<div class="label">
									<label for="input-large"> Discount (if any) e.g. numeric data in % :</label>
								</div>
								<div class="input">
							<input id="ProductDiscount" name="ProductDiscount" value="<?php echo $data[2]; ?>"  class="small valid" type="text">
								</div>
							</div>
<!--                            <div class="field">-->
<!--								<div class="label">-->
<!--									<label for="input-medium"> Shipping Cost (Inside Dhaka):</label>-->
<!--								</div>-->
<!--								<div class="input" >-->
<!--							    <input class="small valid" type="text"  name="ShippingCost" id="ShippingCost" value="--><?php //echo $data[7]; ?><!--">-->
<!--								</div>-->
<!--							</div>-->
<!--							<div class="field">-->
<!--								<div class="label">-->
<!--									<label for="input-medium"> Shipping Cost (Outside Dhaka):</label>-->
<!--								</div>-->
<!--								<div class="input" >-->
<!--							    <input class="small valid" type="text"  name="ShippingCostOutSide" id="ShippingCostOutSide" value="--><?php //echo $data[11]; ?><!--">-->
<!--                                  -->
<!--								</div>-->
<!--							</div>-->
					  <div class="field">
								<div class="label">
									<label for="input-valid">Product Details :</label>
								</div>
							 <div class="input" >
							    <textarea name="ProductFeatures" cols="50" rows="5" id="ProductFeatures"><?php echo htmlspecialchars_decode($data[6]); ?></textarea>
							</div>
                                
                          

                                
							</div>
					<div class="field">
								<div class="label">
									<label for="input-medium"> Featured Product:</label>
								</div>
								<div class="input" >
							    <select name="FeaturedProduct" id="FeaturedProduct">
                                <?php 
								  if($data[9] == 1)
								  {
									 $yes = "selected=\"selected\"";  
									 $no = "";
								  }
								  else if($data[9] == 0)
								  {
									 $yes = "";  
									 $no = "selected=\"selected\"";
								  }
								?>
                                  <option value="1" <?php echo $yes ?>>Yes</option>
                                  <option value="0" <?php echo $no ?>>No</option>
                               
                                </select>
								</div>
							</div>
							<div class="buttons">
							
							 <div class="highlight">
			
								 <input type="button" onclick="all_check();" name="btnAdd" value="   EDIT    " class="btnsdt" style="color:white;"/>
					     
							 </div>
							
						  </div>
						 
						  
						<!-- pagination -->
						
						<!-- end pagination -->
						<!-- table action -->
						
						<!-- end table action -->
				  </form>
			  </div>
		  </div>
				<!-- end table --><!-- messages -->
				
				<!-- end box / left -->
				<!-- box / right -->
				
	</div>
    </div>			<!-- end box / right --><!-- end content / right --><!-- end content -->
		<!-- footer -->
		<?php include("footer.php"); ?>
		<!-- end footert -->
	</body>
</html>