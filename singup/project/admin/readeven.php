<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include 'include.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $sql = "SELECT * FROM events";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $events = array();
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
        echo json_encode($events);
    } else {
        echo json_encode(array("message" => "No event records found."));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['E_Id'])) {
        $eventId = $data['E_Id'];
        $sql = "SELECT * FROM events WHERE E_Id = $eventId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $event = $result->fetch_assoc();
            echo json_encode($event);
        } else {
            echo json_encode(array("message" => "Event with the provided ID not found."));
        }
    } else {
        echo json_encode(array("error" => "Please provide the event ID."));
    }
} else {
    echo json_encode(array("error" => "Invalid request method."));
}

$conn->close();

?>
