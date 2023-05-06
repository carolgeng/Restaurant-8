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

    $sql = "SELECT * FROM `items`";
    $all_items = mysqli_query($conn,$sql);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // get review id, updated rating and description

        $review_id = $row['review_id'];
        $rating = $_POST['rating'];
        $description = $_POST['description'];
        $item = $_POST['item'];

      
        //save to database
        
        $query = "update `reviews` set rating='$rating',description='$description',item_id='$item' WHERE review_id = '$review_id'";
        
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
        <br>
        <p>Review Rating</p>
        <select name="rating" class="box" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <br>
      <p>Review Item</p>
        <select name="item">
            <?php
                // use a while loop to fetch data
                // from the $all_categories variable
                // and individually display as an option
                while ($item = mysqli_fetch_array(
                        $all_items,MYSQLI_ASSOC)):;
            ?>
                <option value="<?php echo $item["item_id"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $item["item_name"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php
                endwhile;
                // While loop must be terminated
            ?>
        </select>
        <input type="submit" value="submit review" name="submit" class="btn">
        </form>

</section>

</section>
</div>

<!-- end post review -->

