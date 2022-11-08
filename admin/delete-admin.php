<?php


include("../config/constraints.php");
 $id=$_GET["id"];

  $sql = "DELETE FROM tbl_admin WHERE id=$id";
  $res= mysqli_query($conn,$sql) ;


  if($res==TRUE){
    $_SESSION["delete"]="<div class='sucess'>Admin deleted Successufly</div>";
    header("location:".SITEURL."admin/manage-admin.php");
  }
   else{
    $_SESSION["delete"]="<div class='error'>Failed To Delete Admin. Try again later.</div>";
    header("location:".SITEURL."admin/manage-admin.php");
   }

?>