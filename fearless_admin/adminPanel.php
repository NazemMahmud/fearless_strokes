<?php
	session_start();
if(empty($_SESSION['UserName']) ){
	header("Location:index.php");
	die();
}
	include"connection.php";

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
		
		<script src="resources/scripts/smooth.table.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.form.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.dialog.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				style_path = "resources/css/colors";

				$("#date-picker").datepicker();

				$("#box-tabs, #box-left-tabs").tabs();
			});
		</script>
	</head>
	<body>
		
		<!-- dialogs --><!-- end dialogs -->
		<!-- header -->
	  <?php  
		 include("header.php");
		?>
		<!-- end header -->
		<!-- content -->
		<div id="content" style="height:auto;">
			<!-- end content / left -->
		  <div id="left" style="height:auto;">
            <?php include("navigation.php"); ?>
            </div>
			<!-- end content / left -->
			<!-- content / right -->
	
			<div id="right">
				<!-- table -->
				
				<!-- end forms -->
				<!-- box / left -->
				<div class="box" style="margin-top:0px;">
				<div id="box-left-tabs" class="box box-left box-padding">
					<!-- box / title -->
					<div class="title">
						<h5>Latest</h5>
						<ul class="links">
							<li><a href="#box-left-forms">Member</a></li>
							<li><a href="#box-left-other">Order</a></li>
						</ul>
					</div>
					<!-- end box / title -->
					<div id="box-left-forms" style="margin-top:0px;">
					  <table class="category" border="0">
					  <thead>
					  <tr>
					   <th>SL</th>
					   <th>Name</th>
					   <th>Join Date</th>
					   <th>Image</th>
					  </tr>
					  </thead>
					  <tbody>
					  <tr>
					  <?php
					    $latestMember=mysqli_query($con, "SELECT MemberID,CONCAT(MemberFirstName,' ',MemberLastName) AS 'Name',JoinDate,MemberImage
						  FROM member_info  ORDER BY MemberID DESC LIMIT 5");
						  $sl=0;
						while($latestMemberRow=mysqli_fetch_row($latestMember))
						{
					   ?>
					   <td align="center"><?php print ++$sl; ?></td>
					   <td align="center"><a href="#" onclick="window.open('member_view.php?MemberID=<?php print $latestMemberRow[0] ?>','member_view','width=500px, height=480px, left=200px');"><?php print $latestMemberRow[1]; ?></a></td>
					   <td align="center"><?php print substr($latestMemberRow[2],0,10); ?></td>
					   <td align="center"><img src="../memberimage/<?php print $latestMemberRow[3]; ?>" width="50" height="40"></td>
					  </tr>
					  <?php } ?>
					  </tbody>
					  </table>
					</div>
					<div id="box-left-other">
                    			  <table class="category" border="0">
					  <thead>
					  <tr>
					   <th>SL</th>
					   <th>Invoice ID</th>
					   <th>Invoice Date</th>
					  
					  </tr>
					  </thead>
					  <tbody>
					  <tr>
					  <?php
					    $latestOrder=mysqli_query($con, "SELECT
			sales_info.InvoiceID
			, sales_info.InvoiceDate
			, member_info.MemberID
			,CONCAT(member_info.MemberFirstName,' ', member_info.MemberLastName) as 'Member Name'
			, SUM(sales_details_info.ProductPrice*sales_details_info.ProductQuantity) as 'Total Amount'
			
		FROM
		   sales_info
			INNER JOIN member_info 
				ON (sales_info.BuyerID = member_info.MemberID)
			INNER JOIN sales_details_info 
				ON (sales_info.InvoiceID = sales_details_info.InvoiceID)
		GROUP BY sales_info.InvoiceID ORDER BY sales_info.InvoiceID DESC LIMIT 5");
						  $sl=0;
						while($latestOrderRow=mysqli_fetch_row($latestOrder))
						{
					   ?>
					   <td align="center"><?php print ++$sl; ?></td>
					 <td align="center"><a href="order_details.php?ID=<?php print $latestOrderRow[0]; ?>" ><?php print $latestOrderRow[0]; ?></a></td>
					   <td align="center"><?php print substr($latestOrderRow[1],0,10); ?></td>
					   
					  </tr>
					  <?php } ?>
					  </tbody>
					  </table>
				</div>
				</div>
				<!-- end box / left -->
				<!-- box / right -->
				<div class="box box-right">
					<!-- box / title -->
					<div class="title">
						<h5>Some Part will be here</h5>
				  </div>
					<!-- end box / title -->
					<h2>&nbsp;</h2>
					<ol class="decimal">
						<li> Programs1</li>
						<li>Programs2</li>
						<li>Programs3</li>
						<li>Programs4</li>
						<li> Programs5</li>
						  <!-- end headings -->
                </li>
				  </ol>
				  </div>
				  
				  <div class="box" style="margin-top:0px;">
				<div id="box-left-tabs" class="box box-left box-padding">
					<!-- box / title -->
					<div class="title">
						<h5>Latest</h5>
						<ul class="links">
							<li><a href="#box-left-forms2">Product</a></li>
							<li><a href="#box-left-other2">Another Part</a></li>
						</ul>
					</div>
					<!-- end box / title -->
					<div id="box-left-forms2" style="margin-top:0px;">
					  <table class="category" border="0">
					  <thead>
					  <tr>
					   <th>SL</th>
					   <th>Name</th>
					   <th>Price</th>
					   <th>Image</th>
					  </tr>
					  </thead>
					  <tbody>
					  <tr>
					  <?php
					    $latestProduct=mysqli_query($con, "SELECT
													ProductID
													, ProductName
													, Price
													
												FROM
													product_info
												WHERE cattype='sscat' ORDER BY ProductID DESC  LIMIT 5");
						  $sl=0;
						while($latestProductRow=mysqli_fetch_row($latestProduct))
						{
					   ?>
					   <td align="center"><?php print ++$sl; ?></td>
					   <td align="center"><?php print $latestProductRow[1]; ?></td>
					   <td align="center"><?php print $latestProductRow[2]; ?></td>
					   <td align="center">Product Image</td>
					  </tr>
					  <?php } ?>
					  </tbody>
					  </table>
					</div>
					<div id="box-left-other2">
                    			  <table class="category" border="0">
					  <thead>
					  <tr>
					   <th></th>
					   <th></th>
					   <th></th>
					   <th></th>
					  </tr>
					  </thead>
					  <tbody>
					  <tr>
					
					  </tbody>
					  </table>
				</div>
				</div>
				<!-- end box / left -->
				<!-- box / right -->
				<div class="box box-right">
					<!-- box / title -->
					<div class="title">
						<h5>Some Part will be here</h5>
					</div>
					<!-- end box / title --></div>
				<!-- end box / right -->

			</div>
			<!-- end content / right -->
		</div>
		</div>
				<!-- end table -->
			
				<!-- messages -->
				
				<!-- end box / left -->
				<!-- box / right -->
				
				<!-- end box / right -->
	
    
    <div style="clear:both;">
    </div>
    

			<!-- end content / right --><!-- end content -->
		<!-- footer -->
	<?php include("footer.php"); ?>
		<!-- end footert -->
	</body>
</html>