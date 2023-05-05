<!-- Annie Ren entire file -->

<?php
session_start();
    include('db.php');

    #get review_id

    if (!empty($_GET['id'])) {
        $review_id = $_GET['id'];
    }


    #delete review from table if it matches review_id
    if(isset($review_id)){
        $query = "delete from reviews where review_id = '$review_id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header('Location: all_reviews.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
?>