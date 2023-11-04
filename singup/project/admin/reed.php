<?php
include 'include.php';
header("Content-Type: application/json");

if ($conn) {
    // Select all comments
    $sql = "SELECT * FROM comment";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $comments = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $comments[] = $row;
        }

        if (count($comments) > 0) {
            echo json_encode($comments);
        } else {
            echo json_encode(array("message" => "No comments found."));
        }
    } else {
        echo json_encode(array("error" => "Failed to retrieve comments: " . mysqli_error($conn)));
    }
} else {
    echo json_encode(array("error" => "Connection error"));
}
?>