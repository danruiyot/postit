<?php
session_start();
ob_start();
include('header.php');
include_once("db_connect.php");
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Profile</title>



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
<?php 
if(count($_POST)>0) {
	$fileinfo=PATHINFO($_FILES["image"]["name"]);
	$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
	move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $newFilename);
	$location="upload/" . $newFilename;

mysqli_query($conn,"UPDATE users set profile_photo= '$location'  ,uid='" . $_POST['uid'] . "', user='" . $_POST['user'] . "' ,email='" . $_POST['email'] . "' WHERE uid='" . $_POST['uid'] . "'");
$message = "Record Modified Successfully";
}
$result = mysqli_query($conn,"SELECT * FROM users WHERE uid='" . $_SESSION['user_id'] . "'");
$row= mysqli_fetch_array($result);
?>

<div class="w3-card-2 w3-center">
  <p>Edit your information</p>
    </div>
<br>
<form name="frmUser" method="post" action="" enctype="multipart/form-data">
<div class="w3-card-2 w3-container w3-center">
&nbsp;
<? if ($row['profile_photo'] == null){
	?>
<? } else {
?>
<img style="width:80%" src="<?php echo $row['profile_photo']; ?>">
<br>
<br>
<?
}
?>
<br>
</div>
&nbsp;
<div class="message"><?php if(isset($message)) { echo $message; } ?>

<table class="w3-table w3-card-2">
<tr>

<td><input type="hidden" name="uid" class="" value="<?php echo $_SESSION['user_id']; ?>">
</tr>
<tr>
<td><label>User Name</label></td>
<td><input type="text" name="user" class="txtField" value="<?php echo $row['user']; ?>"></td>
</tr><tr>
<td><label>Email</label></td>
<td><input type="text" name="email" class="txtField" value="<?php echo $row['email']; ?>"></td>
</tr>
<tr>
<td><label>profile picture</label></td>
<td><input type="file" name="image" accept=".png,.gif,.jpg,.webp" ></td>
</tr> 
<tr>
<td>&nbsp;</td>
<td colspan="2"><input type="submit" name="submit" value="Submit" class="w3-btn w3-blue"></td>
</tr>
</table>
</div>

</form>



		<div style="margin:50px 0px 0px 0px;">
		</div>
</div>
<?php include('footer.php');?>