<?php
session_start();
    include("db.php");
    include("header.php");

    $user_data = check_login($conn);
    if (!empty($_GET['type']) && !empty($_GET['id'])) {
        change_type($conn, $_GET['id'], $_GET['type']);
    }
?>

<!DOCTYPE html>

<section class="all-posts">

   <div class="heading"><h1>Reviews</h1></div>

   <div class="box-container">
   <div class="heading"><h1>user's reviews</h1> <a href="add_review.php?>" class="inline-btn" style="margin-top: 0;">Add Review</a></div>
   <?php 
            $sql = "SELECT * FROM `reviews`"; 
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
            $review_id = $row['review_id'];
            $user_id = $row['user_id'];
            $date = $row['review_date'];
            $description = $row['description'];
            $rating = $row['rating'];
            $url = $row['url'];
            // Display the review data
            echo "<p>Review by User #{$user_id}<p>";
            echo "<p>Description: {$description}</p>";
            echo "<p>Rating: {$rating}</p>";
            }
    ?>

   </div>

</section>
