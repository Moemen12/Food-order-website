<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br><br>

        <?php if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Old Password: </td>
                    <td><input type="password" name="current_password" placeholder="Current password"></td>
                </tr>

                <tr>
                    <td>New Passowrd:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="new Password">
                    </td>
                </tr>


                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm Password">
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="change password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>
<!--  -->





<?php
//check whether the submit buton ic cliked or not
if (isset($_POST['submit'])) {

    // echo "Clicked";
    // 1-Get the Data from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);



    //2-check whether the user with current ID and Password Exists or Not

    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";


    //execute the query
    $res = mysqli_query($conn, $sql);

    if ($res == true) {

        //check whether data is available or not
        $count = mysqli_num_rows($res);

        if ($count == 1) {

            //User exists and password can be changed
            // echo "User Found ";

            //check whether the new password and confirm match or not
            if ($new_password == $confirm_password) {

                //update the Password
                $sql2 = "UPDATE tbl_admin SET 
            password = '$new_password'
            where id = $id
            ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //check whether the query is excuted or not

                if ($res2 == true) {
                    //Display Success Message
                    //Redirect to manage Admin Page with Error MEssage
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                } else {
                    //Display Error Message
                    //Display Success Message
                    //Redirect to manage Admin Page with Error MEssage
                    $_SESSION['change-pwd'] = "<div class='error'Failed to change Password</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {

                //Redirect to Manage Admin Page witn Error MEssage
                $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Match</div>";

                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            //user does not exist set Message and Redirect

            $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    }


    //3-check whether the new Password and confirm Password Match or not


    //4 change password if all above is true
}

?>

<?php include('partials/footer.php') ?>