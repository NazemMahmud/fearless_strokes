<?php
 session_start();
 unset($_SESSION["UserName"],$_SESSION["AreaName"],$_SESSION["AgentID"]);
	 print "<script>location.href='../index'</script>";
?>