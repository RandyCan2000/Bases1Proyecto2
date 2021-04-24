<?php
    $servername = "localhost";
    $database = "proyecto2";
    $username = "root";
    $password = "Intercan1";
    // Create connection
    $conn = mysqli_connect("127.0.0.1", "root","Intercan1", "proyecto2");
    // Check connection
    if (!$conn) {
        die(mysqli_connect_error());
    }
?>