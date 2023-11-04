<!-- 
    Method 'PUT'
    recieve 
    1. 'e_id'
    2. date

    send
    1. 
-->
<?php
include 'conn.php';
// if($_SERVER['REQUEST_METHOD'] == 'GET'){
// $SearchContent = $_GET['content'];

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'PUT'){



        $json_data = file_get_contents('php://input');

        $data = json_decode($json_data, true);
    
        if ($data === null) {
            echo "Invalid JSON data.";
        } else {
            var_dump($data);
        }



        $date = DateTime::createFromFormat('Y-m-d', $data['date']);

        if ($date !== false) {
            $sanitizedDate = $date->format('Y-m-d');
        } else {
            echo "Invalid date or format. Please use YYYY-MM-DD.";
        }
        $e_id = filter_var($data['e_id'], FILTER_VALIDATE_INT);





        $sql = "UPDATE `events` 
        SET `Last_registration`='$sanitizedDate' 
        WHERE E_Id = $e_id
        ;";
        $result = $conn->query($sql);
        if ($result) {
            echo "";
        }
        else {
            echo "error";
        }

}else {
    // This is not a POST request
    echo "This endpoint only accepts PUT requests.";
}

// $conn->close();
?>

