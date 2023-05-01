<?php
session_start();

    include("header.php");
    
    $row = check_login($conn);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //something was posted
        $email = $row['email'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['cpassword'];
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $phone = $_POST['phone'];
        $valid_entries = True;

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

        if($valid_entries) {
            //save to database
            if(empty($phone)) {
                $query = "update `users` set first_name='$first_name',last_name='$last_name',password='$password' WHERE email = '$email'";
            } else {
                $query = "update `users` set first_name='$first_name',last_name='$last_name',phone='$phone',password='$password' WHERE email = '$email'";
            }
            $result = mysqli_query($conn, $query);
            if ($result) {   
                echo "Updated successfully";
                #header('Location: index.php?msg=Data updated successfully');
            } else {
                echo "Failed: " .mysqli_error($conn);
            }
            die;
        }
    }
?>

<!doctype html>
<html>
    <head>
        <title>Edit Account</title>
        <style>
        </style>
    </head>
    <body>
        <div id='box'>
            <h1>Edit Account</h1>

            <form method='post'>
                Email:
                <p><?php echo $row['email'] ?></p>
                Account Type:
                <p><?php echo $row['type'] ?></p>
                Password:
                <p><input type='password' value=<?php echo $row['password'] ?> name='password'></p>
                Confirm Password:
                <p><input type='password' value=<?php echo $row['password'] ?> name='cpassword'></p>
                Name:
                <p><input type='text' value=<?php echo $row['first_name'] ?> name='fname'></p>
                <p><input type='text' value=<?php echo $row['last_name'] ?> name='lname'></p>
                (Optional) Phone: 
                <?php 
                    $phone = $row['phone'];
                    if ($phone)
                        echo "<p><input type='text' value=$phone name='phone'></p>";
                    else
                        echo "<p><input type='text' name='phone'></p>";
                ?>

                <a href='delete.php'>Delete Account</a> <br><br>

                <input type='submit' value='Update'> <br><br>
                <a href='index.php'>Cancel</a> <br><br>
            </form>
        </div>
    </body>
</html>