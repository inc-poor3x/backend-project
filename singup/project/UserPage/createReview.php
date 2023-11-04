<?php
include "connection.php";
// session_start();
// if (!isset($_SESSION['userId'])) {
//     header("Location: login.php");
//     exit;
// }
// $userId = $_SESSION['userId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['event_id'])) {
    $eventId = $_GET['event_id'];
    $userName = '1'; // Replace with the actual username or identifier for the user
    $rating = $_POST['rating'];
    $commentText = $_POST['comment'];

    // Insert the review into the database with status 3
    $insertReviewSql = "INSERT INTO comment (Event_Id, username, Rate, review, statis) VALUES ('$eventId', '$userName', '$rating', '$commentText', '3')";
    mysqli_query($con, $insertReviewSql);

    // Redirect back to the user profile page
    header('Location: userPage.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Review</title>
</head>
<body>
    <h2>Create Review</h2>
    <form action="createReview.php?event_id=<?php echo $eventId; ?>" method="POST">
        <div>
            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required>
        </div>
        <div>
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment" required></textarea>
        </div>
        <div>
            <input type="hidden" name="status" value="3"> <!-- Add hidden input field for status -->
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>