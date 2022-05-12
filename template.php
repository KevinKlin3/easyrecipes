<!DOCTYPE html>
<html lang="en">
  <head >
    <title>Easy Recipes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">      
    <!--External Style sheet-->
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/recipe.css">
    <!-- favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images\logo.png">
    <!--Fonts from google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Satisfy&display=swap" rel="stylesheet">
  </head>

  <body>
    <header class="hero">
    </header>
    <div>
      <h1 class="header">Easy Recipies</h1>
    </div>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-sm navbar-dark sticky-top">
        <div class="container-fluid">
          <div class="fluid-img">
            <img  src="images/logo.png" class="navbar-brand" id="logo" alt="logo for page">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNav" aria-controls="myNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          <div class="collapse navbar-collapse" id="myNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link text-dark" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="recipe.php">Recipes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="about.php">About Us</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button id="button" class="btn btn-outline-primary btn-sm" type="submit" >Search</button>
            </form>
          </div>
        </div>
      </nav>
      <!-- End of NavBar -->
<?php
print $pageContent;
?>
    <footer class="container-fluid">
    <hr>
      <!-- sign in -->
      <?php
		$loginButton = NULL;
      if (auth_user()) {
        $loginButton = '<form class="form-inline" action="index.php" method="post">
            <button class="btn btn-outline-primary btn-sm mb-2" name="logout" type="submit">Log Out</button>
          </form> 
          <form class="form-inline" action="profile.php" method="post" >
            <button class="btn btn-outline-success btn-sm mb-2" type="submit">Profile</button>
          </form>';
      } else {
        $loginButton = '<form class="form-inline" action="login.php" method="post" >
          <button class="btn btn-outline-primary btn-sm mb-2" type="submit">Sign In</button>
        </form>';
      }
      print $loginButton;
      ?>
      <a href="register.php">Sign up</a>
      <h6 class="mb-4 mt-4">Developed by Yordin Kirk, Damaris Gonzalez, Semhar Bire</h6>
      <div class="container-fluid">
      <a href="https://www.youtube.com" target="_blank"><i class="bi bi-youtube"></i></a>
      <a href="https://www.instagram.com" target="_blank"><i class="bi bi-instagram"></i></a>
      <a href="https://www.pinterest.com" target="_blank"><i class="bi bi-pinterest "></i></a>
      <a href="https://www.facebook.com" target="_blank"><i class="bi bi-facebook"></i></a>
    </div>
      <h7>© BHC Web Dev 2022</h7>
    </footer>
  </body>
</html>