<?php
 session_start();
 include("../connection.php");
         $Date=MakeDate();
	    $AgentID=$_REQUEST["ID"];
	  	 $uploadfolder="../agentphoto/";
		  $all_file=mysqli_fetch_row(mysqli_query($con, "SELECT EducationCertificate,TelephonOwnerCopy,NationalIdCopy,PassportCopy,
		  Union_Word_Certificate FROM agent_nondisplay_info WHERE AgentID='".$AgentID."'"));
		 $ecopy=$all_file[0];
		 $TOwnerShip=$all_file[1];
		 $NationalID=$all_file[2];
		 $pcopy=$all_file[3];
		 $uwcopy=$all_file[4];
	  if(isset($_REQUEST["updatetype"]) && $_REQUEST["updatetype"]=="one")
	   {
	     $display_update=mysqli_query($con, "UPDATE agent_info SET AgentName='".$_POST["Name"]."',Mobile='".$_POST["Mobile"]."',
		 SkypeeID='".$_POST["SkypeeID"]."',ViberID='".$_REQUEST["ViberID"]."',UpdateDate='".$Date."',UpdateBy='".$_SESSION["UserID"]."',
		 Designation='".$_POST["Designation"]."'
		  WHERE AgentID='".$AgentID."'");
		 
		$step_one_update=mysqli_query($con, "UPDATE agent_nondisplay_info SET PermanentAddress='".$_REQUEST["Address"]."',
		Division='".$_REQUEST["Division"]."', District='".$_REQUEST["District"]."',Thana='".$_REQUEST["AreaName"]."',
		 Union_Word='".$_REQUEST["UnionName"]."',PostCode='".$_REQUEST["PostCode"]."',
		 Sex='".$_REQUEST["Sex"]."',DateOfBirth='".$_REQUEST["DBIRTH"]."',BloodGroup='".$_REQUEST["BloodGroup"]."',
		 Religion='".$_REQUEST["Religion"]."',
         LandPhone='".$_REQUEST["LandPhone"]."',SmartPhoneInfo='".$_REQUEST["SmartPhoneInfo"]."',Tel_Fax='".$_REQUEST["TelFax"]."',
		 PersonalEmail='".$_REQUEST["PersonalEmail"]."',Village='".$_REQUEST["VillageName"]."' WHERE AgentID='".$AgentID."'");
	   }
	   if(isset($_REQUEST["updatetype"]) && $_REQUEST["updatetype"]=="two")
	   {
		    			
			if($_FILES['ecopy']['name']!="")
			{
			  @unlink($uploadfolder.$ecopy);
		     $file1 = $uploadfolder.$AgentID.$_FILES['ecopy']['name'];
			 $ecopy=$AgentID.$_FILES['ecopy']['name'];
			 move_uploaded_file($_FILES['ecopy']['tmp_name'], $file1);
			}
			if($_FILES['TOwnerShip']['name']!="")
			{
			  @unlink($uploadfolder.$TOwnerShip);
		     $file1 = $uploadfolder.$AgentID.$_FILES['TOwnerShip']['name'];
			 $TOwnerShip=$AgentID.$_FILES['TOwnerShip']['name'];
			 move_uploaded_file($_FILES['TOwnerShip']['tmp_name'], $file1);
			}
			if($_FILES['NationalID']['name']!="")
			{
			  @unlink($uploadfolder.$NationalID);
		     $file1 = $uploadfolder.$AgentID.$_FILES['NationalID']['name'];
			 $NationalID=$AgentID.$_FILES['NationalID']['name'];
			 move_uploaded_file($_FILES['NationalID']['tmp_name'], $file1);
			}
			if($_FILES['pcopy']['name']!="")
			{
			 @unlink($uploadfolder.$pcopy);
		     $file1 = $uploadfolder.$AgentID.$_FILES['pcopy']['name'];
			 $pcopy=$AgentID.$_FILES['pcopy']['name'];
			 move_uploaded_file($_FILES['pcopy']['tmp_name'], $file1);
			}
			if($_FILES['uwcopy']['name']!="")
			{
			 @unlink($uploadfolder.$uwcopy);
		     $file1 = $uploadfolder.$AgentID.$_FILES['uwcopy']['name'];
			 $uwcopy=$AgentID.$_FILES['uwcopy']['name'];
			 move_uploaded_file($_FILES['uwcopy']['tmp_name'], $file1);
			}
	             
				  if($_POST["MaritalStatus"]=="Married")
				  {
				   $spousename=$_POST["SpouseName"];
				   $childreninfo=$_POST["ChildrensInfo"];
				   $anyverserydate=$_REQUEST["DANYVERSERY"];
				  }
				  else
				  {
				    $spousename="";
					$childreninfo="";
					$anyverserydate="";
				  }
		$step_two_update=mysqli_query($con, "UPDATE agent_nondisplay_info SET  
		LastEducation='".$_REQUEST["LastEducation"]."',EducationCertificate='".$ecopy."',TelephonOwnerCopy='".$TOwnerShip."',
		NationalIdCopy='".$NationalID."',PassportCopy='".$pcopy."',Union_Word_Certificate='".$uwcopy."',
		MaritalStatus='".$_REQUEST["MaritalStatus"]."',SpouseName='".$spousename."',AnyverseryDate='".$anyverserydate."',
		ChildrenInfo='".$childreninfo."',Bank_Acc_No='".$_REQUEST["BankAccountNo"]."',BankName='".$_REQUEST["BankName"]."',
		BankBranchName='".$_REQUEST["BankBranch"]."',TIN_No='".$_REQUEST["TinNo"]."',Proffessional_Degree='".$_REQUEST["ProffessionalDegree"]."',
		Present_Occupation='".$_REQUEST["PresentOccupation"]."',Service_Experience='".$_REQUEST["ServiceDetails"]."',
		Extra_Skill='".$_REQUEST["ExtraSkills"]."',Social_Member='".$_REQUEST["SocialMember"]."' WHERE AgentID='".$AgentID."'");
		
		$display_update=mysqli_query($con, "UPDATE agent_info SET UpdateDate='".$Date."',UpdateBy='".$_SESSION["UserID"]."'
		  WHERE AgentID='".$AgentID."'");
		
	   }
	   if(isset($_REQUEST["updatetype"]) && $_REQUEST["updatetype"]=="three")
	   {

		 $egcontact_check=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(UserID) FROM agent_emergency_refer 
		                                      WHERE UserID='".$AgentID."' AND Type='EGCONT'"));
	     $refcontact_check=mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(UserID) FROM agent_emergency_refer 
		                                      WHERE UserID='".$AgentID."' AND Type='REFFER'"));
					if($_REQUEST["emergencytype"]=="OthersPErson")
					{
					  if($egcontact_check[0]>0)
					  {
					    $update=mysqli_query($con, "UPDATE agent_emergency_refer SET PersonName='".$_REQUEST["cpname"]."',
						Address='".$_REQUEST["cpaddress"]."',Mobile='".$_REQUEST["cpcontact"]."',
						Email='".$_REQUEST["cpmail"]."',Relationship='".$_REQUEST["cprelation"]."'
						 WHERE UserID='".$AgentID."' AND Type='EGCONT'");
					  }
					  else
					  {
					    $insert=mysqli_query($con, "INSERT INTO agent_emergency_refer (UserID,PersonName,Address,Mobile,Email,Relationship,Type) 
					  VALUES('".$AgentID."','".$_REQUEST["cpname"]."','".$_REQUEST["cpaddress"]."',
					  '".$_REQUEST["cpcontact"]."','".$_REQUEST["cpmail"]."','".$_REQUEST["cprelation"]."','EGCONT')");
					  }
					  $update=mysqli_query($con, "UPDATE agent_nondisplay_info SET EmergencyID='' WHERE AgentID='".$AgentID."'");
					}
					else if($_REQUEST["emergencytype"]=="PepeelikaUser")
					{
					    @$delete=mysqli_query($con, "DELETE FROM agent_emergency_refer WHERE UserID='".$AgentID."' AND Type='EGCONT'");
					    $update=mysqli_query($con, "UPDATE agent_nondisplay_info SET EmergencyID='".$_REQUEST["CPUserID"]."' WHERE AgentID='".$AgentID."'");
					}
					
					
					if($_REQUEST["reftype"]=="OthersPErson")
					{
					  if($refcontact_check[0]>0)
					  {
					    $update=mysqli_query($con, "UPDATE agent_emergency_refer SET PersonName='".$_REQUEST["refname"]."',
						Address='".$_REQUEST["refaddress"]."',Mobile='".$_REQUEST["refcontact"]."',
						Email='".$_REQUEST["refmail"]."',Relationship='".$_REQUEST["refrelation"]."'
						 WHERE UserID='".$AgentID."' AND Type='REFFER'");
					  }
					  else
					  {
					    $insert=mysqli_query($con, "INSERT INTO agent_emergency_refer (UserID,PersonName,Address,Mobile,Email,Relationship,Type) 
					  VALUES('".$AgentID."','".$_REQUEST["refname"]."','".$_REQUEST["refaddress"]."',
					  '".$_REQUEST["refcontact"]."','".$_REQUEST["refmail"]."','".$_REQUEST["refrelation"]."','REFFER')");
					  }
					  $update=mysqli_query($con, "UPDATE agent_nondisplay_info SET ReferID='' WHERE AgentID='".$AgentID."'");
					}
					else if($_REQUEST["reftype"]=="PepeelikaUser")
					{
					    @$delete=mysqli_query($con, "DELETE FROM agent_emergency_refer WHERE UserID='".$AgentID."' AND Type='REFFER'");
					    $update=mysqli_query($con, "UPDATE agent_nondisplay_info SET ReferID='".$_REQUEST["RPUserID"]."' WHERE AgentID='".$AgentID."'");
					}
					$display_update=mysqli_query($con, "UPDATE agent_info SET UpdateDate='".$Date."',UpdateBy='".$_SESSION["UserID"]."'
		  WHERE AgentID='".$AgentID."'");
		
	   }
	   if(isset($_REQUEST["updatetype"]) && $_REQUEST["updatetype"]=="four")
	   {
         $update=mysqli_query($con, "UPDATE agent_info SET ValidityDate='".$_REQUEST["VDATE"]."',Email='".$_REQUEST["pepeelikamail"]."',
		 Password=PASSWORD('".$_REQUEST["pepeelikapassword"]."'),ActiveStatus='".$_REQUEST["ActiveStatus"]."' WHERE AgentID='".$AgentID."'");
		 
		 $display_update=mysqli_query($con, "UPDATE agent_info SET UpdateDate='".$Date."',UpdateBy='".$_SESSION["UserID"]."'
		  WHERE AgentID='".$AgentID."'");
	   }
	  
 $display=mysqli_fetch_row(mysqli_query($con, "SELECT * FROM agent_info WHERE AgentID='".$_REQUEST["ID"]."'"));
 $non_display=mysqli_fetch_row(mysqli_query($con, "SELECT * FROM agent_nondisplay_info WHERE AgentID='".$_REQUEST["ID"]."'"));
 $cont=mysqli_fetch_row(mysqli_query($con, "SELECT * FROM agent_emergency_refer WHERE UserID='".$_REQUEST["ID"]."' AND Type='EGCONT'"));
 $ref=mysqli_fetch_row(mysqli_query($con, "SELECT * FROM agent_emergency_refer WHERE UserID='".$_REQUEST["ID"]."' AND Type='REFFER'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PEPEELIKA</title>
	<link rel="stylesheet" href="themes/base/jquery.ui.all.css">
	<script src="jquery-1.6.2.js"></script>
	<script src="ui/jquery.ui.core.js"></script>
	<script src="ui/jquery.ui.widget.js"></script>

	<script src="ui/jquery.ui.sortable.js"></script>
	<script src="ui/jquery.ui.tabs.js"></script>


		<script type="text/javascript" src="../js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript">	

$(function() {
			
			$('#DBIRTH').datepicker({
				changeMonth: true,
					changeYear: true,
				dateFormat: 'yy-mm-dd'
			});
			$('#DANYVERSERY').datepicker({
				changeMonth: true,
					changeYear: true,
				dateFormat: 'yy-mm-dd'
			});	
			$('#VDATE').datepicker({
				changeMonth: true,
					changeYear: true,
				dateFormat: 'yy-mm-dd'
			});	
			
		});
		</script>
	<script>
	$(function() {
		$( "#tabs" ).tabs().find( ".ui-tabs-nav" ).sortable({ axis: "x" });

	});
	</script>
	 <script type="text/javascript">
	function checkContact(searchCode)
      {
       $.post("../../LookUp.php",{ func: "CONTACT", src: searchCode},
	   function(data)
	   {
	   $('#ccc').html(data.MEMCONTACT);
	   $('#contact').val(data.MEMCONTACTPARAM);
	   },"json")	
      }
    function selectarea(searchCode)
      {
	 //alert(''+searchCode);
       $.post("../../LookUp.php",{ func: "AREAFIND", src: searchCode},
	   function(data)
	   {
	   $('#thana').html(data.SSSSS);
	   },"json")	
      }
	  function selectunion(searchCode)
      {
	 //alert(''+searchCode);
       $.post("../../LookUp.php",{ func: "UNION", src: searchCode},
	   function(data)
	   {
	   $('#union').html(data.SSSSS);
	   },"json")	
      }
	  function selectvillage(searchCode)
      {
	 //alert(''+searchCode);
       $.post("../../LookUp.php",{ func: "VILLAGE", src: searchCode},
	   function(data)
	   {
	   $('#village').html(data.SSSSS);
	   },"json")	
      }
	  function selectdistrict(searchCode)
      {
	 //alert(''+searchCode);
       $.post("../../LookUp.php",{ func: "DISTRICT", src: searchCode},
	   function(data)
	   {
	   $('#district').html(data.SSSSS);
	   },"json")	
      }
</script>
<script type="text/javascript">
  function emargencypepeelika()
  {
    
	  $('#cpuid').show();
	  $('#cpnam').hide();
	  $('#cpaddr').hide();
	  $('#cpem').hide();
	  $('#cpcont').hide();
	  $('#cprel').hide();
	  
	  document.getElementById("emergencytype").value="PepeelikaUser";
	  //alert(document.getElementById("emergencytype").value);
	 
  }
  function refpepeelika()
  {
      $('#rpuid').show();
	  $('#rpnam').hide();
	  $('#rpaddr').hide();
	  $('#rpem').hide();
	  $('#rpcont').hide();
	  $('#rprel').hide();
	  
	  document.getElementById("reftype").value="PepeelikaUser";
  }
  function emargencyperson()
  {
    
	   $('#cpuid').hide();
	  $('#cpnam').show();
	  $('#cpaddr').show();
	  $('#cpem').show();
	  $('#cpcont').show();
	  $('#cprel').show();
	 
	   document.getElementById("emergencytype").value="OthersPerson";
	   //alert(document.getElementById("emergencytype").value);
  }
  function refperson()
  {
    
	  $('#rpuid').hide();
	  $('#rpnam').show();
	  $('#rpaddr').show();
	  $('#rpem').show();
	  $('#rpcont').show();
	  $('#rprel').show();
	 
	   document.getElementById("reftype").value="OthersPerson";
	   //alert(document.getElementById("emergencytype").value);
 }
 function maritalCheck()
 {
 
   if(document.getElementById("MaritalStatus").value=="Married")
   {
     $('#spousename').show(); 
	 $('#anyverserydate').show();
	 $('#childreninfo').show();
   }
   else
   {
     $('#spousename').hide(); 
	 $('#anyverserydate').hide();
	 $('#childreninfo').hide(); 
   }
 }
 function stepone()
 {
  
  document.getElementById("updatetype").value="one";
  document.agent_edit.submit();
 }
 function steptwo()
 {
  
  document.getElementById("updatetype").value="two";
  document.agent_edit.submit();
 }
 function stepthree()
 {
  
  document.getElementById("updatetype").value="three";
  document.agent_edit.submit();
 }
 function stepfour()
 {
  
  document.getElementById("updatetype").value="four";
  document.agent_edit.submit();
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
<body style="width:550px;">

<div class="demo">

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Step-1</a></li>
		<li><a href="#tabs-2">Step-2</a></li>
		<li><a href="#tabs-3">Step-3</a></li>
		<li><a href="#tabs-4">Step-4</a></li>
	</ul>
	<div id="tabs-1" style="background:#CCCCCC; font-size:12px;">
	<form name="agent_edit" method="post" action="<?php print $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
	 <table cellpadding="5" cellspacing="5" class="category">
                        	<tr>
                            	<th colspan="3" align="center">Personal Details
								<input id="ID" name="ID"   size="33" type="hidden" value="<?php print $_REQUEST["ID"]; ?>">	
								<input id="updatetype" name="updatetype"   size="33" type="hidden" value="">									</th>
							</tr>
                            <tr>
                              <td align="left" >Designation<span style="color:#FF0000;">*</span></td>
                              <td align="left" >
							  <select name="Designation" id="Designation" >
									
									<?php
							        $Designation=mysqli_query($con, "SELECT CategoryID,Title FROM faq_term_pns_cat WHERE 
									type='Customer Manager Designation' AND ActiveStatus='Active' ORDER BY orderid");
									while($DesignationRow=mysqli_fetch_row($Designation))
									{
									   if($display[13]==$DesignationRow[0])
									   {
									 ?>
								<option value="<?php print $DesignationRow[0]; ?>" selected="selected"><?php print $DesignationRow[1]; ?></option>
									<?php }
									else
									   { ?>
									<option value="<?php print $DesignationRow[0]; ?>"><?php print $DesignationRow[1]; ?></option>
									<?php }} ?>
								  </select>
							  </td>
                              <td width="33" rowspan="3" align="center" >
                                
                                <img src="../agentphoto/<?php print $display[0]; ?>.jpg" style="width:100px; height:90px;">
                                <br>
                                Manager Photo                                </td>
                            </tr>
                            <tr>
					             <td width="386" align="left" >Name<span style="color:#FF0000;">*</span></td>
					             <td width="150" align="left" >
								 <input id="Name" name="Name"  size="25" type="text" value="<?php print $display[1]; ?>"> </td>
			                </tr>
                            <tr>
                            
					             <td align="left" valign="top">Permanent Address<span style="color:#FF0000;">*</span></td>
					             <td align="left"><textarea name="Address" cols="20" id="Address" ><?php print $non_display[1]; ?></textarea></td>
			                </tr>
			                 <tr>
                            
					             <td align="left" colspan="3"><strong>Present Address</strong></td>
					        </tr>
                            <tr>
                            
					             <td align="left">Division<span style="color:#FF0000;">*</span></td>
					             <td colspan="2" align="left"><select name="Division" id="Division" onChange="selectdistrict(this.value);" >
									<option value="">Select Division</option>
									<?php
							        $Division=mysqli_query($con, "SELECT DivisionID,DivisionName FROM division_info WHERE ActiveStatus='Active'");
									while($DivisionRow=mysqli_fetch_row($Division))
									{
									  if($non_display[2]==$DivisionRow[0])
									  {
									 ?>
									<option value="<?php print $DivisionRow[0]; ?>" selected="selected"><?php print $DivisionRow[1]; ?></option>
									<?php } 
									else
									{?>
									<option value="<?php print $DivisionRow[0]; ?>"><?php print $DivisionRow[1]; ?></option>
									<?php }} ?>
								  </select></td>
					        </tr>
							<tr>
                            
					             <td align="left">District<span style="color:#FF0000;">*</span></td>
					             <td colspan="2" align="left" id="district">
								 <select name="District" id="District" onChange="selectarea(this.value);" >
									<option value="">Select District</option>
									<?php
							        $District=mysqli_query($con, "SELECT DistrictID,DistrictName FROM district_info WHERE DivisionID='".$non_display[2]."'");
									while($DistrictRow=mysqli_fetch_row($District))
									{
									if($non_display[3]==$DistrictRow[0])
									  {
									 ?>
									<option value="<?php print $DistrictRow[0]; ?>" selected="selected"><?php print $DistrictRow[1]; ?></option>
									<?php } 
									else
									{?>
									<option value="<?php print $DistrictRow[0]; ?>"><?php print $DistrictRow[1]; ?></option>
									<?php }} ?>
								  </select>								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Upazila/PS<span style="color:#FF0000;">*</span></td>
					             <td colspan="2" align="left" id="thana">
								  <select name="AreaName" id="AreaName" onChange="selectunion(this.value);" >
									<option value="">Select Upazila/PS</option>
									<?php
							        $Thana=mysqli_query($con, "SELECT ThanaID,ThanaName FROM thana_info WHERE DistrictID='".$non_display[3]."'");
									while($ThanaRow=mysqli_fetch_row($Thana))
									{
									if($non_display[4]==$ThanaRow[0])
									  {
									 ?>
									<option value="<?php print $ThanaRow[0]; ?>" selected="selected"><?php print $ThanaRow[1]; ?></option>
									<?php } 
									else
									{?>
									<option value="<?php print $ThanaRow[0]; ?>"><?php print $ThanaRow[1]; ?></option>
									<?php }} ?>
								  </select>								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Union/Sector<span style="color:#FF0000;">*</span></td>
					             <td colspan="2" align="left" id="union" >
								 <select name="UnionName" id="UnionName" onChange="selectvillage(this.value);" >
									<option value="">Select Union/Sector Name</option>
									<?php
							        $Union=mysqli_query($con, "SELECT UnionID,Name FROM union_info WHERE ThanaID='".$non_display[4]."'");
									while($UnionRow=mysqli_fetch_row($Union))
									{
									if($non_display[5]==$UnionRow[0])
									  {
									 ?>
									<option value="<?php print $UnionRow[0]; ?>" selected="selected"><?php print $UnionRow[1]; ?></option>
									<?php } 
									else
									{?>
									<option value="<?php print $UnionRow[0]; ?>"><?php print $UnionRow[1]; ?></option>
									<?php }} ?>
								  </select>								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Area/Village<span style="color:#FF0000;">*</span></td>
					             <td colspan="2" align="left" id="village" >
								 <select name="VillageName" id="VillageName"  >
									<option value="">Select Village/Area Name</option>
									<?php
							        $Village=mysqli_query($con, "SELECT VillageID,Name FROM village_info WHERE UnionID='".$non_display[5]."'");
									while($VillageRow=mysqli_fetch_row($Village))
									{
									if($non_display[36]==$VillageRow[0])
									  {
									 ?>
									<option value="<?php print $VillageRow[0]; ?>" selected="selected"><?php print $VillageRow[1]; ?></option>
									<?php } 
									else
									{?>
									<option value="<?php print $VillageRow[0]; ?>"><?php print $VillageRow[1]; ?></option>
									<?php }} ?>
								  </select>								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Post Code<span style="color:#FF0000;">*</span></td>
					             <td colspan="2" align="left" ><input id="PostCode" name="PostCode" size="33" type="text" value="<?php print $non_display[6] ?>"></td>
					        </tr>
							<tr>
                            
					             <td align="left">Sex<span style="color:#FF0000;">*</span></td>
					             <td colspan="2" align="left" >
								 <select name="Sex" id="Sex">
								 <?php 
								 if($non_display[7]=="Male")
								 {
								   $male="selected=\"selected\"";
								   $female="";
								 }
								 else
								 {
								   $male="";
								   $female="selected=\"selected\"";
								 }
								  ?>
								 
								 <option value="Male" <?php print $male; ?>>Male</option>
								 <option value="Female" <?php print $female; ?>>Female</option>
								 </select>								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Date of Birth<span style="color:#FF0000;">*</span></td>
					             <td colspan="2" align="left" >
                                 <input id="DBIRTH" name="DBIRTH"  size="33" type="text" value="<?php print substr($non_display[8],0,10); ?>">                                 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Blood Group<span style="color:#FF0000;">*</span></td>
					             <td colspan="2" align="left" >
								 <input id="BloodGroup" name="BloodGroup"  size="33" type="text" value="<?php print $non_display[9]; ?>">								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Religion/Cast/Complexity<span style="color:#FF0000;">*</span></td>
					             <td colspan="2" align="left" >
								 <input id="Religion" name="Religion"  size="33" type="text" value="<?php print $non_display[10]; ?>">								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Mobile<span style="color:#FF0000;">*</span></td>
					             <td colspan="2" align="left" ><input id="Mobile" name="Mobile" size="33" type="text" value="<?php print $display[4]; ?>"></td>
					        </tr>
							<tr>
                            
					             <td align="left">Land Phone<span style="color:#FF0000;"></span></td>
					             <td colspan="2" align="left" >
								 <input id="LandPhone" name="LandPhone"  size="33" type="text" value="<?php print $non_display[11]; ?>">								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Smart Phone/Tablet Set Info</td>
					             <td colspan="2" align="left" >
								 <textarea name="SmartPhoneInfo" cols="30" id="SmartPhoneInfo"><?php print $non_display[12]; ?></textarea>								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Tel/Fax</td>
					             <td colspan="2" align="left" >
								 <input id="TelFax" name="TelFax"  size="33" type="text" value="<?php print $non_display[13]; ?>">								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Personal Email<span style="color:#FF0000;">*</span></td>
					             <td colspan="2" align="left" > 
								 <input id="PersonalEmail" name="PersonalEmail" size="33" type="text" value="<?php print $non_display[14]; ?>" />								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Skype ID</td>
					          <td colspan="2" align="left" ><input id="SkypeeID" name="SkypeeID"  size="33" type="text" value="<?php print $display[6]; ?>"></td>
					        </tr>
                            <tr>
                            
					             <td align="left">Viber ID</td>
					          <td colspan="2" align="left" >
							  <input id="ViberID" name="ViberID"  size="33" type="text" value="<?php print $display[7]; ?>">							  </td>
					        </tr>
							<tr>
                            
					             <td align="left">Upload Your Photo</td>
					             <td colspan="2" align="left" > <input type="file" name="photo" size="20" />								 	</td>
					        </tr>
							<tr>

					             <td align="center" colspan="2" align="center" > 
								
					<input type="button" name="button1" onClick="stepone();" value="Update Step-1" class="btnsdt" style="color:white;">
								
								 <td colspan="2"></td>
					        </tr>
                        </table>

	</div>
	<div id="tabs-2" style="background:#CCCCCC; font-size:12px;">
<table cellpadding="5" cellspacing="5" class="category">
                        	<tr>
                            	<th colspan="2" align="left">Education & Certificates</th>

                            </tr>

							<tr>
                            
					             <td align="left">Last Education<span style="color:#FF0000;">*</span></td>
					             <td align="left" >
								 <input id="LastEducation" name="LastEducation"  size="33" type="text" value="<?php print $non_display[15]; ?>">
								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Change Education Certification Copy<span style="color:#FF0000;">*</span></td>
					             <td align="left" >
								 <input name="ecopy" type="file" id="ecopy" />&nbsp;
								 <?php if($non_display[16]!="")
								       {
								  ?>
								  <a href="../agentphoto/<?php print $non_display[16]; ?>" target="_blank">Download this</a>
								  <?php } ?>
								  
								 </td>
					        </tr>
						    <tr>
					             <td align="left">Change Telephone Ownership Copy.</td>
					             <td align="left">
								 <input name="TOwnerShip" type="file" id="TOwnerShip" />&nbsp;
								 <?php if($non_display[17]!="")
								       {
								  ?>
								  <a href="../agentphoto/<?php print $non_display[17]; ?>" target="_blank">Download this</a>
								  <?php } ?>
								 </td>
					        </tr>
                            <tr>
                            
					             <td align="left">Change National ID copy<span style="color:#FF0000;">*</span></td>
					             <td align="left">
								 <input name="NationalID" type="file" id="NationalID" />&nbsp;
								 <?php if($non_display[18]!="")
								       {
								  ?>
								  <a href="../agentphoto/<?php print $non_display[18]; ?>" target="_blank">Download</a>
								  <?php } ?>
								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Passport Copy(if any)</td>
					             <td align="left" >
								 <input name="pcopy" type="file" id="pcopy" />&nbsp;
								 <?php if($non_display[19]!="")
								       {
								  ?>
								  <a href="../agentphoto/<?php print $non_display[19]; ?>" target="_blank">Download</a>
								  <?php } ?>
								 
								 </td>
					        </tr>

							<tr>
                            
					             <td align="left">Union/Word Comissionar Certificate</td>
					             <td align="left" >
								 <input name="uwcopy" type="file" id="uwcopy"  />&nbsp;
								 <?php if($non_display[20]!="")
								       {
								  ?>
								  <a href="../agentphoto/<?php print $non_display[20]; ?>" target="_blank">Download</a>
								  <?php } ?>
								 </td>
					        </tr>
							<tr>
                            	<th colspan="2" align="left">Marital Info</th>

                            </tr>
                            <tr>
                            
					             <td align="left">Marital Status<span style="color:#FF0000;">*</span></td>
					             <td align="left" ><select id="MaritalStatus" name="MaritalStatus" onChange="maritalCheck();">
								 <?php 
								 if($non_display[21]=="Married")
								 {
								   $married="selected=\"selected\"";
								   $unmarried="";
								 }
								 else
								 {
								   $married="";
								   $unmarried="selected=\"selected\"";
								 }
								 ?>
								    <option value="UnMarried" <?php print $unmarried; ?>>UnMarried</option>
								    <option  value="Married" <?php print $married; ?>>Married</option>
								    
							    </select></td>
					        </tr>
							<?php
							 if($non_display[21]=="Married")
							 {
							?>
							<tr id="spousename" > 
							<?php }
							else
							{ ?>
                            <tr id="spousename" style="display:none;"> 
							<?php } ?>
					             <td align="left">Spouse Name(if any)</td>
					             <td align="left" >
								 <input id="SpouseName" name="SpouseName"  size="33" type="text" value="<?php print $non_display[22]; ?>">
								 </td>
					        </tr>
							<?php
							 if($non_display[21]=="Married")
							 {
							?>
							<tr id="anyverserydate" > 
							<?php }
							else
							{ ?>
                            <tr id="anyverserydate" style="display:none;"> 
							<?php } ?>
							
                            
					             <td align="left">Wedding Aniversery Date</td>
					             <td align="left" >
				 <input id="DANYVERSERY" name="DANYVERSERY"  size="33" type="text" value="<?php print substr($non_display[23],0,10); ?>">
								 </td>
					        </tr>
							<?php
							 if($non_display[21]=="Married")
							 {
							?>
							<tr id="childreninfo" > 
							<?php }
							else
							{ ?>
                            <tr id="childreninfo" style="display:none;"> 
							<?php } ?>
							
                            
					             <td align="left">Children's Info</td>
					             <td align="left" >
								 <textarea name="ChildrensInfo" cols="30" id="ChildrensInfo"><?php print $non_display[24]; ?></textarea>
								 </td>
					        </tr>
							<tr>
                            	<th colspan="2" align="left">Banking Info</th>

                            </tr>
                            <tr>
                            
					             <td align="left">Bank Account No.<span style="color:#FF0000;">*</span></td>
					             <td align="left"> 
								 <input id="BankAccountNo" name="BankAccountNo" size="33" type="text" value="<?php print $non_display[25]; ?>" />
								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Bank Name.<span style="color:#FF0000;">*</span></td>
					             <td align="left"> 
								 <input id="BankName" name="BankName" size="33" type="text" value="<?php print $non_display[26]; ?>" />
								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Branch of Bank<span style="color:#FF0000;">*</span></td>
					             <td align="left"> 
								 <input id="BankBranch" name="BankBranch" size="33" type="text" value="<?php print $non_display[27]; ?>" />
								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">TIN No.</td>
					             <td align="left" >
								 <input id="TinNo" name="TinNo" size="33" type="text" value="<?php print $non_display[28]; ?>" />
								 </td>
					        </tr>
                            <tr>
                            	<th colspan="2" align="left">Proffessional Info</th>

                            </tr>
							<tr>
                            
					             <td align="left">Proffessional Degree</td>
					             <td align="left" >
						<input id="ProffessionalDegree" name="ProffessionalDegree"  size="33" type="text" value="<?php print $non_display[29]; ?>">
								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Present Occupation</td>
					             <td align="left" >
							<input id="PresentOccupation" name="PresentOccupation"  size="33" type="text" value="<?php print $non_display[30]; ?>">
								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Service/Experience Details</td>
					             <td align="left" >
								 <textarea name="ServiceDetails" id="ServiceDetails" cols="30"><?php print $non_display[31]; ?></textarea>
								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Extra Skills/Activity</td>
					             <td align="left" >
								 <textarea name="ExtraSkills" id="ExtraSkills" cols="30"><?php print $non_display[32]; ?></textarea>
								 </td>
					        </tr>
							<tr>
                            
					             <td align="left">Social/Proffessional Member</td>
					             <td align="left" >
								 <textarea name="SocialMember" id="SocialMember" cols="30"><?php print $non_display[33]; ?></textarea>
								 </td>
					        </tr>
							<tr>

					             <td align="center" colspan="2" align="center" > 
								
								<input type="button" name="button2" onClick="steptwo();" value="Update Step-2" class="btnsdt" style="color:#FFFFFF;">
								
								 </td>
					        </tr>
        </table>
	</div>
	<div id="tabs-3" style="background:#CCCCCC; font-size:12px;">
		<table cellpadding="5" cellspacing="5" class="table_1">
                        	<tr>
                            	<th >Emergency Contact</th>
								<th >
								<?php
								if($non_display[34]!="")
								{
								?>
					<input type="radio" name="radiogroup1"  onclick="emargencypepeelika();" value="PepeelikaUser" checked="checked" />  Pepeelika User
								<input type="radio" name="radiogroup1"  value="EmergencyPerson" onClick="emargencyperson();" /> Others Person
								<input id="emergencytype" name="emergencytype" size="33" type="hidden" value="PepeelikaUser">
						     <?php }
							 else
							  { ?>
					<input type="radio" name="radiogroup1"  onclick="emargencypepeelika();" value="PepeelikaUser" />  Pepeelika User
					<input type="radio" name="radiogroup1"  value="EmergencyPerson" onClick="emargencyperson();" checked="checked"  /> Others Person
								<input id="emergencytype" name="emergencytype" size="33" type="hidden" value="OthersPerson">
							<?php } ?>
								</th>

                            </tr>
							<?php
								if($non_display[34]!="")
								{
								?>
							<tr id="cpuid">
							    <?php }
								else
								{ ?>
							<tr id="cpuid" style="display:none;">
							 <?php } ?>
					             <td align="left">Pepeelika User ID<span style="color:#FF0000;">*</span></td>
					             <td align="left">
								 <input id="CPUserID" name="CPUserID" size="33" type="text" value="<?php print $non_display[34]; ?>">
								 </td>
					        </tr>
							<?php
								if($non_display[34]=="")
								{
								?>
							<tr id="cpnam">
							    <?php }
								else
								{ ?>
							<tr id="cpnam" style="display:none;">
							 <?php } ?>
					             <td align="left">Contact Person's Name<span style="color:#FF0000;">*</span></td>
					             <td align="left">
								 <input id="cpname" name="cpname" size="33" type="text" value="<?php print $cont[1]; ?>">
								 </td>
					        </tr>
							<?php
								if($non_display[34]=="")
								{
								?>
							<tr id="cpaddr">
							    <?php }
								else
								{ ?>
							<tr id="cpaddr" style="display:none;">
							 <?php } ?>
                            
					             <td align="left">Contact Person's Address<span style="color:#FF0000;">*</span></td>
					             <td align="left">
								 <textarea name="cpaddress" id="cpaddress" cols="30"><?php print $cont[2]; ?></textarea>
								 </td>
					        </tr>
							<?php
								if($non_display[34]=="")
								{
								?>
							<tr id="cpem">
							    <?php }
								else
								{ ?>
							<tr id="cpem" style="display:none;">
							 <?php } ?>
                        
                            
					             <td align="left">Contact Person's Email<span style="color:#FF0000;">*</span></td>
					             <td align="left"> 
								 <input id="cpmail" name="cpmail" size="33" type="text" value="<?php print $cont[4]; ?>" />
								 </td>
					        </tr>
							<?php
								if($non_display[34]=="")
								{
								?>
							<tr id="cpcont">
							    <?php }
								else
								{ ?>
							<tr id="cpcont" style="display:none;">
							 <?php } ?>
							
                            
					             <td align="left">Contact Person's Contact<span style="color:#FF0000;">*</span></td>
					             <td align="left"> 
								 <input id="cpcontact" name="cpcontact" size="33" type="text" value="<?php print $cont[3]; ?>" />
								 </td>
					        </tr>
							<?php
								if($non_display[34]=="")
								{
								?>
							<tr id="cprel">
							    <?php }
								else
								{ ?>
							<tr id="cprel" style="display:none;">
							 <?php } ?>
						
                            
					             <td align="left">Relationship<span style="color:#FF0000;">*</span></td>
					             <td align="left"> 
								 <input id="cprelation" name="cprelation" size="33" type="text" value="<?php print $cont[5]; ?>" />
								 </td>
					        </tr>
							<tr>
                            
					             <th align="left" >Reference</th>
					             <th >
								 <?php
								if($non_display[35]!="")
								{
								?>
					<input type="radio" name="radiogroup2"  onclick="refpepeelika();" value="PepeelikaUser" checked="checked" />  Pepeelika User
								<input type="radio" name="radiogroup2"  value="RefPerson" onClick="refperson();" /> Others Person
								<input id="reftype" name="reftype" size="33" type="hidden" value="PepeelikaUser">
							 <?php }
							 else
							  { ?>
					<input type="radio" name="radiogroup2"  onclick="refpepeelika();" value="PepeelikaUser"  />  Pepeelika User
					<input type="radio" name="radiogroup2"  value="RefPerson" onClick="refperson();" checked="checked" /> Others Person
								<input id="reftype" name="reftype" size="33" type="hidden" value="OthersPerson">
							<?php } ?>
								</th>
					        </tr>
							 <?php
								if($non_display[35]!="")
								{
								?>
							<tr id="rpuid">
							<?php }
							else
							 {  ?>
		  <tr id="rpuid" style="display:none;">
							<?php } ?>
                            
					             <td align="left">Refer's ID<span style="color:#FF0000;">*</span></td>
					             <td align="left" >
								  <input id="RPUserID" name="RPUserID" size="33" type="text" value="<?php print $non_display[35]; ?>" />
		    </td>
          </tr>
							<?php
								if($non_display[35]=="")
								{
								?>
							<tr id="rpnam">
							<?php }
							else
							 {  ?>
		  <tr id="rpnam" style="display:none;">
							<?php } ?>
							
                            
					             <td align="left">Refer's Name<span style="color:#FF0000;">*</span></td>
					             <td align="left" > 
								 <input id="refname" name="refname" size="33" type="text" value="<?php print $ref[1]; ?>" />
								 </td>
          </tr>
							<?php
								if($non_display[35]=="")
								{
								?>
							<tr id="rpaddr">
							<?php }
							else
							 {  ?>
		  <tr id="rpaddr" style="display:none;">
							<?php } ?>
							
                            
					             <td align="left">Refer's Address<span style="color:#FF0000;">*</span></td>
					             <td align="left" >
								 <textarea name="refaddress" id="refaddress" cols="30"><?php print $ref[2]; ?></textarea>
								 </td>
          </tr>
							<?php
								if($non_display[35]=="")
								{
								?>
							<tr id="rpem">
							<?php }
							else
							 {  ?>
		  <tr id="rpem" style="display:none;">
							<?php } ?>
							
                            
					             <td align="left">Refer's Email<span style="color:#FF0000;">*</span></td>
					             <td align="left" >
								 <input id="refmail" name="refmail" size="33" type="text" value="<?php print $ref[4]; ?>" />
								 </td>
          </tr>
							<?php
								if($non_display[35]=="")
								{
								?>
							<tr id="rpcont">
							<?php }
							else
							 {  ?>
		  <tr id="rpcont" style="display:none;">
							<?php } ?>
						
                            
					             <td align="left">Refer's Contact<span style="color:#FF0000;">*</span></td>
					             <td align="left" >
								 <input id="refcontact" name="refcontact"  size="33" type="text" value="<?php print $ref[3]; ?>">
								 </td>
          </tr>
                            <?php
								if($non_display[35]=="")
								{
								?>
							<tr id="rprel">
							<?php }
							else
							 {  ?>
		  <tr id="rprel" style="display:none;">
							<?php } ?>

                            
					             <td align="left">Relationship<span style="color:#FF0000;">*</span></td>
					             <td align="left" >
								 <input id="refrelation" name="refrelation"  size="33" type="text" value="<?php print $ref[5]; ?>">
								 </td>
          </tr>
							<tr>

					             <td align="center" colspan="2" align="center" > 
								
				<input type="button" name="button3" onClick="stepthree();" value="Update Step-3" class="btnsdt" style="color:#FFFFFF;">
								
								 </td>
					        </tr>
        </table>
						
				
	</div>
		<div id="tabs-4" style="background:#CCCCCC; font-size:12px;">
		<table cellpadding="5" cellspacing="5" class="table_1">
                        	<tr>
                            	<th colspan="2" >Pepeelika Mail & Password</th>
          </tr>
							  <tr>
    
					             <td align="left">Pepeelika Mail<span style="color:#FF0000;">*</span></td>
					             <td align="left" >
								 <input id="pepeelikamail" name="pepeelikamail"  size="33" type="text" value="<?php print $display[5]; ?>">
								 </td>
					        </tr>
							<tr>
    
					             <td align="left">Pepeelika Password<span style="color:#FF0000;">*</span></td>
					             <td align="left" >
							<input id="pepeelikapassword" name="pepeelikapassword"  size="33" type="password" value="<?php print $display[9]; ?>">
								 </td>
					        </tr>
							<tr>
    
					             <td align="left">Validation Date<span style="color:#FF0000;">*</span></td>
					             <td align="left" >
								 <input id="VDATE" name="VDATE"  size="33" type="text" value="<?php print @substr($display[3],0,10); ?>">
								 </td>
					        </tr>
							<tr>
    
					             <td align="left">Active Status<span style="color:#FF0000;">*</span></td>
					             <td align="left" >
								 <select name="ActiveStatus" id="ActiveStatus">
								 <?php
								  if($display[8]=="Active")
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
								 </select>
								 </td>
					        </tr>
							<tr>

					             <td align="center" colspan="2" align="center" > 
								
				<input type="button" name="button3" onClick="stepfour();" value="Update Step-4" class="btnsdt" style="color:#FFFFFF;">
								
								 </td>
					        </tr>
          </table>
						
				
	</div>
	</form>
</div>

</div><!-- End demo -->


</body>
</html>