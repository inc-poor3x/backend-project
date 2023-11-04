<?php
  include "connection.php";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       // session_start();
    // if (!isset($_SESSION['userId'])) {
    //     header("Location: login.php");
    //     exit;
    // }
    // $userId = $_SESSION['userId']; //replace with actual formatting
  ;
      $userId = '1'; //delete this line after making other comment visible
      if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
          $image = $_FILES['image']['tmp_name'];
          $imagePath = $_FILES['image']['name'];
          move_uploaded_file($image, $imagePath);
          $sql = "UPDATE users SET img = '$imagePath' WHERE id = $userId";
          mysqli_query($con, $sql);
      }

      $username = $_POST["name"];
      $email = $_POST["email"];
      $birthday = $_POST["birthday"];
  
  
      $update_profile_query = "UPDATE users SET username = '$username', email = '$email', date_of_birth = '$birthday' WHERE Id = $userId";
      mysqli_query($con, $update_profile_query);
      
  
      header("Location: userPage.php");
    } else {
      $response = array(
        'error' => "User is not authenticated. Please log in."
      );
  
  
      header("Content-Type: application/json");
      echo json_encode($response);
    }
       mysqli_close($con);
    
      
  ?>
   