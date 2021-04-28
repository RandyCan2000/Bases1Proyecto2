<?php
    $servername = "34.123.9.183";
    $database = "Proyecto2";
    $username = "root";
    $password = "Intercan1";
    // Create connection
    $conn = mysqli_connect($servername, $username,$password, $database);
    // Check connection
    if (!$conn) {
        die(mysqli_connect_error());
    }
?>