<?php
session_start();
ob_start();
include('header.php');
include_once("db_connect.php");
if(isset($_SESSION['user_id'])!="") {
	header("Location: index.php");
}
if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email. "' and pass = '" . md5($password). "'");
	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['user_id'] = $row['uid'];
		$_SESSION['user_name'] = $row['user'];
		header("Location: index.php");
	} else {
		$error_message = "Incorrect Email or Password!!!";
	}
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Log in</title>
<script type="text/javascript" src="script/ajax.js"></script>
<?php include('container.php');?>

<div class="w3-container">
	<h2>Log in</h2>
	<div class="w3-row"">
		<div>
			<span class="w3-text-red"><?php if (isset($error_message)) { echo $error_message; } ?></span>
			<form class="w3-container w3-card-2 w3-round" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
<input class="w3-input" type="text" name="email" placeholder="Your Email" required>
<input class="w3-input" type="password" name="password" placeholder="Your Password" required class="form-control" />
	&nbsp; <br>
<input type="submit" name="login" value="Login" class="w3-btn-block w3-round-xlarge w3-green" />
&nbsp; 
<a class="w3-btn-block w3-teal w3-round-xlarge" href="register.php">register</a>
				<br>
					&nbsp;
				
			</form>
		</div>
	</div>
	<div class="row">
		<div>
<br>
		</div>
	</div>

</div>
<?php include('footer.php');?>