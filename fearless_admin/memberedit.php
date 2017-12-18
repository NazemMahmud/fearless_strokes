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
		 
		 $Date=MakeDate();
		 $MemberID=$_POST["MemberID"];
		  if($_POST["Category"]!="" &&  $_POST["Plan"]!="")
		  {
		 $rs=mysqli_query($con, "UPDATE member_info SET 
		 MemberFirstName='".$_POST["MemberFirstName"]."',
		 MemberLastName='".$_POST["MemberLastName"]."',
		 MemberAddress='".$_POST["MemberAddress"]."',
		 MemberOccupation='".$_POST["MemberOccupation"]."',
		 MemberSex='".$_POST["Sex"]."',
		 MemberContact='".$_POST["MemberContact"]."',
         MemberEmail='".$_POST["MemberEmail"]."',
         MemberType='".$_POST["MemberType"]."',
		 JoinDate='".$_POST["JoinDate"]."',
		 ActiveStatus='".$_POST["ActiveStatus"]."',
		 BuyerStatus='".$_POST["BuyerStatus"]."',
		 SellerStatus='".$_POST["SellerStatus"]."'
		  WHERE MemberID='".$_POST["MemberID"]."'
			");
			/////////////////////MEMBER PLAN AND CATEGORY////////////////////////
			$catplan=mysqli_query($con, "SELECT DetailsID,MemberID,CategoryID,PlanID,ActiveStatus 
			FROM member_plan_and_category  WHERE MemberID='".$MemberID."' AND ActiveStatus='Active'
			 AND CategoryID='".$_POST["Category"]."' AND PlanID='".$_POST["Plan"]."' ");
			$catplanRow=mysqli_fetch_row($catplan);
			 if($catplanRow[2]!=$_POST["Category"] || $catplanRow[3]!=$_POST["Plan"])
			 {
			   $update=mysqli_query($con, "UPDATE member_plan_and_category SET CloseDate='".$Date."',ActiveStatus='InActive' WHERE 
                MemberID='".$MemberID."' AND ActiveStatus='Active'");
			   $DetailsID=MakeID($con, "member_plan_and_category","DetailsID","MCAPL-",25);
			   $insert=mysqli_query($con, "INSERT INTO member_plan_and_category(DetailsID,MemberID,CategoryID,PlanID,StartDate,ActiveStatus)
                VALUES('".$DetailsID."','".$MemberID."','".$_POST["Category"]."','".$_POST["Plan"]."','".$Date."','Active')");
			 }
			////////////////////MEMBER PLAN AND CATEGORY///////////////////////
		header("Location:memberlist.php?msg=Member Successfully Updated!");
			die();
		  }
		  else
		  {
		  header("Location:memberedit.php?msg=Please Submit With Member Category And Plan.&ID=$MemberID");
			die();
		  }
			
			
	  }
	
	  $_REQUEST["ID"]=isset($_REQUEST["ID"])? $_REQUEST["ID"]:$_REQUEST["MemberID"];
	 $rs=mysqli_query($con, "SELECT *  FROM member_info WHERE MemberID='".$_REQUEST["ID"]."' ");
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
	      	<script type="text/javascript">
	  function planmember(searchCode)
      {
	 //alert(''+searchCode);
       $.post("LookUp.php",{ func: "MPLAN", src: searchCode},
	   function(data)
	   {
	   $('#plan').html(data.PLAN);
	   },"json")	
      }
	   function categorymember(searchCode)
      {
	 //alert(''+searchCode);
       $.post("LookUp.php",{ func: "MCAT", src: searchCode},
	   function(data)
	   {
	   $('#category').html(data.CAT);
	   $('#plan').html(data.PLAN);
	   },"json")	
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
			<link type="text/css" href="ui-darkness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript">	

$(function() {
			
			$('#JoinDate').datepicker({
				changeMonth: true,
					changeYear: true,
				dateFormat: 'yy-mm-dd'
			});
				$('#EDATE').datepicker({
				changeMonth: true,
					changeYear: true,
				dateFormat: 'yy-mm-dd'
			});
			
		});
		</script>

	</head>
	<body onload="categorymember('<?php print $_REQUEST['ID'] ?>');">
		
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
						<h5><?php print isset($_REQUEST["msg"])?$_REQUEST["msg"]:"Member Edit"; ?></h5>
					</div>
					<!-- end box / title -->
					
					
					<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
						<div class="form">
						<div class="fields">
							<div class="field  field-first">
								<div class="label">
									<label for="input-small">MemberId:</label>
								</div>
								<div class="input">
									<input id="MemberID" name="MemberID" class="small valid" type="text" value="<?php print @$row[0] ?>" readonly>
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Member  First Name:</label>
								</div>
								<div class="input">
									<input id="MemberFirstName" name="MemberFirstName" value="<?php print @$row[1] ?>" class="small valid" type="text">
								</div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-medium">Member  Last Name:</label>
								</div>
								<div class="input">
									<input id="MemberLastName" name="MemberLastName" value="<?php print @$row[2] ?>" class="small valid" type="text">
								</div>
							</div>
					  <div class="field">
								<div class="label">
									<label for="input-large">Member Address:</label>
						  </div>
								<div class="input">
								  <textarea name="MemberAddress" cols="50" id="MemberAddress" ><?php print @$row[3] ?></textarea>
						  </div>
							</div>
							<div class="field">
								<div class="label">
									<label for="input-large">Member Occupation:</label>
							  </div>
								<div class="input">
									<input id="MemberOccupation" name="MemberOccupation" value="<?php print @$row[4] ?>" class="small valid" type="text">
								</div>
					  </div>
							<div class="field">
								<div class="label">
									<label for="input-large">Member Sex:</label>
								</div>
								<div class="input">
									<span class="select">
								  <select id="Sex" name="Sex">
                                  
                                    <?php
                                      if($row[5]=="Male")
									   {
										$male="selected=\"selected\"";
										$female="";   
									   }
									   else
									   {
										 $female="selected=\"selected\"";
										$male="";    
									   }
									?>
								    <option  value="Male" <?php print $male; ?>>Male</option>
								    <option value="Female" <?php print $female; ?>>Female</option>
							    </select>
								</span>
								</div>
							</div>
                            <div class="field">
								<div class="label">
									<label for="input-large">Member Contact:</label>
							  </div>
								<div class="input">
									<input id="MemberContact" name="MemberContact" value="<?php print @$row[6] ?>" class="small valid" type="text">
								</div>
					  </div>
					  <div class="field">
								<div class="label">
									<label for="input-large">Member E-Mail:</label>
							  </div>
								<div class="input">
									<input id="MemberEmail" name="MemberEmail" value="<?php print @$row[7] ?>" class="small valid" type="text">
								</div>
					  </div>
					  <div class="field">
								<div class="label">
									<label for="input-large">Member Join Date:</label>
							  </div>
								<div class="input">
									<input id="JoinDate" name="JoinDate" value="<?php print @substr($row[10],0,10); ?>" class="small valid" type="text">
								</div>
					  </div>
                            <div class="field">
								<div class="label">
									<label for="input-valid">Seletc Member Type:</label>
								</div>
								<div class="select" id="category">
                                
									
                                
									
							  </div>
                                
                          

                                
							</div>
							<div class="field">
								<div class="label">
									<label for="input-valid">Seletc Member Plan:</label>
								</div>
								<div class="select" id="plan">
                             
                                
									
							  </div>
                                
                          

                                
							</div>
							<div class="field">
								<div class="label">
									<label for="select-button">Active Status:</label>
								</div>
								<div class="input"><span class="select">
								  <select id="ActiveStatus" name="ActiveStatus">
                                  
                                    <?php
                                      if($row[11]=="Active")
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
									<label for="select-button">Buyer Status:</label>
								</div>
								<div class="input"><span class="select">
								  <select id="BuyerStatus" name="BuyerStatus">
                                  
                                    <?php
                                      if($row[12]=="Active")
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
									<label for="select-button">Seller Status:</label>
								</div>
								<div class="input"><span class="select">
								  <select id="SellerStatus" name="SellerStatus">
                                  
                                    <?php
                                      if($row[13]=="Active")
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
							 <?php
                                      if($row[14]!="")
									  {
									  ?>
                            <div class="field">
								<div class="label">
									<label for="select-button">Member Image:</label>
								</div>
								<div class="input">
								<img src="memberimage/<?php print $row[14]; ?>" height="100" width="100">
								<span class="select">
								  
								</span></div>
							</div>
                            <?php } ?>
                            
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