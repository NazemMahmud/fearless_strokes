<?php
session_start();
include("fearless_admin/connection.php");

$sessionId = $_SESSION['MemberId'];
$target_dir = "uploads/";
$image_title = $_POST["image_title"];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
	$msg = "Sorry, file already exists.";
    $uploadOk = 0;
    echo "<script>alert('Sorry, file already exists.'); window.location.href='profile?id=".$sessionId."';</script>";
    // header("Location:profile?id=".$sessionId);
}
// Check file size
else if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "<script>alert('Sorry, your file is too large.')</script>";
    $uploadOk = 0;
}
// Allow certain file formats
else if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');window.location.href='profile?id=".$sessionId."';</script>"; 
    $uploadOk = 0;
  
}
// Check if $uploadOk is set to 0 by an error
else if ($uploadOk == 0) {
    echo "<script>alert('Sorry, your file was not uploaded.')</script>";

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        #echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		#echo "The targeted directory is ".$target_file;
		
		#query to insert image in artist
			#echo "the id is ".$sessionId;
			$artistID=MakeID($con, "artist_detail","id","",10);
			$rs=mysqli_query($con, "INSERT INTO artist_detail 
		 	(id,
			artist_id,
            		images,
			image_title
			)
			VALUES
			(
            		'".$artistID."',
			'".$sessionId."',
			'".$target_file."',
			'".$image_title."'
			)");

			 if($rs){
			 	echo "<script>alert('Record updated successfully.Please, wait for admin approval.'); window.location.href='profile?id=".$sessionId."';</script>";
			//	header("Location:profile?id=".$sessionId);
			}
			else{
				echo "<script>alert('kono akta jhamela hoise')</script>";
			}	
			
			
		#query to insert image in artist ends
				
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href='profile?id=".$sessionId."';</script>";
    }
}
?>
