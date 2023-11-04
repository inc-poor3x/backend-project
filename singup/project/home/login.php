<?php
session_start(); 

include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = json_decode(file_get_contents('php://input'), true);

  if ($data && isset($data["username"]) && isset($data["password"])) {
    $username = $data["username"];
    $password = $data["password"];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      $stored_password = $user["password"];

      if ($password === $stored_password) {

        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user['Id'];

        echo "You are logged in";
      } else {
        $response = array('error' => 'Invalid password');
        header("Content-Type: application/json");
        echo json_encode($response);
      }
    } else {
      $response = array('error' => 'Invalid username');
      header("Content-Type: application/json");
      echo json_encode($response);
    }

    $stmt->close();
  } else {
    $response = array('error' => 'Invalid JSON data');
    header("Content-Type: application/json");
    echo json_encode($response);
  }
}

$conn->close();
?>
