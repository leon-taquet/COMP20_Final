<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php
        $servername = "sql313.epizy.com";
        $usernameData = "epiz_27473726";
        $passwordData = "Aq3RuBCHCGEy";
        $database = "epiz_27473726_ITET";
    // Create connection
    $conn = new mysqli($servername, $usernameData, $passwordData, $database);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";

    // Add trip
    // foreach($_POST as $key=>$value){
    // echo $key.' '.$value."\n";
    // }

    // Have username and password

    // prepare and bind
    //extract($_POST)
    $trip = $_SESSION["tripID"];


    $sql = "DELETE FROM trips WHERE ID = $trip";

    $conn->query($sql);

    $sql = "DELETE FROM expenses WHERE tripID = $trip";

    $conn->query($sql);

      echo "<meta http-equiv='refresh' content='0;URL=http://itet.great-site.net/dashboard.php' />";

    $conn->close();
    ?>
    <title></title>
  </head>
  <body>



  </body>
</html>
