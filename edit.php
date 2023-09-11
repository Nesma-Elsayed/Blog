<?php
  include 'header.php';
  if (isset($_SESSION['edit'])) {
    $error = $_SESSION["edit"];
    unset($_SESSION['edit']); // Clear the error message after displaying it
  }
?>


  <!-- edit section -->

  <section class="service_section layout_padding">
    <div class="service_container">
      <div class="container ">
        <div class="heading_container">
          <h2>
            Edit <span>Post</span>
          </h2>

           
            <form action = "php/register.php" method="POST">
            
                <?php 
                  if(isset($error['empty'])) {
                    echo "<p class='error'> " . $error['empty'] ."</p>";
                  }
                ?>

                <div class="mb-3">
                    <input type="hidden" name="post_id" value="<?php echo $_SESSION['PostId']; ?>">
                        <label for="title" class="form-label">Post Title</label>
                        <?php
                          echo '<textarea  class="form-control" id="title" name="Title" >' . $_SESSION['Mytitle'].'</textarea>'
                        ?>
                </div>

                <?php 
                  if(isset($error['title'])) {
                    echo "<p class='error'> " . $error['title'] ."</p>";
                  }
                ?>

                <div class="mb-3">
                    <label for="body" class="form-label">Body</label>
                    <?php
                      echo '<textarea class="form-control" id="body" name="Body" rows="4" >' . $_SESSION['Mybody']. '</textarea>';
                    ?>
                </div>

                <?php 
                  if(isset($error['body'])) {
                    echo "<p class='error'> " . $error['body'] ."</p>";
                  }
                ?>

                <button type="submit" class="btn btn-info" name="finaledit">Edit</button>
            </form>
          <br>
        </div>
      </div>
    </div>
  </section>

  <!-- end service section -->

  <?php include 'footer.php';?>
