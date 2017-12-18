<?php
 include("connection.php");
 
if(isset($_POST["btnSelect"]))
{
  $a=$_POST["CID"];
  $counter=count($a);
  $sss="";
  $articlenamelist="";
  for($i=0;$i<$counter;$i++)
   {
	 $sss.="|".$a[$i]; 
        $name=mysqli_fetch_row(mysqli_query($con, "SELECT Title FROM content_info WHERE ContentID='".$a[$i]."'"));
	 $articlenamelist.=$name[0]."<br>"; 
   }
   print "<script type=\"text/javascript\">window.opener.document.getElementById('afterSelectArticles').innerHTML='$articlenamelist';</script>";

   print "<script type=\"text/javascript\">window.opener.document.customer.articlesss.value='$sss';</script>";
   print "<script type=\"text/javascript\">window.opener.document.customer.articleCount.value=$counter</script>";	
   print "<script type=\"text/javascript\">window.close();</script>";
}
?>
<style type="text/css">
<!--
.style1 {
	font-size: 16px;
	font-weight: bold;
}
-->
</style>

<form name="articlistSelect" method="post" action="<?php print $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<table width="481" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="33" colspan="2" align="center"><span class="style1">List Article</span></td>
  </tr>
  <tr>
    <td height="19" align="center"><strong>SL</strong></td>
    <td height="19" align="left"><strong>Article Title </strong></td>
  </tr>
  <?php
    $rs=mysqli_query($con, "SELECT ContentID,Title FROM content_info WHERE  Title!='' AND ActiveStatus='Active' ORDER BY Title");
	$sl=0;
	while($row=mysqli_fetch_row($rs))
	{
  ?>
  <tr>
    <td width="59" height="22"><input type="checkbox" name="CID[]" id="checkbox" value="<?php print $row[0] ?>" /> <?php print ++$sl; ?></td>
    <td><?php print $row[1] ?></td>
  </tr>
 <?php
	}
 ?>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="btnSelect" id="button" value="Select" /></td>
  </tr>
</table>
</form>
