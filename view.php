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
		<title>
			View All Items
		</title>
        <link href="style.css" rel="stylesheet">
        <style>
            .login-box {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%
            }

			.login-box table {
				width: 100%;
				border-collapse: collapse;
				margin-top: 20px;
                max-width: 800px; 
			}

            .login-box {
                display: flex;
                flex-direction: column;
                align-items: center;
                }

			.login-box table th,
			.login-box table td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #fff;
                margin-right: 20px;
                white-space: nowrap;
			}


			.login-box table th {
				background-color: #30142b;
				color: #fff;
			}

			.login-box table tr:nth-child(even) {
				background-color: #82e65e;
			}

			.login-box table tr:hover {
				background-color: #f68e44;
			}

            .login-box table a {
                display: inline-block;
                padding: 5px 10px;
                background-color: #f68e44;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .login-box table a:hover {
                background-color: #e05b17;
            }

            .login-box button {
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
                letter-spacing: 4px;
            }

            .login-box button:hover {
                background: #f49803;
                color: #fff;
                border-radius: 5px;
                box-shadow: 0 0 5px #f4c803,
                            0 0 25px #bd9d0b,
                            0 0 50px #f4e403,
                            0 0 100px #d5cf1e;
            }
		</style>
	</head>
	<body>
      <div class="login-box">
        <h2> Current Products Available </h2>
		<?php
			
			//declare the variable that will hold the item records
			$items;
			
			//establish a connection to the database market
			$con = mysqli_connect("localhost", "root", "", "market");
			
			if($con)
			{
				//this code block will only execute if the user clicks a DELETE button
				//get the itemcode from the URL parameter of the item
				//that you want to delete
				//note: when you are getting a value from the URL parameter
				//make sure that you ARE ALWAYS USING the $_GET variable
				if(isset($_GET["itemcode"]))
				{
					//get the value of the URL parameter variable itemcode
					$itemcode = $_GET["itemcode"];
					
					//create the sql code for the delete
					$sql = "delete from item where itemcode = ".$itemcode." ";
					
					//execute the delete query
					mysqli_query($con, $sql);
					
					//display success message
					echo "<p style='color: red; font-weight: bold;'>Record was deleted successfully...</p>";
					
				}
		
				//form the query string that will select all records from item table
				$sql = "select * from item order by description ";
				
				//execute the sql query using the mysqli_query function
				$items = mysqli_query($con, $sql);
				//items variable is now a recordset
				
				//check if there are records retrieved
				if(mysqli_num_rows($items) > 0)
				{
					//form the html table
					echo "<table border='1'>";
					echo "		<tr>";
					echo "			<th>Item Code</th>";
					echo "			<th>Description</th>";
					echo "			<th>Price</th>";
					echo "			<th>Quantity</th>";
					echo "			<th>Status</th>";
					echo "			<th></th>";
					echo "		</tr>";
					
					//loop and visit each record in the recordset assign it to $record variable
					//and display it
					while($record = mysqli_fetch_assoc($items))
					{
						echo "<tr>";
						echo "		<td>".$record["itemcode"]."</td>";
						echo "		<td>".$record["description"]."</td>";
						echo "		<td>".$record["price"]."</td>";
						echo "		<td>".$record["quantity"]."</td>";
						echo "		<td>".$record["status"]."</td>";
                        echo "		<td>";
                        echo "          <a href='edit.php?itemcode=".$record["itemcode"]."'>Edit</a>";
                        echo "          <a href='view.php?itemcode=".$record["itemcode"]."'>Delete</a>";
                        echo "      </td>";
						echo "</tr>";
						
					}										
					echo "</table>";
				}
				else 
				{
					echo "<p>Sorry, no records found...</p>";
					
				}
				
			}
			else 
			{
				
				echo "<p>Error connecting to database...</p>";
			}
			
			mysqli_close($con);
		
		?>
        <div class="user-box">
        <center><a href="mainmenu.php"><button type="button" name="mainmenu" formnovalidate style="margin-left: 70px;"> Back to Menu </button></a></center>
        </div>
    </div>
    
	</body>
</html>