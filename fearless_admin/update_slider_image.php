<?php
session_start();
if(empty($_SESSION['UserName']) )
{
    header("Location:index.php");
    die();
}
include("connection.php");
$Date=MakeDate();
$id = $_GET['id'];

if(isset($_POST["btnAdd"]))
{
    $result = mysqli_fetch_row(mysqli_query($con,"SELECT * FROM slider_image WHERE id=".$id." "));
    @unlink('../'.$result[1]);
    $active = 1;

    $target = "../assets/images/slider/";  //This is the directory where images will be saved
    $target = $target . basename( $_FILES['SliderImage']['name']);
    $image_path = "assets/images/slider/" . basename( $_FILES['SliderImage']['name']);

    //This gets all the other information from the form
    $Filename=basename( $_FILES['SliderImage']['name']);

    //Writes the Filename to the server
    if(move_uploaded_file($_FILES['SliderImage']['tmp_name'], $target)) {
        //Tells you if its all ok
//            echo "The file ". basename( $_FILES['ArtistImage']['name']). " has been uploaded, and your information has been added to the directory";
        // Connects to your Database
//            mysql_connect("localhost", "root", "") or die(mysql_error()) ;
//            mysql_select_db("altabotanikk") or die(mysql_error()) ;

        //Writes the information to the database
//            mysql_query("INSERT INTO picture (Filename,Description)
//            VALUES ('$Filename', '$Description')") ;
        $rs=mysqli_query($con, "UPDATE slider_image SET sliderImage='".$image_path."' WHERE id=".$id." ");
              echo "<script>alert('Image insert successfull.');window.location.href='banner_image_list.php?left_menu=User';</script>";
    } else {
        //Gives and error if its not
        echo "Sorry, there was a problem uploading your file.";
    }
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

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
                <h5>Update Slider Image
                <div class="search">
                    <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customersss" method="post" enctype="multipart/form-data">
                    </form>
                </div>
            </div>
            <!-- end box / title -->


            <form action="<?php print $_SERVER['PHP_SELF'] ?>" name="customer" method="post" enctype="multipart/form-data">
                <?php $image_query = mysqli_fetch_row(mysqli_query($con,"SELECT id, sliderImage FROM slider_image WHERE id=".$id." "));
                ?>
                <div class="form">
                    <div class="fields">

                        <div class="field">
                            <div class="label">
                                <label for="input-medium">Image:</label>
                            </div>
                            <div class="input">
                                <img src="../<?php echo $image_query[1];?>" alt="" width="200" height="70">
                            </div>
                        </div>



                        <div class="field">
                            <div class="label">
                                <label for="input-large">Insert Image:</label>
                            </div>
                            <div class="select">
                                <input  name="SliderImage" class="small valid" type="file" id="fileToUpload">  <label for="input-valid"><strong>resolution must be (1000 x 350)</strong></label>
                            </div>
                        </div>


                        <div class="buttons">

                            <div class="highlight">
                                <input type="submit" name="btnAdd" value="   Add    " class="btnsdt" style="color:white;"/>
                            </div>

                        </div>


                        <!-- pagination -->

                        <!-- end pagination -->
                        <!-- table action -->
                        <!-- table action -->

                        <!-- end table action -->
                    </div>
                </div>
            </form>


            <!-- end table --><!-- messages -->

            <!-- end box / left -->
            <!-- box / right -->

        </div>
    </div>			<!-- end box / right --><!-- end content / right --><!-- end content -->
    <!-- footer -->
    <?php include("footer.php"); ?>
    <!-- end footert -->
    <script type="text/javascript">
        var _URL = window.URL || window.webkitURL;

        $("#fileToUpload").change(function(e) {
            // alert("sdasd");
            var image, fileToUpload;

            if ((fileToUpload = this.files[0])) {
                // alert("sdasd");
                image = new Image();

                image.onload = function() {
                    // alert("sdasd");
                    if(this.width!=1000 || this.height!=350){
                        $("#fileToUpload").val('');
                        alert("The image size must be 1080 X 1440");
                    }
                };

                image.src = _URL.createObjectURL(fileToUpload);


            }

        });
    </script>
</body>
</html>