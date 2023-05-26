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
		<title>Add Item</title>
        <link href="style.css" rel="stylesheet">
        <Style>
        .login-box .user-box select {
            width: 100%;
            padding: 10px 0;
            font-size: 20px;
            color: #fff;
            margin-bottom: 30px;
            border: none;
            border-bottom: 1px solid #fff;
            outline: none;
            background: transparent;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            }

            .login-box .user-box select::-ms-expand {
            display: none;
            }

            .login-box .user-box select option {
            background-color: #30142b;
            color: #fff;
            }

            .login-box .user-box select option:checked {
            background-color: #f68e44;
            color: #fff;
            }
        </style>
	</head>
	<body>
    <div class="login-box">
		<form method="POST" action="create.php">
        <h2> Create new Item </h2>
		<?php
			
			//if the user clicks the save button
			if(isset($_POST["save"]))
			{
				//get all the inputted values
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
					//echo "<p>Connection successful</p>";

					$id = $_POST["itemcode"];

					$sql = "select itemcode from item where itemcode = $id ";

					$result = mysqli_query($con, $sql);

					$num_rows = mysqli_num_rows($result);

					if($num_rows > 0){
						echo "<b><p style='color:red;'>Sorry itemcode is currently existing and therefore cannot use it</p></b>";
					}
					else{
					//construct the insert query
					$query = "insert into item (itemcode, description, price, quantity, status) 
							  values (".$itemcode.", '".$description."', ".$price.", ".$quantity.", '".$status."') ";
							  
					//call the query function in order to insert a record
					mysqli_query($con, $query);
					
					//display a success message
					echo "<p style='color:green;'>Record was saved successfully...</p>";
					}
					
				}
				else 
				{
					echo "<p style='color:red;'>Error connecting to the database...</p>";
					
				}
				
				mysqli_close($con);
				
			}	
		
		?>
            <div class="user-box">
            <input type="text" id="itemcode" name="itemcode" required />
			<label for="itemcode">Item Code:</label>
            </div>
            
            <div class="user-box">
            <input type="text" id="description" name="description" required />
			<label for="description">Description:</label>
            </div>

            <div class="user-box">
            <input type="text" id="price" name="price" required />
			<label for="price">Price:</label>
            </div>

            <div class="user-box">
            <input type="text" id="quantity" name="quantity" required />
			<label for="quantity">Quantity:</label>
            </div>

            <div class="user-box">
            <select id="status" name="status">
				<option value="A">Active</option>
				<option value="I">In-Active</option>
			</select>
            </div>
            <div>
			<button type="submit" name="save">Save</button>
            </div>
            <div>
            <a href="mainmenu.php"><button type="button" name="mainmenu" formnovalidate> Back to Menu </button></a>
            </div>
            
	</form>
    </div>
	</body>
</html>