<?php
  include 'header.php';

  if (isset($_SESSION['user'])) {
    echo '<script>';
    echo 'alert("You are already logged in.");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
    exit();
  }
?>

  </div>
  <!-- login section -->
  <section class="contact_section layout_padding-top">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-5 offset-md-1">
          <div class="heading_container">
            <h2>
              Login 
            </h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-5 offset-md-1">
          <div class="form_container">
            <form action="php/register.php" method="POST">
              
              <div>
                <input type="email" placeholder="Email" name="email" />
              </div>

              <div>
                <input type="password" placeholder="Your Password" name="password" />
              </div>

              <div class="btn_box">
                <button type="submit" name="login">
                  LOGIN
                </button> 
                <a href="registerPage.php">sign up</a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end login section -->


  <?php include 'footer.php';?>
 