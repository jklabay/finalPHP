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
		<title>Search Items by Description</title>
		<link href="style.css" rel="stylesheet">
		<style>
			.login-box table {
				width: 100%;
				border-collapse: collapse;
				margin-top: 20px;
			}

			.login-box table th,
			.login-box table td {
				padding: 8px;
				text-align: left;
				border-bottom: 1px solid #fff;
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
		</style>
	</head>
	<body>
		<div class="login-box">
			<form method="GET" action="search.php">
				<div class="user-box">
					<input type="text" name="description" required />
					<label>Type description:</label>
				</div>
				<button type="submit" name="search" style="margin-top: 0;">Search</button>
                <a href="mainmenu.php"><button type="button" name="mainmenu" formnovalidate style="margin-left: 70px;"> Back to Menu </button></a>
				<br>
				<?php
					$items;

					//if the user clicks the search button
					if(isset($_GET["search"]))
					{
						//get the value of the inputted description and remove leading and
						//trailing spaces using the trim function
						$description = trim($_GET["description"]);

						//establish a connection to the database market
						$con = mysqli_connect("localhost", "root", "", "market");

						//check if connection is successful
						if($con)
						{
							//form the query
							$sql = "select * from item where description like '%".$description."%' order by description ";

							//assign the returned or retrieved records to $items variable in PHP
							$items = mysqli_query($con, $sql);

							//check if there are records retrieved
							if(mysqli_num_rows($items) > 0)
							{
								//form the HTML table
								echo "<table class='styled-table'>";
								echo "	<tr>";
								echo "		<th>Item Code</th>";
								echo "		<th>Description</th>";
								echo "		<th>Price</th>";
								echo "		<th>Quantity</th>";
								echo "		<th>Status</th>";
								echo "	</tr>";

								//loop each record in the $items recordset and display it
								while($record = mysqli_fetch_assoc($items))
								{
									echo "<tr>";
									echo "	<td>".$record["itemcode"]."</td>";
									echo "	<td>".$record["description"]."</td>";
									echo "	<td>".$record["price"]."</td>";
									echo "	<td>".$record["quantity"]."</td>";
									echo "	<td>".$record["status"]."</td>";
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
							echo "<p>Sorry, error connecting to database...</p>";

						}

						mysqli_close($con);


					}

				?>			
			</form>
		</div>
	</body>
</html>
