<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['review_id'])) {
    $reviewId = $_GET['review_id'];
    $commentText = $_POST['comment'];
    $rating = $_POST['rating'];

    // Validate rating value
    if ($rating < 1 || $rating > 5) {
        echo "Rating should be between 1 and 5.";
        exit;
    }

    $sql = "UPDATE comment SET Comments_content = '$commentText', Rate = '$rating' WHERE Id = '$reviewId'";
    mysqli_query($con, $sql);

    header('Location: userPage.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Review</title>
</head>
<body>
    <?php
    $reviewId = $_GET['review_id'];
    $sql = "SELECT * FROM comment WHERE Id = '$reviewId'";
    $result = mysqli_query($con, $sql);
    $review = mysqli_fetch_assoc($result);
    $commentText = $review['Comments_content'];
    $rating = $review['Rate'];
    ?>

    <h2>Edit Review</h2>
    <form action="editReview.php?review_id=<?php echo $reviewId; ?>" method="POST">
        <div>
            <label for="rating">Rate:</label>
            <input type="number" id="rating" name="rating" min="1" max="5" value="<?php echo $rating; ?>">
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment"><?php echo $commentText; ?></textarea>
        </div>
        <div>
            <input type="submit" value="Save">
        </div>
    </form>
</body>
</html>