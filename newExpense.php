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

// Add trip

extract ($_POST);
// $userID;
// $name;
// $def_curr;

// $userID = 0;
// $name = "test";
// $def_curr = "USD";

$sql = "INSERT INTO trips (tripname, default_currency, userID) VALUES ('$tripName', '$defaultCurrency', '$userID')";
$conn->query($sql);

// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

?>
