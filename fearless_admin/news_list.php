<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
    $Date=MakeDate();
	 if(isset($_REQUEST["type"]) && $_REQUEST["type"]=="news")
	    {
			      
					$rs=mysqli_query($con, "SELECT ActiveStatus FROM news_info WHERE NewsID='".$_GET['id']."'");
				 $row=mysqli_fetch_row($rs);
				 if($row[0]=="Active")
				 {$acinac="InActive";}
				 else
				 {$acinac="Active";}
				 mysqli_query($con, "UPDATE news_info SET ActiveStatus='".$acinac."' where NewsID='".$_GET['id']."'");
				
				$activity_update=mysqli_query($con, "UPDATE news_info SET UpdateDate='".$Date."',UpdateBy='".$_SESSION['UserID']."'
					  WHERE NewsID='".$_GET['id']."'");
				
				 header("Location:news_list.php?msg=Notice and Circulation Successfully Updated!");
		 
	    }
     if(isset($_REQUEST["del"]) && $_REQUEST["del"]=="ok")
	  {
        
		    $uploadfolder="newsimage/";
		    $img=mysqli_fetch_row(mysqli_query($con, "SELECT NewsImage FROM news_info WHERE NewsID='".$_REQUEST["NewsID"]."'"));
			@unlink($uploadfolder.$img[0]);
			$delete=mysqli_query($con, "DELETE FROM news_info WHERE NewsID='".$_REQUEST["NewsID"]."' ");
			header("Location:news_list.php?msg=Successfully Deleted Notice and Circulation..");
		 
	  }
 
   $TotalPage=mysqli_query($con, "SELECT COUNT(NewsID) FROM news_info");
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
	 $bgcolor="";
				$recpos=isset($_REQUEST["recpos"])? $_REQUEST["recpos"]:"1";
				$count=($recpos-1)*25;
				$sl=$count;
    $rs=mysqli_query($con, "SELECT
    news_info.NewsID
    , news_info.Title
    , news_info.IssuedBy
    , news_info.IssuedTo
    , news_category_info.CategoryName
    , news_info.ActiveStatus
    , news_info.NewsImage
    , news_info.LinkImage
FROM
    news_info
    INNER JOIN  news_category_info 
        ON (news_info.NewsCategoryID = news_category_info.CategoryID)
ORDER BY news_info.NewsID DESC LIMIT $count,25");

 // }
 
			
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
		window.location = "news_list.php?type=news&id="+id;
	}
}
function ConfirmDelete(id)
{
   //alert(""+id);
	var result = confirm("Are you sure you want to Delete this News?");
	if (result==true)
	{
		window.location = "news_list.php?del=ok&NewsID="+id;
	}
}
</script>
         <style type="text/css">
		.btnsdt
			{
			background-color:#F33;
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
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:"Notice and Circulation List"; ?></h5>
						<div class="search">
							<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customersss" method="post" enctype="multipart/form-data">
							</form>
						</div>
					</div>
					<!-- end box / title -->
					
		  <div class="pagination pagination-left" style="margin-top:0px; background-color:#FFFFFF;" >
    <div class="results" style="margin-top:0px; background-color:#FFFFFF;" >
	<span>Total Notice and Circulation: <?php print $sss[0]; ?></span>
	</div>
	</div>					
    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
  <table width="97%" border="0" align="left" cellpadding="0" cellspacing="0">
        <thead>
            <tr >
              <th width="51" align="center" ><strong>SL</strong></th>
              <th width="99" align="center"  ><strong> Title </strong></th>
              <th width="107" align="center"  ><strong>Issued By </strong></th>
              <th width="160" align="center"  ><strong>Issued To </strong><strong></strong></th>
              <th width="118" align="center" ><strong>Category</strong></th>
              <th width="82" align="center" ><strong>Download </strong></th>
              <th align="center" ><strong>Action</strong></th>
          </tr>
		</thead>
		<tbody>
       		<?php
			
			//$sl=0;
              //$rs=mysqli_query($con, "SELECT UserID,UserName,Address,ContactNumber,Email,UserType,ActiveStatus FROM user_admin ORDER BY UserID DESC ");
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
				  
				  if($row[7]!="")
				  $linkimg="<img src='newsimage/$row[7]' style='width:50px; height:40px;'>";
				  else
				  $linkimg="Download File";
			?>
            <tr <?php print $bgcolor; ?>>
              <td height="61" align="center" valign="middle"><?php print $sl; ?></td>
              <td align="center" valign="middle"  ><?php print $row[1] ?></td>
              <td align="center" valign="middle"><?php print $row[2] ?></td>
              <td align="center" valign="middle"><?php print $row[3] ?></td>
              <td align="center" valign="middle"><?php print $row[4] ?></td>
              <td align="center" valign="middle"><a href="newsimage/<?php print $row[6]; ?>" target="_blank"><?php print $linkimg; ?></a></td>
              <td align="center" valign="middle">
			  <?php
							  $check_access=check_access($con, $_SESSION["UserID"],"MOD-14","edit_option");
							 if($check_access=="yes")
							  {
							 ?>
			  <a href="news_edit.php?NewsID=<?php print $row[0]; ?>">Edit</a>
			  <br><?php } ?>
			  <?php
							  $check_access=check_access($con, $_SESSION["UserID"],"MOD-14","delete_option");
							 if($check_access=="yes")
							  {
							 ?>
			  <a  href="#" onclick="ConfirmDelete('<?php print $row[0] ?>');">Delete</a>
			  <br><?php } ?>
			  <?php
							  $check_access=check_access($con, $_SESSION["UserID"],"MOD-14","edit_option");
							 if($check_access=="yes")
							  {
							 ?>
			  <a  href="#" onclick="ConfirmAcInac('<?php print $row[0] ?>');"><?php print $acinac ?></a>
			             <?php } ?>
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
		  <li><a href="news_list.php?recpos=1">Start</a></li>
		  <li><a href="news_list.php?recpos=<?php print $i-1; ?>" ><< prev</a></li>
		  <?php } ?>
		  <?php
		  if($li==7+1 && $i<=$TotalPageRow)
		  {
		  // $pl++;
		?>
        
		  <li><a href="news_list.php?recpos=<?php print $i; ?>">next >></a></li>
     <?php }
	    if($li<=7 && $i>0)
	      { 
		  
		  //$pl++;
		  ?>
          
		  <li><a href="news_list.php?recpos=<?php print $i; ?>"><?php print $i; ?></a></li>
		<?php }}
		
		?>
        <?php
		 //print $pl;
		if(($i > 7) && ($TotalPageRow >= $nxt+1))
		{
		 ?>
       
		<li><a href="news_list.php?recpos=<?php print $TotalPageRow; ?>">End</a></li>
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