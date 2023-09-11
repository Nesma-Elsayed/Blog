
<?php 
  include 'header.php';

  if (isset($_SESSION['create'])) {
    $errors = $_SESSION["create"];
    unset($_SESSION['create']); // Clear the error message after displaying it
  }
?>

  <!-- post section -->

  <section class="service_section layout_padding">
    <div class="service_container">
      <div class="container ">
        <div class="heading_container">
          <h2>
            Make <span>Post</span>
          </h2>
          <br>
          <form action = "php/register.php" method="POST">
            
            <?php 
              if(isset($errors['emp'])) {
                echo "<p class='error'> " . $errors['emp'] ."</p>";
              }
            ?>

            <div class="mb-3">
              <label for="title" class="form-label">Post Title</label>
              <input type="text" class="form-control" id="title" name="Title">
            </div>

            <?php 
              if(isset($errors['Title'])) {
                echo "<p class='error'> " . $errors['Title'] ."</p>";
              }
            ?>

            <div class="mb-3">
              <label for="body" class="form-label">Body</label>
              <textarea  class="form-control" id="body" name="Body" rows="4" ></textarea>
            </div>

            <?php 
              if(isset($errors['mybody'])) {
                echo "<p class='error'> " . $errors['mybody'] ."</p>";
              }
            ?>

            <button type="submit" class="btn btn-info" name="submit"> Make Post </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- end post section -->

  <?php include 'footer.php';?>
