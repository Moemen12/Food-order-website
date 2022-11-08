
<?php

session_start();


define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD)or die(mysqli_error());
$db_select=mysqli_select_db($conn,DB_NAME)or die(mysqli_error());

?>