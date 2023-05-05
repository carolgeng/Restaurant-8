 <!-- Carol Geng, styling for landing page -->

 <!-- check if logged in -->
 <?php
session_start();
    include("header.php");
    $user_data = check_login($conn);
?>

<html>
    <head>
        <!--styling for landing page -->
        <title>Restaurant 8</title>
    </head>

    <body style="text-align: center; background: url(restaurant.jpeg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
    <div style="background-color: rgba(0, 0, 0, 0.5); padding: 20px;">
        <h1 style="color: white;">Welcome to Restaurant 8!</h1>
        <br>
        <h4 style="color: white;">Hello, <?php echo $user_data['first_name']; ?>, we're excited to see you here!</h4>
    </div>
    </body>
</html>