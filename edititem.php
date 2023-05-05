<!-- Carol Geng, entire file -->
<!-- This is the delete function for items to be deleted from the menu which is only allowed for the admin-->

<?php
session_start();
    include("db.php");
    include("header.php");

    $user_data = check_login($conn);
    // if (!empty($_GET['type']) && !empty($_GET['id'])) {
    //     change_type($conn, $_GET['id'], $_GET['type']);
    // }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Items</title>
        
    </head>
    <body>
        <div class="container">
            <form action="additem.php">
                <button class="btn btn-primary" >Add Item</button>
            </form>
            
        </div>
        <br>
        <div class="container">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
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
                            <a class="btn btn-dark" href="item.php?id=<?php echo $row['item_id']?>">Edit</a>
                            </td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
                </table>
        </div>
    </body>
</html>