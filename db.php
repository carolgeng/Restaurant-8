<?php 
    $servername = "localhost";
    $username = "admin"; 
    $password = "csce310";
    $dbname = "restaurant";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "<p>Connected successfully</p>";
?>