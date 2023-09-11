<?php
    session_start();
    require('./connection.php');

    $sql = "SELECT posts.ID AS Post_id, users.Name, users.Email, posts.Body,
            posts.Title, comments.Description
            FROM posts
            INNER JOIN users ON users.ID = posts.UserId
            LEFT JOIN comments ON posts.ID = comments.PostId 
            ORDER BY posts.ID";
    $results = mysqli_query($connection, $sql);
    
    $posts = array();

    while($row = mysqli_fetch_assoc($results)) {
        $post_id = $row['Post_id'];

        if (!isset($posts[$post_id])) {
            $posts[$post_id] = array(
                'Post_id' => $row['Post_id'],
                'Title' => $row['Title'],
                'Body' => $row['Body'],
                'Name' => $row['Name'],
                'comments' => array()
            );
        }

        if (!empty($row['Description'])) {
            $posts[$post_id]['comments'][] = $row['Description'];
        }

        $_SESSION['posts'] = $posts;
    }
    
    mysqli_close($connection);

    header("Location: ../allposts.php");
?>