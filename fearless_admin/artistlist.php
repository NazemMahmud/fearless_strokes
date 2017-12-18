<?php
	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
//    $Date=MakeDate();
    if(isset($_REQUEST["del"]) && $_REQUEST["del"]=="ok")
    {
        
        
        $id = $_GET["artistid"];
        $result = mysqli_query($con, "SELECT artist_image FROM artist WHERE id='".$id."'");
        $image=mysqli_fetch_row($result);
        @unlink('../artist/'.$image[0]);
        $sql="DELETE FROM artist WHERE id='".$id."'";
        $result=mysqli_query($con, $sql);
        header("Location:artistlist.php?msg=Successfully Deleted!");
//    deletebooking($orderID);

    } 
	if(isset($_REQUEST["type"]) && $_REQUEST["type"]=="admin")
	  {
        
		
			$rs=mysqli_query($con, "SELECT ActiveStatus FROM user_admin WHERE UserID='".$_GET['id']."'");
		 $row=mysqli_fetch_row($rs);
		 if($row[0]=="Active")
		 {$acinac="InActive";}
		 else
		 {$acinac="Active";}
		 mysqli_query($con, "UPDATE user_admin SET ActiveStatus='".$acinac."' where UserID='".$_GET['id']."'");
		
		
					
					 $activity_update=mysqli_query($con, "UPDATE user_admin SET UpdateDate='".$Date."',UpdateBy='".$_SESSION['UserID']."'
					  WHERE UserID='".$_GET['id']."'");
					
					 header("Location:userlist.php?msg=User Successfully Updated!");
		 
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
//           alert(""+id);
            var result = confirm("Are you sure you want to Change this Record ?");
            if (result==true)
            {
                window.location = "userlist.php?type=admin&id="+id;
            }
        }
            
        function ConfirmDelete(id)
        {
//           alert(""+id);
            var result = confirm("Are you sure you want to Delete this Item?");
            if (result==true)
            {
//                alert(""+id);
                window.location = "artistlist.php?del=ok&artistid="+id;
//                window.location = "product_list.php?del=ok&listtype="+type+"&CategoryID="+id;
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
			border-radius: 5px;"
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
					<div class="title">
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:"Artist List"; ?></h5>
					</div>
					<!-- end box / title -->
					
						
                    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data"><br>
                    <table width="728" border="0" align="left" cellpadding="0" cellspacing="0">
                    <tr >
<!--                      <td width="10" align="center" ><strong>SL</strong></td>-->
                      <td width="103" align="center"  ><strong> Name </strong></td>
                        <td width="119" align="center" ><strong>Image</strong></td>
                      <td width="50" align="center"  ><strong> Bio </strong></td>
                      <td width="125" align="center"  ><strong>Contact & Email</strong></td>
<!--                      <td width="109" align="center"  ><strong>E-mail</strong></td>-->

<!--                      <td align="center" ><strong>Action</strong></td>-->
                    </tr>
                <?php

                $sl=0;
                  $rs=mysqli_query($con, "SELECT id,artist_name,artist_bio,artist_phone,artist_email,artist_image FROM artist ORDER BY id DESC ");
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


    //				 if($row[4]=='Active')
    //				  {$acinac="InActive";}
    //				  else
    //				  {$acinac="Active";}
                ?>
                    <tr <?php print $bgcolor; ?>>
<!--                      <td height="30" align="center">--><?php //print $sl; ?><!--</td>-->
                      <td align="center"  ><?php print $row[1] ?></td>
                        <td align="center"><img src="../artist/<?php print $row[5]; ?>" width="100"></td>
                      <td align="left"  ><?php print $row[2] ?></td>
                      <td align="center"><?php print $row[3] ?><br><br><br><?php print $row[4] ?></td>
<!--                      <td align="center"></td>-->

        <!--              <td align="center"><?php 
        //                print $row[5] 
        ?></td>-->
<!--
                      <td align="center">
                      <?php
                                    $check_access=check_access($con, $_SESSION["UserID"],"MOD-06","edit_option");
                                     if($check_access=="yes")
                                      {
                                     ?>
                      <a href="artistedit.php?ID=<?php print $row[0]; ?>">Edit</a><br>
                          <form>
                              <input type="hidden" name="artistID" value="<?php print $row[0] ?>">
                          </form>
                     <a  href="#" onclick="ConfirmDelete('<?php print $row[0] ?>','none');">Delete</a><br>
        
                      <a href="#" onclick="window.open('user_activity_edit.php?ID=<?php print $row[0]; ?>','useractivity','height=450px,width=520px, left=200px, top=100px, align=center,scrollbars=1')">
                      Permission Set
                      </a>      <?php } ?>
        
                      </td>
-->
                    </tr>
              <?php } ?>
                    </table>
                    </form>
			  </div>
		  </div>
				<!-- end table --><!-- messages -->
				
				<!-- end box / left -->
				<!-- box / right -->
				
	</div>			<!-- end box / right -->
<!--	</div>-->
			<!-- end content / right --><!-- end content -->
		<!-- footer -->
		<?php include("footer.php"); ?>
		<!-- end footert -->
	</body>
</html>