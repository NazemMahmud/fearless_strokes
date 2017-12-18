<?php
	
	//mysqli_connect("localhost","rollouto_db","$5qDDfDzX],E");
 	// $con =  mysqli_connect("localhost","root","","fearless_db");
      //  $con =  mysqli_connect("localhost","ctrlnweb_fearles","GdPSp1+y_(VN","ctrlnweb_fearless_db");
       $con =  mysqli_connect("localhost","fearless_strokes","strokes5889","fearless_strokes");
	//mysqli_select_db("rollout_db");
	//$url_cod = "http://rolloutonline.com/";
	$url_cod = "http://localhost/rollout/";
	$site_name = "Fearless-Strokes ";
	$theme_color = "blue";
	$button_background = button_background($theme_color);
	function MakeID($con, $tablename,$fieldname,$prefix,$length)
		{
			$rs=mysqli_query($con, "select max(".$fieldname.") from ".$tablename);
			$row=mysqli_fetch_row($rs);
			$shahadat=$row[0];
			$prefixlength=strlen($prefix);
			$number=substr($shahadat,$prefixlength);
			$numberval=intval($number);	
			$numberval=$numberval+1;
			$numberlength=strlen($numberval);
			$zero=$length-$prefixlength-$numberlength;
			$zerorepeat=str_repeat("0",$zero);
			$id=$prefix.$zerorepeat.$numberval;
			return($id);
		}
	function MakeID_Category($con, $tablename,$fieldname,$prefix,$length,$refField,$cOnditionValue)
		{
			$rs=mysqli_query($con, "select max(".$fieldname.") from $tablename WHERE ".$refField."='".$cOnditionValue."'");
			$row=mysqli_fetch_row($rs);
			$shahadat=$row[0];
			$prefixlength=strlen($prefix);
			$number=substr($shahadat,$prefixlength);
			$numberval=intval($number);	
			$numberval=$numberval+1;
			$numberlength=strlen($numberval);
			$zero=$length-$prefixlength-$numberlength;
			$zerorepeat=str_repeat("0",$zero);
			$id=$prefix.$zerorepeat.$numberval;
			return($id);
	 }
	function MakeID_Type($con, $tablename,$fieldname,$prefix,$length,$type)
		{
			$rs=mysqli_query($con, "select max(".$fieldname.") from ".$tablename." WHERE type='".$type."'");
			$row=mysqli_fetch_row($rs);
			$shahadat=$row[0];
			$prefixlength=strlen($prefix);
			$number=substr($shahadat,$prefixlength);
			$numberval=intval($number);	
			$numberval=$numberval+1;
			$numberlength=strlen($numberval);
			$zero=$length-$prefixlength-$numberlength;
			$zerorepeat=str_repeat("0",$zero);
			$id=$prefix.$zerorepeat.$numberval;
			return($id);
		}
         function MakeID_ID($con, $tablename,$fieldname,$prefix,$length)
		{
			$rs=mysqli_query($con, "select max(".$fieldname.") from ".$tablename." WHERE ".$fieldname." LIKE '".$prefix."%'");
			$row=mysqli_fetch_row($rs);
			$shahadat=$row[0];
			$prefixlength=strlen($prefix);
			$number=substr($shahadat,$prefixlength);
			$numberval=intval($number);	
			$numberval=$numberval+1;
			$numberlength=strlen($numberval);
			$zero=$length-$prefixlength-$numberlength;
			$zerorepeat=str_repeat("0",$zero);
			$id=$prefix.$zerorepeat.$numberval;
			return($id);
		}
	 function upload_file($con, $uploadfolder,$ID,$uploadfilename)
		{
			$uploadfilename1 = $_FILES[$uploadfilename]['name'];
	        $filename = $uploadfolder.$ID.$uploadfilename1;
	        if(move_uploaded_file($_FILES[$uploadfilename]['tmp_name'], $filename))
			{
			return($filename);
			}
			else return "";
		}
           function MakeInvoiceID($tablename,$fieldname,$prefix,$length)
		{
			$rs=mysqli_query($con, "select max(".$fieldname.") from ".$tablename." WHERE LEFT(".$fieldname.",10)='".$prefix."'");
			$row=mysqli_fetch_row($rs);
			$shahadat=$row[0];
			$prefixlength=strlen($prefix);
			$number=substr($shahadat,$prefixlength);
			$numberval=intval($number);	
			$numberval=$numberval+1;
			$numberlength=strlen($numberval);
			$zero=$length-$prefixlength-$numberlength;
			$zerorepeat=str_repeat("0",$zero);
			$id=$prefix.$zerorepeat.$numberval;
			return($id);
		}
//	............................................................
		
	function MakeTable($con, $tablename)
		{
			$rs=mysqli_query($con, "select * from ".$tablename);
			$totalcolumn=mysqli_num_fields($rs);
			$output="<table border=\"1\">\n";
			while($row=mysqli_fetch_row($rs))
				{
				$output.="<tr>\n";
				for($i=0;$i<$totalcolumn;$i++)
					{
						$output.="<td>$row[$i]</td>\n";	
					}
			$output.="</tr>\n";	
				}
			$output.="</table>";	
			return($output);
		}
//..........................................................
	
	function MakeCombo($con, $sql,$name,$previousrecord)
		{
			
			$qrs=mysqli_query($con, $sql);
			$combo="<select name=\"$name\">";
			while($qrow=mysqli_fetch_row($qrs))
				{
					if($previousrecord==$qrow[0])
						{
						$combo.="<option value=\"$qrow[0]\"selected>$qrow[1]</option>";
						}
					else
						{
						$combo.="<option value=\"$qrow[0]\">$qrow[1]</option>";	
						}
				}
			$combo.="</select>";
			return($combo);	
		}
//.........................................................

	function MakeDate($myFormat="y-m-d h:i:s",$myZone="Asia/Dhaka")
		{
			$mydate= new DateTime(null, new DateTimeZone($myZone));
			return($mydate-> format($myFormat));	
		}
		
//............... function for get ad page name.....................

		 function adPageName($con, $menuID, $menuType)
		 {
				   if($menuType=="InnerMenu")
				   {
					$pagename=mysqli_fetch_row(mysqli_query($con, "SELECT Title FROM inner_menu WHERE InnerID='".$menuID."'")); 
					return $pagename[0];
				   } 
				   else if($menuType=="productSubCatID")
				   {
					$pagename=mysqli_fetch_row(mysqli_query($con, "SELECT SubCategoryName FROM product_sub_category WHERE SubCategoryID='".$menuID."'")); 
					return $pagename[0];
				   } 
				   else if($menuType=="serviceSubCatID")
				   {
					$pagename=mysqli_fetch_row(mysqli_query($con, "SELECT SubCategoryName FROM service_sub_category WHERE SubCategoryID='".$menuID."'")); 
					return $pagename[0];
				   } 
				   else if($menuType=="subsubmenu")
				   {
					$pagename=mysqli_fetch_row(mysqli_query($con, "SELECT title FROM subsubmenu WHERE ssid='".$menuID."'")); 
					return $pagename[0];
				   } 
				   else if($menuType=="productCatID")
				   {
					$pagename=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName FROM product_category_info WHERE CategoryID='".$menuID."'")); 
					return $pagename[0];
				   } 
				   else if($menuType=="serviceCatID")
				   {
					$pagename=mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName FROM service_category_info WHERE CategoryID='".$menuID."'")); 
					return $pagename[0];
				   } 
				   else if($menuType=="submenu")
				   {
					$pagename=mysqli_fetch_row(mysqli_query($con, "SELECT title FROM submenu WHERE sid='".$menuID."'")); 
					return $pagename[0];
				   } 
				   else 
				   {
					$pagename=mysqli_fetch_row(mysqli_query($con, "SELECT title FROM mainmenu WHERE mid='".$menuID."'")); 
					return $pagename[0];
				   } 
		 }
 	function check_access($con, $userid,$modid,$option)
		{
			$row=mysqli_fetch_row(mysqli_query($con, "SELECT ".$option." FROM user_admin_activity WHERE UserID='".$userid."' AND ModuleID='".$modid."'"));	
			return $row[0];
		}
	function check_access_primary($con, $userid,$modid)
		{
			$rs = mysqli_query($con, "SELECT add_option,edit_option,delete_option FROM user_admin_activity WHERE UserID='".$userid."' AND ModuleID='".$modid."'");

			$row=mysqli_fetch_row($rs);	
			if($row[0]=="yes" || $row[1]=="yes" || $row[2]=="yes")
			return "yes";
			else
			return "no";
		}
	function button_background($thm_color)
	    {
		    if($thm_color == "red")
			return "#F33"; 
			else if($thm_color == "blue")
			return "#4377AB";
			else if($thm_color == "green")
			return "#8C9856";  		
		}
	function product_parent_category($cattype, $catid)
	    {
		    if($cattype == "scat")
			{
			   return 	product_scat_parent($con, $catid);
			}
			else if($cattype == "sscat")
			{
			  return 	product_scat_parent($con, product_sscat_parent($con, $catid)); 	
			}
					
		}
	function product_sscat_parent($con, $catid)
	    {
			$row = mysqli_fetch_row(mysqli_query($con, "SELECT SubCategoryID FROM product_ssub_category WHERE SubSubCategoryID='".$catid."'"));
			return $row[0];
		}
	function product_scat_parent($con, $catid)
	    {
			$row = mysqli_fetch_row(mysqli_query($con, "SELECT CategoryID FROM product_sub_category WHERE SubCategoryID='".$catid."'"));
			return $row[0];
		}
 function end_quote_send($get)
     {

		 return str_replace("'","&acute;",$get);
				
	}
	
  
  function end_quote_receive($get)
     {

		 return str_replace("&acute;","'",$get);
				
	}
?>