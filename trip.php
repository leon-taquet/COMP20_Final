<?php
// Start the session
session_start();
//From Dashboard
extract($_POST);
$loginID = $_SESSION["userID"];
$homeCurrency = $_SESSION["HomeCurrency"];
$_SESSION["tripID"] = $tripid;
$_SESSION["tripname"] = $tripname;
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="Stylesheet.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"
integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
crossorigin="anonymous">
</script>
<title> Trip Detail </title>
<style>
    h1 {
        text-align: center;
        font-family: Times New Roman;
        font-variant: small-caps;
        font-size: 50px;
        padding-top: 10px;
        padding-bottom: 10px;
        color: black;
        }
    .bod{
        width: 70%;
        margin: 0 auto;
        /*background-color: #EAEFFA;*/
    }
    table{
        width:100%;
        margin: 0 auto;
        border: 3px solid black;
        padding: 10px 10px;
    }
    th {
      border: 1px solid black;
      text-align: center;
      padding:3px 3px;

    }

    tr{
        padding: 10px 10px;
        border: 1px solid black;
    }
    td {
        padding-bottom: 20px;
        padding-right: 10px;
        padding-left: 10px;
        border: 1px solid black;
        text-align:center;
    }
    input {
        font-family: Times New Roman;
        font-variant: none;
    }
    button {
            width: 100%;
            text-align: center;
            margin: 0 auto;
            padding: 5px 5px;
            font-size: 20px;
            font-family: Times New Roman;
            font-variant: small-caps;
            border-radius: 15px;
            border-width: 5px;
            border-color: #4380FE;


        }
    button:hover {
            background-color: #4380FE;
            color: white;
    }
    #addExpenseForm {
        display: none;
    }
    .errMsg {color: #FF0000;
        border: solid 1px #d20e11;
        display: none;
        padding: 1px 15px;
    }
</style>
<script language="javascript">
//function showForm()
//{
//document.getElementById("addExpenseForm").style.display='display';
//}


function getDate()
{
    today = new Date();
    day = today.getDate();
    if (day < 10)
        day = "0" + day;
    month = today.getMonth() + 1;
    if (month < 10)
        month = "0" + month;
    fullDate = today.getFullYear() + "-" + month + "-" + day;
    return fullDate;
}

function checkDate(dateS)
{
    // Check that date entered is in valid format
    if (dateS.length != 10)
        return false;
    for (i = 0; i < 10; i++)
    {
        if (i == 4 || i == 7)
        {
            if (dateS[i] != "-")
                return false;
        }
        else if (isNaN(parseInt(dateS[i])))
            return false;
    }
    // Check that date is not in the future
    today = new Date();
    if (parseInt(dateS.substring(0,4)) > today.getFullYear())
        return false;
    else if (parseInt(dateS.substring(5,7)) > (today.getMonth()+1))
        return false;
    else if (parseInt(dateS.substring(8)) > today.getDate())
        return false;
    return true;
}

function checkAmount(amount)
{
    if (amount == "" || isNaN(parseInt(amount)))
        return false;
    else
        return true;
}

function validate()
{
    err = false;
    document.getElementById("errName").style.display = "none";
    document.getElementById("errType").style.display = "none";
    document.getElementById("errAmount").style.display = "none";
    document.getElementById("errDate").style.display = "none";
    with (document.forms[0])
    {
        if (expenseN.value == "")
        {
            document.getElementById("errName").style.display = "inline-block";
            expenseN.focus();
            err = true;
        }
        // if (expenseT.value == "")
        // {
        //     document.getElementById("errType").style.display = "inline-block";
        //     expenseT.focus();
        //     err = true;
        // }
        if (!checkAmount(expenseForeign.value))
        {
            document.getElementById("errAmount").style.display = "inline-block";
            expenseForeign.focus();
            err = true;
        }
        if (!checkDate(date.value))
        {
            document.getElementById("errDate").style.display = "inline-block";
            date.focus();
            err = true;
        }
    }
    return !err;
}

function useAPI(foreign, home, date, amount)
{
    document.getElementById("amountForeign").value = parseFloat(amount).toFixed(2);
    request = new XMLHttpRequest();
    request.open("GET", "http://api.currencylayer.com/"
        + "historical?access_key=782d6f73de40f0bd7651de14e8196b0e&date=" + date
        + "&currencies=" + foreign + "," + home, true);
    request.onreadystatechange = function()
    {
        if (request.readyState == 4 && request.status == 200)
        {
            parsed = JSON.parse(request.responseText);
            conversion = (amount / parsed.quotes["USD" +
                foreign]) / parsed.quotes["USD" + home];
            document.getElementById("amountHome").value = conversion.toFixed(2);
        }
    } // end of state change function
    request.send();
}

window.onload = function()
{
    with(document.forms[0])
    {
        expenseForeign.onchange = function()
        {
          <?php
            echo "var home = '$homeCurrency';";
           ?>
            foreign = $("input[name^='foreignCurr']").val();

            if (checkDate(date.value) && checkAmount(expenseForeign.value))
            {
                //INR is "foreign", GBP is "home"
                //$homeCurrency
                //For foreign use default \
                useAPI(foreign, home, date.value, expenseForeign.value);
            }
        }
        date.onchange = function()
        {
            if (checkDate(date.value) && checkAmount(expenseForeign.value))
            {
                useAPI(foreign, home, date.value, expenseForeign.value);
            }
        }
    }
    //function showForm()
    //{
    $('#addexpense').click( function(){
      $("#addExpenseForm").slideToggle(500);
      //document.getElementById("addExpenseForm").style.display='display';
    });

}
</script>
</head>


<body>
	<header><a class="header" href="dashboard.php">International Travel Expense Tracker</a></header>

	<nav>
			<ul>
					<div class="leftnav">
							<li><a href = "aboutdash.html">About</a></li>
							<li><a href = "dashboard.php">Dashboard</a></li>
							<div class="rightnav">

									<!-- END SESSION IF CLICKED -->
									<li><a href = "logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a> </li>

							</div>
					</div>
			</ul>
	</nav>

	<div class="bod">

	<?php
    echo "<h1>" . $tripname . "</h1>";

		/*
		This page connects to the MySQL server and display all previous
		expense entries of a user.

		William Huang
		*/

		//for server page
		$servername = "localhost";
		$username = "id14882043_ltaque01";
		$password = "WilliamLeonKateriJulia4!";
		$dbname = "id14882043_itet";


		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		else {
			 //echo "connection successful!<br>";
		}

		// $sql = "SELECT tripname, categories.name, expense_date, expense_name,
		// 				cost_local, local_currency,
		// 				default_currency,	cost_home,
		// 				tripID, local_currency, CategoryID
		// 				FROM trips INNER JOIN expenses INNER JOIN categories
		// 									 INNER JOIN users
		// 				ON tripID = trips.ID AND CategoryID = categories.ID
		// 				AND userID = users.ID
		// 				WHERE userID = $loginID AND tripname = '$tripName'";
    $sql = "SELECT tripname, categories.name, expense_date, expense_name,
		 				cost_local, local_currency,
		 				default_currency,	cost_home,
		 				tripID, local_currency, CategoryID
						FROM expenses INNER JOIN categories INNER JOIN trips
						ON CategoryID = categories.ID AND tripID = trips.ID
						WHERE tripID = $tripid";
		$result = $conn->query($sql);

	   //output data of each row in a table
		//header
		echo "
			<table><tr>
              <th> Date </th>
              <th> Name </th>
							<th> Category </th>
							<th> Local Cost </th>
							<th> Home Cost </th>
              <th> Edit </th>
              <th> Delete </th>
						 </tr>
		";
		//echo mysqli_num_rows($result);
		if (mysqli_num_rows($result) > 0) {

		  while($row = $result->fetch_assoc()) {
		    echo "<tr> <td>" . $row["expense_date"]
					 . "</td><td>" . $row["expense_name"]
           . "</td><td>" . $row["name"]
					 . "</td><td>" . $row["local_currency"] . number_format($row["cost_local"],2) 
					 . "</td><td>" . $row["default_currency"] .number_format($row["cost_home"],2) 
           . "</td><td>" . "Editbutton"
           . "</td><td>" . "DeleteButton"
           . "</td></tr>";

           

				$tripID = $row["tripID"];
				$localCurrency = $row["local_currency"];
		  }

			echo "</table>"; //. $homeCurrency . $localCurrency;

		} else {
		  echo "</table> 0 results";
		}

    $sql = "SELECT DISTINCT name, ID FROM categories ORDER BY name";
    $result = $conn->query($sql);


		//$conn->close();

	?>
	<br><br><br><br>
  <button type="button" id="addexpense" >Add Expense</button>
  <div id="addExpenseForm">
      <form method="post" onsubmit="return validate()" action="expense-validation.php">
          Expense Name: <input type="text" id="expenseName" name="expenseN" value="">
          <div id="errName" class="errMsg">Please enter an expense name.</div>
          <br>
          Category: <select name = "categoryID" size = '1'>
          <?php
          foreach($result as $row){
                if ($row['ID'] == 5)
                  echo "<option value = ".$row['ID']." selected>". $row['name'] ." </option>";
                else
                  echo "<option value = ".$row['ID'].">". $row['name'] ." </option>";
          }

      	   ?>
                    </select>
          <div id="errType" class="errMsg">Please enter an expense type.</div>
          <br>
          Amount in Foreign Currency: <input type="text" id="amountForeign" name="expenseForeign" value="">
          <div id="errAmount" class="errMsg">Please enter a numerical expense amount.</div>
          <br>
          <script type="text/javascript">
              code = "Date: <input type='text'id='expenseDate'name='date'value='" + getDate() + "'>"
              document.writeln(code);
          </script>
          <div id="errDate" class="errMsg">Please enter a valid date in the form "YYYY-MM-DD".</div>
          <br>
          Amount in Home Currency: <input type="text" id="amountHome" name="expenseHome">
          <?php
              $sql = "SELECT default_currency FROM trips WHERE ID = $tripid";
              $result = $conn->query($sql);
              foreach($result as $row){
                    echo "<input type='hidden' value = '".$row['default_currency']."' name = 'foreignCurr'>";
                    $_SESSION["default_currency"] = $row['default_currency'];
              }
              $conn->close();
           ?>
           <br>
          <input type="submit" value="Submit Expense">
      </form>
  </div>
  <br>
  </div>
  <br><br><br>
	<footer>ITET</footer>

</body>
</html>
