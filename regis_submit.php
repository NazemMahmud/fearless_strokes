 <?php
include("fearless_admin/connection.php");
require_once('PHPMailer-master/class.phpmailer.php');
 // $unitname = htmlspecialchars($_POST["CategoryName"]);
	// 		$unitname = mysqli_real_escape_string($con, $unitname) ;
 $cust_name= htmlspecialchars($_POST['cust_name']) ;
 $cust_name= mysqli_real_escape_string($con, $cust_name) ;
 $cust_email= $_POST['cust_email'];
 $cust_number= $_POST['cust_number'];
 // $cust_password= $_POST['cust_password'];
 $cust_password= htmlspecialchars($_POST['cust_password']) ;
 $cust_password= mysqli_real_escape_string($con, $cust_password) ;
 
 // echo $cust_name; echo $cust_email; echo $cust_number; echo $cust_password;


 if($cust_email!=""){
 	$result = mysqli_query($con,"SELECT * FROM artist where artist_email='".$cust_email."'");
 	$num_rows = mysqli_num_rows($result);

 	if($num_rows >= 1){
       // echo "email exist";
//        header("Location:artists.php");
        print "<script>alert('Sorry, email already exist.')</script>";
        print "<script>location.href='artists'</script>";
    }
    else{
    	$artistID=MakeID($con, "artist","id","",4);
    	// function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	    // {
	    //     $str = '';
	    //     $max = mb_strlen($keyspace, '8bit') - 1;
	    //     for ($i = 0; $i < $length; ++$i) {
	    //         $str .= $keyspace[random_int(0, $max)];
	    //     }
	    //     return $str;
	    // }
	    function generateRandomString($length ) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}
    	// $code =  random_str(10);
    	$code =  generateRandomString(10);

		$rs=mysqli_query($con, "INSERT INTO artist 
				 	(
		            id,
					artist_name,
					artist_email,
					artist_phone,
					artist_password,
		            code
					)
					VALUES
					(
		            '".$artistID."',
					'".$cust_name."',
					'".$cust_email."',
		            '".$cust_number."',
					PASSWORD('".$cust_password."'),
					'".$code."'
					)"); 
		 
		 
		 if($rs){
/*...................mail section start........................ */
			$email = new PHPMailer(); // thik ase..........................
			$email->From = "fearless.strokes@gmail.com"; // thik.......................
			$email->FromName = "Fearless Strokes";
			$email->AddAddress($cust_email);

			// $to      = $cust_email;
			//$subject = "";
			$email->Subject   = 'Activate fearless strokes account'; 
			// To activate your account click this link: http://demos.controlndigital.com/fearless-strokes/key_activate.php
			$message = ' Hello '. $cust_name.', 
			To activate your account click this link: http://fearlessstrokes.com/key_activate.php?reg='.$artistID.'&key='.$code;
			$email->Body   = $message;
			// $headers = 'From: fearless.strokes@gmail.com'."\r\n";
			$email->Send();
			// mail($to, $subject, $message, $headers);
/*...................mail section end........................ */
				 // header("Location:key_active.php");
			 print "<script>location.href='key_active'</script>";
			//echo "Thank you for signing up. Please check your email for confirmation!"
			//echo "Thank you for Submitting. Redirecting back to Home Page";
		}
		else{
			echo "kono akta jhamela hoise";
		}
       // echo $code;
    }

 }
 
 



 
 
 ?>