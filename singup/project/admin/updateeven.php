<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
include 'include.php';

$eventId = $_GET['id'];
echo$eventId;
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    
        

        // Check if the event exists
        $checkEventQuery = "SELECT * FROM events WHERE E_Id = $eventId";
        $checkEventResult = $conn->query($checkEventQuery);

        if ($checkEventResult->num_rows > 0) {
            $existingData = $checkEventResult->fetch_assoc();

            $updateFields = array();

            // Loop through all columns in the 'events' table and construct the update query
            foreach ($existingData as $key => $value) {
                if (isset($data[$key]) && $key !== 'E_Id') {
                    $updateFields[] = "$key = '" . ($data[$key] !== null ? $data[$key] : $value) . "'";
                }
            }

            if (!empty($updateFields)) {
                $updateQuery = "UPDATE events SET " . implode(', ', $updateFields) . " WHERE E_Id = $eventId";

                if ($conn->query($updateQuery) === TRUE) {
                    echo json_encode(array("message" => "Event details updated successfully."));
                } else {
                    echo json_encode(array("error" => "Error updating event details: " . $conn->error));
                }
            } else {
                echo json_encode(array("message" => "No fields to update provided."));
            }
        } else {
            echo json_encode(array("error" => "Event not found."));
        }
    
} else {
    echo json_encode(array("error" => "Invalid request method. Please use PUT method."));
}

$conn->close();
?>



