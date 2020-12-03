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
        h1 {
            text-align: center;
            font-family: Times New Roman;
            font-variant: small-caps;
            font-size: 50px;
            padding-bottom: 10px;
        }   
        .bod{
            width: 70%;
            margin: 0 auto;
        }
        table{
            width:70%;
            margin: 0 auto;
        }
        input{
            font-family: Times New Roman;
            font-variant: none;
        }
        button {
            width: 20%;
            margin: 0 auto;

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
                    <!-- END SESSION IF CLICKED -->
                    <li><a href = "login.html"><span class="glyphicon glyphicon-log-out"></span> Logout</a> </li>   
                </div>
            </div>
        </ul>
    </nav>

    <div class="bod">

    <h1>My Dashboard</h1>


    <?php
        //extract POST, get username, select where username =userid=userid
        $userID = $_SESSION["userID"];
        $sql = "SELECT * FROM trips WHERE userID = '$userID'";
        $result = $conn->query($sql);
        //SHOW ALL ROWS
        print "<table>";
        foreach($result as $row){
            print " <tr>";
            foreach ($row as $name=>$value){
                print " <td>$value</td>";
            } // end field loop
            print " </tr>";
        } // end record loop
        print "</table>";
        //UPDATE PAGE ON ADDITION//
    ?> 

    <br><br>

        <button type="button" id="addtripbutton" onclick="AddTripShow()">Add Trip</button>
        <div id="addTripForm">
        <form method="post" action="http://aboutlct.000webhostapp.com/Final/newTrip.php">
            Trip Name: <input type="text" name="tripName"/> 
            &nbsp &nbsp &nbsp
            Default Currency: <input type="text" name="defaultCurrency"/>
            User ID: <input type="text" name="userID"/>
            <input type="submit" value="Add"/>
        </form>
    </div>
    </div>

    <footer>ITET</footer>


</body>
</html>