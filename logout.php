<?php
session_start();
unset($_SESSION["MemberEmail"]); 
header("Location: artists.php");

// header("Location:index.php");
?>