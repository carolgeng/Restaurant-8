<?php
    include("db.php");
    include("functions.php");
    $user_data = check_login($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    
        <style>
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark mb-5">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Restaurant 8</a>
                <ul class="navbar-nav">
                <?php if ($user_data['type'] == 'admin') { ?>
                    <li class="nav-item">
                        <a class='nav-link' href='accounts.php'>Manage Accounts</a>
                    </li>
                <?php } ?>
                <?php if ($user_data['type'] == 'admin') { ?>
                    <li class="nav-item">
                        <a class='nav-link' href='edititem.php'>Manage Items</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="food.php">Order</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="reviews.php">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="edit.php">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                </ul>
            </div>
        </nav>
    
    </body>
</html>