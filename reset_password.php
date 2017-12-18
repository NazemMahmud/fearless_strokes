<?php
session_start();
include("fearless_admin/connection.php");

$artisid = $_GET['reg'];
$code = $_GET['key'];
$act = 1;
//$rs = mysqli_query($con,  "UPDATE  artist SET active='".$act."' WHERE id ='".$artisid."' AND code='".$code."'");

// echo "UPDATE  artist SET active='".$act."' WHERE id ='".$artisid."' AND code='".$code."'";

//echo $artisid." ".$code ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fearless Strokes</title>
    <link rel="icon" href="assets/images/logo.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/style.css">


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <style type="text/css">
        a:hover {color: red;}
    </style>
</head>
<body>
<?php include('header.php');
    $sql = mysqli_fetch_row(mysqli_query($con, "SELECT id, artist_email, artist_name FROM artist WHERE id='".$artisid."' AND code='".$code."'"));
?>
<div class="container">
    <div class="row" style="font-size:20px;" >
        <div class="modal" id="" role="dialog" style="display: block; position:relative;margin-top: 45px;">
            <div class="modal-dialog">
                <div class="modal-content" style="">
                    <div class="modal-body" style="min-height: 240px;">
                        <div class="">
                            <h2 style="text-align:center;">Change Password</h2>
                            <form class = "pure-form" action="password_submit" method="post">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input id="" type="text" value="<?php echo $sql[1];?>" class="form-control" name="cust_email" placeholder="Email Address" disabled>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input id="password" type="password" name="cust_password" class="form-control" placeholder="Password" required>
                                    <input id="" type="hidden" name="artist_id" value=<?php echo $sql[0]?>>
                                </div>
                                <br>

                                <button style="float:right;" type="submit" class="pure-button pure-button-primary btn btn-success">SUBMIT</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>

</body>
<!--
  <body>


    <div class="container">

        <div class="col-md-12" >
            <div class="nav navbar-nav navbar-right col-md-1 col-md-offset-2 collapse navbar-collapse js-navbar-collapse" >
                    <a href="#" data-toggle="modal" data-target="#loginModal">Sign In</a>
                </div>
        </div>


        <div class="modal fade" id="loginModal" role="dialog" style="display: none;">
            <div class="modal-dialog">

                <div class="modal-content" style="top:180px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="">
                            <h2 style="text-align:center;">Sign In</h2>
                            <form class = "pure-form" action="login_submit" method="post">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input id="" type="text" class="form-control" name="cust_email" placeholder="Email Address" required>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input id="password" type="password" name="cust_password" class="form-control" placeholder="Password" required>
                                </div>
                                <br>

                               <button style="float:right;" type="submit" class="pure-button pure-button-primary btn btn-success">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>


        </div>
    </div>


    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap-select.js" /></script>


    <script type="text/javascript" src="assets/js/plugin.js"></script>

  </body> -->
</html>