<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "phptoets2018";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Verbinding mislukt");
}
?>