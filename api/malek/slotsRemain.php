











<?php
include 'conn.php';
    // Method 'POST'
    // recieve 'e_id'

if($_SERVER['REQUEST_METHOD'] == 'POST'){



        $json_data = file_get_contents('php://input');

        $data = json_decode($json_data, true);
    
        if ($data === null) {
            echo "Invalid JSON data.";
        } else {
            // var_dump($data);
        }


        $e_id = filter_var($data['e_id'], FILTER_VALIDATE_INT);





$sql = "SELECT Num_of_sites 
        FROM `events` 
        WHERE E_Id = $e_id

        ;";
$result = $conn->query($sql);
$slotsRemain=array();
if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $slotsRemain[] = $row['Num_of_sites'];
        header('Content-Type: application/json');
        echo json_encode($slotsRemain);
}
else{
    echo 'wrong event is number';
}
}else {
    // This is not a POST request
    echo "This endpoint only accepts POST requests.";
}

// $conn->close();
?>

