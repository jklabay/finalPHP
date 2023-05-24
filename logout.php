<?php
	session_start();
	
	//if wala ko nakalogin / naka logged out nako
	//balik sa login.php
	if(! isset($_SESSION["logged_inuser"]))
	{
		header("location: login.php");
		exit;
		
	}
	
	//destroy the session
	//empty the session array variable
	$_SESSION = array();
	session_destroy();
	unset($_SESSION);	
?>
<html>
	<head>
		<title>Logout</title>
	</head>
	<body>
		<p>Successfully logged out from the system...</p>
		<p><a href="login.php">Click here to login again</a></p>
	</body>
</html>