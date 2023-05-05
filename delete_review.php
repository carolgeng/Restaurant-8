<?php
session_start();
    include('db.php');

    if (!empty($_GET['id'])) {
        $review_id = $_GET['id'];
    }

    #If res_id is not empty proceed to delete the specified entry 
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