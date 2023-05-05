<!-- Carol Geng, entire file -->
<!-- This displays the information for the items if you're the admin. The items can be edited or an item can be added here-->

<?php
session_start();
    include("db.php");
    include("header.php");

    // check if you're admin
    $user_data = check_login($conn);
    
?>
<!-- css styling -->
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Items</title>
        
    </head>
    <body>
        <div class='card mx-auto w-75'>
            <!-- add item button -->
            <h1 class="card-header d-flex">Current Items   
                    <a href="additem.php" class="btn btn-success ms-auto">Add Item</a>
            </h1>
            <br>
            <div class="container">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <!-- table headers -->
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- query to get the items from database and display them onto the item screen -->
                        <?php
                            $query = "select * from items";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                <th scope="row"><?php echo $row['item_id'] ?></th>
                                <td><?php echo $row['item_name'] ?></td>
                                <td><?php echo $row['item_price'] ?></td>
                                <td><?php echo $row['category'] ?></td>
                                <td>
                                <!-- button to edit and redirect to a screen where you can edit the item chosen -->
                                <a class="btn btn-dark" href="item.php?id=<?php echo $row['item_id']?>">Edit</a>
                                </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                    </table>
            </div>
        </div>
        
    </body>
</html>