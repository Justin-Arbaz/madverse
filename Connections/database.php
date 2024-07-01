

<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "mydb";
$database = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$database) {
    die("Something went wrong;");
}

?>