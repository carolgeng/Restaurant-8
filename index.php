<?php
session_start();
    include("header.php");

    $user_data = check_login($conn);
?>

<html>
    <head>
        <title>Landing</title>
    </head>
    <body>
        <h1>This is the landing page</h1>
        <br>
        <h4>Hello, <?php echo $user_data['first_name']; ?></h4>
    </body>
</html>