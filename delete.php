<?php
ob_start();
include_once 'db_connect.php';
$id =$_GET['id'];
// sql query for deleting data from database

mysqli_query($conn,"DELETE FROM posts WHERE id='$id'" ) or die(mysqli_error());

header("location:index.php");

?>