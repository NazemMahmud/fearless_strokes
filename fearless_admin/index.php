<?php
		session_start();
		include"connection.php";
		unset($_SESSION["UserName"],$_SESSION["AreaName"],$_SESSION["AgentID"],$_SESSION["LeftMenu"]);
		 $msg="";
		if(isset($_POST["SignIn"]))
		{
		   $_SESSION["LeftMenu"]="none";
	
	      $sql="SELECT UserName,UserType,UserID FROM user_admin WHERE Email='".$_POST["username"]."' 
		  AND Password=PASSWORD('".$_POST["password"]."') AND ActiveStatus='Active'";
				$rs=mysqli_query($con, "$sql");
				$result=mysqli_fetch_row($rs);
					if($result[0])
						{
							
							$_SESSION["UserName"]=$result[0];
							$_SESSION["UserType"]=$result[1];
							$_SESSION["UserID"]=$result[2];
							print"<script>location.href='insert_product.php'</script>";	
						}
					else
						{
							$msg="Do you forget? Retype your Email and Password......";	
						}	
		 

			
         } 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo $site_name; ?></title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<!-- stylesheets -->
		<link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="resources/css/style.css" media="screen" />
		<link id="color" rel="stylesheet" type="text/css" href="resources/css/colors/<?php echo $theme_color; ?>.css" />
		<!-- scripts (jquery) -->
		<script src="resources/scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
		<script src="resources/scripts/jquery-ui-1.8.custom.min.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.js" type="text/javascript"></script>
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
	<body>
		<div id="login">
			<!-- login -->
			<div class="title">
				<h5>Sign In to <?php echo $site_name; ?> Admin Panel</h5>
				<div class="corner tl"></div>
				<div class="corner tr"></div>
			</div>
			<div class="messages">
			<?php  
			if(isset($_POST["SignIn"]))
			{
				if($msg!="")
				{
			?>
				<div id="message-error" class="message message-error">
					<div class="image">
						<img src="resources/images/icons/error.png" alt="Error" height="32" />
					</div>
					<div class="text">
						<h6>Error Message</h6>
						<span><?php print $msg; ?></span>
					</div>
					<div class="dismiss">
						<a href="#message-error"></a>
					</div>
				</div>
				
				<?php }} ?>
			</div>
			<div class="inner">
				<form action="index.php" method="post" name="login">
				<div class="form">
					<!-- fields -->
					<div class="fields">
					   
						<div class="field">
							<div class="label">
								<label for="username">User Email:</label>
							</div>
							<div class="input">
								<input type="text" id="username" name="username" size="40" value="admin" class="focus" />
							</div>
						</div>
						<div class="field">
							<div class="label">
								<label for="password">Password:</label>
							</div>
							<div class="input">
								<input type="password" id="password" name="password" size="40" value="password" class="focus" />
							</div>
						</div>
						<div class="field">
							<div class="checkbox">
								<input type="checkbox" id="remember" name="remember" />
								<label for="remember">Remember me</label>
							</div>
						</div>
						<div class="buttons">
							<input type="submit" id="signIn" name="SignIn" value="Sign In" />
						</div>
					</div>
					<!-- end fields -->
					<!-- links -->
					<div class="links">
						 <a href="#" onclick="window.open('forget_password.php','forget_password','height=300px,width=430px,align=center')">Forgot your password?</a>
					</div>
					<!-- end links -->
				</div>
				</form>
			</div>
			<!-- end login -->
		
		</div>
	</body>
</html>