<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update admin</h1>
        <br> <br>

        <?php

        // 1. Get the Id of selected Admin
        $id = $_GET['id'];

        //2-create Sql query of selected Admin
        $sql = "SELECT * from tbl_admin WHERE id = $id";

        //EXecute the Query

        $res = mysqli_query($conn, $sql);


        //check wheter the query is executed or not
        if ($res == true) {
            //  check whether the data is available or not
            $count = mysqli_num_rows($res);

            //check whether we have admin data or not
            if ($count == 1) {

                // Get the Details
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];



                // echo "Admin Available";
            } else {
                //redirect To Manage Admin Page
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        }


        ?>
        <form action="" method="post">

            <table class="tbl-30 ">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>" placeholder=""></td>
                </tr>

                <tr colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <td><input type="submit" name="submit" value="update Admin" class="btn-secondary"></td>
                </tr>

            </table>





        </form>
    </div>
</div>




<?php

//check whether the submit Button is Clicked or not
if (isset($_POST['submit'])) {
    // echo "Button Clicked";

    //Get all values from form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];


    //create a sql query to update Admin
    $sql = "UPDATE tbl_admin SET 
    full_name = '$full_name',
    username='$username'
    WHERE id = '$id'
    ";

    //execute the query 
    $res = mysqli_query($conn, $sql);

    //check whether the query executed successfully or not
    if ($res == true) {

        $_SESSION['update'] = "<div class='success'>Admin updated Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-admin.php');
    } else {

        //failed to update Admin

        $_SESSION['update'] = "<div class='error'>failed to delete admin.</div>";
        //redirect
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
}


?>




<?php include('partials/footer.php'); ?>