<?php
echo<<<HERE
<!DOCTYPE html>
<html lang="en">
    <head >
        <title>Easy Recipes</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap4-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!--Jquery-->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!--jsPopper-->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!--JavaScript-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!--FontAwesome kit-->
        <script src="https://kit.fontawesome.com/c0e800fc4a.js" crossorigin="anonymous"></script>
        
    <!--External Style sheet-->
        <link rel="stylesheet"  type="text/css" href="admin\css\index.css">
    </head>
    <body>
        <header>
            <img class="img-fluid" id="img-head" src="admin/images/hero2.jpg" alt="collage of food images">
        </header>
        <!-- Nav Bar -->
            <nav class="navbar navbar-expand-sm bg-light navbar-dark">
                <ul class="navbar-nav">
                    <li>
                        <img src="admin/images/logo.png" class="img-thumbnail" alt="logo for page">
                    </li>
                    <li "nav-item active">
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
                    <li>
                        <form class="form-inline" action="">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search">
                                <button class="btn btn-success" id="btnSearch" type="submit">Search</button>
                        </form>
                    </li>
                </ul>
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