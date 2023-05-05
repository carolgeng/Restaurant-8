<?php
session_start();
    include("header.php");
    

    $row = check_login($conn);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //something was posted
        $email = $row['email'];
        $res_date = $_POST['res_date'];
        $guest_num = $_POST['guest_num'];
        $valid_entries = True;

        #Get the user_id necessary to create new table entry
        $query_id = "select user_id from users where email = '$email'";
        $result_id = mysqli_query($conn, $query_id);
        $row_id = mysqli_fetch_assoc($result_id);
        $id = $row_id['user_id'];

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
                        <input type="text" class="form-control" value=<?php echo $row['email'] ?> disabled>
                    </div>
                </div>
                <div class='row'>
                    <div class='col mb-3'>
                        First Name:
                        <input type='text' class="form-control" name ="fname" value=<?php echo $row['first_name'] ?> disabled>
                    </div>
                    <div class='col mb-3'>
                        Last Name:
                        <input type='text' class="form-control" value=<?php echo $row['last_name'] ?> disabled>
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