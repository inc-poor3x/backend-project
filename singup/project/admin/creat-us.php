<?php
include 'include.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)) {
    $requiredFields = ['username', 'password', 'email', 'date_of_birth', 'img', 'name'];
    $allFieldsPresent = true;

    foreach ($requiredFields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            $allFieldsPresent = false;
            break;
        }
    }

    if ($allFieldsPresent) {
        $sql = "INSERT INTO users (username, password, email, date_of_birth, img, name) VALUES (
            '{$data['username']}',
            '{$data['password']}',
            '{$data['email']}',
            '{$data['date_of_birth']}',
            '{$data['img']}',
            '{$data['name']}'
        
        )";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("message" => "User record created successfully."));
        } else {
            echo json_encode(array("error" => "Error: " . $conn->error));
        }
    } else {
        echo json_encode(array("error" => "Please provide all required fields."));
    }
} else {
    echo json_encode(array("error" => "No data received."));
}

$conn->close();
?>
