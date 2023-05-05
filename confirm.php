<?php
session_start();
    include("db.php");
    include("header.php");

    $user_data = check_login($conn);
    if (!empty($_GET['type']) && !empty($_GET['id'])) {
        change_type($conn, $_GET['id'], $_GET['type']);
    }
?>

<html>
    <head style= "center">
        <title>Order confirmed</title>
    </head>
    <body style="margin: 0 auto; text-align: center;">
    
        <h1>Your order has been submitted! Thank you for ordering with Restaurant 8!</h1>
        <h2> Please pay at our restaurant when you come in to get your order!</h2>
        
    </body>
</html>