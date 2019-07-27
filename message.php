<?php
session_start();
ob_start();
include('header.php');
include_once("db_connect.php");
$mid=$_GET['id'];
if ($mid== null){
	header("location:all.php");
	} else{
	#its good to go
	}

?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home</title>

				<?php
							 if (isset($_SESSION['user_id'])) { ?>
				<?php include('container.php');?>
				<?php } else { ?>
				<?php
				header("location:login.php");
				 } ?>
				<div></div>
				<div>
				<fieldset class="w3-card-2">

		<?php
if(count($_POST)>0) {
 $msg=$_POST['msg'];
 $sender=$_SESSION['user_id'];
 mysqli_query($conn,"INSERT INTO msg (receiverid,senderid,msg,tme) VALUES('$mid','$sender','$msg',now())");
}
$result = mysqli_query($conn,"SELECT * FROM msg WHERE receiverid='$mid' ORDER BY tme ASC");

while($row = mysqli_fetch_array($result )) {

?>
<br>
<?php
$stats ="read";
if ($_SESSION['user_id'] == $row['receiverid']){
mysqli_query($conn,"UPDATE msg set stats= '$stats' WHERE senderid='$mid'");
}else{
}

if ($_SESSION['user_id'] == $row['senderid']){
?>
<div id="right" class=" w3-padding-2 w3-round w3-card-2 w3-green w3-right">
&nbsp;
<?php
	echo $row['msg'];
?>
&nbsp;
<br>
</div>
<br>
<?php
}else{
?>
<div id="left"  class="w3-padding-2 w3-card-2 w3-round w3-blue w3-left">
&nbsp;
<?php
echo $row['msg'];
?>
&nbsp;
<br>
</div>
<br>
<?php
}

}
?>
				</fieldset>
					<form method="post" action="" class="w3-input-group w3-round w3-card-2">
				<input type="text" name="msg" required class="w3-input w3-round" >
				&nbsp;<input type="submit" name="snd" value="send" class="w3-round  w3-btn w3-indigo">
				</form>
		</div>
		<div class="w3-bottom">
<?php include('footer.php');?>
</div>