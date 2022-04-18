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
        <!-- internal css -->
        <link rel="stylesheet" href="admin\css\index.css">


    </head>
    <body>
        <div class="fakeimg" style="margin-bottom:0" >
            <img src="admin/images/hero_main.jpg" class="fakeimg" alt="collage of food images">
        </div>
        <!-- Nav Bar -->
        <nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background-color:#FDAC53 ;">
            <a href="index.php" class="navbar-brand mb-0 h1" >Easy Recipes</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active"><a href="#" class="nav-link active">Home</a></li>
                    <li class="nav-item"><a href="gallery.php" class="nav-link" role="button">Recipe Gallery</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">About Us</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a href="#" class="dropdown-item">Who we are?</a></li>
                                <li><a href="#" class="dropdown-item">What we love?</a></li>
                                <li><a href="#" class="dropdown-item">How to contact us?</a></li>
                            </ul>
                    </li>
                </ul>
            </div>
            <!-- sign in -->
            <form class="d-flex">
                <button type="submit" class="btn btn-dark"> Sign In</button>
            </form>
        </nav>
        <!-- End of NavBar -->
    <div class="container" style="margin-top:30px">
    <div class="row align-self-start">
    <div class="col-sm-4">
    <h2>Why Sharing Recipes?</h2>

    <div class="fakeimg"><img src="admin/images/food_bowl.jpg" class="img-rounded" alt="deconstructed salad bowl" width="100%" height="auto"> </div>
    <p>Sharing a recipe can be like sharing an intimate memory, one that transcends the table. ... So while recipe sharing speaks to the great human warmth that can be realized at a dinner table, recipe guarding speaks to a fundamental lack of trust. Fortunately, trust is something that can be forged over a shared plate of food.</p>

    <p>Recipe Site</p>
    <ul class="nav nav-pills flex-column">
    <li class="nav-item">
    <a class="nav-link active" href="#">Home</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#">About</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#">Recipe Gallery</a>
    </li>
    <li class="nav-item">
    <a class="nav-link disabled" href="#">More..</a>
    </li>
    </ul>
<hr class="d-sm-none">
</div>
 
HERE;
print $pageContent;
echo<<<HERE
</div>
</div>
<hr>
    <footer class="container-fluid">
    <p> Developed by Yordin Kirk, Semhar Bire, Damaris Gonzalez</p>
    <p>© BHC Web Dev 2022</p>
    <i class="fa-brands fa-youtube"></i>
    <i class="fa-brands fa-instagram-square"></i>
    <i class="fa-brands fa-pinterest"></i>
    <i class="fa-brands fa-facebook-square"></i>
    </footer>
</body>
</html>
HERE;
?>