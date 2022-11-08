<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
                     <form action="" method="post" class="newform">
                      <select name="taskOption" class="select-box">
                       <option value="" disabled selected>Choose currency</option>
                        <option value="1">USD</option>
                        <option value="1.01">EUR</option>
                        <option value="0.31">Kuwait dinar</option>
                        <option value="1.70">Azerbaijan manat</option>
                        <option value="37000">Lebanon TL</option>
                       </select>
                       <input type="submit" name="submit2" class="tochange" value="Confirm">
          </form>

        <form action="<?php echo SITEURL ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->






<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //Display Foods that are Active
        $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

        //Execute the QUERY
        $res = mysqli_query($conn, $sql);

        //COunt Rows
        $count = mysqli_num_rows($res);

        //check whether the foods are available or not
        if ($count > 0) {

            //Foods Available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get the values
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
        ?>



                <div class="food-menu-box">
                    <div class="food-menu-img">

                        <?php
                        //check whether image avialble or not
                        if ($image_name == "") {
                            //Image not available
                            echo "<div class='error'>Image Not available.</div>";
                        } else {
                            //Image avialble
                        ?>
                            <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                        <?php
                        }
                        ?>



                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php 
                         if(isset($_POST['submit2'])){
                            $hi= $price*$_POST['taskOption'];
                            echo $hi;
                         }
                         else{
                            echo $price;
                         } ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {

            //foods not available
            echo "<div class='error'>Food not Found</div>";
        }



        ?>


        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>