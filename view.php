<?php 
    include 'header.php';
    if(isset($_SESSION['commentError'])) {
        $error = $_SESSION['commentError'];
        unset($_SESSION['commentError']);
    }
?>

<!-- view post -->


<section class="service_section layout_padding">
    <div class="service_container">
        <div class="container">
            <div class="heading_container">
                <h2>
                    View <span>Post</span>
                </h2>
                <br>

               <div class="row justify-content-center">
                    <div class="card border-info" style="width: 50rem;">
                        <div class="card-body">

                            <h6 class="card-subtitle mb-2 text-muted">
                                @Author:
                                <?php echo $_SESSION['postUser']; ?>
                            </h6>

                            <h5 class="card-header">
                                Title:
                                <?php echo $_SESSION['viewtitle']; ?>
                            </h5>

                            <p class="card-text">
                                Body:
                                <?php echo nl2br($_SESSION['viewbody']); ?>
                            </p>

                            <hr>

                            <p> Comments:</p>

                            <?php
                                if (isset($_SESSION['mycomments'])) {
                                    if (count($_SESSION['mycomments']) > 0) {
                                        foreach ($_SESSION['mycomments'] as $comment) {
                                            echo "<p class='card-subtitle mb-2 text-muted'>" . $comment . "</p>";
                                        }
                                    } else {
                                        echo "<p>No comments Yet</p>";
                                    }
                                }
                            ?>

                        </div>
                        <div class="form_container">
                            <form action="php/register.php" method="POST">
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Add Comment</label>
                                    
                                    <?php                                      
                                        echo '<input type="hidden" name="post_id" value="' . $_SESSION['postViewId'] . '">';
                                    ?>
                                    
                                    <input type="text" class="form-control" id="comment" name="comment">
                                    <?php
                                        if(isset($error['emptyComment'])) {
                                            echo '<p class="error">' . $error['emptyComment'] . '</p>' ;
                                        }
                                    ?>
                                    <br>
                                    <button class="btn btn-primary" type="submit" name="addComment"><i class="bi bi-plus-square"></i> Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php 
    include 'footer.php';
?>

