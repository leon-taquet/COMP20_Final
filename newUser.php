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
echo "Connected successfully";

// Add User

extract ($_POST);
//$username;
//$home_currency;
//$password;

$sql = "INSERT INTO users (username, HomeCurrency, password) VALUES ('$username', '$home_currency', $password)";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
