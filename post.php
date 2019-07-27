<?php
session_start();
ob_start();
include('header.php');
include_once("db_connect.php");
$postid= $_GET['id'];
if ($postid == null){
	header("location:index.php");
	}
	else{
	}
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>post</title>
<div class="container">
		<div>

				<?php if (isset($_SESSION['user_id'])) { ?>
				<?php include('container.php');?>
				<?php } else { ?>
				<?php
				header("location:login.php");
				 } ?>
		</div>

</div>
<?php
$result = mysqli_query($conn,"SELECT * FROM posts  WHERE id = '$postid' ORDER BY id DESC ");
?>
<?php
while($row = mysqli_fetch_array($result )) {

?>
<?php
$x=$row['userId'];
$res = mysqli_query($conn,"SELECT * FROM users WHERE uid ='$x' ");
while($rows = mysqli_fetch_array($res )){
?>
<br>
<table class="w3-table ">
<tr><td class="w3-card-2 w3-btn w3-white">
<img class="w3-circle" style="width:10%;" src="<?php echo $rows['profile_photo']; ?>" alt="profil photo" >
      <b><?php echo $rows['user'];?>:</b>
      <p>"<?php echo $row['content']; ?>"</p>
<? if ($row['file'] == null){
	?>
<? } else {
?>
<img style="width:80%" src="<?php echo $row['file']; ?>">
<br>
<br>
<?php echo $row['date']; ?>
<br>

<?php
if($_SESSION['user_id'] == $row['userId']){
?><button class="w3-red w3-btn w3-round">
<a style="text-decoration:none;" href="delete.php?id=<?php echo $postid?>">Delete?</a></button>
<?php
}

?>
<?
}
?>
    </td>
   </tr>
   </table>
    </div>

<?php
}
}
?>


		<div style="margin:50px 0px 0px 0px;">
		</div>
</div>
<?php include('footer.php');?>