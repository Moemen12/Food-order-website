<?php include('partials/menu.php'); ?>




<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br> <br>



        <?php if (isset($_SESSION['add'])) { //checking whether the session is set or not

            echo $_SESSION['add']; // Display The Session Message if set
            unset($_SESSION['add']); //Remove session message
        }  ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
                </tr>

                <tr>
                    <td>username:</td>
                    <td><input type="text" name="username" placeholder="Your username"></td>
                </tr>


                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Your password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>





<?php include('partials/footer.php'); ?>

<?php
//process the value from from and save it in Database
//check whether the submit buttom is clicked or not

if (isset($_POST['submit'])) {
    // button cliked
    // echo "button clicked";

    //1-Get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // password Encryption with md5

    //2-SQL QUERY to save the data into database
    $sql = "INSERT INTO tbl_admin SET
    full_name = '$full_name',
    username='$username',
    password='$password'

    ";

    //3-Executing Query and Saving Data into Database
    //save data in database men 5ilel rabton bi baad
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // 4-chech whether the (query is executed) data is inserted on not and display 
    // appropriate message

    if ($res == TRUE) {
        //Data Inserted
        // echo "Data Inserted";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "Admin Added Successfully";
        //redirect Page To Manage Admin
        header('location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "Failed to Add Admin";
        //redirect Page To Add Admin
        header('location:' . SITEURL . 'admin/add-admin.php');
    }
}



?>