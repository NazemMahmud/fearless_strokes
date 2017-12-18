<?php

include("fearless_admin/connection.php");

//CategoryName,CategoryDescrition  from product_category_info where CategoryID='".$cat_id."' ");
//$cat_id = $_REQUEST["CatId"];
//$sql = mysqli_fetch_row(mysqli_query($con, "SELECT CategoryName,CategoryDescrition  from product_category_info where CategoryID='".$cat_id."' "));
//
//
//$product_id = $_REQUEST["Productid"];
//$sql_product = mysqli_fetch_row(mysqli_query($con, "SELECT ProductID,ProductName,Features, orderid,ActiveStatus,Price,ShippingCost,SerialNo
//                               FROM product_info
//                               WHERE SerialNo='".$_REQUEST["Serial"]."' AND ProductID='".$product_id."' "));
//
//$sql_productfullid = mysqli_query($con, "SELECT ProductFullID,SerialNo,Qty, Available
//                               FROM product_details
//                               WHERE SerialNo='".$_REQUEST["Serial"]."' ");
//
////for size 
////$sql_size=
////for image
//$sqlimage = mysqli_fetch_row(mysqli_query($con, "SELECT ImageID, ProductID,BigImage,MidImage,SmallImage,SerialNo
//                               FROM product_image
//                               WHERE ProductID='".$product_id."' AND SerialNo='".$_REQUEST["Serial"]."'"));
//                                
//// for artist name
//$artistid = substr($product_id[0],-4);
//$sqlartist = mysqli_fetch_row( mysqli_query($con, "SELECT id, artist_name FROM artist WHERE id='".$artistid."' "));
//
//	$parent_cat=mysqli_fetch_row(mysqli_query($con, "SELECT
//    product_ssub_category.SubCategoryID
//    , CONCAT(product_category_info.CategoryName,' > <br>'
//    , product_sub_category.SubCategoryName,' > <br>'
//    , product_ssub_category.SubCategoryName)
//FROM
//    product_ssub_category
//    INNER JOIN product_sub_category 
//        ON (product_ssub_category.SubCategoryID = product_sub_category.SubCategoryID)
//    INNER JOIN product_category_info 
//        ON (product_sub_category.CategoryID = product_category_info.CategoryID)
//WHERE product_ssub_category.SubSubCategoryID='".$_REQUEST["SubSubCategoryID"]."'"));
?>
<html>
    <body>
        <?php
        $sno= 257;
$sql = mysqli_fetch_row(mysqli_query($con, "SELECT product_info.ProductID, product_info.ProductName, product_info.Price, product_info.SerialNo,
                                    product_image.SmallImage,
                                    product_details.ProductFullID, product_details.Qty,
                                   
                                FROM
                                    product_info INNER JOIN product_image 
                                    ON (product_info.SerialNo = product_image.SerialNo)
                                    INNER JOIN product_details 
                                    ON (product_image.SerialNo = product_details.SerialNo)
                                    
                                where product_info.SerialNo='".$sno."' and product_details.SerialNo"));
//        while($row=mysqli_fetch_row($sql))
//        {
            ?>
        <ul>
            <li><?php echo $row[1]?></li>
            <li><?php echo $row[2]?></li>
<!--
            <li><?php echo $row[6]?></li>
            <li><?php echo $row[1]?></li>
-->
        </ul>
        <?php
//        }
        ?>
        
    </body>
</html>