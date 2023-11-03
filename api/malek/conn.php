<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "backend-pro";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    // echo"Connected";
}
?>
