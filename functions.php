<?php

function check_login($conn) {
    if(isset($_SESSION['email'])) {
        $id = $_SESSION['email'];
        $query = "select * from users where email = '$id' limit 1";
        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    //redirect to login page
    header("Location: login.php");
    die;
}

function change_type($conn, $id, $type) {
    $query = "update users set type='$type' WHERE user_id = '$id'";
    $result = mysqli_query($conn, $query);
    header("Location: accounts.php");
}

function get_item($conn, $id) {
    if(isset($_SESSION['email'])) {
        $query = "select * from items where item_id = '$id' limit 1";
        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0) {
            $item_data = mysqli_fetch_assoc($result);
            return $item_data;
        }
    }

    //redirect to login page
    header("Location: login.php");
    die;
}

?>