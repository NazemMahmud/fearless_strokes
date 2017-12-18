<?php
 session_start();
 include("connection.php");

 $recpos=isset($_REQUEST["recpos"])? $_REQUEST["recpos"]:"1";
					$count=($recpos-1)*20;
					$sl=$count;

					
	if(isset($_POST["btnSave"]))
	  {
	   $i=0;
	    $rs=mysqli_query($con, "SELECT ListID,orderid FROM menu_list_article WHERE MenuID='".$_REQUEST["MID"]."' ORDER BY orderid");
		while($row=mysqli_fetch_row($rs))
		{
		  $update=mysqli_query($con, "UPDATE menu_list_article SET orderid='".$_POST["order"][$i]."'  WHERE  ListID='".$row[0]."'"); 
		   $i++;
		}
		
		
	   
	   
	  }
	if(isset($_POST["btnInsert"]))
	{
	   $a=$_POST["CID"];
	  $counter=count($a);
	  for($i=0;$i<$counter;$i++)
	   {
	
	   $ListID=MakeID($con, "menu_list_article","ListID","LIST-",10);
	   $insert=mysqli_query($con, "INSERT INTO menu_list_article(ListID,ContentID,MenuID) VALUES('".$ListID."','".$a[$i]."','".$_REQUEST["MID"]."')");
	   }
	   
	}
	if(isset($_POST["btnDelete"]))
	{
	        
		 $a=$_POST["CID"];
	  $counter=count($a);
	  for($i=0;$i<$counter;$i++)
	   {
	   $delete=mysqli_query($con, "DELETE FROM menu_list_article WHERE ListID='".$a[$i]."' AND MenuID='".$_REQUEST["MID"]."'");
	   }	
			
			
			$rs=mysqli_query($con, "SELECT
    menu_list_article.ListID
    , content_info.Title
    , content_info.SubTitle
    , menu_list_article.orderid
	, content_info.PublishDate
FROM
    menu_list_article
    INNER JOIN content_info 
        ON (menu_list_article.ContentID = content_info.ContentID)
WHERE menu_list_article.MenuID='".$_REQUEST["MID"]."' ORDER BY menu_list_article.orderid "); 
	}
  if($_REQUEST["type"]=="view")
   {
     if($_REQUEST["txtsearch"]!="")
	       {
	    $TotalPage=mysqli_query($con, "SELECT
			COUNT(menu_list_article.ListID)
					FROM
			menu_list_article
			INNER JOIN content_info 
				ON (menu_list_article.ContentID = content_info.ContentID)
		WHERE menu_list_article.MenuID='".$_REQUEST["MID"]."' AND content_info.Title LIKE '%".$_REQUEST["txtsearch"]."%' ");
						  $sss=mysqli_fetch_row($TotalPage);
						 $TotalPagesss=$sss[0]/25;
						 $TotalPageRow=intval($TotalPagesss);
						   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
						   {
							$TotalPageRow=$TotalPageRow+1;    
						   }
						   else 
						   {
							   
						   }
		
					
		    $rs=mysqli_query($con, "SELECT
			menu_list_article.ListID
			, content_info.Title
			, content_info.SubTitle
			, menu_list_article.orderid
			, content_info.PublishDate
		FROM
			menu_list_article
			INNER JOIN content_info 
				ON (menu_list_article.ContentID = content_info.ContentID)
		WHERE menu_list_article.MenuID='".$_REQUEST["MID"]."' AND content_info.Title LIKE '%".$_REQUEST["txtsearch"]."%' 
		ORDER BY menu_list_article.orderid LIMIT $count,20"); 
	
	    }
	 else
	 {
	    $TotalPage=mysqli_query($con, "SELECT COUNT(ContentID) FROM menu_list_article WHERE MenuID='".$_REQUEST["MID"]."'");
						  $sss=mysqli_fetch_row($TotalPage);
						 $TotalPagesss=$sss[0]/25;
						 $TotalPageRow=intval($TotalPagesss);
						   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
						   {
							$TotalPageRow=$TotalPageRow+1;    
						   }
						   else 
						   {
							   
						   }
		
					
		    $rs=mysqli_query($con, "SELECT
			menu_list_article.ListID
			, content_info.Title
			, content_info.SubTitle
			, menu_list_article.orderid
			, content_info.PublishDate
		FROM
			menu_list_article
			INNER JOIN content_info 
				ON (menu_list_article.ContentID = content_info.ContentID)
		WHERE menu_list_article.MenuID='".$_REQUEST["MID"]."' ORDER BY menu_list_article.orderid LIMIT $count,20"); 
    }
   }
   if($_REQUEST["type"]=="insert")
   {
			if($_REQUEST["txtsearch"]!="")
	       {
	    $TotalPage=mysqli_query($con, "SELECT COUNT(ContentID) FROM content_info WHERE  ContentID not in(SELECT DISTINCT(ContentID) FROM menu_list_article
			 WHERE    MenuID='".$_REQUEST["MID"]."') 
		 AND Title LIKE '%".$_REQUEST["txtsearch"]."%' 
		AND ActiveStatus='Active' ORDER BY Title");
						  $sss=mysqli_fetch_row($TotalPage);
						 $TotalPagesss=$sss[0]/25;
						 $TotalPageRow=intval($TotalPagesss);
						   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
						   {
							$TotalPageRow=$TotalPageRow+1;    
						   }
						   else 
						   {
							   
						   }
		
					
		$rs=mysqli_query($con, "SELECT ContentID,Title,SubTitle,LinkType,PublishDate FROM content_info 
		WHERE ContentID not in(SELECT DISTINCT(ContentID) FROM menu_list_article
			 WHERE    MenuID='".$_REQUEST["MID"]."') 
		 AND Title LIKE '%".$_REQUEST["txtsearch"]."%' 
		AND ActiveStatus='Active' ORDER BY Title LIMIT $count,20");
	
	    }
		else
		{	
		
		 $TotalPage=mysqli_query($con, "SELECT COUNT(ContentID) FROM content_info WHERE  ContentID not in(SELECT DISTINCT(ContentID) FROM menu_list_article
			 WHERE    MenuID='".$_REQUEST["MID"]."') 
		 AND Title!='' 
		AND ActiveStatus='Active' ORDER BY Title");
						  $sss=mysqli_fetch_row($TotalPage);
						 $TotalPagesss=$sss[0]/25;
						 $TotalPageRow=intval($TotalPagesss);
						   if($TotalPageRow<$TotalPagesss || $TotalPageRow=='0')
						   {
							$TotalPageRow=$TotalPageRow+1;    
						   }
						   else 
						   {
							   
						   }
		
					
		$rs=mysqli_query($con, "SELECT ContentID,Title,SubTitle,LinkType,PublishDate FROM content_info 
		WHERE ContentID not in(SELECT DISTINCT(ContentID) FROM menu_list_article
			 WHERE    MenuID='".$_REQUEST["MID"]."') 
		 AND Title!='' 
		AND ActiveStatus='Active' ORDER BY Title LIMIT $count,20");
	  }
   }
  if($_REQUEST["type"]=="delete")
   {
    
   }
?>
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
.style3 {
	font-weight: bold;
	color: #FFFFFF;
}
.btnsdt11 {background-color:#F33;
			height:25px;
			padding:5px;
			line-height:10px;
			border-radious:5px;
			margin-top:0px;
			text-align:center;
			vertical-align:middle;
			color:#FFFFFF;
}
</style>

<form name="articlistSelect" method="post" action="<?php print $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<table width="799" height="auto" border="0" align="center" cellpadding="0" cellspacing="0" style="border: 2px solid #993333; ">
  <tr >
    <td height="33" colspan="4" align="center" >
	   <span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:18px;"><strong>List of Article</strong></span>
       <input type="hidden" name="type" value="<?php print $_REQUEST["type"]; ?>" />
      <input type="hidden" name="MID" value="<?php print $_REQUEST["MID"]; ?>" />    </td>
  </tr>

  <tr>
    <td height="25" colspan="4" align="right" ><strong>Search By Title</strong>:
      <input type="text" name="txtsearch" />
      <input type="submit" name="btnsearch" id="btnsearch" class="btnsdt11" value="GO" /></td>
  </tr>
  <tr>
    <td height="25" colspan="4" align="left" valign="top" >
	<div style="width:100%;  ">
						<div style="float:left; width:150px;margin-top:10px; margin-left:20px; vertical-align:middle;" align="left">
						<span>Page</span><span style="color:#FF0000;"> <?php print $recpos; ?></span> of <span style="color:#FF0000;">
						<?php print $TotalPageRow; ?> </span>						</div>
						<div style="float:right; width:450px; margin-top:10px; margin-right:2px; vertical-align:middle;" align="right"> 
						<span >Page: </span>
						<?php
		   if($recpos<4)
		   $recpos=4;
		   else if($recpos>=$TotalPageRow-3)
		   $recpos=$TotalPageRow-3;
		   //print $recpos;
		  $nxt=$recpos+3;
		  $pre=$recpos-3;
		  $li=0;
		  //$pl=$next+2;
         for($i=$pre;$i<=$nxt+1;$i++)
		 {
			$li++;
		  if($i==$TotalPageRow+1)
		  break;
		  
		  if($i>1 && $li==1)
		  {
		  ?>
						&nbsp;&nbsp;<span><a href="insert_delete_article_list.php?recpos=1&type=<?php print $_REQUEST["type"] ?>&MID=<?php print $_REQUEST["MID"] ?>&txtsearch=<?php print $_REQUEST["txtsearch"] ?>"  style="color:#FF0000;">Start</a> </span>
		  &nbsp;&nbsp;<span><a href="insert_delete_article_list.php?recpos=<?php print $i-1; ?>&type=<?php print $_REQUEST["type"] ?>&MID=<?php print $_REQUEST["MID"] ?>&txtsearch=<?php print $_REQUEST["txtsearch"] ?>" style="color:#FF0000;"><<</a></span>
		  <?php } ?>
		  <?php
		  if($li==7+1 && $i<=$TotalPageRow)
		  {
		  // $pl++;
		?>
        
		  &nbsp;&nbsp;<span><a href="insert_delete_article_list.php?recpos=<?php print $i; ?>&type=<?php print $_REQUEST["type"] ?>&MID=<?php print $_REQUEST["MID"] ?>&txtsearch=<?php print $_REQUEST["txtsearch"] ?>" style="color:#FF0000;">>></a></span>
     <?php }
	    if($li<=7 && $i>0)
	      { 
		  
		  //$pl++;
		  ?>
          
		  &nbsp;&nbsp;<span><a href="insert_delete_article_list.php?recpos=<?php print $i; ?>&type=<?php print $_REQUEST["type"] ?>&MID=<?php print $_REQUEST["MID"] ?>&txtsearch=<?php print $_REQUEST["txtsearch"] ?>" style="color:#FF0000;"><?php print $i; ?></a></span>
		<?php }}
		
		?>
        <?php
		 //print $pl;
		if(($i > 7) && ($TotalPageRow >= $nxt+1))
		{
		 ?>
       
		&nbsp;&nbsp;<span><a href="insert_delete_article_list.php?recpos=<?php print $TotalPageRow; ?>&type=<?php print $_REQUEST["type"] ?>&MID=<?php print $_REQUEST["MID"] ?>&txtsearch=<?php print $_REQUEST["txtsearch"] ?>" style="color:#FF0000;">End</a></span>
		<?php } ?>
		&nbsp;&nbsp;<span>
		</span></div>	</td>
    </tr>

  <tr>
    <td height="30" align="center" bgcolor="#000000" ><span class="style3">SL</span></td>
    <td width="464" height="30" align="left" bgcolor="#000000" ><span class="style3">Article Title</span></td>
    <td width="120" align="left" bgcolor="#000000" ><span class="style3">Publish Date </span></td>
    <td width="120" align="left" bgcolor="#000000" ><span class="style3">
	<?php
	 if($_REQUEST["type"]=="view")
	 {
	?> 
	Ordering
	<?php } ?>
	</span></td>
  </tr>
  <?php
    
	//$sl=0;
	while($row=mysqli_fetch_row($rs))
	{
	   ++$sl;
	   if($sl%2==0)
	    $bgcolor="bgcolor=\"#CCCCCC\"";
	   else
	   $bgcolor="bgcolor=\"#999999\"";
  ?>
  <tr <?php print $bgcolor; ?> >
    <td width="91" height="22" align="center"><input type="checkbox" name="CID[]" id="checkbox" value="<?php print $row[0] ?>" /> <?php print $sl; ?></td>
    <td><?php print $row[1] ?></td>
    <td><?php print substr($row[4],0,10); ?></td>
    <td>
	 <?php
	 if($_REQUEST["type"]=="view")
	 {
	?> 
	<input name="order[]" type="text" value="<?php print @$row[3] ?>" size="2" maxlength="2"/>
	<?php } ?>
	</td>
  </tr>
 <?php
	}
 ?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><?php
	 if($_REQUEST["type"]=="insert")
	 {
	?>
	       <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-02","add_option");
			 if($check_access=="yes")
			  {
			 ?>
      <input type="submit" name="btnInsert" id="button" class="btnsdt1" value="Insert" />
      <?php }  } ?>
	 <?php
	 if($_REQUEST["type"]=="view")
	 {
	?>         <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-02","delete_option");
			 if($check_access=="yes")
			  {
			 ?>
      <input type="submit" name="btnDelete" id="button" class="btnsdt1" value="Delete" />
	  
	  
      <?php }  ?>
	  <?php
			$check_access=check_access($con, $_SESSION["UserID"],"MOD-02","edit_option");
			 if($check_access=="yes")
			  {
			 ?>
      <input type="submit" name="btnSave" id="button" class="btnsdt1" value="Save" />
	  
	  
      <?php }  
	  
	  
	  
	  } ?>	  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
</form>
