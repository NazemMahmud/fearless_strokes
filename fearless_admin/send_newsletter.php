<?php
		session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
		include("connection.php");
	
	if(isset($_POST["btnAdd"]))
	  {
		 
		
		$sdt=mysqli_query($con, "SELECT
    newsletter_info.NewsLetterTitle
    , newslatter_category.CategoryName
    , newsletter_info.NewsLetterDescription
	
FROM
    newsletter_info
    INNER JOIN newslatter_category 
        ON (newsletter_info.NewsLetterCategory = newslatter_category.CategoryID)
WHERE newsletter_info.NewsLetterID='".$_REQUEST["NLID"]."'");
   $sdtRow=mysqli_fetch_row($sdt);
	$sdtRow[2]=str_replace("&acute;","'",$row[2]);	
		//$unsubscribe="\n To Unsubscribe: http://98.142.221.132/~dev2/ahz_cms/unsubscripe.php";
		$message="Title: ".$sdtRow[0]."\n"."Type: ".$sdtRow[1]."\n"."News: ".$sdtRow[2]."\n";
		//$message=$message.$unsubscribe;
		$subject="News Letter From PEPEELIKA";
		
		$mail=$_POST["chkmail"];
			$counter=count($mail);
			for($i=0;$i<$counter;$i++)
				{
					$to=$mail[$i];
					@mail($to , $subject, $message);
				}
		header("Location:newsletter_list.php?msg=Successfully Sent News Letter");	
	  }
	
	$rs=mysqli_query($con, "SELECT
    newsletter_info.NewsLetterID
    , newsletter_info.NewsLetterTitle
    , newslatter_category.CategoryName
    , newsletter_info.NewsLetterDescription
	, newslatter_category.CategoryID
	
FROM
    newsletter_info
    INNER JOIN newslatter_category 
        ON (newsletter_info.NewsLetterCategory = newslatter_category.CategoryID)
WHERE newsletter_info.NewsLetterID='".$_REQUEST["NLID"]."'");
   $row=mysqli_fetch_row($rs);
	$row[3]=str_replace("&acute;","'",$row[3]);		
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
				<div class="box">
					<!-- box / title -->
					<div class="title">
						<h5><?php print isset($_REQUEST['msg'])?$_REQUEST['msg']:"Send NewsLetter To Subscribers "; ?></h5>
						<div class="search">
							
						</div>
					</div>
					<!-- end box / title -->
					
					
					<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
						<div class="form">
						<div class="fields">
							
							<div class="field">
								<div class="label">
									<label for="input-medium">Category  Name:</label>
								</div>
								<div class="input">
									<input id="CategoryName" name="CategoryName"  class="small valid" type="text" value="<?php print $row[2]; ?>" readonly>
									<input id="NLID" name="NLID"  class="small valid" type="hidden" value="<?php print $_REQUEST["NLID"]; ?>">
									<input id="Details" name="Details"  class="small valid" type="hidden" value="<?php print $row[3]; ?>">
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">NewsLetter  Title:</label>
								</div>
								<div class="input">
									<input id="Title" name="Title"  class="small valid" type="text" value="<?php print $row[1]; ?>" readonly>
								</div>
							</div>
					  <div class="field">
								<div class="label">
									<label for="input-large">Description:</label>
						  </div>
								<div class="input">
								  <textarea name="Description" cols="50" rows="5" id="Description" readonly="readonly" ><?php print substr($row[3],0,200)."...."; ?></textarea>
						  </div>
					  </div>
							  <table width="413" border="0" align="left" cellpadding="0" cellspacing="0">
            <tr >
              <td colspan="5" align="center" ><strong>Select E-Mail To Send NewsLetter </strong></td>
              </tr>
            <tr >
              <td width="82" align="center" ><strong>SL</strong></td>
              <td width="170" align="center"  ><strong> E-Mail </strong></td>
              <td width="220" align="center"  ><strong>Active Status </strong></td>
              <td width="147" align="center" ><strong>Category</strong></td>
              <td width="131" align="center" ><strong>Select To Send </strong></td>
            </tr>
       		<?php
			
			$sl=0;
              $rs=mysqli_query($con, "SELECT
     subscriber_info.id
    ,subscriber_info.email
    , subscriber_info.ActiveStatus
    , newslatter_category.CategoryName
FROM
    subscriber_info
    INNER JOIN newslatter_category 
        ON (subscriber_info.category = newslatter_category.CategoryID)
WHERE subscriber_info.category='".$row[4]."'");
			  while($row=mysqli_fetch_row($rs))
			  {		++$sl;
				  
				  
				  
			
			?>
            <tr >
              <td height="30" align="center"><?php print $sl; ?></td>
              <td align="center"  ><?php print $row[1] ?></td>
              <td align="center"><?php print $row[2] ?></td>
              <td align="center"><?php print $row[3] ?></td>
              <td align="center"><input type="checkbox" name="chkmail[]" value="<?php print $row[1] ?>" /></td>
            </tr>
              <?php } ?>
          </table>
		  
							<div class="buttons">
							
							 <div class="highlight">
								 <input type="submit" name="btnAdd" value="   Send    " class="btnsdt" style="color:white;"/>
							     
							 </div>
							
						  </div>
						
						<!-- pagination -->
						
						<!-- end pagination -->
						<!-- table action -->
						
						<!-- end table action -->
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