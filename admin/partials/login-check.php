<?php

if(!isset($_SESSION["user"])){
    
    $_SESSION["no-login-message"] = "<div class='error text-center'>Please Login in To access Admin Panel</div>";
    header("location:".SITEURL."admin/login.php");

}


?>