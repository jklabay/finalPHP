<?php
	session_start();
	
	// If no session variable is set, redirect to login.php
	if (!isset($_SESSION["logged_inuser"])) {
		header("location: login.php");
		exit;
	}
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="style.css" rel="stylesheet">
	<title>Main Menu</title>
</head>
<body>
	<div class="login-box">
		<h2>Welcome <?php echo $_SESSION["logged_inuser"]; ?></h2>
		<div class="user-box">
			<a href="" class="button">Add Item</a>
		</div>
		<div class="user-box">
			<a href="" class="button">Search Item</a>
		</div>
		<div class="user-box">
			<a href="logout.php" class="button">Logout</a>
		</div>
	</div>
</body>
</html>
