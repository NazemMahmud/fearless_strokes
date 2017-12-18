<?php
include("fearless_admin/connection.php");
require_once('PHPMailer-master/class.phpmailer.php');
// $unitname = htmlspecialchars($_POST["CategoryName"]);
// 		$unitname = mysqli_real_escape_string($con, $unitname) ;
$cust_name= htmlspecialchars($_POST['cust_name']) ;
$cust_email= $_POST['cust_email'];
$cust_number= $_POST['cust_number'];
$cust_message= $_POST['cust_message'];


// echo $cust_name; echo $cust_email; echo $cust_number; echo $cust_password;


if($cust_email!="" && $cust_message!="" && $cust_name!=""  ){
            /*...................mail section start........................ */
            $email = new PHPMailer();
            $email->From = $cust_email; // from who
            $email->FromName = $cust_name;
            $email->AddAddress("fearless.strokes@gmail.com"); // to whom

            // $to      = $cust_email;
            $email->Subject   = 'Activate fearless strokes account';

//            $message = ' Hello '. $cust_name.',
//			To activate your account click'.$artistID.'&key='.$code;
            $email->Body   = $cust_message;
            // $headers = 'From: fearless.strokes@gmail.com'."\r\n";
            $email->Send();
            // mail($to, $subject, $message, $headers);
            /*...................mail section end........................ */
            // header("Location:key_active.php");
            print "<script>alert('Your message is sent.');window.location.href='contactus'</script>";


        // echo $code;
}
else{
    print "<script>alert('Please at least fill out your name, email and enquiry');window.location.href='contactus'</script>";
}







?>