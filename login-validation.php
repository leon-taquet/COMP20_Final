<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php
    $servername = "localhost";
    $usernameData = "id14882043_ltaque01";
    $passwordData = "WilliamLeonKateriJulia4!";
    $database = "id14882043_itet";
    // Create connection
    $conn = new mysqli($servername, $usernameData, $passwordData, $database);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    // echo "Connected successfully";

    // Add trip

    extract ($_POST);
    // Have username and password

    $sql = "SELECT ID, HomeCurrency FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      $msg = "<h1> Successful Log In... Forwarding to Trip Page </h1>";
      echo "<meta http-equiv='refresh' content='2;URL=http://aboutlct.000webhostapp.com/Final/dashboard.php' />";
      $user = $result->fetch_assoc();
      $_SESSION["HomeCurrency"] = $user['HomeCurrency'];
      $_SESSION["userID"] = $user['ID'];

    } else {
      $msg = "<h1> Invalid Log In... Sending back to Login Page </h1>";
      echo "<meta http-equiv='refresh' content='2;URL=http://aboutlct.000webhostapp.com/Final/login.html' />";
    }
    $conn->close();
    ?>
    <title></title>
  </head>
  <body>
    <?php
        echo $msg;
     ?>


  </body>
</html>
