<!-- Mengting Cao, entire file -->

<!-- Description:
        this file deletes the user account when called-->

<?php
session_start();
    include('db.php');
    echo "before";
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $query = "delete from users where user_id = '$id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header('Location: accounts.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    else{
        if(isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $query = "delete from users where email = '$email'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                header('Location: login.php');
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }

?>