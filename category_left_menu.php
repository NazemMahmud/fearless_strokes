<div id="filter" class="col-md-3">
<!--
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Tutorials
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">HTML</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">CSS</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">JavaScript</a></li>
                      <li role="presentation" class="divider"></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">About Us</a></li>
                    </ul>
                  </div>
-->
<!--
                <div class="btn-group">
                  <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Large button
                  </button>
                  <button type="button" class="btn btn-lg btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu">
                    ...
                  </div>
                </div>
-->
                
<!--                <div class="panel panel-default">-->
                    
                    <div class="dropdown-wrapper ">

                        <select class="dropdown-btn btn-secondary drpdwn" style="font-weight: bold;" onchange="location = this.value;">
                            <option value="">Select Category</option>
                            <?php
                            $sql=mysqli_query($con, "SELECT CategoryID,CategoryName FROM product_category_info WHERE ActiveStatus='Active' ORDER BY orderid LIMIT 5 ");
                            $sl=0;
                            while($row=mysqli_fetch_row($sql)){
                        ?>
<!--                                <li class=""><a href="product.php"></a></li>-->
                                <option value="product?id=<?php echo $row[0]; ?>"><?php echo $row[1]?></option>
                            <?php
                        }
                        ?>
<!--
                            <option value="product.php">Throw Pillows</option>
                            <option value="product.php">Throw Pillows</option>
                            <option value="product.php">T-Shirts</option>
                            <option value="product.php">Mugs</option>
                            <option value="product.php">Notebooks</option>
-->
                        </select>

                    </div>
<!--                </div>-->
                
                
<!--            	<div class="panel panel-default" style="margin-top: 5px;">-->
<!--                    <div class="panel-heading">-->
<!--                        <strong>COLORS</strong>-->
<!--                    </div>-->
<!--                    <div class="color-ctrl">-->
                
                        
<!--
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="">
                              <div class="colour" style="background-color: gray"></div>
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> <div class="colour" style="background-color: purple"></div>
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Cardigans
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Coats
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Dresses
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Hoodies
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jackets
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jeans
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jersey Tops
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jumpers
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jumpsuits
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jumpsuits & Playsuits
                          </label>
                        </div>
-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="color-ctrl">-->
<!--                        <ul>-->
<!--                            <li style="background-color:gray;"></li>-->
<!--                            <li style="background-color:purple;"></li>-->
<!--                            <li style="background-color:green;"></li>-->
<!--                            <li style="background-color:red;"></li>-->
<!--                            <li style="background-color:yellow;"></li>-->
<!--                            <li style="background-color:orange;"></li>-->
<!--                        </ul>-->
<!--                </div>-->
                
<!--
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Size</strong>
                    </div>
                    <div class="panel-body">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Beachwear
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Blazers
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Cardigans
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Coats
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Dresses
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Hoodies
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jackets
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jeans
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jersey Tops
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jumpers
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jumpsuits
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jumpsuits & Playsuits
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Leggings
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Lingerie
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Nightwear
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Playsuits
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Shirts
                          </label>
                        </div>
                    </div>
                </div>
-->
                
<!--
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Price Range</strong>
                    </div>
                    <div class="panel-body">
                        <div id="slider-range" style="margin-top:15px"></div>                        
   						<p>
                            <input type="text" id="amount" readonly style="border:0; color:#f6931f; text-align:center; width:100%; margin-top:15px;">  
                        </p>

                    </div>
                </div>
-->
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>FILTER BY</strong>
                    </div>
                    <div class="panel-body">
                        <form action="search_result" method="post">
                            <input type="submit" name="submit" value="Search">
                            <?php
                            $style = mysqli_query($con, "SELECT StyleID, StyleName from product_style ORDER BY StyleID asc ");
                            while($row = mysqli_fetch_row($style) ){ ?>
                                <div class="checkbox">
                                    <label>
                                        <input name="keysearch[]" type="checkbox" value="<?php echo $row[1];?>"> <?php echo $row[1];?>
                                    </label>
                                </div>
                            <?php  }
                            ?>
<!--                            <input type="submit" name="submit" value="Go">-->
                        </form>


                      
<!--
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jackets
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jeans
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jersey Tops
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jumpers
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jumpsuits
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Jumpsuits & Playsuits
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Leggings
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Lingerie
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Nightwear
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Playsuits
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value=""> Shirts
                          </label>
                        </div>
-->
                    </div>
                </div>
            </div>