<!-- Caroline Mejia, entire file -->
<!-- This is the reservations page of the website-->
<!-- In this page, you can view information regarding any existing reservations you have -->
<!-- In this page, you can also create, edit, or delete a reservation -->
<!-- By clicking on the correspnonding button, which will take you to the specified CRUD page -->


<?php
session_start();
    include("db.php");
    include("header.php");

    $user_data = check_login($conn);
?>

<!doctype html>
<html>
    <head>
        <title>Current Reservations</title>
        <style>
        </style>
    </head>
    <body>
        <div class='card mx-auto w-75'>
            <h1 class="card-header d-flex">Current Reservations   
            <a href="create_reservation.php" class="btn btn-success ms-auto">Create New Reservation</a>
            </h1>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Reservation Date & Time</th>
                        <th scope="col">Number of Guests</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            #If a reservation exists, display the reservations made by the user
                            #that is currently logged in
                            $email = $user_data['email'];
                            $query_id = "select user_id from users where email = '$email'";
                            $result_id = mysqli_query($conn, $query_id);
                            $row_id = mysqli_fetch_assoc($result_id);
                            $id = $row_id['user_id'];

                            $query = "select * from reservations inner join users on users.user_id='$id'";

                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)!=0){
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                    <td><?php echo $row['first_name'] ?></td>
                                    <td><?php echo $row['last_name'] ?></td>
                                    <td><?php echo $row['res_date'] ?></td>
                                    <td><?php echo $row['guest_num'] ?></td>

                                    <!-- Pass the reservation information to the delete/edit pages -->
                                    <td>
                                    <form method="get" action="edit_reservation.php">
                                        <input type="hidden" name="res_id" value="<?= $row['res_id'] ?>" />
                                        <input type="hidden" name="res_date" value="<?= $row['res_date'] ?>" />
                                        <input type="hidden" name="guest_num" value="<?= $row['guest_num'] ?>" />
                                        <input class = "btn btn-outline-primary" type="submit" value="Edit" />
                                    </form>                                    
                                    </td>
                                    <td>
                                    <form method="post" action="delete_reservation.php">
                                        <input type="hidden" name="res_id" value="<?= $row['res_id'] ?>" />
                                        <input class = "btn btn-outline-danger" type="submit" value="Delete" />
                                    </form>
                                    </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else{
                                ?>
                                <tr>
                                <td><?php echo "No reservations" ?></td>
                                </tr>
                                <?php
                            }
                            ?>                         
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>