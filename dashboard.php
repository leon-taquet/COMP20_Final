<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="Stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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

        tr{
            padding: 10px 10px;
        }
        input{
            font-family: Times New Roman;
            font-variant: none;
        }
        button {
            width: 70%;
            text-align: center;
            margin: 0 auto;
            font-size: 25px;
            font-family: Times New Roman;
            font-variant: small-caps;
            justify-content: center;
        }
        .lbutton {
            background-color: #E9E9E9;
            color: #00508F;
            border: 2px solid black;
            padding: 20px 20px;
            border-radius: 10px;
        }
        .lbutton:hover{
            background-color: white;
        }
        #addTripForm {
            display: none;
        }
        #hiddenTripId {
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
                    <li><a href = "logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a> </li>

                </div>
            </div>
        </ul>
    </nav>

    <div class="bod">

    <h1>My Dashboard</h1>


    <?php
        $count = 0;
        $userID = $_SESSION["userID"];
        $sql = "SELECT * FROM trips WHERE userID = '$userID'";
        $result = $conn->query($sql);
        print "<table>";
        foreach($result as $row){
            if ($count % 2 == 0) {
                print "<tr><td>";
                print "<form action='http://aboutlct.000webhostapp.com/Final/trip.php' method='post'>
              <input type='submit' class='lbutton' name='tripid' value='" . $row['tripname'];
                print "'/> </form></td>";
            }
            else {
                print "<td>";
                print "<form action='http://aboutlct.000webhostapp.com/Final/trip.php' method='post'>
              <input type='submit' class='lbutton' name='tripid' value='" . $row['tripname'];
                print "'/> </form></td></tr>";
            }
            // print "<td>";
            // print $row['tripname'];
            // //SHOW ALL FIELDS 
            // // for ($row as $name=>$value){
            // //     print " <td>$value</td>";
            // // } // end field loop
            // print " </td></tr>";
            $count += 1;
        } // end record loop
        if ($count % 2 ==0) {
            print "</tr>";
        }
        print "</table>";


        //UPDATE PAGE ON ADDITION//
    ?>

    <br><br>

        <button type="button" id="addtripbutton" onclick="AddTripShow()">Add Trip</button>
        <div id="addTripForm">
        <form method="post" action="newTrip.php">
            Trip Name: <input type="text" name="tripName" required />
            &nbsp &nbsp &nbsp
            Default Currency: <input type="text" name="defaultCurrency" required/>
            <input type="submit" value="Add"/>
        </form>
    </div>
    </div>


    <footer>ITET</footer>


</body>
</html>
