<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
include 'conn.php';


    // Method 'POST'
    // recieve 'content'


if($_SERVER['REQUEST_METHOD'] == 'POST'){



        $json_data = file_get_contents('php://input');

        $data = json_decode($json_data, true);
        if ($data === null) {
            echo "Invalid JSON data.";
        } else {
            // var_dump($data);
        }

        $SearchContent = $data['content'];
        






$SearchContent = mysqli_real_escape_string($conn, $SearchContent); // Sanitize the inut

$sql = "SELECT * FROM `events` WHERE 
        LOWER(E_name) LIKE LOWER('%$SearchContent%') OR 
        LOWER(E_date) LIKE LOWER('%$SearchContent%') OR 
        LOWER(Category) LIKE LOWER('%$SearchContent%')
        ORDER BY E_date ASC
        ;";



$result = $conn->query($sql);
$searchResults = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
        // print_r($row);
    }
}
header('Content-Type: application/json');

echo json_encode($searchResults);

// print_r($searchResults);



}else {
    // This is not a POST request
    echo "This endpoint only accepts POST requests.";
}

// $conn->close();
?>

