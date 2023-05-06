<!-- Mengting Cao, entire file -->

<!-- Description:
        shows table of all users
        only the admin can access this page
        Admins can change every user's permissions-->

<?php
session_start();
    include("db.php");
    include("header.php");

    $user_data = check_login($conn);
    if (!empty($_GET['type']) && !empty($_GET['id'])) {
        change_type($conn, $_GET['id'], $_GET['type']);
    }
?>

<!DOCTYPE html>
<html>
        <title>Accounts</title>
        
    </head>
    <body>
        <div class="container">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Type</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "select * from users";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                            <th scope="row"><?php echo $row['user_id'] ?></th>
                            <td><?php echo $row['first_name'] ?></td>
                            <td><?php echo $row['last_name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['phone'] ?></td>
                            <td>
                                <div class="btn-group dropend">
                                    <button type="button" class="btn btn-secondary">
                                        <?php echo $row['type'] ?>
                                    </button>
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php if ($row['type'] != 'admin') { ?>
                                            <li><a class="dropdown-item" href="accounts.php?id=<?php echo $row['user_id']?>&type=admin">admin</a></li>
                                        <?php } ?>
                                        <?php if ($row['type'] != 'employee') { ?>
                                        <li><a class="dropdown-item" href="accounts.php?id=<?php echo $row['user_id']?>&type=employee">employee</a></li>
                                        <?php } ?>
                                        <?php if ($row['type'] != 'customer') { ?>
                                        <li><a class="dropdown-item" href="accounts.php?id=<?php echo $row['user_id']?>&type=customer">customer</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <a href='delete.php?id=<?php echo $row['user_id']?>' class="btn btn-outline-danger">Delete Account</a>
                            </td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
                </table>
        </div>
    </body>
</html>