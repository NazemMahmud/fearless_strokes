<?php 
	//session_start();
if(empty($_SESSION['UserName']) )
{
	header("Location:index.php");
	die();
}
 $_SESSION["LeftMenu"]=isset($_REQUEST["left_menu"])?$_REQUEST["left_menu"]:$_SESSION["LeftMenu"];

	?>
				
				<div id="menu" style="padding-bottom:10px;">
				<?php
//				 if($_SESSION["LeftMenu"]=="Settings")
//				 {
				   
				?>
<!--
				<h6 id="h-menu-settings" style=""><a href="#settings"><span>Settings</span></a></h6>
					<ul id="menu-settings" >
					    
						<li><a href="pepeelika_contact.php">Roll Out Contact</a></li>
					     <li class="collapsible"><a href="#" class="plus">Area Manage</a>
						  <ul >
						    <li><a href="insert_division.php">Add Division</a></li>
							<li><a href="division_list.php">Division List</a></li>
							<li><a href="insert_district.php">Add District</a></li>
							<li><a href="district_list.php">District List</a></li>
							<li><a href="insert_thana.php">Add Upazila/Police Station</a></li>
							<li><a href="thana_list.php">Upazila/Police Station List</a></li>
							<li><a href="insert_union.php">Add Union/Sector Station</a></li>
							<li><a href="union_list.php">Union/Sector List</a></li>
							<li><a href="insert_area.php">Add Area</a></li>
							<li><a href="area_list.php">Area List</a></li>
						  </ul>
						 </li>
						 
					</ul>
-->
			<?php //}
			
				 if($_SESSION["LeftMenu"]=="MenuArticle")
				 { 
				?>
				<h6 id="h-menu-menu"><a href="#menu"><span>Menu Management</span></a></h6>
					<ul id="menu-menu">
						<li><a href="insert_main_menu.php">Insert Menu</a></li>
                         <li class="collapsible">
							<a href="#" class="plus">Menu List</a>
							<ul>
						      <li><a href="main_menu_list.php?type=Top Left">Top Left</a></li>
                              <li><a href="main_menu_list.php?type=Top Right">Top Right</a></li>
							  <li><a href="main_menu_list.php?type=Main">Main</a></li>
							  <li><a href="main_menu_list.php?type=Bottom1 Left">Bottom1</a></li>
<!--							  <li><a href="main_menu_list.php?type=Bottom1 Right">Bottom1 Right</a></li>
							  <li><a href="main_menu_list.php?type=Bottom2 Left">Bottom2 Left</a></li>-->
							  <li><a href="main_menu_list.php?type=Bottom2 Right">Bottom2</a></li>
							  <li><a href="main_menu_list.php?type=Middle">Middle</a></li>
							</ul>
					</li>
					<li><a href="insert_sub_menu.php">Insert Sub Menu</a></li>
                       <li><a href="primary_submenu.php" >Sub Menu List</a></li>	
					<li><a href="insert_sub_sub_menu.php" >Insert Sub Sub Menu</a></li>
                       <li ><a href="primary_subsubmenu.php">Sub Sub Menu List</a></li>
					
					</ul>
					<?php } 
					
				  else if($_SESSION["LeftMenu"]=="User")
				 {
				?> 
				
					<h6 id="h-menu-products"><a href="#products"><span>User</span></a></h6>
					<ul id="menu-products">
						<li><a href="usersetup.php">User Add</a></li>
                        <li><a href="userlist.php">User List</a></li>
<!--                        <li><a href="artistsetup.php">Artist Insert</a></li>-->
                        <li><a href="artistlist.php">Artist List</a></li>
						
					
					</ul>
			 <?php  }


			else if($_SESSION["LeftMenu"]=="Member")
				 {
			 ?>
				 <h6 id="h-menu-member"><a href="#member"><span>Member</span></a></h6>
					<ul id="menu-member">
						
					    
                    	<li><a href="memberlist.php">Member List</a></li>
						
					</ul>
		<?php }

		else if($_SESSION["LeftMenu"]=="Product")
				 {
		?>		
                 <h6 id="h-menu-product"><a href="#product"><span>Product</span></a></h6>
				    <ul id="menu-product">
<!--
                        <li class="collapsible">
                            <a href="#" class="plus">Promotion Code</a>
							<ul>
                                <li><a href="insert_promotion.php?left_menu=Product">Insert Promotion Code</a></li>
                                <li><a href="promotion_list.php?left_menu=Product">Promotion Code List</a></li>								 
                            </ul>
						</li>
-->
                        <li class="collapsible">
                            <a href="#" class="plus">Product Style</a>
							<ul>
                                <li><a href="product_style.php?left_menu=Product">Insert Product Style</a></li>
								<li><a href="product_style_list.php?left_menu=Product">Product Style List</a></li>
                            </ul>
						</li>
                         <li class="collapsible">
                            <a href="#" class="plus">Product Color</a>
							<ul>
                                <li><a href="product_color.php?left_menu=Product">Insert Product Color</a></li>
                                <li><a href="product_color_list.php?left_menu=Product">Product Color List</a></li>
                             </ul>
						  </li>
					    <li class="collapsible">
							<a href="#" class="plus">Product Size </a>
							<ul>
						      <li><a href="product_unit.php">Product Size</a></li>
                              <li><a href="product_unit_list.php">Product Size List</a></li>
							</ul>
					   </li>
<!--
					    <li class="collapsible">
							<a href="#" class="plus">Shipping & Billing </a>
							<ul>
							  <li><a href="ship_bil_update_msg.php">Shipping & Billing Update Msg</a></li>
							  <li><a href="order_complete_msg.php">Order Complete Msg</a></li>
							</ul>
					   </li>
-->
<!--
					    <li class="collapsible">
							<a href="#" class="plus">Payment Type </a>
							<ul>
						      <li><a href="insert_payment_type.php">Insert Payment Type</a></li>
					          <li><a href="payment_type_list.php">Payment Type List</a></li>
							</ul>
					   </li>
-->
					   <li><a href="product_category.php">Product Category Add</a></li>
                    	 <li><a href="product_category_list.php">Product Category List</a></li>
<!--						<li><a href="product_sub_category.php">Product Sub Category Add</a></li>-->
                        <!--<li><a href="product_sub_category_list.php">Product Sub Category List</a></li>-->
<!--						<li><a href="product_sub_sub_category.php">Product Sub Sub Category Add</a></li>-->
                        <!--<li><a href="primary_product_sub_sub_category_list.php">Product Sub Sub Category List</a></li>-->
						<li><a href="insert_product.php">Product Add</a></li>
<!--                        <li><a href="insert_product_occassional.php">Occassional Product Add</a></li>-->
                        <li><a href="product_list.php">Product List</a></li>
						<li class="collapsible">
							<a href="#" class="minus">Sales Manage</a>
                             <ul>
                                <li><a href="member_order_list.php">Order List </a></li>
                             </ul>
						</li>
					</ul>
			<?php }
		     else if($_SESSION["LeftMenu"]=="NewsLetter")
				 {
		          
		?>
					  <h6 id="h-menu-newsletter"><a href="#newsletter"><span>News Letter</span></a></h6>
					<ul id="menu-newsletter">
					<li><a href="newsletter_category.php">Category Add</a></li>
					<li><a href="newsletter_category_list.php">Category List</a></li>
					<li><a href="insert_newsletter.php">NewsLetter Add</a></li>
					<li><a href="newsletter_list.php">NewsLetter List</a></li>	
					</ul>
		<?php  }
		   else if($_SESSION["LeftMenu"]=="HotestNews")
				 {
		 ?>
					<h6 id="h-menu-hotestnews"><a href="#hotestnews"><span>Hotest News</span></a></h6>
					<ul id="menu-hotestnews">
					<li><a href="insert_hot_news.php">Insert News</a></li>
					<li><a href="hot_news_list.php">News List</a></li>
					</ul>
		<?php } 

		else if($_SESSION["LeftMenu"]=="Slide")
				 {
		 ?>			
						 <h6 id="h-menu-sdt3"><a href="#sdt3"><span>Slide Manage</span></a></h6>
					<ul id="menu-sdt3">
					<li><a href="insert_slide.php">Slide Add</a></li>
					<li><a href="slide_list.php">Slide List</a></li>
					
					
					</ul>
			<?php }
			
			else if($_SESSION["LeftMenu"]=="Special")
				 {
					 ?>
<!--
							 <h6 id="h-menu-sdt3"><a href="#sdt3"><span>Special Manage</span></a></h6>
					<ul id="menu-sdt3">
					<li><a href="insert_special.php">Special Add</a></li>
					<li><a href="special_list.php">Special List</a></li>
					
					
					</ul>
-->
					<?php }
					else if($_SESSION["LeftMenu"]=="Paydet")
				 	{
					 ?>
                     <h6 id="h-menu-sdt3"><a href="#sdt3"><span>Tab Details Manage</span></a></h6>
					<ul id="menu-sdt3">
					<li><a href="insert_paysizepaydelivery_details.php">Tab Details Add</a></li>
					<li><a href="paydetails_list.php">Tab Details List</a></li>

					
					</ul>
                     <?php }
				else if($_SESSION["LeftMenu"]=="none")
				{
				 ?>
				  <h6 id="h-menu-sdtadd"><a href="#sdtadd"><span>Browse By Index Link</span></a></h6>
					<ul id="menu-sdtadd">
					<?php
					   $check_primary=check_access_primary($con, $_SESSION["UserID"],"MOD-01");
					   if($check_primary=="yes")
					   {
					  ?>
<!--					<li><a href="pepeelika_contact.php?left_menu=Settings">--><?php //$site_name ; ?><!-- Contact</a></li>-->
					<?php
					} 
					   
					   $check_primary=check_access_primary($con, $_SESSION["UserID"],"MOD-04");
					   if($check_primary=="yes")
					   {
					  ?>
					<li><a href="insert_product.php?left_menu=Product">Product Add</a></li>
					<?php
					} 
					  
					   $check_primary=check_access_primary($con, $_SESSION["UserID"],"MOD-06");
					   if($check_primary=="yes")
					   {
					  ?>
					<li><a href="usersetup.php?left_menu=User">User Add</a></li>
					<?php
					} 
					  
					   $check_primary=check_access_primary($con, $_SESSION["UserID"],"MOD-08");
					   if($check_primary=="yes")
					   {
					  ?>
<!--					<li><a href="memberlist.php?left_menu=Member">Member List</a></li>-->
					<!--<li><a href="member_category_plan.php?left_menu=Plan">Member Plan</a></li>-->
					<?php
					} 
					   $check_primary=check_access_primary($con, $_SESSION["UserID"],"MOD-09");
					   if($check_primary=="yes")
					   {
					  ?>
<!--					<li><a href="insert_slide.php?left_menu=Slide">Slide Add</a></li>-->
					<?php
					} 
					 } ?>
				</div>