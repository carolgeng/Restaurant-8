<!-- Mengting Cao, entire file -->

<!-- Description:
        this file allows the user to update their own information
        They can change first name, last name, phone number and password
        They cannot change their email or permissions
        The php also checks that all input fields are not empty
        This page also has the button to delete the user's account-->

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
        <div class='card mx-auto w-75'>
            <h1 class="card-header">Edit Account</h1>

            <form method='post' class="card-body">
                <div class='row'>
                    <div class='col'>
                        Email:
                        <input type="text" class="form-control" value=<?php echo $row['email'] ?> disabled>
                    </div>
                </div>
                <div class='row'>
                    <div class='col'>
                        Password:
                        <input type='password' class="form-control" value=<?php echo $row['password'] ?> name='password'>
                    </div>
                    <div class='col'>
                        Confirm Password:
                        <input type='password' class="form-control" value=<?php echo $row['password'] ?> name='cpassword'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col'>
                        First Name:
                        <input type='text' class="form-control" value=<?php echo $row['first_name'] ?> name='fname'>
                    </div>
                    <div class='col'>
                        Last Name:
                        <input type='text' class="form-control" value=<?php echo $row['last_name'] ?> name='lname'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col'>
                        (Optional) Phone: 
                        <?php 
                            $phone = $row['phone'];
                            if ($phone) { ?>
                                <p><input type='text' class="form-control" value=<?php echo $phone ?> name='phone'></p>
                            <?php } else { ?>
                                <p><input type='text' class="form-control" name='phone'></p> 
                        <?php } ?>
                    </div>
                    <div class='col-4'>
                        Account Type:
                        <input type="text" class="form-control" value=<?php echo $row['type'] ?> disabled>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href='delete.php' class="btn btn-outline-danger">Delete Account</a>
                    <input type='submit' value='Update' class="btn btn-outline-dark">
                    <a href='index.php' class="btn btn-outline-secondary">Cancel</a>
                </div>
                
            </form>
        </div>
    </body>
</html>