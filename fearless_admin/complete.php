<?php
  require_once("wish_cart_session.php");
  
  require_once("rollout_admin/connection.php");
  
  if(empty($_SESSION["success_step"]))
$_SESSION["success_step"]=0;
  
  if(isset($_REQUEST["success"]) && $_REQUEST["success"]=="ok")
  {
		$Inv_Buyer = mysqli_fetch_row(mysqli_query($con, "SELECT InvoiceID,BuyerID FROM sales_info 
	WHERE SessionID='".$_SESSION["id"]."' ORDER BY InvoiceID DESC LIMIT 1"));
	$_REQUEST["InvoiceID"]=$Inv_Buyer[0];


 @$invoice=mysqli_fetch_row(mysqli_query($con,  "SELECT sales_info.InvoiceID , sales_info.InvoiceDate ,
 SUM(sales_details_info.ShippingCost) FROM sales_info   
 INNER JOIN sales_details_info ON (sales_info.InvoiceID = 
 sales_details_info.InvoiceID) WHERE sales_info.InvoiceID='".$_REQUEST["InvoiceID"]."'"));


$msg="";

?>

<?php 
   $msg ='<table width="200" height="325" border="0" align="center" style="border:1px solid #999999;">

   <tr>
     <td width="462" ><strong> &nbsp;&nbsp;Order ID: '.$invoice[0].'</strong></td>
     <td width="181" align="right" ><strong>Order Date: '.substr($invoice[1],0,10).'</strong>
     </td>
   </tr>
  
   <tr>
     <td height="27" colspan="2"><table width="597"  align="center" cellpadding="0" cellspacing="0" bordercolor="#999999" >
       <tr>
         <td align="center" bgcolor="#FFFFFF"><strong>RollOut</strong></td>
       </tr>'; ?>
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
       <?php $msg .='<tr>
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
       </tr>'; ?>
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
      <?php $msg .= '<tr>
         <td valign="top" style="padding-left:2px"><strong>Name:</strong>'.$shipping_info[0].'<br> A<strong>ddress</strong>: '.$shipping_info[1].'<br> <strong>Contact Number:</strong>'.$shipping_info[2].'<br><strong> Email:</strong>'.$shipping_info[3].'<br>'.$shipping_info[4].'<br> '?>
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
	  { $msg.= $shipping_address."\n"; 
	  ?>
           <?php } ?><?php $msg .= '</td>
       </tr>
     </table></td>
   </tr>
   <tr>
     <td height="19" colspan="2" align="left" valign="top"  style="border-top:1px solid #999999;" >&nbsp;</td>
   </tr>
   <tr>
     <td height="20" colspan="2" align="left" valign="top"  style="border-bottom:1px solid #999999;" ><strong>Payment Method:'; ?>
       <?php
		$sql=mysqli_fetch_row(mysqli_query($con, "SELECT PaymentID FROM sales_info Where  InvoiceID='".$_REQUEST["InvoiceID"]."'"));
		$msg .=$sql[0];
	?>
     <?php $msg .= '</strong></td>
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
              <td width="73" colspan="2" align="center"  style="border:1px solid #999999;"><strong>Amount</strong></td>
          </tr>'; ?>
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
      <?php $msg .= '<tr style="border:1px solid #999999;">
              <td height="30" align="center" style="border:1px solid #999999;">'.++$sl.'?></td>
              <td align="center"  style="border:1px solid #999999;">'; ?><?php
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
				 <?php $msg.='</a></td>'?>
				 
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
                 
				 <?php $msg .= '<td align="center" style="border:1px solid #999999;"><?php $length==13 ? print "Color-<b>".$viewrow6[0]."</b> & Size- <b>" .$viewrow7[0]."</b>" : ""; ?></td>
              <td align="center" style="border:1px solid #999999;">'.$viewRow[1].'</td>
              <td align="center" style="border:1px solid #999999;">'; ?>
              
              <?php
							    print $pdt_price;
								print "<br>BDT: ".number_format($price_without_discount,'2','.',',');
								// if($viewRow[6]>0)
								//print "<br>Shipping Cost- BDT :".number_format($shipping_cost,'2','.',',');
							  ?>	
                              <?php $msg.="</td>
              <td colspan='2' align='center' style='border:1px solid #999999;'>
			  <strong>BDT: ".number_format($viewRow[9],'2','.',',')."</strong>			  </td>
            </tr>"?>
       <?php } ?>
       <?php $msg .= '<tr>
              <td height="30" colspan="8" align="right" style="border:1px solid #999999;">Sub Total(BDT): '. number_format($sub_total,'2','.',',').'
			  <br>Shipping Cost(BDT):'.@number_format($totalShippingCoast,'2','.',',').'?>
			  <br>
			  <br><strong>Grand Total(BDT):'.
			  					$x=intval($total);// <- or an other value from the cleaned user input
								$y=intval($totalShippingCoast);
								$val=$x+$y;
								$val;
			  					@number_format($val,'2','.',',').'</strong>			  </td>
            </tr>
     </table></td>
   </tr>
   </table>';?>
   <?php
     $to = $Inv_Buyer[1];

   $subject = 'Rollout::Your Order is Being Processed';

   $headers = "From: " . strip_tags('rollout.clothing@gmail.com') . "\r\n";
   $headers .= "Reply-To: ". strip_tags('rollout.clothing@gmail.com') . "\r\n";
   $headers .= "CC: yousuf.syed7@gmail.com\r\n";
   $headers .= 'Bcc: rony.mozumder@controln.net' . "\r\n";
   $headers .= "MIME-Version: 1.0\r\n";
   $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
   
   $message = '<html><body>'.$msg.'</body></html>';
   mail($to, $subject, $message, $headers);
   
   
   
   $from = $Inv_Buyer[1];
   $to = "rollout.clothing@gmail.com";
   $headers = "From: " . strip_tags($from) . "\r\n";
   $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
   $headers .= "CC: yousuf.syed7@gmail.com\r\n";
   $headers .= 'Bcc: rony.mozumder@controln.net' . "\r\n";
   $headers .= "MIME-Version: 1.0\r\n";
   $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
   

   $subject = 'Rollout::A New Order Has Been Created';
   mail($to, $subject, $message, $headers);
	
	
	mysqli_query($con, "DELETE FROM shopping_cart WHERE SessionID='".$_SESSION["id"]."'");
	unset($_SESSION["success_step"],$_SESSION["cartcount"],$_SESSION["cartdetails"],$_SESSION["MemberEmail"],$_SESSION["id"]);
	print "<script>location.href='index.php'</script>";
  }
  
  
  if(isset($_REQUEST["loginval"]) && $_REQUEST["loginval"]=="1")
  {
	$chk = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(MemberID) FROM member_info
	 WHERE MemberEmail='".$_REQUEST["email"]."' AND MemberPassword=PASSWORD('".$_REQUEST["password"]."')"));  
	 if($chk[0] > 0)
	 {
		 $_SESSION["success_step"]=1;
		 $_SESSION['MemberEmail']=$_REQUEST["email"];
		 print "<script>location.href='complete.php'</script>";
	 }
	 else
	 {
		 print "<script>alert('Try another Email and Password!')</script>";
	 }
  }
  if(isset($_REQUEST["regdata"]) && $_REQUEST["regdata"]==1)
  {
	
	
	
	 $member_id = MakeID($con, "member_info","MemberID","MEM-",15);
	 $date = MakeDate();
	 if(mysqli_query($con, "INSERT INTO member_info (MemberID,MemberFirstName,MemberLastName,MemberAddress,
	 MemberContact,MemberEmail,MemberPassword,JoinDate,ActiveStatus,PromotionalCode)
	VALUES('".$member_id."','".$_REQUEST["rFirstName"]."','".$_REQUEST["rLastName"]."','".$_REQUEST["rAddress"]."',
	'".$_REQUEST["rContactNumber"]."','".$_REQUEST["remail"]."',PASSWORD('".$_REQUEST["rpassword"]."'),'".$date."',
	'Active','')"))
	 {
	  	$_SESSION['MemberEmail']=$_REQUEST["remail"];
		$_SESSION["success_step"]=1;
		 print "<script>alert('Registration Successful')</script>";	
		 print "<script>location.href='complete.php'</script>";	 
	 }
	 else
	 {
		 print "<script>alert('Registration Faild! Try Again.')</script>";	
	 }
  }
 if(isset($_REQUEST["sval"]) && $_REQUEST["sval"]=="1")
  {
	
	
	
	 $shiping_id = MakeID($con, "shiftment_address","ShiftID","SFT-",20);
	 $date = MakeDate();
	 $sql="INSERT INTO shiftment_address (ShiftID,Name,Address,Contact,
	                                           Email,Division,District,Upazila,
											   Union_Name,Village,sessionid)
	                                          VALUES('".$shiping_id."','".$_REQUEST["sname"]."','".$_REQUEST["saddress"]."',
											  '".$_REQUEST["scontact"]."','".$_REQUEST["semailaddress"]."','".$_REQUEST["division"]."',
											  '','',
											  '','','".$_SESSION["id"]."')";
	 if(mysqli_query($con, $sql))
	 {
		 $invoice_id = MakeID($con, "sales_info","InvoiceID","INV-",20);
		  $sql1="INSERT INTO sales_info (InvoiceID,InvoiceDate,ShiftID, BuyerID,ActiveStatus,PaymentID,
                     SessionID,PromotionalID)
	                VALUES('".$invoice_id."','".$date."','".$shiping_id."',
	               '".$_SESSION['MemberEmail']."','Order Created','','".$_SESSION["id"]."',
	               (SELECT PromotionalID FROM promotional_temporary  where SessionID='".$_SESSION["id"]."'))";
		if(mysqli_query($con, $sql1))
			{
				  $sqla="SELECT
    shopping_cart.ProductID
	, product_info.Price
	, product_info.Discount
    , shopping_cart.ProductQuantity 
    , shopping_cart.SerialNo
	, product_info.ShippingCost
FROM
    shopping_cart
    INNER JOIN product_info 
        ON (shopping_cart.SerialNo = product_info.SerialNo)
WHERE shopping_cart.SessionID='".$_SESSION["id"]."'";
		 			$sales_details = mysqli_query($con, $sqla);
										   while($sales_details_row = mysqli_fetch_row($sales_details))
										   {
											   
											 
											   $invoiceD_id = MakeID($con, "sales_details_info","InvoiceDetailsID","INVD-",20);
											   $sql3= "INSERT INTO sales_details_info 
											   (InvoiceDetailsID,InvoiceID,ProductID,ProductPrice,
											   ProductDiscount,ProductQuantity,SerialNo,ShippingCost)																
											   VALUES('".$invoiceD_id."','".$invoice_id."','".$sales_details_row[0]."',
											   '".$sales_details_row[1]."','".$sales_details_row[2]."','".$sales_details_row[3]."'
											   ,'".$sales_details_row[4]."','".$sales_details_row[5]."')";
											   if(mysqli_query($con, $sql3))
																				$status="true";
																				else
																				$status="false";
																				
										   }
	  	//$_SESSION['MemberEmail']=$_REQUEST["email"];
        /*print "<script>alert('Save Successful')</script>";*/	
		 /*print "<script>location.href='shipping'</script>";*/	 
			}
	 }
	 if($status=="true")
	 {  $_SESSION["success_step"]=2;
		  print "<script>alert('Address saved Successfully')</script>";	
		 print "<script>location.href='complete.php'</script>";	
	 }
	 else
	 {
		 print "<script>alert('Faild to Save! Try Again.')</script>";
		 $delete = mysqli_query($con, "DELETE FROM sales_info WHERE InvoiceID='".$invoice_id."'");	
		 $delete = mysqli_query($con, "DELETE FROM shiftment_address WHERE sessionid='".$_SESSION["id"]."'");	
	 }
  }
  if(isset($_REQUEST["payment_type"]) && $_REQUEST["payment_type"]!="")
  {
	if(mysqli_query($con, "UPDATE sales_info SET ActiveStatus='Order Complete',PaymentID='".$_REQUEST["payment_type"]."' 
	WHERE SessionID='".$_SESSION["id"]."'"))
	{
	  $_SESSION["success_step"]=3;
	  print "<script>location.href='complete.php'</script>";		
	} 
	else
	{
	  print "<script>alert('Incomplete Payment')</script>";
      print "<script>location.href='complete.php'</script>";	
	}
  }
?>
<!DOCTYPE html>
<html >
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $site_name; ?></title>
        
        <!-- META -->
        <meta name="description" content="">
        <meta name="author" content="Solutii Soft">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- END META -->
        
        <!-- CSS -->
        <link type="text/css" rel="stylesheet" href="<?php echo $url_cod; ?>style.css">
        <!-- END CSS -->
        
        <!-- Favicon Icon -->
        <link rel="shortcut icon" href="<?php echo $url_cod; ?>images/favicon.ico">
        
        <!-- Jquery Sticky Navigation Script
        ================================================== -->
        <script src="<?php echo $url_cod; ?>js/jquery-1.10.2.min.js"></script>
        
        <script>
        $(function() {
        
            // grab the initial top offset of the navigation 
            var sticky_navigation_offset_top = $('#sticky_navigation').offset().top;
            
            // our function that decides weather the navigation bar should have "fixed" css position or not.
            var sticky_navigation = function(){
                var scroll_top = $(window).scrollTop(); // our current vertical position from the top
                
                // if we've scrolled more than the navigation, change its position to fixed to stick to top, otherwise change it back to relative
                if (scroll_top > sticky_navigation_offset_top) { 
                    $('#sticky_navigation').css({ 'position': 'fixed', 'top':0, 'left':0 });
                } else {
                    $('#sticky_navigation').css({ 'position': 'relative' }); 
                }   
            };
            
            // run our function on load
            sticky_navigation();
            
            // and run it again every time you scroll
            $(window).scroll(function() {
                 sticky_navigation();
            });
            
            // NOT required:
            // for this demo disable all links that point to "#"
            $('a[href="#"]').click(function(event){ 
                event.preventDefault(); 
            });
            
        });
		
        </script>
        <script type="text/javascript">
		function cart_add(type,id,pdtid)
		{
			//alert("type: "+type+" id: "+pdtid);
		  if(type == "cart")
		  {
			  $.post("LookUp.php",{ func: "CART", id: id, pdtid: pdtid, qty: "1"},
				   function(data)
				   {
					//alert(data.SSSSS); 
				   $('#cart_inc').html(data.SSSSS);
				     if(data.MSG == "Product exist in your cart")
					 {}
					 else if(data.MSG == "")
				     {
					   // alert(data.TTTTT);
					   $('#shortcart').html(data.SSSSS);	
					  $('#sdtcartcount').html(data.TTTTT);	
					    
					 }
				   },"json")	
		  }
		  else  if(type == "wish")
		  {
			  $.post("LookUp.php",{ func: "WISH", id: id, pdtid: pdtid, qty: "1"},
				   function(data)
				   {
					alert(data.SSSSS); 
				  // $('#cart_inc').html(data.SSSSS);
				   
				   },"json")	
		  }
		}
		</script>
        <script type="text/javascript">
			//document.getElementById("for_hide3").style.display='none';
		  function DistrictSelection(searchCode)
		  {
			   $.post("rollout_admin/searchLookup.php",{ func: "DISTRICT", src: searchCode},
		   function(data)
		   {
		   $('#billingDistrict').html(data.SSSSS);
		   },"json")	
				
		  }
		  function UpozillaSelection(searchCode)
		  {
			   $.post("rollout_admin/searchLookup.php",{ func: "AREAFIND", src: searchCode},
		   function(data)
		   {
		   $('#billingAreaName').html(data.SSSSS);
		   },"json")	
				
		  }
		  function UnionSelection(searchCode)
		  {
			   $.post("rollout_admin/searchLookup.php",{ func: "UNION", src: searchCode},
		   function(data)
		   {
		   $('#billingUnionName').html(data.SSSSS);
		   },"json")	
				
		  }
		</script>
      <style type="text/css">
	  .steps-headers {
	text-align: left;
	
}

.nav-steps {
  border: none;
  padding-bottom: 1px; 
  background-color: #efefef;
  display: inline-block;
overflow: hidden; 
}

.nav-steps>li>a {
  margin-right: 0px;
  line-height: 1.428571429;
       width: 200px;
	   padding-left:30px;
	  
}

/* step arrow style */
.nav-steps>.step a:after {
position: absolute;
z-index: 2;
content: '';
top: 0px;
right: -30px;
border-bottom: 23px solid transparent;
border-left: 23px solid #efefef;
border-top: 20px solid transparent;
width: 31px;
}


/* disable step arrow style for last item */
.nav-steps>.step:last-child a:after {
  display: none;
}

/* HOVER STYLE */

/* hover state */
.nav-steps>li a:hover {
  background-color: #a7a7a7;
  color: white;
  border-radius: 0px;  
}



/* step arrow color on hover:after */
.nav-steps .step:hover a:after {
  border-left-color: #a7a7a7;
}

/* ACTIVE STYLE */

/* active state */
.nav-steps>li.active>a, .nav-steps>li.active>a:hover, .nav-steps>li.active>a:focus {
  background-color: #999999;
  color: white;
  border-radius: 0px;
}

/* step arrow color on active:after */
.nav-steps .step.active a:after {
  border-left-color: #999999;
}
.form-group{ font-size:12px;}
	  </style>
    </head>
	<body >
    
<!-- bg slider -->    

		<div id="slideshow-holder">
            <div id="slideshow">
                <img class="gallery" src="<?php echo $url_cod; ?>images/bg/s1.jpg" />
                <img class="gallery" src="<?php echo $url_cod; ?>images/bg/s2.jpg" />
                <img class="gallery" src="<?php echo $url_cod; ?>images/bg/s3.jpg" />
            </div>
        </div>
        
        <script>
            $(function () {
            // Simplest jQuery slideshow by Jonathan Snook
            $('#slideshow img:gt(0)').hide();
            setInterval(function () {
            $('#slideshow :first-child').fadeOut(3000)
            .next('img').fadeIn(3000).end().appendTo('#slideshow');
            }, 6000);
            });
        </script>
        <script type="text/javascript">
		  function check_login()
		  {
			if(document.getElementById('email').value=="")
			{
			  alert("Enter Email Address");	
			  document.getElementById('email').focus();
			  return false;
			} 
			else if(document.getElementById('password').value=="")
			{
			  alert("Enter Password");	
			  document.getElementById('password').focus();
			  return false;
			} 
			else
			{
			  document.getElementById('loginval').value="1";
			  document.login_form.submit();
			  return true;	
			} 
		  }
	 function reg_check()
		{
			if(document.getElementById('remail').value=="")
			{
			  alert("Enter Email Address");	
			  document.getElementById('remail').focus();
			  return false;
			} 
			else if(document.getElementById('rpassword').value=="")
			{
			  alert("Enter Password");	
			  document.getElementById('rpassword').focus();
			  return false;
			} 
			else if($('#rpassword').val().length < 6)
			{
			 	alert("Password will be at least 6 characters.");	
			  document.getElementById('rpassword').focus();
			  return false;
			}
			else if(document.getElementById('rFirstName').value=="")
			{
			  alert("Enter First Name");	
			  document.getElementById('rFirstName').focus();
			  return false;
			} 
			else if(document.getElementById('rLastName').value=="")
			{
			  alert("Enter Last Name");	
			  document.getElementById('rLastName').focus();
			  return false;
			} 
			else if(document.getElementById('rContactNumber').value=="")
			{
			  alert("Enter Contact Number");	
			  document.getElementById('rContactNumber').focus();
			  return false;
			} 
			else
			{
			  document.getElementById('regdata').value="1";	
			  document.reg_form.submit();
			  return true;
			}
		}
		function reg_show()
		{
		 $('#login_form').hide();
		 $('#reg_form').show();
		}
		function ship_check()
		{	
		
			if(document.getElementById('sname').value=="")
			{
			  alert("Enter Your Name");	
			  document.getElementById('sname').focus();
			  return false;
			} 
			else if(document.getElementById('saddress').value=="")
			{
			  alert("Enter Your Address");	
			  document.getElementById('saddress').focus();
			  return false;
			} 
			else if(document.getElementById('scontact').value=="")
			{
			  alert("Enter Contact Number");	
			  document.getElementById('scontact').focus();
			  return false;
			} 
			else if(document.getElementById('semailaddress').value=="")
			{
			  alert("Enter Email Address");	
			  document.getElementById('semailaddress').focus();
			  return false;
			} 
			else if(document.getElementById('division').value=="")
			{
			  alert("Select Your Location");	
			  document.getElementById('division').focus();
			  return false;
			} 
			else
			{
			  document.getElementById('sval').value="1";	
			  document.shipping_form.submit();
			  return true;
			}
		}
		function unselect_hidden_payment_method() 
		{
	
  		if($("#pm20").is(':checked'))
		{
			
			var form_url = $("#reg_form2").attr("action");
    		
    		//changing the action to google.com
    		$("#reg_form2").attr("action","https://www.sslcommerz.com.bd/process/index.php");
    		
    		//submit the form
   		 	$("#reg_form2").submit();
			
			
		}
		else if($("#pm8").is(':checked'))
		{
			document.getElementById('payment_type').value = "Cash";
			
			var form_url = $("#reg_form2").attr("action");
    	
    		$("#reg_form2").attr("action","complete.php");
    		
   		 	$("#reg_form2").submit();
		}
		else if($("#pm2").is(':checked'))
		{
			document.getElementById('payment_type').value = "bKash";
			
			var form_url = $("#reg_form2").attr("action");
    		
    		$("#reg_form2").attr("action","complete.php");
    		
   		 	$("#reg_form2").submit();
		}
  		
		}
		</script>
<!-- bg slider end -->  

<!-- Header -->
		<header>
<!-- Top Header -->        
        	<?php include("top_header.php"); ?>
<!-- Top Header End --> 

<!-- Bottom Header -->			
<?php include("menu.php"); ?>
<!-- Bottom Header End -->
        </header>
<!-- Header End -->        
        
<!-- Wrapper Start -->  
		<div class="wrapper">
<!-- Slider -->  
           <div class="container">
<div class="row shadow">
  <div class="col-md-12" style="padding: 0px 0px 21px 81px">
		<div class="steps-headers">
		<ul class="nav nav-tabs nav-steps">
          <?php if($_SESSION["success_step"]==0)
		       {
		  ?>
			<li class="step active">
				<a href="#" data-toggle="tab">LOGIN OR REGISTER</a>
			</li>
           <?php }
		     else
			 {
		    ?>
            <li class="step">
				<a href="#" data-toggle="tab">LOGIN OR REGISTER</a>
			</li>
            <?php } ?>
			 <?php if($_SESSION["success_step"]==1)
		       {
		  ?>
			<li class="step active">
				<a href="#" data-toggle="tab">SHIPPING</a>
			</li>
           <?php }
		     else
			 {
		    ?>
            <li class="step">
				<a href="#" data-toggle="tab">SHIPPING</a>
			</li>
            <?php } ?>
             <?php if($_SESSION["success_step"]==2)
		       {
		  ?>
			<li class="step active">
				<a href="#" data-toggle="tab">PAYMENT</a>
			</li>
           <?php }
		     else
			 {
		    ?>
            <li class="step">
				<a href="#" data-toggle="tab">PAYMENT</a>
			</li>
            <?php } ?>
            <?php if($_SESSION["success_step"]==3)
		       {
		  ?>
			<li class="step active">
				<a href="#" data-toggle="tab">ORDER COMPLETE</a>
			</li>
           <?php }
		     else
			 {
		    ?>
            <li class="step">
				<a href="#" data-toggle="tab">ORDER COMPLETE</a>
			</li>
            <?php } ?>
		</ul>
		</div>
		<div class="tab-content">
        
			<div class="tab-pane fade  <?php if($_SESSION["success_step"]==0){echo " in active";} ?>" id="facebook-tab">
				<form name="login_form" id="login_form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="row" >
                  <div class="col-md-10" style="  padding:5px 0px 5px; font-size:14px; background-image:url(images/h1-background.gif); background-repeat:100% 100%;">
                   <span style="margin-left:20px; "> SIGN IN TO ROLLOUT</span>
                </div>                
                </div>
                <div class="clearfix" style="height:30px;"></div>
                <div class="row" >
                  <div class="col-md-6" style="margin-left:10px; height:20px; padding:2px 0px 2px; font-size:12px; background-image:url(https://www.next.co.uk/secure/account/content/images/structural/ap/page/h2-background.png); background-repeat:100% 100%;">
                   <div class="pull-left" style="margin-left:10px;">EXISTING CUSTOMER</div>
                   <div class="pull-right" style="padding-right:5px; "><a href="#" style="color:#0f3d77;">Sign in with Email and Password</a></div>
                </div>                
                </div>
                <div class="row" >
                
                <div class="col-md-12"> 
                  <div class="col-md-5 pull-left">
                    
                   <div class="col-md-12 pull-left" style=" margin-top:20px; color:#0f3d77; font-size:14px; font-weight:bold;">Customer Emil Address</div>
                   <div style="height:5px;"></div>
                   <div class="col-md-12 pull-left" style=" margin-top:5px; color:#0f3d77;">
                   <input type="text" name="email" id="email" class="col-md-12 form-control" placeholder="Enter Email Address">
                   </div>
                   <div class="clearfix" style="height:10px; "></div>
                   
               
                   
                   <div class="col-md-12 pull-left" style=" margin-top:20px; color:#0f3d77; font-size:14px; font-weight:bold;">
                   Customer Password</div>
                   <div style="height:5px;"></div>
                   <div class="col-md-12 pull-left" style=" margin-top:5px; color:#0f3d77;">
                   <input type="password" class="col-md-12 form-control" placeholder="Enter Password" name="password" id="password">
                   <input type="hidden" id="loginval" name="loginval" value="0">
                   </div>
                   <div class="clearfix" style="height:10px;"></div>
                   <div class="col-md-12 pull-right" style=" margin-top:15px; color:#0f3d77;">
                       <div class="btn-group pull-right">
                                        <a href="#" onClick="check_login();" class="btn btn-checkout" id="bagadd">Sign In Now</a>
                                    </div>
                   </div>
                   <div class="clearfix" style="height:5px;"></div>
                   
                </div>  
               
                <div class="col-md-5 pull-right" style="">
                  
                   <div class="pull-left" style=" width:180px; height:130px;  background-image:url(https://www.next.co.uk/secure/account/content/images/structural/ap/page/h2-background.png); background-repeat:100% 100%;">
                   
                   <div style="margin-top:30px; font-family:16px; color:#000; text-align:center;">NEW TO ROLLOUT?</div>
                   <div class="clearfix" style="height:10px;"></div>
                   <div class="col-md-12" align="center">
                   <div class="btn-group" style="">
                                        <a href="#" onClick="reg_show();" class="btn btn-checkout" id="bagadd">Register Now</a>
                                    </div>
                   </div>
                   </div>
                   
                   </div>
                </div>  
                 </div>             
                </form>
                 

  <form role="form" name="reg_form" id="reg_form"  style="display:none;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <div class="row" style=" padding-left:10px; width:86%;  background-image:url(images/h1-background.gif); background-repeat:100% 100%;"><h2 style=" font-size:18px;">REGISTER YOUR DETAILS

		<span style="font-size:14px; padding-left:20px;">All fields marked with a <font color="#FF0000">*</font> are mandatory</span></h2>
  </div>
   <div class="row" style=" padding-left:10px; width:58%;"><h3 style=" background-image:url(https://www.next.co.uk/secure/account/content/images/structural/ap/page/h2-background.png); background-repeat:100% 100%; padding:5px 0px 5px; font-size:16px;">YOUR SECURITY DETAILS</h3>
  </div>
  <fieldset>
  <div class="form-group" style=" margin-bottom:3px;">
      <label for="emailaddress" class="col-md-2">
        Email address<font color="#FF0000">*</font>:
      </label>
      <div class="col-md-10">
      <div class="col-md-6 pull-left ">
        <input type="email" class="form-control" id="remail" name="remail" placeholder="Enter email address">
        </div>
        <p class="help-block">
          Example: yourname@domain.com
        </p>
      </div>
 
 
    </div>
 
    <div class="form-group" style=" margin-bottom:3px;">
      <label for="password" class="col-md-2">
        Password<font color="#FF0000">*</font>:
      </label>
      <div class="col-md-10">
        <div class="col-md-6 pull-left ">
        <input type="password" class="form-control" id="rpassword" name="rpassword" placeholder="Enter Password">
        </div>
        <p class="help-block">
          Min: 6 characters (Alphanumeric only)
        </p>
      </div>
 
 
    </div>
  
    
 </fieldset>
 <div class="row" style=" padding-left:10px; width:58%;"><h3 style=" background-image:url(https://www.next.co.uk/secure/account/content/images/structural/ap/page/h2-background.png); background-repeat:100% 100%; padding:5px 0px 5px; font-size:16px;">YOUR DETAILS</h3>
  </div>
  <fieldset>
    <div class="form-group" style=" margin-bottom:3px;">
      <label for="firstname" class="col-md-2">
        First Name<font color="#FF0000">*</font>:
      </label>
      <div class="col-md-10">
      <div class="col-md-6 pull-left ">
        <input type="text" class="form-control" id="rFirstName" name="rFirstName" placeholder="Enter First Name">
        </div>
      </div>
 
 
    </div>
 
    <div class="form-group" style=" margin-bottom:3px;">
      <label for="lastname" class="col-md-2">
        Last Name<font color="#FF0000">*</font>:
      </label>
      <div class="col-md-10" >
      <div class="col-md-6 pull-left ">
        <input type="text" class="col-md-6 pull-left form-control" id="rLastName" name="rLastName" placeholder="Enter Last Name">
        </div>
      </div>
 
 
    </div>

    <div class="form-group" style=" margin-bottom:3px;">
      <label for="Contact Number" class="col-md-2">
        Contact <font color="#FF0000">*</font>:
      </label>
      <div class="col-md-10">
      <div class="col-md-6 pull-left ">
        <input type="text" class="col-md-6 pull-left form-control" id="rContactNumber" name="rContactNumber" placeholder="Enter Your Contact Number">
        </div>
      </div>
 
 
    </div>
 	
     <div class="form-group" style=" margin-bottom:3px;">
      <label for="Address" class="col-md-2">
        Address:
      </label>
      <div class="col-md-10">
      <div class="col-md-6 pull-left ">
        <input type="text" class="col-md-6 pull-left form-control" name="rAddress" id="rAddress" placeholder="Enter Your Address">
        </div>
      </div>
 
 
    </div>
    
   </fieldset>
 

 
    <div class="row">
      <div class="col-md-2">
      </div>
      <div class="col-md-10">
      <div class="col-md-6 pull-left " align="center">
        <div class="btn-group" style=" padding-top:10px;">
        <input type="hidden" name="regdata" id="regdata" value="0">
                                        <a href="#" onClick="reg_check();" class="btn btn-checkout" id="bagadd">Register Your Details</a>
                                    </div>
        </div>
      </div>
    </div>
  </form>
			</div>
              
			<div class="tab-pane fade <?php if($_SESSION["success_step"]==1){echo " in active";} ?>" id="twitter-tab">
            
  <form role="form" name="shipping_form" id="shipping_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <div class="row" style=" padding-left:10px; width:58%;"><h3 style=" background-image:url(https://www.next.co.uk/secure/account/content/images/structural/ap/page/h2-background.png); background-repeat:100% 100%; padding:5px 0px 5px; font-size:16px;">YOUR BASIC DETAILS</h3>
  </div>
  <fieldset>
  <div class="form-group" style=" margin-bottom:3px;">
      <label for="name" class="col-md-2">
        Name<font color="#FF0000">*</font>:
      </label>
      <div class="col-md-10">
      <div class="col-md-6 pull-left ">
        <input type="text" class="form-control" id="sname" name="sname" placeholder="Enter Your Name">
        </div>
      </div>
     </div>
      
      <div class="form-group" style=" margin-bottom:3px;">
      <label for="Address" class="col-md-2">
        Address<font color="#FF0000">*</font>:
      </label>
      <div class="col-md-10">
      <div class="col-md-6 pull-left ">
        <input type="text" class="form-control" id="saddress" name="saddress" placeholder="Enter Your Shipping Adress">
        </div>
      </div>
      </div>
       <div class="form-group" style=" margin-bottom:3px;">
      <label for="Contact" class="col-md-2">
        Contact<font color="#FF0000">*</font>:
      </label>
      <div class="col-md-10">
      <div class="col-md-6 pull-left ">
        <input type="text" class="form-control" id="scontact" name="scontact" placeholder="Enter Your Contact">
        </div>
      </div>
      </div>
  <div class="form-group" style=" margin-bottom:3px;">
      <label for="emailaddress" class="col-md-2">
        Email <font color="#FF0000">*</font>:
      </label>
      <div class="col-md-10">
      <div class="col-md-6 pull-left ">
        <input type="email" class="form-control" id="semailaddress" name="semailaddress" placeholder="Enter email address">
        </div>
        <p class="help-block">
          Example: yourname@domain.com
        </p>
      </div>
 
 
    </div>
 
      <div class="form-group" style=" margin-bottom:3px;">
      <label for="Division" class="col-md-2">
        Location<font color="#FF0000">*</font>:
      </label>
      <div class="col-md-10">
      <div class="col-md-8 pull-left ">
        <span id="sizespan1" class="size">
            <select id="division" class="form-control" name="division">
            <option value="">Select Location</option>
             <option value="Dhaka City">Dhaka City</option>
             <option value="Narayongonj">Narayongonj</option>
             <option value="Gazipur">Gazipur</option>
             <option value="Chittagong">Chittagong</option>
             <option value="Sylhet">Sylhet</option>
            </select>
		</span>
        </div>
       
      </div>
      
 
 
    </div>

    
 </fieldset>

 
	
    <div class="row">
      <div class="col-md-2">
      </div>
      <div class="col-md-10">
      <div class="col-md-6 pull-left " align="center">
        <div class="btn-group" style=" padding-top:10px;">
        <input type="hidden" name="sval" id="sval" value="0">
                                        <a href="#" onClick="ship_check();" class="btn btn-checkout" id="bagadd">Save Shipment Details</a>
                                    </div>
        </div>
      </div>
    </div>
  </form>
			</div>
			<div class="tab-pane fade <?php if($_SESSION["success_step"]==2){echo " in active";} ?>" id="googleplus-tab">
				      <div class="row" style=" margin-left:10px; width:83%;  background-image:url(images/h1-background.gif); background-repeat:100% 100%;">
     <h2 style=" font-size:18px;">PAYMENT DETAILS INFORMATION

		</h2>
      </div>
        
        <div class="row" >
               
                <div class="col-md-12"> 
                  <div class="col-md-6 pull-left">
                     <div class="col-md-12" style=" padding:10px; margin-top:10px;margin-left:0px; height:20px; padding:2px 0px 2px; font-size:14px; background-color:#CCC; background-image:url(https://www.next.co.uk/secure/account/content/images/structural/ap/page/h2-background.png); background-repeat:100% 100%;">
                   <div class="pull-left" style="margin-left:10px;">PAYMENT METHOD</div>
                   </div>
                         <table cellspacing="0" summary="Payment methods" class="table table-condensed" >
                
                
                            <tbody><tr class="active">
                             <td>
                                <input type="radio" checked="checked" value="20" id="pm20" name="paymentid" onClick="">
                            </td>
                
                    
                             <td class="checkout-payment-name">
                                     <label for="pm20">Online Payment
                                    </label>
                            <div class="checkout-payment-descr">
                        Visa, Master, DBBL
                          
                              </div>
                          </td>
                
                    </tr>
                    <tr id="cod_tr8" class="active">
                        <td>
                            <input type="radio" value="8" id="pm8" name="paymentid">
                        </td>
                
                    
                        <td class="checkout-payment-name">
                                <label for="pm8">Cash on Delivery
                              </label>
                            <div class="checkout-payment-descr">
                        Cash on Delivery
                          
                              </div>
                          </td>
                
                    </tr>
                  <tr class="active">
                    <td>
                      <input type="radio" value="2" id="pm2" name="paymentid">
                    </td>
                
                    
                      <td class="checkout-payment-name">
                      <label for="pm2">Bkash
                              </label>
                            <div class="checkout-payment-descr">
                        Please Pay to 0179-6389326
                          
                              </div>
                          </td>
                
                    </tr>
                
                
                  
                
                
                 
                </tbody></table>
                   
                </div>  
               
                <div class="col-md-6 pull-left" style="">
                  <div class="col-md-10" style=" padding:10px; width:69%; margin-top:10px;margin-left:0px; height:20px; padding:2px 0px 2px; font-size:14px; background-color:#CCC; background-image:url(https://www.next.co.uk/secure/account/content/images/structural/ap/page/h2-background.png); background-repeat:100% 100%;">
                   <div class="pull-left " style="margin-left:10px; ">ORDER SUMMERY</div>
                   </div>
                   <?php 
				   		
			 $sql = "SELECT
			sum(((sales_details_info.ProductPrice*sales_details_info.ProductDiscount*sales_details_info.ProductQuantity)/100)) as 'Discount',
			
			MAX(product_info.ShippingCost) as 'Cost',
			
			 sum(sales_details_info.ProductPrice*sales_details_info.ProductQuantity) as 'price' 
			
			 ,sales_info.InvoiceID
			 ,MAX(product_info.ShippingCostOutSide) as 'CostOutSide'
			 ,shiftment_address.Division as 'Location'
			FROM
			sales_info
			INNER JOIN sales_details_info 
				ON (sales_info.InvoiceID = sales_details_info.InvoiceID)
			INNER JOIN product_info 
				ON (sales_details_info.SerialNo = product_info.SerialNo)
			INNER JOIN shiftment_address
			   ON(sales_info.ShiftID=shiftment_address.ShiftID)
			WHERE  sales_info.SessionID='".$_SESSION["id"]."' ";
						$OrderSummery=mysqli_query($con,  "$sql");
						$OrderSummeryTotal=mysqli_fetch_row($OrderSummery);
			$shippingOriginalCost = $OrderSummeryTotal[1];	
				if($OrderSummeryTotal[5]!="Dhaka City")	
				{
					$shippingOriginalCost = $OrderSummeryTotal[4];
				}
						$promocheck = mysqli_fetch_row(mysqli_query($con, "SELECT promotional_code.Discount FROM
                                                                     promotional_temporary
                                                                   INNER JOIN promotional_code 
                                                                ON (promotional_temporary.PromotionalID = promotional_code.PromotionalID)
                                                                 WHERE promotional_temporary.SessionID='".$_SESSION["id"]."'"));
						
				   	  
					   if($promocheck[0]!="")
					   {
						  $promocheck[0] = ($promocheck[0]/100*$OrderSummeryTotal[2]);   
					   }
				   ?>
                         <div class="col-md-12 ">
                    
                   <div class="col-md-6" style=" margin-top:20px; color:#0f3d77; font-size:14px; font-weight:bold;">
                   <b>Sub Total:  </b><a href="#" onClick="" class="" id="bagadd">
				   <?php print number_format($OrderSummeryTotal[2],2,'.',','); ?> (BDT)  </a>
                   </div>
                   
                   
                  <div class="col-md-6" style=" margin-top:20px; color:#0f3d77; font-size:18px; font-weight:bold;"><b> </b></div>
                   
                  
                   
                   
                </div>  
                <?php
                  if($OrderSummeryTotal[0]!=0)
				  {
				?>
                <div class="col-md-12 ">
                    
                   <div class="col-md-6" style=" margin-top:20px; color:#0f3d77; font-size:14px; font-weight:bold;">
                   <b>Discount: </b>
                   <a href="#" onClick="" class="" id="bagadd">
                   <?php echo $OrderSummeryTotal[0]!= 0 ? $OrderSummeryTotal[0]: "N/A"?> (BDT)
                   </a>
                   </div>
               </div>
                <?php } ?>  
                <?php
                  if($promocheck[0]!=0)
				  {
				?>
                <div class="col-md-12 ">
                    
                   <div class="col-md-6" style=" margin-top:20px; color:#0f3d77; font-size:14px; font-weight:bold;">
                   <b>Promotional Discount: </b>
                   <a href="#" onClick="" class="" id="bagadd">
                   <?php echo $promocheck[0]; ?> (BDT)
                   </a>
                   </div>
               </div>
                <?php } ?> 
                <div class="col-md-12 ">
                    
                   <div class="col-md-6" style=" margin-top:20px; color:#0f3d77; font-size:14px; font-weight:bold;"><b>Shipping Cost: </b>
                   <?php echo $shippingOriginalCost!= "" ? $shippingOriginalCost: "N/A"?>  
                   </div>
                   
                   
                 <div class="col-md-12 ">
                    
                   <div class="col-md-8" style=" margin-top:20px; color:#0f3d77; font-size:16px; font-weight:bold;">
                   <b>Total Amount: </b>
                   <?php echo $total_amount = number_format($shippingOriginalCost+$OrderSummeryTotal[2]-($promocheck[0]+$OrderSummeryTotal[0]),'2','.',','); ?> (BDT)
                   </div>
               
                </div>  
                               
                </div>
           </div>
           </div>
           </div>




   


  
  <form role="form" name="reg_form2" id="reg_form2" method="post" action="complete.php">
	<div class="row">
		<div class="col-md-2"> </div>
			<div class="col-md-10">
				<div class="col-md-10 pull-left " align="center">
					<input id="tran_id" type="hidden" value="<?php echo $OrderSummeryTotal[3]; ?>" name="tran_id">
					<input id="store_id" type="hidden" value="rolloutlive001" name="store_id">
                    <input id="payment_type" type="hidden" value="" name="payment_type">
					<input id="total_amount" type="hidden" value="<?php echo $total_amount; ?>" name="total_amount">
					<input id="success_url" type="hidden" value="http://rollout.com.bd/notify.php?itemid=<?php echo $OrderSummeryTotal[3]; ?>" name="success_url">
					<input id="fail_url" type="hidden" value="http://rollout.com.bd/fail.php?itemid=<?php echo $OrderSummeryTotal[3]; ?>" name="fail_url">
					<input id="cancel_url" type="hidden" value="http://rollout.com.bd/cancel.php?itemid=<?php echo $OrderSummeryTotal[3]; ?>" name="cancel_url">
                 <div class="btn-group" style=" padding:5px;">
                  
                <button class="btn  btn-success continue_to_checkout" onClick="unselect_hidden_payment_method();" type="button" value="Checkout" name="cont_to_checkout1">
                                        Continue To Payment
                                        <i class="icon-hand-right icon-white"></i>
                                    </button>
                          
					<!--/*<input id="pay" type="submit" value="Pay with SSLCOMMERZ" name="pay">*/-->
                </div>
</div>
</div>
</div>
</form>

			</div>
			<div class="tab-pane fade <?php if($_SESSION["success_step"]==3){echo " in active";} ?>" id="pinterest-tab">
				
				<div class="row" >
                  <div class="col-md-10" style="  padding:5px 0px 5px; font-size:14px; background-image:url(images/h1-background.gif); background-repeat:100% 100%;">
                   <span style="margin-left:20px; "> Complete Your Order</span>
                </div>                
                </div>
                <div class="clearfix" style="height:5px;"></div>
                
                <div class="row" >
                
                <div class="col-md-12"> 
                  <div class="col-md-5 pull-left">
                   
                   <div class="col-md-12 pull-left" style=" margin-top:15px; color:#0f3d77;">
                       <p>Your all process completed successfully. </br>
                       Your order no: <?php
                       $last_ord_no = mysqli_fetch_row(mysqli_query($con, "SELECT  InvoiceID FROM sales_info WHERE SessionID='".$_SESSION["id"]."'"));
					   echo $last_ord_no[0];
					   ?></br>
                       In order to complete your order and to contact with you 
                       </br><b>click complete order</b> </p>
                   </div>
                    
                   <div class="clearfix" style="height:10px;"></div>
                   <div class="col-md-12 pull-right" style=" margin-top:15px; color:#0f3d77;">
                       <div class="btn-group pull-right">
                                        <a href="complete.php?success=ok" class="btn btn-checkout" id="bagadd">Complete Order</a>
                                    </div>
                   </div>
                   <div class="clearfix" style="height:5px;"></div>
                   
                </div>  
               
             
                </div>  
                 </div>             
                
			</div>
	</div></div>
</div><!-- Product info -->
                </div>
        <!-- wrapper end -->  
        
        <!--Footer -->
              <?php include("footer.php"); ?>
        <!--Footer  -->
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo $url_cod; ?>https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo $url_cod; ?>js/bootstrap.min.js"></script>
        
        <!-- Flex Slider Scripts -->
        <script type='text/javascript' src='js/jquery.custom.min.js'></script>
        <script type='text/javascript' src='js/tm_jquery.flexslider.js'></script>
        
        <!-- Megamenu Scripts -->
        <script type="text/javascript" src="<?php echo $url_cod; ?>js/jquery.js"></script>
        <script>
            $('a.btn').tooltip({
                "placement" : "top"
            });
        
            /* === SHOW MESSAGES === */
            $('.cart-message, .wish-message').css('display','none');
            function showMessage(value) {
                $.gritter.add({
                    title: ' Information',				            // (string | mandatory) the heading of the notification
                    text: $('.' + value + '-message p').text(),	    // (string | mandatory) the text inside the notification
                    time: 5000							            // (int | optional) the time you want it to be alive for before fading out (milliseconds)
                });
            }
            /* === END SHOW MESSAGES === */
        </script>
        
        <!-- Owl carousel JavaScript -->
        <script src="<?php echo $url_cod; ?>owl-carousel/owl.carousel.js"></script>
        <script>
        $(document).ready(function() {
        
          $("#owl-demo").owlCarousel({
            items : 4,
            lazyLoad : true,
            navigation : true
          });
        
        });
        </script>
        
        <script src="<?php echo $url_cod; ?>js/bootstrap-hover-dropdown.js"></script>
        <script src="<?php echo $url_cod; ?>js/fitdivs.js"></script>
        <script>
            $(document).ready(function(){
            // Target your .container, .wrapper, .post, etc.
                $(".fhmm").fitVids();
            });
        </script>
        <script>
            // Menu drop down effect
            $('.dropdown-toggle').dropdownHover().dropdown();
            $(document).on('click', '.fhmm .dropdown-menu', function(e) {
              e.stopPropagation()
            })
        </script>
          <script>
		    var dropcount = 0; 
           $('.navbar .dropdown').hover(function() 
			     {
				  
					$(".dropdown-menu", this).slideUp().slideDown();
				   
				 }
				
				);
        </script>
        <script>

            $('.navbar .dropdown').hover(function() {
                $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
            }, function() {
                $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
            });
        </script>
        
        <!-- GlassCase Product Viewer Scripts -->
        <script src="<?php echo $url_cod; ?>js/jquery.glasscase.min.js" type="text/javascript"></script>
		<script type="text/javascript">
            $(function () {
                //Demo 1
                $("#girlstop").glassCase({ 'thumbsPosition': 'top', 'widthDisplay': '341', 'heightDisplay': '511' });            
            });
        </script> 
    
    </body>
</html>