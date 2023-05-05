<!-- Carol Geng, entire file -->
<!-- This is the delete function for items to be deleted from the menu which is only allowed for the admin-->

<?php
session_start();
    include('db.php');
    echo "before";
    // check item id to be deleted
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        // check if logged in
        if(isset($_SESSION['email'])) {
            echo "inside";
            // delete item
            $query = "delete from items where item_id = '$id'";
            $result = mysqli_query($conn, $query);
            // redirect to edit items page
            if ($result) {
                header('Location: edititem.php');
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
    echo "after";

?>