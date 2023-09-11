<?php
    session_start();
    require('./connection.php');
    $email = $_SESSION['user'];

    $userInfo = [];
    $sql = "SELECT * FROM users WHERE Email = '$email' ";
    $results = mysqli_query($connection, $sql);
        

        if (mysqli_num_rows($results) > 0) {
            $row = mysqli_fetch_assoc($results);
            $userInfo["name"] = $row['Name'];
            $userInfo['email'] = $row['Email'];
            $_SESSION['userInfo'] = $userInfo;
            header("Location: ../userPage.php");
        }

?>