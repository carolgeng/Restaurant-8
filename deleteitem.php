<?php
session_start();
    include('db.php');
    echo "before";
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    
        if(isset($_SESSION['email'])) {
            echo "inside";
            $query = "delete from items where item_id = '$id'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                header('Location: edititem.php');
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
    echo "after";

?>