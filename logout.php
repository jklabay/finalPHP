<?php
	session_start();
	
	// If not logged in or already logged out
	// Redirect to login.php
	if (!isset($_SESSION["logged_inuser"])) {
		header("location: login.php");
		exit;
	}
	
	// Destroy the session
	// Empty the session array variable
	$_SESSION = array();
	session_destroy();
	unset($_SESSION);
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="style.css" rel="stylesheet">
	<title>Logout</title>
</head>
<body>
	<div class="login-box">
		<h2>Successfully logged out from the system...</h2>
		<div class="user-box">
		<a href="login.php" class="button">Click here to login again</a>
		</div>
	</div>
</body>
</html>
