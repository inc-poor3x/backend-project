

<?php
include 'conn.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'PUT'){

    // Method 'PUT'
    // recieve 
    // 1. 'u_id'
    // 2. 'e_id'

        $json_data = file_get_contents('php://input');

        $data = json_decode($json_data, true);
    

        if ($data === null) {
            echo "Invalid JSON data.";
        } else {
            // var_dump($data);
        }

        $u_id = filter_var($data['u_id'], FILTER_VALIDATE_INT);
        $e_id = filter_var($data['e_id'], FILTER_VALIDATE_INT);


        // get all user events dates
        $sql = "SELECT events.E_date
                FROM event_user 
                JOIN events ON events.E_Id = event_user.Event_Id 
                WHERE event_user.User_Id = 1 ;         
                ";
        $result = $conn->query($sql);

        $userDates = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userDates[] = $row;
            }
        }
        // echo '<pre>';
        // print_r($userDates);
        // echo '</pre>';

        // print_r($userDates);
        //get event date
        $sql = "SELECT E_date FROM `events` WHERE E_Id = $e_id      
                ";
        $result = $conn->query($sql);

        $eventDate;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $eventDate= $row['E_date'];
            }
        }

        $counter = 0;
        for ($i=0; $i <count($userDates) ; $i++) { 
            if (in_array($eventDate, $userDates[$i])) {
                $counter++;
            }
        }

        

        if ($counter>0) {
            echo "cant register";
        }
        else {
        
                $sql = "UPDATE `events` 
                SET `Num_of_sites`= Num_of_sites-1 
                WHERE E_Id = $e_id
                ;";
                
                $result = $conn->query($sql);

                $sql = "INSERT INTO `event_user`(`User_Id`, `Event_Id`) 
                        VALUES ('$u_id','$e_id')
                        ;";
                $result = $conn->query($sql);   
        }
        header('Content-Type: application/json');


}else {
    // This is not a POST request
    echo "This endpoint only accepts POST requests.";
}


// $conn->close();
?>

