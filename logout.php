<!-- Mengting Cao, entire file -->

<!-- Description:
        functionality to logout of user account-->

<?php

session_start();

if(isset($_SESSION['email'])) {
    unset($_SESSION['email']);
}

header("Location: login.php");

?>