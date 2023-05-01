<?php
session_start();

    include('db.php');
    include('functions.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //something was posted
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(!empty($email) && !empty($password) && !is_numeric($email)) {
            //read from database
            $query = "select * from users where email = '$email' limit 1";
            $result = mysqli_query($conn, $query);
            if($result) {
                if($result && mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
                    
                    #Check if the correct password was entered
                    if($user_data['password'] === $password) {
                        $_SESSION['email'] = $user_data['email'];
                        header('Location: index.php');
                        die;
                    }
                    return $user_data;
                }
            }
            echo "Wrong email or password";
        } else {
            echo "Wrong email or password";
        }
    }
?>

<html>
    <head>
        <title>Login</title>
        <style>
        </style>
    </head>
    <body>
        <div class='card mx-auto w-75'>
            <h1 class="card-header">Login</h1>
            <form method='post' class="card-body">
                <div class='row'>
                    <div class='col'>
                        Email:
                        <input type='text' class="form-control" name='email' autofocus=true>
                    </div>
                </div>
                <div class='row'>
                    <div class='col'>
                        Password:
                        <input type='password' class="form-control" name='password'>
                    </div>
                </div>
                
                <input type='submit' value='Login' class="btn btn-dark">
                <a href='signup.php' class="btn btn-secondary">Sign Up</a>
            </form>
        </div>
    </body>
</html>