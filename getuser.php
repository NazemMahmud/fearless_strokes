<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = $_GET['q'];
$qt = $_GET['qt'];
$u = $_GET['u'];

$con = mysqli_connect('localhost','root','','rollout_db');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"rollout_db");
$sql="SELECT * FROM product_details WHERE SerialNo = '".$q."'";
$result = mysqli_query($con,$sql);
$sql_name = mysqli_fetch_array(mysqli_query($con, "SELECT ProductName,Price FROM product_info WHERE SerialNo = '".$q."'"));
$unit = mysqli_fetch_array(mysqli_query($con, "SELECT UnitID,UnitName FROM product_unit WHERE UnitID = '".$u."'"));
echo "<table>
<tr>
<th>Product Name</th>
<th>Price</th>
<th>Size</th>

</tr>";
while($row = mysqli_fetch_array($result)) {
	//$unit = mysqli_fetch_array(mysqli_query($con, "SELECT UnitID,UnitName FROM product_unit WHERE UnitID = '".$u."'"));
    echo "<tr>";
    echo "<td>" . $sql_name[0] . "</td>"; // name
    echo "<td>" . $sql_name[1] . "</td>"; // price
    echo "<td>" . $unit[1] . "</td>"; // size
  
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>