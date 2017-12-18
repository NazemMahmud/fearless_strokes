<?php
session_start();
error_reporting(0);
include("fearless_admin/connection.php");
//$id = $_REQUEST["id"];
//$sql = mysqli_fetch_row(mysqli_query($con, "SELECT category_name from hj_category_info where category_id='".$id."' ")); //

$count = 0;
$clause = ' WHERE ';//Initial clause
//StyleID, StyleName from product_style                        WHERE  SUBSTRING(ProductID,3,2)='".$_REQUEST["id"]."' ORDER BY SerialNo desc
$sql_search='SELECT  StyleID, StyleName from product_style';//Query stub
if(isset($_POST['submit'])){
    if(isset($_POST['keysearch'])){
        foreach($_POST['keysearch'] as $c){
            $sql_search .= $clause.' StyleName  LIKE "%'.$c.'%"';
            $clause = ' OR ';//Change to OR after 1st WHERE
            $count = $count+1;

        }
    }
}
   // echo $sql_search;//Remove after testing
$query = mysqli_query($con, $sql_search);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Fearless Strokes | <?php echo $sql[0]?></title>

    <link rel="icon" href="assets/images/logo.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <style>
        .drpdwn{
            width: 100%;
            height:30px;
            border-radius: 4%;
            margin-bottom: 10px;
        }
        .drpdwn option{
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php include("header.php"); ?>

<div class="container">
    <div class="row clearfix">
        <div class="col-sm-12 bar2 ">
            Find your favourite arts here
            <div class="divider"></div>
        </div>
    </div>

    <div class="row" style="margin-top:15px;">

        <?php include('category_left_menu_hj.php');?>

        <div class="col-md-9">
            <div class="clearfix"></div>

            <div  class="product-list">
                <div id="products" class="list-group">
                    <?php
                    $sl=0;
                    while($row1=mysqli_fetch_row($query)){
                        $sql=mysqli_query($con, "SELECT ProductID,ProductName,Description,orderid,ActiveStatus,Price,SerialNo,Discount
                               FROM hj_product_info
                               WHERE  SUBSTRING(ProductID,1,2)='".$row1[0]."' ");
                        while($row=mysqli_fetch_row($sql)){
                        //for image :/
                        $sqlimage = mysqli_fetch_row(mysqli_query($con, "SELECT ImageID, ProductID,BigImage,MidImage,SmallImage,SerialNo 
                               FROM hj_product_image
                               WHERE ProductID='".$row[0]."' AND SerialNo='".$row[6]." ' "));
                        $id = substr($row[0],2,2); // category id       
                    ?>
                        <a href="product_hj_details.php?CatId=<?php echo $id;?>&Productid=<?php echo $row[0]; ?>&Serial=<?php echo $row[6]; ?>">
                            <div class="item col-md-4  col-xs-12 col-lg-4">
                                <div class="thumbnail">
                                    <img class="group list-group-image" src="productimage/hj/<?php echo $sqlimage[2]?>" alt="<?php echo $sqlimage[1]?>" />
                                    <div class="caption">
                                        <h4 class="group inner list-group-item-heading" style="text-align:center;"><?php echo $row[1]?></h4> <!-- Product title-->
                                        <p class="group inner list-group-item-text"  style="text-align:center;"><?php echo $row[2]?></p>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <?php if($row[7]<=0){ ?>
                                                    <p class="lead">ট <?php echo $row[5];?></p> <!-- price -->
                                                <?php }else if($row[7]>0){
                                                    $main = $row[5];
                                                    $discount = $row[7]/100;
                                                    $discount = $main * $discount;
                                                    $main = $main - $discount;
                                                ?>
                                                    <p class="lead">ট
                                                        <span style="text-decoration: line-through; color: red; "><span style="color: black;"> <?php echo $row[5];?></span></span>
                                                        <?php echo $main; ?>
                                                    </p> <!-- price -->
                                                <?php } ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                    <?php } }  ?>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<div class="container">
    <?php include("footer.php"); ?>
</div>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/bootstrap/js/bootstrap-select.js" /></script>
<script src="assets/js/singleCartDelete.js"></script>
<script>
    $(document).ready(function() {

    });

    $(function() {
        });
</script>

<script type="text/javascript" src="assets/js/plugin.js"></script>

</body>
</html>