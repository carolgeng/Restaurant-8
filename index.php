<!-- Carol Geng -->
<!-- Description:
        This file is the landing page when you first enter. -->
<?php
session_start();
    include("header.php");

    $user_data = check_login($conn);
?>

<html>

<head>
    <title>Landing</title>
</head>
<!-- styling for the the page -->

<body style="text-align: center; background: url(restaurant.jpeg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
    <div style="background-color: rgba(0, 0, 0, 0.5); padding: 20px;">
        <h1 style="color: white;">Welcome to Restaurant 8!</h1>
        <br>
        <!-- get first name -->
        <h4 style="color: white;">Hello, <?php echo $user_data['first_name']; ?>, we're excited to see you here!</h4>
    </div>
</body>

</html>