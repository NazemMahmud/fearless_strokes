<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
     $Date=MakeDate();
	$msg="Product's Color List";
 	if(isset($_POST["btnUpdate"]))
		{
			$orderid=$_REQUEST["orderid"];
			$qrs=mysqli_query($con, "SELECT id,orderid FROM product_color_info WHERE ProductID='".$_REQUEST["ProductID"]."' ORDER BY orderid");
			$i=0;
			while($qrow=mysqli_fetch_row($qrs))
				{
					if($qrow[1] != $orderid[$i])
						{
						$prs=mysqli_query($con, "update product_color_info set
						 orderid=".$orderid[$i]." 
						 where id='".$qrow[0]."' and ProductID='".$_REQUEST["ProductID"]."' ");	
						}	
					$i++;
				}
				$ID=$_REQUEST["ID"];
		 $ProductID=$_REQUEST["ProductID"];
		 
		 $activity_update=mysqli_query($con, "UPDATE product_info SET UpdateDate='".$Date."', UpdateBy='".$_SESSION['UserID']."'
		  WHERE ProductID='".$ProductID."'");
		  
			 header("Location:product_color_image.php?msg=Successfully Updated Ordering&ProductID=$ProductID");
		}
	
 $product_info=mysqli_fetch_row(mysqli_query($con, "SELECT ProductID,CategoryID,cattype,SuppliersID,Name,Brand,Price,InsertBy,InsertDate FROM product_info WHERE ProductID='".$_REQUEST["ProductID"]."'"));
  if($product_info[2]=="cat")
				  {
				   $cat_name=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName FROM product_category_info WHERE CategoryID='".$product_info[1]."'"));
				  }
				  else if($product_info[2]=="scat")
				  {
				   $cat_name=mysqli_fetch_row(mysqli_query($con, "SELECT
										CONCAT(product_category_info.CategoryName,' > '
										, product_sub_category.SubCategoryName)
									FROM
										product_sub_category
										INNER JOIN product_category_info 
											ON (product_sub_category.CategoryID = product_category_info.CategoryID)
									WHERE product_sub_category.SubCategoryID='".$product_info[1]."'"));
				  }
				  else if($product_info[2]=="sscat")
				  {
				   $cat_name=mysqli_fetch_row(mysqli_query($con, "SELECT
								CONCAT(product_category_info.CategoryName,' > '
								, product_sub_category.SubCategoryName,' > '
								, product_ssub_category.SubCategoryName)
							FROM
								product_ssub_category
								INNER JOIN product_sub_category 
									ON (product_ssub_category.SubCategoryID = product_sub_category.SubCategoryID)
								INNER JOIN product_category_info 
									ON (product_sub_category.CategoryID = product_category_info.CategoryID)
							WHERE product_ssub_category.SubSubCategoryID='".$product_info[1]."'"));
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
		window.location = "delete.php?type=member&id="+id;
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
		
		<link type="text/css" href="ui-darkness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript">	

$(function() {
			
			$('#BDATE').datepicker({
				changeMonth: true,
					changeYear: true,
				dateFormat: 'yy-mm-dd'
			});
				$('#EDATE').datepicker({
				changeMonth: true,
					changeYear: true,
				dateFormat: 'yy-mm-dd'
			});
			
		});
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
				<div class="box" style="background:none;">
					<!-- box / title -->
					<div class="title">
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:$msg; ?></h5>
						
					  <div class="search" style="width:auto; float:right; color:#FFFFFF; font-size:12px;"></div>
					</div>
					<!-- end box / title -->
					
						
    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
                    <br>
  <table width="728" border="0" align="left" cellpadding="0" cellspacing="0">
           <tr >
              <th colspan="5" align="left" > Color List Update <br>
                <br>                <a href="#" onclick="window.open('color_set_in_product_ex.php?ProductID=<?php print $product_info[0] ?>&type=insert&cattype=<?php print $product_info[2] ?>','color_set_in_product_ex','width=600px, height=500px, scrollbars=1, left=200px, top=100px');">Insert Color Into List</a>
			    <br>			    <a href="#" onclick="window.open('color_set_in_product_ex.php?ProductID=<?php print $product_info[0] ?>&type=delete&cattype=<?php print $product_info[2] ?>','color_set_in_product_ex','width=600px, height=500px, scrollbars=1, left=200px, top=100px');">Delete Color From List</a></th>
          </tr>
            <tr >
              <td align="right" ><strong>Product Name : </strong></td>
              <td width="186" align="left" ><strong><?php print $product_info[4]; ?>
                <input type="hidden" name="ProductID" id="ProductID" value="<?php print $_REQUEST["ProductID"]; ?>" />
              </strong></td>
              <td width="176" align="right" ><strong>Category: </strong></td>
              <td colspan="2" align="left" ><strong><?php print $cat_name[0]; ?></strong></td>
            </tr>
            <tr >
              <td align="right" ><strong>Product Brand : </strong></td>
              <td align="left" ><strong><?php print $product_info[5]; ?></strong></td>
              <td align="right" ><strong>Supplier: </strong></td>
              <td colspan="2" align="left" ><strong><?php print $product_info[3]; ?></strong></td>
            </tr>
            <tr >
              <td align="right" ><strong>Product Price : </strong></td>
              <td align="left" ><strong><?php print $product_info[6]; ?></strong></td>
              <td align="right" ><strong>Insert Date : </strong></td>
              <td colspan="2" align="left" ><strong><?php print $product_info[8]; ?></strong></td>
            </tr>
            <tr >
              <th colspan="5" align="left" >Color List For Image Settings </th>
            </tr>
            
            
            <tr >
              <td width="128" align="center" ><strong>SL</strong></td>
              <td align="center"  ><strong>Name </strong></td>
              <td align="center"  ><strong>Color</strong></td>
              <td width="78" align="center" ><strong>Ordering</strong></td>
              <td width="172" align="center" ><strong>Image Settings </strong></td>
          </tr>
       		<?php
			
			  $i=0;
				  $TotalAmount=0;

                   $color=mysqli_query($con, "SELECT
						product_color_info.id
						, product_color_info.colorid
						, product_cat_color.ColorName
						, product_cat_color.ColorCode
						, product_color_info.orderid
					FROM
						product_color_info
						INNER JOIN product_cat_color 
							ON (product_color_info.colorid = product_cat_color.id)
					WHERE product_color_info.ProductID='".$_REQUEST["ProductID"]."'
					ORDER BY product_color_info.orderid");
      
				  while( $colorRow=mysqli_fetch_row($color))
				  {
					  $i++;
					
			?>
            <tr>
              <td height="30" align="center"><?php print $i; ?><strong>
                <input type="hidden" name="id[]" id="id" value="<?php print $colorRow[0]; ?>" />
              </strong></td>
              <td align="center"  ><?php print $colorRow[2] ?></td>
              <td align="center"><div style="width:20px; height:20px; background-color:<?php print "#".$colorRow[3]; ?>;"></div></td>
              <td align="center"><input name="orderid[]" type="text" size="3" value="<?php print $colorRow[4] ?>" /></td>
              <td align="left">
			  <a href="#" onclick="window.open('color_image_setting.php?ID=<?php print $colorRow[0] ?>&ProductID=<?php print $_REQUEST["ProductID"] ?>&type=insert','color_image_setting','width=600px, height=500px, scrollbars=1, left=200px, top=100px')">Insert Image</a>
			  <br>
			  <a href="#" onclick="window.open('color_image_setting.php?ID=<?php print $colorRow[0] ?>&ProductID=<?php print $_REQUEST["ProductID"] ?>&type=delete','color_image_setting','width=600px, height=500px, scrollbars=1, left=200px, top=100px')">View Image</a>			  </td>
            </tr>
			<?php } ?>
            <tr>
              <td colspan="5" align="center"><input name="btnUpdate" type="submit" class="btnsdt" id="btnUpdate" style="color:white;" value="Save"/></td>
            </tr>
          </table>
</form>
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