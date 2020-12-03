<html>
<head>
<meta http-equiv="refresh" content="1; URL=https://aboutlct.000webhostapp.com/Final/trip.php" />

<?php
$servername = "localhost";
$username = "id14882043_ltaque01";
$password = "WilliamLeonKateriJulia4!";
$database = "id14882043_itet";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";



extract ($_POST);

$sql = "INSERT INTO trips (tripname, default_currency, userID) VALUES ('$tripName', '$defaultCurrency', '$userID')";
$conn->query($sql);

// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

?>
</head>
</html>
