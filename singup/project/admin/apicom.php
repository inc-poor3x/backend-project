<?php
include 'include.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = $_GET['id'];
    $st = $_GET['st'];

    if ($conn) {
        $sql = "UPDATE comment SET statis = $st WHERE Id = $data";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("message" => "Status updated to $st for ID $data"));
        } else {
            echo json_encode(array("error" => "Failed to update status: " . mysqli_error($conn)));
        }
    } else {
        echo json_encode(array("error" => "Connection error"));
    }
} else {
    echo json_encode(array("error" => "Please provide the 'Id' in the data."));
}

header("location: inbox.html");
?>
