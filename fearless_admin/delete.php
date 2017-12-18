<?php
session_start();
if(empty($_SESSION['UserName']) )
{
	header("Location:index.php");
	die();
}

include("connection.php");

if($_REQUEST["type"]=="admin")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM user_admin WHERE UserID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE user_admin SET ActiveStatus='".$acinac."' where UserID='".$_GET['id']."'");

 header("Location:userlist.php?msg=User Successfully Updated!");
}
if($_REQUEST["type"]=="agent")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM agent_info WHERE AgentID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE agent_info SET ActiveStatus='".$acinac."' where AgentID='".$_GET['id']."'");

 header("Location:agentlist.php?msg=Agent Successfully Updated!");
}
if($_REQUEST["type"]=="pcat")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM product_category_info WHERE CategoryID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE product_category_info SET ActiveStatus='".$acinac."' where CategoryID='".$_GET['id']."'");

 header("Location:product_category_list.php?msg=Product Category Successfully Updated!");
}
if($_REQUEST["type"]=="product")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM product_info WHERE ProductID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE product_info SET ActiveStatus='".$acinac."' where ProductID='".$_GET['id']."'");

 header("Location:product_list.php?msg=Product Successfully Updated!");
}
if($_REQUEST["type"]=="phcat")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM photo_category WHERE PhotoCategoryID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE photo_category SET ActiveStatus='".$acinac."' where PhotoCategoryID='".$_GET['id']."'");

 header("Location:photo_category_list.php?msg=Photo Category Successfully Updated!");
}
if($_REQUEST["type"]=="photo")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM photo_gallery WHERE PhotoID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE photo_gallery SET ActiveStatus='".$acinac."' where PhotoID='".$_GET['id']."'");

 header("Location:photo_list.php?msg=Photo Successfully Updated!");
}
if($_REQUEST["type"]=="serv")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM service_category_info WHERE CategoryID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE service_category_info SET ActiveStatus='".$acinac."' where CategoryID='".$_GET['id']."'");

 header("Location:service_category_list.php?msg=Service Category Successfully Updated!");
}
if($_REQUEST["type"]=="service")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM service_info WHERE ServiceID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE service_info SET ActiveStatus='".$acinac."' where ServiceID='".$_GET['id']."'");

 header("Location:service_list.php?msg=Service Successfully Updated!");
}
if($_REQUEST["type"]=="member")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM member_info WHERE MemberID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE member_info SET ActiveStatus='".$acinac."' where MemberID='".$_GET['id']."'");

 header("Location:memberlist.php?msg=Member Successfully Edited!");
}
if($_REQUEST["type"]=="mcat")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM member_category WHERE CategoryID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE member_category SET ActiveStatus='".$acinac."' where CategoryID='".$_GET['id']."'");

 header("Location:member_category_list.php?msg=Member Category Successfully Updated!");
}
if($_REQUEST["type"]=="nlcat")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM newslatter_category WHERE CategoryID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE newslatter_category SET ActiveStatus='".$acinac."' where CategoryID='".$_GET['id']."'");

 header("Location:newsletter_category_list.php?msg=NewsLetter Category Successfully Updated!");
}
if($_REQUEST["type"]=="ocat")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM offers_category_info WHERE CategoryID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE offers_category_info SET ActiveStatus='".$acinac."' where CategoryID='".$_GET['id']."'");

 header("Location:offers_category_list.php?msg=Offers Category Successfully Updated!");
}
if($_REQUEST["type"]=="offer")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM offers_info WHERE OfferID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE offers_info SET ActiveStatus='".$acinac."' where OfferID='".$_GET['id']."'");

 header("Location:offer_list.php?msg=Offer Successfully Updated!");
}

if($_REQUEST["type"]=="ncat")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM news_category_info WHERE CategoryID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE news_category_info SET ActiveStatus='".$acinac."' where CategoryID='".$_GET['id']."'");

 header("Location:news_category_list.php?msg=Notice and Circulation Category Successfully Updated!");
}
if($_REQUEST["type"]=="news")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM news_info WHERE NewsID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE news_info SET ActiveStatus='".$acinac."' where NewsID='".$_GET['id']."'");

 header("Location:news_list.php?msg=Notice and Circulation Successfully Updated!");
}
if($_REQUEST["type"]=="ulcat")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM usefullink_category_info WHERE CategoryID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE usefullink_category_info SET ActiveStatus='".$acinac."' where CategoryID='".$_GET['id']."'");

 header("Location:usefullink_category_list.php?msg=Useful Link Catgeory Successfully Updated!");
}
if($_REQUEST["type"]=="link")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM useful_link WHERE LinkID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE useful_link SET ActiveStatus='".$acinac."' where LinkID='".$_GET['id']."'");

 header("Location:usefullink_list.php?msg=Useful Link Successfully Updated!");
}
if($_REQUEST["type"]=="slide")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM slide_info WHERE SlideID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE slide_info SET ActiveStatus='".$acinac."' where SlideID='".$_GET['id']."'");

 header("Location:slide_list.php?msg=Slide Successfully Updated...");
}
if($_REQUEST["type"]=="special")
{

    $rs=mysqli_query($con, "SELECT Activestatus FROM special_info WHERE SpecialID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE special_info SET Activestatus='".$acinac."' where SpecialID='".$_GET['id']."'");

 header("Location:special_list.php?msg=Special Successfully Updated...");
}
if($_REQUEST["type"]=="payday")
{

    $rs=mysqli_query($con, "SELECT Activestatus FROM paysizepaydelivery_details WHERE ID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE paysizepaydelivery_details SET Activestatus='".$acinac."' where ID='".$_GET['id']."'");

 header("Location:paydetails_list.php?msg=Successfully Updated...");
}
if($_REQUEST["type"]=="district")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM district_info WHERE DistrictID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE district_info SET ActiveStatus='".$acinac."' where DistrictID='".$_GET['id']."'");

 header("Location:district_list.php?msg=District Name Successfully Updated...");
}
if($_REQUEST["type"]=="area")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM area_info WHERE AreaID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE area_info SET ActiveStatus='".$acinac."' where AreaID='".$_GET['id']."'");

 header("Location:area_list.php?msg=Area Successfully Updated...");
}
if($_REQUEST["type"]=="division")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM division_info WHERE DivisionID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE division_info SET ActiveStatus='".$acinac."' where DivisionID='".$_GET['id']."'");

 header("Location:division_list.php?msg=Division Successfully Updated...");
}
if($_REQUEST["type"]=="thana")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM thana_info WHERE ThanaID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE thana_info SET ActiveStatus='".$acinac."' where ThanaID='".$_GET['id']."'");

 header("Location:thana_list.php?msg=Upazila/Police Station Successfully Updated...");
}

if($_REQUEST["type"]=="union")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM union_info WHERE unionID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE union_info SET ActiveStatus='".$acinac."' where unionID='".$_GET['id']."'");

 header("Location:union_list.php?msg=Union/Ward Successfully Updated...");
}

if($_REQUEST["type"]=="catplan")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM member_category_plan WHERE PlanID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE member_category_plan SET ActiveStatus='".$acinac."' where PlanID='".$_GET['id']."'");

 header("Location:member_category_plan_list.php?msg=Plan Successfully Updated...");
}
if($_REQUEST["type"]=="addcat")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM advertise_category WHERE AddCategoryID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE advertise_category SET ActiveStatus='".$acinac."' where AddCategoryID='".$_GET['id']."'");

 header("Location:add_category_list.php?msg=Advertise Category Successfully Updated...");
}
if($_REQUEST["type"]=="pscat")
{
    $catID=$_REQUEST["CategoryID"];
    $rs=mysqli_query($con, "SELECT ActiveStatus FROM product_sub_category WHERE SubCategoryID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE product_sub_category SET ActiveStatus='".$acinac."' where SubCategoryID='".$_GET['id']."'");

 header("Location:product_sub_category_list.php?msg=Product Sub Category Successfully Updated...&CategoryID=$catID");
}
if($_REQUEST["type"]=="sscat")
{
         $catID=$_REQUEST["CategoryID"];
    $rs=mysqli_query($con, "SELECT ActiveStatus FROM service_sub_category WHERE SubCategoryID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE service_sub_category SET ActiveStatus='".$acinac."' where SubCategoryID='".$_GET['id']."'");

 header("Location:service_sub_category_list.php?msg=Service Sub Category Successfully Updated...&CategoryID=$catID");
}
if($_REQUEST["type"]=="adclnt")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM advertise_client WHERE ClientID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE advertise_client SET ActiveStatus='".$acinac."' where ClientID='".$_GET['id']."'");

 header("Location:add_client_list.php?msg=Advertise Client Successfully Updated...");
}

if($_REQUEST["type"]=="pmtp")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM payment_type WHERE PaymentID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE payment_type SET ActiveStatus='".$acinac."' where PaymentID='".$_GET['id']."'");

 header("Location:payment_type_list.php?msg=Payment Type Successfully Updated...");
}
if($_REQUEST["type"]=="adacinac")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM advertisement_info WHERE AdID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE advertisement_info SET ActiveStatus='".$acinac."' where AdID='".$_GET['id']."'");

 header("Location:advertise_list.php?msg=Advertise Successfully Updated...");
}
if($_REQUEST["type"]=="article")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM content_info WHERE  ContentID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE content_info SET ActiveStatus='".$acinac."' where ContentID='".$_GET['id']."'");

 header("Location:article_list.php?msg=Article Successfully Updated...");
}
if($_REQUEST["type"]=="dcat")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM download_category WHERE CategoryID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE download_category SET ActiveStatus='".$acinac."' where CategoryID='".$_GET['id']."'");

 header("Location:download_category_list.php?msg=Successfully Updated Download Category...");
}
if($_REQUEST["type"]=="dload")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM download_element WHERE ElementID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE download_element SET ActiveStatus='".$acinac."' where ElementID='".$_GET['id']."'");

 header("Location:download_element_list.php?msg=Successfully Updated Download Element...");
}
if($_REQUEST["type"]=="faq")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM faq_list WHERE FAQID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE faq_list SET ActiveStatus='".$acinac."' where FAQID='".$_GET['id']."'");

 header("Location:faq_list.php?msg=Successfully Updated FAQ...");
}
if($_REQUEST["type"]=="hotnews")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM hotest_news WHERE HotNewsID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE hotest_news SET ActiveStatus='".$acinac."' where HotNewsID='".$_GET['id']."'");

 header("Location:hot_news_list.php?msg=Successfully Updated Hotest News...");
}
if($_REQUEST["type"]=="video")
{

    $rs=mysqli_query($con, "SELECT ActiveStatus FROM video_gallery WHERE VideoID='".$_GET['id']."'");
 $row=mysqli_fetch_row($rs);
 if($row[0]=="Active")
 {$acinac="InActive";}
 else
 {$acinac="Active";}
 mysqli_query($con, "UPDATE video_gallery SET ActiveStatus='".$acinac."' where VideoID='".$_GET['id']."'");

 header("Location:video_list.php?msg=Successfully Updated Video...");
}
?>   