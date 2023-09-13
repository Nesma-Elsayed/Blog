
<?php
  include 'header.php';
  if (isset($_SESSION['message'])) {
    $error = $_SESSION["message"];
    unset($_SESSION['message']); // Clear the error message after displaying it
  }

  if (isset($_SESSION['user'])) {
    echo '<script>';
    echo 'alert("You are already logged in.");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
    exit();
  }
?>



  <!-- register section -->
  <section class="contact_section layout_padding-top">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black " style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
  
                  <form class="mx-1 mx-md-4" action = "php/register.php" method="POST">
                     <?php 
                      if(isset($error['empty'])) {
                        echo "<p class='alert alert-danger' role='alert' > ". $error['empty'] ."</p>";
                      }
                    ?>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" id="form3Example1c" class="form-control" name="name" placeholder="Name"
                        value="<?php echo isset($_SESSION['myName']) ? $_SESSION['myName'] : ''; ?>"
                        />
                        <label class="form-label" for="form3Example1c">Your Name</label>
                      </div>
                    </div>
                      
                    <?php
                      if(isset($error['name'])){
                        echo "<p class='alert alert-danger' role='alert'> ". $error['name'] . "</p>";
                      }
                    ?>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <div class="form-outline flex-fill mb-0">
                        <input type="email" id="form3Example3c" class="form-control" name="email" placeholder="Email"
                        value="<?php echo isset($_SESSION['myEmail']) ? $_SESSION['myEmail'] : ''; ?>"
                        />
                        <label class="form-label" for="form3Example3c">Your Email</label>
                      </div>
                    </div>

                    <?php
                      if(isset($error['email'])) {
                        echo "<p class='alert alert-danger' role='alert'> ". $error['email'] . "</p>";
                      }
                    ?>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="form3Example4c" class="form-control" name="password" placeholder="Password" />
                        <label class="form-label" for="form3Example4c">Password</label>
                      </div>
                    </div>

                    <?php
                      if(isset($error['password'])) {
                        echo "<p class='alert alert-danger' role='alert'> ". $error['password'] . "</p>";
                      }
                    ?>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="confirmPassword" class="form-control" name="confirmPassword" placeholder="Confirm Password"/>
                        <label class="form-label" for="confirmPassword">Confirm Password</label>
                      </div>
                    </div>

                    <?php
                      if(isset($error['confirm'])) {
                        echo "<p class='alert alert-danger' role='alert'> ".$error['confirm'] ."</p>";
                      }
                    ?>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" name="register" class="btn btn-primary btn-lg">Register</button>
                    </div>
  
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>

  <?php include 'footer.php';?>

</body>

</html>