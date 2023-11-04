<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['review_id'])) {
    $reviewId = $_GET['review_id'];
    $sql = "DELETE FROM comment WHERE Id = '$reviewId'";

    if (mysqli_query($con, $sql)) {
        header('Location: userPage.php');
        exit;
    } else {
        echo "Error deleting review.";
    }
}

mysqli_close($con);
?>