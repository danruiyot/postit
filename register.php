<?php
ob_start();
include('header.php');
include_once("db_connect.php");
session_start();
if(isset($_SESSION['user_id'])) {
	header("Location: index.php");
}
$error = false;
if (isset($_POST['signup'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$uname_error = "Name must contain only alphabets and space";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if(strlen($password) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	if (!$error) {
		if(mysqli_query($conn, "INSERT INTO users(user, email, pass) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
			$success_message = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
		} else {
			$error_message = "Error in registering...Please try again later!";
		}
	}
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>sign up</title>
<script type="text/javascript" src="script/ajax.js"></script>
<?php include('container.php');?>

<div class="container">
<h2>Sign up</h2>
	<div>
		<div class="w3-row">
<span class="w3-text-green"><?php if (isset($success_message)) { echo $success_message; } ?></span>
			<span class="w3-text-red"><?php if (isset($error_message)) { echo $error_message; } ?></span>
			<form class="w3-container w3-card-2 " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
					
						<input class="w3-input" type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
				   	
						<input class="w3-input" type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
						<input type="password" name="password" placeholder="Password" required class="w3-input" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
						
						<input class="w3-input" type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
						<spanclass="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
					&nbsp;
					<br></br>
					<input type="submit" name="signup" value="Sign Up" class=" w3-btn-block w3-round-xlarge w3-green" />
					&nbsp; <a class="w3-btn-block w3-round-xlarge w3-teal" href="login.php">Login</a>
			<br></br>&nbsp;
			</form>
			
		</div>
	</div>
	<div>

		<br>
		
	</div>

</div>
<?php include('footer.php');?>