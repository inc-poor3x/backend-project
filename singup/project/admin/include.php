<?php
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "project-back"; // Define the database name here

$conn = new mysqli($servername, $username, $password, $dbname); // Corrected database selection

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// if ($conn) {
//   echo "Connected to the database successfully. <br>";
// } else {
//   die("Database selection failed: " . $conn->error);
// }
?>



