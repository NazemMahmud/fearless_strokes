<?php
    	session_start();
		if(empty($_SESSION['UserName']) )
		{
		header("Location:index.php");
		die();
		}
	include("connection.php");
	$Date=MakeDate();

 
	if(isset($_POST["btnInsert"]))
	{
	   $a=$_POST["CID"];
	  $counter=count($a);
	  for($i=0;$i<$counter;$i++)
	   {
	   $insert=mysqli_query($con, "INSERT INTO faq_terms_pns_list_details (CatID,ContentID) VALUES('".$_REQUEST["CatID"]."','".$a[$i]."')");
	   }
      $activity_update=mysqli_query($con, "UPDATE faq_terms_pns_list SET UpdateDate='".$Date."',UpdateBy='".$_SESSION['UserID']."'
					  WHERE CatID='".$_REQUEST["CatID"]."'");
	}
	if(isset($_POST["btnDelete"]))
	{
	        
		 $a=$_POST["CID"];
	  $counter=count($a);
	  for($i=0;$i<$counter;$i++)
	   {
	   $delete=mysqli_query($con, "DELETE FROM faq_terms_pns_list_details WHERE ContentID='".$a[$i]."' AND CatID='".$_REQUEST["CatID"]."'");
	   }	
		$activity_update=mysqli_query($con, "UPDATE faq_terms_pns_list SET UpdateDate='".$Date."',UpdateBy='".$_SESSION['UserID']."'
					  WHERE CatID='".$_REQUEST["CatID"]."'");	
			
	}
  if($_REQUEST["vtype"]=="view")
   {
     $rs=mysqli_query($con, "SELECT
    content_info.ContentID
    , content_info.Title
    , content_info.SubTitle
FROM
    faq_terms_pns_list_details
    INNER JOIN content_info 
        ON (faq_terms_pns_list_details.ContentID = content_info.ContentID)
WHERE faq_terms_pns_list_details.CatID='".$_REQUEST["CatID"]."'"); 
   }
  else if($_REQUEST["vtype"]=="insert")
   {
			$rs=mysqli_query($con, "SELECT ContentID,Title FROM content_info WHERE ContentID not in(SELECT DISTINCT(ContentID) FROM                 faq_terms_pns_list_details
			 WHERE    CatID='".$_REQUEST["CatID"]."') 
		 AND Title!='' 
		AND ActiveStatus='Active' ORDER BY Title");
   }
  if($_REQUEST["vtype"]=="delete")
   {
    
   }
?>
<style type="text/css">
<!--
.style1 {
	font-size: 16px;
	font-weight: bold;
	color: #FFFFFF;
}
-->
</style>
<style type="text/css">
		.btnsdt
			{
			background-color:#F33;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
			color:#FFFFFF;
			}
		.btnsdt1 {background-color:#F33;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
			color:#FFFFFF;
}
.style2 {
	color: #FFFFFF;
	font-weight: bold;
}
</style>

<form name="articlistSelect" method="post" action="<?php print $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<table width="377" height="auto" border="0" align="center" cellpadding="0" cellspacing="0" style="border: 2px solid #993333; ">
  <tr >
    <td height="33" colspan="2" align="center" >
	   <span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px;">List Article</span>
      <input type="hidden" name="type" value="<?php print $_REQUEST["type"]; ?>" />
	  <input type="hidden" name="vtype" value="<?php print $_REQUEST["vtype"]; ?>" />
      <input type="hidden" name="CatID" value="<?php print $_REQUEST["CatID"]; ?>" />
    </td>
  </tr>
  <tr>
    <td height="19" align="center" >SL</td>
    <td width="286" height="19" align="left" >Article Title</td>
  </tr>
  <?php
    
	$sl=0;
	while($row=mysqli_fetch_row($rs))
	{
	   ++$sl;
	  /* if($sl%2==0)
	    $bgcolor="bgcolor=\"#CCCCCC\"";
	   else
	   $bgcolor="bgcolor=\"#999999\"";*/
  ?>
  <tr >
    <td width="87" height="22" align="center"><input type="checkbox" name="CID[]" id="checkbox" value="<?php print $row[0] ?>" /> <?php print $sl; ?></td>
    <td><?php print $row[1] ?></td>
  </tr>
 <?php
	}
 ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php
	 if($_REQUEST["vtype"]=="insert")
	 {
	?>
      <input type="submit" name="btnInsert" id="button" class="btnsdt1" value="Insert" />
      <?php } ?>
	 <?php
	 if($_REQUEST["vtype"]=="view")
	 {
	?>
      <input type="submit" name="btnDelete" id="button" class="btnsdt1" value="Delete" />
      <?php } ?> 
	  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
