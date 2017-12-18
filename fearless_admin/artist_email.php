<?php
/**
 * Date: 8/31/2017
 * Time: 2:40 PM
 */

session_start();
if(empty($_SESSION['UserName']) )
{
    header("Location:index.php");
    die();
}
include("connection.php");
require_once('PHPMailer-master/class.phpmailer.php');
//id, ac
$artist_id=$_GET['id'];
$artist_reply=$_GET['ac'];
$artist_details=mysqli_fetch_row(mysqli_query($con, "SELECT artist_detail.id, 
                  artist.artist_name, 
                  artist.artist_email, 
                  artist_detail.image_title,
                  artist_detail.images,
                  artist_detail.active,
                  artist.id	
                    FROM artist_detail INNER JOIN artist ON (artist_detail.artist_id=artist.id)
                    WHERE artist_detail.id='".$details_id."' "));


$email = new PHPMailer();
$email->From = "fearless.strokes@gmail.com";
$email->FromName = "Fearless Strokes";

$email->AddAddress($artist_details[2]);


//Send HTML or Plain Text email
$email->isHTML(true);
$email->Subject   = 'Image Accept/Reject Confirmation';
$id1="artistImage";
$path = '../'.$artist_details[4];
$email->addEmbeddedImage($path,$id1);
//$email->addEmbeddedImage('assets/images/logo.png',$id1);
$msg = '';
$msg.='<html><body>';
if($artist_reply=='y'){
$msg.='<p>Dear '.$artist_details[1].',<br>The following art of yours is primarily accepted. 
Now, in order to publish it please email us a better quality of this art to this email account: <a>fearless.strokes@gmail.com</a> . 
Image size must be 1080*1440. <br><br>

Thank you.</p><br><br><br><br>';
}else{
    $msg.='<p>Dear '.$artist_details[1].',<br>We are sorry to say that, the following art of yours is not accepted. So, we can\'t publish this image right now. 
But don\'t worry. Upload more of your arts. We are eagerly waiting.<br><br>
Thank you.</p><br><br><br><br>';
}


$msg.=' <div style="margin-left:20px;">
    <img src="cid:'.$id1.'" alt="" height="80" width="60"></div></body></html>';
// echo $msg;
$email->Body   = $msg; //thik


$email->Send();
print "<script>alert('Email confirmation sent')</script>";
print "<script>location.href='artist_image_list?left_menu=User'</script>";
exit();
// http://controlndigital.com:2082/cpsess2996387321/frontend/x3/filemanager/index.html?dirselect=webroot&domainselect=controlndigital.com&dir=%2Fhome%2Fctrlnweb%2Fpublic_html&showhidden=1
?>