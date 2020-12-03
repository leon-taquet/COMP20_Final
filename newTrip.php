<?php session_start(); ?>
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
$userID = $_SESSION["userID"];

$sql1 = "SELECT * FROM trips WHERE userID = '$userID' AND tripname = '$tripName'";
$result = $conn->query($sql1);
if ($result->num_rows == 0) {
        $sql = "INSERT INTO trips (tripname, default_currency, userID) VALUES ('$tripName', '$defaultCurrency', '$userID')";
        $conn->query($sql);
        echo "<meta http-equiv='refresh' content='1; URL=https://aboutlct.000webhostapp.com/Final/trip.php' />";
}
else {
        echo "<h3> Trip name taken. Please enter a different name. </h3>";
        echo "<meta http-equiv='refresh' content='1; URL=https://aboutlct.000webhostapp.com/Final/dashboard.php' />";

}


// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

?>
</head>
</html>
