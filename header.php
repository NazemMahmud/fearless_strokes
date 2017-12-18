<header>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 hidden-xs">
                <a href="index"><img src="assets/images/logo.png" class="img-responsive" alt=""></a>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div id="custom-search-input">
                            <form action="searchres" method="post">
                                <div class="input-group col-md-12">
                                    <input type="text" name="search_name" class="form-control input-sm" placeholder="Search" />
                                    <span class="input-group-btn">
                                        		<button class="btn btn-info btn-sm" type="button">
                                            			<i class="glyphicon glyphicon-search"></i>
                                        		</button>
                        			</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1 col-md-offset-2 col-sm-3">
                <ul style="">
                    <!--
                                            <li><a href="">Join</a></li>
                                            <li><a href="">Sign In</a></li>
                    -->
                </ul>
                <!--                    <div class="clearfix hidden-xs"></div>-->
                <!--
                                    <select type="text" class="form-control multiselect multiselect-icon" role="multiselect">
                                        <option value="0" data-icon="fa fa-usd" >USD</option>
                                        <option value="1" data-icon="fa fa-eur">Euro</option>
                                        <option value="2" data-icon="fa fa-money" selected="selected">BDT</option>
                                    </select>
                -->
                <button type="button" class="multiselect dropdown-toggle btn btn-default btn-sm" data-toggle="dropdown" style="width: auto;" title="BDT"><span class="glyphicon fa fa-money"></span> BDT</button>


            </div>
        </div>
    </div>
</header>

<nav class="navbar navbar-default navbar-static">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="assets/images/logo.png" class="img-responsive" alt="" width="75"></a>
            </div>

            <div class="collapse navbar-collapse js-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index"><i class="fa fa-home"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Category <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-cart dropdown-content" role="menu">
                            <?php
                            $sql=mysqli_query($con, "SELECT CategoryID,CategoryName FROM product_category_info WHERE ActiveStatus='Active' ORDER BY orderid");
                            $sl=0;
                            while($row=mysqli_fetch_row($sql)){
                                ?>
                                <li class=""><a href="product?id=<?php echo $row[0]; ?>"><strong><?php echo $row[1]?></strong></a></li>
                                <?php
                            }
                            ?>
                        </ul>

                    </li>



                    <!--
                                            <li class=""><a href="tote_bags.php">Tote Bags</a></li>
                                            <li class=""><a href="throw_pillows.php">Throw Pillows</a></li>
                                            <li class=""><a href="t_shirts.php">T-Shirts</a></li>
                                            <li class=""><a href="mugs.php">Mugs</a></li>
                                            <li class=""><a href="note_books.php">Note Books</a></li>
                    -->
                    <!--                        <li class=""><a href="artist.php">Artist</a></li>-->
                    <!--<li class="dropdown dropdown-large">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Women <b class="caret"></b></a>

                        <ul class="dropdown-menu dropdown-menu-large row">
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Glyphicons</li>
                                    <li><a href="#">Available glyphs</a></li>
                                    <li class="disabled"><a href="#">How to use</a></li>
                                    <li><a href="#">Examples</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Dropdowns</li>
                                    <li><a href="#">Example</a></li>
                                    <li><a href="#">Aligninment options</a></li>
                                    <li><a href="#">Headers</a></li>
                                    <li><a href="#">Disabled menu items</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Button groups</li>
                                    <li><a href="#">Basic example</a></li>
                                    <li><a href="#">Button toolbar</a></li>
                                    <li><a href="#">Sizing</a></li>
                                    <li><a href="#">Nesting</a></li>
                                    <li><a href="#">Vertical variation</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Button dropdowns</li>
                                    <li><a href="#">Single button dropdowns</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Input groups</li>
                                    <li><a href="#">Basic example</a></li>
                                    <li><a href="#">Sizing</a></li>
                                    <li><a href="#">Checkboxes and radio addons</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Navs</li>
                                    <li><a href="#">Tabs</a></li>
                                    <li><a href="#">Pills</a></li>
                                    <li><a href="#">Justified</a></li>
                                </ul>
                            </li>

                        </ul>

                    </li>
                    <li class="dropdown dropdown-large">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Men <b class="caret"></b></a>

                        <ul class="dropdown-menu dropdown-menu-large row">

                        </ul>
                    </li>-->
                </ul>
                <!--for style category -->
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Style <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-cart dropdown-content" role="menu">
                            <?php
                            $sql=mysqli_query($con, "SELECT StyleID, StyleName from product_style ORDER BY StyleID asc");
                            $sl=0;
                            while($row=mysqli_fetch_row($sql)){
                                ?>
                                <li class=""><a href="style?id=<?php echo $row[0]; ?>"><strong><?php echo $row[1]?></strong></a></li>
                                <?php
                            }
                            ?>
                        </ul>

                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="aboutus">About Us</a></li>
                    <li><a href="#">Help</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"></span>
                            Items <span id="cartcount">
                                 <?php
                                 if(isset($_SESSION["cart_item"]) && count($_SESSION["cart_item"])>0){
                                     echo '- '.count($_SESSION["cart_item"]);
                                 }else{
                                     echo '';
                                 }
                                 ?>
                             </span>
                            <span class="caret"></span></a>
                        <div id="shopping_cart_results"></div>
                        <?php
                        if(isset($_SESSION["cart_item"]) && count($_SESSION["cart_item"])>0 ){ ?>
                            <ul class="dropdown-menu dropdown-cart dropdown-content" role="menu">
                                <?php if(count($_SESSION["cart_item"])>0)
                                {
                                    foreach ($_SESSION["cart_item"] as $item){
                                        ?>
                                        <li>
                                              <span class="item">
                                                <span class="item-left">
                                                    <?php
                                                    if($item['type'] == 1){ ?>
                                                        <img src="productimage/<?php echo $item["image"];?>" alt="" style="width:50px; height:50px;"/>
                                                    <?php    }else{ ?>
                                                        <img src="productimage/hj/<?php echo $item["image"];?>" alt="" style="width:50px; height:50px;"/>
                                                    <?php    }
                                                    ?>

                                                    <span class="item-info">
                                                        <span><?php echo $item["name"];?></span>
                                                        <span><?php echo $item["price"]*$item["quantity"];?>tk</span>
                                                        <span>Qty: <?php echo $item["quantity"];?></span>
                                                    </span>
                                                </span>
                                                <span class="item-right">
                                                    <button class="btn btn-xs btn-danger pull-right singleCartRemove" data-code="<?php echo $item['type'].$item['code'];?>">x</button>
                                                    <!--                                                    onclick="singleCartRemove('remove')"-->
                                                </span>
                                            </span>
                                        </li>
                                    <?php }
                                } ?>
                                <li class="divider"></li>
                                <li><a class="text-center" href="viewcart">View Cart</a></li>
                            </ul>
                        <?php  }
                        ?>
                        <!--

                                                              <li>
                                                                  <span class="item">
                                                                    <span class="item-left">
                                                                        <img src="assets/images/product/the-unicorn-is-reading-bags50-50.jpg" alt="" />
                                                                        <span class="item-info">
                                                                            <span>Item name</span>
                                                                            <span>23$</span>
                                                                        </span>
                                                                    </span>
                                                                    <span class="item-right">
                                                                        <button class="btn btn-xs btn-danger pull-right">x</button>
                                                                    </span>
                                                                </span>
                                                              </li>
                        -->


                    </li>

                </ul>
            </div><!-- /.nav-collapse -->
        </div>
    </div>
</nav>
<nav class="navbar-default navbar-static">
    <div class="container">
        <div class="row">
            <div class="collapse navbar-collapse js-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="row top-left-message" style="background:#fff">
                        <div class="col-sm-3">
                            <!--                        <button class="btn btn-sm">T-Shirts <i class="fa fa-chevron-right"></i></button>-->
                        </div>
                        <div class="col-sm-6">
                            <!--                         <h5>WIN UP TO 60%</h5>-->
                        </div>
                        <div class="col-sm-3">
                            <!--                        <button class="btn btn-sm pull-right">Mugs <i class="fa fa-chevron-right"></i></button>-->
                        </div>
                    </li>
                </ul>
                <!--            ................... for artist login registration start ....................................-->
                <ul class="nav navbar-nav navbar-right " >
                    <!--                        <li><a href="home_junctions">Home Junction</a></li>-->
                    <li class="dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Artists <span class="caret"></span></a>

                        <ul class="dropdown-menu dropdown-cart dropdown-content" role="menu" style="min-width: 150px; font-size:15px;" >
                            <li> <a href="artists" >Artist</a>  </li>
                            <?php
                            if(empty($_SESSION['MemberEmail']) ){ ?>
                                <li> <a href="#" data-toggle="modal" data-target="#loginModal">Sign In</a> </li>
                                <li> <a href="#" data-toggle="modal" data-target="#registrationModal">Register</a> </li>
                            <?php } else if(!empty($_SESSION['MemberEmail'])){ ?>
                                <li> <a href="logout" data-toggle="" data-target="">Sign Out</a> </li>
                                <li> <a href="account?id=<?php echo $_SESSION['MemberId'];?>" data-toggle="" data-target="">
                                        <?php echo  $_SESSION['MemberName']; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="home_junctions">Alokito Hridoy Foundation</a></li>

                </ul>
            </div>

            <!--Modal for Login-->

            <div class="modal fade" id="loginModal" role="dialog" style="display: none;">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content" style="top:180px;">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body" style="min-height: 235px;" >
                            <div class="">
                                <h2 style="text-align:center;">Sign In</h2>
                                <form class = "pure-form" action="login_submit" method="post">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input id="" type="text" class="form-control" name="cust_email" placeholder="Email Address" required>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input id="password" type="password" name="cust_password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <br>

                                    <!-- <input name="to_mail" style="float:right; border-radius:0px;" type="hidden" class="btn btn-danger" value="servicedesk@augere.com.bd"> -->
                                    <button style="float:right;" type="submit" class="pure-button pure-button-primary btn btn-success">SUBMIT</button>

                                </form>
                                <a style="float:left;color:red;" href="" data-toggle="modal" data-target="#forgetModal" class="">Forget Password?</a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal for Login Ends-->

            <!--model for forget password start-->

            <div class="modal fade" id="forgetModal" role="dialog" style="display: none;">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content" style="top:180px;">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body" style="min-height: 235px;" >
                            <div class="">
                                <h2 style="text-align:center;">Reset Password</h2>
                                <form class = "pure-form" action="reset_password_data" method="post">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input id="" type="text" class="form-control" name="cust_email" placeholder="Enter your Email" required>
                                    </div>
                                    <br>
                                    <button style="float:right;" type="submit" class="pure-button pure-button-primary btn btn-success">SUBMIT</button>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <!--model for forget password ends-->

            <!--modal for registration starts-->
            <div class="modal fade" id="registrationModal" role="dialog" style="display: none;">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content" style="top:180px;">

                        <div class="modal-body" style="height: 450px;" >
                            <div class="">
                                <h2 style="text-align:center;">Register</h2>
                                <form class = "pure-form" action="regis_submit" method="post">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="" type="text" class="form-control" name="cust_name" placeholder="Your Name" required>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input id="" type="text" class="form-control" name="cust_email" placeholder="Email Address" required>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input id="" type="text" class="form-control" name="cust_number" placeholder="Contact No." required>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input id="passwordd" type="password"  class="form-control" placeholder="Password" required>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input id="confirm_password" type="password" class="form-control" name="cust_password" placeholder="Confirm Password" required>
                                    </div>
                                    <br>

                                    <!-- <div class="form-group">
                                        <textarea class="form-control" rows="5" id="comment" name="cust_message" placeholder="Your Message"></textarea>
                                    </div> -->
                                    <!-- <input name="to_mail" style="float:right; border-radius:0px;" type="hidden" class="btn btn-danger" value="servicedesk@augere.com.bd"> -->
                                    <button style="float:right;" type="submit" class="pure-button pure-button-primary btn btn-success">SUBMIT</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--modal for registration ends-->

            <!-- Alif scripts body for registration starts from here-->
            <script>
                var password = document.getElementById("passwordd")
                    , confirm_password = document.getElementById("confirm_password");

                function validatePassword(){
                    if(password.value != confirm_password.value) {
                        confirm_password.setCustomValidity("Passwords Don't Match");
                    } else {
                        confirm_password.setCustomValidity('');
                    }
                }

                password.onchange = validatePassword;
                confirm_password.onkeyup = validatePassword;
            </script>
            <!-- Alif scripts body for registration starts from here-->
            <!--         	<div class="col-md-8">-->
            <!--           		<div class="row top-left-message" style="background:#fff">-->
            <!--
                                <div class="col-sm-3">
                                    <button class="btn btn-sm">T-Shirts <i class="fa fa-chevron-right"></i></button>
                                </div>
                                <div class="col-sm-6">
                                    <h5>WIN UP TO 60%</h5>
                                </div>
                                <div class="col-sm-3">
                                     <button class="btn btn-sm pull-right">Mugs <i class="fa fa-chevron-right"></i></button>
                                </div>
            -->
            <!--
                            </div>
                        </div>
            -->

        </div>
    </div>
</nav>
</div>