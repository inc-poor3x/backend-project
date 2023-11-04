<?php
include 'include.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['Id'])) {
        $userId = $data['Id'];

        // Check if the user exists
        $checkUserQuery = "SELECT * FROM users WHERE Id = $userId";
        $checkUserResult = $conn->query($checkUserQuery);

        if ($checkUserResult->num_rows > 0) {
            $existingData = $checkUserResult->fetch_assoc();

            $updateFields = array();

            // Loop through all columns in the 'users' table and construct the update query
            foreach ($existingData as $key => $value) {
                if (isset($data[$key]) && $key !== 'Id') {
                    $updateFields[] = "$key = '" . ($data[$key] !== null ? $data[$key] : $value) . "'";
                }
            }

            if (!empty($updateFields)) {
                $updateQuery = "UPDATE users SET " . implode(', ', $updateFields) . " WHERE Id = $userId";

                if ($conn->query($updateQuery) === TRUE) {
                    echo json_encode(array("message" => "User details updated successfully."));
                } else {
                    echo json_encode(array("error" => "Error updating user details: " . $conn->error));
                }
            } else {
                echo json_encode(array("message" => "No fields to update provided."));
            }
        } else {
            echo json_encode(array("error" => "User not found."));
        }
    } else {
        echo json_encode(array("error" => "Please provide the user ID."));
    }
} else {
    echo json_encode(array("error" => "Invalid request method. Please use PUT method."));
}

$conn->close();
?>



<!-- 
{
    "Id": 7,
    "username": "laith",
    "password": "new_password",
    "email": "new_email@lait.com",
    "date_of_birth": "1990-05-20",
    "img": "new_profile_pic.jpg",
    "name": "New Name",
    "Role": 2
} -->