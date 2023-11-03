<!-- 
    Method 'PUT'
    recieve 
    1. 'u_id'
    2. 'e_id'

    send
    1. 
-->
<?php
include 'conn.php';


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

        print_r($userDates);
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
        echo $eventDate;


        

        if (in_array($eventDate, $userDates)) {
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

}else {
    // This is not a POST request
    echo "This endpoint only accepts PUT requests.";
}






// function already_registered($e,$u,$conn){
//     $sql = "SELECT * 
//     FROM `event_user` 
//     WHERE `User_Id`= $u AND `Event_Id` = $e;
//     ;";
//     $result = $conn->query($sql);
//     if ($result->num_rows > 0) {
//         echo "user already registered";
//         return 0;
//     }else{
//         return true;
//     }
// }

// function user_events_dates($u,$conn){
//     //get all user events dates
//     $sql1 = "SELECT events.E_date
//     FROM event_user 
//     JOIN events ON events.E_Id = event_user.Event_Id 
//     WHERE event_user.User_Id = $u ;         
//     ";
//     $result1 = $conn->query($sql1);

//     $userDates = array();
//     if ($result1->num_rows > 0) {
//         while ($row = $result1->fetch_assoc()) {
//             $userDates[] = $row;
//         }
//     }
//         return $userDates;
    

// }


// $conn->close();
?>

