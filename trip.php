<?php
// Start the session
session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> Trip Detail </title>
</head>

<body>
	
	<h1> Trip Detail </h1>
	
	<?php
		
		/*
		This page connects to the MySQL server and display all previous
		expense entries of a user.
		
		William Huang
		*/
		
		
		
		//for server page
		$servername = "localhost";
		$username = "id14882043_ltaque01";
		$password = "WilliamLeonKateriJulia4!";
		$dbname = "id14882043_itet";

		//From Dashboard (TO DO)!!!
		
		$tripName = $_POST["tripid"];
		$loginID = $_SESSION["userID"];
		echo ".$tripName. <br> . $loginID. <br>";
		
		//$_SESSION["tripID"] = $tripID;
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT tripname, categories.name, expense_date, expense_name,
						cost_local, local_currency,
						default_currency,	cost_home 	 
						FROM trips INNER JOIN expenses INNER JOIN categories 
											 INNER JOIN users
						ON tripID = trips.ID AND CategoryID = categories.ID
						AND userID = users.ID
						WHERE tripID = " .$tripID; //???
		$result = $conn->query($sql);



		
		//output data of each row in a table
		//header
		echo "
			<table><tr>
								<th> Trip </th>
								<th> Category </th>
								<th> Date </th>
								<th> Name </th>
								<th> Local Currency </th>
								<th> Local Cost </th>
								<th> Home Currency </th>
								<th> Home Cost </th>
						 </tr>
		";

		if ($result->num_rows > 0) {
			
		  while($row = $result->fetch_assoc()) {
		    echo "<tr> <td>" . $row["tripname"]
					 . "</td><td>" . $row["categories.name"]
					 . "</td><td>" . $row["expense_date"]
					 . "</td><td>" . $row["expense_name"]
					 . "</td><td>" . $row["cost_local"]
					 . "</td><td>" . $row["local_currency"]
					 . "</td><td>" . $row["default_currency"]
					 . "</td><td>" . $row["cost_home"] . "</td></tr>";
		  }
			
			echo "</table>";
			
		} else {
		  echo "</table> 0 results";
		}
		$conn->close();

	?>
	
	
</body>
</html>