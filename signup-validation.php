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

// Add trip
extract ($_POST);

// Have username password
$sql = "SELECT ID FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $msg = "<h1> Username is taken... Sending back to Sign Up Page </h1>";
    echo "<meta http-equiv='refresh'" .
        "content='2;URL=http://itet.great-site.net/signup.php'/>";
}
else {
    $sql = "INSERT INTO users (username, HomeCurrency, password, name)" .
        "VALUES ('$username', '$hcurrency', '$password' ,'$name')";
    $conn->query($sql);
    $sql = "SELECT ID FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    $msg = "<h1> Successful Created Account... Forwarding to Trip Page </h1>";
    echo "<meta http-equiv='refresh' content='2;" .
        "URL=http://itet.great-site.net/dashboard.php' />";
    $userID = $result->fetch_row()[0];
    $_SESSION["HomeCurrency"] = $hcurrency;
    $_SESSION["userID"] = $userID;
}
$conn->close();
?>
<title>Loading...</title>
</head>

<body>
<?php
    echo $msg;
?>
</body>
</html>
