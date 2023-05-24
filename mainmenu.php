<?php
	session_start();
	
	
	//if wala nani nga session variable
	//balik sa login.php
	if(! isset($_SESSION["logged_inuser"]))
	{
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
		<h2>Welcome <?php echo $_SESSION["logged_inuser"]; ?></h2>
		<p><a href="">Add Item</a></p>
		<p><a href="">Search Item</a></p>
		<p><a href="logout.php">Logout</a></p>
	</body>
</html>