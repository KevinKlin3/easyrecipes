<?php
echo<<<HERE
<!DOCTYPE html>
<html lang="en">
    <head >
        <title>Easy Recipes</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap 3 -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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