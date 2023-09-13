<?php
    session_start();
    require('./connection.php');

    $sql = "SELECT posts.ID AS Post_id, post_user.Name as PostUserName , post_user.Email, posts.Body,
            posts.Title, comments.Description ,comment_user.Name as CommentUser,comments.ID as comment_id
            FROM posts
            INNER JOIN users as post_user ON post_user.ID = posts.UserId
            LEFT JOIN comments ON posts.ID = comments.PostId 
            LEFT JOIN users as comment_user  ON comment_user.ID = comments.UserId 
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
                'Name' => $row['PostUserName'],
                'comments' => array()
            );
        }

        if (!empty($row['Description'])) {
            // $posts[$post_id]['comments'][] = $row['Description'];
            $posts[$post_id]['comments'][] = array(
                'Description' => $row['Description'],
                'UserName' => $row['CommentUser'],
                'CommentId' => $row['comment_id']
            );
        }

        $_SESSION['posts'] = $posts;
    }
    
    mysqli_close($connection);

    header("Location: ../allposts.php");
?>