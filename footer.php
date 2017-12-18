<footer>
    <div class="footer-links">
        <div class="col-md-6 col-sm-6">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-md-offset-7 col-sm-offset-7">
                    <ul>
                        <li> <h2>What's in store</h2> </li>
                            <?php
                                 $sql=mysqli_query($con, "SELECT CategoryID,CategoryName FROM product_category_info WHERE ActiveStatus='Active' ORDER BY orderid");
                                 $sl=0;
                                 while($row=mysqli_fetch_row($sql)){
                            ?>
                                    <li class=""><a href="product?id=<?php echo $row[0]; ?>"><?php echo $row[1]?></a></li>
                             <?php }  ?>                               
                            </ul>
                </div>
            </div>	
        </div>
                 <div class="col-md-6 col-sm-6">
                    <div class="row">
                        <div class="col-sm-4">
                            <ul>
                                <li>
                                    <h2>Follow Fearless Strokes</h2>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.facebook.com/fstrokes/">Facebook</a>
                                </li>
                                <li>
                                    <a href="#">Twitter</a>
                                </li>
                                <li>
                                    <a href="#">YouTube</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                 </div>
            </div>     
            
<!--            <hr>-->
            
            <div class="row">
            	<div class="col-sm-12 disclaimer">
                	<div class="col-sm-12">
                        <div class="links">        
                            <ul>
                                       
<!--                                <li class="first"><a href="#">Privacy &amp; Cookies</a></li>-->
                                <li><a href="terms">Terms &amp; Conditions</a></li>
                                <li><a href="contactus">Contact us</a></li>
                                <li><a href="faq">FAQ</a></li>

                            </ul>
                            <p>The celebrities named or featured on fearlessstrokes.com have not endorsed recommended or approved the items offered on site</p>
                        </div>
                        <div class="legal">            
                            <p class="copyright">&copy;2017 Fearless Strokes.com | All rights reserved | Powered By Alokito Hridoy Foundation</p>
                        </div>
        			</div>
                </div>
            </div>
        </footer>