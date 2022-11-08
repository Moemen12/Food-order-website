<?php include('partials/menu.php') ?>

<div class="main-contnet">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>
        <?php
        //check whether the id is set or not
        if (isset($_GET['id'])) {

            //GET The ID And all other details
            // echo "Getting the Data";
            $id = $_GET['id'];
            //create sql query to get all other details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //count the rows to check whether the id is valid or not

            $count = mysqli_num_rows($res);



            if ($count == 1) {

                //Get all the Data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {

                //redirect to manage Category with session message
                $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {

            //redirect to manage Category
            header('location:' . SITEURL . 'admin/manage-category.php');
        }

        ?>
        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {

                            //Displaying the message
                        ?>

                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">

                        <?php



                        } else {
                            //display message
                            echo "<div class='error'>Image not added.</div>";
                        }; ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>


                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>

                    <td>Active:</td>

                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>




        <?php

        if (isset($_POST['submit'])) {

            // echo "gel";
            //1.Get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2.Updating New Image if selected

            //check whether the image is selected or not
            if (isset($_FILES['image']['name'])) {

                //Get the Image Details
                $image_name = $_FILES['image']['name'];

                //check whether the image is available or not
                if ($image_name != "") {

                    //image available
                    //A.upload the new Image



                    //AUto rename our image
                    //Get the Extension of our image (jpg,png,gif,etc) e.g "food1.jpg"
                    //explode function to get the extension (.jpg)
                    $ext = end(explode('.', $image_name)); //ne7sal 3al jpg

                    //Rename the Image now
                    $image_name = "Food_category_" . rand(000, 999) . '.' . $ext; //e.g. 
                    //Food_Category_262.jpg



                    $source_path = $_FILES['image']['tmp_name']; //  he fia el esem wel tempor location   =>C:\xampp\tmp\php79FB.tmp

                    $destination_path = "../images/category/" . $image_name; //    ../images/category/Food_Category_262.jpg

                    //Finally Upload the Image
                    $upload = move_uploaded_file($source_path, $destination_path); // hayde hye li bt3mol upload bel vscode only (php function)



                    //check whether the image is uploaded or not
                    //And if the image is not uploaded then we will stop the process and redirect with error message

                    if ($upload == false) {

                        //set message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload Image.</div>";
                        //Redirect to add category page
                        header('location:' . SITEURL . 'admin/manage-category.php');
                        //stop the Process
                        die();
                    }





                    //B.Remove the current Image if available

                    if ($current_image != "") {




                        $remove_path = "../images/category/" . $current_image;


                        $remove = unlink($remove_path);

                        //check whether the image is removed or not
                        //if fail to remove the display message and stop the process

                        if ($remove == false) {
                            //failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error>Failed to remove current image</div>";
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            die(); //stop the process
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            //3.update the database
            $sql2 = "UPDATE tbl_category SET 
            title='$title',
            image_name='$image_name',
            featured = '$featured',
            active = '$active'
            WHERE id=$id 
            ";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);





            //4.Redirect to Manage Category with Message

            //check whether query exectuted  or not
            if ($res2 == true) {

                //Category Updated
                $_SESSION['update'] = "<div class='success'>Category Updated succesfully</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {

                //failed to update category
                $_SESSION['update'] = "<div class='error'>failed to update Category.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }



        ?>





    </div>
</div>




<?php include('partials/footer.php'); ?>