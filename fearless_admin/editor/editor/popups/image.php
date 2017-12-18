
<script>
function getData(x)
{
	//alert(''+x);
var yyy="adminppl/contentimage/"+x;
//document.getElementById('txtcategoryid').value=yyy[0];
//document.getElementById('txtcategoryname').value=yyy[1];
//document.getElementById('txrcategorydescription').value=yyy[2];
window.opener.document.aaa.imageurl.value=yyy;
window.close();

}

</script>
<?php  
  include("../../../connection.php");
?>

<table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="27" height="25">&nbsp;</td>
    <td width="113">&nbsp;</td>
  </tr>
  <?php
  $prs=mysqli_query($con, "SELECT image_name FROM editor_image");
  while($prow=mysqli_fetch_row($prs))
  {
  ?>
  <tr>
    <td height="57">
    <input type="radio" name="radio" value="<?php print $prow[0]; ?>" id="radio" onclick="getData('<?php print $prow[0]; ?>');" />
    </td>
    <td><img src="../../../contentimage/<?php print $prow[0]; ?>" height="50" width="100"></td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <td height="19"><p><br />
      <br />
    </p></td>
    <td>&nbsp;</td>
  </tr>
</table>
