<?php
session_start();
require_once('config.php');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { // logged in
	header('Location: index.php');
	die();
}


$username = isset($_POST['Username']) ? trim($_POST['Username']) : ''; // handle the login
$password = isset($_POST['Password']) ? trim($_POST['Password']) : '';

if ($username == $adminusername && $password == $adminpassword) { // login is successful
	$_SESSION['loggedin'] = true;
	$_SESSION['user'] = $username;
	header('location: index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id="login-page">
<!--
<div class="banner-alert">
	<p class="white-txt"><span class="white-txt bold">Warning:</span> Can't connect to database</p>
	<p class="banner-close" onclick="closeBanner(this.parentElement.nodeName)">X</p>
</div>
-->
  
<div id="login-form">
	<form action="login.php" method="post">
		<div class="login-input-container">
			<h1>Login</h1>
			<!-- <label for="Username">Username:</label> -->
			<input type="text" id="Username" name="Username" placeholder="Username..." required>
			<!-- <label for="Password">Password:</label> -->
			<input type="password" id="Password" name="Password" placeholder="Password..." required>
			<input type="submit" value="Submit">
		</div>
	</form>
</div>

<script src="js/script.js"></script>
</body>
</html>
