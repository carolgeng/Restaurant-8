<!-- Annie Ren, entire file -->

<?php
session_start();
    
    include("header.php");
        
        
    if (!empty($_GET['id'])) {
        $review_id = $_GET['id'];
        $row = get_review($conn, $review_id);
    }
    else{
        header('Location: all_reviews.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //something was posted
        $name = $_POST['item_name'];
        $price = $_POST['item_price'];
        $category = $_POST['category'];

        $valid_entries = True;

        if($valid_entries) {
            //save to database
            
            $query = "update `reviews` set rating='$rating',description='$description' WHERE review_id = '$review_id'";
            
            $result = mysqli_query($conn, $query);
            if ($result) {   
                echo "Updated successfully";
                header('Location: all_reviews.php');
            }
            die;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>update review</title>
</head>
<body>

<!-- post a review -->
<div> 
<section class="account-form">

   <?php
       $query = "update `review` set rating='$rating',description='$description' WHERE review_id = '$id'";
        while($fetch_review = $select_review->fetch()){
   ?>
   <form action="" method="post">
      <h3>edit your review</h3>
      <input type="text" name="title" required maxlength="50"class="box"?>">
      <p >review description</p>
      <textarea name="description" class="box" maxlength="1000" cols="30" rows="10"><?= $fetch_review['description']; ?></textarea>
      <p >review rating <span></span></p>
      <select name="rating" class="box" required>
         <option value="<?= $fetch_review['rating']; ?>"><?= $fetch_review['rating']; ?></option>
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
      </select>
      <input type="submit" value="update review" name="submit" class="btn">
   </form>
   <?php
         }
   ?>

</section>
</div>

<!-- end post review -->

