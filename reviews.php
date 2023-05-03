<!-- <?php
session_start();

    include("header.php");
    
    $row = check_login($conn);

    // handle user reviews
    if (isset($_POST['submit_review'])) {
        // get form data
        $user_id = $_POST['user_id'];
        $description = $_POST['description'];
        $rating = $_POST['rating'];
        $url = $_POST['url'];
        
        // insert review into database
        $sql = "INSERT INTO reviews (user_id, review_date, description, rating, url) VALUES ('$user_id', NOW(), '$description', '$rating', '$url')";
        if (mysqli_query($conn, $sql)) {
        echo "Review added successfully.";
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // handle editing reviews
    if (isset($_POST['edit_review'])) {
        // get form data
        $review_id = $_POST['review_id'];
        $description = $_POST['description'];
        $rating = $_POST['rating'];
        $url = $_POST['url'];
    
        // update review in database
        $sql = "UPDATE reviews SET description = '$description', rating = '$rating', url = '$url' WHERE review_id = '$review_id'";
        if (mysqli_query($conn, $sql)) {
        echo "Review edited successfully.";
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // handle deleting reviews
    if (isset($_POST['delete_review'])) {
        // get review ID
        $review_id = $_POST['review_id'];
    
        // delete review from database
        $sql = "DELETE FROM reviews WHERE review_id = '$review_id'";
        if (mysqli_query($conn, $sql)) {
        echo "Review deleted successfully.";
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // display reviews
    $sql = "SELECT * FROM reviews";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Review ID: " . $row['review_id'] . "<br>";
        echo "User ID: " . $row['user_id'] . "<br>";
        echo "Review Date: " . $row['review_date'] . "<br>";
        echo "Description: " . $row['description'] . "<br>";
        echo "Rating: " . $row['rating'] . "<br>";
        echo "URL: " . $row['url'] . "<br>";

        // display edit and delete buttons
        echo "<form method='post' action=''>
                <input type='hidden' name='review_id' value='" . $row['review_id'] . "'>
                <label for='description'>Description:</label>
                <input type='text' name='description' value='" . $row['description'] . "'>
                <br>
                <label for='rating'>Rating:</label>
                <input type='text' name='rating' value='" . $row['rating'] . "'>
                <br>
                <label for='url'>URL:</label>
                <input type='text' name='url' value='" . $row['url'] . "'>
                <br>
                <input type='submit' name='edit_review' value='Edit'>
                <input type='submit' name='delete_review' value='Delete'>
            </form>";
        echo "<hr>";
    }
    }

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Restaurant Reviews</title>
  </head>
  <body>
    <h1>Restaurant Reviews</h1>
    
    <h2>Add a Review</h2>
    <form method="post" action="review.php">
      <label for="description">Description:</label>
      <input type="text" name="description"><br>
      <label for="rating">Rating:</label>
      <input type="text" name="rating"><br>
      <label for="url">URL:</label>
      <input type="text" name="url"><br>
      <input type="submit" name="submit_review" value="Submit">
    </form>

    <h2>Edit or Delete a Review</h2>
    <!-- <?php
      // connect to the database
      $conn = mysqli_connect('localhost', 'username', 'password', 'restaurant_db');

      // check connection
      if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
      }

      // display reviews
      $sql = "SELECT * FROM reviews";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          echo "Review ID: " . $row['review_id'] . "<br>";
          echo "User ID: " . $row['user_id'] . "<br>";
          echo "Review Date: " . $row['review_date'] . "<br>";
          echo "Description: " . $row['description'] . "<br>";
          echo "Rating: " . $row['rating'] . "<br>";
          echo "URL: " . $row['url'] . "<br>";

          // display edit and delete buttons
          echo "<form method='post' action='review.php'>
                  <input type='hidden' name='review_id' value='" . $row['review_id'] . "'>
                  <label for='description'>Description:</label>
                  <input type='text' name='description' value='" . $row['description'] . "'>
                  <br>
                  <label for='rating'>Rating:</label>
                  <input type='text' name='rating' value='" . $row['rating'] . "'>
                  <br>
                  <label for='url'>URL:</label>
                  <input type='text' name='url' value='" . $row['url'] . "'>
                  <br>
                  <input type='submit' name='edit_review' value='Edit'>
                  <input type='submit' name='delete_review' value='Delete'>
                </form>";
          echo "<hr>";
        }
      } else {
        echo "No reviews found.";
      }
    ?> -->
  </body>
</html> -->