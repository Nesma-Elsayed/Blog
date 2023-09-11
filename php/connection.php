<?php
    require('env.php');
    $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if(!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo("Connected Successfully" . "<br>");
    }
?>