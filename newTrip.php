<?php
$servername = "localhost";
$username = "id14882043_ltaque01";
$password = "WilliamLeonKateriJulia4!";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
