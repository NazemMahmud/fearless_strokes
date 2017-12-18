<?php
		session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
	$Date=MakeDate();
	if(isset($_POST["btnEdit"]))
	 {
	   $rs=mysqli_query($con, "UPDATE user_admin_activity SET add_option='no',edit_option='no',delete_option='no'
		 WHERE UserID='".$_REQUEST["ID"]."'");	
		
		
	  @$add=$_POST["add"];
	   $add_count=count($add);
	  $i=0;
	  while($add_count > 0)
	  {
	   $add_count--;
	   mysqli_query($con, "UPDATE user_admin_activity SET add_option='yes'
		 WHERE UserID='".$_REQUEST["ID"]."' AND ModuleID='".$add[$i]."'");
		 ++$i;
	  }
	  
	  
	  @$edit=$_POST["edit"];
	   $edit_count=count($edit);
	  $j=0;
	  while($edit_count > 0)
	  {
	     $edit_count--;
	   mysqli_query($con, "UPDATE user_admin_activity SET edit_option='yes'
		 WHERE UserID='".$_REQUEST["ID"]."' AND ModuleID='".$edit[$j]."'");
		 ++$j;
	  }
	  
	  
	  @$delete=$_POST["delete"];
	   $delete_count=count($delete);
	  $k=0;
	  while($delete_count > 0)
	  {
	   
	   $edit_count--;
	   mysqli_query($con, "UPDATE user_admin_activity SET delete_option='yes'
		 WHERE UserID='".$_REQUEST["ID"]."' AND ModuleID='".$delete[$k]."'");
		 ++$k;
	  }
	  
	    
		$activity_update=mysqli_query($con, "UPDATE user_admin SET UpdateDate='".$Date."',UpdateBy='".$_SESSION['UserID']."'
					  WHERE UserID='".$_REQUEST['ID']."'"); 
	 }

	
?>
<form action="<?php print $_SERVER['PHP_SELF'] ?>" name="activityedit" method="post" enctype="multipart/form-data">
                    <br>
  <table width="495" border="0" align="left" cellpadding="0" cellspacing="1">
            <tr >
              <td height="29" colspan="5" align="center"  ><strong>
			  <?php
			  // if(substr($_REQUEST["ID"],0,2)=="US")
			   print "User Permission Setting";
			  // else if(substr($_REQUEST["ID"],0,2)=="AG")
			 //  print "Customer Manager Permission Setting";
			  ?>
			  
                  <input type="hidden" name="ID" id="ID" value="<?php print $_REQUEST["ID"]; ?>" />
              </strong></td>
            </tr>
            <tr >
              <td width="45" height="29" align="center" bgcolor="#CCCCCC"  ><strong>SL</strong></td>
              <td width="148" align="left" bgcolor="#CCCCCC"  ><strong>Module Name </strong></td>
              <td width="106" align="center" bgcolor="#CCCCCC"  ><strong>Add</strong></td>
              <td width="103" align="center" bgcolor="#CCCCCC"  ><strong>Edit</strong></td>
              <td width="87" align="center" bgcolor="#CCCCCC"  ><strong>Delete</strong></td>
            </tr>
			<?php
			   $rs=mysqli_query($con, "SELECT
    user_module.ModuleID
    , user_module.ModuleName
    , user_admin_activity.add_option
    , user_admin_activity.edit_option
    , user_admin_activity.delete_option
FROM
    user_admin_activity
    INNER JOIN user_module 
        ON (user_admin_activity.ModuleID = user_module.ModuleID)
WHERE user_admin_activity.UserID='".$_REQUEST["ID"]."'");
              $sl=0;
            while($row=mysqli_fetch_row($rs))
			{  ++$sl;
			
			    //  if($sl%2 == 0)
				  $bgcolor="bgcolor=\"#CCCCCC\"";
				  
				  if( $row[2]=="yes")
				   $add="checked=\"checked\"";
				  else
				   $add="";
				   
				  if( $row[3]=="yes")
				   $edit="checked=\"checked\"";
				  else
				   $edit="";
				   
				 if( $row[4]=="yes")
				   $delete="checked=\"checked\"";
				  else
				   $delete="";
				  
			?>
            <tr <?php print $bgcolor; ?> >
              <td height="29" align="center"  ><?php print $sl; ?></td>
              <td height="29" align="left"  ><?php print $row[1]; ?><strong>
                <input type="hidden" name="modid[]" id="modid" value="<?php print $row[0]; ?>" />
              </strong></td>
              <td align="center"  ><input type="checkbox" name="add[]" <?php print $add; ?>  value="<?php print $row[0]; ?>" /></td>
              <td align="center"  ><input type="checkbox" name="edit[]" <?php print $edit; ?> value="<?php print $row[0]; ?>" /></td>
              <td align="center"  ><input type="checkbox" name="delete[]" <?php print $delete; ?> value="<?php print $row[0]; ?>" /></td>
            </tr>
       	    <?php } ?>
            <tr >
              <td height="27" align="left"  >&nbsp;</td>
              <td height="27" align="left"  >&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr >
              <td height="21" colspan="2" align="right"  ><input type="submit" name="btnEdit" id="btnEdit" value="EDIT" /></td>
              <td colspan="3" align="left"><input type="button" name="button2" id="button2" value="Close" onclick="window.close();" /></td>
            </tr>
  </table>
</form>