<div id="filter" class="col-md-3">
    <div class="dropdown-wrapper ">
        <select class="dropdown-btn btn-secondary drpdwn" style="font-weight: bold;" onchange="location = this.value;">
            <option value="">Select Category</option>
            <?php
                $sql=mysqli_query($con, "SELECT category_id,category_name FROM hj_category_info  ORDER BY orderid");
                $sl=0;
                while($row=mysqli_fetch_row($sql)){
            ?>
                    <option value="product_hj?id=<?php echo $row[0]; ?>"><?php echo $row[1]?></option>
            <?php   } ?>

        </select>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>FILTER BY</strong>
        </div>
        <div class="panel-body">
            <form action="search_resulthj" method="post">
                <input type="submit" name="submit" value="Search">
                <?php
                $style = mysqli_query($con, "SELECT StyleID, StyleName from product_style ORDER BY StyleID asc ");
                while($row = mysqli_fetch_row($style) ){ ?>
                    <div class="checkbox">
                        <label><input name="keysearch[]" type="checkbox" value="<?php echo $row[1];?>"> <?php echo $row[1];?></label>
                    </div>
                <?php  } ?>
            </form>
        </div>
    </div>
</div>