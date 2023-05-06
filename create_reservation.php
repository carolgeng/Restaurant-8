<!-- Caroline Mejia, entire file -->
<!-- This is the create page for the reservations-->
<!-- In this page, you can view the email, first name, and last name you reservtion will be created under -->
<!-- (Info depends on the account info, only viewable) -->
<!-- In this page, you can also set the datetime and number of guests for your reservation -->
<?php
session_start();
    include("header.php");
    

    $row = check_login($conn);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //something was posted
        if ($row['type'] == 'admin') {
            $email_user = $_POST['email_user'];
            $first_name = $_POST['fname'];
            $last_name = $_POST['lname'];
            if(empty($email_user)) {
                echo "Email is empty ";
                $valid_entries = False;
            }
            if(empty($first_name)) {
                echo "Fist name is empty ";
                $valid_entries = False;
            }
            if(empty($last_name)) {
                echo "Last name is empty ";
                $valid_entries = False;
            }
        }
        $email = $row['email'];
        $res_date = $_POST['res_date'];
        $guest_num = $_POST['guest_num'];
        $valid_entries = True;

        #check if any required fields are missing
        
        if(empty($res_date)) {
            echo "Reservation date & time is empty ";
            $valid_entries = False;
        }
        if(empty($guest_num)) {
            echo "Guest number is empty ";
            $valid_entries = False;
        }    

        if($valid_entries) {
            //save to database
            if ($row['type'] == 'admin') {
                $user_query = "insert into users (first_name, last_name, email, password, type) values ('$first_name', '$last_name', '$email_user', 'password', 'customer')";
                mysqli_query($conn, $user_query);

                #Get the user_id necessary to create new table entry
                $query_id = "select user_id from users where email = '$email_user'";
                $result_id = mysqli_query($conn, $query_id);
                $row_id = mysqli_fetch_assoc($result_id);
                $id = $row_id['user_id'];

            }
            elseif ($row['type'] == 'customer') {
                $query_id = "select user_id from users where email = '$email'";
                $result_id = mysqli_query($conn, $query_id);
                $row_id = mysqli_fetch_assoc($result_id);
                $id = $row_id['user_id'];
            }

            $query = "insert into reservations (user_id, res_date, guest_num) values ('$id', '$res_date', '$guest_num')";

            $result = mysqli_query($conn, $query);
            if ($result) {   
                header('Location: reserve.php');
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
        <title>Create Reservation</title>
        <style>
        </style>
    </head>
    <body>
        <div class='card mx-auto w-75'>
            <h1 class="card-header">Create Reservation</h1>
            <form method='post' class="card-body">
                <div class='row'>
                    <div class='col mb-3'>
                        Email:
                        <?php if ($user_data['type'] == 'customer') { ?>
                        <input type="text" class="form-control" value=<?php echo $row['email'] ?> disabled>
                        <?php } ?>  
                        <?php if ($user_data['type'] == 'admin') { ?>
                        <input type="text" class="form-control" name = "email_user">
                        <?php } ?> 

                    </div>
                </div>
                <div class='row'>
                    <div class='col mb-3'>
                        First Name:
                        <?php if ($user_data['type'] == 'customer') { ?>
                        <input type="text" class="form-control" value=<?php echo $row['first_name'] ?> disabled>
                        <?php } ?>  
                        <?php if ($user_data['type'] == 'admin') { ?>
                        <input type="text" class="form-control" name = "fname">
                        <?php } ?> 
                    </div>
                    <div class='col mb-3'>
                        Last Name:
                        <?php if ($user_data['type'] == 'customer') { ?>
                        <input type="text" class="form-control" value=<?php echo $row['first_name'] ?> disabled>
                        <?php } ?>  
                        <?php if ($user_data['type'] == 'admin') { ?>
                        <input type="text" class="form-control" name = "lname">
                        <?php } ?> 
                    </div>
                </div>
                <div class='row'>
                    <div class='col mb-3'>
                        Date & Time:
                        <input type="datetime-local" class="form-control" name='res_date'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col mb-3'>
                        Number of Guests
                        <input type="number" class="form-control" min="1" name='guest_num'>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href='reserve.php' class="btn btn-outline-danger">Cancel</a>
                    <input type='submit' name="submit" value='Submit' class="btn btn-outline-dark">
                </div>
                
            </form>
        </div>
    </body>
</html>