<!-- Annie Ren, entire file -->

<?php
session_start();
    include("db.php");
    include("header.php");

    $user_data = check_login($conn);
    if (!empty($_GET['type']) && !empty($_GET['id'])) {
        change_type($conn, $_GET['id'], $_GET['type']);
    }

   $sql = "SELECT * FROM `items`";
   $all_items = mysqli_query($conn,$sql);

   //  get review data and insert into database
    if(isset($_POST['submit'])){
        
        $user_id = $user_data['user_id'];
        $description = $_POST['description'];
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $rating = $_POST['rating'];
        $rating = filter_var($rating, FILTER_SANITIZE_STRING);
        $item = $_POST['item'];

        $add_review = $conn->prepare("INSERT INTO `reviews`(user_id, description, rating, item_id) VALUES(?,?,?,?)");
        $add_review->execute([$user_id, $description, $rating, $item]);
        $success_msg[] = 'Review added!';
        header('location:all_reviews.php');
        die;
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
</div>

<!-- end post review -->

