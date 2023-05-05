<?php
session_start();
    include("db.php");
    include("header.php");

    $user_data = check_login($conn);
    if (!empty($_GET['type']) && !empty($_GET['id'])) {
        change_type($conn, $_GET['id'], $_GET['type']);
    }
?>

<!-- category -->
<html>
    <head>
        <title>Order</title>
    </head>
    <body  style="background-color:rgb(230, 230, 250);">
        <br>
        <div class="container my-4 mb-5">
        <div class="col-lg-2 text-center my-4" style="margin:auto;">     
            <h1 class="text-center">Menu </h1>
        </div>
        <div class="row">
        <!-- Fetch all the categories and use a loop to iterate through categories -->
        <?php 
            $sql = "SELECT * FROM `items`"; 
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
            $id = $row['item_id'];
            $cat = $row['category'];
            $name = $row['item_name'];
            $price = $row['item_price'];
            echo '<div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="img/card-'.$id. '.jpg" class="card-img-top" alt="image for this category" width="249px" height="270px">
                        <div class="card-body">
                        <h5 class="card-title">' . $name . '</h5>
                        <h6 class="card-title">' . $cat . ' &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; $' . $price . '</h6>
                        Quantity: <a value = "0" id='.$id. '>0</a> &emsp; <button class="btn btn-primary" type="button" onClick="onClick('.$id. ')">Add</button> <button class="btn btn-primary" type="button" onClick="onClick2('.$id. ')">Remove</button> 

                        </div>
                    </div>
                    
                    </div>';
            }
        ?>
        
                </div>
                <br>
                <br>
                <br>
                <div style="text-align:right;">
                <form action="confirm.php">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
                 </div>
                
        </div>
            
        
    </body>
</html>

<script>

var quantities = {};

function onClick(id) {
  if (!(id in quantities)) {
    quantities[id] = 0;
  }
  quantities[id] += 1;
  document.getElementById(id).innerHTML = quantities[id];
}

function onClick2(id) {
  if (!(id in quantities)) {
    quantities[id] = 0;
  }
  quantities[id] -= 1;
  if (quantities[id] < 0) {
    quantities[id] = 0;
  }
  document.getElementById(id).innerHTML = quantities[id];
}

</script>