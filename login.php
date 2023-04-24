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

<!doctype html>
<html>
    <head>
        <title>Login</title>
        <style>
            
        </style>
    </head>
    <body>
        <div id='box'>
            <h1>Login</h1>
            <form method='post'>
                <input type='text' name='email'> <br><br>
                <input type='password' name='password'> <br><br>
                <input type='submit' value='Login'> <br><br>
                <a href='signup.php'>Sign Up</a> <br><br>
            </form>
        </div>
    </body>
</html>