<?php
    session_start();
    require('./connection.php');
    
    function checkPasswordStrength($password) {
        // Define password strength requirements using regular expressions
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChar = preg_match('@[^\w]@', $password);
        
        // Define minimum length for the password
        $minLength = 8;
        
        // Check if the password meets all the requirements
        if ($uppercase && $lowercase && $number && $specialChar && strlen($password) >= $minLength) {
            return true;
        } else {
            return false;
        }
    }
    //////// register code 
    if(isset($_POST['register'])) {
        $_SESSION['myName'] = strip_tags($_POST['name']);
        $_SESSION['myEmail'] = strip_tags($_POST['email']);
        $_SESSION['myPassword'] = strip_tags($_POST['password']);
        $message = [];
        // Get form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['confirmPassword'];
      
        // Validate form data
        if(empty($name) &&  empty($email) &&  empty($password) && empty($confirm)) {
            $message["empty"] = "please fill in all fields";
        }
        else if(empty($name)) {
            $message["name"] = "Name is required";
        }
        else if(strlen($name) < 4) {
            $message["name"] = "Username must be at least 4 characters";
        }
          
        else if(strlen($name) > 16) {
            $message["name"] = "Username cannot exceed 16 characters"; 
        }
          
          // Validate characters
        else if(!preg_match('/^[a-zA-Z0-9_]*$/', $name)) {
            $message["name"] = "Username can only contain letters, numbers and underscores"; 
        }
        else if(empty($email)) {
            $message["email"] = "Email is required";
        }
        else if(empty($password)) {
            $message["password"] = "Password is required";
        }
        else if(!checkPasswordStrength($password)) {
            $message["password"] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
        }
        else if(empty($confirm)) {
            $message["confirm"] = "Confirm Password is required";
        }
        else if($password !== $confirm) { 
            $message['confirm'] = "Not match password";
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $message['email'] = "Not a valid Email";
        }   
        else {
            $checkEmail = "SELECT * FROM users WHERE Email = '$email'";
            $result = mysqli_query($connection, $checkEmail);
            if (mysqli_num_rows($result) > 0) {
                $message['email'] = "Email already exists";
            }
            else {
                $sql =  "INSERT INTO users (Name, Email, Password)
                         VALUES ('$name', '$email', '$password')";
                mysqli_query($connection, $sql);

                unset($_SESSION['myName']);
                unset($_SESSION['myEmail']);
                echo '<script>';
                echo 'alert("You registered is done, please Sign in.");';
                echo 'window.location.href = "../login.php";';
                echo '</script>';
                exit();

            }            
        }
        $_SESSION['message'] = $message;
        echo '<script> window.location.href = "../registerPage.php";</script>';
    }

    /////// login code 

    if (isset($_POST['login'])) {
        $password = strip_tags($_POST['password']);
        $email = strip_tags($_POST['email']);
        $sql = "SELECT * FROM users WHERE Email = '$email'";
        $results = mysqli_query($connection, $sql);
        

        if (mysqli_num_rows($results) > 0) {
            
            $row = mysqli_fetch_assoc($results);
            if ($row['Password'] === $password) {
              // Successful login
              session_start();
              $_SESSION['user'] = $email;
              $_SESSION['Id'] = $row['ID'];
              $_SESSION['UserName'] = $row['Name'];
              header("Location: indexphp.php");
            //   header("Location: ../service.php");
              exit();

            } else {
              echo '<script>alert("Invalid password. Please try again.");</script>';
              echo '<script> window.location.href = "../login.php";</script>';
            }
          } else {
            // Email doesn't exist
            echo '<script>alert("Invalid Email. please try again or sign up.");</script>';
            echo '<script> window.location.href = "../login.php";</script>';
            exit();
          }
    }

    ///////// create post code 

    if(isset($_POST['submit'])) {
        $Title = strip_tags(addslashes($_POST['Title']));
        $Body = strip_tags(addslashes($_POST['Body']));
        $UserId = $_SESSION['Id'];
        $_SESSION['myTitle'] = $Title;
        $_SESSION['myBody'] = $Body;
        $create = [];

        if( empty($Title) && empty($Body)) {
            $create["emp"] = "please fill in all fields";
        }
        else if(empty($Title)) {
            $create["Title"] = "Title is required";
        }
        else if(empty($Body)) {
            $create["mybody"] = "Body is required";
        }
        else {   

            $sql = " INSERT INTO posts (Title, Body, UserId) VALUES 
                ( '$Title', '$Body', '$UserId')";

             if (mysqli_query($connection, $sql)) {
                echo '<script>';
                unset($_SESSION['myTitle']);
                unset($_SESSION['myBody']);
                echo 'alert("successful madepost.");';
                echo 'window.location.href = "indexphp.php";';
                echo '</script>';
                } else {
                    header("Location: ../index.php");
                exit();
             }

        }

        $_SESSION['create'] = $create;

        echo '<script> window.location.href = "../post.php";</script>';
        

        
    }

    //// delete post

    if (isset($_POST['delete'])) {

        $post_id = $_POST['post_id'];
    
        // Delete the associated comments
        $deleteCommentsQuery = "DELETE FROM comments WHERE PostId = '$post_id'";
        mysqli_query($connection, $deleteCommentsQuery);

        // Delete the post
        $deletePostQuery = "DELETE FROM posts WHERE ID = '$post_id'";
        mysqli_query($connection, $deletePostQuery);
    
        header("Location: indexphp.php");
        exit();
    }
     ///////edit post

    if (isset($_GET['edit'])) {
        $post_id = $_GET['post_id'];
        $sql = "SELECT * FROM posts , users WHERE posts.ID = '$post_id'";
        $result = mysqli_query($connection, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $title = $row['Title'];
            $body = $row['Body'];
            $_SESSION['Mytitle'] =  $title;
            $_SESSION['Mybody'] =  $body;
            $_SESSION['PostId'] = $post_id;
            header("Location: ../edit.php");
        }

    }

    if (isset($_POST['finaledit'])) {
        $post_id = $_POST['post_id'];
        $title = strip_tags(addslashes($_POST['Title']));
        $body = strip_tags(addslashes($_POST['Body']));
        $edit = [];
        if(empty($title) &&  empty($body) ) {
            $edit["empty"] = "please fill in all fields";
        }
        else if(empty($title)) {
            $edit["title"] = "Title is required";
        }
        else if(empty($body)) {
            $edit["body"] = "Body is required";
        }
        else {   
            $sql = "UPDATE posts SET Title = '$title', Body = '$body' WHERE ID = '$post_id'";
            if (mysqli_query($connection, $sql)) {
                header("Location: indexphp.php");
            } else {
                header("Location: ../index.php");
            }
        }
        $_SESSION['edit'] = $edit;

        echo '<script> window.location.href = "../edit.php";</script>';

    }

    /// view post
    if (isset($_GET['view'])) {
        $post_id = $_GET['post_id'];
        $sql = "SELECT posts.Title, posts.Body, post_user.Name AS PostUserName, comments.Description, comment_user.Name AS CommentUserName
                FROM posts
                INNER JOIN users AS post_user ON posts.UserId = post_user.ID
                LEFT JOIN comments ON posts.ID = comments.PostId
                LEFT JOIN users AS comment_user ON comments.UserId = comment_user.ID
                WHERE posts.ID = '$post_id'";
        $view = [];
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['viewtitle'] = $row['Title'];
        $_SESSION['viewbody'] = $row['Body'];
        $_SESSION['postUser'] = $row['PostUserName'];
        $_SESSION['postViewId'] = $post_id;
    
        $comments = array();
        do {
            if (!empty($row['Description'])) {
                $comments[] = array(
                    'Description' => $row['Description'],
                    'UserName' => $row['CommentUserName']
                );
            }
        } while ($row = mysqli_fetch_assoc($result));
    
        $_SESSION['mycomments'] = $comments;
    
        header("Location: ../view.php");
    }

    if (isset($_POST['editUserInfo'])) {
        $userId = $_SESSION['Id'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $editUser = [];
        $allEmails = "SELECT Email FROM users";
        @
        $result = mysqli_query($connection, $allEmails);

        if(empty($email) &&  empty($name) ) {
            $editUser["empty"] = "Please fill in all fields";
        }
        else if(empty($email)) {
            $editUser["email"] = "Email is required";
        }
        // else if(mysqli_num_rows($result) > 0) {
        //     $editUser["email"] = "Email already exists";
        // }
        else if(empty($name)) {
            $editUser["name"] = "Name is required";
        }
        else {   
            $sql = "UPDATE users SET Email = '$email', Name = '$name' WHERE ID = '$userId'";
            if (mysqli_query($connection, $sql)) {
              $_SESSION['user'] = $email;
              $_SESSION['UserName'] = $name;
                header("Location: user.php");
            } else {
                header("Location: ../index.php");
            }
        }
        $_SESSION['editUser'] = $editUser;

        echo '<script> window.location.href = "../editUserInfo.php";</script>';
    }

    ///add comment
    if(isset($_POST['addComment'])) {
        $post_id = $_POST['post_id'] ;
        $comment = strip_tags(addslashes($_POST['comment'.$post_id]));
        $UserId = $_SESSION['Id'];
        $commentError = [];
        if(!empty($comment)) {
            $sql = " INSERT INTO comments (Description, UserId, PostId) VALUES 
            ('$comment', '$UserId', '$post_id') ";

            if(mysqli_query($connection, $sql)) {
               header("Location: indexphp.php");
            } 
        } else {
            $commentError['emptyComment' . $post_id] = "Comment Can't be Empty";   
            $_SESSION['commentError'] = $commentError;
            header("Location: ../allposts.php");
        }
       
    }
    
    /// delete comment

    if(isset($_POST['deleteComment'])) {
        $comment_id = $_POST['comment_id'];
        $sql = "DELETE FROM comments WHERE ID = $comment_id";
       if(mysqli_query($connection, $sql)) {
        // echo '<script>alert("Invalid password. Please try again.");</script>';
        echo '<script>alert("Comment Deleted sucessfully.");</script>';
        echo '<script> window.location.href = "indexphp.php";</script>';
       }

    }
    mysqli_close($connection);
?>