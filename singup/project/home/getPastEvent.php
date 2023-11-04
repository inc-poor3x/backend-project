
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include 'include.php';


if($_SERVER['REQUEST_METHOD'] == 'GET'){



        // $json_data = file_get_contents('php://input');

        // $data = json_decode($json_data, true);
    
        // if ($data === null) {
        //     echo "Invalid JSON data.";
        // } else {
        //     // var_dump($data);
        // }


        // $e_id = filter_var($data['e_id'], FILTER_VALIDATE_INT);





$sql = "SELECT *
        FROM `events` 
        WHERE E_date < CURRENT_DATE

        ;";
$result = $conn->query($sql);
$slotsRemain=array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
        // print_r($row);
    }
    header('Content-Type: application/json');
    
    echo json_encode($searchResults);
}
else{
    echo 'no past event';
}
}else {
    // This is not a POST request
    echo "This endpoint only accepts POST requests.";
}

// $conn->close();
?>

