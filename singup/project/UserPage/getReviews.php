<?php
$commentSql = "SELECT * FROM comment WHERE User_Id = $userId AND Event_Id = $eventId";
$commentResult = mysqli_query($con, $commentSql);

if (mysqli_num_rows($commentResult) > 0) {
    while ($commentData = mysqli_fetch_assoc($commentResult)) {
        $commentId = $commentData['Id'];
        $commentText = $commentData['Comments_content'];
        $rating = $commentData['Rate'];
        $statusId = $commentData['statis'];

        if ($statusId === "1") {
           
            
            echo "<div class='event-cards'>";
            echo "<div class='event-card'>";
            echo "<h4>Review</h4>";
            echo "<p>Rating: $rating</p>";
            echo "<p>Comment: $commentText</p>";
            echo "<div class='edit-button'>";
            echo "<a href='editReview.php?review_id=$commentId'><button>Edit</button></a> ";
            echo "</div>";
            echo "<div class='edit-button'>";
            echo "<a href='deleteReview.php?review_id=$commentId'><button>Delete</button></a>";
            echo "</div>";
            echo "</div>";
           
        } elseif ($statusId === "2") {
           
            echo "<div class='event-cards'>";
            echo "<div class='event-card'>";
            echo "<h4>Review</h4>";
            echo "<p>Comment was rejected.</p>";
            echo "</div>";
        } elseif ($statusId === "3") {
            echo "<div class='event-cards'>";
            echo "<div class='event-card'>";
            echo "<h4>Review</h4>";
            echo "<p>Comment is awaiting approval.</p>";
            echo "</div>";
           
        }
    }
} else {
    echo "<div class='event-cards'>";
    echo "<div class='event-card'>";
    echo "<p>No reviews found.</p>";
    echo "<div class='edit-button'>";
    echo "<a href='createReview.php?review_id=$eventId'><button>Create</button></a>";
    echo "</div>";

}

?>