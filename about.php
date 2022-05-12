
<?php
include 'config.php';
if(!$conn)  {
   echo "Failed to connect to MySQL: ". mysqli_connect_error();
}

$pageTitle = "Home";

$pageContent = <<<HERE
<main class="container mt-1">
  <h1 class="text-center">Our Team</h1>
  <div class="row">
    <div class="col-sm-4 h-50">
      <div class="card shadow p-4 m-2">
        <img class="card-img-top" src="images/jordan.png" alt="Jordan">
        <div class="card-body">
          <h2 id="name">Yordin Kirk</h2>
          <p id="ptitle"class="card-title">Web Developer</p>
          <p>As a Dallas College student who enjoys coding and the aesthetics of web design, I decided to study Web Design and Development. I am set to graduate in December of 2022 with my Associates in Applied Science.</p>
          <button class="btn btn-dark m-2"><a class="text-white m-1" href="contact.php">Contact</a></button>
        </div>
      </div>
    </div>
    <div class="col-sm-4 h-50">
      <div class="card shadow p-4 m-2">
        <img class="card-img-top" src="images/demaris.png" alt="Damaris">
        <div class="card-body">
          <h2 id="name">Damaris Gonzalez</h2>
          <p id="ptitle" class="card-title">Web Developer</p>
          <p>As a business administrator with experience in selling technology solutions, I decided I can apply my knowledge to generate new ideas and business models. I decided to study Web Production and Design and am set to graduate (insert graudation here).</p>
          <button class="btn btn-dark m-2"><a class="text-white m-1" href="contact.php">Contact</a></button>
        </div>
      </div>
    </div>
    <div class="col-sm-4 h-50">
      <div class="card shadow p-4 m-2">
        <img class="card-img-top" src="images/semhar.png" alt="Semhar">
        <div class="card-body">
          <h2 id="name">Semhar Bire</h2>
          <p id="ptitle" class="card-title">Web Developer</p>
          <p>My name is Semhar and I am a Web Developer.I am very passionate about Web Development, and strive to better myself as a developer, and the development community as a whole.</p>
          <br>
          <button class="btn btn-dark m-2"><a class="text-white m-1" href="contact.php">Contact</a></button>
        </div>
      </div>
    </div>
  </div>
</main>
HERE;
include 'template.php'
?>