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
	   $totalID=count($_POST["catid"]);
	   for($i=0;$i<$totalID;$i++)
	   {
		$update=mysqli_query($con, "UPDATE shipping_method SET orderid='".$_POST["orderid"][$i]."'
		 WHERE MethodID='".$_POST["catid"][$i]."'");
		
	   }
	   header("Location:product_shipping_method_list.php?msg=Successfully Updated ordering...");
	  }
	  
	  if(isset($_REQUEST["acinac"]) && $_REQUEST["acinac"]=="ok")
	  {
		 $rs=mysqli_query($con, "SELECT ActiveStatus FROM shipping_method WHERE MethodID='".$_GET['id']."'");
		 $row=mysqli_fetch_row($rs);
		 if($row[0]=="Active")
		 {$acinac="InActive";}
		 else
		 {$acinac="Active";}
		 mysqli_query($con, "UPDATE shipping_method SET ActiveStatus='".$acinac."' WHERE MethodID='".$_GET['id']."'");
		
		header("Location:product_shipping_method_list.php?msg=Successfully Updated Method...");
	  }
	  
	  if(isset($_REQUEST["del"]) && $_REQUEST["del"]=="ok")
	  {
	     
				
			$delete=mysqli_query($con, "DELETE FROM shipping_method WHERE MethodID='".$_REQUEST["CategoryID"]."'");
			header("Location:product_shipping_method_list.php?msg=Successfully Deleted Method...");
	  }
	  
	  
      $TotalPage=mysqli_query($con, "SELECT COUNT(MethodID) FROM shipping_method");
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
		window.location = "product_shipping_method_list.php?acinac=ok&id="+id;
	}
}
function ConfirmDelete(id)
{
   //alert(""+id);
	var result = confirm("Are you sure you want to Delete this Method?");
	if (result==true)
	{
		window.location = "product_shipping_method_list.php?del=ok&CategoryID="+id;
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
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:" Shipping Method List"; ?></h5>
					</div>
					<!-- end box / title -->
		<div class="pagination pagination-left" style="margin-top:0px; background-color:#FFFFFF;" >
    <div class="results" style="margin-top:0px; background-color:#FFFFFF;" >
	<span>Total Method: <?php print $sss[0]; ?></span>
	</div>
	</div>			
						
    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
  <table width="413" border="0" align="left" cellpadding="0" cellspacing="0">
      <thead>
            <tr >
              <th width="233" align="center" ><strong>SL</strong></th>
              <th width="1715" align="center"  ><strong> <span class="input">
                <input type="hidden" name="type" value="<?php print $_REQUEST["type"]; ?>" />
              </span>Method </strong></th>
              <th width="62" align="center"  ><strong>Order</strong></th>
              <th width="129" align="center"  ><strong>Icon</strong></th>
              <th width="555" align="center" ><strong>Action</strong></th>
            </tr>
	 </thead>
	 <tbody>
       		<?php
			
			   $bgcolor="";
				$recpos=isset($_REQUEST["recpos"])? $_REQUEST["recpos"]:"1";
				$count=($recpos-1)*25;
				$sl=$count;	
              $rs=mysqli_query($con, "SELECT * FROM shipping_method ORDER BY orderid  LIMIT $count,25");
			  while($row=mysqli_fetch_row($rs))
			  {		++$sl;
				  if($sl%2==0)
				  {
				  $bgcolor="bgcolor=\"#999999\"";
				  }
				  else
				  {
					$bgcolor="bgcolor=\"#CCCCCC\"";  
				  }
				  
				  
				 if($row[5]=='Active')
				  {$acinac="InActive";}
				  else
				  {$acinac="Active";}
			?>
            <tr <?php print $bgcolor; ?>>
              <td height="30" align="center"><?php print $sl; ?></td>
              <td align="center"  ><?php print $row[1] ?></td>
              <td align="center">
			  <input name="orderid[]" type="text" size="3" value="<?php print $row[4] ?>" />
			  <input name="catid[]" type="hidden" size="3" value="<?php print $row[0] ?>" />			  </td>
              <td align="center"><img src="menuimage/<?php print $row[3] ?>" height="40" width="60"></td>
              <td align="center">
			   <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
			  <a href="product_shipping_method_edit.php?MethodID=<?php print $row[0]; ?>">Edit</a>
			  <br>
			 <?php } ?>
			  <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","delete_option");
			 if($check_access=="yes")
			  {
			 ?>
			   <a href="#" onclick="ConfirmDelete('<?php print $row[0] ?>');">Delete</a>
			  <br>
			 <?php } ?>
		 <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
			  <a  href="#" onclick="ConfirmAcInac('<?php print $row[0] ?>');"><?php print $acinac ?></a>
			 <?php } ?>		      </td>
            </tr>
            <?php } ?>
			 <tr >
              <td height="30" colspan="5" align="center">
			   		  <div class="buttons">
							
							 <div class="highlight">
							     <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-04","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
							 
								 <input type="submit" name="btnSave" value="   Save    " class="btnsdt" style="color:white;"/>
			<?php } ?>
							 </div>
	    </div>			 </td>
            </tr>
		</tbody>
          </table>

</form>
			  <div class="pagination pagination-left" style="background-color:#FFFFFF;">
			
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
		  <li><a href="product_shipping_method_list.php?recpos=1&type=<?php print $type; ?>">Start</a></li>
		  <li><a href="product_shipping_method_list.php?recpos=<?php print $i-1; ?>&type=<?php print $type; ?>" ><< prev</a></li>
		  <?php } ?>
		  <?php
		  if($li==7+1 && $i<=$TotalPageRow)
		  {
		  // $pl++;
		?>
        
		  <li><a href="product_shipping_method_list.php?recpos=<?php print $i; ?>&type=<?php print $type; ?>">next >></a></li>
     <?php }
	    if($li<=7 && $i>0)
	      { 
		  
		  //$pl++;
		  ?>
          
		  <li><a href="product_shipping_method_list.php?recpos=<?php print $i; ?>&type=<?php print $type; ?>"><?php print $i; ?></a></li>
		<?php }}
		
		?>
        <?php
		 //print $pl;
		if(($i > 7) && ($TotalPageRow >= $nxt+1))
		{
		 ?>
       
		<li><a href="product_shipping_method_list.php?recpos=<?php print $TotalPageRow; ?>&type=<?php print $type; ?>">End</a></li>
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