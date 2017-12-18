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
        
        
        $id = $_GET["id"];
        $result = mysqli_query($con, "SELECT * FROM slider_image WHERE id=".$id." ");
        $image=mysqli_fetch_row($result);
        @unlink('../'.$image[1]);
        $sql="DELETE FROM slider_image WHERE id=".$id." ";
        $result=mysqli_query($con, $sql);
        header("Location:banner_image_list.php?id=".$id."msg=Successfully Deleted!");

    } 
	if(isset($_REQUEST["type"]) && $_REQUEST["type"]=="admin")
	  {
        $rs=mysqli_query($con, "SELECT active FROM artist_detail WHERE id='".$_GET['id']."'");
        $row=mysqli_fetch_row($rs);
        if($row[0]==1)
        {$acinac=0;
        echo $acinac." adfja ad naab dabda ";  }
        else
        {$acinac=1;}
        $sql = mysqli_query($con, "UPDATE artist_detail SET active='".$acinac."' where id='".$_GET['id']."'");
		
        if($sql){
            header("Location:artist_image_list?msg=Artist Image Successfully Updated!"); }
        else{ echo "There may b some problem occured";}
	  }
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo $site_name; ?></title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<!-- stylesheets -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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

<!--        for modal start    -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--                for modal end    -->

		<script type="text/javascript">


            
        function ConfirmDelete(id)
        {
//           alert(""+id);
            var result = confirm("Are you sure you want to Delete this Item?");
            if (result == true) {
//                alert(""+id);
                window.location = "banner_image_list.php?del=ok&id=" + id;
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
						<h5><?php print @isset($_REQUEST["msg"])?$_REQUEST["msg"]:"Slider Image List"; ?></h5>
					</div>
					<!-- end box / title -->

                    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data"><br>
                        <table width="728" border="0" align="left" cellpadding="0" cellspacing="0">
                        <tr >
                          <td width="10" align="center" ><strong>SL</strong></td>
                          <td width="350" align="center" ><strong>Image</strong></td>

                          <td align="center" ><strong>Action</strong></td>
                        </tr>
                        <?php $sl=0;
                        $rs=mysqli_query($con, "SELECT id, sliderImage FROM slider_image ORDER BY id ");
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
                        ?>
                            <tr valign="middle" <?php print $bgcolor; ?>>
                            <td style="text-align: top" ><?php print $sl; ?></td>
<!--                            <td align="center"  valign="middle">--><?php //print $row[1] ?><!--</td>-->
<!--                            <td align="center"  >--><?php //print $row[2] ?><!--</td>-->
                            <td align="center" width="350"><img src="../<?php print $row[1]; ?>" width="300" height="105" data-toggle="modal" data-target="#myModal<?php echo $row[0]?>"></td>

                      <td align="center">
                      <?php
                                    $check_access=check_access($con, $_SESSION["UserID"],"MOD-06","edit_option");
                                     if($check_access=="yes")
                                      {
                                     ?>

                          <form>
                              <input type="hidden" name="artistID" value="<?php print $row[0] ?>">
                          </form>&nbsp;
                          <a  href="update_slider_image.php?id=<?php print $row[0] ?>">Edit</a>&nbsp;&nbsp;
                          <a  href="#" onclick="ConfirmDelete('<?php print $row[0] ?>','none');">Delete</a>
<!--                          onclick="ConfirmAcInac('--><?php //print $row[0] ?><!--');"-->

        <!--
                      <a href="#" onclick="window.open('user_activity_edit.php?ID=<?php print $row[0]; ?>','useractivity','height=450px,width=520px, left=200px, top=100px, align=center,scrollbars=1')">
                      Permission Set
                      </a>      -->
<?php } ?>

                      </td>
                    </tr>
                      <!-- Modal -->
                      <div class="modal fade" id="myModal<?php echo $row[0]?>" role="dialog">
                          <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>

                                  </div>
                                  <div class="modal-body" style="text-align: center">
<!--                                      <p>--><?php //echo $row[1]?><!--</p>-->
                                      <img src="../<?php print $row[1]; ?>" width="400" >
                                  </div>

                              </div>

                          </div>
                      </div>
                      <!--  Modal end-->
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
        <script type="text/javascript">
            function ConfirmAcInac(id)
            {
//               alert(""+id);
                var result = confirm("Are you sure you want to Change this Record ?");
                if (result==true)
                {
                    window.location = "artist_image_list?type=admin&id="+id;
                }
            }
        </script>
        
	</body>
</html>