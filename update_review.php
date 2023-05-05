<!-- Annie Ren, entire file -->

<?php
session_start();
    
    include("header.php");
        
    # get review_id
    
    if (!empty($_GET['id'])) {
        $review_id = $_GET['id'];
        $row = get_review($conn, $review_id);
    }
    else{
        header('Location: all_reviews.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // get review id, updated rating and description

        $review_id = $row['review_id'];
        $rating = $_POST['rating'];
        $description = $_POST['description'];

      
        //save to database
        
        $query = "update `reviews` set rating='$rating',description='$description' WHERE review_id = '$review_id'";
        
        $result = mysqli_query($conn, $query);
        if ($result) {   
            echo "Updated successfully";
            header('Location: all_reviews.php');
        }
        die;
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>update review</title>
</head>
<body>

<!-- update a review -->
<div> 
<section class="account-form">


<section class="account-form">

        <form action="" method="post">
        <h3>Update Your Review</h3>
        <p>Review description</p>
        <textarea name="description" class="box" value= <?php echo $row['description']?> maxlength="1000" cols="30" rows="10"></textarea>
        <p>Review Rating <span></span></p>
        <select name="rating" class="box" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <input type="submit" value="submit review" name="submit" class="btn">
        </form>

</section>

</section>
</div>

<!-- end post review -->

