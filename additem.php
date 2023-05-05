<!-- Carol Geng, entire file -->
<!-- This is the add function for items to be added to the menu which is only allowed for the admin-->

<?php
session_start();

    include("header.php");
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //something was posted/ information to be added into database
        $name = $_POST['item_name'];
        $price = $_POST['item_price'];
        $category = $_POST['category'];

        $valid_entries = True;

       #check if any required fields are missing
        if(empty($name)) {
            echo "Item Name is empty";
            $valid_entries = False;
        }
        if(empty($price)) {
            echo "Price is empty";
            $valid_entries = False;
        }
        if(empty($category)) {
            echo "Category is empty";
            $valid_entries = False;
        }

        if($valid_entries) {
            //save and insert to database
            
            $query = "insert into items (item_name, item_price, category) values ('$name', '$price', '$category')";

            $result = mysqli_query($conn, $query);
            if ($result) {   
                echo "Added successfully";
                header('Location: edititem.php');
            } else {
                echo "Failed: " .mysqli_error($conn);
            }
            die;
        }
    }
?>
<!-- styling for add item page -->
<!doctype html>
<html>
    <head>
        <title>Add Item</title>
        <style>
        </style>
    </head>
    <body>
        <div class='card mx-auto w-75'>
            <h1 class="card-header">Add Item</h1>

            <!-- form information -->
            <form method='post' class="card-body">
                <div class='row'>
                    <div class='col'>
                        Item Name:
                        <input type="text" class="form-control" name='item_name'>
                    </div>
                </div>
                
                <div class='row'>
                    <div class='col'>
                        Price:
                        <input type='text' class="form-control" name='item_price'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col'>
                        Category:
                        <input type='text' class="form-control" name='category'>
                    </div>
                </div>
                
                <!-- submit button for add page -->
                <div class="d-grid gap-2">
                    <input type='submit' value='Add' class="btn btn-outline-dark">
                    <!-- <a href='index.php' class="btn btn-outline-secondary">Cancel</a> -->
                </div>
                
            </form>
        </div>
    </body>
</html>