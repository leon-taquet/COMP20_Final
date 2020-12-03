<?php session_start(); ?>
<!-- trip.html
Author: HTeamML
Comp20 Fall 2020-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="Stylesheet.css">
    <style>
        input{
            font-family: Times New Roman;
            font-variant: none;
        }
        #addTripForm {
            display: none;
        }
    </style>
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
    ?>

    <script type="text/javascript">
        function AddTripShow() {
            document.getElementById("addTripForm").style.display='block';
            document.getElementById("addtripbutton").style.display='none';
        }
        // function completeAndReload() {
        //     <?php
        //     extract ($_POST);
        //     $sql = "INSERT INTO trips (tripname, default_currency, userID) VALUES ('$tripName', '$defaultCurrency', '$userID')";
        //     $conn->query($sql);
        //     if ($conn->query($sql) === TRUE) {
        //         echo "New record created successfully";
        //     } else {
        //         echo "Error: " . $sql . "<br>" . $conn->error;
        //     }
        //     ?>
        // }
    </script>

</head>
<body>

    <header><a class="header" href="dashboard.php">International Travel Expense Tracker</a></header>

    <nav>
        <ul>
            <div class="leftnav">
                <li><a href = "aboutdash.html">About</a></li>
                <li><a href = "dashboard.php" class="currpage">Dashboard</a></li>
                <div class="rightnav">
                    <li><a href = #><span class="glyphicon glyphicon-log-out"></span> Logout</a> </li>
                </div>
            </div>
        </ul>
    </nav>

    <!-- BODY -->

    <h1>My Dashboard</h1>

    <?php
        //extract POST, get username, select where username =userid=userid
        $userID = $_SESSION["userID"];
        $sql = "SELECT * FROM trips WHERE userID = '$userID'";
        $result = $conn->query($sql);
        //SHOW ALL ROWS
        echo $result-> fetch_row()[0];
        //UPDATE PAGE ON ADDITION//
    ?>

    <br><br>

        <button type="button" id="addtripbutton" onclick="AddTripShow()">Add Trip</button>
        <div id="addTripForm">
        <form method="post" action="newTrip.php">
            Trip Name: <input type="text" name="tripName"/>
            &nbsp &nbsp &nbsp
            Default Currency: <input type="text" name="defaultCurrency"/>
            User ID: <input type="text" name="userID"/>
            <input type="submit" value="Add"/>
        </form>
    </div>


    <footer>ITET</footer>


</body>
</html>
