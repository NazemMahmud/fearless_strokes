<?php
		session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
		include("connection.php");
	

	   if( isset($_POST["TakeID"]) && $_POST["TakeID"]!="")
	   {
	      $uploadfolder = "../productimage/" ;
	       include("thumb.php") ;
		// $ProductID=MakeID($con, "product_info","ProductID","PDT-",15);
		 $Date=MakeDate();
		 $SerialNo = mysqli_fetch_row(mysqli_query($con, "SELECT IFNULL(MAX(SerialNo),0)+1 FROM product_info"));
		 if($_POST["ProductCategoryID"] == "4")
		 {
		   $collectibles = 1;
		      $sql = "INSERT INTO product_info
			   (SerialNo,
			   ProductID,
			   ProductName,
			   Brand,
			   ProductDimension,
			   Stock,
			   Price,
			   Discount,
			   Features,
               ShippingCost,
			   ActiveStatus,
			   InsertBy,
			   InsertDate,
			   UpdateDate,
			   UpdateBy,
			   BatchLot,
			   Collectibles,
			   FeaturedStatus)
              VALUES(".$SerialNo[0].",
			  '".$_POST["primary_id_container"]."',
			  '".$_POST["ProductName"]."',
			 '".$_POST["ProductBrand"]."',
			 '".$_POST["Dimension"]."',
			 '".$_POST["Stock"]."',
			 '".$_POST["ProductPrice"]."', 
			 '".$_POST["ProductDiscount"]."',
			 '".$_POST["ProductFeatures"]."',
			 '".$_POST["ShippingCost"]."',
			 'InActive',
			 '".$_SESSION["UserID"]."',
			 '".$Date."',
			 '',
			 '',
			 '".$_POST["BatchLot"]."',
			 '".$collectibles."',
			 ".$_POST["FeaturedProduct"].")";
			 
			$insert=mysqli_query($con, "$sql");	
			   $img_ref_pdt_id = $_POST["primary_id_container"];
				 
				   for($j=1; $j<=4; $j++)
				   {
					 $file_take = "image".$j;  
					 if($_FILES[$file_take]['name'] != "")
					 {
					      			
						$file1 = $uploadfolder."img".$ImageID.$_FILES[$file_take]['name'];
						//$bigimg="img".$row['maxid'].$_FILES['uploadimage']['name']; 
						move_uploaded_file($_FILES[$file_take]['tmp_name'], $file1);
						$ext=strtolower(substr(strrchr($file1,"."),1));
						
						$bigimg=$uploadfolder."big".$ImageID.$_FILES[$file_take]['name'];
						$bigimgname="big".$ImageID.$_FILES[$file_take]['name'];
						save_scaled($file1,$bigimg,$ext,600,500);
					
						$midimg=$uploadfolder."mid".$ImageID.$_FILES[$file_take]['name'];
						$midimgname="mid".$ImageID.$_FILES[$file_take]['name'];
						save_scaled($file1,$midimg,$ext,400,220);
						
						$smallimg=$uploadfolder."small".$ImageID.$_FILES[$file_take]['name'];
						$smallimgname="small".$ImageID.$_FILES[$file_take]['name'];
						save_scaled($file1,$smallimg,$ext,100,120);
						@unlink($file1);	
						   $ImageID=MakeID($con, "product_image","ImageID","IMG-",20);
						  $img_insert=mysqli_query($con, "INSERT INTO product_image 
					   (ImageID,ProductID,BigImage,MidImage,SmallImage,type) 
					   VALUES('".$ImageID."','".$img_ref_pdt_id."','".$bigimgname."','".$midimgname."','".$smallimgname."',
					   'nocolor')"); 
					 }
					 
				   }	 
		 }
		 else
		 {
		   $collectibles = 0;	
		      
			 $sql = "INSERT INTO product_info
			   (SerialNo,
			   ProductID,
			   ProductName,
			   Brand,
			   ProductDimension,
			   Stock,
			   Price,
			   Discount,
			   Features,
               ShippingCost,
			   ActiveStatus,
			   InsertBy,
			   InsertDate,
			   UpdateDate,
			   UpdateBy,
			   BatchLot,
			   Collectibles,
			   FeaturedStatus)
              VALUES(".$SerialNo[0].",
			  '".$_POST["primary_id_container"]."',
			  '".$_POST["ProductName"]."',
			 '".$_POST["ProductBrand"]."',
			 '".$_POST["Dimension"]."',
			 '".$_POST["Stock"]."',
			 '".$_POST["ProductPrice"]."', 
			 '".$_POST["ProductDiscount"]."',
			 '".$_POST["ProductFeatures"]."',
			 '".$_POST["ShippingCost"]."',
			 'InActive',
			 '".$_SESSION["UserID"]."',
			 '".$Date."',
			 '',
			 '',
			 '".$_POST["BatchLot"]."',
			 '".$collectibles."',
			 ".$_POST["FeaturedProduct"].")";
			 
			$insert=mysqli_query($con, "$sql");
			 
			  for($i =1; $i<= $_POST["ColorCount"]; $i++)
			  {
				    $colorid = "color".$i;
				    $img_ref_pdt_id = $_POST["primary_id_container"].$_POST[$colorid];
				 
				   for($j=1; $j<=4; $j++)
				   {
					 $file_take = "file".$i.$j;  
					 if($_FILES[$file_take]['name'] != "")
					 {
					      			
						$file1 = $uploadfolder."img".$ImageID.$_FILES[$file_take]['name'];
						//$bigimg="img".$row['maxid'].$_FILES['uploadimage']['name']; 
						move_uploaded_file($_FILES[$file_take]['tmp_name'], $file1);
						$ext=strtolower(substr(strrchr($file1,"."),1));
						
						$bigimg=$uploadfolder."big".$ImageID.$_FILES[$file_take]['name'];
						$bigimgname="big".$ImageID.$_FILES[$file_take]['name'];
						save_scaled($file1,$bigimg,$ext,600,500);
					
						$midimg=$uploadfolder."mid".$ImageID.$_FILES[$file_take]['name'];
						$midimgname="mid".$ImageID.$_FILES[$file_take]['name'];
						save_scaled($file1,$midimg,$ext,400,220);
						
						$smallimg=$uploadfolder."small".$ImageID.$_FILES[$file_take]['name'];
						$smallimgname="small".$ImageID.$_FILES[$file_take]['name'];
						save_scaled($file1,$smallimg,$ext,100,120);
						@unlink($file1);	
						   $ImageID=MakeID($con, "product_image","ImageID","IMG-",20);
						  $img_insert=mysqli_query($con, "INSERT INTO product_image 
					   (ImageID,ProductID,BigImage,MidImage,SmallImage,type) 
					   VALUES('".$ImageID."','".$img_ref_pdt_id."','".$bigimgname."','".$midimgname."','".$smallimgname."',
					   'color')"); 
					 }
					 
				   }
				
			  }
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
					mysqli_query($con, "INSERT INTO product_details(ProductFullID,SerialNo,Qty) VALUES('".$id."',".$SerialNo[0].",".$qty.")");  
					}
				   }
			  }
		 }

					if($insert)
					 {
					   
					   
					    

						
						$CatID=$_POST["ProductSubSubCategoryID"];
			           // $CatType=$_POST["cattype"];
						header("Location:product_list3.php?msg=Product Successfully Added!&SubSubCategoryID=$CatID");
							die();
					   
						  /* if($CatType=="sscat")
						   {
							header("Location:product_list3.php?msg=Product Successfully Added!&SubSubCategoryID=$CatID");
							die();
						   }
						   else if($CatType=="scat")
						   {
							header("Location:product_list2.php?msg=Product Successfully Added!&SubCategoryID=$CatID");
							die();
						   }
						   else if($CatType=="cat")
						   {
							header("Location:product_list1.php?msg=Product Successfully Added!&CategoryID=$CatID");
							die();
						   }*/
					 }
					 else
					 {
					   header("Location:insert_product.php?msg=Product Insertion Failed! Try Again... ");
			            die();
					 }
			
			
		   }
		
			
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
				if($('#ProductCategoryID').val() == '4')
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
			   var pdtstyle = $('#ProductStyleID').val();
			   var pdtcategory = $('#ProductCategoryID').val();
			   var pdtscategory = $('#ProductSubCategoryID').val();
			   var pdtsscategory = $('#ProductSubSubCategoryID').val();
			   var primary_id = pdtstyle+''+pdtcategory+''+pdtscategory+''+pdtsscategory;
			     $('#primary_id_container').val(primary_id);
			   	 
			 }
			 function add_more_function()
			  {
				
				  var ColorCount = $('#ColorCount').val();
				 // alert(ColorCount);
				  var deleterow = "delete"+ColorCount;
				  ColorCount ++; 
				  var primary_id = $('#primary_id_container').val(); 
				   if(primary_id != "" && primary_id.length == 8)
				   {
				   $.post("LookUp.php",{ func: "ADDMORE", src: ColorCount, primary_id: primary_id },
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
			     
				 if(document.getElementById("BatchLot").value=="")
				 {
				  alert("Please Enter Batch/Lot Number");
				  document.getElementById("BatchLot").focus();
				  return false;
				 }
				 if( productID.length < 8)
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
				 if(document.getElementById("ProductCategoryID").value==4)
				 {
				    if(document.getElementById("Stock").value=="")
					{
					   alert("Please Enter Product Stock");
				       document.getElementById("Stock").focus();
					    return false;
					}
					else  if(document.getElementById("Dimension").value=="")
					{
					   alert("Please Enter Product Dimension");
				       document.getElementById("Dimension").focus();
					    return false;
					}
				 }
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
						<h5><?php print isset($_REQUEST['msg'])?$_REQUEST['msg']:"Insert Product"; ?></h5>
						<div class="search">
							
						</div>
					</div>
					<!-- end box / title -->
					
					
					<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="product_form" method="post" enctype="multipart/form-data">
						<div class="form">
						<div class="fields">
						<div class="field">
							<div class="label">
									<label for="input-medium">Batch/Lot:</label>
						  </div>
				    <div class="input">
									
									<input type="text"   name="BatchLot" id="BatchLot" class="small valid">
				      
								</div>
					  </div>
                       <div class="field">
								<div class="label">
									<label for="input-medium">  Style:</label>
								</div>
					    <div class="input" >
							    <select name="ProductStyleID" id="ProductStyleID" onchange="set_primary_id();">
                                  <option value="">Select Product Style</option>
								  <?php
								   $style=mysqli_query($con, "SELECT StyleID,StyleName FROM product_style WHERE ActiveStatus = 1");
								   while($styleRow=mysqli_fetch_row($style))
								   {
								  ?>
                                  <option value="<?php print $styleRow[0]; ?>"><?php print $styleRow[1]; ?></option>
								  <?php
								  }
								  ?>
                                </select>
								
							<span style="float:right; padding-left:10px;">
                    <input style="height:18px; padding:0; text-align:center;" name="primary_id_container" type="text" size="10" readonly="readonly" id="primary_id_container"></span>    
					    </div>
					  </div>
					  <div class="field">
								<div class="label">
									<label for="input-medium">  Category:</label>
								</div>
					    <div class="input">
							    <select name="ProductCategoryID" id="ProductCategoryID" onchange="subCategory(this.value);">
                                  <option value="">Select Product Category</option>
								  <?php
								   $cat=mysqli_query($con, "SELECT  CategoryID,CategoryName FROM product_category_info WHERE ActiveStatus='Active' 
								   ORDER BY orderid");
								   while($catRow=mysqli_fetch_row($cat))
								   {
								  ?>
                                  <option value="<?php print $catRow[0]; ?>"><?php print $catRow[1]; ?></option>
								  <?php
								  }
								  ?>
                                </select>
								<input type="hidden" name="cattype" id="cattype" value="" />
								<input type="hidden" name="TakeID" id="TakeID" value="" />
							    
					    </div>
					  </div>
							<div class="field">
								<div class="label">
									<label for="input-medium"> Sub Category:</label>
								</div>
								<div class="input" id="subcatpro">
							    <select name="ProductSubCategoryID" id="ProductSubCategoryID" onchange="subsubCategory(this.value);">
                                  <option value="">Select Product Sub Category</option>
                                </select>
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium"> Sub Sub Category:</label>
								</div>
								<div class="input" id="subsubcatpro">
							    <select name="ProductSubSubCategoryID" id="ProductSubSubCategoryID">
                                  <option value="">Select Product Sub Sub Category</option>
                                </select>
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">  Name:</label>
								</div>
								<div class="input">
									<input id="ProductName" name="ProductName" class="small valid" type="text">
								</div>
							</div>
					  <div class="field">
								<div class="label">
									<label for="input-large"> Brand :</label>
						  </div>
				      <div class="input">
						    <input id="ProductBrand" name="ProductBrand" class="small valid" type="text" />
					    <input type="hidden" name="ColorCount" id="ColorCount" value="0" />
                        <input type="hidden" name="lastsize_id_qty_count" id="lastsize_id_qty_count" value="0" />
						  </div>
					  </div>
					 <div class="field" id="size_color_qty_option">
                            <div  style="width:100%;" id="size_color_qty">
                       
                          
                         
                          </div>
                            <div style="padding-top:10px;"><a href="#" onclick="add_more_function();">Add Product Size,Color,Qty</a></div>
                         
                         
					  </div>
                     
                      <div class="field" id="set_images" style="display:none;">
								
									<span style="font-weight:bold; color:#000;">Upload Images:</span>
								
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									(1)<input type="file"  name='image1' id='image1'/>
                                    &nbsp;(2)<input type="file"  name='image2' id='image2'/>
                               <br> <br><span style="margin-left:130px;">
									(3)<input type="file"  name='image3' id='image3'/>
                                    &nbsp;(4)<input type="file"  name='image4' id='image4'/></span>
								
							</div> 
                     <div class="field" id="set_dimension" style="display:none;">
								<div class="label">
									<label for="input-large">Product Dimension:</label>
								</div>
								<div class="input">
									<input id="Dimension" name="Dimension" class="small valid" type="text">
								</div>
							</div>

						<div class="field" id="set_stock" style="display:none;">
								<div class="label">
									<label for="input-large">Product Stock:</label>
								</div>
								<div class="input">
									<input id="Stock" name="Stock" class="small valid" type="text">
								</div>
							</div>	
							<div class="field">
								<div class="label">
									<label for="input-large">Trade Price per Qty(e.g. numeric data):</label>
								</div>
								<div class="input">
									<input id="ProductPrice" name="ProductPrice" class="small valid" type="text">
								</div>
							</div>
							
                            <div class="field">
								<div class="label">
									<label for="input-large"> Discount (if any) e.g. numeric data in % :</label>
								</div>
								<div class="input">
							<input id="ProductDiscount" name="ProductDiscount"  class="small valid" type="text">
								</div>
							</div>
                            <div class="field">
								<div class="label">
									<label for="input-medium"> Shipping Cost:</label>
								</div>
								<div class="input" >
							    <select name="ShippingCost" id="ShippingCost">
                                  <option value="Paid">Paid</option>
                                  <option value="Free">Free</option>
                                  
                                </select>
								</div>
							</div>
							
					  <div class="field">
								<div class="label">
									<label for="input-valid">Product Details :</label>
								</div>
							  <div class="select">
							    <textarea name="ProductFeatures" cols="50" rows="5" id="ProductFeatures"></textarea>
							  </div>
                                
                          

                                
							</div>
					<div class="field">
								<div class="label">
									<label for="input-medium"> Featured Product:</label>
								</div>
								<div class="input" >
							    <select name="FeaturedProduct" id="FeaturedProduct">
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                                  
                                </select>
								</div>
							</div>
							<div class="buttons">
							
							 <div class="highlight">
			
								 <input type="button" onclick="all_check();" name="btnAdd" value="   Add    " class="btnsdt" style="color:white;"/>
					     
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