<?php
session_start();
    include('db.php');

    #ID passed from revservation page
    $res_id = $_POST['res_id'];

    #If res_id is not empty proceed to delete the specified entry 
    if(isset($res_id)){
        $query = "delete from reservations where res_id = '$res_id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header('Location: reserve.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
?>