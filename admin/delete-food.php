<?php
include('../config/constraints.php');
//

if (isset($_GET['id']) && isset($_GET['image_name'])) {

    //1-get id and image_name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];


    //2-remove image if available

    //check whether the image is available or not and delete only if available
    if ($image_name != "") {

        //it has image and need to remove from folder
        //get the image path
        $path = "../images/food/" . $image_name;

        //remove Image File from folder
        $remove = unlink($path); //3anda true of false value  el $remove

        //check whether the image is removed or not
        if ($remove == false) {

            //failed to Remove Image
            $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File</div>";
            //redirect to Manage Food
            header('location:' . SITEURL . 'admin/manage-food.php');

            //stop the process
            die();
        }
    }





    //3-delete food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    //exexute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed or not and set the session message respectivley
    //4-redirect to manage food with session message

    if ($res == true) {

        //food deleted
        $_SESSION['delete'] = "<div class='success'>Food Deleted Succesfully</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {

        //failed to delete food

        $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {


    $_SESSION['unauthorize'] = "<div class='error'>unothorized Access.</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}