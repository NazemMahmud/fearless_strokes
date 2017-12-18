<?php
session_start();
include("fearless_admin/connection.php");
require_once('PHPMailer-master/class.phpmailer.php');
if(isset($_POST['cust_email'])){
    $cust_email = $_POST['cust_email'];
}

$act = 1;
$chk = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(id) FROM artist
     WHERE artist_email='".$cust_email."' AND active='".$act."' "));
if($chk[0] > 0)
{
    $chk1 = mysqli_fetch_row(mysqli_query($con, "SELECT id, artist_name,artist_email,code FROM artist WHERE artist_email='".$cust_email."' AND active = 1 "));
    $email = new PHPMailer(); // email start from here
    $email->From = "fearless.strokes@gmail.com"; //
    $email->FromName = "Fearless Strokes";
    $email->AddAddress($cust_email);
    $email->Subject   = 'Change Password';

    $msg = ' Hello '. $chk1[1].', 
			To reset your password click this link: http://fearlessstrokes.com/reset_password?reg='.$chk1[0].'&key='.$chk1[3];
    $email->Body   = $msg;
    $email->Send();

    print '<script>alert("Check your email to reset your password.");window.location.href="index"</script>';
}
else
{
    print "<script>alert('Try another Email and Password!'); window.location.href='index.php';</script>";
}

?>