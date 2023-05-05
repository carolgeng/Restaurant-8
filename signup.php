<!-- Mengting Cao, entire file -->

<!-- Description:
        Form a new user can use to register an account on our website
        All fields are required except phone and code
        code is a secret code the user can input to get specific permissions-->

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
        $type = "customer";
        $code = $_POST['code'];

        #check if any required fields are missing
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

        #check if password matches with confirmation password
        if($password != $password_confirmation) {
            echo "Passwords do not match";
            $valid_entries = False;
        }

        #check if email already exists in db
        $query = "select * from users where email = '$email' limit 1";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) != 0) {
            echo "Email already in use";
            $valid_entries = False;
        }

        if($code == "admin") {
            $type = "admin";
        } else if ($code == "employee") {
            $type = "employee";
        }

        if($valid_entries) {
            //save to database
            if(empty($phone)) {
                $query = "insert into users (first_name, last_name, email, password, type) values ('$first_name', '$last_name', '$email', '$password', '$type')";
            } else {
                $query = "insert into users (first_name, last_name, phone, email, password, type) values ('$first_name', '$last_name', '$phone', '$email', '$password', '$type')";
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
        <div class="h-100 d-flex align-items-center justify-content-center min-vh-100">
            <div class='card mx-auto w-75'>
                <h1 class="card-header">Signup</h1>
                <form method='post' class="card-body">
                    <div class='row'>
                        <div class='col'>
                            Email:
                            <input type="text" class="form-control" name='email' autofocus=true>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col'>
                            Password:
                            <input type='password' class="form-control" name='password'>
                        </div>
                        <div class='col'>
                            Confirm Password:
                            <input type='password' class="form-control" name='cpassword'>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col'>
                            First Name:
                            <input type='text' class="form-control" placeholder="First" name='fname'>
                        </div>
                        <div class='col'>
                            Last Name:
                            <input type='text' class="form-control" placeholder="Last" name='lname'>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col'>
                            (Optional) Phone: 
                            <input type='text' class="form-control" placeholder="111-111-1111" name='phone'>
                        </div>
                        <div class='col-4'>
                            Permission Code:
                            <input type='password' class="form-control" name='code'>
                        </div>
                    </div>
                    <br>
                    <div class="d-grid gap-2">
                        <input type='submit' value='Signup' class="btn btn-outline-dark">
                        <a href='login.php' class="btn btn-outline-primary">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>