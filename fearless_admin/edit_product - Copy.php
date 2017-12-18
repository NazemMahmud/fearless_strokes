<?php
		session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
		include("connection.php");
	 $Date=MakeDate();
	  $psql="SELECT
    product_info.ProductID
    , product_info.CategoryID
    , product_info.cattype
    , product_info.SuppliersID
    , product_info.Name
    , product_info.Brand
    , product_info.Model
    , product_info.Stock
    , product_info.Size
    , product_info.Price
    , IFNULL(product_info.Discount,0)
    , IFNULL(product_info.Vat,0)
    , IFNULL(product_info.ShipingCost,0)
    , product_info.Features
    , product_info.AdditionalFeatures
    , product_info.InsertBy
    , product_info.InsertDate
    , product_sub_unit.SubUnitName
    , product_info.MinQty
	, product_info.ShippingLocation
FROM
    product_info
    LEFT JOIN product_sub_unit 
        ON (product_info.Size = product_sub_unit.SubUnitID)
	WHERE product_info.ProductID='".$_REQUEST["ProductID"]."'";
	 $row=mysqli_fetch_row(mysqli_query($con, "$psql"));

	             if($row[2]=="cat")
				  {
				   $cat_id=$row[1];
				   $scat_id="";
				   $sscat_id="";
				  }
				  else if($row[2]=="scat")
				  {
				      $sql="SELECT CategoryID, SubCategoryID FROM product_sub_category
				    WHERE SubCategoryID='".$row[1]."'";
				   $cat_find=mysqli_fetch_row(mysqli_query($con, "$sql"));
				   
				    $cat_id=$cat_find[0];
				     $scat_id=$cat_find[1];
				   $sscat_id="";
				  // print "aaaaaaaaaaaaaaaaa";
				  }
				  else if($row[2]=="sscat")
				  {
				   $cat_find=mysqli_fetch_row(mysqli_query($con, "SELECT
												product_category_info.CategoryID
												, product_sub_category.SubCategoryID
												, product_ssub_category.SubSubCategoryID
											FROM
												product_ssub_category
												INNER JOIN product_sub_category 
													ON (product_ssub_category.SubCategoryID = product_sub_category.SubCategoryID)
												INNER JOIN product_category_info 
													ON (product_sub_category.CategoryID = product_category_info.CategoryID)
											WHERE product_ssub_category.SubSubCategoryID='".$row[1]."'"));
				   
				   $cat_id=$cat_find[0];
				   $scat_id=$cat_find[1];
				   $sscat_id=$cat_find[2];
				  }	
	           
	 
	if(isset($_POST["btnEdit"]))
	  {
	   $ProductID=$_REQUEST["ProductID"];
	   if($_POST["TakeID"]!=$_POST["preTakeID"])
	   {
		   /*if($_POST["colorid"]=="")
		   {
		     header("Location:edit_product.php?msg=Please Select Product Color!&ProductID=$ProductID");
			 die();
		   }*/
		}  
		 
        
			 
			 $update=mysqli_query($con, "UPDATE product_info SET CategoryID='".$_POST["TakeID"]."',cattype='".$_POST["cattype"]."',
			 SuppliersID='".$_POST["Suppliers"]."',Name='".$_POST["ProductName"]."',Brand='".$_POST["ProductBrand"]."',
			 Model='".$_POST["ProductModel"]."',
			 Stock='".$_POST["ProductStock"]."',Size='".$_POST["ProductSize"]."',Price=".$_POST["ProductPrice"].",
			 Discount=".$_POST["ProductDiscount"].",Vat=".$_POST["ProductVat"].",ShipingCost=".$_POST["ProductShipingCost"].",
			 Features='".$_POST["ProductFeatures"]."',AdditionalFeatures='".$_POST["ProductPlan"]."',MinQty='".$_POST["Volume"]."',
			 ShippingLocation='".$_POST["ShippingLocation"]."',
			 UpdateDate='".$Date."', UpdateBy='".$_SESSION['UserID']."'  WHERE ProductID='".$ProductID."'");
		
					if($update)
					 {
					   
					   if($row[2]=="cat")
					   {
					   header("Location:product_list1.php?msg=Product Successfully Updated!&CategoryID=$row[1]");
			            die();
					   }
					   if($row[2]=="scat")
					   {
					   header("Location:product_list2.php?msg=Product Successfully Updated!&SubCategoryID=$row[1]");
			            die();
					   }
					   if($row[2]=="sscat")
					   {
					   header("Location:product_list3.php?msg=Product Successfully Updated!&SubSubCategoryID=$row[1]");
			            die();
					   }
					 }
					 else
					 {
					  header("Location:edit_product.php?msg=Update Failed! Try Again...&ProductID=$ProductID");
			            die();
					 }
			



	  }
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>PEPEELIKA</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<!-- stylesheets -->
		<link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="resources/css/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="resources/css/style_fixed.css" />
		<link id="color" rel="stylesheet" type="text/css" href="resources/css/colors/red.css" />
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
			    document.getElementById('cattype').value="cat";
				document.getElementById('TakeID').value=searchCode;	
				//alert(''+searchCode);
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
							<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customersss" method="post" enctype="multipart/form-data">
							</form>
						</div>
					</div>
					<!-- end box / title -->
					
					
					<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="product_form" method="post" enctype="multipart/form-data">
						<div class="form">
						<div class="fields">
						    <div class="field">
								<div class="label">
									<label for="input-medium">  Supplier:</label>
								</div>
								<div class="input">
									<input id="Suppliers" name="Suppliers"  class="small valid" type="text" value="<?php print $row[3]; ?>">
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Product  Category:</label>
								</div>
							  <div class="input">
							    <select name="ProductCategoryID" id="ProductCategoryID" onchange="subCategory(this.value);">
                                  <option value="">Select Product Category</option>
								  <?php
								   $cat=mysqli_query($con, "SELECT  CategoryID,CategoryName FROM product_category_info WHERE ActiveStatus='Active'
								    ORDER BY CategoryID DESC");
								   while($catRow=mysqli_fetch_row($cat))
								   {
								    if($cat_id==$catRow[0])
									{
								  ?>
                                  <option value="<?php print $catRow[0]; ?>" selected="selected"><?php print $catRow[1]; ?></option>
								  <?php
								  }
								  else
								  {
								  ?>
								  <option value="<?php print $catRow[0]; ?>"><?php print $catRow[1]; ?></option>
								  <?php }} ?>
                                </select>
								<input type="hidden" name="cattype" id="cattype" value="<?php print $row[2]; ?>" />
								<input type="hidden" name="TakeID" id="TakeID" value="<?php print $row[1]; ?>" />
								<input type="hidden" name="precattype" id="precattype" value="<?php print $row[2]; ?>" />
								<input type="hidden" name="preTakeID" id="preTakeID" value="<?php print $row[1]; ?>" />
							    <input type="hidden" name="colorid" id="colorid" value="" />
								<input type="hidden" name="colorcount" id="colorcount" value="" />
								
							    <input type="hidden" name="ProductID" id="ProductID" value="<?php print $_REQUEST["ProductID"]; ?>" />
							  </div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Product Sub Category:</label>
								</div>
								<div class="input" id="subcatpro">
							    <select name="ProductSubCategoryID" id="ProductSubCategoryID" onchange="subsubCategory(this.value);">
                                  <option value="">Select Product Sub Category</option>
								  <?php
								   $scat=mysqli_query($con, "SELECT SubCategoryID,SubCategoryName FROM product_sub_category WHERE CategoryID='".$cat_id."'
								    AND ActiveStatus='Active' ORDER BY SubCategoryName");
								   while($scatRow=mysqli_fetch_row($scat))
								   {
								    if($scat_id==$scatRow[0])
									{
								  ?>
                                  <option value="<?php print $scatRow[0]; ?>" selected="selected"><?php print $scatRow[1]; ?></option>
								  <?php
								  }
								  else
								  {
								  ?>
								  <option value="<?php print $scatRow[0]; ?>"><?php print $scatRow[1]; ?></option>
								  <?php }} ?>
                                </select>
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Product Sub Sub Category:</label>
								</div>
								<div class="input" id="subsubcatpro">
							    <select name="ProductSubSubCategoryID" id="ProductSubSubCategoryID">
                                  <option value="">Select Product Sub Sub Category</option>
								   <?php
								   $sscat=mysqli_query($con, "SELECT SubSubCategoryID,SubCategoryName FROM product_ssub_category
								    WHERE SubCategoryID='".$scat_id."' AND ActiveStatus='Active' ORDER BY SubCategoryName");
								   while($sscatRow=mysqli_fetch_row($sscat))
								   {
								    if($sscat_id==$sscatRow[0])
									{
								  ?>
                                  <option value="<?php print $sscatRow[0]; ?>" selected="selected"><?php print $sscatRow[1]; ?></option>
								  <?php
								  }
								  else
								  {
								  ?>
								  <option value="<?php print $sscatRow[0]; ?>"><?php print $sscatRow[1]; ?></option>
								  <?php }} ?>
                                </select>
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Product  Name:</label>
								</div>
								<div class="input">
									<input id="ProductName" name="ProductName" value="<?php print @$row[4] ?>" class="small valid" type="text">
								</div>
							</div>
					  <div class="field">
								<div class="label">
									<label for="input-large">Product Brand :</label>
						  </div>
						  <div class="input">
						    <input id="ProductBrand" name="ProductBrand" value="<?php print @$row[5] ?>" class="small valid" type="text" />
						  </div>
					  </div>
							<div class="field">
								<div class="label">
									<label for="input-large">Product Model :</label>
							  </div>
								<div class="input">
									<input id="ProductModel" name="ProductModel" value="<?php print @$row[6] ?>" class="small valid" type="text">
								</div>
					  </div>
					  <div class="field">
								<div class="label">
									<label for="input-large">Product Stock (e.g. numeric data):</label>
								</div>
								<div class="input">
									<input id="ProductStock" name="ProductStock" value="<?php print @$row[7] ?>" class="small valid" type="text">
								</div>
							</div>
					<div class="field">
								<div class="label">
									<label for="input-large">Min Qty :</label>
								</div>
								<div class="input">
								<div style="width:auto; float:left;">
								  
                                    <input id="Volume" name="Volume" class="small valid" type="text" value="<?php print @$row[18] ?>">
								</div>
								<div style="width:auto; float:left; vertical-align:middle;">
									<strong>&nbsp;General&nbsp;Unit:&nbsp;</strong>								</div>
                                 <div style="width:auto; float:left;" class="input" id="pdtsize">
								  <select name="ProductSize" id="ProductSize">
                                    <option value="">Product Unit</option>
									<?php
									  $general_unit=mysqli_query($con, "SELECT
									product_sub_unit.SubUnitID
									, product_sub_unit.SubUnitName
								FROM
									product_sub_unit
									INNER JOIN product_unit 
										ON (product_sub_unit.UnitID = product_unit.UnitID)
								WHERE product_unit.UnitName LIKE '%General%' ORDER BY product_sub_unit.SubUnitName");
								while($general_unitRow=mysqli_fetch_row($general_unit))
								{
									 if($row[8]==$general_unitRow[0])
									 {
									?>
									
									<option value="<?php print $general_unitRow[0]; ?>" selected="selected"><?php print $general_unitRow[1]; ?></option>
								<?php } 
								      else
									  {
								?>
								  <option value="<?php print $general_unitRow[0]; ?>"><?php print $general_unitRow[1]; ?></option>
								  <?php }} ?>
                                  </select>
								</div>
								</div>
					  </div>

					 
					<!--<div class="field">
					  <div class="label">
									<label for="input-large"><a href="#" onclick="window_popup();">Select Color</a></label>
						    
							<table style="margin-left:100px;" width="150" border="0" cellspacing="0" cellpadding="0" class="category">
                                      <tr>
                                        <th id="color_div" style="display:none;">&nbsp;</th>
                                      </tr>
                                    </table>
								</div>
						
							</div>-->
							
							<div class="field">
								<div class="label">
									<label for="input-large">Price per Qty(e.g. numeric data):</label>
								</div>
								<div class="input">
									<input id="ProductPrice" name="ProductPrice" value="<?php print @$row[9] ?>" class="small valid" type="text">
								</div>
							</div>
                            <div class="field">
								<div class="label">
									<label for="input-large">Product Discount (if any) e.g. numeric data :</label>
								</div>
								<div class="input">
							<input id="ProductDiscount" name="ProductDiscount" value="<?php print @$row[10] ?>" class="small valid" type="text">
								</div>
							</div>
                            <div class="field">
								<div class="label">
									<label for="input-large">Product Vat (if any) e.g. numeric data :</label>
								</div>
								<div class="input">
							<input id="ProductVat" name="ProductVat" value="<?php print @$row[11] ?>" class="small valid" type="text">
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-large">Product Shiping Cost (if any) e.g. numeric data :</label>
								</div>
								<div class="input">
							<input id="ProductShipingCost" name="ProductShipingCost" value="<?php print @$row[12] ?>" class="small valid" type="text">
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-valid">Product Features :</label>
								</div>
							  <div class="select">
							    <textarea name="ProductFeatures" cols="50" rows="5" id="ProductFeatures"><?php print @$row[13] ?></textarea>
							  </div>
                                
                          

                                
							</div>
							<div class="field">
								<div class="label">
									<label for="input-valid">Additional Features :</label>
								</div>
							  <div class="select">
							    <textarea name="ProductPlan" cols="50" rows="5" id="ProductPlan"><?php print @$row[14] ?></textarea>
							  </div>
                                
                          

                                
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Shipping Location:</label>
								</div>
								<div class="input">
								  <select name="ShippingLocation" id="ShippingLocation">
								  <option value="">Select Shipping Location</option>
								  <?php
								   if($row[19]=="All Over The Bangladesh")
								   {
								  ?>
								  <option value="All Over The Bangladesh" selected="selected">All Over The Bangladesh</option>
								  <?php }
								     else
									 {
								   ?>
								   <option value="All Over The Bangladesh">All Over The Bangladesh</option>
								   <?php }
								   if($row[19]=="All Over The World")
								   {
								    ?>
								  <option value="All Over The World" selected="selected">All Over The World</option>
								  <?php }
								     else
									 {
								   ?>
								   <option value="All Over The World">All Over The World</option>
								   <?php } ?>
								  <?php
								    $rs=mysqli_query($con, "SELECT DistrictID,DistrictName FROM district_info WHERE ActiveStatus='Active'
									 ORDER BY DistrictName");
									while($row=mysqli_fetch_row($rs))
									{
									  if($row[19]==$row[0])
								      {   
								  ?>
								  
								  <option value="<?php print $row[0]; ?>" selected="selected"><?php print $row[1]; ?></option>
								    <?php }
									else
									  { ?>
								 <option value="<?php print $row[0]; ?>"><?php print $row[1]; ?></option>
								   <?php }} ?>
							      </select>
							    </div>
							</div>
							<div class="buttons">
							
							 <div class="highlight">
								 <input type="submit" name="btnEdit" value="   Edit    " class="btnsdt" style="color:white;"/>
							     
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