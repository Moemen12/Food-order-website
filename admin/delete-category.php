<?php
//INCLUDE constants file
include('../config/constraints.php');
// echo "Delete Page";
//check whether the id and image_name value is set or not
if (isset($_GET['id']) and isset($_GET['image_name'])) {



    //if true 3mol kell holll =======>

    // Get the value and delete
    // echo "GET VAlUE AND DElete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];



    //Remove the physcial image file if available
    if ($image_name != "") { // iza la2a el sura bel vscode
        //image is available , so remove it
        $path = "../images/category/" . $image_name;
        //Remove the Image
        $remove = unlink($path); //true yaane removed

        //if  failed to remove image then add an error message and stop the process
        if ($remove == false) {  // iza ma la2a el sura bel vscode aw ma eder yem7ia la sabab ma
            //set the session message 
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";
            // redirect to Manage Category 
            header('location:' . SITEURL . 'admin/manage-category.php');
            // stop the process
        }
    }


    //delete data from database
    //sql query delete data from database
    $sql = "DELETE FROM tbl_category WHERE id=$id";


    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the data is deleted from database or not
    if ($res == true) {
        //set success message and redirect
        $_SESSION['delete'] = "<div class='sucess'>Category Deleted Succesfully</div>";
        //Redirect to Manage Category
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        //set fail Message and redirect 
        $_SESSION['delete'] = "<div class='error'>failed to delete category</div>";

        //Redirect to Manage Category

        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    //redirect to Manage category page
    header('location:' . SITEURL . 'admin/manage-category.php');
}