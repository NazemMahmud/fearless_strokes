<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
	
	  if(isset($_REQUEST["acinac"]) && $_REQUEST["acinac"]=="ok")
		{
		
			$rs=mysqli_query($con, "SELECT ActiveStatus FROM promotional_code WHERE SL='".$_GET['id']."'");
		 $row=mysqli_fetch_row($rs);
		 if($row[0]=="Active")
		 {$acinac="InActive";}
		 else
		 {$acinac="Active";}
		 mysqli_query($con, "UPDATE promotional_code SET ActiveStatus='".$acinac."' where SL='".$_GET['id']."'");
		
		 header("Location:promotion_list.php?msg=Promotion Code Successfully Updated!");
		}
	 
	  if(isset($_REQUEST["del"]) && $_REQUEST["del"]=="ok")
	  {
	    if(mysqli_query($con, "DELETE FROM promotional_code WHERE SL='".$_GET['id']."'"))
		{
		  header("Location:promotion_list.php?msg=Promotion Code Successfully Deleted!");	
		}
	  }
	  
	  
      $TotalPage=mysqli_query($con, "SELECT COUNT(SL) FROM promotional_code");
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
		window.location = "promotion_list.php?acinac=ok&id="+id;
	}
}
function ConfirmDelete(id)
{
   //alert(""+id);
	var result = confirm("Are you sure you want to Delete this and related all?");
	if (result==true)
	{
		window.location = "promotion_list.php?del=ok&id="+id;
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
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:"Promotion Code List"; ?></h5>
					</div>
					<!-- end box / title -->
		<div class="pagination pagination-left" style="margin-top:0px; background-color:#FFFFFF;" >
    <div class="results" style="margin-top:0px; background-color:#FFFFFF;" >
	<span>Total Promotion Code: <?php print $sss[0]; ?></span>
	</div>
	</div>			
						
    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
  <table width="413" border="0" align="left" cellpadding="0" cellspacing="0">
      <thead>
            <tr >
              <th width="23" align="center" ><strong>SL</strong></th>
              <th width="82" align="center"  ><strong> CODE </strong></th>
              <th width="86" align="center"  ><strong>Discount</strong></th>
              <th width="136" align="center"  ><strong>Description</strong><strong></strong></th>
              <th width="86" align="center" ><strong>Action</strong></th>
            </tr>
	 </thead>
	 <tbody>
       		<?php
			
			   $bgcolor="";
				$recpos=isset($_REQUEST["recpos"])? $_REQUEST["recpos"]:"1";
				$count=($recpos-1)*25;
				$sl=$count;	
              $rs=mysqli_query($con, "SELECT SL,PromotionalID,Discount,Description,ActiveStatus FROM promotional_code
			   ORDER BY SL DESC  LIMIT $count,25");
			  while($row=mysqli_fetch_row($rs))
			  {		++$sl;
				  
				  
				 if($row[4]=='Active')
				  {$acinac="InActive";}
				  else
				  {$acinac="Active";}
			?>
            <tr>
              <td height="30" align="center"><?php print $sl; ?></td>
              <td align="center"  ><?php print $row[1] ?></td>
              <td align="center"><?php print $row[2] ?></td>
              <td align="center"><?php print $row[3] ?></td>
              <td align="center">
			  <a href="promotion_edit.php?SL=<?php print $row[0]; ?>">Edit</a>
			  <br>
			   <a href="#" onclick="ConfirmDelete('<?php print $row[0] ?>');">Delete</a>
			  <br>
			  <a  href="#" onclick="ConfirmAcInac('<?php print $row[0] ?>');"><?php print $acinac ?></a>
			  
			  </td>
            </tr>
              <?php } ?>
			
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
		  <li><a href="promotion_list.php?recpos=1">Start</a></li>
		  <li><a href="promotion_list.php?recpos=<?php print $i-1; ?>" ><< prev</a></li>
		  <?php } ?>
		  <?php
		  if($li==7+1 && $i<=$TotalPageRow)
		  {
		  // $pl++;
		?>
        
		  <li><a href="promotion_list.php?recpos=<?php print $i; ?>">next >></a></li>
     <?php }
	    if($li<=7 && $i>0)
	      { 
		  
		  //$pl++;
		  ?>
          
		  <li><a href="promotion_list.php?recpos=<?php print $i; ?>"><?php print $i; ?></a></li>
		<?php }}
		
		?>
        <?php
		 //print $pl;
		if(($i > 7) && ($TotalPageRow >= $nxt+1))
		{
		 ?>
       
		<li><a href="promotion_list.php?recpos=<?php print $TotalPageRow; ?>">End</a></li>
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