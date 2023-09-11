<?php 
include 'header.php';

if (isset($_SESSION['editUser'])) {
  $erroruser = $_SESSION["editUser"];
  unset($_SESSION['editUser']); // Clear the error message after displaying it
}
?>

<section class="contact_section layout_padding-top">

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-5 offset-md-1">
          <div class="heading_container">
            <h2>
              Edit User Info
            </h2>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-5 offset-md-1">
          <div class="form_container">
            <form action="php/register.php" method="POST">
              
                <?php 
                  if(isset($erroruser['emp'])) {
                    echo "<p class='error'> " . $erroruser['emp'] ."</p>";
                  }
                ?>

                <div class="mb-3">
                  <label class="form-label" for="email">Your Email</label>
                  <input type="email" id="email" placeholder="Email" name="email" value= "
                  <?php
                    echo  $_SESSION['userInfo']['email'];
                  ?>" />
                </div>

                <?php
                  if(isset($erroruser['email'])) {
                    echo "<p class='error'>" . $erroruser['email'] ."</p>";
                  }
                ?>

                <div class="mb-3">
                  <label for="name" class="form-label">Your Name</label>
                  <?php
                    echo '<input type="text" class="form-control" id="name" name="name"  value="' . $_SESSION['userInfo']['name'].'">'
                  ?>  
                </div>
                 
                <?php
                  if(isset($erroruser['name'])) {
                    echo "<p class='error'>" . $erroruser['name'] . "</p>";
                  }
                ?>
                <div class="btn_box">
                  <button type="submit" name="editUserInfo">
                    Edit
                  </button> 

                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>

<?php include 'footer.php';?>
