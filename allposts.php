
<?php 

  include 'header.php';
  if(isset($_SESSION['commentError'])) {
    $error = $_SESSION['commentError'];
    unset($_SESSION['commentError']);
}

?>

  <!-- allposts section -->

  <section class="service_section layout_padding">
    <div class="service_container">
      <div class="container ">
        <div class="heading_container">
            <h2 >
              All <span>Posts</span>
            </h2>
          <br>
          <div>
            <a class="btn btn-primary" href="post.php"> <i class="bi bi-folder-plus"></i> Make Post </a>
          </div>
          
          <?php
            if (isset($_SESSION['posts'])) {
              $posts = $_SESSION['posts'];
                
                // Iterate over the posts and display the data in one line
                echo '<div class="row justify-content-center">';
                foreach ($posts as $post) {
                  echo '<div class="card border-primary" style="width: 50rem; margin-right: 10px; margin-bottom: 10px;">';
                  echo '<p>'.'<span class="comment-user">'.'Author: '.'</span>'.$post['Name'].'</p>';
                  echo '<div class="card-body">';
                  echo '<h5 class="card-header text-center">' . $post['Title'] . '</h5>';
                  echo '<p class="card-text">' . nl2br($post['Body']) . '</p>' . '<br>';
                  echo '<hr>';
                    
                  echo '<div id="comments-' . $post['Post_id'] . '" class="collapse">';
                  if (!empty($post['comments'])) {
                    echo '<h5>Comments:</h5>';
                    foreach ($post['comments'] as $comment) {
                      echo '<span class="comment-user">'.'@'.$comment['UserName'] . '</span>';
          ?>
                      <form action="php/register.php" method="POST">
                        <input type="text" name="comment_id" hidden value="<?php echo $comment['CommentId']?>">
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="comment" disabled value="<?php echo '-'.$comment['Description'];?>">
                          <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="submit" name="deleteComment">Delete</button>
                          </div>
                        </div>
                      </form>   

              <?php
                  }
                    
                  } else {
                      echo '<p>' . '--'. 'NO comments yet' . '</p>';
                  }
                echo '</div>'; // Close the comments collapsible div
              ?>

                <form action="php/register.php" method="POST">
                    <label for="comment<?php echo $post['Post_id']?>" class="form-label">Add Comment</label>
                    <div class="input-group mb-3">
                      <?php                                      
                          echo '<input type="hidden" name="post_id" value="' . $post['Post_id'] . '">';
                      ?>
                      <input type="text" class="form-control" placeholder="Comment" id="comment<?php echo $post['Post_id']?>" name="comment<?php echo $post['Post_id']?>">
                      
                      <div class="input-group-append">
                        <button class="btn  btn-outline-primary" type="submit" name="addComment">Add</button>
                      </div>
                    </div>
                    <?php
                      if(isset($error['emptyComment'. $post['Post_id']])) {
                        echo '<p class="error">' . $error['emptyComment'. $post['Post_id']] . '</p>' ;
                      }
                    ?>
                  <br>
                </form>  
          <?php
                    echo '<div class="button-group ">';

                    echo '<form method="GET" action="php/register.php" class="inline-form">';
                    echo '<input type="hidden" name="post_id" value="' . $post['Post_id'] . '">';
                    echo '<button class="btn btn-primary" type="submit" name="view"><i class="bi bi-eye-fill"></i> View</button>';
                    echo '</form>';

                    echo '<form class="inline-form" action="php/register.php" method="GET">';
                    echo '<input type="hidden" name="post_id" value="' . $post['Post_id'] . '">';
                    echo '<button class="btn btn-info" type="submit" name="edit"><i class="bi bi-pen"></i> Edit</button>';
                    echo '</form>';

                    echo '<form method="POST" action="php/register.php" class="inline-form">';
                    echo '<input type="hidden" name="post_id" value="' . $post['Post_id'] . '">';
                    echo '<button class="btn btn-danger" type="submit" name="delete"><i class="bi bi-archive-fill">Delete</i></button>';
                    echo '</form>';
                    echo '<button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#comments-' . $post['Post_id'] . '">Comments</button>';
                    echo '</div>'; // Close the button-group <div>
                    echo '</div>'; // Close the card-body <div>
                    echo '</div>'; // Close the card <div>
                  }
                  
                echo '</div>'; // Close the flex-row <div>
            } else {
                // Handle the case when no posts are available
              echo 'No posts available.';
            }
          ?>         
        </div>
      </div>
    </div>
  </section>

  <!-- end all section -->

  <?php include 'footer.php';?>
  