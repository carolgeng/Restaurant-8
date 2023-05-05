<?php
session_start();

    include("header.php");
    
    
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $row = get_item($conn, $id);
    }
    else{
        header('Location: edititem.php');
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //something was posted
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
            //save to database
            
            $query = "update `items` set item_name='$name',item_price='$price',category='$category' WHERE item_id = '$id'";
            
            $result = mysqli_query($conn, $query);
            if ($result) {   
                echo "Updated successfully";
                header('Location: edititem.php');
            } else {
                echo "Failed: " .mysqli_error($conn);
            }
            die;
        }
    }
?>

<!doctype html>
<html>
    <head>
        <title>Edit Items</title>
        <style>
        </style>
    </head>
    <body>
        <div class='card mx-auto w-75'>
            <h1 class="card-header">Edit Items</h1>

            <form method='post' class="card-body">
                <div class='row'>
                    <div class='col'>
                        Item Name:
                        <input type="text" class="form-control" value=<?php echo $row['item_name'] ?> name='item_name'>
                    </div>
                </div>
                
                <div class='row'>
                    <div class='col'>
                        Price:
                        <input type='text' class="form-control" value=<?php echo $row['item_price'] ?> name='item_price'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col'>
                        Category:
                        <input type='text' class="form-control" value=<?php echo $row['category'] ?> name='category'>
                    </div>
                </div>
                

                <div class="d-grid gap-2">
                    <a href='deleteitem.php?id=<?php echo $row['item_id']?>' class="btn btn-outline-danger">Delete Item</a>
                    <input type='submit' value='Update' class="btn btn-outline-dark">
                    <!-- <a href='index.php' class="btn btn-outline-secondary">Cancel</a> -->
                </div>
                
            </form>
        </div>
    </body>
</html>