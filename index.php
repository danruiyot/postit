<?php
session_start();
ob_start();
include('header.php');
include_once("db_connect.php");
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home</title>


<div class="container">
<div></div>
		<div>
<?php if (isset($_SESSION['user_id'])) { ?>
				<?php include('container.php');?>
				<?php } else { ?>
				<?php
				header("location:login.php");
				 } ?>
		</div>
<br>
<div class="w3-card-2">
<form method="post" role="form" action="process2.php" enctype="multipart/form-data">
 <div class="w3-input-group">
<table  class=" w3-table " align="center">

<tr>
<input style="display:none;" type="text" name="id" value="<?php echo $_SESSION['user_id']; ?>">
<input style="display:none;" type="text" name="name" value="<?php echo $_SESSION['user_name'];  ?>">
<td><input class="w3-input" type="text" name="cont" required placeholder="post your ideas" /><br>
<input class="w3-input" type="file" name="image" accept=".png,.gif,.jpg,.webp">
<br>
&nbsp;<input type="submit" name="btn" class=" w3-btn w3-round w3-blue" value="Post"></td>
</tr>
</table>
</div>
</form>
</div>
<?php
$result = mysqli_query($conn,"SELECT * FROM posts ORDER BY id DESC ");
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
<a style="text-decoration:none;" href="post.php?id=<?php echo $row['id']?>">
<? if ($rows['profile_photo'] == null){
	?>
<? } else {
?>
<img class="w3-circle" style="width:10%;" src="<?php echo $rows['profile_photo']; ?>" alt="profile photo">
<?php
}
 ?>


      <b><?php echo $rows['user'];?>:</b>
<hr>
      <p>"<?php echo $row['content']; ?>"</p>
<? if ($row['file'] == null){
	?>
<? } else {
?>
<img style="width:80%" src="<?php echo $row['file']; ?>">
</a>
<br>
<br>
<?
}
?>

<?php echo $row['date']; ?>
<input type="text" style="display:none" value="<?php echo $row['id']; ?>">
<hr>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

<input type="text" style="width:50%;" name="comment" placeholder="comment on the post">
<input type="submit" value="comment" name="comment" >
<br>
<br>
<input type="text" name="userid" style="display:none"  value="<?php echo $_SESSION['user_id']; ?>">
<input type="text" name="postid" style="display:none" value="<?php echo $row['id']; ?>">

 <input type="submit" name="like" value="like" >
 <input type="submit" name="dislike" value='dislike' >
 </form>


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

<?php
require_once('db_connect.php');
$postid = $_POST['postid'];
$userid = $_POST['userid'];
$comment = $_POST['comment'];

if ($_POST['like']){
echo 'liked';
   $sql = "INSERT INTO likes (status, postid, userid) VALUES ('1', '$postid', '$userid')" ;
   $result=mysqli_query($conn,$sql);
}

if ($_POST['dislike']){
   $sql = "INSERT INTO likes (status, postid, userid) VALUES ('0', '$postid', '$userid')" ;
   $result=mysqli_query($conn,$sql);
}

if ($_POST['comment']){
   $sql = "INSERT INTO comments ( comment, postid, userid) VALUES ('$comment', '$postid', '$userid')" ;
   $result=mysqli_query($conn,$sql);
}
?>