<?php
 session_start();
require_once("connection.php");
$action=$_POST["func"];
	$srcText=$_POST["src"];
	//$user=$_POST["user"];
 
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
			$combo="<select name='District' id='District' onchange='selectarea(this.value)' >";
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
				
			//$MemberData=mysqli_query($con, "SELECT MemberContact FROM member_info WHERE MemberContact='".$srcText."'");
			//$memberRow=mysqli_fetch_row($MemberData);
			 $qrs=mysqli_query($con, "SELECT AreaID,AreaName FROM area_info WHERE DistrictID='".$srcText."' AND ActiveStatus='Active' ORDER BY AreaName");
			if($qrs)
			{
			$combo="<select name='AreaName' id='AreaName'>";
			$combo.="<option value=''>Select Area Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			}
			
		  $qrs=mysqli_query($con, "SELECT ThanaID,ThanaName FROM thana_info WHERE DistrictID='".$srcText."' AND ActiveStatus='Active' ORDER BY ThanaName");
			if($qrs)
			{
			$combo2="<select name='ThanaName' id='ThanaName'>";
			$combo2.="<option value=''>Select Thana Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo2.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo2.="</select>";
			}
			//else
//			{$combo="aaaaaaaaaaaaaaaaaaaaaaaa";}
			$json='
				{
					"SSSSS":"'.$combo.'",	
					"THANA":"'.$combo2.'"	
						
				}
				';
			print $json; 
			   
			break;
	case "THANA":
				
			$tha=mysqli_query($con, "SELECT PS,District,Division,AreaName FROM agent_info WHERE AgentID='".$srcText."'");
			$thaRow=mysqli_fetch_row($tha);
			
		  $qrs=mysqli_query($con, "SELECT ThanaID,ThanaName FROM thana_info WHERE  ActiveStatus='Active' ORDER BY ThanaName");
			if($qrs)
			{
			$combo="<select name='ThanaName' id='ThanaName'>";
			$combo.="<option value=''>Select Thana Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
				 if($thaRow[0]==$qrow[0])
				 {	
				$combo.="<option value='$qrow[0]' selected='selected'>$qrow[1]</option>";	
				 }
				 else
				 {
				 $combo.="<option value='$qrow[0]'>$qrow[1]</option>";
				 }
						
				}
			$combo.="</select>";
			}
			
			
			  $qrs=mysqli_query($con, "SELECT DistrictID,DistrictName FROM district_info WHERE ActiveStatus='Active' ORDER BY DistrictName");
			if($qrs)
			{
			
			$combo2="<select name='District' id='District' onchange='selectarea(this.value)' >";
			$combo2.="<option value=''>Select District Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				 if($thaRow[1]==$qrow[0])
				 {	
				$combo2.="<option value='$qrow[0]' selected='selected'>$qrow[1]</option>";	
				 }
				 else
				 {
				 $combo2.="<option value='$qrow[0]'>$qrow[1]</option>";
				 }
						
				}
			$combo2.="</select>";
			}
			
			
				  $qrs=mysqli_query($con, "SELECT DivisionID,DivisionName FROM division_info WHERE ActiveStatus='Active' ORDER BY DivisionName");
			if($qrs)
			{
			
			$combo3="<select name='Division' id='Division' onChange='selectdistrict(this.value)' >";
			$combo3.="<option value=''>Select Division Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				 if($thaRow[2]==$qrow[0])
				 {	
				$combo3.="<option value='$qrow[0]' selected='selected'>$qrow[1]</option>";	
				 }
				 else
				 {
				 $combo3.="<option value='$qrow[0]'>$qrow[1]</option>";
				 }
						
				}
			$combo3.="</select>";
			}
			
		 $qrs=mysqli_query($con, "SELECT AreaID,AreaName FROM area_info WHERE ActiveStatus='Active' ORDER BY AreaName");
			if($qrs)
			{
			$combo4="<select name='AreaName' id='AreaName'>";
			$combo4.="<option value=''>Select Area Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				 if($thaRow[3]==$qrow[0])
				 {	
				$combo4.="<option value='$qrow[0]' selected='selected'>$qrow[1]</option>";	
				 }
				 else
				 {
				 $combo4.="<option value='$qrow[0]'>$qrow[1]</option>";
				 }
						
				}
			$combo4.="</select>";
			}


			$json='
				{
					"THA":"'.$combo.'",	
					"DIS":"'.$combo2.'",
					"DIV":"'.$combo3.'",
					"AREA":"'.$combo4.'"		
				}
				';
			print $json; 
			   
			break;

 
 
 case "MCAT":
				
			$plancat=mysqli_query($con, "SELECT CategoryID,PlanID FROM member_plan_and_category WHERE MemberID='".$srcText."' AND ActiveStatus='Active'");
			$plancatRow=mysqli_fetch_row($plancat);
			
		  $qrs=mysqli_query($con, "SELECT CategoryID,CategoryName FROM member_category WHERE ActiveStatus='Active' ORDER BY CategoryName");
			if($qrs)
			{
			$combo="<select name='Category' id='Category' onchange='planmember(this.value)'>";
			$combo.="<option value=''>Select Category</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
				 if($plancatRow[0]==$qrow[0])
				 {	
				$combo.="<option value='$qrow[0]' selected='selected'>$qrow[1]</option>";	
				 }
				 else
				 {
				 $combo.="<option value='$qrow[0]'>$qrow[1]</option>";
				 }
						
				}
			$combo.="</select>";
			}
			
			
		$qrs=mysqli_query($con, "SELECT PlanID,PlanTitle FROM member_category_plan WHERE CategoryID='".$plancatRow[0]."' AND ActiveStatus='Active' ORDER BY PlanTitle");
			if($qrs)
			{
			
			$combo2="<select name='Plan' id='Plan' >";
			$combo2.="<option value=''>Select Plan</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				 if($plancatRow[1]==$qrow[0])
				 {	
				$combo2.="<option value='$qrow[0]' selected='selected'>$qrow[1]</option>";	
				 }
				 else
				 {
				 $combo2.="<option value='$qrow[0]'>$qrow[1]</option>";
				 }
						
				}
			$combo2.="</select>";
              }

			$json='
				{
					"CAT":"'.$combo.'",	
					"PLAN":"'.$combo2.'"		
				}
				';
			print $json; 
			   
			break;
			
 case "MPLAN":
			
		$qrs=mysqli_query($con, "SELECT PlanID,PlanTitle FROM member_category_plan WHERE CategoryID='".$srcText."' AND ActiveStatus='Active' ORDER BY PlanTitle");
			if($qrs)
			{
			
			$combo2="<select name='Plan' id='Plan' >";
			$combo2.="<option value=''>Select Plan</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				 if($plancatRow[1]==$qrow[0])
				 {	
				$combo2.="<option value='$qrow[0]' selected='selected'>$qrow[1]</option>";	
				 }
				 else
				 {
				 $combo2.="<option value='$qrow[0]'>$qrow[1]</option>";
				 }
						
				}
			$combo2.="</select>";
              }

			$json='
				{
					"PLAN":"'.$combo2.'"		
				}
				';
			print $json; 
			   
			break;
			
			
case "SUBMENU":
				
			
			 $qrs=mysqli_query($con, "SELECT sid,title FROM submenu WHERE mid='".$srcText."' ORDER BY orderid");
			$combo="<select name='ParentSubMenu' id='ParentSubMenu' onchange='subsubmenu(this.value)' >";
			$combo.="<option value=''>Select Parent Sub Menu</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;
			
case "PSUBCAT":
				
			
			 $qrs=mysqli_query($con, "SELECT SubCategoryID,SubCategoryName FROM product_sub_category 
								WHERE CategoryID='".$srcText."' AND ActiveStatus='Active' ORDER BY SubCategoryID");
			$combo="<select name='ProductSubCategoryID' id='ProductSubCategoryID'  >";
			$combo.="<option value=''>Select Product Sub Category</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;
			
case "SSUBCAT":
				
			
			 $qrs=mysqli_query($con, "SELECT SubCategoryID,SubCategoryName FROM service_sub_category 
								WHERE CategoryID='".$srcText."' AND ActiveStatus='Active' ORDER BY SubCategoryID
								");
			$combo="<select name='ProductSubCategoryID' id='ProductSubCategoryID'  >";
			$combo.="<option value=''>Select Service Sub Category</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;
			

  case "PARENTMENU":
				
			 $qrs=mysqli_query($con, "SELECT mid,title FROM mainmenu WHERE menutype='".$srcText."' AND ActiveStatus='Active'");
			$combo="<select name='ParentMenu' id='ParentMenu' onchange='submenu(this.value);' >";
			$combo.="<option value=''>Select Parent Menu</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			   
			break;

  case "PDTCAT":
				
			 $qrs=mysqli_query($con, "SELECT SubCategoryID,SubCategoryName FROM product_sub_category 
			 WHERE CategoryID='".$srcText."' AND ActiveStatus='Active' ORDER BY orderid");
			$combo="<select name='ProductSubCategoryID' id='ProductSubCategoryID' onchange='subsubCategory(this.value);'  >";
			$combo.="<option value=''>Select Product Sub Category</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			/*
			$qrs2=mysqli_query($con, "SELECT
					product_sub_unit.SubUnitID
					, product_sub_unit.SubUnitName
				FROM
					product_cat_size 
					INNER JOIN product_sub_unit 
						ON (product_cat_size.SubUnitID = product_sub_unit.SubUnitID)
				WHERE product_cat_size.CatID='".$srcText."' AND product_sub_unit.ActiveStatus='Active'
				ORDER BY product_sub_unit.SubUnitName");
			$combo2="<select name='ProductSize' id='ProductSize'  >";
			$combo2.="<option value=''>Select Product Size</option>";
			while($qrow2=mysqli_fetch_row($qrs2))
				{
					
				$combo2.="<option value='$qrow2[0]'>$qrow2[1]</option>";	
						
				}
			$combo2.="</select>";

			$combo3="<select name='ProductSubSubCategoryID' id='ProductSubSubCategoryID' onchange='subsubSize(this.value);'  >";
			$combo3.="<option value=''>Select Product Sub Sub Category</option>";
			$combo3.="</select>";*/
			
			$json='
				{
					"SSSSS":"'.$combo.'"
					
						
				}
				';
			print $json; 
			   
			   
			break;
  case "PDTSUBCAT":
				
			 $qrs=mysqli_query($con, "SELECT SubSubCategoryID,SubCategoryName FROM product_ssub_category WHERE SubCategoryID='".$srcText."' 
			 AND ActiveStatus='Active' ORDER BY orderid");
			$combo="<select name='ProductSubSubCategoryID' id='ProductSubSubCategoryID' onchange='set_primary_id();'  >";
			$combo.="<option value=''>Select Product Sub Sub Category</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			
			/*$qrs2=mysqli_query($con, "SELECT
					product_sub_unit.SubUnitID
					, product_sub_unit.SubUnitName
				FROM
					product_cat_size 
					INNER JOIN product_sub_unit 
						ON (product_cat_size.SubUnitID = product_sub_unit.SubUnitID)
				WHERE product_cat_size.CatID='".$srcText."' AND product_sub_unit.ActiveStatus='Active'
				ORDER BY product_sub_unit.SubUnitName");
			$combo2="<select name='ProductSize' id='ProductSize'  >";
			$combo2.="<option value=''>Select Product Size</option>";
			while($qrow2=mysqli_fetch_row($qrs2))
				{
					
				$combo2.="<option value='$qrow2[0]'>$qrow2[1]</option>";	
						
				}
			$combo2.="</select>";*/
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			   
			break;
  case "PDTSUBSIZE":
				
				 $qrs=mysqli_query($con, "SELECT
					product_sub_unit.SubUnitID
					, product_sub_unit.SubUnitName
				FROM
					product_cat_size 
					INNER JOIN product_sub_unit 
						ON (product_cat_size.SubUnitID = product_sub_unit.SubUnitID)
				WHERE product_cat_size.CatID='".$srcText."' AND product_sub_unit.ActiveStatus='Active'
				ORDER BY product_sub_unit.SubUnitName");
			$combo="<select name='ProductSize' id='ProductSize'>";
			$combo.="<option value=''>Select Product Size</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			   
			break;
   case "SSSSCAT":
				
				 $qrs=mysqli_query($con, "SELECT SSSubCategoryID,Title FROM ssscat_table 
				 WHERE SSubCategoryID='".$srcText."' AND ActiveStatus='Active' ORDER BY orderid");
				
			$combo="<select name='SelectSSSubCategory' id='SelectSSSubCategory' onchange='ssss_cat(this.value)'>";
			$combo.="<option value=''>Select Sub Sub Sub Category Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			   
			break;
   case "SSSCAT":
				
				 $qrs=mysqli_query($con, "SELECT SSubCategoryID,Title FROM faq_term_pns_sscat 
				 WHERE SubCategoryID='".$srcText."' AND ActiveStatus='Active' ORDER BY orderid");
				
			$combo="<select name='SelectSSubCategory' id='SelectSSubCategory' onchange='sss_cat(this.value)'>";
			$combo.="<option value=''>Select Sub Sub Category Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			   
			break;
			
  case "FTPS":
				
				 $qrs=mysqli_query($con, "SELECT SubCategoryID,Title FROM faq_term_pns_scat 
				 WHERE CategoryID='".$srcText."' AND ActiveStatus='Active' ORDER BY orderid");
				
			$combo="<select name='SelectSubCategory' id='SelectSubCategory' onchange='subsubsubcat(this.value)'>";
			$combo.="<option value=''>Select Sub Category Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			   
			break;
  case "MFTPS":
				
				 $qrs=mysqli_query($con, "SELECT SubCategoryID,Title FROM faq_term_pns_scat 
				 WHERE CategoryID='".$srcText."' AND ActiveStatus='Active' ORDER BY orderid");
				
			$combo="<select name='SelectSubCategory' id='SelectSubCategory' onchange='ssubcat(this.value)'>";
			$combo.="<option value=''>Select Sub Category Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			   
			break;
  case "MSFTPS":
				
				 $qrs=mysqli_query($con, "SELECT SSubCategoryID,Title FROM faq_term_pns_sscat 
				 WHERE SubCategoryID='".$srcText."' AND ActiveStatus='Active' ORDER BY orderid");
				
			$combo="<select name='SelectSubSubCategory' id='SelectSubSubCategory'>";
			$combo.="<option value=''>Select Sub Sub Category Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			   
			break;	
			
  case "VOLUME":
				
				 $qrs=mysqli_query($con, "SELECT VolumeID,Volume FROM product_size_volume WHERE sub_id='".$srcText."' ORDER BY orderid");
				
			$combo="<select name='Volume' id='Volume'>";
			$combo.="<option value=''>Select Size</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			   
			break;	

  case "SKU":
				
			$MemberData=mysqli_query($con, "SELECT SKUNumber FROM product_info WHERE SKUNumber='".$srcText."' AND InsertBy='".$_SESSION["UserID"]."'");
				$memberRow=mysqli_fetch_row($MemberData);
				if($memberRow[0]!="")
				{
				 $memberRow[0]="Already Exist This SKU Number";
				 $memberRow[1]="";
				}
				else if($memberRow[0]=="" && $srcText!="")
				{
				$memberRow[0]="You Can Continue With This SKU.";
				$memberRow[1]=$srcText;
				}
				else if($memberRow[0]=="" && $srcText=="")
				{
				$memberRow[0]="Please Fillup The SKU No.";
				$memberRow[1]=$srcText;
				}
				$json='
				{
					"SSSSS":"'.$memberRow[0].'",	
					"TTTTT":"'.$memberRow[1].'"	
				}
				';
			print $json;
			   
			break;
  case "ADDMORE":
				
				 $first_color_id = "";
				 $first_size_id = "";
				 $primary_id = $_POST["primary_id"];
				 $color = "color".$srcText;
				 $size = "size".$srcText;
				 $qty = "qty".$srcText;
				 $id = "id".$srcText;
				 $delete = "delete".$srcText;
				 $div_id = "div".$srcText;
				 $file1="file".$srcText."1";
				 $file2="file".$srcText."2";
				 $file3="file".$srcText."3";
				 $file4="file".$srcText."4";
				 $uploadButton="uploadButton".$srcText;
				 $VALUE = "";
				   
                    $VALUE .="<div id='".$div_id."' style='padding-top:10px;' ><span>Color : &nbsp;</span>";
                    $VALUE .=" <span>";
                    $VALUE .="<select name='".$color."' id='".$color."' onchange='idchange(".$srcText.")'>";
					$VALUE .="<option value=''>Select Color</option>";
				 $color_rs = mysqli_query($con, "SELECT ColorID,ColorName FROM color_list");
					 $i = 0;
					while($color_row = mysqli_fetch_row($color_rs))
					{
					
						
                       $VALUE .="<option value='".$color_row[0]."'>".$color_row[1]."</option>";
						
					}
                    $VALUE .="</select> </span>";
					$VALUE .="<span id='".$delete."'>&nbsp;&nbsp;<img src='actionimage/icon_delete.gif' title='delete this row'                                   onclick='delete_row($srcText)'></span><br>";
					$VALUE .="<br>&nbsp;&nbsp;&nbsp;<span>&nbsp;Browse Image: &nbsp;";
					$VALUE .="(1)&nbsp;<input type='file'  name='$file1' id='$file1'/>&nbsp;";
					$VALUE .="(2)&nbsp;<input type='file'  name='$file2' id='$file2'/><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					$VALUE .="(3)&nbsp;<input type='file'  name='$file3' id='$file3'/>&nbsp;";
					$VALUE .="(4)&nbsp;<input type='file'  name='$file4' id='$file4'/>&nbsp;";
					
					
					   $size_rs = mysqli_query($con, "SELECT UnitID,UnitName FROM product_unit WHERE ActiveStatus='Active' ORDER BY UnitID DESC");
					 $j = 0;
					 $size_id_qty_count = 0;
				   while($size_row = mysqli_fetch_row($size_rs))
					{
						$VALUE .="<br>&nbsp;&nbsp;";
						$size_id_qty_count++;
						$size_id_qty_size =  $size.$size_id_qty_count;
						$size_id_qty_qty =  $qty.$size_id_qty_count;
						$size_id_qty_id =  $id.$size_id_qty_count;
						$id_span_msg = "id_span_msg".$size_id_qty_count;;
						
	$VALUE .="<div><div style='width:70px;'><span>$size_row[1]&nbsp;";
	$VALUE .="<input onchange='idchange(".$srcText.")' type='checkbox' name='$size_id_qty_size' id='$size_id_qty_size' value='$size_row[0]' ></span></div>";
	$VALUE .="<div style=' margin-left: 70px;margin-top: -20px;width: 300px;'> <span>&nbsp;&nbsp;Qty: &nbsp;</span> <span>";
	$VALUE .="<input type='text' value='1' name='$size_id_qty_qty' id='$size_id_qty_qty' size='4'></span>";
				  
 $VALUE .=" <span>ID :&nbsp;</span><span><input readonly type='text' name='$size_id_qty_id' id='$size_id_qty_id' size='13'></span><span id='$id_span_msg'></span></div></div>";
						$VALUE .="<br>&nbsp;&nbsp;";
						
					}
               	
				 // $id_value = $primary_id.$first_color_id.$first_size_id;
                 
				  
					
					 $VALUE .= "</div><br>";
				
               //echo $VALUE;
			 //  $VALUE = "aaaaaaaaaaaaaaa";
			 
			
			$json='
				{
					"SSSSS":"'.$VALUE.'",
					"TTTTT":"'.$size_id_qty_count .'"	
						
				}
				';
			print $json; 
			   
			   
			break;	
  case "ADDMOREEDIT":
				
				 $first_color_id = "";
				 $first_size_id = "";
				 $primary_id = $_POST["primary_id"];
				 $color = "color".$srcText;
				 $size = "size".$srcText;
				 $qty = "qty".$srcText;
				 $id = "id".$srcText;
				 $delete = "delete".$srcText;
				 $div_id = "div".$srcText;
				 
				 $uploadButton="uploadButton".$srcText;
				 $VALUE = "";
				   
                    $VALUE .="<div id='".$div_id."' style='padding-top:10px;' ><span>Color : &nbsp;</span>";
                    $VALUE .=" <span>";
                    $VALUE .="<select name='".$color."' id='".$color."' onchange='idchange(".$srcText.")'>";
					$VALUE .="<option value=''>Select Color</option>";
				 $color_rs = mysqli_query($con, "SELECT ColorID,ColorName FROM color_list");
					 $i = 0;
					while($color_row = mysqli_fetch_row($color_rs))
					{
					
						
                       $VALUE .="<option value='".$color_row[0]."'>".$color_row[1]."</option>";
						
					}
                    $VALUE .="</select> </span>";
					$VALUE .="<span id='".$delete."'>&nbsp;&nbsp;<img src='actionimage/icon_delete.gif' title='delete this row'                                   onclick='delete_row($srcText)'></span><br>";
					
					
					
					   $size_rs = mysqli_query($con, "SELECT UnitID,UnitName FROM product_unit WHERE ActiveStatus='Active' ORDER BY UnitID DESC");
					 $j = 0;
					 $size_id_qty_count = 0;
				   while($size_row = mysqli_fetch_row($size_rs))
					{
						$VALUE .="<br>&nbsp;&nbsp;";
						$size_id_qty_count++;
						$size_id_qty_size =  $size.$size_id_qty_count;
						$size_id_qty_qty =  $qty.$size_id_qty_count;
						$size_id_qty_id =  $id.$size_id_qty_count;
						
	$VALUE .="<div><div style='width:70px;'><span>$size_row[1]&nbsp;";
	$VALUE .="<input onchange='idchange(".$srcText.")' type='checkbox' name='$size_id_qty_size' id='$size_id_qty_size' value='$size_row[0]' ></span></div>";
	$VALUE .="<div style=' margin-left: 70px;margin-top: -20px;width: 300px;'> <span>&nbsp;&nbsp;Qty: &nbsp;</span> <span>";
	$VALUE .="<input type='text' value='1' name='$size_id_qty_qty' id='$size_id_qty_qty' size='4'></span>";
				  
    $VALUE .=" <span>ID :&nbsp;</span><span><input readonly type='text' name='$size_id_qty_id' id='$size_id_qty_id' size='13'></span></div></div>";
						$VALUE .="<br>&nbsp;&nbsp;";
						
					}
               	
				 // $id_value = $primary_id.$first_color_id.$first_size_id;
                 
				  
					
					 $VALUE .= "</div><br>";
				
               //echo $VALUE;
			 //  $VALUE = "aaaaaaaaaaaaaaa";
			 
			
			$json='
				{
					"SSSSS":"'.$VALUE.'",
					"TTTTT":"'.$size_id_qty_count .'"	
						
				}
				';
			print $json; 
			   
			   
			break;
  case "FINALIDTEXT":
				
			$MemberData=mysqli_query($con, "SELECT COUNT(ProductFullID) FROM product_details WHERE ProductFullID='".$_POST["send_pdtid"]."'");
			 $MemberData = mysqli_fetch_row($MemberData);
			 $msg = "";
			 if($MemberData[0] > 0)
			 {$msg = "Allready Exist";}
			 else
			 {$msg = "No";}
			
				$json='
				{
					"SSSSS":"'.$msg.'"
				}
				';
			print $json;
			   
			break;
	
 }

?>