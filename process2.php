<?php
ob_start();
include_once 'db_connect.php';
if(isset($_POST['btn']))
{
// variables for input data
if(empty($_FILES)){

$content = $_POST['cont'];
$name = $_POST['name'];
$date = date('Y-m-d H:i:s');
$userId = $_POST['id'];
// sql query for inserting data into database

mysqli_query($conn,"insert into posts(userId,content,date) values ('$userId','$content',now())") or die(mysqli_error());

header("location:index.php");

}else{
$fileinfo=PATHINFO($_FILES["image"]["name"]);
	$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
	move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $newFilename);
	$location="upload/" . $newFilename;
$content = $_POST['cont'];
$name = $_POST['name'];
$date = date('Y-m-d H:i:s');
$userId = $_POST['id'];
// sql query for inserting data into database

mysqli_query($conn,"insert into posts(userId,content,file,date) values ('$userId','$content','$location',now())") or die(mysqli_error());

header("location:index.php");
}
}
?>