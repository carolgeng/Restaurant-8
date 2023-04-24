<?php
session_start();

    include('db.php');
    include('functions.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //something was posted
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['cpassword'];
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $phone = $_POST['phone'];
        $valid_entries = True;
        if(empty($email)) {
            echo "Email is empty";
            $valid_entries = False;
        }
        if(empty($password)) {
            echo "Password is empty";
            $valid_entries = False;
        }
        if(empty($password_confirmation)) {
            echo "Password confirmation is empty";
            $valid_entries = False;
        }
        if(empty($first_name)) {
            echo "First name is empty";
            $valid_entries = False;
        }
        if(empty($last_name)) {
            echo "Last name is empty";
            $valid_entries = False;
        }
        if($password != $password_confirmation) {
            echo "Passwords do not match";
            $valid_entries = False;
        }
        if($valid_entries) {
            if(empty($phone)) {
                //save to database
                $query = "insert into users (first_name, last_name, email, password) values ('$first_name', '$last_name', '$email', '$password')";
            } else {
                $query = "insert into users (first_name, last_name, phone, email, password) values ('$first_name', '$last_name', '$phone', '$email', '$password')";
            }
            mysqli_query($conn, $query);
            header('Location: login.php');
            die;
        }
    }
?>

<!doctype html>
<html>
    <head>
        <title>Signup</title>
        <style>
        </style>
    </head>
    <body>
        <div id='box'>
            <h1>Signup</h1>
            <form method='post'>
                Email:
                <p><input type='text' name='email'></p>
                Password:
                <p><input type='password' name='password'></p>
                Confirm Password:
                <p><input type='password' name='cpassword'></p>
                Name:
                <p><input type='text' placeholder="John" name='fname'></p>
                <p><input type='text' placeholder="Doe" name='lname'></p>
                Phone: 
                <p><input type='text' placeholder="111-111-1111" name='phone'></p>
                <input type='submit' value='Signup'> <br><br>
                <a href='login.php'>Login</a> <br><br>
            </form>
        </div>
    </body>
</html>