<?php
include 'config.php';
if(!$conn)  {
   echo "Failed to connect to MySQL: ". mysqli_connect_error();
}

$pageTitle = "Home";
$pageContent = NULL;

$pageContent =<<<HERE
<main class="container">
<h2>Thank You, You Have Submitted Your Information Successfully!</h2>

</main>
HERE;
include 'template.php'
?>
