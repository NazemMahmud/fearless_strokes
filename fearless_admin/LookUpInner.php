<?php
require_once("connection.php");
$action=$_POST["func"];
	$srcText=$_POST["src"];
 
 switch($action)
 {

			
case "PARENTMENU":
				
			 $qrs=mysqli_query($con, "SELECT mid,title FROM mainmenu WHERE menutype='".$srcText."' 
			  AND ActiveStatus='Active' AND editstatus='0'");
			 if($srcText=="Main" || $srcText=="Top Left" || $srcText=="Top Right")
				{
			$combo="<select name='MainMenu' id='MainMenu' onchange='submenu(this.value)' >";
			    }
			 else
			    {
		   $combo="<select name='MainMenu' id='MainMenu'>";
				}
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
			
case "SUBMENU":
				
			 $qrs=mysqli_query($con, "SELECT sid,title FROM submenu WHERE mid='".$srcText."' 
			  AND ActiveStatus='Active'");
			$combo="<select name='SubMenu' id='SubMenu' onchange='subsubmenu(this.value)' >";
			$combo.="<option value=''>Select Sub Menu</option>";
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
case "SUBSUBMENU":
				
			 $qrs=mysqli_query($con, "SELECT ssid,title FROM subsubmenu WHERE sid='".$srcText."' 
			  AND ActiveStatus='Active'");
			$combo="<select name='SubSubMenu' id='SubSubMenu' >";
			$combo.="<option value=''>Select Sub Sub Menu</option>";
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
 }

?>