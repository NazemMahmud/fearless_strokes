<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
	$_REQUEST["InvoiceID"]=$_REQUEST["ID"];

/* $sql="SELECT
    sales_info.InvoiceID
    , sales_info.InvoiceDate
    , payment_type.TypeName
    , shipping_method.title
	, shipping_method.amount
FROM
   sales_info
    LEFT JOIN shipping_method 
        ON (sales_info.ShippingID = shipping_method.MethodID)
    LEFT JOIN payment_type 
        ON (sales_info.PaymentID = payment_type.PaymentID)
WHERE sales_info.InvoiceID='".$_REQUEST["InvoiceID"]."'";
$sdt = mysqli_query($con, $sql);*/
 @$invoice=mysqli_fetch_row(mysqli_query($con,  "SELECT sales_info.InvoiceID , sales_info.InvoiceDate ,
 SUM(sales_details_info.ShippingCost) FROM sales_info   
 INNER JOIN sales_details_info ON (sales_info.InvoiceID = 
 sales_details_info.InvoiceID) WHERE sales_info.InvoiceID='".$_REQUEST["InvoiceID"]."'"));


$msg="";
print "<p align=\"right\"><a href=\"javascript:window.print()\" class=\"printlink\">Print</a></p>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
    	<style type="text/css" media="print">
		.printlink
		{
			display:none;
		}
		</style>
    </head>
   <body>
   <table width="200" height="325" border="0" align="center" style="border:1px solid #999999;">

   <tr>
     <td width="462" ><strong> &nbsp;&nbsp;Order ID: <?php print $invoice[0]; ?></strong></td>
     <td width="181" align="right" ><strong>Order Date: <?php print substr($invoice[1],0,10);?></strong>
     </td>
   </tr>
  
   <tr>
     <td height="27" colspan="2"><table width="597"  align="center" cellpadding="0" cellspacing="0" bordercolor="#999999" >
       <tr>
         <td align="center" bgcolor="#FFFFFF"><strong>RollOut</strong></td>
       </tr>
       <?php
	   $shipping_info=mysqli_fetch_row(mysqli_query($con,   "SELECT
						shiftment_address.Name
						, shiftment_address.Address
						, shiftment_address.Contact
						, shiftment_address.Email
						, village_info.Name
						, union_info.Name
						, thana_info.ThanaName
						, district_info.DistrictName
						, division_info.DivisionName
					FROM
					   sales_info
						INNER JOIN shiftment_address 
							ON (sales_info.ShiftID = shiftment_address.ShiftID)
						LEFT JOIN division_info 
							ON (shiftment_address.Division = division_info.DivisionID)
						LEFT JOIN district_info 
							ON (shiftment_address.District = district_info.DistrictID)
						LEFT JOIN thana_info 
							ON (shiftment_address.Upazila = thana_info.ThanaID)
						LEFT JOIN union_info 
							ON (shiftment_address.Union_Name = union_info.UnionID)
						LEFT JOIN village_info 
							ON (shiftment_address.Village = village_info.VillageID)
					WHERE sales_info.InvoiceID='".$_REQUEST["InvoiceID"]."'"));
	  ?>
       <tr>
         <td align="center" valign="top">Niketon Heights,Plot-133A(1st Floor)</td>
       </tr>
       <tr>
         <td align="center" valign="top">Block-A,Road-3,Niketon,Gulshan-1</td>
       </tr>
       <tr>
         <td align="center" valign="top">Dhaka-1212</td>
       </tr>
     </table></td>
   </tr>
   <tr>
     <td height="19" colspan="2"><table width="597"  align="center" cellpadding="0" cellspacing="0" bordercolor="#999999" style="border:1px solid #999999;">
       <tr>
         <td align="left" bgcolor="#CCCCCC"><strong>Customer Shipping Address </strong></td>
       </tr>
       <?php
	   $shipping_info=mysqli_fetch_row(mysqli_query($con,   "SELECT
						shiftment_address.Name
						, shiftment_address.Address
						, shiftment_address.Contact
						, shiftment_address.Email
						, village_info.Name
						, union_info.Name
						, thana_info.ThanaName
						, district_info.DistrictName
						, division_info.DivisionName
					FROM
					   sales_info
						INNER JOIN shiftment_address 
							ON (sales_info.ShiftID = shiftment_address.ShiftID)
						LEFT JOIN division_info 
							ON (shiftment_address.Division = division_info.DivisionID)
						LEFT JOIN district_info 
							ON (shiftment_address.District = district_info.DistrictID)
						LEFT JOIN thana_info 
							ON (shiftment_address.Upazila = thana_info.ThanaID)
						LEFT JOIN union_info 
							ON (shiftment_address.Union_Name = union_info.UnionID)
						LEFT JOIN village_info 
							ON (shiftment_address.Village = village_info.VillageID)
					WHERE sales_info.InvoiceID='".$_REQUEST["InvoiceID"]."'"));
	  ?>
       <tr>
         <td valign="top" style="padding-left:2px"><strong>Name:</strong><?php print $shipping_info[0]."<br>"; ?> A<strong>ddress</strong>:<?php print $shipping_info[1]."<br>"; ?> <strong>Contact Number:</strong><?php print $shipping_info[2]."<br>"; ?><strong> Email:</strong><?php print $shipping_info[3]."<br>"; ?> <?php print $shipping_info[4]."<br>"; ?>
           <?php 
	    $shipping_address="";
	  if($shipping_info[5]!="") 
         $shipping_address.=$shipping_info[5].", ";
     if($shipping_info[6]!="") 
        $shipping_address.=$shipping_info[6].", ";
	  if($shipping_info[7]!="") 
        $shipping_address.=$shipping_info[7].", ";
	 if($shipping_info[8]!="") 
	   $shipping_address.=$shipping_info[8]." ";

	  if($shipping_address!="")
	  { print $shipping_address."<br>"; 
	  ?>
           <?php } ?></td>
       </tr>
     </table></td>
   </tr>
   <tr>
     <td height="19" colspan="2" align="left" valign="top"  style="border-top:1px solid #999999;" >&nbsp;</td>
   </tr>
   <tr>
     <td height="20" colspan="2" align="left" valign="top"  style="border-bottom:1px solid #999999;" ><strong>Payment Method:
       <?php
		$sql=mysqli_fetch_row(mysqli_query($con, "SELECT PaymentID FROM sales_info Where  InvoiceID='".$_REQUEST["InvoiceID"]."'"));
		print $sql[0];
	?>
     </strong></td>
   </tr>
   <tr>
     <td height="19" colspan="2" align="left" valign="top" >&nbsp;</td>
   </tr>
   <tr>
     <td height="51" colspan="2" align="center" valign="top"><table width="647"  cellspacing="1" cellpadding="2" style="border:1px solid #999999;">
       <tr  style="border:1px solid #999999;">
              <td width="50" align="center" style="border:1px solid #999999;"><strong>SL</strong></td>
              <td width="80" align="center" style="border:1px solid #999999;" ><strong>Name </strong></td>
              <!--<td width="115" align="center"  ><strong>Style </strong></td>-->
              <!--<td width="100" align="center"  ><strong>Cat/Sub Cat </strong></td>-->
              <td width="100" align="center"  style="border:1px solid #999999;"><strong>Color & Size/ Cover</strong></td>
             
              
              <td width="50" align="center"  style="border:1px solid #999999;"><strong>Qty</strong></td>
              <td width="124" align="center" style="border:1px solid #999999;" ><strong>Price</strong></td>
              <td width="73" colspan="2" align="right"  style="border:1px solid #999999;"><strong>Amount</strong></td>
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
       <tr style="border:1px solid #999999;">
              <td height="30" align="center" style="border:1px solid #999999;"><?php print ++$sl; ?></td>
              <td align="center"  style="border:1px solid #999999;">
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
             <!-- <td align="center"><?php //print $viewrow2[0]; ?></td>-->
             <!-- <td align="center"><?php //print $viewrow3[0]."-></br>".$viewrow4[0]."-></br>".$viewrow5[0]; ?></td>-->
              <td align="center" style="border:1px solid #999999;"><?php $length==13 ? print "Color-<b>".$viewrow6[0]."</b> & Size- <b>" .$viewrow7[0]."</b>" : print "N/A"; ?></td>
              <td align="center" style="border:1px solid #999999;"><?php print $viewRow[1]; ?></td>
              <td align="center" style="border:1px solid #999999;">
			  <?php
							    print $pdt_price;
								print "<br>BDT: ".number_format($price_without_discount,'2','.',',');
								// if($viewRow[6]>0)
								//print "<br>Shipping Cost- BDT :".number_format($shipping_cost,'2','.',',');
							  ?>			  </td>
              <td colspan="2" align="right" style="border:1px solid #999999;">
			  <strong><?php print  "BDT: ".number_format($viewRow[9],'2','.',','); ?></strong>			  </td>
            </tr>
			<?php } ?>
            <tr>
              <td height="30" colspan="8" align="right" style="border:1px solid #999999;">Sub Total(BDT): <?php print number_format($sub_total,'2','.',','); ?>
			  <br>Shipping Cost(BDT): <?php print @number_format($totalShippingCoast,'2','.',','); ?>
			  <br>
			  <br><strong>Grand Total(BDT): <?php 
			  					$x=intval($total);// <- or an other value from the cleaned user input
								$y=intval($totalShippingCoast);
								$val=$x+$y;
								$val;
			  					print @number_format($val,'2','.',','); ?></strong>			  </td>
            </tr>
     </table></td>
   </tr>
   </table>
</body>