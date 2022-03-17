<?php
$pageTitle = "Gallery";
$pageContent = NULL;

$pageContent .= <<<HERE
<div class="container"
<div class="row">
  <div class="col-sm">
      <div class="card text-dark border-primary" style="width: 18rem;">
         <img src="admin/images/test_img/fries.jpg" class="card-img-top" alt="fries in a paper sleeve">
         <div class="card-body">
            <h5 class="card-title">Card title</h5>
               <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
               <a href="#" class="btn btn-primary">Go somewhere</a>
         </div>
      </div>
   </div>
   <div class="col-sm">
      <div class="card text-dark border-primary" style="width: 18rem;">
         <img src="admin/images/test_img/eggs_smile.jpg" class="card-img-top" alt="eggs sunny side up smiling">
         <div class="card-body">
            <h5 class="card-title">Card title</h5>
               <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
               <a href="#" class="btn btn-primary">Go somewhere</a>
         </div>
      </div>
   </div>
HERE;
include 'admin/template.php';
?>