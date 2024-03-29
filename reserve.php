<!-- Caroline Mejia, entire file -->
<!-- This is the reservations page of the website-->
<!-- If you are an admin, you can view all reservations in the database and delete or edit them as needed -->
<!-- If you're a customer you can only view your own reservations, but you can edit or delete them as needed -->
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
            <?php if ($user_data['type'] != 'employee') { ?>
                    <a href="create_reservation.php" class="btn btn-success ms-auto">Create New Reservation</a>
                <?php } ?>  
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
                        if ($user_data['type'] == 'admin') { 
                            $query = "select * from reservations";  
                            
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)!=0){
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $res_user_id = $row['user_id'];
                                    $query_users = "select * from users where user_id = '$res_user_id'";
                                    $user_result = mysqli_query($conn, $query_users);
                                    $user_row = mysqli_fetch_assoc($user_result);

                                    ?>
                                    <tr>
                                    <td><?php echo $user_row['first_name'] ?></td>
                                    <td><?php echo $user_row['last_name'] ?></td>
                                    <td><?php echo $row['res_date'] ?></td>
                                    <td><?php echo $row['guest_num'] ?></td>

                                    <!-- Pass the reservation information to the delete/edit pages -->
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
                        }
                        elseif ($user_data['type'] == 'customer') {
                            $email = $user_data['email'];
                            $query_id = "select user_id from users where email = '$email'";
                            $result_id = mysqli_query($conn, $query_id);
                            $row_id = mysqli_fetch_assoc($result_id);
                            $id = $row_id['user_id'];
                           
                            $query = "select * from reservations where reservations.user_id='$id'";
                            
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)!=0){
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $res_user_id = $row['user_id'];
                                    $query_users = "select * from users where user_id = '$res_user_id'";
                                    $user_result = mysqli_query($conn, $query_users);
                                    $user_row = mysqli_fetch_assoc($user_result);
                                    

                                    ?>
                                    <tr>
                                    <td><?php echo $user_row['first_name'] ?></td>
                                    <td><?php echo $user_row['last_name'] ?></td>
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
                        } 
                        ?>
                        <?php
                            
                            ?>                         
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>