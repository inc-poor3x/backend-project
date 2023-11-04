<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include 'include.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($conn) {
        $query = "SELECT * FROM comment WHERE statis =3";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $comments = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $comments[] = $row;
            }

            // Output the JSON response
            echo json_encode($comments); // Output only JSON data without additional characters
        } else {
            echo json_encode(["message" => "No comments found"]);
        }
    } else {
        echo json_encode(["message" => "Connection error"]);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);

    if ($conn) {
        $comment_id = $_PUT['comment_id'];
        $status = $_PUT['status']; // Assuming 1 represents 'Yes' and 2 represents 'No'

        $update_query = "UPDATE comment SET statis = $status WHERE Id = $comment_id";

        if (mysqli_query($conn, $update_query)) {
            echo json_encode(["message" => "Comment status updated successfully"]);
        } else {
            echo json_encode(["message" => "Error updating comment status: " . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["message" => "Invalid data or request"]);
    }

} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>