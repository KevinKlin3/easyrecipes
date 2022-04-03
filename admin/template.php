<?php
echo<<<HERE
<!DOCTYPE html>
<html lang="en">
    <head >
        <title>Easy Recipes</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--bootstrap5-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        
    <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

    <!--javaScript-->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--FontAwesome kit-->
        <script src="https://kit.fontawesome.com/c0e800fc4a.js" crossorigin="anonymous"></script>
        
    <!--External Style sheet-->
        <link rel="stylesheet"  type="text/css" href="admin\css\index.css">
    <!-- favicon -->
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.ico">
    </head>
    <body>
        <header class="container-fluid">
        <img class="img-fluid" src="admin\images\hero3.jpg" alt="collage of food images">
        </header>
        <!-- Nav Bar -->
            <nav class="navbar navbar-expand-sm  navbar sticky-top">
                <ul class="navbar-nav">
                    <li "container-fluid">
                        <img  src="admin/images/logo.png" class="navbar-brand" id="logo" alt="logo for page">
                    </li>
                    <li class="navbar-nav">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="navbar-nav">
                        <a class="nav-link" href="gallery.php">Recipe Gallery</a>
                    </li>
                    <li class="navbar-nav">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="navbar-nav">
                        <a class="nav-link" href="#">Contact us</a>
                    </li>
                </ul>
                <form class="d-flex right" id="searchbar">
                    <input class="form-control me-2" type="text" placeholder="Search">
                        <button class="buttonSearch" type="button">Search</button>
                </form>
            </nav>
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
    <a href="https://www.youtube.com" target="_blank"><i class="fa-brands fa-youtube"></i></a>
    <a href="https://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram-square"></i></a>
    <a href="https://www.pinterest.com" target="_blank"><i class="fa-brands fa-pinterest"></i></a>
    <a href="https://www.facebook.com" target="_blank"><i class="fa-brands fa-facebook-square"></i></a>
    </footer>
</body>
</html>
HERE;
?>