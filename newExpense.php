<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
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
        // $expenseN;
        // $expenseT;
        // $expenseForeign; (Stored as a float)
        // $expenseHome; (Stored as a float)
        // $date;
        $expenseF = 40.00;
        $expenseH = 10.00;
        $trip = 1;
        $local_currency = "USD";
        $category = 1;

        $sql = "INSERT INTO expenses (expense_name, cost_home, cost_local,
            local_currency, CategoryID, tripID) VALUES ('$expenseN',
                '$expenseH', '$expenseF', '$local_currency',
                '$category', '$trip')";
        $conn->query($sql);

        $sql = "SELECT expense_date FROM expenses WHERE tripID=1";
        $result = $conn->query($sql);
        $date = $result->fetch_row()[0];
        echo $date . " This is the date.";
        // if ($conn->query($sql) === TRUE) {
        //   echo "New record created successfully";
        // } else {
        //   echo "Error: " . $sql . "<br>" . $conn->error;
        // }

        ?>
        <p></p>
    </body>
</html>
