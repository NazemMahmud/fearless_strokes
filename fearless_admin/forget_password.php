<?php
		session_start();
		include"connection.php";
		if(isset($_POST["Submit"]))
		{
				//$sql="SELECT UserEmail,UserName FROM user_info WHERE UserEmail='".$_POST["email"]."'";
				$sql="SELECT UserID,UserName,Email,ActiveStatus,ContactNumber FROM user_admin WHERE Email='".$_POST["email"]."'
				 AND UserType='".$_POST["UserType"]."' AND ContactNumber='".$_POST["Contact"]."'";
				$rs=mysqli_query($con, "$sql");
				$result=mysqli_fetch_row($rs);
					if($result[0])
						{
							$pass=substr($result[0],0,3);
							$pass=$pass.substr($result[1],0,3);
							$pass=$pass.substr($result[2],0,3);
							$pass=$pass.substr($result[4],0,3);
							//$update=mysqli_query($con, "UPDATE user_info SET UserPassword=PASSWORD('".$pass."')");	
					$update=mysqli_query($con, "UPDATE user_admin SET Password=PASSWORD('".$pass."') WHERE UserID='".$result[0]."'");
							if($update)
							{
								$to=$result[2];
								$subject="USER PASSWORD UPDATE OF PEPEELIKA";
								$message="Your New Updated Password Is: ".$pass."\nAND User Name Is: ".$result[1].
								"\nPlease Update Your Password From AYL as early as possible";
							 	if(mail($to, $subject, $message))
								 {
									$msg="Your Password And User Name Already Has Sent To Your Email.. <br>Please Check Your Email..."  ;	 
								 }
								 else
								 {
								    $msg="Try Again..."  ;		 
								 }
							}
							else
							{
							$msg="Try Again..."  ;		
							}
						}
					else
						{
							$msg="Do you forget? Retype your Email...";	
						}	
			
         } 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>PEPEELIKA</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<!-- stylesheets -->
		<link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="resources/css/style.css" media="screen" />
		<link id="color" rel="stylesheet" type="text/css" href="resources/css/colors/red.css" />
		<!-- scripts (jquery) -->
		
	
		
		<script type="text/javascript">
			$(document).ready(function () {
				style_path = "resources/css/colors";

				$("input.focus").focus(function () {
					if (this.value == this.defaultValue) {
						this.value = "";
					}
					else {
						this.select();
					}
				});

				$("input.focus").blur(function () {
					if ($.trim(this.value) == "") {
						this.value = (this.defaultValue ? this.defaultValue : "");
					}
				});

				$("input:submit, input:reset").button();
			});
		</script>
	</head>
	<body style="width:200px;">
		<div id="login" style="float:left; margin-top:0px; padding:0px;">
			<!-- login -->
			<div class="title">
				<h5><?php echo $site_name; ?> Admin</h5>
				<div class="corner tl"></div>
				<div class="corner tr"></div>
			</div>
			<div class="messages">
			<?php  
			if(isset($_POST["Submit"]))
			{
				
			?>
				<div id="message-error" class="message message-error">
					<div class="image">
						
					</div>
					<div class="text">
						<h6><?php print @$msg; ?></h6>
						
					</div>
					<div class="dismiss">
						<a href="#message-error"></a>
					</div>
				</div>
				
				<?php } ?>
			</div>
			<div style="background-color:#FFF;" >
				<form action="forget_password.php" method="post" name="login">
				<div class="form">
					<!-- fields -->
					<div class="fields">
                    <br>
						<div class="field">
							<div class="label">
                            	
								<label for="usermail">User Email:</label>
							</div>
							<div class="input">
								<input type="text" id="email" name="email" size="40"  class="focus" />
							</div>
						</div>
                        <div class="field">
							<div class="label">
                            	
								<label for="username">User Type:</label>
							</div>
							<div class="input">
							 <select id="UserType" name="UserType">
										<option value="User Admin">User Admin</option>
										<option value="Site Admin">Site Admin</option>
                                        <option value="Super Admin">Super Admin</option>
							  </select>
							</div>
						</div>
                        <div class="field">
							<div class="label">
                            	
								<label for="usercontact">User Contact:</label>
							</div>
							<div class="input">
							  <input type="text" id="Contact" name="Contact" size="40"  class="focus" />
							</div>
						</div>
						<div class="field"></div>
				    <div class="buttons">
							<input type="submit" style="border-radious:5px;" id="Submit" name="Submit" value="Submit" />
                            &nbsp;&nbsp;
							<input type="button" onclick="window.close();" style="border-radious:5px;" id="Submit2" name="Submit2" value="Close" />
                      </div>
					</div>
					<!-- end fields -->
					<!-- links -->
					<div class="links">
						<!--<a href="index.php?ID=ForgetPassword">Forgot your password?</a>-->
					</div>
					<!-- end links -->
				</div>
				</form>
			</div>
			<!-- end login -->
		
		</div>
	</body>
</html>