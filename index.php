<?php include('partials-front/menu.php'); ?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
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

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php

if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
} 


?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        //create sql queru to display categories from database
        $sql = "SELECT * FROM tbl_category where active='Yes' AND featured='Yes' LIMIT 3";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //count rows to check whether the category ia available or not
        $count = mysqli_num_rows($res);


        if ($count > 0) {

            //categories available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get the values like title , image_name, id
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>

                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        //check whether image is available or not
                        if ($image_name == "") {
                            //display Message
                            echo "<div class='error'>Image Not Available</div>";
                        } else {
                            //Image available
                        ?>

                            <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve" height="400px">

                        <?php
                        }
                        ?>

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            //categories not available
            echo "<div class='error'>Catgeory Not added</div>";
        }



        ?>





        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->

 





<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //Getting Foods from DataBase that are active and featured
        //SQL QUery
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

        //execute the query
        $res2 = mysqli_query($conn, $sql2);

        //COunt ROws 
        $count2 = mysqli_num_rows($res2);

        //check whether food ia available or not
        if ($count2 > 0) {
            //food avialable
            while ($row = mysqli_fetch_assoc($res2)) {
                //Get all the Values
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
        ?>


                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //check whether image avaiblable or not
                        if ($image_name == "") {
                            //Image not available
                            echo "<div class='error'>Image Not Available.</div>";
                        } else {
                            //Image Available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">


                        <?php

                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">
                        <?php 
                         if(isset($_POST['submit2'])){
                            $hi= $price*$_POST['taskOption'];
                            echo $hi;
                         }
                         else{
                            echo $price;
                         }
                        
                        ?></p>
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
            echo "<div class='error'>Food not Available.</div>";
        }



        ?>


        <div class="clearfix"></div>
    </div>

    <p class="text-center">
        <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>
