<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
	   $msg="Order Details";
	  $TotalPage=mysqli_query($con, "SELECT COUNT(InvoiceID)-1 FROM sales_info");
	  $sss=mysqli_fetch_row($TotalPage);
	 $recpos=isset($_REQUEST["recpos"])?$_REQUEST["recpos"]:0;
	 
	   if(isset($_REQUEST["btnnext"]))
	   {
	     $recpos++; 
		 if($recpos>$sss[0])
		 {
		 $recpos=$sss[0];
		 $msg="This is Last Order";
		 }
		 else
		 $msg="This is Next Order";
	   }
	  if(isset($_REQUEST["btnprevious"]))
	   {
	     $recpos--; 
		 if($recpos<0)
		 {
		 $recpos=0;
		 $msg="This is First Order";
		 }
		 else
		 $msg="This is Previous Order";
	   }
	 
	 $invoice_id_take=mysqli_fetch_row(mysqli_query($con, "SELECT InvoiceID FROM sales_info ORDER BY InvoiceID DESC LIMIT $recpos,1"));
	 
    $_REQUEST["InvoiceID"]=$invoice_id_take[0];
	$_REQUEST["ID"]=$invoice_id_take[0];
	  if(isset($_REQUEST["btncomplete"]))
	  {
	  
	   
	    $rs=mysqli_query($con, "UPDATE sales_info SET ActiveStatus='".$_REQUEST["SelectStatus"]."' WHERE InvoiceID='".$_REQUEST["ID"]."'");
		//$insert=mysqli_query($con, "INSERT INTO invoice_status_comments (InvoiceID,OrderStatus,Comments)
		// VALUES('".$_REQUEST["ID"]."','".$_REQUEST["SelectStatus"]."','".$_REQUEST["StatusComments"]."')");
		// print $_REQUEST["OrderStatus"];
		  if($_REQUEST["OrderStatus"]=="Out For Deliverey")
			{
				
		 					$query= mysqli_query($con, "SELECT sales_info.ShiftID,sales_info.SessionID,
							sales_details_info.ProductID
 							from sales_info inner join sales_details_info 
							on sales_info.InvoiceID=sales_details_info.InvoiceID  where sales_info.InvoiceID='".$_REQUEST["ID"]."'");
							while($row=mysqli_fetch_row($query))
							{
							//print $row[2];
							 $pdtLen=strlen($row[2]);
							if($pdtLen==8)
							{
								$updateQuery=mysqli_query($con, "SELECT 
								sales_details_info.ProductID,(product_info.Stock-sales_details_info.ProductQuantity)as 'Stock'
								from sales_info inner join sales_details_info 
								on sales_info.InvoiceID=sales_details_info.InvoiceID 
								inner join product_info on product_info.ProductID = sales_details_info.ProductID 
								where sales_info.InvoiceID='".$_REQUEST["ID"]."' AND sales_details_info.ProductID='".$row[2]."'");
								while($updateQueryRow=mysqli_fetch_row($updateQuery))
								{
									$rs=mysqli_query($con, "UPDATE product_info SET Stock='".$updateQueryRow[1]."' WHERE ProductID='".$updateQueryRow[0]."'");
								}
							}
							else if($pdtLen==13)
							{
								$updateQuery=mysqli_query($con, "SELECT      
								sales_details_info.ProductID,(product_details.Qty-sales_details_info.ProductQuantity)as
								'Stock' from sales_info inner join sales_details_info 
								on sales_info.InvoiceID=sales_details_info.InvoiceID 
								inner join product_details on product_details.ProductFullID = sales_details_info.ProductID 
								where sales_info.InvoiceID='".$_REQUEST["ID"]."' AND sales_details_info.ProductID='".$row[2]."'");
								while($updateQueryRow=mysqli_fetch_row($updateQuery))
								{
									$rs=mysqli_query($con, "UPDATE product_details SET product_details.Qty='".$updateQueryRow[1]."'WHERE ProductID='".$updateQueryRow[0]."'");
								}
							}
							else
							{
								
							}
							$del_cart=mysqli_query($con, "DELETE FROM shopping_cart WHERE SessionID='".$row[1]."'");
						}
			}
			else
			{
				
			}
		    /* $pepeelika_mail=mysqli_fetch_row(mysqli_query($con, "SELECT name FROM contact_info WHERE id='1'"));
			//$pepeelika_mail[0]="shahadatcmt94@gmail.com";
			$shipping=mysqli_fetch_row(mysqli_query($con, "SELECT
											shiftment_address.Email
											,shiftment_address.Name
										FROM
											sales_info
											INNER JOIN shiftment_address 
												ON (sales_info.ShiftID = shiftment_address.ShiftID)
										WHERE sales_info.InvoiceID='".$_REQUEST["ID"]."'"));
			$shipping_info[3]=$shipping[0];
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers  .= "From: $pepeelika_mail[0]\r\n"; 
			$subject= "PEPEELIKA ORDER ".$_REQUEST["ID"]." has been updated as ".$_REQUEST["SelectStatus"];
			$msg="Dear Mr. ".$shipping_info[3].",\n";
			$msg.="Your order is now ".$_REQUEST["SelectStatus"]."\n";
			$msg.=$_REQUEST["StatusComments"]."\n\n";
			$msg.="      Administrator \n";
			$msg.="           of \n";
			$msg.="        PEPEELIKA \n";
			$msg.="Email: ".$pepeelika_mail[0];
			mail($shipping_info[3], $subject, $msg, $headers);
			
		
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers  .= "From: $shipping_info[3]\r\n"; 
		
			
			mail($pepeelika_mail[0], $subject, $msg, $headers);*/
		 
		$msg="<script>alert('Updated Order...');</script>";
		$_REQUEST["InvoiceID"]=$_REQUEST["ID"];
	  }
	  if(isset($_REQUEST["btndelete"]))
	  {
	    $row=mysqli_fetch_row(mysqli_query($con, "SELECT ShiftID,SessionID FROM sales_info WHERE InvoiceID='".$_REQUEST["ID"]."'"));
		 $del_shipping=mysqli_query($con, "DELETE FROM shiftment_address WHERE ShiftID='".$row[0]."'");
		 $del_sales_details=mysqli_query($con, "DELETE FROM sales_details_info WHERE InvoiceID='".$_REQUEST["ID"]."'");
		 $del_sales_=mysqli_query($con, "DELETE FROM sales_info WHERE InvoiceID='".$_REQUEST["ID"]."'");
		 $del_cart=mysqli_query($con, "DELETE FROM shopping_cart WHERE SessionID='".$row[1]."'");
		 $del_promo=mysqli_query($con, "DELETE FROM promotional_temporary WHERE SessionID='".$row[1]."'");
		$msg="Deleted Order...";
		if($recpos<$sss[0]-1)
		 $recpos++;
		else $recpos--;
		$invoice_id_take=mysqli_fetch_row(mysqli_query($con, "SELECT InvoiceID FROM sales_info ORDER BY InvoiceID DESC LIMIT $recpos,1"));
	 
       $_REQUEST["InvoiceID"]=$invoice_id_take[0];
	   $_REQUEST["ID"]=$invoice_id_take[0];
	  }
// 	if(isset($_POST["btnUpdate"]))
//		{
//			$b=$_POST["txtqty"];
//			$qrs=mysqli_query($con, "SELECT InvoiceDetailsID,ProductQuantity FROM sales_details_info WHERE InvoiceID='".$_REQUEST["ID"]."'");
//			$i=0;
//			while($qrow=mysqli_fetch_row($qrs))
//				{
//					if($qrow[1] != $b[$i])
//						{
//						$prs=mysqli_query($con, "update sales_details_info set
//						 ProductQuantity=".$b[$i]." 
//						 where InvoiceDetailsID='".$qrow[0]."' and InvoiceID='".$_REQUEST["ID"]."' ");	
//						}	
//					$i++;
//				}
//				$ID=$_REQUEST["ID"];
//			$activeInvoice=mysqli_query($con, "UPDATE sales_info SET ActiveStatus='Active' WHERE InvoiceID='".$_REQUEST["ID"]."'");	
//			 header("Location:order_details.php?msg=Successfully Updated Quantity&ID=$ID");
//		}
	
	    @$Member=mysqli_query($con,   "SELECT
					sales_info.InvoiceID
					,sales_info.InvoiceDate
					,member_info.MemberID
					, CONCAT(member_info.MemberFirstName,' ', member_info.MemberLastName) as 'Name'
					,sales_info.ActiveStatus
					,sales_info.PaymentID
					
				FROM
					sales_info
					INNER JOIN member_info 
						ON (sales_info.BuyerID = member_info.MemberEmail)
				WHERE sales_info.InvoiceID='".$_REQUEST["ID"]."'");
			$MemberRow=mysqli_fetch_row(@$Member);
	
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
		</script>
    <style type="text/css">
    .btnsdt1 {			background-color:<?php echo $button_background; ?>;
			height:30px;
			padding:5px;
			line-height:10px;
			border-radious:5px;"
}
    .btnsdt11 {background-color:<?php echo $button_background; ?>;
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
					<div class="title">
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:$msg; ?></h5>
						
					  <div class="search" style="width:auto; float:right; color:#FFFFFF; font-size:12px;">
				  <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
						<input type="submit" name="btnprevious" value="Previous" class="btnsdt" style="color:white; height:25px;" />
							<input type="submit" name="btnnext" value="Next" class="btnsdt" style="color:white; height:25px;" />	  
							
						</div>
					</div>
					<!-- end box / title -->
					
						
    
                    <br>
<table width="728" border="0" align="left" cellpadding="0" cellspacing="0">
        
            <tr >
              <td align="right" ><strong>Order ID: </strong></td>
              <td colspan="2" align="left" ><strong><a href="#" onclick="window.open('invoice.php?ID=<?php print $_REQUEST["ID"]?>','Invoice','height=700px,width=760px,top=50px,left=200px,scrollbars=1')"><?php print $_REQUEST["ID"]; ?></a>
                <input type="hidden" name="ID" value="<?php print $_REQUEST["ID"]; ?>" />
                <input type="hidden" name="recpos" value="<?php print $recpos; ?>" />
              </strong></td>
              <td align="right" ><strong>Order Date: </strong></td>
              <td colspan="4" align="left" ><strong><?php print $MemberRow[1]; ?></strong></td>
            </tr>
            <tr >
              <td align="right" ><strong>Customer : </strong></td>
              <td colspan="2" align="left" ><strong><a href="#" onclick="window.open('member_view.php?MemberID=<?php print $MemberRow[2]; ?>','article_select','height=500px,width=450px,align=center,scrolling=yes');"><?php print $MemberRow[3]; ?></a></strong></td>
              <td align="right" ><strong>Order Status : </strong></td>
              <td colspan="4" align="left" ><strong><?php print $MemberRow[4]; ?></strong></td>
            </tr>
            <tr >
              <td colspan="8" align="left" >
			 
			  <strong>Payment Type: </strong><strong><?php print $MemberRow[5]; ?></strong></td>
            </tr>
            <tr >
              <th colspan="8" align="left" >Item List </th>
            </tr>
            
            
            <tr >
              <td width="120" align="center" ><strong>SL</strong></td>
              <td width="72" align="center"  ><strong>Name </strong></td>
              <td width="115" align="center"  ><strong>Style </strong></td>
              <td width="100" align="center"  ><strong>Cat/Sub Cat </strong></td>
              <td width="64" align="center"  ><strong>Color & Size/ Cover</strong></td>
             
              
              <td width="60" align="center"  ><strong>Qty</strong></td>
              <td width="124" align="center" ><strong>Price</strong></td>
              <td width="73" colspan="2" align="center" ><strong>Amount</strong></td>
          </tr>
   		<?php
			
			 
													$view=mysqli_query($con,   "SELECT 
												sales_details_info.ProductID,
												sales_details_info.ProductQuantity,
												sales_details_info.ProductPrice,
												ProductDiscount,
												ProductQuantity*ProductPrice as SubTotal,
												(ProductQuantity*ProductPrice-
												((ProductPrice*ProductDiscount)/100)) 
												as 'Amount'
												,(product_info.ShippingCost) as 'Cost' 
												,(product_info.ShippingCostOutSide) as 'CostOutSide' 
												,shiftment_address.Division as 'Location' ,

												IF(shiftment_address.Division = 'Dhaka City', 

													((sales_details_info.ProductPrice*sales_details_info.ProductQuantity- 
					(sales_details_info.ProductDiscount/100*sales_details_info.ProductPrice*sales_details_info.ProductQuantity))),
		
		 ((sales_details_info.ProductPrice*sales_details_info.ProductQuantity- 
		(sales_details_info.ProductDiscount/100*sales_details_info.ProductPrice*sales_details_info.ProductQuantity)))) AS 'CreditCardTotal' ,
												product_info.ProductName
												FROM sales_info  
												LEFT JOIN sales_details_info ON (sales_info.InvoiceID = sales_details_info.InvoiceID) 
												INNER JOIN product_info 
        										ON (sales_details_info.SerialNo = product_info.SerialNo)
												INNER JOIN shiftment_address
       											ON(sales_info.ShiftID=shiftment_address.ShiftID)
	   											WHERE sales_details_info.InvoiceID='".$_REQUEST["InvoiceID"]."'");
											$sl=0;
											$total=0;
											$vat=0;
											while($viewRow=mysqli_fetch_array($view))
											{
													$promocheck = mysqli_fetch_row(mysqli_query($con, "SELECT promotional_code.Discount FROM
                                                                     sales_info
                                                                   INNER JOIN promotional_code 
                                                                ON (sales_info.PromotionalID = promotional_code.PromotionalID)
                                                                 WHERE sales_info.InvoiceID='".$_REQUEST["InvoiceID"]."'"));
						
				   	  
												    if($promocheck[0]!="")
												   {
													  $promocheck[0] = ($promocheck[0]/100*$viewRow[4]); 
													  $viewRow[3]=$viewRow[3]+$promocheck[0];
													  $viewRow[5] = $viewRow[5]-$promocheck[0];  
												   }
												   /*if($row[8]=="Dhaka City")
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
													if($viewRow[3]>0)
													$pdt_price="<span style=' text-decoration:line-through;'>
													 BDT: ".number_format($viewRow[5],'2','.',',')."</span> "." ".$viewRow[3]."% OFF";
													 else
													 $pdt_price="";
													 $price_without_discount=$viewRow[4];
/*($viewRow[2]*$viewRow[1])-($viewRow[3]/100*$viewRow[2]*$viewRow[1]);*/
													if($viewRow[8]=="Dhaka City")
													 {
													 $shipping_cost=$viewRow[6];
													 	if($totalShippingCoast<$shipping_cost)
															$totalShippingCoast=$shipping_cost;
													 }
													 else if($viewRow[8]!="Dhaka City")
													 {
													  $shipping_cost=$viewRow[7];	 
													  if($totalShippingCoast<$shipping_cost)
															$totalShippingCoast=$shipping_cost;
													 }
																						  
													  $sub_total+=$viewRow[5];
													  ///$totalShippingCoast=$shipping_cost;
													  $total+=$viewRow[9];
													  
	                                              ?>
            <tr>
              <td height="30" align="center"><?php print ++$sl; ?></td>
              <td align="center"  >
			  <?php
			  	$cover=mysqli_fetch_row(mysqli_query($con,  "SELECT Cover_type FROM phonecover_type 
									INNER JOIN sales_info on sales_info.SessionID=phonecover_type.SessionID
									 WHERE InvoiceID='".$_REQUEST["InvoiceID"]."' AND 
									 SerialNo=(SELECT SerialNo FROM product_info WHERE ProductID='".$viewRow[0]."')"));
									 if($cover[0] !="")
									 	$covername=$viewRow[10]."-<b>(".$cover[0].")</b>";
										else
										$covername=$viewRow[10];
							   print "<a href=\"#\" onclick=\"window.open('product_view.php?ProductID=$viewRow[0]','article_select','height=500px,width=455px,align=center, valign=top, scrollbars=1');\"><strong>".strlen($viewRow[0])==13 ? $viewRow[0] : $covername."</strong></a>";
							  
							  
							  
				 ?>
			  </a></td>
              <?php 
			  		 $length=strlen($viewRow["ProductID"]);
					
							$viewrow2=mysqli_fetch_row(mysqli_query($con,   "SELECT StyleName from product_style where StyleID=SUBSTR('".$viewRow["ProductID"]."',1,2)"));	
							$viewrow3=mysqli_fetch_row(mysqli_query($con,   "SELECT CategoryName from product_category_info where CategoryID=SUBSTR('".$viewRow["ProductID"]."',3,1)"));	
							$viewrow4=mysqli_fetch_row(mysqli_query($con,   "SELECT SubCategoryName from product_sub_category where SubCategoryID=SUBSTR('".$viewRow["ProductID"]."',4,2)"));	
							$viewrow5=mysqli_fetch_row(mysqli_query($con,   "SELECT SubCategoryName from product_ssub_category where SubSubCategoryID=SUBSTR('".$viewRow["ProductID"]."',6,3)"));	
							if($length==13)
							{
								$viewrow6=mysqli_fetch_row(mysqli_query($con,    "SELECT ColorName from color_list where ColorID=SUBSTR('".$viewRow["ProductID"]."',9,3)"));	
							$viewrow7=mysqli_fetch_row(mysqli_query($con,    "SELECT UnitName from product_unit where UnitID=SUBSTR('".$viewRow["ProductID"]."',12,2)"));	
							}
							else
							{
								$viewrow6[0]="";
								$viewrow7[0]="";
							}
				
			  
			  ?>
              <td align="center"><?php print $viewrow2[0]; ?></td>
              <td align="center"><?php print $viewrow3[0]."-></br>".$viewrow4[0]."-></br>".$viewrow5[0]; ?></td>
              <td align="center"><?php $length==13 ? print "Color-<b>".$viewrow6[0]."</b> </br>&</br> Size- <b>" .$viewrow7[0]."</b>" : ""; ?></td>
              <td align="center"><?php print $viewRow[1]; ?></td>
              <td align="center">
			  <?php
							    print $pdt_price;
								print "<br>BDT: ".number_format($price_without_discount,'2','.',',');
								 if($viewRow[6]>0)
								print "<br>Shipping Cost- BDT :".number_format($shipping_cost,'2','.',',');
							  ?>			  </td>
              <td colspan="2" align="center">
			  <strong><?php print  "BDT: ".number_format($viewRow[9],'2','.',','); ?></strong>			  </td>
            </tr>
			<?php } ?>
            <tr>
              <td height="30" colspan="8" align="right">Sub Total(BDT): <?php print number_format($sub_total,'2','.',','); ?>
			  <br>Shipping Cost(BDT): <?php print @number_format($totalShippingCoast,'2','.',','); ?>
			  <br>
			  <br><strong>Grand Total(BDT): <?php 
			  					$x=intval($total);// <- or an other value from the cleaned user input
								$y=intval($totalShippingCoast);
								$val=$x+$y;
								$val;
			  					print @number_format($val,'2','.',','); ?></strong>			  </td>
            </tr>
			
			<tr>
              <td height="30" colspan="8" align="left">
			                
							<strong>Order Status:</strong>
							
							  <?php
							   if($MemberRow[4]=="Order Created")
							     {
								  $pending="selected=\"selected\"";
								  $processing="";
								  $delivered="";
								  $canceled="";
								 }
							   else if($MemberRow[4]=="Order Complete")
							     {
								  $pending="";
								  $processing="selected=\"selected\"";
								  $delivered="";
								  $canceled="";
								 }
							   else if($MemberRow[4]=="Out For Deliverey")
							     {
								  $pending="";
								  $processing="";
								  $delivered="selected=\"selected\"";
								  $canceled="";
								 }
								 else if($MemberRow[4]=="Order Canceled")
							     {
								  $pending="";
								  $processing="";
								  $delivered="";
								  $canceled="selected=\"selected\"";
								 }
							  ?>
							<select id="SelectStatus" name="OrderStatus">
							 <option value="Order Created" <?php print @$pending; ?>>Order Created</option>
							 <option value="Order Complete" <?php print @$processing; ?>>Order Complete</option>
							 <option value="Out For Deliverey" <?php print @$delivered; ?>>Out For Deliverey</option>
                             
			                </select>
							<?php if($MemberRow[4]!="Out For Deliverey")
							{ ?>			
							<input type="submit" name="btncomplete" value="Update Order" class="btnsdt" style="color:white; height:25px;" />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" name="btndelete" align="right" value="Delete Order" class="btnsdt11" style="color:white; height:25px;" />							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <?php } ?>							  </td>
            </tr>
          </table>

			 
	
			  
			</form>
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