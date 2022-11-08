<?php include('partials-front/menu.php'); ?>


<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        // display all the categories that are active
        //Sql query
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //COunt Rows
        $count = mysqli_num_rows($res);

        //CHeck whether categories available or not
        if ($count > 0) {
            //categories available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get THe Values
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>

                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php

                        if ($image_name == "") {
                            //image not available
                            echo "<div class='error>Image Not Found</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL ?>/images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve"height="400px">


                        <?php
                        }
                        ?>

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>



        <?php
            }
        } else {

            //categories Not Available
            echo "<div class='error'>Category Not Found.</div>";
        }




        ?>






        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->




<?php include('partials-front/footer.php'); ?>