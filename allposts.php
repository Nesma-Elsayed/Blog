
<?php 

  include 'header.php';

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
                echo '<div class="row justify-content-center ">';
                foreach ($posts as $post) {
                    echo '<div class="card border-primary" style="width: 50rem; margin-right: 10px; margin-bottom: 10px;">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-header text-center">' . $post['Title'] . '</h5>';
                    echo '<p class="card-text">' . nl2br($post['Body']) . '</p>' . '<br>';
                    echo '<hr>';
                    
                    if (!empty($post['comments'])) {
                        echo '<div class="comments">';
                        echo '<h5>Comments:</h5>';
                        foreach ($post['comments'] as $comment) {
                            echo '<p class="card-subtitle mb-2 text-muted">' . '-'.$comment . '</p>';
                        }
                        echo '</div>' .'<br>'; // Close the comments <div>
                    } else {
                      echo '<p>' . '--'. 'NO comments yet' . '</p>';
                    }

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
  