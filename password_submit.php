<?php
session_start();
include("fearless_admin/connection.php");

$cust_email= $_POST['cust_email']; // eta paitse na, tai id diye catch kortsi apadoto
// echo  $cust_email;
//echo $_POST['cust_password'];
$cust_password= htmlspecialchars($_POST['cust_password']) ;
//echo $cust_password;
//$cust_password= mysqli_real_escape_string($con, $cust_password) ;

$id = $_POST['artist_id'];
// echo $id;
 $rs=mysqli_query($con, "UPDATE artist SET artist_password = PASSWORD('".$cust_password."') WHERE id='".$id."'");

    if($rs){
   // echo $cust_email;
   // echo $id;
    $sql = mysqli_fetch_row(mysqli_query($con, "SELECT artist_name, artist_email,artist_password FROM artist WHERE artist_email='".$cust_email."'"));
   // echo $sql[1]." ".$sql[2];
        print "<script>alert('Password Updated Successfully');window.location.href='index'</script>";
    }
?>

