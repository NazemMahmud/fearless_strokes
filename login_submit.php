<?php
session_start();
include("fearless_admin/connection.php");
if(isset($_POST['cust_email'])){
    $cust_email = $_POST['cust_email'];
   
}

if(isset($_POST['cust_password'])){
    $cust_password = $_POST['cust_password'];
 
}

$act = 1;
 $chk = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(id) FROM artist
     WHERE artist_email='".$cust_email."' AND active='".$act."'  AND artist_password=PASSWORD('".$cust_password."')")); 
     if($chk[0] > 0)
     {
	     $chk1 = mysqli_fetch_row(mysqli_query($con, "SELECT * FROM artist
          WHERE artist_email='".$cust_email."' AND artist_password=PASSWORD('".$cust_password."') AND active = 1 "));  
				
        $_SESSION["success_step"]=1;
       
    	   $_SESSION['MemberEmail']=$_REQUEST["cust_email"];
    	   $_SESSION['MemberContact']=$chk1[4];
    	   $_SESSION['MemberName']=$chk1[1];
         $_SESSION['MemberId'] = $chk1[0];
	
	
       print '<script>location.href="profile?id='.$_SESSION['MemberId'].'"</script>';
     }
     else
     {
       print "<script>alert('Try another Email and Password!'); window.location.href='index';</script>";
     }

 ?>