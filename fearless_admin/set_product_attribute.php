<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");

	if($_REQUEST["type"]=="sscat")
	{
	 $title=mysqli_fetch_row(mysqli_query($con, "SELECT
    CONCAT(product_category_info.CategoryName,' > ',
    product_sub_category.SubCategoryName,' > ',
    product_ssub_category.SubCategoryName)
FROM
    product_ssub_category
    INNER JOIN product_sub_category 
        ON (product_ssub_category.SubCategoryID = product_sub_category.SubCategoryID)
    INNER JOIN product_category_info 
        ON (product_sub_category.CategoryID = product_category_info.CategoryID)
WHERE product_ssub_category.SubSubCategoryID='".$_REQUEST["ID"]."'"));
     $title="Attribute Settings for ".$title[0];
	}
	else if($_REQUEST["type"]=="scat")
	{
	 
	 $title=mysqli_fetch_row(mysqli_query($con, "SELECT
     CONCAT(product_category_info.CategoryName,' > '
    , product_sub_category.SubCategoryName)
   FROM
    product_sub_category
    INNER JOIN product_category_info 
        ON (product_sub_category.CategoryID = product_category_info.CategoryID)
WHERE product_sub_category.SubCategoryID='".$_REQUEST["ID"]."'"));

     $title="Attribute Settings for ".$title[0];
	}
	else if($_REQUEST["type"]=="cat")
	{
	 
	 $title=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName FROM product_category_info WHERE CategoryID='".$_REQUEST["ID"]."'"));

     $title="Attribute Settings for ".$title[0];
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

function ConfirmAcInac(id)
{
   //alert(""+id);
	var result = confirm("Are you sure you want to Change this Record ?");
	if (result==true)
	{
		window.location = "delete.php?type=phcat&id="+id;
	}
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
				<div class="box" style="background:none;">
					<!-- box / title -->
					<div class="title" style="margin-bottom:0px;">
						<h5><?php print $title; ?></h5>
					</div>
					<!-- end box / title -->
					
		<div class="pagination pagination-left" style="margin-top:0px; background-color:#FFFFFF;" >
    <div class="results" style="margin-top:0px; background-color:#FFFFFF;" ></div>
	</div>					
    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
  <table width="413" border="0" align="left" cellpadding="0" cellspacing="0">
       <thead>
            <tr >
              <th width="6%" align="left" >SL</th>
              <th width="33%" align="left" ><strong>Attribute</strong> Name </th>
              <th width="29%" align="left" ><strong>Add Attribute </strong></th>
              <th width="32%" align="left" >Edit Attribute </th>
            </tr>
		</thead>
		<tbody>
       		<?php
			

		
			?>
            <tr >
              <td height="34" align="left" valign="top">1</td>
              <td height="34" align="left" valign="top">Unit &amp; Size </td>
              <td height="34" align="left" valign="top"><a href="#" onclick="window.open('unit_size_set.php?ID=<?php print $_REQUEST["ID"] ?>&type=insert&cattype=<?php print $_REQUEST["type"]; ?>','unit_size_set','width=600px, height=500px, scrollbars=1, left=200px, top=100px,');">Add Unit & Size</a>             </td>
              <td height="34" align="left"><a href="#" onclick="window.open('unit_size_set.php?ID=<?php print $_REQUEST["ID"] ?>&type=delete&cattype=<?php print $_REQUEST["type"]; ?>','unit_size_set','width=600px, height=500px, scrollbars=1, left=200px, top=100px,');">View/Edit/Delete Unit & Size</a></td>
            </tr>
            <tr >
              <td height="30" align="left" valign="top">2</td>
              <td height="30" align="left" valign="top">Color</td>
              <td height="30" align="left" valign="top"><a href="#" onclick="window.open('color_set.php?ID=<?php print $_REQUEST["ID"] ?>&type=insert&cattype=<?php print $_REQUEST["type"]; ?>','color_set','width=600px, height=500px, scrollbars=1, left=200px, top=100px,');">Add Color</a></td>
              <td height="30" align="left"><a href="#" onclick="window.open('color_set.php?ID=<?php print $_REQUEST["ID"] ?>&type=delete&cattype=<?php print $_REQUEST["type"]; ?>','color_set','width=600px, height=500px, scrollbars=1, left=200px, top=100px,');">View/Delete Color</a></td>
            </tr>
            <tr >
              <td height="30" align="left" valign="top">3</td>
              <td height="30" align="left" valign="top">Price</td>
              <td height="30" align="left" valign="top"><a href="#" onclick="window.open('price_set.php?ID=<?php print $_REQUEST["ID"] ?>&type=insert&cattype=<?php print $_REQUEST["type"]; ?>','price_set','width=600px, height=500px, scrollbars=1, left=200px, top=100px,');">Add Price Range</a></td>
              <td height="30" align="left"><a href="#" onclick="window.open('price_set.php?ID=<?php print $_REQUEST["ID"] ?>&type=delete&cattype=<?php print $_REQUEST["type"]; ?>','price_set','width=600px, height=500px, scrollbars=1, left=200px, top=100px,');">View/Edit/Delete Price Range</a></td>
            </tr>
            <tr >
              <td height="47" align="left" valign="top">4</td>
              <td height="47" align="left" valign="top">Discount</td>
              <td height="47" align="left" valign="top"><a href="#" onclick="window.open('discount_set.php?ID=<?php print $_REQUEST["ID"] ?>&type=insert&cattype=<?php print $_REQUEST["type"]; ?>','discount_set','width=600px, height=500px, scrollbars=1, left=200px, top=100px,');">Add Discount Range</a>
		</td>
              <td height="47" align="left"><a href="#" onclick="window.open('discount_set.php?ID=<?php print $_REQUEST["ID"] ?>&type=delete&cattype=<?php print $_REQUEST["type"]; ?>','discount_set','width=600px, height=500px, scrollbars=1, left=200px, top=100px,');">View/Edit/Delete Discount Range</a></td>
            </tr>
		</tbody>
        </table>
</form>
			    </div>
		</div>
			</div>	
				<!-- end table --><!-- messages -->
				
				<!-- end box / left -->
				<!-- box / right -->
				
	</div>			<!-- end box / right -->
	</div>
			<!-- end content / right --><!-- end content -->
		<!-- footer -->
		<?php include("footer.php"); ?>
		<!-- end footert -->
	</body>
</html>