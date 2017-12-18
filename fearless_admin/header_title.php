
					
					<!-- quick -->
					<ul id="quick" style="float:left; margin-left:2%;">
					  <?php
					   $check_primary=check_access_primary($con, $_SESSION["UserID"],"MOD-01");
					   if($check_primary=="yes")
					   {
					  ?>
<!--
				       <li>
					    <a href="#" title="Products"><span class="icon"></span><span>Settings</span></a>
						<ul >
						<li><a href="pepeelika_contact.php?left_menu=Settings">Roll Out Contact</a></li>
-->
<!--
						 <li><a href="#">Area Manage</a>
							<ul>
							<li><a href="insert_division.php?left_menu=Settings">Add Division</a></li>
							<li><a href="division_list.php?left_menu=Settings">Division List</a></li>
							<li><a href="insert_district.php?left_menu=Settings">Add District</a></li>
							<li><a href="district_list.php?left_menu=Settings">District List</a></li>
							<li><a href="insert_thana.php?left_menu=Settings">Add Upazila/Police Station</a></li>
							<li><a href="thana_list.php?left_menu=Settings">Upazila/Police Station List</a></li>
							<li><a href="insert_union.php?left_menu=Settings">Add Union/Sector Station</a></li>
							<li><a href="union_list.php?left_menu=Settings">Union/Sector List</a></li>
							<li><a href="insert_area.php?left_menu=Settings">Add Area</a></li>
							<li><a href="area_list.php?left_menu=Settings">Area List</a></li>
							
							</ul>
					      </li>
-->
						  
<!--						</ul>-->
					  </li>
					 <?php
					 }
   
                        $check_primary=check_access_primary($con, $_SESSION["UserID"],"MOD-04");
					   if($check_primary=="yes")
					   {
					  ?>
			<li><a href="" title="Pages"><span class="icon"></span><span>Product</span></a>
							<ul>
									<li>
										<a href="#" class="plus">Settings</a>
										<ul>
<!--
                                             <li ><a href="#" >Promotion Code</a>
											   <ul>
											      <li><a href="insert_promotion.php?left_menu=Product">Insert Promotion Code</a></li>
												  <li><a href="promotion_list.php?left_menu=Product">Promotion Code List</a></li>
												 
											   </ul>
						                     </li>
-->
                                          <li><a href="#">Product Style</a>
											   <ul>
											      <li><a href="product_style.php?left_menu=Product">Insert Product Style</a></li>
												  <li><a href="product_style_list.php?left_menu=Product">Product Style List</a></li>
												 
											   </ul>
											</li>
                                          <li><a href="#">Product Color</a>
											   <ul>
											      <li><a href="product_color.php?left_menu=Product">Insert Product Color</a></li>
												  <li><a href="product_color_list.php?left_menu=Product">Product Color List</a></li>
												 
											   </ul>
											</li>
										    <li><a href="#">Product Size</a>
											   <ul>
											      <li><a href="product_unit.php?left_menu=Product">Product Size</a></li>
												  <li><a href="product_unit_list.php?left_menu=Product">Product Size List</a></li>
												 
											   </ul>
											</li>
<!--
											<li><a href="#">Shipping & Billing Settings</a>
											   <ul>
												  <li><a href="ship_bil_update_msg.php?left_menu=Product">Shipping & Billing Update Msg</a></li>
												  <li><a href="order_complete_msg.php?left_menu=Product">Order Complete Msg</a></li>
											   </ul>
											</li>
										  
										    <li><a href="#">Payment Type Settings</a>
												<ul>
												<li><a href="insert_payment_type.php?left_menu=Product">Insert Payment Type</a></li>
												<li><a href="payment_type_list.php?left_menu=Product">Payment Type List</a></li>
												</ul>
											</li>
-->
										</ul>
								   </li>
								  <li><a href="product_category.php?left_menu=Product">Product Category Add</a></li> 
<!--
								<li><a href="product_sub_category.php?left_menu=Product">Product Sub Category Add</a></li>
								<li><a href="product_sub_sub_category.php?left_menu=Product">Product Sub Sub Category Add</a></li>
-->
								<li><a href="insert_product.php?left_menu=Product">Product Add</a></li>
<!--                                <li><a href="insert_product_occassional.php?left_menu=Product">Occassional Product Add</a></li>-->
								<li><a href="product_list.php?left_menu=Product">Product List</a></li>
								<li><a href="shippingcost.php?left_menu=Product">Shipping Cost</a></li>
								 <li><a href="#">Sales Manage</a>
								     <ul>
								     <li><a href="member_order_list.php?left_menu=Product">Order List </a></li>
									 </ul>
                                 </li>
							</ul>
						</li>
                        
<!--                                            for home junction                     -->
                        <li><a href="" title="Pages"><span class="icon"></span><span>Home Junction</span></a>
							<ul>
									<li>
										<a href="#" class="plus">Settings</a>
<!--
										<ul>

                                          <li><a href="#">Product Style</a>
											   <ul>
											      <li><a href="product_style.php?left_menu=Product">Insert Product Style</a></li>
												  <li><a href="product_style_list.php?left_menu=Product">Product Style List</a></li>
												 
											   </ul>
											</li>
                                          <li><a href="#">Product Color</a>
											   <ul>
											      <li><a href="product_color.php?left_menu=Product">Insert Product Color</a></li>
												  <li><a href="product_color_list.php?left_menu=Product">Product Color List</a></li>
												 
											   </ul>
											</li>
										    <li><a href="#">Product Size</a>
											   <ul>
											      <li><a href="product_unit.php?left_menu=Product">Product Size</a></li>
												  <li><a href="product_unit_list.php?left_menu=Product">Product Size List</a></li>
												 
											   </ul>
											</li>

										</ul>
-->
								   </li>
								  <li><a href="hj_category.php?left_menu=Product">Category Add</a></li> 

								<li><a href="insert_hj_product.php?left_menu=Product">Product Add</a></li>
								<li><a href="hj_product_list.php?left_menu=Product">Product List</a></li>
								<li><a href="shippingcost.php?left_menu=Product">Shipping Cost</a></li>
								 <li><a href="#">Sales Manage</a>
								     <ul>
								     <li><a href="member_order_list.php?left_menu=Product">Order List </a></li>
									 </ul>
                                 </li>
							</ul>
						</li>
						<?php
					 }
                       
                        $check_primary=check_access_primary($con, $_SESSION["UserID"],"MOD-06");
					   if($check_primary=="yes")
					   {
					  ?>
						<li>
					       <a href="" title="Links"><span class="icon"></span><span>User</span></a>
							
								   <ul>
								       <li><a href="usersetup.php?left_menu=User">User Add</a></li>
                                       <li><a href="userlist.php?left_menu=User">User List</a></li>
								   </ul>
								 
						</li>
                        <li>
					       <a href="" title="Links"><span class="icon"></span><span>Artist</span></a>
							
								   <ul>
<!--                                       <li><a href="artistsetup.php?left_menu=User">Artist Add</a></li>-->
                                       <li><a href="artistlist.php?left_menu=User">Artist List</a></li>
                                       <li><a href="artist_image_list?left_menu=User">Artist Primary Image List</a></li>
                                       <li><a href="artist_image_insert.php?left_menu=User">Artist Image Add</a></li>
                                       <li><a href="artist_images.php?left_menu=User">Artist Image List</a></li>
								   </ul>
								 
						</li>

                        <li>
                               <a href="#" title="Links"><span class="icon"></span><span>Slider Image</span></a>
                               <ul>
                                   <li><a href="banner_image_insert.php?left_menu=User">Add Slider Image</a></li>
                                   <li><a href="banner_image_list?left_menu=User">Slider Image List</a></li>
                               </ul>

                        </li>
						<?php
					 }
                       
//                        $check_primary=check_access_primary($con, $_SESSION["UserID"],"MOD-08");
//					   if($check_primary=="yes")
//					   {
					  ?>
<!--
					   <li><a href="#"><span class="icon"></span><span>Member</span></a>
							<ul>
                                 <li><a href="memberlist.php?left_menu=Member">Member List</a></li>
							</ul>
						</li>
-->

					  <?php //} ?>
					

					<?php
					 
                        $check_primary=check_access_primary($con, $_SESSION["UserID"],"MOD-09");
					   if($check_primary=="yes")
					   {
					  ?>
<!--
					 <li><a href="#feature"><span class="icon"></span><span>Slide Manage</span></a>
							<ul>
								<li><a href="insert_slide.php?left_menu=Slide">Slide Add</a></li>
				            	<li><a href="slide_list.php?left_menu=Slide">Slide List</a></li>
								
							</ul>
						    </li>
-->
					<?php
					 }
                       
                        $check_primary=check_access_primary($con, $_SESSION["UserID"],"MOD-11");
					   if($check_primary=="yes")
					   {
					  ?>	
<!--
							<li><a href="#feature"><span class="icon"></span><span>Special Manage</span></a>
							<ul>
								<li><a href="insert_special.php?left_menu=Special">Special Add</a></li>
				            	<li><a href="special_list.php?left_menu=Special">Special List</a></li>
								
							</ul>
						    </li>
-->
						<?php
					 }
                        $check_primary=check_access_primary($con, $_SESSION["UserID"],"MOD-12");
//					   if($check_primary=="yes")
//					   {
					  ?>
<!--
							<li><a href="#feature"><span class="icon"></span><span>Tab Details Manage</span></a>
							<ul>
								<li><a href="insert_paysizepaydelivery_details.php?left_menu=Paydet">Tab Details Add</a></li>
					            <li><a href="paydetails_list.php?left_menu=Paydet">Tab Details List</a></li>
								
							</ul>
						    </li>
-->
						<?php // } 
                        ?>


					 
					</ul>
					<!-- end quick -->

