<?php include('partials/menu.php'); ?>
<!-- tmp_name is the temporary name of the uploaded file which is generated automatically 
by php, and stored on the temporary folder on the server. 
name is the original name of the file which is store on the local machine. -->

<!-- A temporary address where the file is located before processing the upload request -->

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>

        <br> <br>
        <!-- add catgeory form starts -->

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="category title"></td>
                </tr>


                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>





                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>



                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>




            </table>
        </form>


        <!-- add catgeory form ends -->


        <?php

        //check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {

            // echo "clicked";

            //1.Get the Value from category from
            $title = $_POST['title'];

            //for radio input type , we need to check whether the button is selected or not

            if (isset($_POST['featured'])) {

                //Get the Value from form

                $featured = $_POST['featured'];
            } else {
                //SET the default VAlue
                $featured = "No";
            }
            //for radio input type , we need to check whether the button is selected or not

            if (isset($_POST['active'])) {

                $active = $_POST['active'];
            } else {
                $active = "NO";
            }
            /////////////////

            //check whether the image is selected or not and set the value from name accordingly
            //print_r can display the value of array but echo can't
            // print_r($_FILES['image']['name']); Screenshot (51).png
            // die(); //break the code here

            //iza 3anda esem m3ayan el image lah yen3amala upload
            if (isset($_FILES['image']['name'])) { //select lal name property['name']

                //upload the Image
                //to upload image we need , image name , source path and destination path
                $image_name = $_FILES['image']['name']; // he fia esem el sura bas  => Screenshot (51).png

                //upload the image only if image is selected
                if ($image_name != "") {








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
                        header('location:' . SITEURL . 'admin/add-category.php');
                        //stop the Process
                        die();
                    }
                }
            } else {
                //Dont upload Image and set the image_name value as blank
                $image_name = "";
            }






            //2.create sql query to insert category into database
            $sql = "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";

            //3-Execute the query and Save in Database
            $res = mysqli_query($conn, $sql);


            // 4-chech whether the query executed or not and data added or not
            if ($res == true) {

                //Query Executed and Category Added
                $_SESSION['add'] = "<div class='sucess'>Category Added Successfully.</div>";

                //Redirect to Manage Category Page
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {

                //failed to add Category

                $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";

                //Redirect to add Category Page

                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }

        ?>


    </div>
</div>














<?php include('partials/footer.php'); ?>