<?php
require_once("connection.php");
$action=$_POST["func"];
	$srcText=$_POST["src"];
 
 switch($action)
 {
case "CONTACT":
				$MemberData=mysqli_query($con, "SELECT MemberContact FROM member_info WHERE MemberContact='".$srcText."'");
				$memberRow=mysqli_fetch_row($MemberData);
				if($memberRow[0]!="")
				{
				 $memberRow[0]="Already Exists This Contact Number! Try Another..";
				 $memberRow[1]="";
				}
				else if($memberRow[0]=="" && $srcText!="")
				{
				$memberRow[0]="You Can Continue With This Contact No.";
				$memberRow[1]=$srcText;
				}
				else if($memberRow[0]=="" && $srcText=="")
				{
				$memberRow[0]="Please Fillup The Contact No.";
				$memberRow[1]=$srcText;
				}
				$json='
				{
					"MEMCONTACT":"'.$memberRow[0].'",	
					"MEMCONTACTPARAM":"'.$memberRow[1].'"	
				}
				';
			print $json;
			   
			break;
			
case "DISTRICT":
				
			//$MemberData=mysqli_query($con, "SELECT MemberContact FROM member_info WHERE MemberContact='".$srcText."'");
			//$memberRow=mysqli_fetch_row($MemberData);
			 //$qrs=mysqli_query($con, "SELECT AreaID,AreaName FROM area_info WHERE DistrictID='".$srcText."' AND ActiveStatus='Active' ORDER BY AreaName");
			 $qrs=mysqli_query($con, "SELECT DistrictID,DistrictName FROM district_info WHERE DivisionID='".$srcText."' AND ActiveStatus='Active'");
			if($qrs)
			{
			$combo="<select name='billingDistrict' id='billingDistrict' onchange='billingselectarea(this.value)' >";
			$combo.="<option value=''>Select District Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			}
			else
			{$combo="aaaaaaaaaaaaaaaaaaaaaaaa";}
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;

case "DISTRICTEX":
				
			//$MemberData=mysqli_query($con, "SELECT MemberContact FROM member_info WHERE MemberContact='".$srcText."'");
			//$memberRow=mysqli_fetch_row($MemberData);
			 //$qrs=mysqli_query($con, "SELECT AreaID,AreaName FROM area_info WHERE DistrictID='".$srcText."' AND ActiveStatus='Active' ORDER BY AreaName");
			 $qrs=mysqli_query($con, "SELECT DistrictID,DistrictName FROM district_info WHERE DivisionID='".$srcText."' AND ActiveStatus='Active'");
			if($qrs)
			{
			$combo="<select name='GoTop' id='GoTop' onchange='document.customer.submit();' >";
			$combo.="<option value=''>Select District Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			}
			else
			{$combo="aaaaaaaaaaaaaaaaaaaaaaaa";}
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;

			
case "AREAFIND":
			 $qrs=mysqli_query($con, "SELECT ThanaID,ThanaName FROM thana_info WHERE DistrictID='".$srcText."' ORDER BY ThanaName");
			if($qrs)
			{
			$combo="<select name='billingAreaName' id='billingAreaName' onchange='billingselectunion(this.value)'>";
			$combo.="<option value=''>Select Upazila/PS Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";			
				}
			$combo.="</select>";
			}
			else
			{$combo="aaaaaaaaaaaaaaaaaaaaaaaa";}
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;


case "AREAFINDEX":
			 $qrs=mysqli_query($con, "SELECT ThanaID,ThanaName FROM thana_info WHERE DistrictID='".$srcText."'");
			if($qrs)
			{
			$combo="<select name='GoTop' id='GoTop' onchange='document.customer.submit();'>";
			$combo.="<option value=''>Select Upazila/PS Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";			
				}
			$combo.="</select>";
			}
			else
			{$combo="aaaaaaaaaaaaaaaaaaaaaaaa";}
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;

case "UNION":
			 $qrs=mysqli_query($con, "SELECT UnionID,Name FROM union_info WHERE ThanaID='".$srcText."' ORDER BY Name");
			if($qrs)
			{
			$combo="<select name='billingUnionName' id='billingUnionName' onchange='billingselectvillage(this.value)'>";
			$combo.="<option value=''>Select Union/Sector Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			}
			else
			{$combo="aaaaaaaaaaaaaaaaaaaaaaaa";}
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;
 
 case "UNIONEX":
			 $qrs=mysqli_query($con, "SELECT UnionID,Name FROM union_info WHERE ThanaID='".$srcText."' ORDER BY Name");
			if($qrs)
			{
			$combo="<select name='GoTop' id='GoTop' onchange='document.customer.submit();'>";
			$combo.="<option value=''>Select Union/Sector Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			}
			else
			{$combo="aaaaaaaaaaaaaaaaaaaaaaaa";}
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;
 
 case "VILLAGE":

			 $qrs=mysqli_query($con, "SELECT VillageID,Name FROM village_info WHERE UnionID='".$srcText."' ORDER BY Name");
			if($qrs)
			{
			$combo="<select name='billingVillageName' id='billingVillageName'>";
			$combo.="<option value=''>Select Village/Area Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			}
			else
			{$combo="aaaaaaaaaaaaaaaaaaaaaaaa";}
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;
 
  case "VILLAGEEX":

			 $qrs=mysqli_query($con, "SELECT VillageID,Name FROM village_info WHERE VillageID='".$srcText."' ORDER BY Name");
			if($qrs)
			{
			$combo="<select name='billingVillageName' id='billingVillageName'>";
			
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			}
			else
			{$combo="aaaaaaaaaaaaaaaaaaaaaaaa";}
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;
			
    case "MIDDLEARTICLE":

			 $qrs=mysqli_query($con, "SELECT VillageID,Name FROM village_info WHERE VillageID='".$srcText."' ORDER BY Name");
			                     $combo="<select name='MenuName' id='MenuName' onchange='document.customer.submit();'>";
									$combo.="<option value=''>Select Menu</option>";
									
									  $menu_rs=mysqli_query($con, "SELECT mid,title FROM mainmenu WHERE menutype='Middle'  ORDER BY orderid ");
									  while($menu_rs_row=mysqli_fetch_row($menu_rs))
									  {
									   
									
									$combo.="<option value='$menu_rs_row[0]'>$menu_rs_row[1]</option>";
									
									   
									        $smenu_rs=mysqli_query($con, "SELECT sid,title FROM submenu WHERE mid='".$menu_rs_row[0]."'");
									          while($smenu_rs_row=mysqli_fetch_row($smenu_rs))
											  {
											   
							$combo.="<option value='$smenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;$smenu_rs_row[1]</option>";
											
											     $ssmenu_rs=mysqli_query($con, "SELECT ssid,title FROM subsubmenu WHERE sid='".$smenu_rs_row[0]."'");
									          while($ssmenu_rs_row=mysqli_fetch_row($ssmenu_rs))
											  {
											   
											  $combo.="<option value='$ssmenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ssmenu_rs_row[1]</option>";
											
									         }
										    } 
											}
									$combo.="</select>";
			
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;		
  case "MARTICLE":

			 $qrs=mysqli_query($con, "SELECT VillageID,Name FROM village_info WHERE VillageID='".$srcText."' ORDER BY Name");
			                     $combo="<select name='MenuName' id='MenuName' onchange='document.customer.submit();'>";
									$combo.="<option value=''>Select Menu</option>";
									
									  $menu_rs=mysqli_query($con, "SELECT mid,title FROM mainmenu WHERE menutype='Main' 
									  AND mid NOT IN('MN-0001','MN-0002') ORDER BY orderid ");
									  while($menu_rs_row=mysqli_fetch_row($menu_rs))
									  {
									   
									
									$combo.="<option value='$menu_rs_row[0]'>$menu_rs_row[1]</option>";
									
									   
									        $smenu_rs=mysqli_query($con, "SELECT sid,title FROM submenu WHERE mid='".$menu_rs_row[0]."'");
									          while($smenu_rs_row=mysqli_fetch_row($smenu_rs))
											  {
											   
							$combo.="<option value='$smenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;$smenu_rs_row[1]</option>";
											
											     $ssmenu_rs=mysqli_query($con, "SELECT ssid,title FROM subsubmenu WHERE sid='".$smenu_rs_row[0]."'");
									          while($ssmenu_rs_row=mysqli_fetch_row($ssmenu_rs))
											  {
											   
											  $combo.="<option value='$ssmenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ssmenu_rs_row[1]</option>";
											
									         }
										    } 
											}
									$combo.="</select>";
			
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;
  case "TARTICLE":

	
			                     $combo="<select name='MenuName' id='MenuName' onchange='document.customer.submit();'>";
									$combo.="<option value=''>Select Menu</option>";
									
									  $menu_rs=mysqli_query($con, "SELECT mid,title FROM mainmenu WHERE menutype LIKE 'Top%' 
									  AND mid NOT IN('MN-0008') ORDER BY orderid");
									  while($menu_rs_row=mysqli_fetch_row($menu_rs))
									  {
									   
									
									$combo.="<option value='$menu_rs_row[0]'>$menu_rs_row[1]</option>";
									
									   
									        $smenu_rs=mysqli_query($con, "SELECT sid,title FROM submenu WHERE mid='".$menu_rs_row[0]."'");
									          while($smenu_rs_row=mysqli_fetch_row($smenu_rs))
											  {
											   
							$combo.="<option value='$smenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;$smenu_rs_row[1]</option>";
											
											     $ssmenu_rs=mysqli_query($con, "SELECT ssid,title FROM subsubmenu WHERE sid='".$smenu_rs_row[0]."'");
									          while($ssmenu_rs_row=mysqli_fetch_row($ssmenu_rs))
											  {
											   
											  $combo.="<option value='$ssmenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ssmenu_rs_row[1]</option>";
											
									         }
										    } 
											}
									$combo.="</select>";
			
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;
  case "BARTICLE":

	
			                     $combo="<select name='MenuName' id='MenuName' onchange='document.customer.submit();'>";
									$combo.="<option value=''>Select Menu</option>";
									
									  $menu_rs=mysqli_query($con, "SELECT mid,title FROM mainmenu WHERE menutype='".$srcText."' 
									   AND mid NOT IN('MN-0015','MN-0029','MN-0030','MN-0032','MN-0033','MN-0034') ORDER BY orderid");
									  while($menu_rs_row=mysqli_fetch_row($menu_rs))
									  {
									   
									     
									$combo.="<option value='$menu_rs_row[0]'>$menu_rs_row[1]</option>";
									       
									   
									       if($menu_rs_row[0]=="MN-0018")
									       {
									        $smenu_rs=mysqli_query($con, "SELECT CategoryID,Title FROM faq_term_pns_cat 
											WHERE type='Franchaise and Affiliation'");
									          while($smenu_rs_row=mysqli_fetch_row($smenu_rs))
											  {
											   
							$combo.="<option value='one$smenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;$smenu_rs_row[1]</option>";
											
											     $ssmenu_rs=mysqli_query($con, "SELECT SubCategoryID,Title FROM faq_term_pns_scat 
												 WHERE CategoryID='".$smenu_rs_row[0]."'");
									          while($ssmenu_rs_row=mysqli_fetch_row($ssmenu_rs))
											  {
											   
											  $combo.="<option value='two$ssmenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ssmenu_rs_row[1]</option>";
											         $sssmenu_rs=mysqli_query($con, "SELECT SSubCategoryID,Title FROM faq_term_pns_sscat 
												 WHERE SubCategoryID='".$ssmenu_rs_row[0]."'");
									            while($sssmenu_rs_row=mysqli_fetch_row($sssmenu_rs))
											    {
											   
											  $combo.="<option value='thr$sssmenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sssmenu_rs_row[1]</option>";
											
									            }
									         }
										     } 
											}
										else if($menu_rs_row[0]=="MN-0019")
									       {
									        $smenu_rs=mysqli_query($con, "SELECT CategoryID,Title FROM faq_term_pns_cat 
											WHERE type='Advertise With Us'");
									          while($smenu_rs_row=mysqli_fetch_row($smenu_rs))
											  {
											   
							$combo.="<option value='one$smenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;$smenu_rs_row[1]</option>";
											
											     $ssmenu_rs=mysqli_query($con, "SELECT SubCategoryID,Title FROM faq_term_pns_scat 
												 WHERE CategoryID='".$smenu_rs_row[0]."'");
									          while($ssmenu_rs_row=mysqli_fetch_row($ssmenu_rs))
											  {
											   
											  $combo.="<option value='two$ssmenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ssmenu_rs_row[1]</option>";
											         $sssmenu_rs=mysqli_query($con, "SELECT SSubCategoryID,Title FROM faq_term_pns_sscat 
												 WHERE SubCategoryID='".$ssmenu_rs_row[0]."'");
									            while($sssmenu_rs_row=mysqli_fetch_row($sssmenu_rs))
											    {
											   
											  $combo.="<option value='thr$sssmenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sssmenu_rs_row[1]</option>";
											
									            }
									         }
										     } 
											}
										else if($menu_rs_row[0]=="MN-0020")
									       {
									        $smenu_rs=mysqli_query($con, "SELECT CategoryID,Title FROM faq_term_pns_cat 
											WHERE type='Payment and Shipping'");
									          while($smenu_rs_row=mysqli_fetch_row($smenu_rs))
											  {
											   
							$combo.="<option value='one$smenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;$smenu_rs_row[1]</option>";
											
											     $ssmenu_rs=mysqli_query($con, "SELECT SubCategoryID,Title FROM faq_term_pns_scat 
												 WHERE CategoryID='".$smenu_rs_row[0]."'");
									          while($ssmenu_rs_row=mysqli_fetch_row($ssmenu_rs))
											  {
											   
											  $combo.="<option value='two$ssmenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ssmenu_rs_row[1]</option>";
											         $sssmenu_rs=mysqli_query($con, "SELECT SSubCategoryID,Title FROM faq_term_pns_sscat 
												 WHERE SubCategoryID='".$ssmenu_rs_row[0]."'");
									            while($sssmenu_rs_row=mysqli_fetch_row($sssmenu_rs))
											    {
											   
											  $combo.="<option value='thr$sssmenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sssmenu_rs_row[1]</option>";
											
									            }
									         }
										     } 
											}
											}
									$combo.="</select>";
			
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;
			
  case "FARTICLE":

	
			                     $combo="<select name='MenuName' id='MenuName' onchange='document.customer.submit();'>";
									$combo.="<option value=''>Select Menu</option>";
									
									  $menu_rs=mysqli_query($con, "SELECT mid,title FROM mainmenu WHERE menutype='".$srcText."' 
									   AND mid IN('MN-0022','MN-0023') ORDER BY orderid");
									  while($menu_rs_row=mysqli_fetch_row($menu_rs))
									  {
									   
									
									$combo.="<option value='$menu_rs_row[0]'>$menu_rs_row[1]</option>";
									     if($menu_rs_row[0]=="MN-0022")
									       {
									        $smenu_rs=mysqli_query($con, "SELECT CategoryID,Title FROM faq_term_pns_cat WHERE type='FAQ'");
									          while($smenu_rs_row=mysqli_fetch_row($smenu_rs))
											  {
											   
							$combo.="<option value='one$smenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;$smenu_rs_row[1]</option>";
											
											    $ssmenu_rs=mysqli_query($con, "SELECT SubCategoryID,Title FROM faq_term_pns_scat 
												 WHERE CategoryID='".$smenu_rs_row[0]."'");
									          while($ssmenu_rs_row=mysqli_fetch_row($ssmenu_rs))
											  {
											   
											  $combo.="<option value='two$ssmenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ssmenu_rs_row[1]</option>";
											        $sssmenu_rs=mysqli_query($con, "SELECT SSubCategoryID,Title FROM faq_term_pns_sscat 
												 WHERE SubCategoryID='".$ssmenu_rs_row[0]."'");
									            while($sssmenu_rs_row=mysqli_fetch_row($sssmenu_rs))
											    {
											   
											  $combo.="<option value='thr$sssmenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sssmenu_rs_row[1]</option>";
											
									            }
									         }
										     } 
											}
										  else if($menu_rs_row[0]=="MN-0023")
									       {
									        $smenu_rs=mysqli_query($con, "SELECT CategoryID,Title FROM faq_term_pns_cat WHERE type='Terms of Use'");
									          while($smenu_rs_row=mysqli_fetch_row($smenu_rs))
											  {
											   
							$combo.="<option value='one$smenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;$smenu_rs_row[1]</option>";
											
											     $ssmenu_rs=mysqli_query($con, "SELECT SubCategoryID,Title FROM faq_term_pns_scat 
												 WHERE CategoryID='".$smenu_rs_row[0]."'");
									          while($ssmenu_rs_row=mysqli_fetch_row($ssmenu_rs))
											  {
											   
											  $combo.="<option value='two$ssmenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ssmenu_rs_row[1]</option>";
											         $sssmenu_rs=mysqli_query($con, "SELECT SSubCategoryID,Title FROM faq_term_pns_sscat 
												 WHERE SubCategoryID='".$ssmenu_rs_row[0]."'");
									            while($sssmenu_rs_row=mysqli_fetch_row($sssmenu_rs))
											    {
											   
											  $combo.="<option value='thr$sssmenu_rs_row[0]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sssmenu_rs_row[1]</option>";
											
									            }
									         }
										     } 
											}
										}
									$combo.="</select>";
			
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;
 }

?>