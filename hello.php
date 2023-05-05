<html>
 <head>
  <title>PHP-Test</title>
 </head>
 <body>
  <?php 
    echo '<p>Hello World</p>';
    $servername = "localhost";
    $username = "admin"; 
    $password = "csce310";
    $dbname = "restaurant";

    $conn = mysqli_connect($servername, $username, $password, $dbname, 3307);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "<p>Connected successfully</p>";

    #Testing data insertion
    $sql = "INSERT INTO users (first_name, last_name, type, email, password) VALUES ('John', 'Doe', 'customer', 'john@example.com', 'password')";

    if (mysqli_query($conn, $sql)) {
        echo '<p>Inserted successfully</p>';
    } else {
        echo '<p>Error: ' . $sql . '<br>' . mysqli_error($conn) . '</p>';
    }

    mysqli_close($conn);
    echo '<p>Connection closed</p>';
  ?>
 </body>
</html>