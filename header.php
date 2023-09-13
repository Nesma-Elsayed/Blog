<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/fevicon.png" type="">

  <title> Blog </title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!--  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

  <!-- cdn for icons -->
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css\style.css" type="text/css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css\myStyle.css" />
</head>

<body class="sub_page">
  

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.php">
              <span>
                Blog
              </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>


                <li class="nav-item">
                <?php if(isset($_SESSION['user'])) { ?>
                  <a class="nav-link" href="service.php">  service</a>
                  <?php } ?>
                </li>

                <li class="nav-item">
                <?php if(isset($_SESSION['user'])) { ?>
                  <a class="nav-link" href="allposts.php">  All posts</a>
                  <?php } ?>
                </li>

                <li class="nav-item">
                <?php if(isset($_SESSION['user'])) { ?>
                  <a class="nav-link" href="post.php"> <i class="bi bi-plus"></i> Create Post</a>
                  <?php } ?>
                </li>
                  
                <li class="nav-item">
                <?php if(isset($_SESSION['user'])) { ?>
                  <a class="nav-link fs-5" href="php/user.php"><i class="bi bi-person-circle fs-5"></i> <?php echo $_SESSION['UserName'] ?></a>
                  <?php } ?>
                </li>

                <li class="nav-item">
                  <?php if(!isset($_SESSION['user'])) { ?>
                    <a class="nav-link" href="login.php"> <i class="fa fa-user" aria-hidden="true"></i> Login</a>
                <?php }
                else {?>
                    <a class="nav-link" href="php/logout.php">  Log Out</a>

                <?php }
                 ?>
 
                </li>

                <li class="nav-item">
                <?php if(!isset($_SESSION['user'])) { ?>
                  <a class="nav-link" href="registerPage.php"> <i class="fa fa-user" aria-hidden="true"></i> Sign Up</a>
                  <?php } ?>
                </li>




                <form class="form-inline">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
                </form>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
