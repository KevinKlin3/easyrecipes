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
        <!--FontAwesome kit-->
          <script src="https://kit.fontawesome.com/c0e800fc4a.js" crossorigin="anonymous"></script>
        <!--External Style sheet-->
          <link rel="stylesheet"  type="text/css" href="..\..\admin\css\index.css">
          <link rel="stylesheet" type="text/css" href="../../admin/css/gallery.css">
        <!-- favicon -->
          <link rel="icon" type="image/png" sizes="32x32" href="..\..\admin\images\logo.png">
    </head>
    <body>
    <!--php here to show hero img on index; other for all other pages-->
<?php
 if ($pageTitle == "Home")	{
   $headerImg =<<<HERE
       <header class="container-fluid">
           <img class="img-fluid" src="..\..\admin\images\hero5.svg" alt="collage of food images">
           </header>
HERE;
   }else    {
   $headerImg =<<<HERE
        <header class="container-fluid">
           <img class="img-fluid" src="..\..\admin\images\header.svg" alt="collage of food images">
           </header>
HERE;
}
        print $headerImg
?>
        <!-- Nav Bar -->
        <nav class="navbar navbar-expand-sm navbar-dark sticky-top">
         <div class="container-fluid">
             <div class="fluid-img">
                 <img  src="..\..\admin/images/logo.png" class="navbar-brand" id="logo" alt="logo for page">
              </div>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
             <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               <li class="nav-item">
                 <a class="nav-link active" aria-current="page" href="..\..\index.php">Home</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="..\..\gallery.php">Recipe Gallery</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link disabled">About Us</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link disabled">Contact us</a>
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
        <!--add burger-->
<?php
print $pageContent;
?>
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