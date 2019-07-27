<?php
session_start();
ob_start();
include('header.php');
include_once("db_connect.php");
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/main.css">
<title>Message</title>
</head>
<body>
<?php if (isset($_SESSION['user_id'])) { ?>
				<?php include('container.php');?>
				<div class="w3-card-2">
				<h4>select who to message</h4>
				</div>
		<?php
$result = mysqli_query($conn,"SELECT * FROM users   ");
?>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<div class="w3-container w3-card-2">
<?php
if ($row['uid'] == $_SESSION['user_id']){	
?><?php } else { ?>
<a style="text-decoration:none;" href="message.php?id=<?php echo $row['uid']; ?>"><?php echo $row ['user'];?></a>
</div>
<br>
			<?php
}

}
include('footer.php'); }else {
	header("location:login.php");
	} ?>