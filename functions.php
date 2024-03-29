<!-- Mengting Cao, check login and change type functions -->

<!-- Description:
        Check login checks that the user is logged in and returns the user information
        Change type update's type for the account that had their id passed in-->

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

function get_user($conn, $id) {
    if(isset($_SESSION['email'])) {
        $query = "select * from users where user_id = '$id' limit 1";
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

// Carol Geng, get_item function
// gets items to be loaded in and to be used if you are logged in

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

function get_review($conn, $id) {
    if(isset($_SESSION['email'])) {
        $query = "select * from reviews where review_id = '$id'";
        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0) {
            $item_data = mysqli_fetch_assoc($result);
            return $item_data;
        }
    }

    //redirect to reviews page
    header("Location: all_reviews.php");
    die;
}

?>