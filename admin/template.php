<?php
echo<<<HERE
<!DOCTYPE html>
<html lang="en">
    <head >
        <title>Easy Recipes</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!--FontAwesome kit-->
        <script src="https://kit.fontawesome.com/c0e800fc4a.js" crossorigin="anonymous"></script>
        <!--External Style sheet-->
        <link rel="stylesheet"  type="text/css" href="admin\css\index.css">
    </head>
    <body>
        <header>
            <img src="admin/images/hero2.jpg" alt="collage of food images">
        </header>
    <!-- Nav Bar -->
<ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="gallery.php">Recipe Gallery</a></li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">About Us</a>
    <div class="dropdown-content">
      <a href="#">Who we are?</a>
      <a href="#">What we love?</a>
      <a href="#">How to contact us?</a>
    </div>
  </li>
</ul>
    <!-- End of NavBar -->
HERE;
print $pageContent;
// add third column here ?//
echo<<<HERE
<hr>
    <footer class="container-fluid">
                <!-- sign in -->
            <a class="button" href="#">Sign In</a>
    <p> Developed by Yordin Kirk, Semhar Bire, Damaris Gonzalez</p>
    <p>© BHC Web Dev 2022</p>
    <a href="www.youtube.com" ><i class="fa-brands fa-youtube"></i></a>
    <i class="fa-brands fa-instagram-square"></i>
    <i class="fa-brands fa-pinterest"></i>
    <i class="fa-brands fa-facebook-square"></i>
    </footer>
</body>
</html>
HERE;
?>