<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "daczihu0";
$password = "2u4Y3ocdUI";
$dbname = "daczihu0_Englishexercises";

//$conn = mysqli_connect($servername, $username, $password, $dbname);
$conn = mysqli_connect("localhost", "daczihu0_daczihu0", "2u4Y3ocdUI", "daczihu0_Englishexercises");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!$conn->set_charset("utf8mb4")) {
    echo $conn->error;
} else {
    echo "";
}

?>