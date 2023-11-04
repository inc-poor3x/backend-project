<?php

include "include.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $data = json_decode(file_get_contents('php://input'), true);

    if ($data) {
        $username = $data["username"];
        $email = $data["email"];
        $password = $data["password"];
        $date_of_birth = $data["date_of_birth"];

        $insert_query = "INSERT INTO users (username, email, password, date_of_birth) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ssss", $username, $email, $password, $date_of_birth);

        if ($stmt->execute()) {
            $response = array('success' => true);
            echo json_encode($response);
        } else {
            $response = array('error' => "Error: " . $stmt->error);
            echo json_encode($response);
        }
    } else {
        $response = array('error' => "Invalid JSON data.");
        echo json_encode($response);
    }
}
?>
