<?php
require_once("connection.php");
$action=$_POST["func"];
	$srcText=$_POST["src"];
 
 switch($action)
 {			
case "MENU":
				
			if($srcText!="Root Home")
			 {
			 $qrs=mysqli_query($con, "SELECT mid,title FROM mainmenu WHERE menutype='".$srcText."' AND ActiveStatus='Active'
			  ORDER BY mid");
			$combo="<select name='MenuName' id='MenuName' onchange='submenu(this.value)'>";
			$combo.="<option value=''>Select Menu Name</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			 }
			 else if($srcText=="Root Home")
			 {

			$combo="<select name='MenuName' id='MenuName' onchange='submenu(this.value)'>";
			$combo.="<option value='Root Home'>Root Home</option>";
			$combo.="</select>";
			 }
			$json='
				{
					"SSSSS":"'.$combo.'"	
						
				}
				';
			print $json; 
			   
			break;
			
	
case "SUBMENU":
				
			  if($srcText=='MN-0001')
			   {
			      $qrs=mysqli_query($con, "SELECT CategoryID,CategoryName FROM product_category_info WHERE ActiveStatus='Active' ORDER BY CategoryName");
				  			$combo="<select name='SubMenu' id='SubMenu' onchange='subsubmenu(this.value)' >";
			$combo.="<option value=''>Select Sub Menu</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				      $combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
					  
				}
			$combo.="</select>";
				  
			   }
			   else if($srcText=='MN-0002')
			   {
			      $qrs=mysqli_query($con, "SELECT CategoryID,CategoryName FROM service_category_info WHERE ActiveStatus='Active' ORDER BY CategoryName");
				  			$combo="<select name='SubMenu' id='SubMenu' onchange='subsubmenu(this.value)' >";
			$combo.="<option value=''>Select Sub Menu</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				      $combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
					  
				}
			$combo.="</select>";
			   }
			   else
			   {
			     $qrs=mysqli_query($con, "SELECT sid,title,articlelink FROM submenu WHERE mid='".$srcText."' 
			     AND ActiveStatus='Active' AND editstatus='0'");
				 			$combo="<select name='SubMenu' id='SubMenu' onchange='subsubmenu(this.value)' >";
			$combo.="<option value=''>Select Sub Menu</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					$test=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(ssid),(SELECT sid FROM subsubmenu WHERE sid='".$qrow[0]."' LIMIT 1) as 'Parent'
					  FROM subsubmenu WHERE sid='".$qrow[0]."' AND ActiveStatus='Active' AND articlelink!='#'"));
					  if($test[1]!="")
					  {
					    if($test[0]>0)
						$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
					  }
					  else if($qrow[2]!="#")
					  {
				      $combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
					  }
				}
			$combo.="</select>";
			   }

			
			$sql="SELECT InnerID,Title FROM inner_menu WHERE ParentID='".$srcText."' AND ActiveStatus='Active' AND articlelink!='#'";
			$qrs=mysqli_query($con, "$sql");
			$combo2="<select name='InnerMenu' id='InnerMenu' >";
			$combo2.="<option value=''>Select Inner Menu</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo2.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo2.="</select>";
			
			$json='
				{
					"SSSSS":"'.$combo.'",	
					"TTTTT":"'.$combo2.'"
						
				}
				';
			print $json; 
			   
			break;	
			
			
case "SUBSUBMENU":
				
				
				if(substr($srcText,0,4)=="SCAT")
				{
				 $qrs=mysqli_query($con, "SELECT SubCategoryID,SubCategoryName FROM service_sub_category WHERE CategoryID='".$srcText."'");
				    $combo="<select name='SubSubMenu' id='SubSubMenu' >";
					$combo.="<option value=''>Select Sub Sub Menu</option>";
					while($qrow=mysqli_fetch_row($qrs))
						{
							
						$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
								
						}
					$combo.="</select>";
				
				}
				else if(substr($srcText,0,4)=="PCAT")
				{
				   $qrs=mysqli_query($con, "SELECT SubCategoryID,SubCategoryName FROM product_sub_category WHERE CategoryID='".$srcText."'");
				    $combo="<select name='SubSubMenu' id='SubSubMenu' >";
					$combo.="<option value=''>Select Sub Sub Menu</option>";
					while($qrow=mysqli_fetch_row($qrs))
						{
							
						$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
								
						}
					$combo.="</select>";
				}
				else
				{
			$qrs=mysqli_query($con, "SELECT ssid,title,articlelink FROM subsubmenu WHERE sid='".$srcText."' AND ActiveStatus='Active' AND articlelink!='#'");
			$combo="<select name='SubSubMenu' id='SubSubMenu' onchange='innermenu(this.value)' >";
			$combo.="<option value=''>Select Sub Sub Menu</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo.="</select>";
			    }
			$sql="SELECT InnerID,Title FROM inner_menu WHERE ParentID='".$srcText."' AND ActiveStatus='Active' AND articlelink!='#'";
			$qrs=mysqli_query($con, "$sql");
			$combo2="<select name='InnerMenu' id='InnerMenu' >";
			$combo2.="<option value=''>Select Inner Menu</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo2.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo2.="</select>";
			
			$json='
				{
					"SSSSS":"'.$combo.'",	
					"TTTTT":"'.$combo2.'"
						
				}
				';
			print $json; 
			   
			break;	
			

case "INNERMENU":
			
			$sql="SELECT InnerID,Title FROM inner_menu WHERE ParentID='".$srcText."' AND ActiveStatus='Active' AND articlelink!='#'";
			$qrs=mysqli_query($con, "$sql");
			$combo2="<select name='InnerMenu' id='InnerMenu' >";
			$combo2.="<option value=''>Select Inner Menu</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo2.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo2.="</select>";
			
			$json='
				{
					"TTTTT":"'.$combo2.'"
						
				}
				';
			print $json; 
			   
			break;	
					
case "WHAD":
            $combo="";
			if($srcText=="Top")
			{	
			$combo.="<select name='Width' id='Width'>";
			$combo.="<option value=''>Select Width</option>";
				$combo.="<option value='190px'>190px</option>";	
				$combo.="<option value='380px'>380px</option>";	
				$combo.="<option value='570px'>570px</option>";	
				$combo.="<option value='760px'>760px</option>";	
                $combo.="<option value='950px'>950px</option>";	
			$combo.="</select>";
		   }
		   else if($srcText=="Bottom")
			{	
			$combo.="<select name='Width' id='Width'>";
			$combo.="<option value=''>Select Width</option>";
				$combo.="<option value='152px'>152px</option>";	
				$combo.="<option value='304px'>304px</option>";	
				$combo.="<option value='456px'>456px</option>";	
				$combo.="<option value='608px'>608px</option>";	
			$combo.="</select>";
		   }
		   else if($srcText=="Menu")
			{	
			$combo.="<select name='Width' id='Width'>";
				$combo.="<option value='180px'>180px</option>";	
			$combo.="</select>";
		   }
		   else
		   {
		    $combo.="<select name='Width' id='Width'>";
			$combo.="<option value=''>Select Width</option>";
				$combo.="<option value='148px'>148px</option>";	
				$combo.="<option value='296px'>296px</option>";	
			$combo.="</select>";
		   }
		   $sql="SELECT AdID,Title FROM advertisement_info WHERE Position='".$srcText."' AND  ActiveStatus='Active' ";
			$qrs=mysqli_query($con, "$sql");
			$combo2="<select name='SelectAd' id='SelectAd' >";
			$combo2.="<option value=''>Select Ad</option>";
			while($qrow=mysqli_fetch_row($qrs))
				{
					
				$combo2.="<option value='$qrow[0]'>$qrow[1]</option>";	
						
				}
			$combo2.="</select>";
		   
			$json='
				{
					"SSSSS":"'.$combo.'",	
					"TTTTT":"'.$combo2.'"	
						
				}
				';
			print $json; 
			   
			break;

 }

?>