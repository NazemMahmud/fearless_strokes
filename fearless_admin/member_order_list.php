<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");

	$msg="Order List";
	if(isset($_POST["btnGo"]) || ( isset($_POST["searchtype"]) && $_REQUEST["searchtype"]=="yes"))
	  {
	     $bDate=$_REQUEST['BDATE'];
		 $eDate=$_REQUEST['EDATE'];
//	     $TotalPage=mysqli_query($con, "SELECT COUNT(InvoiceID) FROM sales_info WHERE   
//		  DATE_FORMAT(InvoiceDate,'%Y-%m-%d')>='".$_REQUEST['BDATE']."'
//		  AND DATE_FORMAT(InvoiceDate,'%Y-%m-%d')<='".$_REQUEST['EDATE']."'");
			  $sss=mysqli_fetch_row($TotalPage);
			 $TotalPagesss=$sss[0]/25;
			 $TotalPageRow=intval($TotalPagesss);
			   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
			   {
				$TotalPageRow=$TotalPageRow+1;    
			   }
			   else 
			   {
				   
			   }
	           $sss[0].=" (Found as your Searched From $bDate To $eDate)";
	 
	 
	    $bgcolor="";
		$recpos=isset($_REQUEST["recpos"])? $_REQUEST["recpos"]:"1";
		$count=($recpos-1)*25;
		$sl=$count;
	  

//         $rs=mysqli_query($con,  "SELECT sales_info.InvoiceID , sales_info.InvoiceDate , sales_info.PaymentID, sales_info.ActiveStatus , 
//							SUM(sales_details_info.ProductPrice*sales_details_info.ProductQuantity- 
//							(sales_details_info.ProductDiscount/100*sales_details_info.ProductPrice*sales_details_info.ProductQuantity)) as 'Total Amount', 
//							MAX(product_info.ShippingCost) as 'Cost' ,
//							MAX(product_info.ShippingCostOutSide) as 'CostOutSide' ,shiftment_address.Division as 'Location' , 
//							IF(shiftment_address.Division = 'Dhaka City', 
//							(SUM(sales_details_info.ProductPrice*sales_details_info.ProductQuantity- 
//							(sales_details_info.ProductDiscount/100*sales_details_info.ProductPrice*sales_details_info.ProductQuantity))+
//							MAX(product_info.ShippingCost)), (SUM(sales_details_info.ProductPrice*sales_details_info.ProductQuantity- 
//							(sales_details_info.ProductDiscount/100*sales_details_info.ProductPrice*sales_details_info.ProductQuantity))+
//							MAX(product_info.ShippingCostOutSide))) AS 'CreditCardTotal' FROM sales_info 
//							LEFT JOIN sales_details_info ON (sales_info.InvoiceID = sales_details_info.InvoiceID) 
//							INNER JOIN product_info ON (sales_details_info.SerialNo = product_info.SerialNo) 
//							INNER JOIN shiftment_address ON(sales_info.ShiftID=shiftment_address.ShiftID)
//								WHERE  DATE_FORMAT(sales_info.InvoiceDate,'%Y-%m-%d')>='".$_REQUEST['BDATE']."' 
//								AND DATE_FORMAT(sales_info.InvoiceDate,'%Y-%m-%d')<='".$_REQUEST['EDATE']."'
//						GROUP BY sales_info.InvoiceID ORDER BY sales_info.InvoiceID DESC LIMIT $count,25");
        
//        order_id, customer_name, customer_email, customer_contact, customer_address, total_price, order_date
//        $rs = mysqli_query($con, "SELECT * FROM purchase_order LIMIT $count,25") ;
        
         $searchtype="&searchtype=yes&BDATE=$bDate&EDATE=$eDate";

	  }
	 else
	 {
	 
	    $TotalPage=mysqli_query($con, "SELECT COUNT(order_id) FROM purchase_order ");
			  $sss=mysqli_fetch_row($TotalPage);
			 $TotalPagesss=$sss[0]/25;
			 $TotalPageRow=intval($TotalPagesss);
			   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
			   {
				$TotalPageRow=$TotalPageRow+1;    
			   }
			   else 
			   {   
			   }
	 
	    $bgcolor="";
		$recpos=isset($_REQUEST["recpos"])? $_REQUEST["recpos"]:"1";
		$count=($recpos-1)*25;
		$sl=$count;
//		   $sql="SELECT sales_info.InvoiceID , sales_info.InvoiceDate , sales_info.PaymentID, sales_info.ActiveStatus , 
//						SUM(sales_details_info.ProductPrice*sales_details_info.ProductQuantity- 
//						(sales_details_info.ProductDiscount/100*sales_details_info.ProductPrice*sales_details_info.ProductQuantity)) as 'Total Amount', 
//						MAX(product_info.ShippingCost) as 'Cost' ,
//						MAX(product_info.ShippingCostOutSide) as 'CostOutSide' ,shiftment_address.Division as 'Location' , 
//						IF(shiftment_address.Division = 'Dhaka City', 
//						(SUM(sales_details_info.ProductPrice*sales_details_info.ProductQuantity- 
//						(sales_details_info.ProductDiscount/100*sales_details_info.ProductPrice*sales_details_info.ProductQuantity))+
//						MAX(product_info.ShippingCost)), (SUM(sales_details_info.ProductPrice*sales_details_info.ProductQuantity- 
//						(sales_details_info.ProductDiscount/100*sales_details_info.ProductPrice*sales_details_info.ProductQuantity))+
//						MAX(product_info.ShippingCostOutSide))) AS 'CreditCardTotal' FROM sales_info 
//						LEFT JOIN sales_details_info ON (sales_info.InvoiceID = sales_details_info.InvoiceID) 
//						INNER JOIN product_info ON (sales_details_info.SerialNo = product_info.SerialNo) 
//						INNER JOIN shiftment_address ON(sales_info.ShiftID=shiftment_address.ShiftID) 
//						GROUP BY sales_info.InvoiceID ORDER BY sales_info.InvoiceID DESC LIMIT $count,25";
         
         //        order_id, customer_name, customer_email, customer_contact, customer_address, total_price, order_date
        $rs = mysqli_query($con, "SELECT * FROM purchase_order ORDER BY order_id desc LIMIT $count,25") ;
//	    $rs=mysqli_query($con, $sql);

      $searchtype="&searchtype=no";
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
			background-color:<?php echo $button_background; ?>;
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
		</script></head>
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
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:$msg; ?></h5>
						
						<div class="search" style="width:auto; float:right; color:#FFFFFF; font-size:12px;">
							<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customersss" method="post" enctype="multipart/form-data">
							  
							  <strong>Begining Date:</strong>
									<input name="BDATE" type="text" id="BDATE" class="date" size="10" />
									
							 <strong>Ending Date:</strong>
									<input name="EDATE" type="text" id="EDATE" size="10" />
								
								
									<input type="submit" name="btnGo" value="Search" class="btnsdt" style="color:white; height:25px;" />
								
							</form>
						</div>
					</div>
					<!-- end box / title -->
					 <div class="pagination pagination-left" style="margin-top:0px; background-color:#FFFFFF;" >
    <div class="results" style="margin-top:0px; color:#FFFFFF;">
	<span >Total Order: <?php print $sss[0]; ?></span>
	</div>
	</div>	
						
    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
  <table width="728" border="0" align="left" cellpadding="0" cellspacing="0">
           <thead>
            <tr >
              <th width="40" align="center" ><strong>SL</strong></th>
              <th width="92" align="center"  ><strong> Order ID </strong></th>
<!--              <th width="92" align="center"  ><strong>Payment Type </strong></th>-->
              <th width="150" align="center"  ><strong>Order Date </strong></th>
             
<!--              <th width="76" align="center"  ><strong>Status </strong></th>-->
              <th width="109" align="center" ><strong>Order Total  (BDT) </strong></th>
              <th width="143" align="center" ><strong>Action</strong></th>
          </tr>
		  </thead>
		  <tbody>
       		<?php
			
			$sl=0;
              
			  while($row=mysqli_fetch_row($rs))
			  {		++$sl;
			     
				 $promocheck = mysqli_fetch_row(mysqli_query($con, "SELECT promotional_code.Discount FROM
                                                                     sales_info
                                                                   INNER JOIN promotional_code 
                                                                ON (sales_info.PromotionalID = promotional_code.PromotionalID)
                                                                 WHERE sales_info.InvoiceID='".$row[0]."'"));
						
				   	  
					   if($promocheck[0]!="")
					   {
						  $promocheck[0] = ($promocheck[0]/100*$row[4]); 
						  $row[8] = $row[8]-$promocheck[0];  
					   }
				 
				 
			    /* if($row[8]=="Dhaka City")
				 {
				  $row[5]=$row[5]-$row[6];	 
				 }
				 else if($row[8]!="Dhaka City")
				 {
				  $row[5]=$row[5]-$row[7];	 
				 }*/
				  if($sl%2==0)
				  {
				  $bgcolor="bgcolor=\"#999999\"";
				  }
				  else
				  {
					$bgcolor="bgcolor=\"#CCCCCC\"";  
				  }
				  
				  
				 if($row[6]=='Active')
				  {$acinac="InActive";}
				  else
				  {$acinac="Active";}
			?>
<!--              //        order_id, customer_name, customer_email, customer_contact, customer_address, total_price, order_date-->
            <tr <?php print $bgcolor; ?>>
              <td height="30" align="center"><?php print $sl; ?></td> <!-- row serial no.   -->
<!--              <td align="center"  ><a href="#" onclick="window.open('invoice.php?ID=<?php print $row[0]?>','Invoice','height=700px,width=760px,top=50px,left=200px,scrollbars=1')"><?php print $row[0] ?></a></td>-->
              <td align="center"  ><a href="#" ><?php print $row[0] ?></a></td> <!-- order id or invoice id column-->
<!--              <td align="center"  ><?php print $row[2]; ?></td>-->
              <td align="center"><?php print $row[6]; ?></td>  <!-- order date  column-->
<!--              <td align="center"><?php print $row[3] ?></td>-->
              <td align="center"><?php print number_format($row[5],'2','.',',') ?></td>
             
              <td align="center">			    
			  <a  href="order_details.php?ID=<?php print $row[0]; ?>&recpos=<?php print $sl-1; ?>">Order Details</a></td>
            </tr>
              <?php } ?>
			  </tbody>
          </table>
</form>
			 	<div class="pagination pagination-left" style="background-color:#FFFFFF;"  >
			
				 <div class="results">
								<span>Page <?php print $recpos;?> of <?php print $TotalPageRow ?></span>
							</div>
						
				
				
		<ul class="pager" style="float:left;">
        <?php
		   if($recpos<4)
		   $recpos=4;
		   else if($recpos>=$TotalPageRow-3)
		   $recpos=$TotalPageRow-3;
		   //print $recpos;
		  $nxt=$recpos+3;
		  $pre=$recpos-3;
		  $li=0;
		  //$pl=$next+2;
         for($i=$pre;$i<=$nxt+1;$i++)
		 {
			$li++;
		  if($i==$TotalPageRow+1)
		  break;
		  
		  if($i>1 && $li==1)
		  {


		  ?>
		  <li><a href="member_order_list.php?recpos=1<?php print $searchtype ?>">Start</a></li>
		  <li><a href="member_order_list.php?recpos=<?php print $i-1; ?><?php print $searchtype ?>" ><< prev</a></li>
		  <?php } ?>
		  <?php
		  if($li==7+1 && $i<=$TotalPageRow)
		  {
		  // $pl++;
		?>
        
		  <li><a href="member_order_list.php?recpos=<?php print $i; ?><?php print $searchtype ?>">next >></a></li>
     <?php }
	    if($li<=7 && $i>0)
	      { 
		  
		  //$pl++;
		  ?>
          
		  <li><a href="member_order_list.php?recpos=<?php print $i; ?><?php print $searchtype ?>"><?php print $i; ?></a></li>
		<?php }}
		
		?>
        <?php
		 //print $pl;
		if(($i > 7) && ($TotalPageRow >= $nxt+1))
		{
		 ?>
       
		<li><a href="member_order_list.php?recpos=<?php print $TotalPageRow; ?><?php print $searchtype ?>">End</a></li>
		<?php } ?>
		</ul>
		
			</div></div>
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