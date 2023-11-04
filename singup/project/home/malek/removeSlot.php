

<?php
// Method 'PUT'
// recieve 
// 1. 'u_id'
// 2. 'e_id'

// send
// 1. 
include 'conn.php';
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

        $u_id = filter_var($data['u_id'], FILTER_VALIDATE_INT);
        $e_id = filter_var($data['e_id'], FILTER_VALIDATE_INT);


        // get all user events dates
        $sql = "SELECT *
                FROM event_user 
                WHERE Event_Id = $e_id AND User_Id = $u_id  ;         
                ";
        $result = $conn->query($sql);




        

        if (!$result->num_rows > 0) {
            echo "cant remove";
        }
        else {
        
                $sql = "UPDATE `events` 
                SET `Num_of_sites`= Num_of_sites+1 
                WHERE E_Id = $e_id
                ;";
                
                $result = $conn->query($sql);

                $sql = "DELETE FROM `event_user` 
                        WHERE Event_Id = $e_id 
                        AND User_Id = $u_id
                        ;";
                $result = $conn->query($sql);   
        }

}else {
    // This is not a POST request
    echo "This endpoint only accepts PUT requests.";
}


// $conn->close();
?>

