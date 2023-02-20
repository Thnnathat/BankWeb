<?php
    $servername = "localhost";
    $username = "root";
    $password = "thnnathat";
    $dbname = "bank";

    global $conn; 
    $conn = new mysqli($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>