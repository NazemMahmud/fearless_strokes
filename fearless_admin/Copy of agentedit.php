<?php
		session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
		include("connection.php");
	
	if(isset($_POST["btnEdit"]))
	  {
		 
		
		 $AgentID=$_POST["UserID"];
		   $uploadfolder="agentphoto/";
		 $file1 = $uploadfolder.$AgentID.".jpg";
			//$bigimg="img".$row['maxid'].$_FILES['uploadimage']['name']; 
			if($AgentID!="" && $_FILES['photo']['name']!="")
			{
			move_uploaded_file($_FILES['photo']['tmp_name'], $file1);
			}
		 $rs=mysqli_query($con, "UPDATE agent_info SET AgentName='".$_REQUEST["UserName"]."',
		 AgentAddress='".$_REQUEST["UserAddress"]."',AgentContact='".$_REQUEST["UserContact"]."',
		 AgentEmail='".$_REQUEST["UserEmail"]."',
		 AgentPassword=PASSWORD('".$_REQUEST["UserPassword"]."'),
		 ActiveStatus='".$_REQUEST["ActiveStatus"]."'
		 WHERE AgentID='".$AgentID."'");
			
			 header("Location:agentlist.php?msg=Successfully Update Agent");	
	  }
	  if(isset($_POST["btnDelete"]))
	  {
		$rs=mysqli_query($con, "DELETE FROM agent_info WHERE AgentID='".$_POST["UserID"]."'");  
		 header("Location:agentlist.php?msg=Successfully Delete Agent");	
	  }
	  
	//$_REQUEST["ID"]=isset($_REQUEST["ID"])? $_REQUEST["ID"]:$_REQUEST["UserID"];
	$rs=mysqli_query($con, "SELECT * FROM  agent_info WHERE  AgentID='".$_REQUEST["ID"]."'");
	$row=mysqli_fetch_row($rs);
			
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
			<div id="left" >
				
					<?php include("navigation.php"); ?>
				
				
      </div>
			<!-- end content / left -->
			<!-- content / right -->
		<div id="right">
				<!-- table -->
				<div class="box">
					<!-- box / title -->
					<div class="title">
						<h5>Update  Agent</h5>
						<div class="search">
							<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customersss" method="post" enctype="multipart/form-data">
							</form>
						</div>
					</div>
					<!-- end box / title -->
					
					
					<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
						<div class="form">
						<div class="fields">
							<div class="field  field-first">
								<div class="label">
									<label for="input-small">Agent Id:</label>
								</div>
								<div class="input">
									<input id="UserID" name="UserID" class="small valid" type="text" value="<?php print @$row[0] ?>" readonly>
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Agent  Name:</label>
								</div>
								<div class="input">
									<input id="UserName" name="UserName" value="<?php print @$row[1] ?>" class="small valid" type="text">
								</div>
							</div>
					  <div class="field">
								<div class="label">
									<label for="input-large">Agent Address:</label>
						  </div>
								<div class="input">
								  <textarea name="UserAddress" cols="50" id="UserAddress" ><?php print @$row[2] ?></textarea>
						  </div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-large">Agent Contact:</label>
							  </div>
								<div class="input">
									<input id="UserContact" name="UserContact" value="<?php print @$row[3] ?>" class="small valid" type="text">
								</div>
					  </div>
							<div class="field">
								<div class="label">
									<label for="input-large">Agent Email:</label>
								</div>
								<div class="input">
						<input id="UserEmail" name="UserEmail" value="<?php print @$row[4] ?>" class="small valid" type="text">
								</div>
							</div>
							<div class="field">
							  <div class="label">
									<label for="select-button">Active Status:</label>
								</div>
								<div class="input"><span class="select">
								  <select id="ActiveStatus" name="ActiveStatus">
                                  
                                  <?php
                                    if($row[6]=="Active")
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
								    <option  value="Active" <?php print $active; ?>>Active</option>
								    <option value="InActive" <?php print $inactive; ?>>InActive</option>
							    </select>
								</span></div>
							</div>
                            
                            <div class="field">
								<div class="label">
									<label for="select-button">Agent Password:</label>
								</div>
								<div class="input">
								  <input id="UserPassword" name="UserPassword" value="<?php print @$row[5] ?>" class="small valid" type="password" />
								</div>
							</div>
                            
                            <div class="field">
								<div class="label">
									<label for="select-button">Agent Image:</label>
								</div>
								<div class="input">
								  <img src="agentphoto/<?php print $row[0].".jpg"; ?>" height="100" width="100">
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="select-button">Update  Image:</label>
								</div>
								<div class="input">
								  <input type="file" name="photo" />
								</div>
							</div>
                               <div class="buttons">
							
							 
							 <div class="highlight">
								 <input type="submit" name="btnEdit" value="     Edit     "  class="btnsdt" style="color:white;"/>
							     
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