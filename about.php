
<?php
include 'config.php';
if(!$conn)  {
   echo "Failed to connect to MySQL: ". mysqli_connect_error();
}
$pageTitle = "Home";

$pageContent = <<<HERE
<main class="container mt-1">
  <h2 class="text-center" id="title">Our Team</h2>
  <div class="row">
    <div class="col-sm-4">
      <div class="card shadow p-4 m-2">
        <img class="card-img-top" src="images/jordan.png" alt="Jordan">
        <div class="card-body">
          <h2 id="name">Yordin Kirk</h2>
          <p class="card-title">Web Developer</p>
          <p>Some text that describes me lorem ipsum ipsum lorem.</p>
          <p>jordan@example.com</p>
          <button class="btn btn-dark m-2"><a class="text-white m-1" href="contactus.php">Contact</a></button>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card shadow p-4 m-2">
        <img class="card-img-top" src="images/demaris.png" alt="Damaris">
        <div class="card-body">
          <h2 id="name">Damaris Gonzalez</h2>
          <p class="card-title">Web Developer</p>
          <p>Some text that describes me lorem ipsum ipsum lorem.</p>
          <p>demaris@example.com</p>
          <button class="btn btn-dark m-2"><a class="text-white m-1" href="contactus.php">Contact</a></button>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card shadow p-4 m-2">
        <img class="card-img-top" src="images/semhar.png" alt="Semhar">
        <div class="card-body">
          <h2 id="name">Semhar Bire</h2>
          <p class="card-title">Web Developer</p>
          <p>Some text that describes me lorem ipsum ipsum lorem.</p>
          <p>semhar@example.com</p>
          <button class="btn btn-dark m-2"><a class="text-white m-1" href="contactus.php">Contact</a></button>
        </div>
      </div>
    </div>
  </div>
</main>
HERE;
include 'template.php'
?>