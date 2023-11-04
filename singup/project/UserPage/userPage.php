<!DOCTYPE html>
<html>

<head>
    <title>User Page</title>
    <link rel="stylesheet" href="userPage.css">
</head>

<body>
<nav id="navbar" class="">
        <div class="nav-wrapper">
          <!-- Navbar Logo -->
          <div class="logo">
            <!-- Logo Placeholder for Illustration -->
            <a href="#home"><img width="80px" height="auto" style="z-index: 999;" src="603fa7500ceaef1becbea552e605a235-removebg-preview-removebg-preview.png"></a>
         
          </div>

          <!-- Navbar Links -->
          <ul id="menu">
            <li><a href="#home">Home</a></li><!--
         --><li><a href="#services">Services</a></li><!--
         --><li><a href="#about">About</a></li><!--
         --><li><a href="#contact">Contact</a></li>
         <span>
            <li><a href="login.html" id="links">Login</a></li>
            <li><a href="aa.html" id="logout-button">Logout</a></li>
         </span>
          </ul>

        </div>

      </nav>


      <!-- Menu Icon -->
      <div class="menuIcon">
        <span class="icon icon-bars"></span>
        <span class="icon icon-bars overlay"></span>
      </div>


      <div class="overlay-menu">
        <ul id="menu">
            <li><a href="#home">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
      </div>

   <!-- this section edits name and image -->
    <?php
       include "connection.php";
    // session_start();
    // if (!isset($_SESSION['userId'])) {
    //     header("Location: login.php");
    //     exit;
    // }
    // $userId = $_SESSION['userId']; //replace with actual formatting
    $userId = '5'; //delete after making comment visible
    $sql = "SELECT * FROM users WHERE id = '$userId'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    // print_r($row);
    $email = $row["email"];
    $birthday = $row["date_of_birth"];
    $name = $row['username'];
    $image = $row['img'];

    mysqli_close($con);
    ?>

    <div class="left">
        <div class="heading">
    </div>

    
    <!-- edit the details -->
    <?php 
 if (isset($_GET['edit'])): ?>
    <form action="editProfile.php" method="POST" enctype="multipart/form-data">
    <div class="profile-container">
    <div class="profile-picture">
      <img src="<?php echo $image; ?>" alt="Profile Image" width="100">
      </div>
      <div>
      <input class="edit-button" type="file" id="image" name="image">
    </div>
    <div class="profile-info">
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>">
      </div>
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>">
      </div>
      <div>
        <label for="birthday">Date of Birth:</label>
        <input type="date" id="birthday" name="birthday" value="<?php echo $birthday; ?>">
      </div>
      <div class="edit-button">
        <button>Save</button>
      </div>
    </div>
  </div>
</form>


    <!-- new output for html -->
    <?php else: ?>
     <div class="profile-container">
    <div class="profile-picture">
     <img src="<?php echo $image; ?>" alt="User Profile Picture">
    </div>
    <div class="profile-info">
      <p name="username"><strong>Username:<?php echo $name;?></strong></p>
      <p name="email"><strong>Email:</strong><?php echo $email; ?></p>
      <p name="birthday"><strong>Date of Birth:</strong><?php echo $birthday; ?></p>
    </div>
    <div class="edit-button">
    <a href="?edit=true"><button>Edit Information</button></a>
    </div>
  </div>
    <?php endif; ?>

    </div>
    <div class="right">
<!-- the users current registrations -->
    <!-- the users current registrations -->
    <table>
        <tr>
            <th>
    <h2>Current Registrations</h2>
    </th>
    </tr>


    <?php
    //  session_start();
    //  if (!isset($_SESSION['userId'])) {
    //      header("Location: login.php");
    //      exit;
    //  }
    //  $userId = $_SESSION['userId']; //replace with actual formatting
    $userId = '2'; // delete after making comment visible

    include "connection.php";
    
    $currentDate = date('Y-m-d');
    $sql = "SELECT * FROM event_user WHERE User_Id = $userId";
    $result = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        while ($event = mysqli_fetch_assoc($result)) {
            $eventId = $event['Event_Id'];
            $eventSql = "SELECT * FROM events WHERE E_Id = $eventId";
            $eventResult = mysqli_query($con, $eventSql);
    
            if (mysqli_num_rows($eventResult) > 0) {
                $eventData = mysqli_fetch_assoc($eventResult);
                $eventName = $eventData['E_name'];
                $eventLocation = $eventData['Location'];
                $eventDate = $eventData['E_date'];
                $eventImage = $eventData['Img'];
                $eventDescription = $eventData['Description'];
    
                if ($currentDate < $eventDate) {
                    echo "<td>";
                    echo "<div class='event-cards'>";
                    echo "<div class='event-card'>";
                    echo "<h4>$eventName</h4>";
                    echo "<img class='event-image' src='$eventImage'>";
                     echo "<p>Date: $eventDate </p>";
                     echo "<p>Location: $eventLocation </p>";
                     echo "<p>Description: $eventDescription</p>";
                     echo "<a href=''>Unregister</a> ";
                    echo "</div>";
                    echo "<td>";
                }
                else {
                    echo "<td>";
                    echo "<div class='event-cards'>";
                    echo "<div class='event-card'>";
                    echo "<p>No events found.</p>";
                    echo "</div>";
                    echo "<td>";

                    echo "</table>";


                }
            }
        }
    } 
    
    mysqli_close($con);
?>
<table>
<th>
<h2>Past Registrations</h2>
</th>
</tr>
<?php
// session_start();
// if (!isset($_SESSION['userId'])) {
//     header("Location: login.php");
//     exit;
// }
// $userId = $_SESSION['userId'];

include "connection.php";
$userId = 2;
$currentDate = date('Y-m-d');
$sql = "SELECT * FROM event_user WHERE User_Id = $userId";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($event = mysqli_fetch_assoc($result)) {
        $eventId = $event['Event_Id'];
        $eventSql = "SELECT * FROM events WHERE E_Id = $eventId";
        $eventResult = mysqli_query($con, $eventSql);

        if (mysqli_num_rows($eventResult) > 0) {
            $eventData = mysqli_fetch_assoc($eventResult);
            $eventName = $eventData['E_name'];
            $eventLocation = $eventData['Location'];
            $eventDate = $eventData['E_date'];
            $eventImage = $eventData['Img'];
            $eventDescription = $eventData['Description'];
            if ($currentDate > $eventDate) { 
                echo "<td>";
                echo "<div class='event-cards'>";
                echo "<div class='event-card'>";
                echo "<h4 class='name'>$eventName</h4>";
                echo "<p class='date'>$eventDate</p>";
                echo "</td>";
               
       
            } else {
                echo "<td>";
                echo "<div class='event-cards'>";
                echo "<div class='event-card'>";
                echo "<p>No events found.</p>";
                echo "</div>";
                echo "</td>";

            }

            echo "</div>";
            echo "</table>";
                
            }
           
        }
    }


mysqli_close($con);
?>
</body>
</html>