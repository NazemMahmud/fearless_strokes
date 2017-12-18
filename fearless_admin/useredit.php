<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
	$Date=MakeDate();
	$msg = "Update User";
	if(isset($_POST["btnEdit"]))
	  {
		 
		 
		// $userID=MakeID($con, "user_admin","UserID","USR-",10);
		 $rs=mysqli_query($con, "UPDATE user_admin SET  
			UserName='".$_REQUEST["UserName"]."',
			Address='".$_REQUEST["UserAddress"]."',
			ContactNumber='".$_REQUEST["UserContact"]."',
			Email='".$_REQUEST["UserEmail"]."',
			Password=PASSWORD('".$_REQUEST["UserPassword"]."'),
			UserType='".$_REQUEST["UserType"]."',
			ActiveStatus='".$_REQUEST["ActiveStatus"]."',
			UpdateDate='".$Date."',
			UpdateBy='".$_SESSION['UserID']."'
			WHERE UserID='".$_REQUEST["UserID"]."'");
			
					  
		$msg=isset($rs)? "Successfully Updated...":"Can not Update";
			
	  }
	 if(isset($_POST["btnDelete"]))
	   {
			$rs=mysqli_query($con, "DELETE FROM user_admin WHERE UserID='".$_REQUEST["UserID"]."'");   
			$rs2=mysqli_query($con, "DELETE FROM user_admin_activity WHERE UserID='".$_REQUEST["UserID"]."'"); 
			header("Location:userlist.php?msg=Successfully Delete User");	
	   }
	  $_REQUEST["ID"]=isset($_REQUEST["ID"])? $_REQUEST["ID"]:$_REQUEST["UserID"];
	 $rs=mysqli_query($con, "SELECT * FROM user_admin WHERE UserID='".$_REQUEST["ID"]."' ");
	 $row=mysqli_fetch_row($rs);
			
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
						<h5><?php echo $msg; ?></h5>
					</div>
					<!-- end box / title -->
					
					
					<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
						<div class="form">
						<div class="fields">
							<div class="field  field-first">
								<div class="label">
									<label for="input-small">UserId:</label>
								</div>
								<div class="input">
									<input id="UserID" name="UserID" class="small valid" type="text" value="<?php print @$row[0] ?>" readonly>
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Full  Name:</label>
								</div>
								<div class="input">
									<input id="UserName" name="UserName" value="<?php print @$row[1] ?>" class="small valid" type="text">
								</div>
							</div>
					  <div class="field">
								<div class="label">
									<label for="input-large">User Address:</label>
						  </div>
								<div class="input">
								  <textarea name="UserAddress" cols="50" id="UserAddress" ><?php print @$row[2] ?></textarea>
						  </div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-large">User Contact:</label>
							  </div>
								<div class="input">
									<input id="UserContact" name="UserContact" value="<?php print @$row[3] ?>" class="small valid" type="text">
								</div>
					  </div>
							<div class="field">
								<div class="label">
									<label for="input-large">User Email:</label>
								</div>
								<div class="input">
									<input id="UserEmail" name="UserEmail" value="<?php print @$row[4] ?>" class="small valid" type="text">
								</div>
							</div>
                            
                            <div class="field">
								<div class="label">
									<label for="input-valid">User Type:</label>
								</div>
								<div class="select">
                                <?php
                                      if($row[6]=="User Admin")
									   {
										$useradmin="selected=\"selected\"";
										$siteadmin=""; 
										$superadmin="";  
									   }
									   else if($row[6]=="Site Admin")
									   {
										$useradmin="";
										$siteadmin="selected=\"selected\""; 
										$superadmin="";     
									   }
									    else if($row[6]=="Super Admin")
									   {
										$useradmin="";
										$siteadmin=""; 
										$superadmin="selected=\"selected\"";     
									   }
									?>
                                
									<select id="UserType" name="UserType">
										<option value="User Admin" <?php print $useradmin; ?>>User Admin</option>
										<option value="Site Admin" <?php print $siteadmin; ?>>Site Admin</option>
                                        <option value="Super Admin" <?php print $superadmin; ?>>Super Admin</option>
									</select>
							  </div>
                                
                          

                                
							</div>
							<div class="field">
								<div class="label">
									<label for="select-button">Active Status:</label>
								</div>
								<div class="input"><span class="select">
								  <select id="ActiveStatus" name="ActiveStatus">
                                  
                                    <?php
                                      if($row[7]=="Active")
									   {
										$active="selected=\"selected\"";
										$inactive="";   
									   }
									   else
									   {
										 $inactive="selected=\"selected\"";
										$active="";    
									   }
									?>
								    <option  value="Active" <?php print $active; ?>>Active</option>
								    <option value="InActive" <?php print $inactive; ?>>InActive</option>
							    </select>
								</span></div>
							</div>
                            
                            <div class="field">
								<div class="label">
									<label for="select-button">User Password:</label>
								</div>
								<div class="input">
								  <input id="UserPassword" name="UserPassword" value="<?php print @$row[5] ?>" class="small valid" type="password" />
								</div>
							</div>
                            
                            
                               <div class="buttons">
                                 <div class="highlight">
								 <input type="submit" name="btnEdit" value="     Edit     "  class="btnsdt" style="color:white;"/>
							     
							 </div>
							
							 
						  </div>
						    <div class="buttons">
                                 
							
						  </div>
                            <div class="buttons">
                                 
							
						  </div>
                          <br>
                          <br>
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