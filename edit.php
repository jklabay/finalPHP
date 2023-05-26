<?php
    session_start();
	
	// If no session variable is set, redirect to login.php
	if (!isset($_SESSION["logged_inuser"])) {
		header("location: login.php");
		exit;
	}

	$itemcode = "";
	$description = "";
	$price = "";
	$quantity = "";
	$status = "";
	//get the value of the URL parameter itemcode from list_all.php
	if(isset($_GET["itemcode"]))
	{
		$itemcode = $_GET["itemcode"];
		
		//check if you have established a connection to the database named: market
		$con = mysqli_connect("localhost", "root", "", "market");
		
		//check if the connection is successful...
		if($con)
		{
			//query the record that you want to edit
			
			//form the query string that will select all records from item table
			$sql = "select * from item where itemcode = ".$itemcode." ";
			
			//execute the sql query using the mysqli_query function
			$items = mysqli_query($con, $sql);
			//items variable is now a recordset					
			
			if(mysqli_num_rows($items) > 0)  
			{
				while($record = mysqli_fetch_assoc($items))
				{
					//transfer the recordset into local php variables
					$itemcode = $record["itemcode"];
					$description = $record["description"];
					$price = $record["price"];
					$quantity = $record["quantity"];
					$status = $record["status"];
					
				}
				
			}
			else 
			{
				echo "<p>Record not found.</p>";
				
			}
			
		}				
		else 
		{
			echo "<p>Error connecting to DB.</p>";
			
		}
		mysqli_close($con);
		
	}
	
	
	//if the user clicks the save_changes button
	if(isset($_POST["save_changes"]))
	{
		//get all the inputs
		$itemcode = $_POST["itemcode"];
		$description = $_POST["description"];
		$price = $_POST["price"];
		$quantity = $_POST["quantity"];
		$status = $_POST["status"];
		
		//check if you have established a connection to the database named: market
		$con = mysqli_connect("localhost", "root", "", "market");
		
		//check if the connection is successful...
		if($con)
		{
			//prepare the sql query for the update
			$sql = "update item 
						set description = '".$description."', 
							price = ".$price.",
							quantity = ".$quantity.",
							status = '".$status."' 
						where	
							itemcode = ".$itemcode." ";
							
			mysqli_query($con, $sql);
			//echo "<p>Record was updated successfully...</p>";
			header("location: view.php");
			exit;
			
		}				
		else 
		{
			echo "<p>Error connecting to DB.</p>";
			
		}
		mysqli_close($con);
		
	}

?>
<html>
	<head>
		<title>Edit Record</title>
		<style>
		body {
            margin:0;
            padding:0;
            font-family: sans-serif;
            background: linear-gradient(#30142b, #82e65e);
		}
		form {
			background-color:  transparent;
			border: 1px solid #ccc;
			border-radius: 5px;
			padding: 20px;
			margin: 50px auto;
			max-width: 500px;
			box-shadow: 0px 2px 5px rgba(0,0,0,0.3);
		}
		h1 {
			font-size: 28px;
			text-align: center;
			margin-bottom: 30px;
		}
		label {
			display: block;
			font-size: 16px;
			margin-bottom: 10px;
		}
		input[type="text"], select {
			width: 100%;
			padding: 10px;
			font-size: 16px;
			border-radius: 5px;
			border: 1px solid #ccc;
			box-sizing: border-box;
			margin-bottom: 20px;
		}
		button[type="submit"] {
			position: relative;
            display: inline-block;
            padding: 10px 20px;
            color: #b79726;
            font-size: 16px;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            transition: .5s;
            margin-top: 40px;
            letter-spacing: 4px
		}
		button{
			position: relative;
            display: inline-block;
            padding: 10px 20px;
            color: #b79726;
            font-size: 16px;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            transition: .5s;
            margin-top: 40px;
            letter-spacing: 4px
		}
		button:hover{
			background: #f49803;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px #f4c803,
                        0 0 25px #bd9d0b,
                        0 0 50px #f4e403,
                        0 0 100px #d5cf1e;
		}
		button[type="submit"]:hover {
			background: #f49803;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px #f4c803,
                        0 0 25px #bd9d0b,
                        0 0 50px #f4e403,
                        0 0 100px #d5cf1e;
		}
        form label {
            color:white;
        }
	</style>
	</head>
	<body>
		<form method="POST" action="edit.php">
		<h1 style="color:white;">Edit Record</h1>
		<label>Item Code:</label>
		<input type="text" name="itemcode" readOnly value="<?php echo $itemcode; ?>" />
		
		<label>Description:</label>
		<input type="text" name="description" value="<?php echo $description; ?>" required />
		
		<label>Price:</label>
		<input type="text" name="price" value="<?php echo $price; ?>" required />
		
		<label>Quantity:</label>
		<input type="text" name="quantity" value="<?php echo $quantity; ?>" required />		
		
		<label>Status:</label>
		<select name="status">
			<option value="A" <?php if($status == "A"){ echo "selected"; }  ?>>Active</option>
			<option value="I" <?php if($status == "I"){ echo "selected"; }  ?>>In-Active</option>
		</select>
        		
        <div>
		<button type="submit" name="save_changes">Save Changes</button>	
        <a href="view.php"><button type="button" name="list_all" formnovalidate> View All Products </button></a>
        </div>
        <a href="mainmenu.php"><button type="button" name="list_all" style="margin-left: 150px;" formnovalidate> Main Menu </button></a>
	</form>
	</body>
</html>