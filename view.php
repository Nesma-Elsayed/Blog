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
                                            echo '<span class="comment-user">'.'@'.$comment['UserName'] . '</span>';
                                            // echo "<p class='card-subtitle mb-2 text-muted'>" . $comment['Description'] . "</p>";
                                            ?>
                                            <input type="text" class="form-control" name="comment" disabled value="<?php echo $comment['Description'];?>">
                                            <?php
                                        }
                                    } else {
                                        echo "<p>No comments Yet</p>";
                                    }
                                }
                            ?>
                            <br>
                            <a href="allposts.php" class="btn btn-primary">Back</a>
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

