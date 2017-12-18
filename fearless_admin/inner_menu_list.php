<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
 
      if(isset($_POST["btnSave"]))
	  {
	   $totalID=count($_POST["ID"]);
	   $parent=$_POST["parent"];
	   $type=$_POST["type"];
	   for($i=0;$i<$totalID;$i++)
	   {
	    $update=mysqli_query($con, "UPDATE inner_menu SET Title='".$_POST["title"][$i]."',OrderID='".$_POST["order"][$i]."',
		ActiveStatus='".$_POST["Status"][$i]."' WHERE ParentID='".$parent."' AND ParentType='".$type."' AND InnerID='".$_POST["ID"][$i]."'");
	   }
	   header("Location:inner_menu_list.php?parent=$parent&type=$type");
	  }
	  
	   if($_REQUEST["type"]=="SubSubMenu")
	   {
	    $parentname=mysqli_query($con, "SELECT title FROM subsubmenu WHERE ssid='".$_REQUEST["parent"]."'");
		 $parentnameRow=mysqli_fetch_row($parentname);
	   }
	   else if($_REQUEST["type"]=="SubMenu")
	   {
	    $parentname=mysqli_query($con, "SELECT title FROM submenu WHERE sid='".$_REQUEST["parent"]."'");
		 $parentnameRow=mysqli_fetch_row($parentname);
	   }
	   else
	   {
	    
	    $parentname=mysqli_query($con, "SELECT title FROM mainmenu WHERE mid='".$_REQUEST["parent"]."'");
		 $parentnameRow=mysqli_fetch_row($parentname);
	   }
	
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>PEPEELIKA</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<!-- stylesheets -->
		<link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="resources/css/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="resources/css/style_fixed.css" />
		<link id="color" rel="stylesheet" type="text/css" href="resources/css/colors/red.css" />
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
		window.location = "delete.php?type=product&id="+id;
	}
}
</script>
         <style type="text/css">
		.btnsdt
			{
			background-color:#F33;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
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
					<div class="title" style="margin-bottom:0px;">
						<h5><?php print @isset($_REQUEST["type"])?"Inner Menu List of ".$parentnameRow[0]:"Inner Menu List"; ?></h5>
						
							<div class="search" style="width:auto; float:right; color:#FFFFFF; font-size:12px; margin-top:0px;"> 
							
						</div>
						
					</div>
					<!-- end box / title -->
					
						
    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
  <table width="97%" border="0" align="left" cellpadding="0" cellspacing="0">
        <thead>
            <tr >
              <th width="38" align="center" ><strong>SL</strong></th>
              <th width="201" align="center"  ><strong> 
                <input type="hidden" name="type" value="<?php print $_REQUEST["type"]; ?>" />
				<input type="hidden" name="parent" value="<?php print $_REQUEST["parent"]; ?>" />
              Title </strong><strong></strong></th>
              <th width="58" align="center"  ><strong>Order</strong></th>
              <th width="104" align="center" ><strong>Status</strong><strong></strong></th>
              <th colspan="2" align="center" ><strong>Icon</strong></th>
              <th width="217" align="center" ><strong>Action</strong></th>
            </tr>
		</thead>
		<tbody>
       		<?php
			
			$sl=0;
              $rs=mysqli_query($con, "SELECT InnerID,Title,OrderID,ActiveStatus,IconName,LinkType,articlelink FROM inner_menu 
			  WHERE ParentID='".$_REQUEST["parent"]."' ORDER BY OrderID");
			  while($row=mysqli_fetch_row($rs))
			  {	 
			  	 ++$sl;
				 if($row[5]=="General")
				 {
				   $articleview="<a href='#'>View Article</a>";
				 }
				 else if($row[5]=="List")
				 {
				   $articleview="<a href='#' onclick=\"window.open('insert_delete_article_list.php?type=view&MID=$row[0]','insert_delete_article_list','height=400px,width=400px, left=200px, top=100px, align=center,scrollbars=1')\">View List</a> <br><a href='#' onclick=\"window.open('insert_delete_article_list.php?type=insert&MID=$row[0]','insert_delete_article_list','height=400px,width=400px, left=200px, top=100px, align=center,scrollbars=1')\">Insert into List</a>";
				 }
				 
			?>
            <tr >
              <td height="39" align="center" valign="middle"><?php print $sl; ?>
              <input type="hidden" name="ID[]" value="<?php print @$row[0] ?>" /></td>
              <td align="center" valign="middle"  ><input name="title[]" type="text" size="30" value="<?php print @$row[1] ?>" /></td>
              <td align="center" valign="middle"><input name="order[]" type="text" value="<?php print @$row[2] ?>" size="2" maxlength="2"/></td>
              <td align="center" valign="middle">
			  <select name="Status[]">
			     <?php
				   if($row[3]=="Active")
				   {
				    $active="selected=\"selected\"";
					$inactive="";
				   }
				   else
				   {
				    $active="";
					$inactive="selected=\"selected\"";
				   }
				 ?>
			   <option value="Active" <?php print $active; ?>>Active</option>
			   <option value="InActive" <?php print $inactive; ?>>InActive</option>
              </select>              </td>
              <td width="53" align="center" valign="middle"><img src="menuimage/<?php print $row[4];?>" /></td>
              <td width="69" align="center" valign="middle"><a href="#"  onclick="window.open('menu_icon_change.php?MenuID=<?php print $row[0]; ?>&menutype=innermenu','menu_icon_change','height=300px,width=350px,align=center,scrolling=yes');">Change </a></td>
              <td align="center" valign="middle">
			  <?php
			   if(substr($row[6],0,7)=="content" && ($row[5]=="General" || $row[5]=="List"))
			   {
			  ?>
			  Article Type: <?php print $row[5]; ?><br>
			  <?php print  $articleview;
			  }
			   ?>
			  </td>
            </tr>
			<?php } ?>
            <tr >
              <td height="34" colspan="7" align="center" valign="middle">
			  	<div class="buttons">
							
							 <div class="highlight">
								 <input type="submit" name="btnSave" value="   Save    " class="btnsdt" style="color:white;"/>
							 </div>
						  </div>			  </td>
            </tr>
	  </tbody>
          </table>
</form>
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