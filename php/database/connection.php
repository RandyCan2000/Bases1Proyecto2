<?php
    $servername = "34.68.27.29";
    $database = "Proyecto2";
    $username = "root";
    $password = "Intercan3";
    // Create connection
    $conn = mysqli_connect($servername, $username,$password, $database);
    // Check connection
    if (!$conn) {
        die(mysqli_connect_error());
    }
?>