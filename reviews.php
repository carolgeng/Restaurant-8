<!-- Annie Ren, entire file -->

<?php
session_start();
    include("db.php");
    include("header.php");

    $user_data = check_login($conn);
    if (!empty($_GET['type']) && !empty($_GET['id'])) {
        change_type($conn, $_GET['id'], $_GET['type']);
    }
     
    if(isset($_POST['submit'])){
        
        $user_id = $user_data['user_id'];
        $description = $_POST['description'];
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $rating = $_POST['rating'];
        $rating = filter_var($rating, FILTER_SANITIZE_STRING);

        $add_review = $conn->prepare("INSERT INTO `reviews`(user_id, description, rating) VALUES(?,?,?)");
        $add_review->execute([$user_id, $description, $rating]);
        $success_msg[] = 'Review added!';
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>add review</title>
</head>
<body>

<!-- post a review -->
<div> 
<section class="account-form">

   <form action="" method="post">
      <h3>Post Your Review</h3>
      <p>Review description</p>
      <textarea name="description" class="box" placeholder="enter review description" maxlength="1000" cols="30" rows="10"></textarea>
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
</div>

