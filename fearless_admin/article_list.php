<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
    $Date=MakeDate();
	    if(isset($_REQUEST["type"]) && $_REQUEST["type"]=="article")
	    {
			$rs=mysqli_query($con, "SELECT ActiveStatus FROM content_info WHERE  ContentID='".$_GET['id']."'");
		 $row=mysqli_fetch_row($rs);
		 if($row[0]=="Active")
		 {$acinac="InActive";}
		 else
		 {$acinac="Active";}
		 mysqli_query($con, "UPDATE content_info SET ActiveStatus='".$acinac."' where ContentID='".$_GET['id']."'");
		
		    $activity_update=mysqli_query($con, "UPDATE content_info SET UpdateDate='".$Date."',UpdateBy='".$_SESSION['UserID']."'
					  WHERE ContentID='".$_GET['id']."'");
		
		 header("Location:article_list.php?msg=Article Successfully Updated...");
		 
	    }
	  
        if(isset($_REQUEST["del"]) && $_REQUEST["del"]=="ok")
		{
		   
		  $check_menu=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(mid) FROM mainmenu WHERE RIGHT(articlelink,10)='".$_REQUEST["ContentID"]."'"));
		  $check_sub_menu=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(sid) FROM submenu WHERE RIGHT(articlelink,10)='".$_REQUEST["ContentID"]."'"));
		  $check_subsub_menu=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(ssid) FROM subsubmenu
		   WHERE RIGHT(articlelink,10)='".$_REQUEST["ContentID"]."'"));
		  $check_inner_menu=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(InnerID) FROM  inner_menu
		   WHERE RIGHT(articlelink,10)='".$_REQUEST["ContentID"]."'"));
		 $check_list_article=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(ListID) FROM menu_list_article WHERE ContentID='".$_REQUEST["ContentID"]."'"));
		  
		  if($check_menu[0]==0 && $check_sub_menu[0]==0 && $check_subsub_menu[0]==0 && $check_inner_menu[0]==0 && $check_list_article[0]==0)
		  {
		    $delete=mysqli_query($con, "DELETE FROM content_info WHERE ContentID='".$_REQUEST["ContentID"]."'");
		    header("Location:article_list.php?msg=Successfully Deleted Article.");  
		  } 
		  else
		  {
		    print "<script>alert('Sorry! This article is allready exist in Menu')</script>";
			print "<script>location.href='article_list.php'</script>"; 
		  }
		  
		}
		
		$recpos=isset($_REQUEST["recpos"])? $_REQUEST["recpos"]:"1";
					$count=($recpos-1)*25;
					$sl=$count;
		$_REQUEST["txtsearch"]=isset($_REQUEST["txtsearch"])?$_REQUEST["txtsearch"]:"";
		if(isset($_POST["btnGo"]) || $_REQUEST["txtsearch"]!="")
		{
		   //print "aaaaaaa";
		   $_REQUEST["MenuName"]="";
		   $menu_name="txtsearch=".$_REQUEST["txtsearch"];
		   $count_msg=" found as '".$_REQUEST["txtsearch"]."'";
		   $rs=mysqli_query($con, "SELECT
										content_info.ContentID
										, content_info.Title
										, content_info.SubTitle
										, content_info.Description
										, content_info.ContentType
										, content_info.ActiveStatus
										, content_info.PublishDate
									FROM
									   content_info
									WHERE content_info.Title LIKE '%".$_REQUEST["txtsearch"]."%'");
									
						 $sss=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(ContentID) FROM content_info 
						 WHERE Title LIKE '%".$_REQUEST["txtsearch"]."%'"));
						 $TotalPagesss=$sss[0]/25;
						 $TotalPageRow=intval($TotalPagesss);
						   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
						   {
							$TotalPageRow=$TotalPageRow+1;    
						   }
						   else 
						   {
							   
						   }
		   
		}
		
		
		else if(isset($_REQUEST["MenuName"]) && $_REQUEST["MenuName"]!="")
		{
		    $_REQUEST["txtsearch"]="";
			 $_REQUEST["MenuName"];
		   $menu_name="MenuName=".$_REQUEST["MenuName"];
		   $substr=substr($_REQUEST["MenuName"],0,3);
		   if($substr=="MN-")
		   {
		        $select_link_type=mysqli_fetch_row(mysqli_query($con, "SELECT LinkType,RIGHT(articlelink,10),title FROM mainmenu 
				WHERE mid='".$_REQUEST["MenuName"]."'"));
				$count_msg=" found as '".$select_link_type[2]."'";
					 if($select_link_type[0]=="List")
					 {
					    $rs=mysqli_query($con, "SELECT
										content_info.ContentID
										, content_info.Title
										, content_info.SubTitle
										, content_info.Description
										, content_info.ContentType
										, content_info.ActiveStatus
										, content_info.PublishDate
									FROM
									   menu_list_article
										INNER JOIN content_info 
											ON (menu_list_article.ContentID = content_info.ContentID)
									WHERE menu_list_article.MenuID='".$_REQUEST["MenuName"]."'");
									
						 $sss=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(ContentID) FROM menu_list_article 
						 WHERE MenuID='".$_REQUEST["MenuName"]."'"));
						 $TotalPagesss=$sss[0]/25;
						 $TotalPageRow=intval($TotalPagesss);
						   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
						   {
							$TotalPageRow=$TotalPageRow+1;    
						   }
						   else 
						   {
							   
						   }
					 }
					 else if($select_link_type[0]=="General")
					 {
					      $sss[0]=1;
						 $TotalPagesss=$sss[0]/25;
						 $TotalPageRow=intval($TotalPagesss);
						   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
						   {
							$TotalPageRow=$TotalPageRow+1;    
						   }
						   else 
						   {
							   
						   }

					
				             $rs=mysqli_query($con, "SELECT ContentID,Title,SubTitle,Description,ContentType,ActiveStatus,PublishDate FROM content_info 
								 WHERE ContentID='".$select_link_type[1]."'"); 
					 }
		   }
		   else if($substr=="SMN")
		   {
		         $select_link_type=mysqli_fetch_row(mysqli_query($con, "SELECT LinkType,RIGHT(articlelink,10),title FROM submenu 
				 WHERE sid='".$_REQUEST["MenuName"]."'"));
				 $count_msg=" found as '".$select_link_type[2]."'";
				     if($select_link_type[0]=="List")
					 {
					           $rs=mysqli_query($con, "SELECT
										content_info.ContentID
										, content_info.Title
										, content_info.SubTitle
										, content_info.Description
										, content_info.ContentType
										, content_info.ActiveStatus
										, content_info.PublishDate
									FROM
									   menu_list_article
										INNER JOIN content_info 
											ON (menu_list_article.ContentID = content_info.ContentID)
									WHERE menu_list_article.MenuID='".$_REQUEST["MenuName"]."'");
							
							$sss=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(ContentID) FROM menu_list_article 
							WHERE MenuID='".$_REQUEST["MenuName"]."'"));
						 $TotalPagesss=$sss[0]/25;
						 $TotalPageRow=intval($TotalPagesss);
						   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
						   {
							$TotalPageRow=$TotalPageRow+1;    
						   }
						   else 
						   {
							   
						   }
							
					 }
					 else if($select_link_type[0]=="General")
					 {
					     $sss[0]=1;
						 $TotalPagesss=$sss[0]/25;
						 $TotalPageRow=intval($TotalPagesss);
						   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
						   {
							$TotalPageRow=$TotalPageRow+1;    
						   }
						   else 
						   {
							   
						   }

					
				         $rs=mysqli_query($con, "SELECT ContentID,Title,SubTitle,Description,ContentType,ActiveStatus,PublishDate FROM content_info 
								 WHERE ContentID='".$select_link_type[1]."'");
					 }
		   }
		   else if($substr=="SSM")
		   {
		         $select_link_type=mysqli_fetch_row(mysqli_query($con, "SELECT LinkType,RIGHT(articlelink,10),title FROM subsubmenu
				  WHERE ssid='".$_REQUEST["MenuName"]."'"));
				  $count_msg=" found as '".$select_link_type[2]."'";
				     if($select_link_type[0]=="List")
					 {
					              $rs=mysqli_query($con, "SELECT
										content_info.ContentID
										, content_info.Title
										, content_info.SubTitle
										, content_info.Description
										, content_info.ContentType
										, content_info.ActiveStatus
										, content_info.PublishDate
									FROM
									   menu_list_article
										INNER JOIN content_info 
											ON (menu_list_article.ContentID = content_info.ContentID)
									WHERE menu_list_article.MenuID='".$_REQUEST["MenuName"]."'");
									
									
							$sss=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(ContentID) FROM menu_list_article 
							WHERE MenuID='".$_REQUEST["MenuName"]."'"));
						 $TotalPagesss=$sss[0]/25;
						 $TotalPageRow=intval($TotalPagesss);
						   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
						   {
							$TotalPageRow=$TotalPageRow+1;    
						   }
						   else 
						   {
							   
						   }
					 }
					 else if($select_link_type[0]=="General")
					 {   $sss[0]=1;
						 $TotalPagesss=$sss[0]/25;
						 $TotalPageRow=intval($TotalPagesss);
						   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
						   {
							$TotalPageRow=$TotalPageRow+1;    
						   }
						   else 
						   {
							   
						   }

					
				$rs=mysqli_query($con, "SELECT ContentID,Title,SubTitle,Description,ContentType,ActiveStatus,PublishDate FROM content_info 
								 WHERE ContentID='".$select_link_type[1]."'");
					 }
		   }
		   else if($substr=="one" || $substr=="two" || $substr=="thr" )
		   {
		       $strlen=strlen($_REQUEST["MenuName"])-3;
			    $_REQUEST["MenuName"]=substr($_REQUEST["MenuName"],3,$strlen);
				  if($substr=="one")
				  {
			     $select_link_type=mysqli_fetch_row(mysqli_query($con, "SELECT Title FROM faq_term_pns_cat 
											WHERE CategoryID='".$_REQUEST["MenuName"]."'"));
				  $count_msg=" found as '".$select_link_type[0]."'";
				  }
				  else if($substr=="two")
				  {
			     $select_link_type=mysqli_fetch_row(mysqli_query($con, "SELECT Title FROM faq_term_pns_scat 
											WHERE SubCategoryID='".$_REQUEST["MenuName"]."'"));
				  $count_msg=" found as '".$select_link_type[0]."'";
				  }
				  else if($substr=="thr")
				  {
			     $select_link_type=mysqli_fetch_row(mysqli_query($con, "SELECT Title FROM faq_term_pns_sscat 
											WHERE SSubCategoryID='".$_REQUEST["MenuName"]."'"));
				  $count_msg=" found as '".$select_link_type[0]."'";
				  }
				    
					              $rs=mysqli_query($con, "SELECT
										content_info.ContentID
										, content_info.Title
										, content_info.SubTitle
										, content_info.Description
										, content_info.ContentType
										, content_info.ActiveStatus
										, content_info.PublishDate
									FROM
									   faq_terms_pns_list_details
										INNER JOIN content_info 
											ON (faq_terms_pns_list_details.ContentID = content_info.ContentID)
									WHERE faq_terms_pns_list_details.CatID='".$_REQUEST["MenuName"]."'");
									
									
							$sss=mysqli_fetch_row(mysqli_query($con, "SELECT
										COUNT(content_info.ContentID)
										
									FROM
									   faq_terms_pns_list_details
										INNER JOIN content_info 
											ON (faq_terms_pns_list_details.ContentID = content_info.ContentID)
									WHERE faq_terms_pns_list_details.CatID='".$_REQUEST["MenuName"]."'"));
						 $TotalPagesss=$sss[0]/25;
						 $TotalPageRow=intval($TotalPagesss);
						   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
						   {
							$TotalPageRow=$TotalPageRow+1;    
						   }
						   else 
						   {
							   
						   }
					 
			    $menu_name="MenuName=".$substr.$_REQUEST["MenuName"];		
		   }
		}
		else
		{
		$menu_name="";
		                 $TotalPage=mysqli_query($con, "SELECT COUNT(ContentID) FROM content_info WHERE Title!=''");
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
					
				$rs=mysqli_query($con, "SELECT ContentID,Title,SubTitle,Description,ContentType,ActiveStatus,PublishDate FROM content_info 
								  ORDER BY ContentID DESC LIMIT $count,25");
      
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
	function selectmenutype(searchCode)
      {
	 //alert(''+searchCode);
	    if(searchCode=='Middle Menu')
		{
		   $.post("searchLookup.php",{ func: "MIDDLEARTICLE", src: searchCode},
		   function(data)
		   {
		   $('#allmlist').html(data.SSSSS);
		   },"json")
	    }
		else if(searchCode=='Main Menu')
		{
		   $.post("searchLookup.php",{ func: "MARTICLE", src: searchCode},
		   function(data)
		   {
		   $('#allmlist').html(data.SSSSS);
		   },"json")
	    }
		else if(searchCode=='Top Menu')
		{
		   $.post("searchLookup.php",{ func: "TARTICLE", src: searchCode},
		   function(data)
		   {
		   $('#allmlist').html(data.SSSSS);
		   },"json")
	    }
		else if(searchCode=='Bottom1 Left')
		{
		   $.post("searchLookup.php",{ func: "BARTICLE", src: searchCode},
		   function(data)
		   {
		   $('#allmlist').html(data.SSSSS);
		   },"json")
	    }
		else if(searchCode=='Bottom2 Right')
		{
		   $.post("searchLookup.php",{ func: "FARTICLE", src: searchCode},
		   function(data)
		   {
		   $('#allmlist').html(data.SSSSS);
		   },"json")
	    }	
      }
function ConfirmAcInac(id)
{
   //alert(""+id);
	var result = confirm("Are you sure you want to Change this Record ?");
	if (result==true)
	{
		window.location = "article_list.php?type=article&id="+id;
	}
}
function ConfirmDelete(id)
{
   
	var result = confirm("Are you sure you want to Delete this Article?");
	if (result==true)
	{
		window.location = "article_list.php?del=ok&ContentID="+id;
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
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:"Article List"; ?></h5>
						
						<div class="search" style="width:auto; float:right; color:#FFFFFF; font-size:12px; margin-top:0px;"> 
							<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
							  
							  <span style="float:right;">
								<strong>Search By Title:</strong>
								<input type="text" name="txtsearch" id="txtsearch">
							    <input type="submit" name="btnGo" value="Search" class="btnsdt" style="color:white; height:25px;" />
                                
							<br><br>		
							 <strong>Search Menu Wise:</strong>
							    <select name="MenuType" id="MenuType" onChange="selectmenutype(this.value);" >
									<option value="">Select Menu Type</option>
									
								<option value="Top Menu">Top Menu</option>
								<option value="Main Menu">Main Menu</option>
								<option value="Middle Menu">Middle Menu</option>
								<option value="Bottom1 Left">Bottom1</option>
								<option value="Bottom2 Right">Bottom2</option>
									</select>
							    <span id="allmlist">
									<select name="MenuName" id="MenuName" onchange="document.customer.submit();">
									<option value="">Select Menu</option>
									
									</select>
									</span>
								</span>
														</div>
						
					</div>
					<!-- end box / title -->
					
				  <div class="pagination pagination-left" style="margin-top:0px; background-color:#FFFFFF;" >
    <div class="results" style="margin-top:0px;">
	<span >Total Article: <?php print $sss[0].@$count_msg; ?></span>
	</div>
	</div>			
    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
  <table width="93%" border="0" align="left" cellpadding="0" cellspacing="0">
           <thead>
            <tr >
              <th width="401" align="center" ><strong>SL</strong></th>
              <th width="1078" align="center"  ><strong> Title </strong></th>
              <th width="909" align="center"  ><strong>Sub Title </strong></th>
              <th width="285" align="center"  ><strong>Publish Date </strong></th>
              <th width="651" align="center" ><strong>Action</strong></th>
          </tr>
		  </thead>
		  <tbody>
       		<?php
			

			  while($row=mysqli_fetch_row($rs))
			  {	
			  	++$sl; 
				 if($row[5]=='Active')
				  {$acinac="InActive";}
				  else
				  {$acinac="Active";}

				
			?>
            <tr <?php //print $bgcolor; ?>>
              <td height="61" align="center" valign="middle"><?php print $sl; ?></td>
              <td align="center" valign="middle"  ><?php print $row[1] ?></td>
              <td align="center" valign="middle"  ><?php print $row[2] ?></td>
              <td align="center" valign="middle"  ><?php print substr($row[6],0,10); ?></td>
              <td align="center" valign="middle">
			  <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-03","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
			  <a href="content_edit.php?ContentID=<?php print $row[0]; ?>">Edit</a>
			  <br>
			 <?php } ?>
			 <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-03","delete_option");
			 if($check_access=="yes")
			  {
			 ?>
			  <a  href="#" onclick="ConfirmDelete('<?php print $row[0] ?>');">Delete</a>
			  <br>
			 <?php } ?>
			 <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-03","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
			  <a  href="#" onclick="ConfirmAcInac('<?php print $row[0] ?>');"><?php print $acinac ?></a>
			 <?php } ?>			  </td>
            </tr>
              <?php } ?>
			  </tbody>
          </table>
</form>
			<div class="pagination pagination-left" style="background-color:#FFFFFF;"  >
			
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
		  <li><a href="article_list.php?recpos=1&<?php print $menu_name; ?>">Start</a></li>
		  <li><a href="article_list.php?recpos=<?php print $i-1; ?>&<?php print $menu_name; ?>" ><< prev</a></li>
		  <?php } ?>
		  <?php
		  if($li==7+1 && $i<=$TotalPageRow)
		  {
		  // $pl++;
		?>
        
		  <li><a href="article_list.php?recpos=<?php print $i; ?>&<?php print $menu_name; ?>">next >></a></li>
     <?php }
	    if($li<=7 && $i>0)
	      { 
		  
		  //$pl++;
		  ?>
          
		  <li><a href="article_list.php?recpos=<?php print $i; ?>&<?php print $menu_name; ?>"><?php print $i; ?></a></li>
		<?php }}
		
		?>
        <?php
		 //print $pl;
		if(($i > 7) && ($TotalPageRow >= $nxt+1))
		{
		 ?>
       
		<li><a href="article_list.php?recpos=<?php print $TotalPageRow; ?>&<?php print $menu_name; ?>">End</a></li>
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